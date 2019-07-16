@extends('layouts.app')

@section('content')

    <div class="card-header text-center"><h4>Список всех тестов</h4></div>
    <div class="card-body">
        <a href="{{action('Admin\ProjectController@create')}}" class="btn btn-success mb-2">Создать новый проект</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Название</th>
                <th scope="col">Исполнители</th>
                <th scope="col">Создан</th>
                <th scope="col">Действие</th>
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
                                <li>{{$user->name}}</li>
                                <form action="{{action('Admin\ProjectController@removeUserFromProject', [$project, $user])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">-</button>
                                </form>
                            @endforeach
                                <button class="btn btn-sm btn-success">+</button>
                        </ul>
                    </td>
                    <td>{{$project->created_at}}</td>
                    <td>
                        <form class="mb-2" action="{{action('Admin\ProjectController@destroy', $project)}}"
                              method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-sm btn-danger" value="Удалить">
                        </form>
                        <form action="{{action('Admin\ProjectController@edit', $project)}}" method="GET">
                            <input type="submit" class="btn btn-sm btn-primary" value="Редактировать">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$projects->links()}}

@endsection
