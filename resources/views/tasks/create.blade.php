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
                    @component('components.input',[
                        'labelName' => __('tasks.name'),
                        'name' => 'name',
                        'type' => 'text',
                        'value' => ''
                    ])
                    @endcomponent
                </div>
                <div class="form-group">
                    @component('components.select', [
                        'label' => __('tasks.type'),
                        'name' => 'type_id',
                        'id' => 'select_type',
                        'options' => $types,
                    ])
                    @endcomponent
                </div>
                <div class="form-group">
                    @component('components.select', [
                        'label' => __('tasks.state'),
                        'name' => 'state_id',
                        'id' => 'select_state',
                        'options' => $states,
                    ])
                    @endcomponent
                </div>
                <div class="form-group">
                    @component('components.select', [
                        'label' => __('tasks.priority'),
                        'name' => 'priority_id',
                        'id' => 'priority_type',
                        'options' => $priorities,
                    ])
                    @endcomponent
                </div>
                <div class="form-group">
                    @component('components.input',[
                        'labelName' => __('tasks.est'),
                        'name' => 'estimation',
                        'type' => 'number',
                        'value' => ''
                    ])
                    @endcomponent
                </div>
                <div class="form-group">
                    @component('components.input',[
                        'labelName' => __('tasks.time'),
                        'name' => 'spent_time',
                        'type' => 'number',
                        'value' => ''
                    ])
                    @endcomponent
                </div>
                <div class="form-group">
                    @component('components.textarea',[
                        'labelName' => __('tasks.desc'),
                        'name' => 'description',
                        'value' => ''
                    ])
                    @endcomponent
                </div>
                <div class="form-group">
                    @component('components.select', [
                        'label' => __('tasks.assigned'),
                        'name' => 'assigned_to_id',
                        'id' => 'select_assigned_to',
                        'options' => $project->users,
                    ])
                    @endcomponent
                </div>
                <button class="btn btn-success">@lang('actions.create')</button>
            </form>
        </div>
    </div>

@endsection
