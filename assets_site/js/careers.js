$(document).ready(function() {
    $('#careers-birthday').datepicker({ minDate: -20, maxDate: '0D'});

    $('#careers-form').on('submit', function(e) {
    	if(validateForm($(this))) {
    		e.preventDefault();
    	}
    });
});