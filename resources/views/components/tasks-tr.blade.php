
@props(['task'])

<tr class="border-t hover:bg-gray-100">
  <x-tasks-td-text>{{ $task->name }}</x-tasks-td-text>
  <x-tasks-td-text>{{ $task->description }}</x-tasks-td-text>
  <x-tasks-td-text class="text-center">
    @if ($task->due_date)
      {{ \Carbon\Carbon::parse($task->due_date)->format('jS M') }}
    @else
      <span class="text-gray-400">No due date</span>
    @endif
  </x-tasks-td-text>
  <x-tasks-td-status :status="$task->status" :taskId="$task->id" />
  <x-tasks-td-actions :taskId="$task->id" />
</tr>
