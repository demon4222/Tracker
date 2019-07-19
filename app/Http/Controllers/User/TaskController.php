<?php

namespace App\Http\Controllers\User;

use App\Models\Priority;
use App\Models\Project;
use App\Models\State;
use App\Models\Task;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project = null)
    {
        $tasks = isset($project) ? $project->tasks()->paginate() : Task::paginate();

        return view('tasks.index', compact('tasks', 'project'));
    }

    public function search(Project $project, $search)
    {
        $project->tasks()->where('name', 'like', "%$search%");

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $types = Type::all();
        $states = State::all();
        $priorities = Priority::all();

        return view('tasks.create', compact('project', 'types', 'states', 'priorities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required|min:10',
            'type_id' => 'required|exists:types,id',
            'state_id' => 'required|exists:states,id',
            'priority_id' => 'required|exists:priorities,id',
            'assigned_to_id' => 'required|exists:users,id',
            'estimation' => 'required|min:1',
            'spent_time' => 'required|min:1',
        ]);
        $values = $request->all();
        $values['project_id'] = $project->id;
        $values['creator_id'] = Auth()->user()->id;

        $project->tasks()->create($values);

        return redirect()->action('User\ProjectController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Task $task)
    {
        $types = Type::all();
        $states = State::all();
        $priorities = Priority::all();

        return view('tasks.edit', compact('task', 'types', 'states', 'priorities', 'project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required|min:10',
            'type_id' => 'required|exists:types,id',
            'state_id' => 'required|exists:states,id',
            'priority_id' => 'required|exists:priorities,id',
            'assigned_to_id' => 'required|exists:users,id',
            'estimation' => 'required|min:1',
            'spent_time' => 'required|min:1',
        ]);
        $values = $request->all();

        $task->update($values);

        return redirect()->action('User\TaskController@index', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return redirect()->back();
    }
}
