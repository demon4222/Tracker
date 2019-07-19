@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/project/show.css')}}">
@endpush

@section('content')

    <div class="card">
        <div class="card-header text-center">
            <h4>{{$project->name}}</h4>
        </div>
        <div class="card-body">
            <div class="menu my-3">
                <div class="row justify-content-between">
                    <div class="col-4">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{action('User\TaskController@index', $project)}}">@lang('project.issues')</a>
                                <span class="badge badge-primary badge-pill">{{$project->tasks->count()}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{action('User\ProjectController@members', $project)}}">@lang('project.members')</a>
                                <span
                                    class="badge badge-primary badge-pill">{{$project->projectUser->count()}}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-2 actions text-right">
                        @if(Auth()->user()->is_admin)
                            <form class="mb-2" action="{{action('Admin\ProjectController@destroy', $project)}}"
                                  method="POST">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="@lang('actions.del')">
                            </form>
                        @endif
                        @can('update', $project)
                            <a href="{{action('User\ProjectController@edit', $project)}}"
                               class="btn btn-primary my-2">@lang('actions.edit')</a>
                        @endcan
                        <a href="{{action('User\TaskController@create', $project)}}" class="btn btn-success mt-2">@lang('tasks.new')</a>
                    </div>
                </div>
            </div>
            <div class="description-block">
                <h5>@lang('project.desc')</h5>
                <div class="desc-text">
                    <p>{{$project->description}}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
