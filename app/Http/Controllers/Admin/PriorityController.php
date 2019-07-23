<?php

namespace App\Http\Controllers\Admin;

use App\Models\Priority;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priorities = Priority::all();

        return view('admin.priority-index', compact('priorities'));
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
            'name' => 'required',
            'weight' => 'required'
        ]);

        Priority::create($request->only('name', 'weight'));

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Priority  $priority
     * @return \Illuminate\Http\Response
     */
    public function edit(Priority $priority)
    {
        return view('admin.priority-edit', compact('priority'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Priority  $priority
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Priority $priority)
    {
        $request->validate([
            'name' => 'required',
            'weight'=> 'required'
        ]);

        $priority->update($request->only('name', 'weight'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Priority $priority
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Priority $priority)
    {
        if (Priority::count() <= 1){
            throw new BadRequestHttpException("The last one priority");
        }

        $priority->delete();

        $minPriorityId = Priority::orderBy('weight')->firstOrFail()->id;

        Task::where('priority_id', $priority->id)->update(['priority_id' => $minPriorityId]);

        return redirect()->back();
    }
}
