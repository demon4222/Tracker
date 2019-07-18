<div class="card">
    <div class="card-header">
        <h5>Users</h5>
        <div class="close-block text-right">
            <button class="text-danger btn-sm btn close-btn">close</button>
        </div>
    </div>
    <div class="card-body">
        <ul>
            @foreach(App\User::all() as $user)
                @if($project->isUserNotInProject($user->id))
                    <form action="{{action('Admin\ProjectController@addUserToProject', [$project, $user->id])}}"
                          method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success" style="position: relative; left: 80%; ">
                            Add
                        </button>
                        <li>
                            <p>{{$user->email}}<br/>
                                <input type="radio" name="role" value="{{App\User::ROLE_PROJECT_ADMIN}}">
                                Project Admin
                                <input type="radio" name="role" value="{{App\User::ROLE_DEVELOPER}}">
                                Developer
                            </p>
                        </li>
                    </form>
                @endif
            @endforeach
        </ul>
    </div>
</div>
