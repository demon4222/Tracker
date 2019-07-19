@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header"></div>

        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-4">
                    <ul class="list-group">
                        <a href="{{action('Admin\ProjectController@index')}}" class="list-group-item list-group-item-secondary">@lang('admin.projects')</a>
                        <a href="{{action('Admin\StateController@index')}}" class="list-group-item list-group-item-secondary">@lang('admin.states')</a>
                        <a href="{{action('Admin\PriorityController@index')}}" class="list-group-item list-group-item-secondary">@lang('admin.priority')</a>
                        <a href="{{action('Admin\TypeController@index')}}" class="list-group-item list-group-item-secondary">@lang('admin.types')</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
