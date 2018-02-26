$(document).ready(function() {
    if(checked == "false")
    {
        $('#terms-modal').modal('show');
    }

    $('#terms-form').on('submit', function(e) {
        if (validateForm($(this))) {
            e.preventDefault();
        }else{
            $.ajax({
                "url" : base_url + "loyalty/profile/update_terms",
                "method" : "post",
                "success" : function(data){
                    $('#terms-modal').modal('hide');
                }
            });
        }
        return false;
    });

    $('#edit-form').on('submit', function(e) {
        if (validateForm($(this))) {
            e.preventDefault();
        }else{

            
            var data = {
                "address" : $("#edit-house-number").val(),
                "mobile":$("#edit-contact-number").val(),
                "email": $("#edit-email-address").val(),
                "civil_status_code": $('input[name=edit-status]:checked').val(),
                "gender_code": $('input[name=edit-gender]:checked').val(),
                "occupation_code": $("#edit-occupation").val(),
                "is_petron": $("#edit-petron").is("checked"),
                "is_phoenix": $("#edit-phoenix").is("checked"),
                "is_shell": $("#edit-shell").is("checked") ,
                "is_flyingv": $("#edit-flyingv").is("checked"),
                "is_caltex":$("#edit-caltex").is("checked") ,
                "is_ptt":$("#edit-ptt").is("checked") ,
                "is_total":$("#edit-total").is("checked") ,
                "is_jetti":$("#edit-jetti").is("checked") ,
                "is_seaoil":$("#edit-seaoil").is("checked") ,
                "is_sm": $("#edit-smad").is("checked"),
                "is_robinson":$("#edit-robin").is("checked") ,
                "is_cebupacific":$("#edit-cebup").is("checked") ,
                "is_petronv": $("#edit-petro").is("checked"),
                "is_bdo": $("#edit-bdore").is("checked"),
                "is_mabuhay": $("#edit-mabuh").is("checked"),
                "is_starbucks": $("#edit-starb").is("checked"),
                "is_snr": $("#edit-snr").is("checked"),
                "is_national": $("#edit-natio").is("checked"),
                "is_happy":$("#edit-happy").is("checked") ,
                "is_mercury": $("#edit-mercu").is("checked"),
                "number_cars": $("#edit-car-number").val()
            };
            $.ajax({
                "data": data,
                "url" : base_url + "loyalty/profile/api_update_info",
                "method" : "post",
                "success" : function(data){
                    console.log(data)
                    $('#edit-modal').modal('hide');
                }
            });
        }
        return false;
    });

    $.ajax({
        "url" : base_url + "loyalty/profile/api_retrieve_info",
        "method" : "post",
        "success" : function(data){
            data = JSON.parse(data);
            $("#edit-contact-number").val(data.data.mobile);
            $("#edit-email-address").val(data.data.email);
            if(data.data.gender_code == "1")
            {
                $('#gender-male').prop('checked', true);
            }
            else
            {
                $('#gender-female').prop('checked', true);
            }
            $.ajax({
                "data": { "mobile_number" : data.data.mobile },
                "url" : base_url + "loyalty/profile/api_validate",
                "method" : "post",
                "success" : function(dataval){
                    dataval = JSON.parse(dataval);
                    $("#profile-points").val(dataval[0].points);
                }
            });
        }
    });

    
    $.ajax({
        "url" : base_url + "loyalty/profile/api_transaction",
        "method" : "post",
        "success" : function(data){
            data = JSON.parse(data);

        }
    });

    var fileNode = document.querySelector('#image'),
    form = new FormData(),
    xhr = new XMLHttpRequest();

    fileNode.addEventListener('change', function( event ) {
        event.preventDefault();

        var files = this.files;
        var file = files[0];

        // check mime
        if (['image/png', 'image/jpg'].indexOf(file.type) == -1) {
            // mime type error handling
            alert("Invalid image type uploaded");
            return false;
        }

        form.append('my-files', file);

        xhr.onload = function() {
            if (xhr.status === 200) {
                alert("Image Successfully updated");
                window.location = "";
            }
        }

        xhr.open('POST', base_url + "loyalty/profile/image_upload");
        xhr.send(form);
        
});
    

});