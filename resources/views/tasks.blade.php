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

    <div class="py-4 md:py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end mb-4 pr-2 md:pr-0">
          <form action="{{ route('tasks') }}" method="get" class="flex flex-wrap space-x-2">
            <select name="status" id="status" class="bg-transparent border-transparent text-right">
              <option value="">All</option>
              <option value="in-progress" {{ request('status') === 'in-progress' ? 'selected' : '' }}>In Progress</option>
              <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            <button type="submit" class="bg-primary hover:bg-accent text-white font-semibold py-2 px-4 rounded shadow ml-2">Filter</button>
          </form>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div class="hidden md:block overflow-x-auto">
              <table class="table-auto w-full border-collapse">
                <thead>
                  <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Title/Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Description</th>
                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Due</th>
                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Status</th>
                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tasks as $task)
                    <tr class="border-t hover:bg-gray-100">
                      <td class="px-4 py-2 text-sm text-gray-900">{{ $task->name }}</td>
                      <td class="px-4 py-2 text-sm text-gray-900">{{ $task->description }}</td>
                      <td class="px-4 py-2 text-center text-sm text-gray-900">
                        @if($task->due_date)
                          {{ \Carbon\Carbon::parse($task->due_date)->format('jS M') }}
                        @else
                          <span class="text-gray-400">No due date</span>
                        @endif
                      </td>
                      <td class="px-4 py-2 text-center">
                        <i class='bx bxs-circle text-xl cursor-pointer {{ $task->status === 'in-progress' ? 'text-orange-400' : 'text-green-700' }}'
                          title="{{ $task->status === 'in-progress' ? 'In Progress' : 'Completed' }}"
                          onclick="toggleStatus({{ $task->id }}, this)"></i>
                      </td>
                      <td class="px-4 py-2 flex justify-center items-center space-x-4">
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
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="block md:hidden">
              @foreach ($tasks as $task)
                <div class="border rounded-lg p-4 mb-4 hover:bg-gray-100">
                  <div class="flex justify-between items-center">
                    <div>
                      <h3 class="text-lg font-semibold">{{ $task->name }}</h3>
                      <p class="text-sm text-gray-600">{{ $task->description }}</p>
                      <p class="text-sm text-gray-600">
                        @if($task->due_date)
                          {{ \Carbon\Carbon::parse($task->due_date)->format('jS M') }}
                        @else
                          <span class="text-gray-400">No due date</span>
                        @endif
                      </p>
                    </div>
                    <div class="flex items-center space-x-4">
                      <i class='bx bxs-circle text-xl cursor-pointer {{ $task->status === 'in-progress' ? 'text-orange-400' : 'text-green-700' }}'
                        title="{{ $task->status === 'in-progress' ? 'In Progress' : 'Completed' }}"
                        onclick="toggleStatus({{ $task->id }}, this)"></i>
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
              @endforeach
            </div>
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
