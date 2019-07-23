<?php

namespace App\Http\Controllers\Admin;

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

        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Project::class, Auth()->user());

        return view('project.create');
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
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return void
     * @throws \Exception
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->action('Admin\ProjectController@index');
    }
}
