<x-app-layout>
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md">
            <h1 class="text-3xl font-bold mb-3 text-gray-800 text-center">Edit Task</h1>

            <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Task Description</label>
                    <textarea name="description" id="description" rows="5" class="block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md shadow-sm p-3" required>{{ $task->description }}</textarea>
                </div>
                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                    <input type="date" name="due_date" id="due_date" value="{{ $task->due_date }}" class="block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md shadow-sm p-3">
                </div>
                <div class="flex justify-between">
                    <button type="submit" class="flex items-center bg-blue-500 text-white py-2 px-4 rounded-md shadow hover:bg-blue-600 transition">
                        <i class="fas fa-save mr-2"></i> Update Task
                    </button>
                    <a href="{{route('tasks.index')}}" class="flex items-center bg-black text-white py-2 px-4 rounded-md shadow hover:bg-gray-900 transition">
                        <i class="fas fa-save mr-2"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
