<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
{
    $id= Auth::id();
    $query = Task::where('user_id',$id); 

    if ($request->has('filter')) {
        if ($request->filter === 'completed') {
            $query->where('is_completed', true);
        } elseif ($request->filter === 'pending') {
            $query->where('is_completed', false);
        }
    }

    // Get the filtered tasks
    $tasks = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('tasks.index', compact('tasks'));
}

    

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|max:255',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'user_id'=>Auth::id(),
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index')->with('success','Task has been added successfully.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'description' => 'required|max:255',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->only('description', 'due_date'));

        return redirect()->route('tasks.index')->with('success','Task has been updated successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success','task deleted successfully');
    }

    public function markComplete(Request $request, Task $task)
    {
        $task->update(['is_completed' => true]);
    
        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Task marked as complete.',
            'task' => $task
        ]);
    }
}
