$(document).ready(function() {
    $('.tabs').tabs();

    $('.show_debug').click(function() {
        $('#debug').dialog({
            width: 800
        });
    });
});

function validateEmail(email) {
    var bool;
    $.ajax({
        url: 'users/validate_email',
        data: {
            email: email
        },
        type: 'POST',
        dataType: 'json',
        async: false,
        success: function(response) {
            bool = response['valid'];
        }
    });
    return bool;
}

function uniqueEmail(email) {
    var bool;
    $.ajax({
        url: 'users/unique_email',
        data: {
            email: email
        },
        type: 'POST',
        dataType: 'json',
        async: false,
        success: function(response) {
            bool = response['valid'];
        }
    });
    return bool;
}