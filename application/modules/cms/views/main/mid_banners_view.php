<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<?php $module_name = ucwords(str_replace("_"," ",$module_name));?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo ucfirst($module_name);?>
    <small>Management</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo ucfirst($module_name);?></li>
    </ol>
</section>
<button class="btn btn-success btn-circle btn-lg fix-btn" id="addBtn"  data-toggle="tooltip" title="Add New">
    <span class="glyphicon glyphicon-plus"></span>
</button>
<!-- Main content -->
<section class="content">
<div class="box" id="main-list">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucfirst($module_name);?> List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="mid_bannersList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Banner</th>
            <th>Link</th>
            <th>Status</th>
            <th>Date Created</th>
            <th>Created By</th>
            <th>Date Modified</th>
            <th>Modified By</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
</div>

<div class="modal fade" id="mid_bannersModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add MidBanners</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="mid_bannersID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="mid_bannersForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputMidBannersTitle" class="col-sm-2 control-label">Title</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputMidBannersTitle" placeholder="Title" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription" class="col-sm-2 control-label">Description</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputDescription" placeholder="Description" style="resize:none" required></textarea>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputBannerImage" class="col-sm-2 control-label">Banner Image (Required Size: 1920x772)</label>

                                <div class="col-sm-10">
                                <input type="file" class="form-control" id="inputBannerImage" placeholder="Banner Image" style="resize:none" required>
                                <div class="help-block with-errors" id="coverError"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputLink" class="col-sm-2 control-label">Link</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputLink" placeholder="Link" style="resize:none"></textarea>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus" class="col-sm-2 control-label">Status</label>

                                <div class="col-sm-10">
                                <select class="form-control" id="inputStatus" placeholder="Content" style="resize:none" required>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                        </div>
                    </form>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveMidBanners">Save Mid Banner</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteMidBannersModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete MidBanners</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteMidBanners">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade" id="imgPreviewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Banner Image Preview</h3>
            </div>
            <div class="modal-body">
                <center><img src="" id="imgPreview" style="width:100%;"></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>

    var inputRoleConfig = {
        dropdownAutoWidth : true,
        width: 'auto',
        placeholder: "--- Select Item ---"
    };


    var main = function(){
        var table = $('#mid_bannersList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "responsive" : true,
            "ajax" : "<?php echo base_url()."cms/mid_banners/get_mid_banners_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 1 ] }
        ]
        });
        $("#addBtn").click(function(){
            $("#mid_bannersModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#inputBannerImage").attr("required","required");
            $('#mid_bannersForm').validator();
            $("#mid_bannersModal").modal("show");
        });

        $("#saveMidBanners").click(function(){
            $("#mid_bannersForm").submit();
        });

        var image_correct = true;
        var image_error = "";
        $("#mid_bannersForm").validator().on('submit', function (e) {
           
            var btn = $("#saveMidBanners");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var title = $("#inputMidBannersTitle").val();
                var description = $("#inputDescription").val();
                var link = $("#inputLink").val();
                var status = $("#inputStatus").val();
                var mid_banners_id = $("#mid_bannersID").val();

                var formData = new FormData();
                formData.append('id', mid_banners_id);
                formData.append('title', title);
                formData.append('link', link);
                formData.append('description', description);
                formData.append('status', status);
                // Attach file
                formData.append('banner_image', $('#inputBannerImage').prop("files")[0]);

                var url = "<?php echo base_url()."cms/mid_banners/add_mid_banner";?>";
                var message = "New mid banner successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."cms/mid_banners/edit_mid_banner";?>";
                    message = "Mid banner successfully updated";
                }

                if(image_correct == false)
                {
                    btn.button("reset");
                    $("#coverError").html(img_error);
                    return false;
                }
                console.log(image_correct);

                $.ajax({
                    data: formData,
                    type: "post",
                    processData: false,
                    contentType: false,
                    url: url ,
                    success: function(data){
                        if(!data)
                        {
                            btn.button("reset");
                            toastr.error(data);
                        }
                        else
                        {
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw();
                            toastr.success(message);
                            $("#mid_bannersForm").validator('destroy');
                            $("#mid_bannersModal").modal("hide");     
                        }
                    
                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    }
            });
            }
               return false;
        });

        $("#inputBannerImage").change(function (e) {
            var btn = $("#saveMidBanners");
            var fileUpload = document.getElementById("inputBannerImage");
                
                //Check whether the file is valid Image.
                var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
                
                if (regex.test(fileUpload.value.toLowerCase())) {

                    //Check whether HTML5 is supported.
                    if (typeof (fileUpload.files) != "undefined") {
                        //Initiate the FileReader object.
                        var reader = new FileReader();
                        //Read the contents of Image File.
                        reader.readAsDataURL(fileUpload.files[0]);
                        reader.onload = function (e) {
                            //Initiate the JavaScript Image object.
                            var image = new Image();

                            //Set the Base64 string return from FileReader as source.
                            image.src = e.target.result;
                                    
                            //Validate the File Height and Width.
                            image.onload = function () {
                                if(this.width != "1920" || this.height != "772")
                                {
                                    img_error = "<span style='color:red;'>Invalid cover size use 1920x772</span>";                     
                                    btn.button("reset"); 
                                    image_correct = false;
                                    console.log(image_correct);
                                }
                                else
                                {
                                    image_correct = true;
                                    $("#coverError").html("");  
                                    console.log(image_correct);
                                }
                            };

                        }
                    } else {
                        alert("This browser does not support HTML5.");
                        btn.button("reset"); 
                        image_correct = false;
                    }
                } else {
                    alert("Please select a valid Image file.");
                    btn.button("reset"); 
                    image_correct = false;
                }
        });

        $("#deleteMidBanners").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."cms/mid_banners/delete_mid_banner";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw();
                            $("#deleteMidBannersModal").modal("hide");
                            toastr.error('Mid Mid Banner ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#mid_bannersModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $("#inputStatus").val('1').trigger('change');
            $("#mid_bannersForm").validator('destroy');
        });

        $('#inputStatus').select2(inputRoleConfig);
        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
      
    };
    function _edit(id)
    {
        $("#mid_bannersModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#mid_bannersForm').validator();    
        $("#action").val("edit");
        $("#inputBannerImage").removeAttr("required");
        $("#inputInnerBannerImage").removeAttr("required");
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."cms/mid_banners/get_banner_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputMidBannersTitle").val(data.mid_banners.title);
                    $("#inputDescription").val(data.mid_banners.description);
                    $("#inputLink").val(data.mid_banners.link);
                    $("#inputStatus").val(data.mid_banners.status).trigger('change');
                    $("#mid_bannersID").val(data.mid_banners.id);
                    $("#mid_bannersModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteMidBannersModal .modal-title").html("Delete <?php echo rtrim(ucfirst($module_name),"s");?>");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteMidBannersModal").modal("show");
    }
    function img_preview(img_src)
    {
        $("#imgPreview").attr("src","<?php echo base_url()."uploads/mid_banners/"?>"+img_src);
        $("#imgPreviewModal").modal("show");
    }
    $(document).ready(main);
</script>