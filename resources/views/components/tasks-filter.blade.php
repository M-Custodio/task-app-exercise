<form action="{{ route('tasks') }}" method="get" class="flex flex-wrap space-x-2">
  <select name="status" id="status" class="bg-transparent border-transparent text-right">
    <option value="">All</option>
    <option value="in-progress" {{ request('status') === 'in-progress' ? 'selected' : '' }}>In Progress</option>
    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
  </select>
  <x-primary-button class="ml-2">Filter</x-primary-button>
</form>
