@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>@lang('tasks.new')</h4>
        </div>

        <div class="card-body">
            <form action="{{action('User\TaskController@store', $project)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label>@lang('tasks.name')</label>
                    <input name="name" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>@lang('tasks.type')</label>
                    <select name="type_id" class="form-control">
                        <option>1</option>
                        <option>2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>@lang('tasks.state')</label>
                    <select name="state_id" class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>@lang('tasks.priority')</label>
                    <select name="priority_id" class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>@lang('tasks.est')</label>
                    <input name="estimation" type="number" class="form-control">
                </div>
                <div class="form-group">
                    <label>@lang('tasks.time')</label>
                    <input name="spent_time" type="number" class="form-control">
                </div>
                <div class="form-group">
                    <label>@lang('tasks.desc')</label>
                    <textarea name="description" class="form-control" rows="6"></textarea>
                </div>
                <div class="form-group">
                    <label>@lang('tasks.assigned')</label>
                    <select name="assigned_to_id" class="form-control">
                        @foreach($project->users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success">@lang('actions.create')</button>
            </form>
        </div>
    </div>

@endsection
