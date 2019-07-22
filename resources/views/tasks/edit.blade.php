@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>@lang('tasks.edit')</h4>
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
                <button class="btn btn-success">@lang('actions.edit')</button>
            </form>
        </div>
    </div>

@endsection
