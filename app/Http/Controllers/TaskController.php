<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(Request $request){

        $task = new Task;

        $this->validate($request,[
            'task'=>'required|max:100|min:5',
        ]);
    

        $task->task=$request->task;
        $task->save();
        
        $data=Task::all();
        //dd($data);

        return view('tasks')->with('tasks',$data);
        //dd($request->all());
    }

    public function UpdateTaskAsCompleted($id){
        $task=Task::find($id);
        $task->iscompleted=1;
        $task->save();
        return back()->withInput();
    }

    public function UpdateTaskAsNotCompleted($id){
        $task=Task::find($id);
        $task->iscompleted=0;
        $task->save();
        return back()->withInput();
    }

    public function DeleteTask($id){
        $task=Task::find($id);
        $task->delete();
        return back()->withInput();
    }

    public function UpdateTask($id){
        $task=Task::find($id);
        return view('updatetask')->with('taskdata',$task);
    }

    public function updatetasks(Request $request){
       $id=$request->id;
       $task=$request->task;
       $data=Task::find($id);
       $data->task=$task;
       $data->save();
       $datas=Task::all();
       return view('tasks')->with('tasks',$datas);

    }
}
