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
            @can('addUser', $project, Auth()->user())
                <select class="custom-select add-new-member mb-3">
                    <option value="0" selected>Add member</option>
                    @foreach(\App\User::all() as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            @endcan
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Issues</th>
                    <th scope="col">Role</th>
                </tr>
                </thead>
                <tbody>
                @foreach($project->users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>4</td>
                        <td class="role">
                            <div>
                                <input type="hidden" value="{{$user->id}}" id="user">
                                <select class="custom-select role-select">
                                    <option
                                        value="{{App\User::ROLE_PROJECT_ADMIN}}" {{$user->projectUser->role == App\User::ROLE_PROJECT_ADMIN ? 'selected' : ''}}>
                                        Project Admin
                                    </option>
                                    <option
                                        value="{{App\User::ROLE_DEVELOPER}}" {{$user->projectUser->role == App\User::ROLE_DEVELOPER ? 'selected' : ''}}>
                                        Developer
                                    </option>
                                </select>
                                {{--                                {{$user->projectUser->role == App\User::ROLE_PROJECT_ADMIN ? 'Project admin' : 'Developer' }}--}}
                            </div>
                            @can('removeUser', $project, Auth()->user())
                                <form
                                    action="{{action('Admin\ProjectController@removeUserFromProject', [$project, $user->id])}}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="remove-btn">
                                        <button type="submit" class="btn btn-sm btn-danger">remove from project</button>
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
