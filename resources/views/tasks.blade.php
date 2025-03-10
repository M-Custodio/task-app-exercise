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
                  <td class="text-center">{{ $task->status }}</td>
                  <td class="flex justify-center space-x-7">
                    <a href="{{ route('tasks.edit', $task->id) }}"
                      class="bg-primary hover:bg-accent text-white font-semibold py-2 px-4 rounded shadow">
                      Edit
                    </a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow">
                        Delete
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
