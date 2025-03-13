<div class="border rounded-lg p-4 mb-4 hover:bg-gray-100">
  <div class="flex justify-between items-center">
    <div>
      <x-tasks-card-title>{{ $task->name }}</x-tasks-card-title>
      <x-tasks-card-text>{{ $task->description }}</x-tasks-card-text>
      <x-tasks-card-text>
        @if ($task->due_date)
          {{ \Carbon\Carbon::parse($task->due_date)->format('jS M') }}
        @else
          <span class="text-gray-400">No due date</span>
        @endif
      </x-tasks-card-text>
    </div>
    <div class="flex items-center space-x-4">
      <x-tasks-card-status :status="$task->status" :taskId="$task->id" />
      <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:text-blue-700">
        <i class='bx bx-edit-alt text-xl'></i>
      </a>
      <form action="{{ route('tasks.destroy', $task->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-500 hover:text-red-700">
          <i class='bx bx-trash text-xl'></i>
        </button>
      </form>
    </div>
  </div>
</div>
