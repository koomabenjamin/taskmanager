<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Priority;

class PriorityController extends Controller
{
    public function index()
    {
        return Priority::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|string|max:255',
        ]);

        return Priority::create($request->all());
    }

    public function show($id)
    {
        return Priority::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $priority = Priority::findOrFail($id);
        $priority->update($request->all());

        return $priority;
    }

    public function destroy($id)
    {
        Priority::destroy($id);
        return response()->noContent();
    }
}
