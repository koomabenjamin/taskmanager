<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Http\Requests\ProjectsValidationRequest;

class ProjectsController extends Controller
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
        $projects = Projects::orderBy('name', 'ASC')->with('user')->Paginate(6);

        if(isset($_GET["search"])){
            $search = $_GET["search"];
            $projects = Projects::orderBy('name', 'ASC')->with('user')->where('name', 'LIKE', '%'.$search.'%')->Paginate(6);
        }

        return view('/projects/index', ['projects' => $projects]);
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
            'added_by' => auth()->user()->id
        ]);

        return redirect('/projects')->with('success', 'Project created successfully.');
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

        return redirect('/projects')->with('success', 'Project Updated successfully.');
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
        return redirect('/projects')->with('success', 'Project deleted successfully.');
    }
}
