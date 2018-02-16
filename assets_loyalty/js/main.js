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
        }else{
            e.preventDefault();
            var bday = $("#login-birthday-year").val() + $("#login-birthday-month").val() + $("#login-birthday-day").val();
            var data = { "card_number" : $("#login-card-number").val() , "birthdate" : bday }
            $.ajax({
                "method" : "POST",
                "data" : data,
                "url" : base_url + "loyalty/main/api_login",
                "success" : function(data){
                    if(data != "true")
                    {
                        $("#login-error").html("Account not found!");
                    }
                    else
                    {
                        window.location = "loyalty/profile";
                    }
                }
            });
        }
    });
});