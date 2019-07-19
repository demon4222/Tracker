@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>@lang('actions.edit')</h4>
        </div>

        <div class="card-body">
            <form action="{{action('Admin\PriorityController@update', $priority)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input class="form-control" value="{{$priority->name}}" name="name">
                    <input class="form-control mt-1" value="{{$priority->weight}}" name="weight">
                </div>
                <button type="submit" class="my-2 btn btn-success">@lang('actions.edit')</button>
            </form>
        </div>
    </div>

@endsection
