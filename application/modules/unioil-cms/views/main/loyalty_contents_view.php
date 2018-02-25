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
        <table id="loyalty_contentsList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <!--<th>Cover Image</th>-->
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

<div class="modal fade" id="loyalty_contentsModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Loyalty Content</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="loyalty_contentsID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="loyalty_contentsForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputNewsTitle" class="col-sm-2 control-label">Title</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputNewsTitle" placeholder="Title" required>
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

                            <!--<div class="form-group">
                                <label for="inputCoverImage" class="col-sm-2 control-label">Cover Image (Required Size: 582x498)</label>

                                <div class="col-sm-10">
                                    <center><img id="coverImgPrev" src="#" class='img-thumbnail' style='height:100px;width:200px' onerror="this.src='<?php echo base_url()."assets/images/img_bg.png";?>'"></center>
                                    <input type="hidden" id="inputCoverImage" value="">
                                    <center><a class="btn btn-info" onclick="set_image_loader('inputCoverImage','coverImgPrev');">Select from Gallery</a></center>
                                    <center><div class="help-block with-errors" id="coverError"></div></center>
                                </div>
                            </div>-->

                            <div class="form-group">
                                <label for="inputContent" class="col-sm-2 control-label">Content</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputContent" placeholder="Content" style="resize:none" required></textarea>
                                <div class="help-block with-errors" id="ckEditorError"></div>
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
                            <div class="form-group">
                                <div id="uploadBoxMain" class="col-md-12">
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveNews">Save Loyalty Content</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteNewsModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Loyalty Content</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteNews">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade" id="mediaGalleryModal"   role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Loyalty Content Cover Image Gallery</h3>
            </div>
            <div class="modal-body">
                <form id="galleryFormUpload" method="post" action="<?php echo base_url()."unioil-cms/media/add_media"?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-8">
                            <input type="hidden" id="var_holder" value="">
                            <input type="hidden" id="file_holder" value="">
                            <input type="hidden" name="module" value="loyalty_contents">
                            <input type="hidden" name="allowed_files" value="png|jpeg|jpg|gif">
                            <input type="hidden" name="file_type" value="image">
                            <input type="file" name="media_file" id="media_file" accept="*" class="form-control" required>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-success" id="startUpload">Start Upload</button></center>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="uploadBox">
                            </div>
                        </div>
                    </div>
                </form>
                <center>
                    <table id="imageGalleryTable" class="table table-bordered table-striped display nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th width="100px"></th>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Date Created</th>
                            <th>Created By</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info" id="selectImage">Select</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade" id="imgPreviewModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Cover Image Preview</h3>
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


<!-- /.modal -->
<div class="modal fade" id="deleteImageModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete this image?</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteImage">
                <center><img src="" id="imgPreviewDel" style="width:100%;"></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteImageBtn">Delete</button>
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

    var editor = CKEDITOR.replace('inputContent');

    var main = function(){
        var table = $('#loyalty_contentsList').DataTable({
            "language": {                
                "infoFiltered": ""
            },  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."unioil-cms/loyalty_contents/get_loyalty_contents_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 1 ] }
        ], "order": [[ 3, 'desc' ]]
        });
        $("#addBtn").click(function(){
            $("#loyalty_contentsModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
            $('#loyalty_contentsForm').validator();
            $("#loyalty_contentsModal").modal("show");
        });

        $("#saveNews").click(function(){
            $("#loyalty_contentsForm").submit();
        });

        var image_correct = true;
        var image_error = "";
        $("#loyalty_contentsForm").validator().on('submit', function (e) {
           
            var btn = $("#saveNews");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var title = $("#inputNewsTitle").val();
                var description = $("#inputDescription").val();
                var content = editor.getData();;
                var status = $("#inputStatus").val();
                var loyalty_contents_id = $("#loyalty_contentsID").val();

                if(title == "" || description == "")
                {
                    btn.button("reset"); 
                    return false;
                }

                var formData = new FormData();
                formData.append('id', loyalty_contents_id);
                formData.append('title', title);
                formData.append('description', description);
                formData.append('content', content);
                formData.append('status', status);
                // Attach file
                //formData.append('cover_image', $('#inputCoverImage').val());
                var messageLength = content.replace(/<[^>]*>/gi, '').trim().length;
                if($('#inputCoverImage').val() == "")
                {   
                    img_error = "<span style='color:red;'>Banner image is required</span>";   
                    btn.button("reset");
                    $("#coverError").html(img_error);
                    return false;
                }
                
                /* var img = document.getElementById('coverImgPrev'); 
                //or however you get a handle to the IMG
                var width = img.naturalWidth;
                var height = img.naturalHeight;
              
                
               if(width != "582" || height != "498")
                {                  
                    img_error = "<span style='color:red;'>Invalid cover size use 582x498</span>";   
                    btn.button("reset");
                    $("#coverError").html(img_error);
                    return false;
                }
                else
                {
                    $("#coverError").html("");  
                }*/
                if( !messageLength ) {
                    $("#ckEditorError").html("<span style='color:red;'>Please fill out this field.</span>");
                    btn.button("reset"); 
                    return false;
                }else{
                    $("#ckEditorError").html("");
                }

                 //fromthis    
                 var url = "<?php echo base_url()."unioil-cms/loyalty_contents/add_loyalty_contents";?>";
                var message = "New loyalty_contents successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."unioil-cms/loyalty_contents/edit_loyalty_contents";?>";
                    message = "Loyalty Content successfully updated";
                }


                $('#uploadBoxMain').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBarMain" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
                $.ajax({
                    data: formData,
                    type: "post",
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: url ,
                    xhr: function(){
                        //upload Progress
                        var xhr = $.ajaxSettings.xhr();
                        if (xhr.upload) {
                            xhr.upload.addEventListener('progress', function(event) {
                                var percent = 0;
                                var position = event.loaded || event.position;
                                var total = event.total;
                                if (event.lengthComputable) {
                                    percent = Math.ceil(position / total * 100);
                                }
                                //update progressbar
                                
                                $('#progressBarMain').css('width',percent+'%').html(percent+'%');
                                                                
                            }, true);
                        }
                        return xhr;
                    },
                    mimeType:"multipart/form-data"
                }).done(function(data){ 
                    if(!data)
                    {
                        btn.button("reset");
                        toastr.error(data);
                    }
                    else
                    {
                         //alert("Data Save: " + data);
                         btn.button("reset");
                         if(action == "edit")
                         {
                             table.draw("page");
                         }
                         else
                         {
                             table.draw();
                         }
                         toastr.success(message);
                         editor.setData('');
                         $("#loyalty_contentsForm").validator('destroy');
                         $("#loyalty_contentsModal").modal("hide"); 
                         $('#uploadBoxMain').html('');          
                    }
                });
            }
               return false;
        });

        $("#deleteNews").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."unioil-cms/loyalty_contents/delete_loyalty_contents";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#deleteNewsModal").modal("hide");
                            toastr.error('Loyalty Content ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#loyalty_contentsModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            editor.setData("");
            $("#inputStatus").val('1').trigger('change');
            $('#inputCoverImage').val("");
            $('#coverImgPrev').attr("src","");
            $("#loyalty_contentsForm").validator('destroy');
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
        $("#loyalty_contentsModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#loyalty_contentsForm').validator();    
        $("#action").val("edit");
        $("#inputCoverImage").removeAttr("required");
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."unioil-cms/loyalty_contents/get_loyalty_contents_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputNewsTitle").val(data.loyalty_contents.title);
                    $("#inputDescription").val(data.loyalty_contents.description);
                    editor.setData(data.loyalty_contents.content);
                    //$('#inputCoverImage').val(data.loyalty_contents.cover_image_id);
                    $('#coverImgPrev').attr("src","<?php echo base_url()."/uploads/loyalty_contents/"; ?>" + data.loyalty_contents.cover_image);
                    $("#inputStatus").val(data.loyalty_contents.status).trigger('change');
                    $("#loyalty_contentsID").val(data.loyalty_contents.id);
                    $("#loyalty_contentsModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteNewsModal .modal-title").html("Delete <?php echo rtrim(ucfirst($module_name),"s");?>");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteNewsModal").modal("show");
    }
    
    function img_preview(img_src)
    {
        $("#imgPreview").attr("src","<?php echo base_url()."uploads/loyalty_contents/"?>"+img_src);
        $("#imgPreviewModal").modal("show");
    }

    
    
    function set_image_loader(var_holder,file_holder)
    {
        $("#var_holder").val(var_holder);
        $("#file_holder").val(file_holder);
        $("#mediaGalleryModal").modal("show");
    }

    var new_table = $('#imageGalleryTable').DataTable({  
            "language": {                
                "infoFiltered": ""
            },
            "processing" : true,
            "serverSide" : true,
            "searching" : false,
            "pageLength": 10, "bLengthChange": false,
            "ajax" : "<?php echo base_url()."unioil-cms/media/get_media_list?module=loyalty_contents";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 1 ] }
        ], "order": [[ 0, 'desc' ]]
        });

    $('#galleryFormUpload').ajaxForm( {
            dataType : 'json',
            beforeSubmit: function() {
                $("#startUpload").button("loading");
                $('#uploadBox').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
            },
            uploadProgress: function ( event, position, total, percentComplete ) {
                if (percentComplete == 100) {
                    $('#progressBar').css('width',percentComplete+'%').html('Processing...');
                } else {
                    $('#progressBar').css('width',percentComplete+'%').html(percentComplete+'%');
                }
            },
            success: function(data){
                
                if(!data)
                {
                    $("#startUpload").button("reset");
                    toastr.error(data);
                }
                else
                {   
                    $("#startUpload").button("reset");
                    new_table.draw();
                    toastr.success("Upload Complete");
                    $('#uploadBox').html('<div id="progressOverlay"><div class="progress progress-striped"><div class="bar" id="progressBar" style="width: 0%;">0%</div></div></div>');       
                    $("#media_file").val('');     
                    $('#uploadBox').html("");
                }
            
            },
            error: function (request, status, error) {
                $("#startUpload").button("reset");
                toastr.error(request.responseText);
            }
    });

    $("#selectImage").click(function(){
        $("#"+$("#var_holder").val()).val($('input[name=selected_image]:checked').val());
        $("#"+$("#file_holder").val()).attr("src",$('input[name=selected_image]:checked').attr("data"));
        $("#mediaGalleryModal").modal("hide"); 
        new_table.draw();
    });

    function _delete_media(id,file_name)
    {
        $("#imgPreviewDel").attr("src",file_name);
        $("#deleteImage").val(id);
        $("#deleteImageModal").modal("show");
    }

    $("#deleteImageBtn").click(function(){
        var btn = $(this);
        var id = $("#deleteImage").val();
        var data = { "id" : id };
        btn.button("loading");

        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."unioil-cms/media/delete_media";?>",
                success: function(data){
                    //alert("Data Save: " + data);
                    btn.button("reset");
                    new_table.draw('page');
                    $("#deleteImageModal").modal("hide");
                    toastr.error('Image successfully deleted');
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    });

    $(document).ready(main);
</script>