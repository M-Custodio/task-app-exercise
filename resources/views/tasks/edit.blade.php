<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-black-800 leading-tight">
        Edit Task
      </h2>
    </x-slot>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <form action="{{ route('tasks.update', $task->id) }}" method="post">
              @method('PUT')
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
              <x-input-text name="name" :value="old('name', $task->name)">Title/Name</x-input-text>
              <x-input-textarea name="description" :value="old('description', $task->description)">Description</x-input-textarea>
              <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                  <option value="in-progress" {{ old('status') == 'in-progress' || $task->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                  <option value="completed" {{ old('status') == 'completed' || $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
              </div>
              <div class="mb-4">
                <label for="due_date" class="block text-gray-700 text-sm font-bold mb-2">Due Date</label>
                <input type="date" name="due_date" id="due_date"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  value="{{ old('due_date') ?? $task->due_date }}">
              </div>
              <div class="mb-4">
                <input type="checkbox" id="no_due_date" name="no_due_date" value="1"
                  {{ old('no_due_date') ? 'checked' : '' }}>
                <label for="no_due_date" class="text-gray-700 text-sm">No due date</label>
              </div>
              <div class="mb-4">
                <label for="user_ids" class="block text-gray-700 text-sm font-bold mb-2">Assign Users</label>
                <div class="flex flex-wrap">
                  @foreach ($users as $user)
                    @if ($user->id === auth()->id())
                      @continue
                    @endif
                    <div class="mr-4 mb-2">
                      <label class="inline-flex items-center">
                        <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" class="form-checkbox" {{ in_array($user->id, $task->users->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <span class="ml-2">{{ ucfirst($user->name) }}</span>
                      </label>
                    </div>
                  @endforeach
                </div>
              </div>
              <div class="mb-4">
                <x-primary-button>Update Task</x-primary-button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </x-app-layout>
