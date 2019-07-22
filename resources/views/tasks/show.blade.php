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
                            @can('changeType', $task)
                                @component('components.select',[
                                    'name' => 'type_id',
                                    'id' => 'type_select',
                                    'options' => $types,
                                    'value' => $task->type->id
                                ])
                                @endcomponent
                            @else
                                <p>{{$task->type->name}}</p>
                            @endcan
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('tasks.state')
                            @can('changeState', $task)
                                @component('components.select',[
                                    'name' => 'state_id',
                                    'id' => 'state_select',
                                    'options' => $states,
                                    'value' => $task->state->id
                                ])
                                @endcomponent
                            @else
                                <p>{{$task->state->name}}</p>
                            @endcan
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('tasks.priority')
                            @can('changePriority', $task)
                                @component('components.select',[
                                    'name' => 'priority_id',
                                    'id' => 'priority_select',
                                    'options' => $priorities,
                                    'value' => $task->priority->id
                                ])
                                @endcomponent
                            @else
                                <p>{{$task->priority->name}}</p>
                            @endcan
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('tasks.assigned')
                            @can('changeAssigned', $task)
                                @component('components.select',[
                                    'name' => 'assigned_to_id',
                                    'id' => 'assigned_select',
                                    'options' => $project->users,
                                    'value' => $task->assigned->id
                                ])
                                @endcomponent
                            @else
                                <p>{{$task->assigned->name}}</p>
                            @endcan
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('tasks.creator')
                            <p class="mt-3">{{$task->creator->name}}</p>
                        </li>
                    </ul>
                </div>

                <div class="col-7 desc p-3 mt-3">
                    <h5 class="pl-2"><u>@lang('tasks.comments')</u></h5>
                    <div class="all-comments">
                        @foreach($task->comments as $comment)
                            <div class="description comment mt-2 p-2">
                                <input type="hidden" id="comment-id" value="{{$comment->id}}">
                                <div class="comment-text">
                                    <p id="comment-text">{{$comment->text}}</p>
                                </div>
                                <div class="author text-right">
                                    <p class="mb-0 font-italic">{{$comment->user->name}}</p>
                                </div>
                                @can('delete', $comment)
                                    <div class="comment-actions">
                                        <form id="del-comment-form"
                                              action="{{action('User\CommentController@destroy', $comment)}}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button id="del-comment" type="submit"
                                                    class="btn btn-danger btn-sm"> @lang('actions.del')</button>
                                        </form>
                                        @can('update', $comment)
                                            <button id="edit-comment"
                                                    class="btn btn-primary btn-sm"> @lang('actions.edit')</button>
                                        @endcan
                                    </div>
                                @endcan
                            </div>
                        @endforeach
                    </div>
                    <div class="add-comment-field mt-2" style="display: none">
                        <form id="add-comment-form" action="{{action('User\CommentController@store', $task)}}"
                              method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" row="3" name="text"
                                          placeholder="Your comment"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">@lang('actions.add')</button>
                        </form>
                    </div>

                    <div class="text-right mt-2">
                        @can('create', [\App\Models\Comment::class, $task])
                            <input type="button" id="add-comment" class="btn btn-sm btn-success" value="Comment">
                        @endcan
                    </div>
                </div>
            </div>
            @can('delete', $task)
                <div class="mt-2 text-right">
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
