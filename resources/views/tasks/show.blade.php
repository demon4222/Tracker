@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/tasks/show.css')}}">
@endpush

@push('scripts')
    <script src="{{asset('js/task-show.js')}}"></script>
@endpush

@section('content')

    <div class="card">
        <input id="task_id" type="hidden" value="{{$task->id}}">
        <div class="card-header text-center">
            <h4>{{$task->name}}</h4>
        </div>

        <div class="card-body">
            <div class="row justify-content-between p-2">
                <div class="col-7 desc p-3">
                    <h5 class="pl-2"><u>{{$task->name}}</u></h5>

                    <div class="description mt-4 p-2">
                        <p>{{$task->description}}</p>
                    </div>
                    <div class="add">
                        <label>Estimation: {{$task->estimation}}</label>
                        <label>Spent time: {{$task->spent_time}}</label>
                    </div>
                    @can('update', $task)
                        <div class="actions m-1">
                            <a href="{{action('User\TaskController@edit', [$project, $task])}}"
                               class="btn btn-primary">@lang('actions.edit')</a>
                        </div>
                    @endcan
                </div>

                <div class="col-4 options p-2">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('tasks.type')
                            @component('components.select',[
                                'name' => 'type_id',
                                'id' => 'type_select',
                                'options' => $types,
                                'value' => $task->type->id
                            ])
                            @endcomponent
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('tasks.state')
                            <span class="badge badge-primary badge-pill">{{$task->state->name}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('tasks.priority')
                            @component('components.select',[
                                'name' => 'priority_id',
                                'id' => 'priority_select',
                                'options' => $priorities,
                                'value' => $task->priority->id
                            ])
                            @endcomponent
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('tasks.assigned')
                            @component('components.select',[
                                'name' => 'assigned_to_id',
                                'id' => 'assigned_select',
                                'options' => $project->users,
                                'value' => $task->assigned->id
                            ])
                            @endcomponent
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('tasks.creator')
                            <p class="mt-3">{{$task->creator->name}}</p>
                        </li>
                    </ul>
                </div>
            </div>
            @can('delete', $task)
                <div class="mt-2">
                    <form action="{{action('User\TaskController@destroy', [$task->project, $task])}}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-sm btn-danger">@lang('actions.del')</button>
                    </form>
                </div>
            @endcan
        </div>
    </div>

@endsection
