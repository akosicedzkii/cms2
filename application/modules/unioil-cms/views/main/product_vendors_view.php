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
        <table id="product_vendorsList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Vendor Name</th>
            <th>Vendor Image</th>
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

<div class="modal fade" id="productVendorsModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Product Vendors</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="productVendorsID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="productVendorsForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputProductVendorName" class="col-sm-2 control-label">Vendor Name</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputProductVendorName" placeholder="Vendor Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputProductVendorDescription" class="col-sm-2 control-label">Description</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputProductVendorDescription" placeholder="Description" style="resize:none" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputProductVendorImage" class="col-sm-2 control-label">Vendor Image</label>

                                <div class="col-sm-10">
                                        <center><img id="vendorImgPrev" src="#" class='img-thumbnail' style='height:100px;width:200px' onerror="this.src='<?php echo base_url()."assets/images/img_bg.png";?>'"></center>
                                        <input type="hidden" id="inputProductVendorImage" value="">
                                        <center><a class="btn btn-info" onclick="set_image_loader('inputProductVendorImage','vendorImgPrev');">Select from Gallery</a></center>
                                        <center><div class="help-block with-errors" id="inputProductVendorImageError"></div></center>
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
            <button type="button" class="btn btn-primary" id="saveProductVendors">Save Product Vendor</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteProductVendorsModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Product Vendors</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteProductVendors">Delete</button>
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
           
             <h3 class="modal-title">Product Vendor Image Gallery</h3>
            </div>
            <div class="modal-body">
                <form id="galleryFormUpload" method="post" action="<?php echo base_url()."unioil-cms/media/add_media"?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-8">
                            <input type="hidden" id="var_holder" value="">
                            <input type="hidden" id="file_holder" value="">
                            <input type="hidden" name="module" value="product_vendors">
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
                            <th>Media</th>
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
<div class="modal fade" id="imgPreviewModal"   role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Vendor Image Preview</h3>
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

    var main = function(){
        var table = $('#product_vendorsList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."unioil-cms/product_vendors/get_product_vendors_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 1 ] }
        ], "order": [[ 3, 'desc' ]]
        });
        $("#addBtn").click(function(){
            $("#productVendorsModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
            $('#productVendorsForm').validator();
            $("#productVendorsModal").modal("show");
        });

        $("#saveProductVendors").click(function(){
            $("#productVendorsForm").submit();
        });
        $("#productVendorsForm").validator().on('submit', function (e) {
           
            var btn = $("#saveProductVendors");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var vendor_name = $("#inputProductVendorName").val();
                var vendor_description = $("#inputProductVendorDescription").val();
                var product_vendor_id = $("#productVendorsID").val();
                var vendor_image =  $('#inputProductVendorImage').val() ;
                if(vendor_name == "" || vendor_description == "")
                {
                    btn.button("reset"); 
                    return false;
                }
                if(vendor_image == "")
                {
                    $("#inputProductVendorImageError").html("<span style='color:red;'>Please fill out this field.</span>");
                    btn.button("reset"); 
                    return false;
                }else{
                    
                    $("#inputProductVendorImageError").html("");
                }
                var formData = new FormData();
                formData.append('id', product_vendor_id);
                formData.append('vendor_name', vendor_name);
                formData.append('vendor_description', vendor_description);
                // Attach file
                formData.append('vendor_image',vendor_image);

                var url = "<?php echo base_url()."unioil-cms/product_vendors/add_product_vendors";?>";
                var message = "New Product Vendor successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."unioil-cms/product_vendors/edit_product_vendors";?>";
                    message = "Product Vendor successfully updated";
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
                        $("#productVendorsForm").validator('destroy');
                        $("#productVendorsModal").modal("hide");
                        $('#uploadBoxMain').html('');     
                    }
                });              
            }
               return false;
        });

        $("#deleteProductVendors").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."unioil-cms/product_vendors/delete_product_vendors";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#deleteProductVendorsModal").modal("hide");
                            toastr.error('Product Vendors ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#productVendorsModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $("#productVendorsForm").validator('destroy');
            $("#vendorImgPrev").attr("src","");
            $("#inputProductVendorImage").val("");
        });

        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
      
    };
    function _edit(id)
    {
        $("#productVendorsModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#productVendorsForm').validator();    
        $("#action").val("edit");
        $("#inputCoverImage").removeAttr("required");
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."unioil-cms/product_vendors/get_product_vendor_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputProductVendorName").val(data.product_vendors.vendor_name);
                    $("#inputProductVendorDescription").val(data.product_vendors.vendor_description);
                    $("#productVendorsID").val(data.product_vendors.id);
                    $("#vendorImgPrev").attr("src","<?php echo base_url()."uploads/product_vendors/";?>"+data.product_vendors.vendor_image);
                    $("#inputProductVendorImage").val(data.product_vendors.vendor_image_id);
                    $("#productVendorsModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteProductVendorsModal .modal-title").html("Delete <?php echo rtrim(ucfirst($module_name),"s");?>");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteProductVendorsModal").modal("show");
    }
    
    function img_preview(img_src)
    {
        $("#imgPreview").attr("src","<?php echo base_url()."uploads/product_vendors/"?>"+img_src);
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
            "ajax" : "<?php echo base_url()."unioil-cms/media/get_media_list?module=product_vendors";?>",
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
                    new_table.draw("page");
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