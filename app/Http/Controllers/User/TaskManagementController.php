<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskManagementController extends Controller
{
    public function taskList(Request $request){
        return view('user.task.create');
    }
}
