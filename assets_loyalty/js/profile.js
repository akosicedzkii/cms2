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
    $("#editBtn").click(function(){
        getInfo("edit");
    });
    $('#edit-form').on('submit', function(e) {
        if (validateForm($(this))) {
            e.preventDefault();
        }else{

            
            var data = {
                "address" : $("#edit-house-number").val() + "|" + $("#edit-street").val() + "|" +$("#edit-village").val() + "|" +$("#edit-barangay").val() + "|" +$("#edit-city").val() + "|" + $("#edit-province").val() ,
                "mobile":$("#edit-contact-number").val(),
                "email": $("#edit-email-address").val(),
                "civil_status_code": $('input[name=edit-status]:checked').val(),
                "gender_code": $('input[name=edit-gender]:checked').val(),
                "occupation_code": $("#edit-occupation").val(),
                "is_petron": Number($("#edit-petron").prop("checked")),
                "is_phoenix": Number($("#edit-phoenix").prop("checked")),
                "is_shell":Number($("#edit-shell").prop("checked")) ,
                "is_flyingv": Number($("#edit-flyingv").prop("checked")),
                "is_caltex":Number($("#edit-caltex").prop("checked")) ,
                "is_ptt":Number($("#edit-ptt").prop("checked")) ,
                "is_total":Number($("#edit-total").prop("checked")) ,
                "is_jetti":Number($("#edit-jetti").prop("checked")) ,
                "is_seaoil": Number($("#edit-seaoil").prop("checked")) ,
                "is_sm": Number($("#edit-smadv").prop("checked")),
                "is_robinson": Number($("#edit-robin").prop("checked")) ,
                "is_cebupacific": Number($("#edit-cebup").prop("checked")) ,
                "is_petronv": Number($("#edit-petro").prop("checked")),
                "is_bdo": Number($("#edit-bdore").prop("checked")),
                "is_mabuhay": Number($("#edit-mabuh").prop("checked")),
                "is_starbucks": Number($("#edit-starb").prop("checked")),
                "is_snr": Number($("#edit-snr").prop("checked")),
                "is_national": Number($("#edit-natio").prop("checked")),
                "is_happy": Number($("#edit-happy").prop("checked")) ,
                "is_mercury": Number($("#edit-mercu").prop("checked")),
                "number_cars": $("#edit-car-number").val()
            };
            console.log(data);
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
    $('#datepick').datepicker({ dateFormat: 'yy-mm-dd' }).datepicker("setDate", new Date());
    getInfo("load");
    function getInfo(view)
    {
         $.ajax({
            "url" : base_url + "loyalty/profile/api_retrieve_info",
            "method" : "post",
            "success" : function(data){
                data = JSON.parse(data);
                console.log(data);
                //alert(Boolean(Number(data.data[0].is_petron)));
                $("#edit-contact-number").val(data.data[0].mobile);
                $("#edit-email-address").val(data.data[0].email);
                $("#edit-occupation").val(data.data[0].occupation_code);
                $("#edit-car-number").val(data.data[0].number_cars);
                var full_address = data.data[0].address.split("|");
                $("#edit-house-number").val(full_address[0]);
                $("#edit-street").val(full_address[1]);
                $("#edit-village").val(full_address[2]);
                $("#edit-barangay").val(full_address[3]);
                $("#edit-city").val(full_address[4]);
                $("#edit-province").val(full_address[5]);
                $("#edit-petron").prop('checked', Boolean(Number(data.data[0].is_petron)));
                $("#edit-phoenix").prop('checked',  Boolean(Number(data.data[0].is_phoenix)));
                $("#edit-shell").prop('checked',  Boolean(Number(data.data[0].is_shell)));
                $("#edit-flyingv").prop('checked',  Boolean(Number(data.data[0].is_flyingv)));
                $("#edit-caltex").prop('checked',  Boolean(Number(data.data[0].is_caltex)));
                $("#edit-ptt").prop('checked',  Boolean(Number(data.data[0].is_ptt)));
                $("#edit-total").prop('checked',  Boolean(Number(data.data[0].is_total)));
                $("#edit-jetti").prop('checked',  Boolean(Number(data.data[0].is_jetti)));
                $("#edit-seaoil").prop('checked',  Boolean(Number(data.data[0].is_seaoil)));
                $("#edit-smadv").prop('checked',  Boolean(Number(data.data[0].is_sm)));
                $("#edit-robin").prop('checked',  Boolean(Number(data.data[0].is_robinson)));
                $("#edit-cebup").prop('checked',  Boolean(Number(data.data[0].is_cebupacific)));
                $("#edit-petro").prop('checked',  Boolean(Number(data.data[0].is_petronv)));
                $("#edit-bdore").prop('checked',  Boolean(Number(data.data[0].is_bdo)));
                $("#edit-mabuh").prop('checked',  Boolean(Number(data.data[0].is_mabuhay)));
                $("#edit-starb").prop('checked',  Boolean(Number(data.data[0].is_starbucks)));
                $("#edit-snr").prop('checked',  Boolean(Number(data.data[0].is_snr)));
                $("#edit-natio").prop('checked',  Boolean(Number(data.data[0].is_national)));
                $("#edit-happy").prop('checked',  Boolean(Number(data.data[0].is_happy)));
                $("#edit-mercu").prop('checked',  Boolean(Number(data.data[0].is_mercury)));
                
                
                
                
                
                if(data.data[0].gender_code == "M")
                {
                    $('#gender-male').prop('checked', true);
                }
                else
                {
                    $('#gender-female').prop('checked', data.data[0].mobile);
                }


                $("input[name=edit-status][value='"+data.data[0].civil_status_code+"']").prop("checked",true);
                if(view == "load")
                {
                    $.ajax({
                        "data": { "mobile_number" : data.data[0].mobile },
                        "url" : base_url + "loyalty/profile/api_validate",
                        "method" : "post",
                        "success" : function(dataval){
                            dataval = JSON.parse(dataval);
                            $("#profile-points").val(dataval[0].points);
                        }
                    });
                }else{
                    
                    $("#edit-modal").modal("show");
                }
            }
        });
    }
   
    $("#datepick").on("change",function(){
        var data = {"startdate":$("#datepick").val(),"enddate":$("#datepick").val() }
        $.ajax({
            "data":data,
            "url" : base_url + "loyalty/profile/api_transaction",
            "method" : "post",
            "success" : function(data){
                $("#tbl_content").html(data);
            }
        });
    });
    $("#datepick").trigger("change");

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