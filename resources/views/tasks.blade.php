<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-black-800 leading-tight">
      Tasks
    </h2>
    <a href="{{ route('tasks.create') }}"
      class="bg-primary hover:bg-accent text-white font-semibold py-2 px-4 rounded shadow">
      Create Task
    </a>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="flex justify-end mb-4">
        <form action="{{ route('tasks') }}" method="get">
          <select name="status" id="status" class="bg-transparent border-transparent text-right">
            <option value="">All</option>
            <option value="in-progress" {{ request('status') === 'in-progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
          </select>
          <button type="submit"
            class="bg-primary hover:bg-accent text-white font-semibold py-2 px-4 rounded shadow ml-2">Filter</button>
        </form>
      </div>
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <table class="table-auto w-full ">
            <thead>
              <tr>
                <th>Title/Name</th>
                <th>Description</th>
                <th>Due</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tasks as $task)
                <tr>
                  <td>{{ $task->name }}</td>
                  <td>{{ $task->description }}</td>
                  <td class="text-center">{{ \Carbon\Carbon::parse($task->due_date)->format('jS M') }}</td>
                  <td class="text-center">
                    <i class='bx bxs-circle text-xl cursor-pointer {{ $task->status === 'in-progress' ? 'text-orange-400' : 'text-green-700' }}'
                      title="{{ $task->status === 'in-progress' ? 'In Progress' : 'Completed' }}"
                      onclick="toggleStatus({{ $task->id }}, this)"></i>
                  </td>
                  <td class="flex justify-center items-center space-x-7">
                    <a href="{{ route('tasks.edit', $task->id) }}">
                      <i class='bx bx-edit-alt text-xl'></i>
                    </a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit">
                        <i class='bx bx-trash text-xl'></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="mt-4">
            {{ $tasks->links('vendor.pagination.tailwind') }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function toggleStatus(taskId, element) {
      fetch(`/tasks/${taskId}/toggle-status`, {
          method: 'PATCH',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'in-progress') {
            element.classList.remove('text-green-700');
            element.classList.add('text-orange-400');
            element.setAttribute('title', 'In Progress');
          } else {
            element.classList.remove('text-orange-400');
            element.classList.add('text-green-700');
            element.setAttribute('title', 'Completed');
          }
        })
        .catch(error => console.error('Error:', error));
    }
  </script>
</x-app-layout>
