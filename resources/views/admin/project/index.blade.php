@extends('layouts.app')

@section('content')

    <div class="card-header text-center"><h4>Список всех тестов</h4></div>
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
                <th scope="col">@lang('project.created')</th>
                <th scope="col">@lang('actions.act')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>
                        <a>{{$project->name}}</a>
                    </td>
                    <td>
                        <ul>
                            @foreach($project->users as $user)
                                <form
                                    action="{{action('Admin\ProjectController@removeUserFromProject', [$project->id, $user->id])}}"
                                    method="POST">
                                    <li>{{$user->name}}
                                        @if(Auth()->user()->can('removeUser', Auth()->user(), $project))
                                            <button type="submit" class="btn btn-sm btn-danger">-</button>
                                        @endif
                                    </li>
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endforeach
                            @if(Auth()->user()->can('removeUser', Auth()->user(), $project))
                                <button class="btn btn-sm btn-success">+</button>
                            @endif
                        </ul>
                    </td>
                    <td>{{$project->created_at}}</td>
                    <td>
{{--                        @project_admin({{$project}})--}}
{{--                        @endproject_admin--}}
                        @if(Auth()->user()->can('addUser', Auth()->user(), $project))
                            <form class="mb-2" action="{{action('Admin\ProjectController@destroy', $project)}}"
                                  method="POST">
                                @csrf
                                @method('delete')
                                @if(Auth()->user()->is_admin)
                                    <input type="submit" class="btn btn-sm btn-danger" value="@lang('actions.del')">
                                @endif
                            </form>
                        @endif
                        @if(Auth()->user()->can('update', Auth()->user(), $project))
                            <form action="{{action('Admin\ProjectController@edit', $project)}}" method="GET">
                                <input type="submit" class="btn btn-sm btn-primary" value="@lang('actions.edit')">
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$projects->links()}}
@endsection
