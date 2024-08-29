<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Http\Requests\Frontend\MemberRequest;
use App\Http\Requests\Frontend\MemberLoginRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.member.login');
    }

    public function register()
    {
        $country = Country::all();
        return view('frontend.member.register', compact('country'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(MemberRequest $request)
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

        return redirect()->route('member.login');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(MemberLoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0,
        ];

        $remember = false;

        if ($request->remember_me) {
            $remember = true;
        }

        if (Auth::attempt($login, $remember)) {
            return redirect('/member/blog');

        } else {
            return redirect()->back()->withErrors(['login' => 'Email or Password is not correct.']);
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function account()
    {
        $country = Country::all();
        return view('frontend.account.account', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $data = $request->all();
        $file = $request->avatar;

        if(empty($data['password'])) {
            $data['password'] = $user->password;
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        if(!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
            $path = public_path('upload/member/avatar');
            $file->move($path,  $data['avatar']);
        }

        if ($user->update($data)) {

            if (!empty($file)) {
                $user->avatar = $data['avatar'];
            }

            $selectCountry = $request->input('select-country');
    
            if ($user->id_country != $selectCountry) {
                $user->id_country = $selectCountry;
            }

            $user->phone = $request->input('phone');
    
            $user->save();

            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('member.login');
    }
}
