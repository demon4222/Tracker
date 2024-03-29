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
            <div class="new-state-block" style="display: none">
                <form action="{{action('Admin\StateController@store')}}" method="POST" class="add-state-form">
                    @csrf
                    <div class="form-group">
                        @component('components.input',[
                            'labelName' => 'Name',
                            'name' => 'name',
                            'type' => 'text'
                        ])
                        @endcomponent
                        <p><input type="checkbox" name="is_resolved">is resolved</p>
                        <button type="submit" class="btn btn-primary btn-sm mt-2">@lang('actions.add')</button>
                    </div>
                </form>
            </div>
            <ul class="list-group">
                @foreach($states as $state)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="state-name">
                            <a href="#">{{$state->name}}</a>
                        </div>
                        <div class="actions">
                            <a href="{{action('Admin\StateController@edit', $state)}}"
                               class="badge badge-primary badge-pill state-edit-btn">@lang('actions.edit')</a>
                            <form action="{{action('Admin\StateController@destroy', $state)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    {{$states->count() == 1 ? 'disabled title=Last' : ''}} class="badge badge-danger badge-pill">@lang('actions.delete')</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
