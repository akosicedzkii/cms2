$(document).ready(function() {
	var $activePage = $('.nav-item.active');

	$('#privacy-form').on('submit', function(e) {
        e.preventDefault();
        if (!validateForm($(this))) {
            $('#privacy-modal').modal('hide');
            $('#login-modal').modal('show');
        }
    });
	
    $('#login-form').on('submit', function(e) {
        if (validateForm($(this))) {
            e.preventDefault();
        }
    });
});