@extends('layouts.app')

@push('styles')
    <link href="{{asset('css/project/index.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="add-user-block"></div>

    <div class="card-header text-center block"><h4>Projects</h4></div>
    <div class="card-body">
        @if(Auth()->user()->is_admin)
            <a href="{{action('Admin\ProjectController@create')}}"
               class="btn btn-success mb-2">@lang('actions.create') @lang('project.new')</a>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">@lang('project.name')</th>
                <th scope="col">@lang('project.members')</th>
                <th scope="col" class="text-center">Issues</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>
                        <a href="{{action('Admin\ProjectController@show', $project)}}">{{$project->name}}</a>
                    </td>
                    <td>{{$project->users->count()}}</td>
                    <td class="text-center">a</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$projects->links()}}
@endsection
