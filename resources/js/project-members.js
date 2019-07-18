import $ from 'jquery'

$(document).ready(function () {
    $('.role-select').on('change', function () {
        let role = $(this).val();
        let project = $('#project').val();
        let user = $(this).parent().find('#user').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/projects/' + project + '/changeUserRole/' + user,
            data: {role: role},
            success: function (data) {
                alert('Role was changed successful!');
            },
            error: function (data) {
                console.log("error: ", data);
            }
        });
    })

    $('.add-new-member').on('change', function () {
        let userId = $(this).val();
        let project = $('#project').val();
        if (userId != 0) {
            location.href = '/projects/'+ project + '/addUser/'+ userId;
        }
    })
})
