<?php

namespace App\Http\Controllers\Admin;

use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::all();

        return view('admin.states-index', compact('states'));
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
            'name' => 'required'
        ]);

        if($request->get('is_resolved')){
            State::create(['name' => $request->name, 'is_resolved' => 1]);
        }
        else {
            State::create($request->only('name'));
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\State $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        return view('admin.state-edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\State $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $request->validate([
            'name' => 'required'
        ]);

        if($request->get('is_resolved')) {
            $state->update(['name' => $request->name, 'is_resolved' => 1]);
        }
        else {
            $state->update($request->only('name'));
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\State $state
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(State $state)
    {
        if (State::count() <= 1){
            throw new BadRequestHttpException("The last one state.");
        }

        $state->delete();

        return redirect()->back();
    }
}
