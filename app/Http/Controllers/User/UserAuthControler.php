<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAuthControler extends Controller
{
    public function signup(){
        return view('user.register');
    }
}
