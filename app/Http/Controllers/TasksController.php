<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Http\Requests\TasksValidationRequest;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', []);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Tasks::orderBy('name', 'ASC')->with('user')->Paginate(6);

        if(isset($_GET["search"])){
            $search = $_GET["search"];
            $tasks = Tasks::orderBy('name', 'ASC')->with('user')->where('name', 'LIKE', '%'.$search.'%')->Paginate(6);
        }

        return view('/projects/index', ['tasks' => $tasks]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TasksValidationRequest $request)
    {
        $request->validated();

        $tasks = Tasks::create([
            'project_id' => $request->input('project_id'),
            'name' => $request->input('name'),
            'members' => $request->input('members'),
            'tags' => $request->input('tags'),
            'category' => $request->input('category'),
            'priority_level' => $request->input('priority_level'),
            'added_by' => auth()->user()->id
        ]);

        return redirect('/tasks')->with('success', 'Task created successfully.');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $tasks)
    {
        return view('tasks.edit')->with('tasks', $tasks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TasksValidationRequest $request, $id)
    {
        $request->validated();

        $tasks = Tasks::where('id', $id)
        ->update([
            'project_id' => $request->input('project_id'),
            'name' => $request->input('name'),
            'members' => $request->input('members'),
            'tags' => $request->input('tags'),
            'category' => $request->input('category'),
            'priority_level' => $request->input('priority_level')
        ]);

        return redirect('/tasks')->with('success', 'Task Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $tasks)
    {
        $tasks->delete();
        return redirect('/tasks')->with('success', 'Task deleted successfully.');
    }
}