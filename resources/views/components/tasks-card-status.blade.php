@props(['status', 'taskId'])


<i class='bx bxs-circle text-xl cursor-pointer {{ $status === 'in-progress' ? 'text-orange-400' : 'text-green-700' }}'
  title="{{ $status === 'in-progress' ? 'In Progress' : 'Completed' }}"
  onclick="toggleStatus({{ $taskId }}, this)"></i>
