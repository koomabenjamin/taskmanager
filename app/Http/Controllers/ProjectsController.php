<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Http\Requests\ProjectsValidationRequest;
use App\Http\Resources\ProjectResource;

class ProjectsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Projects::orderBy('name', 'ASC')->with('user')->Paginate(6);

        if(isset($_GET["search"])){
            $search = $_GET["search"];
            $projects = Projects::orderBy('name', 'ASC')->with('user')->where('name', 'LIKE', '%'.$search.'%')->Paginate(6);
        }

        return response()->json($projects);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectsValidationRequest $request)
    {
        $request->validated();

        $projects = Projects::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'added_by' => 1
        ]);

        return response()->json('Project created successfully.');
    }

    /**
     * Show the form for showing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Projects $project)
    {
        return new ProjectResource($project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Projects $projects)
    {
        return view('projects.edit')->with('projects', $projects);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectsValidationRequest $request, $id)
    {
        $request->validated();

        $projects = Projects::where('id', $id)
        ->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return response()->json('Project Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projects $projects)
    {
        $projects->delete();
        return response()->json('Project deleted successfully.');
    }
}
