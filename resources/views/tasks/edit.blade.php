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
                    @component('components.select', [
                        'label' => __('tasks.type'),
                        'name' => 'type_id',
                        'id' => 'select_type',
                        'value' => $task->type->id,
                        'options' => $types,
                    ])
                    @endcomponent
                </div>
                <div class="form-group">
                    @component('components.select', [
                        'label' => __('tasks.state'),
                        'name' => 'state_id',
                        'id' => 'select_state',
                        'value' => $task->state->id,
                        'options' => $priorities,
                    ])
                    @endcomponent
                </div>
                <div class="form-group">
                    @component('components.select', [
                        'label' => __('tasks.priority'),
                        'name' => 'priority_id',
                        'id' => 'select_priority',
                        'value' => $task->priority->id,
                        'options' => $priorities,
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
                <div class="form-group">
                    @component('components.select', [
                        'label' => __('project.members'),
                        'name' => 'assigned_to_id',
                        'id' => 'select_assigned',
                        'value' => $task->assigned->id,
                        'options' => \App\User::all(),
                    ])
                    @endcomponent
                </div>
                <button class="btn btn-success">@lang('actions.edit')</button>
            </form>
        </div>
    </div>

@endsection
