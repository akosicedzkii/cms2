$(document).ready(function() {
    $('#careers-birthday').datepicker({ minDate: -20, maxDate: '0D'});

    $('#careers-form').on('submit', function(e) {
    	if(validateForm($(this))) {
    		e.preventDefault();
    	}
    });


    $("#careers-opening").change(function(){
        var data = {"id" : $("#careers-opening").val()}
        $.ajax({
            type: "post",
            url: "careers/get_career_details",
            data:data,
            success: function(data){
                data = JSON.parse(data);
                $("#job-description").html(data.job_description);
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
    });
    });
});