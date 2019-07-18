import $ from 'jquery'

$(document).ready(function () {
    $('.add-state-btn').on('click', function () {
        $('.new-state-block').removeAttr('hidden');
    });

    $('.hide-btn').on('click', function () {
        $('.new-state-block').attr('hidden', true);
    })
})
