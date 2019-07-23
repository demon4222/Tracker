<div class="description comment mt-2 p-2">
    <input type="hidden" id="comment-id" value="{{$comment->id}}">
    <div class="comment-text">
        <p id="comment-text">{{$comment->text}}</p>
    </div>
    <div class="author text-right">
        <p class="mb-0 font-italic">{{$comment->user->name}}</p>
    </div>
    @can('delete', $comment)
        <div class="comment-actions">
            <form id="del-comment-form"
                  action="{{action('User\CommentController@destroy', $comment)}}"
                  method="POST">
                @csrf
                @method('DELETE')
                <button id="del-comment" type="submit"
                        class="btn btn-danger btn-sm"> @lang('actions.delete')</button>
            </form>
            @can('update', $comment)
                <button id="edit-comment"
                        class="btn btn-primary btn-sm"> @lang('actions.edit')</button>
            @endcan
        </div>
    @endcan
</div>
