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
        e.preventDefault();
        var $form = $(this);
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize()
        }).done(function (data) {
            let $newCommBlock = data;
            $('.all-comments').append($newCommBlock);
        }).fail(function (data) {
            console.log(data);
        });

        $('.add-comment-field').toggle();
    })

    $('*[id*=edit-comment]:visible').each(function () {
        $(this).on('click', function () {
            $(this).attr('disabled', 'disabled');
            let $block = $(this).parent().parent().find('.comment-text');
            let $text = $(this).parent().parent().find('#comment-text');
            $text.remove();
            let comment = $(this).parent().parent().find('#comment-id').val();
            $block.load('/comments/' + comment + '/edit');
        })
    });
})
