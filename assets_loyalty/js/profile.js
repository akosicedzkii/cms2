$(document).ready(function() {
    $('#terms-modal').modal('show');

    $('#terms-form').on('submit', function(e) {
        if (validateForm($(this))) {
            e.preventDefault();
        }
    });

    $('#edit-form').on('submit', function(e) {
        if (validateForm($(this))) {
            e.preventDefault();
        }
    });
});