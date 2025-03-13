@props(['taskId'])

<td class="px-4 py-2 flex justify-center items-center space-x-4">
  <a href="{{ route('tasks.edit', $taskId) }}" class="text-blue-500 hover:text-blue-700">
    <i class='bx bx-edit-alt text-xl'></i>
  </a>
  <form action="{{ route('tasks.destroy', $taskId) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-500 hover:text-red-700">
      <i class='bx bx-trash text-xl'></i>
    </button>
  </form>
</td>
