<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        try {
            $projects = Project::all();
            return response()->json(['message' => 'Projects retrieved successfully', 'data' => $projects], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve projects'], 500);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $project = Project::create([
                'name' => $validatedData['name'],
            ]);

            return response()->json(['message' => 'Project created successfully', 'data' => $project], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create project'], 500);
        }
    }
}
