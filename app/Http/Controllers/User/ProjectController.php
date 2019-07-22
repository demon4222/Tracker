<?php

namespace App\Http\Controllers\User;

use App\Models\Project;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Auth()->user()->projects()->paginate();

        return view('project.index', compact('projects'));
    }

    public function removeUserFromProject(Project $project, $userId)
    {
        $this->authorize('removeUser', $project);

        if (!$project->projectUser()->whereUserId($userId)->first()->user->is_admin) {
            $project->projectUser()->whereUserId($userId)->delete();
        }

        return redirect()->action('User\ProjectController@members', compact('project'));
    }

    public function addUser(Project $project, $userId)
    {
        $this->authorize('addUser', $project);

        $project->projectUser()->firstOrCreate(['project_id' => $project->id, 'user_id' => $userId, 'role' => User::ROLE_DEVELOPER]);

        return redirect()->action('User\ProjectController@members', compact('project'));
    }

    public function changeUserRole(Request $request, Project $project, $userId)
    {
        $this->authorize('changeUserRole', $project);

        $request->validate([
            'role' => 'required'
        ]);

        $project->projectUser()->whereUserId($userId)->update(['role' => $request->role]);
    }

    public function show(Project $project)
    {
        return view('project.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('project.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required|min:10'
        ]);

        $project->update($request->all());

        return redirect()->back();
    }

    public function members(Project $project)
    {
        return view('project.members', compact('project'));
    }
}
