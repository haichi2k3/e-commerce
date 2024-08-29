<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\MemberRequest;
use Illuminate\Http\Request;
use App\Mail\MailNotify;
use App\Models\Histories;
use App\Models\Products;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $data = [
            'subject' => 'Cambo Tutorial Mail',
            'body' => 'Hello This is my cart!'
        ];

        $cart = session()->get('cart', []);
        $productId = array_keys($cart);
        $products = Products::find($productId);
        try {
            Mail::to(Auth::user()->email)->send(new MailNotify($data, $cart, $products));
            $this->saveHistory($cart, Auth::user());
            return response()->json(['Great check your mail box']);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()]);
        }
    }

    public function saveHistory($cart, $user)
    {
        $history = new Histories();
        $history->email = $user->email;
        $history->phone = $user->phone;
        $history->name = $user->name;
        $history->id_user = $user->id;
        $subTotal = 0;

        foreach ($cart as $productId => $item) {
            $product = Products::find($productId);

            if ($product) {
                $total = $product->price * $item['qty'];
                $subTotal += $total;
            }

        }
        $history->price = $subTotal;
        $history->save();
    }

    public function register(MemberRequest $request)
    {
        $user = new User();
        $user->level = 0;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->phone = $request->input('phone');
        $user->id_country = $request->input('select-country');
        $file = $request->file('avatar');
        if(!empty($file)) {
            $image =  $file->getClientOriginalName();
            $path = public_path('upload/member/avatar');
            $file->move($path, $image);

            $user->avatar = $image ; 
        };
        $user->save();
        Auth::login($user);

        if (Auth::check()) {
            return redirect()->route('send-email');
        } else {
            return response()->json(['success' => 'User registered successfully.']);
        }
    }
}
