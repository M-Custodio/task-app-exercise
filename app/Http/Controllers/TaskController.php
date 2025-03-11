<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', auth()->id());

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Modify the sorting to put null due_date's at the end
        $tasks = $query->orderByRaw('due_date IS NULL, due_date')->paginate(10);

        return view('tasks', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'due_date' => 'date',
        ]);

        //add status to $request
        $request->request->add(['status' => 'in-progress']);

        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => auth()->id(),
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks');
    }

    public function edit(Task $task)
    {
        //check if the task belongs to the authenticated user
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        //check if the task belongs to the authenticated user
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|min:3',
            'status' => 'required|in:in-progress,completed',
            'due_date' => 'date',
        ]);

        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks');
    }

    public function destroy(Task $task)
    {
        //check if the task belongs to the authenticated user
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks');
    }
}
