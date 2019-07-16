@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>{{$project->name}}</h4>
        </div>
        <div class="card-body">
            <form action="{{action('Admin\ProjectController@update', $project)}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label>Название проекта</label>
                    <input name="name" value="{{$project->name}}" type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label>Описание</label>
                    <textarea name="description" class="form-control" rows="6">{{$project->description}}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Обновить</button>
            </form>
        </div>
    </div>
@endsection
