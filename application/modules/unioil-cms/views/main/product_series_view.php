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
        <table id="product_seriesList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Series Name</th>
            <th>Series Image</th>
            <th>Series Title Image</th>
            <th>Product Type</th>
            <th>Vendor</th>
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

<div class="modal fade" id="productSeriesModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Product Series</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="productSeriesID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="productSeriesForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputProductSeriesName" class="col-sm-2 control-label">Series Name</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputProductSeriesName" placeholder="Series Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription" class="col-sm-2 control-label">Description</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputProductSeriesDescription" placeholder="Description" style="resize:none" required></textarea>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputProductSeriesImage" class="col-sm-2 control-label">Series Image</label>

                                <div class="col-sm-10">
                                    <center><img id="seriesImgPrev" src="#" class='img-thumbnail' style='height:100px;width:200px' onerror="this.src='<?php echo base_url()."assets/images/img_bg.png";?>'"></center>
                                    <input type="hidden" id="inputProductSeriesImage" value="">
                                    <center><a class="btn btn-info" onclick="set_image_loader('inputProductSeriesImage','seriesImgPrev');">Select from Gallery</a></center>
                                    <center><div class="help-block with-errors" id="inputProductSeriesImageError"></div></center>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputProductSeriesTitleImage" class="col-sm-2 control-label">Series Title Image</label>

                                <div class="col-sm-10">
                                    <center><img id="seriesTitleImgPrev" src="#" class='img-thumbnail' style='height:100px;width:200px' onerror="this.src='<?php echo base_url()."assets/images/img_bg.png";?>'"></center>
                                    <input type="hidden" id="inputProductSeriesTitleImage" value="">
                                    <center><a class="btn btn-info" onclick="set_image_loader('inputProductSeriesTitleImage','seriesTitleImgPrev');">Select from Gallery</a></center>
                                    <div class="help-block with-errors" id="inputProductSeriesTitleImageError"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputProductVendorID" class="col-sm-2 control-label">Vendor</label>

                                <div class="col-sm-10">
                                <select class="form-control" id="inputProductVendorID" style="resize:none" required>
                                    <option value=""></option>
                                    <?php 
                                        if($product_vendors != null){
                                            foreach($product_vendors as $row){
                                                ?>
                                                    <option value="<?php echo $row->id;?>"><?php echo ucfirst($row->vendor_name);?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputProductCategoryID" class="col-sm-2 control-label">Product Category</label>

                                <div class="col-sm-10">
                                <select class="form-control" id="inputProductCategoryID"  style="resize:none" required>
                                    <option value=""></option>
                                    <?php 
                                        if($product_categories != null){
                                            foreach($product_categories as $row){
                                                ?>
                                                    <option value="<?php echo $row->id;?>"><?php echo ucfirst($row->category_name);?></option>
                                                <?php
                                            }
                                        }
                                    ?>
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
            <button type="button" class="btn btn-primary" id="saveProductSeriess">Save Product Series</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteProductSeriessModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Product Series</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteProductSeriess">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade" id="imgTitlePreviewModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Product Series Title Image Preview</h3>
            </div>
            <div class="modal-body">
                <center><img src="" id="imgTitlePreview" style="width:100%;"></center>
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
<div class="modal fade" id="mediaGalleryModal"   role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Product Series Image Gallery</h3>
            </div>
            <div class="modal-body">
                <form id="galleryFormUpload" method="post" action="<?php echo base_url()."unioil-cms/media/add_media"?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-8">
                            <input type="hidden" id="var_holder" value="">
                            <input type="hidden" id="file_holder" value="">
                            <input type="hidden" name="module" value="product_series">
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
           
             <h3 class="modal-title">Product Series Image Preview</h3>
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
    var main = function(){
        var table = $('#product_seriesList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."unioil-cms/product_series/get_product_series_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 1 ] }
        ], "order": [[ 6, 'desc' ]]
        });
        $('select').select2(inputRoleConfig);
        $("#addBtn").click(function(){
            $("#productSeriesModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#inputProductSeriesImage").attr("required","required");
            $('#productSeriesForm').validator();
            $("#productSeriesModal").modal("show");
        });

        $("#saveProductSeriess").click(function(){
            $("#productSeriesForm").submit();
        });
        $("#productSeriesForm").validator().on('submit', function (e) {
         
            var btn = $("#saveProductSeriess");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var series_name = $("#inputProductSeriesName").val();
                var series_description = $("#inputProductSeriesDescription").val();
                var product_series_id = $("#productSeriesID").val();
                var vendor_id = $("#inputProductVendorID").val();
                var product_category_id = $("#inputProductCategoryID").val();
                if(series_name == "" || series_description == "" || vendor_id == ""|| product_category_id == "")
                {
                    btn.button("reset"); 
                    return false;
                }
                if($('#inputProductSeriesImage').val() == "")
                {
                    $("#inputProductSeriesImageError").html("<span style='color:red;'>Please fill out this field.</span>");
                    btn.button("reset"); 
                    return false;
                }else{
                    
                    $("#inputProductSeriesImageError").html("");
                }


                var formData = new FormData();
                formData.append('id', product_series_id);
                formData.append('series_name', series_name);
                formData.append('series_description', series_description);
                formData.append('vendor_id', vendor_id);
                formData.append('product_category_id', product_category_id);
                // Attach file
                formData.append('series_image', $('#inputProductSeriesImage').val());
                formData.append('series_title_image', $('#inputProductSeriesTitleImage').val());

                var url = "<?php echo base_url()."unioil-cms/product_series/add_product_series";?>";
                var message = "New product_series successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."unioil-cms/product_series/edit_product_series";?>";
                    message = "ProductSeriess successfully updated";
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
                         $("#productSeriesForm").validator('destroy');
                         $("#productSeriesModal").modal("hide"); 
                         $('#uploadBoxMain').html('');       
                    }
                });              
            }
               return false;
        });

        $("#deleteProductSeriess").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."unioil-cms/product_series/delete_product_series";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#deleteProductSeriessModal").modal("hide");
                            toastr.error('Product Series ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#productSeriesModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
                
                $("#inputProductCategoryID").val("").trigger("change");
                $("#inputProductVendorID").val("").trigger("change");
                $('#inputProductSeriesImage').val("");
                $('#inputProductSeriesTitleImage').val("");
                $('#seriesTitleImgPrev').attr("src","");
                $('#seriesImgPrev').attr("src","");
                $("#productSeriesForm").validator('destroy');
        });

        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
      
    };
    function _edit(id)
    {
        $("#productSeriesModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#productSeriesForm').validator();    
        $("#action").val("edit");
        $("#inputProductSeriesImage").removeAttr("required");
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."unioil-cms/product_series/get_product_series_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputProductSeriesName").val(data.product_series.series_name);
                    $("#inputProductSeriesDescription").val(data.product_series.series_description);
                    $("#productSeriesID").val(data.product_series.id);
                    $("#inputProductCategoryID").val(data.product_series.product_category_id).trigger("change");
                    $("#inputProductVendorID").val(data.product_series.vendor_id).trigger("change");
                    
                    $('#inputProductSeriesImage').val(data.product_series.series_image_id);
                    $('#inputProductSeriesTitleImage').val(data.product_series.series_title_image_id);
                    $('#seriesTitleImgPrev').attr("src","<?php echo base_url()."uploads/product_series/";?>"+data.product_series.series_title_image);
                    $('#seriesImgPrev').attr("src","<?php echo base_url()."uploads/product_series/";?>"+data.product_series.series_image);

                    $("#productSeriesModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteProductSeriessModal .modal-title").html("Delete Product Series");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteProductSeriessModal").modal("show");
    }
    
    function img_preview(img_src)
    {
        $("#imgPreview").attr("src","<?php echo base_url()."uploads/product_series/"?>"+img_src);
        $("#imgPreviewModal").modal("show");
    }
    function img_title_preview(img_src)
    {
        $("#imgTitlePreview").attr("src","<?php echo base_url()."uploads/product_series/"?>"+img_src);
        $("#imgTitlePreviewModal").modal("show");
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
            "ajax" : "<?php echo base_url()."unioil-cms/media/get_media_list?module=product_series";?>",
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