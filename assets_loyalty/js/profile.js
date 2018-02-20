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
        }
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