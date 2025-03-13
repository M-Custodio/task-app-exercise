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
        <x-tasks-filter />
      </div>
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="hidden md:block overflow-x-auto">
            <table class="table-auto w-full border-collapse">
              <thead>
                <tr class="bg-gray-200">
                  <x-tasks-th>Title/Name</x-tasks-th>
                  <x-tasks-th>Description</x-tasks-th>
                  <x-tasks-th class="text-center">Due</x-tasks-th>
                  <x-tasks-th class="text-center">Status</x-tasks-th>
                  <x-tasks-th class="text-center">Actions</x-tasks-th>
                </tr>
              <tbody>
                @foreach ($tasks as $task)
                  <x-tasks-tr :task="$task" />
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="block md:hidden">
            @foreach ($tasks as $task)
              <x-tasks-card :task="$task" />
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
