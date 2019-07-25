@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/tasks/index.css')}}">
@endpush

@section('content')

    @if(!$tasks->isEmpty())
        <div class="card">
            <div class="card-header">
                <h4>{{$tasks->first()->project->name}}</h4>
            </div>

            <div class="card-body">
                <div class="search mb-4 p-2">
                    <form action="{{action('User\TaskController@search', $project)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            @component('components.input', [
                                'labelName' => 'Search',
                                'name' => 'search',
                                'type' => 'text',
                            ])
                            @endcomponent
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('actions.search')</button>
                    </form>
                </div>

                <div class="task-list">
                    @foreach($tasks as $key => $task)
                        <a href="{{action('User\TaskController@show', [$project, $task])}}">
                            <div class="border-card">
                                <div title="{{$task->state->is_resolved ? 'resolved' : 'not resolved'}}"
                                    class="card-type-icon with-border {{$task->state->is_resolved ? 'bg-success' : 'bg-danger'}}">{{$key+1}}
                                </div>
                                <div class="content-wrapper">
                                    <div class="label-group fixed mr-4">
                                        <p class="title">@lang('tasks.name')</p>
                                        <p class="caption">{{$task->name}}</p>
                                    </div>
                                    <div class="label-group fixed">
                                        <p class="title">@lang('tasks.type')</p>
                                        <p class="caption">{{$task->type->name}}</p>
                                    </div>
                                    <div class="min-gap"></div>
                                    <div class="label-group">
                                        <p class="title">@lang('tasks.state')</p>
                                        <p class="caption">{{$task->state->name}}</p>
                                    </div>
                                    <div class="min-gap"></div>
                                    <div class="label-group">
                                        <p class="title">@lang('tasks.priority')</p>
                                        <p class="caption">{{$task->priority->name}}</p>
                                    </div>
                                    <div class="min-gap"></div>
                                    <div class="label-group">
                                        <p class="title">@lang('tasks.assigned')</p>
                                        <p class="caption">{{$task->assigned->name}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="text-center">
                    {{$tasks->links()}}
                </div>
            </div>
        </div>
    @endif

@endsection
