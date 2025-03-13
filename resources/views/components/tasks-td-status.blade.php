@props(['status', 'taskId'])

<td class="px-4 py-2 text-center">
    <i class='bx bxs-circle text-xl cursor-pointer {{ $status === 'in-progress' ? 'text-orange-400' : 'text-green-700' }}'
      title="{{ $status === 'in-progress' ? 'In Progress' : 'Completed' }}"
      onclick="toggleStatus({{ $taskId }}, this)"></i>
  </td>
