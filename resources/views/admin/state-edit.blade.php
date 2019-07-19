@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>@lang('actions.edit')</h4>
    </div>

    <div class="card-body">
        <form action="{{action('Admin\StateController@update', $state)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input class="form-control" value="{{$state->name}}" name="name">
            </div>
            <button type="submit" class="my-2 btn btn-success">@lang('actions.edit')</button>
        </form>
    </div>
</div>

@endsection
