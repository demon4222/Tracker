<?php

namespace App\Http\Controllers\Admin;

use App\Models\Priority;
use App\Models\State;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function states()
    {
        $states = State::all();

        return view('admin.states-index', compact('states'));
    }

    public function stateStore(Request $request)
    {
        $request->validate([
           'name' => 'required'
        ]);

        State::create($request->only('name'));

        return redirect()->back();
    }

    public function stateEdit(State $state)
    {
        return view('admin.state-edit', compact('state'));
    }

    public function stateUpdate(Request $request, State $state)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $state->update($request->only('name'));

        return redirect()->back();
    }

    public function stateDestroy(State $state)
    {
        $state->delete();

        return redirect()->back();
    }

    public function priorities()
    {
        $priorities = Priority::all();

        return view('admin.priority-index', compact('priorities'));
    }

    public function priorityStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'weight' => 'required'
        ]);

        Priority::create($request->only('name', 'weight'));

        return redirect()->back();
    }

    public function priorityEdit(Priority $priority)
    {
        return view('admin.priority-edit', compact('priority'));
    }

    public function priorityUpdate(Request $request, Priority $priority)
    {
        $request->validate([
            'name' => 'required',
            'weight'=> 'required'
        ]);

        $priority->update($request->only('name', 'weight'));

        return redirect()->back();
    }

    public function priorityDestroy(Priority $priority)
    {
        $priority->delete();

        return redirect()->back();
    }

    public function types()
    {
        $types = Type::all();

        return view('admin.type-index', compact('types'));
    }

    public function typeStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Type::create($request->only('name'));

        return redirect()->back();
    }

    public function typeEdit(Type $type)
    {
        return view('admin.type-edit', compact('type'));
    }

    public function typeUpdate(Request $request, Type $type)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $type->update($request->only('name'));

        return redirect()->back();
    }

    public function typeDestroy(Type $type)
    {
        $type->delete();

        return redirect()->back();
    }
}
