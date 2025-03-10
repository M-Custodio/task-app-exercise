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
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <table class="table-auto w-full ">
            <thead>
              <tr>
                <th>Title/Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tasks as $task)
                <tr>
                  <td>{{ $task->name }}</td>
                  <td>{{ $task->description }}</td>
                  <td class="text-center">
                    @if ($task->status === 'in-progress')
                      <i class='bx bxs-circle text-orange-400 text-xl' title="In Progress"></i>
                    @else
                      <i class='bx bxs-circle text-green-700 text-xl' title="Completed"></i>
                    @endif
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
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
