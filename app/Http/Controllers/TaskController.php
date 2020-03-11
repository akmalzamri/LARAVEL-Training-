<?php

namespace App\Http\Controllers;

use PDF;
use App\Task;
use App\User;
use App\Exports\TaskExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TaskController extends Controller
{

// UNTUK BUAT SELECT YG DIE TARIK DARI DATABASE
    
    protected function getUserList($users)
    {
        $input =[];

        $input ['']= "Please Choose";
        
        foreach ($users as $user)
        {
            $input [$user->id] = $user->name;
        }

       

        return $input;
    }

    protected function getUserEmail($users){
        $input =[];

        $input ['']= "Please Choose";

        foreach ($users as $user)
        {
            $input [$user->id] = $user->email;
        }

        return $input;

    }


    public function getlist(Request $req)
    {

        $name = $req->name;
        $tasks = \App\Task::orderBy('id', 'asc');
        $users = User::get();

        $paramString = $req->getQueryString(); 
        
        // untuk panggil dkt view nnti
        $input = $this->getUserList($users, 'name');
        $inputEmail = $this->getUserEmail($users, 'email');

        // untuk filter any ayat
        $params = (object) $req->all(); 


        // User filter by name je takyah filter query
        if($req->filled('name')){
        $tasks = \App\Task::where('name', 'LIKE', "%$name%")->orderBy('id', 'asc');
        
        $name = $req->name;
        }

        if ($req->filled('user_id')){
            $tasks = Task::where('user_id', $req->user_id);
        }

        if ($req->filled('email')){
            $tasks = Task::where('user_id', $req->email);
        }
  

        $tasks = $tasks->paginate(5);
        
        return view('tasks.index', compact('tasks', 'users', 'input', 'inputEmail', 'params', 'paramString'));

    }



    public function createform(Request $req){

        $name = $req->name;
      
        $users = User::get();

        // untuk panggil dkt view nnti
        $input = $this->getUserList($users, 'name');


        return view ('tasks.create', compact('input'));

    }

    public function create(Request $req){

        $tasks = new Task();

        $tasks->name = $req->name;
        $tasks->content = $req->content;
        $tasks->user_id = $req->user_id;

        $tasks->save();

        return redirect('tasks')->with('status','success');

    }

    public function ViewTask($id){

        $task = Task::find($id);

        $users = User::get();

        $input = $this->getUserList($users);


        return view('tasks.view', compact('task', 'users', 'input'));

    }

    public function Delete($id){
        Task::where('id', $id)->delete();

        return redirect()->back()->with('status','Success');

    }



    // PDF
    public function getViewTaskPdf($id){

        $task = Task::find($id);

        $users = User::get();

        $input = $this->getUserList($users);

        $pdf = PDF::loadview('tasks.view-pdf', compact('users','task', 'input'));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream();

    }

    public function getListExcel(Request $req){

        $task = Task::orderBy('id','desc');

        if ($req->filled('name')){
            $task = $task->where('name', 'like',"%". $req->name . "%");
          
            }
        if ($req->filled('user_id')){
            $task = $task->where('user_id',  $req->user_id );
          
            }
        if ($req->filled('email')){
            $task = $task->where('email', $req->email );
          
            }

            $task = $task->get();

            return Excel::download(new TaskExport($task), 'task.xlsx');

    }


}
