import $ from 'jquery'

$(document).ready(function () {
    $('.add-state-btn').on('click', function () {
        $('.new-state-block').toggle();
    })
})
