import $ from 'jquery'

$(document).ready(function () {
    $('#type_select').on('change', function () {
        let typeId = $(this).val();
        let task = $('#task_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/tasks/' + task + '/changeType/',
            data: {type_id: typeId},
            success: function (data) {
                alert('Successfully changed!');
            }
        });
    })

    $('#priority_select').on('change', function () {
        let priorityId = $(this).val();
        let task = $('#task_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/tasks/' + task + '/changePriority/',
            data: {priority_id: priorityId},
            success: function (data) {
                alert('Successfully changed!');
            }
        });
    })

    $('#state_select').on('change', function () {
        let stateId = $(this).val();
        let task = $('#task_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/tasks/' + task + '/changeState/',
            data: {state_id: stateId},
            success: function (data) {
                alert('Successfully changed!');
            }
        });
    })

    $('#assigned_select').on('change', function () {
        let assignedId = $(this).val();
        let task = $('#task_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/tasks/' + task + '/changeAssigned/',
            data: {assigned_to_id: assignedId},
            success: function (data) {
                alert('Successfully changed!');
            }
        });
    })

    $('#add-comment').on('click', function () {
        $('.add-comment-field').toggle();
    })

    $("#add-comment-form").submit(function (e) {
        var $form = $(this);
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize()
        }).done(function (data) {
            let $newCommBlock = $('<div class="description comment mt-2 p-2">');
            let $newCommText = $('<p>').html(data.text);
            let $newCommAuthorBlock = $('<div class="author text-right">');
            let $newCommAuthorName = $('<p>').html(data.author);
            let $newCommActions = $('<div class="comment-actions">');

            $newCommBlock.append($newCommText);
            $newCommAuthorBlock.append($newCommAuthorName);
            $newCommBlock.append($newCommAuthorBlock);

            let $newForm = $('<form>');
            $newForm.attr('method', 'POST');
            $newForm.attr('action', 'http://127.0.0.1:8000/comments/' + data.comment_id + '/delete');
            let $method = $('<input type="hidden" name="_method" value="DELETE">');
            let token = $('meta[name = "csrf-token"]').attr('content');
            let $csrf = $('<input type="hidden" name="_token" value="' + token + '">');
            let $delBtn = $('<button id="del-comment" type="submit" class="btn btn-danger btn-sm">').html('Delete');

            $newForm.append($delBtn);
            $newForm.prepend($method);
            $newForm.prepend($csrf);

            $newCommActions.append($newForm);
            $newCommBlock.append($newCommActions);

            $('.all-comments').append($newCommBlock);
        });

        $('.add-comment-field').toggle();

        e.preventDefault();
    })

    $('*[id*=edit-comment]:visible').each(function() {
        $(this).on('click', function () {
            let $text = $(this).parent().parent().find('#comment-text');
            let value = $text.html();
            $text.remove();
            let $newTextBlock = $('<textarea class="form-control" name="text" row="3">').html(value);

            let comment_id = $(this).parent().parent().find('#comment-id').val();
            console.log(comment_id);

            let $newForm = $('<form>');
            $newForm.attr('method', 'POST');
            $newForm.attr('action', 'http://127.0.0.1:8000/comments/' + comment_id + '/update');
            let $method = $('<input type="hidden" name="_method" value="PUT">');
            let token = $('meta[name = "csrf-token"]').attr('content');
            let $csrf = $('<input type="hidden" name="_token" value="' + token + '">');
            let $saveBtn = $('<button id="save-comment" type="submit" class="btn btn-primary btn-sm mt-1">').html('Save');

            $newForm.append($saveBtn);
            $newForm.prepend($newTextBlock);
            $newForm.prepend($method);
            $newForm.prepend($csrf);

            $(this).parent().parent().prepend($newForm);
        })
    });
})
