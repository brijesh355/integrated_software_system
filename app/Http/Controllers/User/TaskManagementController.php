<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskManagementController extends Controller
{
    public function taskList(Request $request){
        $taskList = Task::paginate(10);
        return view('user.task.list',compact('taskList'));
    }
    public function createTask(Request $request){
        return view('user.task.create');
    }
    public function storeTask(Request $request){

        $validator = Validator::make($request->all(), [
            'title' =>    'required|min:3|max:100',
            'due_date' => 'required|date',
            'description' => 'required|min:6|max:200',
        ]); 
        if ($validator->fails()) {
            return Redirect()->back()->withErrors($validator);
        }
        else{
            $create = [
                'title' => $request->title,
                'due_date' => Carbon::parse($request->due_date)->format('Y-m-d'),
                'status' => 'Inprogress',
                'user_id' => Auth::user()->id,
                'description' => $request->description
            ];
            Task::create($create);
            return redirect()->route('user.taskList')->with('success', 'Task created successfully.');
        }
    }
    public function editTask(Request $request, $id){
        return view('user.task.edit');
    }
    public function deleteTask($id){
       $task = Task::where('id',$id)->first();
       if($task){
        $task->delete();
        return redirect()->route('user.taskList')->with('success', 'Task deleted successfully.');
       }
    }
}
