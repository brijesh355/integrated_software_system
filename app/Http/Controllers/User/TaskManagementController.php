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
        $taskList = Task::orderBy('due_date','Desc');
        if(!empty($request->get('keyword'))){
            $taskList = $taskList->where('title','like','%'.$request->get('keyword').'%');
        }
        $taskList = $taskList->paginate(10);
        return view('user.task.list',compact('taskList'));
    }
    public function createTask(){
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
        $task = Task::where('id',$id)->first();
        if($task){
            return view('user.task.edit',compact('task'));
        }
    }
    public function deleteTask($id){
       $task = Task::where('id',$id)->first();
       if($task){
        $task->delete();
        return redirect()->route('user.taskList')->with('success', 'Task deleted successfully.');
       }
    }
    public function updateTask(Request $request){
        
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
}
