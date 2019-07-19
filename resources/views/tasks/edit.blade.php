@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>@lang('tasks.new')</h4>
        </div>

        <div class="card-body">
            <form action="{{action('User\TaskController@update', [$task->project, $task])}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    @component('components.input',[
                        'labelName' => __('tasks.name'),
                        'name' => 'name',
                        'type' => 'text',
                        'value' => $task->name
                    ])
                    @endcomponent
                </div>
                <div class="form-group">
                    <label>@lang('tasks.type')</label>
                    <select name="type_id" class="form-control">
                        @foreach($types as $type)
                            <option {{$task->type_id == $type->id ? 'selected' : ''}} value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>@lang('tasks.state')</label>
                    <select name="state_id" class="form-control">
                        @foreach($states as $state)
                            <option {{$task->state_id == $state->id ? 'selected' : ''}} value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>@lang('tasks.priority')</label>
                    <select name="priority_id" class="form-control">
                        @foreach($priorities as $priority)
                            <option {{$task->priority_id == $priority->id ? 'selected' : ''}} value="{{$priority->id}}">{{$priority->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    @component('components.input',[
                        'labelName' => __('tasks.est'),
                        'name' => 'estimation',
                        'type' => 'number',
                        'value' => $task->estimation
                    ])
                    @endcomponent
                </div>
                <div class="form-group">
                    @component('components.input',[
                        'labelName' => __('tasks.time'),
                        'name' => 'spent_time',
                        'type' => 'number',
                        'value' => $task->spent_time
                    ])
                    @endcomponent
                </div>
                <div class="form-group">
                    @component('components.textarea',[
                        'labelName' => __('tasks.desc'),
                        'name' => 'description',
                        'value' => $task->description
                    ])
                    @endcomponent
                </div>
                <div class="form-group">
                    <label>@lang('project.members')</label>
                    <select name="assigned_to_id" class="form-control">
                        @foreach(\App\User::all() as $user)
                            <option {{$task->assigned_to_id == $user->id ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success">@lang('actions.edit')</button>
            </form>
        </div>
    </div>

@endsection
