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
})
