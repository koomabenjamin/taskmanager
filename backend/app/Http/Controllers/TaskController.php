<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::with('project', 'user')->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string|max:25',
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'priority' => 'required|in:High,Medium,Low,Critical,Urgent',
            'category' => 'required|in:Technology,Healthcare,Education,Finance,Entertainment,Infrastructure',
            'status' => 'required|in:todo,in_progress,done',
            'implementation_date' => 'required|date',
        ]);

        $task = Task::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'project_id' => $validatedData['project_id'],
            'user_id' => $validatedData['user_id'],
            'priority' => $validatedData['priority'],
            'category' => $validatedData['category'],
            'status' => $validatedData['status'],
            'implementation_date' => $validatedData['implementation_date'],
        ]);

        return response()->json($task, 201);
    }

    public function show(Task $task)
    {
        return $task->load('project', 'user');
    }

    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string|max:25',
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'priority' => 'required|in:High,Medium,Low,Critical,Urgent',
            'category' => 'required|in:Technology,Healthcare,Education,Finance,Entertainment,Infrastructure',
            'status' => 'required|in:todo,in_progress,done',
            'implementation_date' => 'required|date',
        ]);

        $task->update($validatedData);
        return response()->json($task, 200);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }

    // Method to fetch soft-deleted tasks
    public function trashed()
    {
        return Task::onlyTrashed()->get();
    }
}
