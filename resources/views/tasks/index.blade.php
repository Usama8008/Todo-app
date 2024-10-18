<x-app-layout>
    <div class="container mx-auto py-10">
        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
            <!-- Add Task Section -->
            <div class="bg-white shadow-lg rounded-lg p-6 col-span-1 md:col-span-2">
                <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Add Task</h1>

                <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <!-- Task Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Task Description</label>
                        <textarea name="description" id="description" placeholder="Enter your task description" rows="4" class="block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md p-3 shadow-sm" required></textarea>
                    </div>

                    <!-- Due Date -->
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                        <input type="date" name="due_date" id="due_date" class="block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md p-3 shadow-sm">
                    </div>

                    <!-- Add Task Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-md shadow hover:bg-blue-600 transition">
                            Add Task
                        </button>
                    </div>
                </form>
            </div>

            <!-- Task Table Section -->
            <div class="bg-white shadow-lg rounded-lg p-6 col-span-1 md:col-span-4">
                <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Your Tasks</h1>

                <!-- Filter Buttons -->
                <div class="mb-6 flex justify-center space-x-3">
                    <a href="{{ route('tasks.index', ['filter' => 'all']) }}" class="bg-gray-200 text-gray-800 py-2 px-4 rounded-md shadow hover:bg-gray-300 transition">
                        All Tasks
                    </a>
                    <a href="{{ route('tasks.index', ['filter' => 'pending']) }}" class="bg-yellow-200 text-yellow-800 py-2 px-4 rounded-md shadow hover:bg-yellow-300 transition">
                        Pending Tasks
                    </a>
                    <a href="{{ route('tasks.index', ['filter' => 'completed']) }}" class="bg-green-200 text-green-800 py-2 px-4 rounded-md shadow hover:bg-green-300 transition">
                        Completed Tasks
                    </a>
                </div>

                <!-- Task Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg shadow-lg">
                        <thead class="bg-gray-200 text-gray-800">
                            <tr>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-1/2">Task Description</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-1/6 text-right">Due Date</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-1/6 text-right">Status</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-1/6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($tasks as $task)
                            <tr class="hover:bg-gray-100 transition">
                                <td class="py-3 px-4">
                                    <span class="{{ $task->is_completed ? 'line-through text-gray-400' : '' }}">
                                        {{ \Str::limit($task->description, 50) }}
                                    </span>
                                    <button type="button" data-description="{{ $task->description }}" class="view-button text-blue-500 hover:underline ml-2">
                                        Read more
                                    </button>
                                </td>
                                <td class="py-3 px-4 text-right">{{ $task->due_date ?? 'No due date' }}</td>
                                <td class="py-3 px-4 text-right">
                                    <span id="status-{{ $task->id }}" class="{{ $task->is_completed ? 'text-green-600' : 'text-yellow-600' }}">
                                        {{ $task->is_completed ? 'Completed' : 'Pending' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right flex space-x-2 justify-end">
                                    @if(!$task->is_completed)
                                    <button type="button" class="bg-green-500 text-white py-1 px-3 rounded-md shadow hover:bg-green-600 transition mark-complete" data-id="{{ $task->id }}">
                                        Mark Complete
                                    </button>
                                    @endif
                                    <a href="{{ route('tasks.edit', $task) }}" class="text-yellow-500 hover:text-yellow-600 transition flex items-center">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600 transition flex items-center">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $tasks->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for viewing full description -->
    <div id="descriptionModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-6 w-1/2 shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Task Description</h2>
            <p id="fullDescription" class="text-gray-700"></p>
            <button id="closeModal" class="bg-blue-500 text-white py-2 px-4 rounded-md shadow hover:bg-blue-600 transition mt-4">Close</button>
        </div>
    </div>
</x-app-layout>

<!-- JavaScript for AJAX (Fetch API) and Modal handling -->
<script>
    // Modal handling for viewing task description
    document.querySelectorAll('.view-button').forEach(button => {
        button.addEventListener('click', function() {
            const description = this.getAttribute('data-description');
            document.getElementById('fullDescription').textContent = description;
            document.getElementById('descriptionModal').classList.remove('hidden');
        });
    });

    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('descriptionModal').classList.add('hidden');
    });

    // AJAX to handle Mark Complete
    document.querySelectorAll('.mark-complete').forEach(button => {
        button.addEventListener('click', function() {
            const taskId = this.getAttribute('data-id');

            fetch(`/tasks/${taskId}/complete`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update task status in the UI
                    document.getElementById(`status-${taskId}`).innerHTML = 'Completed';
                    document.getElementById(`status-${taskId}`).classList.remove('text-yellow-600');
                    document.getElementById(`status-${taskId}`).classList.add('text-green-600');
                    // Remove the "Mark Complete" button
                    document.querySelector(`button[data-id="${taskId}"]`).remove();
                }
            });
        });
    });
</script>
