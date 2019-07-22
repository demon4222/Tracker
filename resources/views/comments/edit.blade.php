<form action="{{action('User\CommentController@update', $comment)}}" method="POST">
    @csrf
    @method('PUT')
    <textarea class="form-control" name="text" row="3">{{$comment->text}}</textarea>
    <button id="save-comment" type="submit" class="btn btn-primary btn-sm mt-1">@lang('actions.save')</button>
</form>
