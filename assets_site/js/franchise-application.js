$(document).ready(function() {
    //$('#franchise-birthday').datepicker({ minDate: -20, maxDate: '0D'});
	$('#franchise-birthday').datepicker();

    $('#franchise-form').on('submit', function(e) {
    	if(validateForm($(this))) {
    		e.preventDefault();
    	}else {
			e.preventDefault();
			var filename = "";
			var fullPath = document.getElementById('franchise-letter').value;
			if (fullPath) {
				var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
				var filename = fullPath.substring(startIndex);
				if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
					filename = filename.substring(1);
				}
			}
			if(filename != "")
			{
				var file_data = $('#franchise-letter').prop('files')[0];   
				var form_data = new FormData();                  
				form_data.append('file', file_data);                         
				$.ajax({
							url: './emailer/attach.php', // point to server-side PHP script 
							dataType: 'text',  // what to expect back from the PHP script, if anything
							cache: false,
							contentType: false,
							processData: false,
							data: form_data,                         
							type: 'post',
							success: function(php_script_response){
								if(php_script_response == "Error")
								{
										alert("An error occured during upload.");
										return false;
								}
							}
				 });
			}
			
			var values = { "subject" : "Franchise Form Response" , "to" : to_franchise_email , "body" : "First Name: " + $("#franchise-fname").val() +  "<br>Last Name: " + $("#franchise-lname").val() + "<br>Franchise Address:" + $("#franchise-address").val() + 	
			"<br>Franchise City: " + $("#franchise-city").val() + 
			"<br>Franchise Zipcode: " + $("#franchise-zipcode").val() + 
			"<br>Birthday:" + $("#franchise-birthday").val() + 
			"<br>Contact Number: " + $("#franchise-number").val() + 
			"<br>Email Address: " + $("#franchise-email").val() , "attachment" : filename
			}

			 $.ajax({
					url: "./emailer/send_email.php",
					type: "post",
					data: values ,
					success: function (response) {
					   if(response == "Message sent")
					   {
						   alert("Message successfully sent");
						   window.location = "";
					   }						   

					},
					error: function(jqXHR, textStatus, errorThrown) {
					   console.log(textStatus, errorThrown);
					}


				});
		}
    });
});