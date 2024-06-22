<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskController extends Controller
{
    public function index()
    {
        try {
            $tasks = Task::with('project', 'user')->get();
            return response()->json(['message' => 'Tasks retrieved successfully', 'data' => $tasks], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve tasks'], 500);
        }
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

        try {
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

            return response()->json(['message' => 'Task created successfully', 'data' => $task], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create task'], 500);
        }
    }

    public function show($id)
    {
        try {
            $task = Task::with('project', 'user')->findOrFail($id);
            return response()->json(['message' => 'Task retrieved successfully', 'data' => $task], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve task'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        // Made all fields optional for PATCH request
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string',
            'description' => 'sometimes|nullable|string|max:25',
            'project_id' => 'sometimes|required|exists:projects,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'priority' => 'sometimes|required|in:High,Medium,Low,Critical,Urgent',
            'category' => 'sometimes|required|in:Technology,Healthcare,Education,Finance,Entertainment,Infrastructure',
            'status' => 'sometimes|required|in:todo,in_progress,done',
            'implementation_date' => 'sometimes|required|date',
        ]);

        try {
            $task = Task::findOrFail($id);
            $task->update($validatedData);
            return response()->json(['message' => 'Task updated successfully', 'data' => $task], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update task'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return response()->json(['message' => 'Task deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete task'], 500);
        }
    }

    public function trashed()
    {
        try {
            $trashedTasks = Task::onlyTrashed()->get();
            if ($trashedTasks->isEmpty()) {
                return response()->json(['error' => 'No trashed tasks found'], 404);
            }
            return response()->json(['message' => 'Trashed tasks retrieved successfully', 'data' => $trashedTasks], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve trashed tasks'], 500);
        }
    }

    public function restore($id) 
    {
        try {
            $task = Task::withTrashed()->findOrFail($id);
            $task->restore();
            return response()->json(['message' => 'Task restored successfully.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to restore task'], 500);
        }
    }

    public function restoreAll()
    {
        try {
            $trashedTasks = Task::onlyTrashed();
            if ($trashedTasks->count() === 0) {
                return response()->json(['error' => 'No tasks to restore'], 404);
            }
            $trashedTasks->restore();
            return response()->json(['message' => 'All tasks restored successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to restore tasks'], 500);
        }
    }

    public function tasksPastImplementationDate()
    {
        try {
            $tasksPastDate = Task::where('implementation_date', '<', now())->get();
            if ($tasksPastDate->isEmpty()) {
                return response()->json(['error' => 'No tasks past implementation date found'], 404);
            }
            return response()->json(['message' => 'Tasks past implementation date retrieved successfully', 'data' => $tasksPastDate], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve tasks past implementation date'], 500);
        }
    }
}
