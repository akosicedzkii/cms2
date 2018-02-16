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

    $.ajax({
        "url" : base_url + "main/api_retrieve_info",
        "method" : "post",
        "success" : function(data){
            console.log(JSON.parse(data));
        }
    });
});