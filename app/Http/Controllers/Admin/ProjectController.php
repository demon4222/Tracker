<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectUser;

class ProjectController extends Controller
{
    private $perpage = 20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate($this->perpage);
        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.project.create');
    }

    public function removeUserFromProject(Project $project, User $user)
    {
        ProjectUser::where(['project_id'=>$project->id, 'user_id'=>$user->id])->delete(); //???
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required|min:10'
        ]);
        $project = Project::create($request->all());
        $project->projectUser()->create(['project_id'=>$project->id, 'user_id'=>Auth()->user()->id, 'role'=>User::ROLE_PROJECT_ADMIN]);
        return redirect()->action('Admin\ProjectController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required|min:10'
        ]);
        $project->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return void
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->back();
    }
}
