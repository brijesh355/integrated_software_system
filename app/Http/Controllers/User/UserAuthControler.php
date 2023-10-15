<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserAuthControler extends Controller
{
    public function login()
    {
        return view('user.login');
    }
    public function authenticate(Request $request)
    {

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
    public function register(Request $request)
    {
        return view('user.register');
    }
    public function registerStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' =>    'required|min:3|max:100',
            'email' => 'required|email',
            'password' => 'required|min:6|max:12',
        ]);
        if ($validator->fails()) {
            return Redirect()->back()->withErrors($validator);
        } else {
            $user = User::where(['email' => $request->email, 'user_type' => 'user'])->first();
            if ($user) {
                return redirect()->route('user.register')->with('error', 'Entered email already exists.');
            }

            $create = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'user_type' => 'user',
                'status' => 'active',
            ];
            $userCreated = User::create($create);
            if ($userCreated) {
                return redirect()->route('user.login')->with('success', 'User register successfully, Please login.');
            } else {
                return redirect()->route('user.login')->with('error', 'Something went wrong, Please try again.');
            }
        }
    }
    public function dashboard()
    {
        return view('user.dashboard');
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('user.login')->with('success', 'User logout successfully.');
    }
    public function editProfile(Request $request)
    {
        $userAuth = Auth::user();
        if ($userAuth) {
            return view('user.edit_profile', compact('userAuth'));
        }
    }
    public function updateProfile(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'name' =>    'required|min:3|max:100',
            'email' => 'required|email',
            'profile_pic' => 'nullable|mimes:png,jpg',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6',
        ]);
        if ($validator->fails()) {
            return Redirect()->back()->withErrors($validator);
        } else {
            $update = [];
            if ($request->file('profile_pic')) {
                $file = $request->file('profile_pic');
                $name = $file->getClientOriginalName();
                $file->move('uploads/images', $name);

                if (file_exists(public_path($name =  $file->getClientOriginalName()))) {
                   $deletePic = url('uploads/images/'.$update['profile_pic']);
                   if($deletePic){
                    File::delete($deletePic);
                   }
                    unlink(public_path($name));
                };
                //Update Image
                $update['profile_pic'] = $name;
            }
            $update['name'] = $request->name;
            $update['email'] = $request->email;
            $update['password'] =  Hash::make($request->password);
            User::where('id',Auth::user()->id)->update($update);
            return redirect()->route('user.dashboard')->with('success', 'User profile updated successfully.');
        }
    }
}
