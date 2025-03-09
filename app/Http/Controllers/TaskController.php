<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
      $tasks = Task::all();

      return view();
    }

    public function create(){
      return view();
    }

    public function store(Request $request){

    }

    public function edit(Task $task){
      return view();
    }

    public function update(Request $request, Task $task){

    }

    public function destroy(Task $task){

    }
}
