<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $country = Country::all();
        return view('admin.user.pages-profile', compact('country'));
    }
    
    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
    
        $data = $request->all();
        $file = $request->avatar;
    
        if (empty($data['password'])) {
            $data['password'] = $user->password;
        } else {
            $data['password'] = bcrypt($data['password']);
        }
    
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
            $path = public_path('upload/user/avatar');
            $file->move($path, $data['avatar']);
        }
    
        if ($user->update($data)) {
            if (!empty($file)) {
                // Cập nhật avatar nếu có
                $user->avatar = $data['avatar'];
            }
    
            $selectCountry = $request->input('select-country');
            // Chỉ cập nhật quốc gia nếu có sự thay đổi
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

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
