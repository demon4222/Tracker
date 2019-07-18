@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/project/members.css')}}">
@endpush

@push('scripts')
    <script src="{{asset('js/project-members.js')}}"></script>
@endpush

@section('content')
    <input type="hidden" value="{{$project->id}}" id="project">
    <div class="card">
        <div class="card-header text-center">
            <h4>Members</h4>
        </div>
        <div class="card-body">
            @can('addUser', $project)
                <select class="custom-select add-new-member mb-3">
                    <option value="0" selected>@lang('project.add_member')</option>
                    @foreach(\App\User::all() as $user)
                        @if(!$project->isUserInProject($user->id))
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endif
                    @endforeach
                </select>
            @endcan
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">@lang('project.member')</th>
                    <th scope="col">@lang('project.issues')</th>
                    <th scope="col">@lang('project.role')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($project->users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>4</td>
                        <td class="role">
                            @can('changeUserRole', $project)
                            <div>
                                <input type="hidden" value="{{$user->id}}" id="user">
                                <select class="custom-select role-select">
                                    <option
                                        value="{{App\User::ROLE_PROJECT_ADMIN}}" {{$user->projectUser->role == App\User::ROLE_PROJECT_ADMIN ? 'selected' : ''}}>
                                        @lang('project.role_admin')
                                    </option>
                                    <option
                                        value="{{App\User::ROLE_DEVELOPER}}" {{$user->projectUser->role == App\User::ROLE_DEVELOPER ? 'selected' : ''}}>
                                        @lang('project.role_dev')
                                    </option>
                                </select>
                            </div>
                                @else
                                <label>{{$user->projectUser->role == App\User::ROLE_PROJECT_ADMIN ? __('project.role_admin') : __('project.role_dev')}}</label>
                            @endcan
                            @can('removeUser', $project)
                                <form
                                    action="{{action('User\ProjectController@removeUserFromProject', [$project, $user->id])}}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="remove-btn">
                                        <button type="submit"
                                                class="btn btn-sm btn-danger">@lang('actions.del')</button>
                                    </div>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>

@endsection
