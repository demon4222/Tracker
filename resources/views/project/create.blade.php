@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>@lang('Новый проект')</h4>
        </div>
        <div class="card-body">
            <form action="{{action('Admin\ProjectController@store')}}" method="POST">
                @csrf
                @component('components.input',[
                    'labelName' => 'Название проекта',
                    'name' => 'name',
                    'type' => 'text'
                ])
                @endcomponent

                @component('components.textarea',[
                    'labelName' => 'Описание',
                    'name' => 'description'
                ])
                @endcomponent
                <button type="submit" class="btn btn-success">@lang('Создать')</button>
            </form>
        </div>
    </div>
@endsection
