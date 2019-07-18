<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProjectUser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate();

        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Project::class, Auth()->user());

        return view('admin.project.create');
    }

    public function removeUserFromProject(Project $project, $userId)
    {
        $this->authorize('removeUser', $project, $userId);

        $project->projectUser()->whereUserId($userId)->delete();

        return redirect()->action('Admin\ProjectController@members', compact('project'));
    }

    public function addUser(Project $project, $userId)
    {
        $this->authorize('addUser', $project, $userId);

        $project->projectUser()->firstOrCreate(['project_id' => $project->id, 'user_id' => $userId, 'role' => User::ROLE_DEVELOPER]);

        return redirect()->action('Admin\ProjectController@members', compact('project'));
    }

    public function changeUserRole(Request $request, Project $project, $userId)
    {
        $this->authorize('changeUserRole', $project, $userId);

        $request->validate([
            'role' => 'required'
        ]);

        $project->projectUser()->whereUserId($userId)->update(['role'=> $request->role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required|min:10'
        ]);

        $project = Project::create($request->only(['name', 'description']));
        $project->projectUser()->create(['project_id' => $project->id, 'user_id' => Auth()->user()->id, 'role' => User::ROLE_PROJECT_ADMIN]);

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
        return view('admin.project.show', compact('project'));
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
     * @param \Illuminate\Http\Request $request
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project, Auth()->user());

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

        return redirect()->action('Admin\ProjectController@index');
    }

    public function members(Project $project)
    {
        return view('admin.project.members', compact('project'));
    }
}
