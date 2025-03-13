<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $status = $request->input('status');

        $tasks = Task::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhereHas('users', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
        })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderByRaw('ISNULL(due_date), due_date ASC')
            ->paginate(10);

        // Append query parameters to pagination links
        $tasks->appends($request->query());

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
        $user = auth()->user();

        // Check if the task belongs to the authenticated user or is assigned to the authenticated user
        if ($task->user_id !== $user->id && !$task->users->contains($user->id)) {
            abort(403);
        }

        $users = User::all();

        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $user = auth()->user();

        // Check if the task belongs to the authenticated user or is assigned to the authenticated user
        if ($task->user_id !== $user->id && !$task->users->contains($user->id)) {
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
        $user = auth()->user();

        // Check if the task belongs to the authenticated user or is assigned to the authenticated user
        if ($task->user_id !== $user->id && !$task->users->contains($user->id)) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks');
    }

    public function toggleStatus(Task $task)
    {
        $user = auth()->user();

        // Check if the task belongs to the authenticated user or is assigned to the authenticated user
        if ($task->user_id !== $user->id && !$task->users->contains($user->id)) {
            abort(403);
        }

        // Toggle the status
        $task->status = $task->status === 'in-progress' ? 'completed' : 'in-progress';
        $task->save();

        return response()->json(['status' => $task->status]);
    }
}
