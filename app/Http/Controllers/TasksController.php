<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Http\Requests\TasksValidationRequest;

class TasksController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Json\Response
     */
    public function index(Request $request, $id)
    {
        $tasks = Tasks::orderBy('name', 'ASC')->with('user')->Paginate(6);

        if($id = "pending"){
            $tasks = Tasks::orderBy('name', 'ASC')->with('user')->where('status', 'Pending');
        }else if($id = "progress"){
            $tasks = Tasks::orderBy('name', 'ASC')->with('user')->where('status', 'Progress');
        }else if($id = "done"){
            $tasks = Tasks::orderBy('name', 'ASC')->with('user')->where('status', 'Done');
        }else{
            $tasks = Tasks::orderBy('name', 'ASC')->with('user');
        }

        if(isset($_GET["search"])){
            $search = $_GET["search"];
            $tasks = $tasks->orwhere('name', 'LIKE', '%'.$search.'%');
        }

        //$tasks = $tasks->Paginate(6);
        $tasks = Tasks::orderBy('name', 'ASC')->with('user')->Paginate(6);

        return response()->json($tasks);
    }

   /**
     * Display a Specific Task.
     *
     *  @return \Illuminate\Json\Response
     */
    public function show(Tasks $tasks)
    {
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Json\Response
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

        return response()->json('Task created successfully.');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Json\Response
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
     * @return \Illuminate\Json\Response
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

        return response()->json('Task Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Json\Response
     */
    public function destroy(Tasks $tasks)
    {
        $tasks->delete();
        return response()->json('Task deleted successfully.');
    }
}
