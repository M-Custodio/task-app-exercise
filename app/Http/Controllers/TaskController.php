<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
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
        $users = User::all();

        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'user_ids' => 'array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'user_id' => auth()->id(),
        ]);

        $task->users()->attach(auth()->id());
        $task->users()->attach($request->user_ids);
        $task->status = 'in-progress';

        return redirect()->route('tasks');
    }

    public function edit(Task $task)
    {
        //check if the task belongs to the authenticated user
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $users = User::all();

        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        //check if the task belongs to the authenticated user
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable|string',
            'status' => 'required|in:in-progress,completed',
            'due_date' => 'nullable|date',
            'user_ids' => 'array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);
        $task->users()->sync($request->user_ids);

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
