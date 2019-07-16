@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Новый проект</h4>
        </div>
        <div class="card-body">
            <form action="{{action('Admin\ProjectController@store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Название проекта</label>
                    <input name="name" type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label>Описание</label>
                    <textarea name="description" class="form-control" rows="6"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Создать</button>
            </form>
        </div>
    </div>
@endsection
