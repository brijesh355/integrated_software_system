<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserAuthControler extends Controller
{
    public function login(){
        dd(Auth::guard('web'));
        return view('user.login');
    }
    public function authenticate(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return Redirect()->back()->withErrors($validator);
        } else {

            $guard = Auth::guard('web');
            if ($guard->attempt(['email' => $request->email, 'password' => $request->password])) {
                $admin = $guard->user();
                if ($admin->user_type == 'user') {
                    return redirect()->route('user.dashboard')->with('success', 'User login successfully.');
                } else {
                    $guard->logout();
                    return redirect()->route('user.login')->with('error', 'You are not authorized to access user panel.');
                }
            } else {
                return redirect()->route('user.login')->with('error', 'Either email/password is incorrect.');
            }
        }
    }
    public function dashboard(){
        
    }
    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('user.login')->with('success', 'User logout successfully.');
    }
}
