@extends('layouts.app')

@push('scripts')
    <script src="{{asset('js/admin-states-index.js')}}"></script>
@endpush

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>@lang('admin.states')</h4>
        </div>

        <div class="card-body">
            <a href="#" class="btn btn-success mb-3 add-state-btn">@lang('actions.create')</a>
            <div class="new-state-block" hidden>
                <form action="{{action('Admin\AdminController@typeStore')}}" method="POST" class="add-state-form">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control">
                        <button type="submit" class="btn btn-primary btn-sm mt-2">@lang('actions.add')</button>
                        <a href="#" class="btn btn-danger btn-sm ml-4 mt-2 hide-btn">@lang('actions.hide')</a>
                    </div>
                </form>
            </div>
            <ul class="list-group">
                @foreach($types as $type)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="state-name">
                            <a href="#">{{$type->name}}</a>
                        </div>
                        <div class="actions">
                            <a href="{{action('Admin\AdminController@typeEdit', $type)}}"
                               class="badge badge-primary badge-pill state-edit-btn">@lang('actions.edit')</a>
                            <form action="{{action('Admin\AdminController@typeDestroy', $type)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="badge badge-danger badge-pill">@lang('actions.del')</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
