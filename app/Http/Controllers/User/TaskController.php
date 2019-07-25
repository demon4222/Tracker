<?php

namespace App\Http\Controllers\User;

use App\Events\TaskAssignedChanged;
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
     * @param Project $project
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project = null)
    {
        $tasks = isset($project) ? $project->tasks()->paginate() : Task::paginate();

        return view('tasks.index', compact('tasks', 'project'));
    }

    public function search(Request $request, Project $project = null)
    {
        $query = Task::query();

        if($project) {
            $query->whereProjectId($project->id);
        }

        if($search = $request->get('search')) {
            $query->where('name', 'like', "%{$search}%");
        }
        dd($query->paginate());

        return view('tasks.index', compact('tasks', 'project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Project $project)
    {
        $this->authorize('create', [Task::class, $project]);

        $types = Type::all();
        $states = State::all();
        $priorities = Priority::all();

        return view('tasks.create', compact('project', 'types', 'states', 'priorities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Project $project
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Project $project)
    {
        $this->authorize('create', [Task::class, $project]);

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
     * @param Project $project
     * @param Task $task
     * @return Response
     */
    public function show(Project $project, Task $task)
    {
        $types = Type::all();
        $states = State::all();
        $priorities = Priority::all();

        return view('tasks.show', compact('task', 'project', 'types', 'states', 'priorities'));
    }

    public function edit(Project $project, Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task', 'project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Project $project
     * @param Task $task
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required|min:10',
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
     * @param Project $project
     * @param Task $task
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Project $project, Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->action('User\TaskController@index', $project);
    }

    public function changeType(Request $request, Task $task)
    {
        $this->authorize('changeType', $task);

        $task->update($request->only('type_id'));
    }

    public function changeState(Request $request, Task $task)
    {
        $this->authorize('changeState', $task);

        $task->update($request->only('state_id'));
    }

    public function changePriority(Request $request, Task $task)
    {
        $this->authorize('changePriority', $task);

        $task->update($request->only('priority_id'));
    }

    /**
     * @param Request $request
     * @param Task $task
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function changeAssigned(Request $request, Task $task)
    {
        $this->authorize('changeAssigned', $task);

        $task->update($request->only('assigned_to_id'));

        event(new TaskAssignedChanged($task));
    }
}
