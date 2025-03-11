<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-black-800 leading-tight">
      Create Task
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <form action="{{ route('tasks.store') }}" method="post">
            @csrf
            @if ($errors->any())
              <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <div class="mb-4">
              <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Title/Name</label>
              <input type="text" name="name" id="name"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                value="{{ old('name') }}">
            </div>
            <div class="mb-4">
              <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
              <textarea name="description" id="description"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description') }}</textarea>
            </div>
            <div class="mb-4">
              <label for="due_date" class="block text-gray-700 text-sm font-bold mb-2">Due Date</label>
              <input type="date" name="due_date" id="due_date"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                value="{{ old('due_date') }}">
              <div class="mt-2">
                <input type="checkbox" id="no_due_date" name="no_due_date" value="1"
                  {{ old('no_due_date') ? 'checked' : '' }}>
                <label for="no_due_date" class="text-gray-700 text-sm">No due date</label>
              </div>
            </div>
            <div class="mb-4">
              <button type="submit"
                class="bg-primary hover:bg-accent text-white font-semibold py-2 px-4 rounded shadow">Create
                Task</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
