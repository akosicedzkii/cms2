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
        <table id="productsList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Product Sub Image</th>
            <th>Product Type</th>
            <th>Product Series</th>
            <th>Vendor</th>
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

<div class="modal fade" id="productModal"   role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Product</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="productID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="productForm" data-toggle="validator">
                        <div class="box-body">
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
                                    <label for="inputProductSeriesID" class="col-sm-2 control-label">Product Series</label>

                                    <div class="col-sm-10">
                                    <select class="form-control" id="inputProductSeriesID"  style="resize:none">
                                        <option value=""></option>
                                    
                                    </select>
                                    <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            
                                <div class="form-group visibility">
                                    <label for="inputVisibility" class="col-sm-2 control-label">Visibility</label>

                                    <div class="col-sm-10">
                                    <select class="form-control" id="inputVisibility"  style="resize:none">
                                        <option value="promotion_only">Promotion</option>
                                        <option value="price_only">Price</option>
                                        <!--<option value="price_and_promotion">Price And Promotion</option>-->
                                    </select>
                                    <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            <div class="form-group">
                                <label for="inputProductName" class="col-sm-2 control-label">Product Name</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputProductName" placeholder="Product Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription" class="col-sm-2 control-label">Description</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputProductDescription" placeholder="Description" required></textarea>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group specification">
                                <label for="inputSpecification" class="col-sm-2 control-label">Specification</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputSpecification" placeholder="Specification"></textarea>
                                <div class="help-block with-errors" id="ckEditorError"></div>
                                </div>
                            </div>

                            <div class="form-group product_image">
                                <label for="inputProductImage" id="lblImage" class="col-sm-2 control-label">Product Image</label>

                                <div class="col-sm-10">
                                <center><img id="prodImgPrev" src="#" class='img-thumbnail' style='height:100px;width:200px' onerror="this.src='<?php echo base_url()."assets/images/img_bg.png";?>'"><center>
                                <input type="hidden" id="inputProductImage" value="">
                                <a class="btn btn-info" onclick="set_image_loader('inputProductImage','prodImgPrev');">Select from Gallery</a>
                                
                                <!--<input type="file" class="form-control" id="inputProductImage" placeholder="Product Image" style="resize:none">-->
                                <div class="help-block with-errors" id="productImageError"></div>
                                </div>
                            </div>

                            <div class="form-group product_sub_image">
                                <label for="inputProductSubImage" class="col-sm-2 control-label">Product Sub Image(For Fuels)(Recommended Size: 399x206)</label>

                                <div class="col-sm-10"> 
                                <center><img id="prodSubImgPrev" src="#" class='img-thumbnail' style='height:100px;width:200px' onerror="this.src='<?php echo base_url()."assets/images/img_bg.png";?>'"><center>
                                <input type="hidden" id="inputProductSubImage" value="">
                                <a class="btn btn-info" onclick="set_image_loader('inputProductSubImage','prodSubImgPrev');">Select from Gallery</a>
                                <div class="help-block with-errors" id="productSubImageError"></div>
                                </div>
                            </div>

                            <div class="form-group pdf">
                                <label for="inputProductPdf" class="col-sm-2 control-label">PDS/PDF file</label>

                                <div class="col-sm-10">
                                <input type="file" class="form-control" id="inputProductPdf" placeholder="PDS/PDF file" style="resize:none" accept=".pdf">
                                <div class="help-block with-errors" id="pdsError"></div>
                                </div>
                            </div>

                            <div class="form-group mds">
                                <label for="inputProductMds" class="col-sm-2 control-label">MDS file</label>

                                <div class="col-sm-10">
                                <input type="file" class="form-control" id="inputProductMds" placeholder="MDS file" style="resize:none" accept=".pdf">
                                <div class="help-block with-errors" id="mdsError"></div>
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
            <button type="button" class="btn btn-primary" id="saveProducts">Save Product</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteProductsModal"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Product</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteProducts">Delete</button>
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
           
             <h3 class="modal-title">Product Image Gallery</h3>
            </div>
            <div class="modal-body">
                <form id="galleryFormUpload" method="post" action="<?php echo base_url()."cms/media/add_media"?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-8">
                            <input type="hidden" id="var_holder" value="">
                            <input type="hidden" id="file_holder" value="">
                            <input type="hidden" name="module" value="products">
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
           
             <h3 class="modal-title">Product Image Preview</h3>
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

   
    $('#inputStatus').select2(inputRoleConfig);
    var editor = CKEDITOR.replace('inputSpecification');
    var main = function(){
        var table = $('#productsList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."cms/products/get_products_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] }
        ], "order": [[ 8, 'desc' ]]
        });
        
        $('#inputProductCategoryID,#inputProductVendorID').select2(inputRoleConfig);
        $('#inputProductCategoryID,#inputProductVendorID').on('change', function() {
            check_series();

            $("#inputProductMds").removeAttr("required");
            $("#inputProductPdf").removeAttr("required");
            if($("#inputProductCategoryID").val() == "1")
            {
                $("#inputVisibility").change();
                $(".visibility").show();
                $(".specification").show();
                $(".product_image").show();
                $("#lblImage").html("Product Image(Recommended Size: 846x203)");
                $(".product_sub_image").show();
                $(".mds").hide();
            }
            else if($("#inputProductCategoryID").val() == "2")
            {
                $(".visibility").hide();
                $(".specification").show();
                $(".product_image").show();
                $("#lblImage").html("Product Image(Recommended Size: 450x450)");
                $(".product_sub_image").hide();
                $(".pdf").show();
                $(".mds").show();
                var action = $("#action").val();
                if(action == "edit")
                {
                    $("#inputProductMds").removeAttr("required");
                    $("#inputProductPdf").removeAttr("required");
                }
                else
                {
                    $("#inputProductPdf").attr("required","required");
                    $("#inputProductMds").attr("required","required");
                }
            }
            else if($("#inputProductCategoryID").val() == "3")
            {
                $(".visibility").hide();
                $(".specification").show();
                $(".product_image").hide();
                $(".product_sub_image").hide();
                $(".pdf").hide();
                $(".mds").hide();
            } 
            

        });
        
        $("#inputVisibility").change(function(){
            if($("#inputProductCategoryID").val() == "1")
            {
                if($("#inputVisibility").val() != "promotion_only")
                {
                    $(".specification").hide();
                    $(".product_image").hide();
                    $(".product_sub_image").hide();
                    $(".pdf").hide();
                    $("#inputProductPdf").removeAttr("required");
                }
                else
                { 
                    $(".specification").show();
                    $(".product_image").show();
                    $(".product_sub_image").show();
                    $(".pdf").show();
                    var action = $("#action").val();
                    if(action == "edit")
                    {
                        $("#inputProductPdf").removeAttr("required");
                    }
                    else
                    {
                        $("#inputProductPdf").attr("required","required");
                    }
                }
            }
        });
        
        
        check_series();
        $("#addBtn").click(function(){
            $("#productModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            
            $(".visibility").hide();

            $(".specification").hide();
            $(".product_image").hide();
            $(".product_sub_image").hide();
            $(".pdf").hide();
            $(".mds").hide();

            $("#inputProductImage").val("");
            $("#inputProductSubImage").val("");
            $("#prodImgPrev").attr("src","#");
            $("#prodSubImgPrev").attr("src","#");
            $('#productForm').validator();
            $("#productModal").modal("show");
        });

        $("#saveProducts").click(function(){
            $("#productForm").submit();
        });
        $('#inputProductSeriesID').select2({
            dropdownAutoWidth : true,
            width: 'auto',
            placeholder: "--- Select Item ---"
        });

        $('#inputVisibility').select2({
            dropdownAutoWidth : true,
            width: 'auto',
            placeholder: "--- Select Item ---"
        });
        $("#productForm").validator().on('submit', function (e) {
          
            var btn = $("#saveProducts");
            var action = $("#action").val();
           
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var product_name = $("#inputProductName").val();
                var product_description = $("#inputProductDescription").val();
                var products_id = $("#productID").val();
                var vendor_id = $("#inputProductVendorID").val();
                var specification = editor.getData();
                var product_category_id = $("#inputProductCategoryID").val();
                var product_series_id = $("#inputProductSeriesID").val();
                var visibility = $("#inputVisibility").val();
                var status = $("#inputStatus").val();
                if(product_name == "" || product_description == "" || vendor_id == "" || product_category_id == "")
                {
                    btn.button("reset"); 
                    return false;
                }
                var formData = new FormData();
                formData.append('id', products_id);
                formData.append('product_name', product_name);
                formData.append('product_description', product_description);
                formData.append('vendor_id', vendor_id);
                formData.append('product_category_id', product_category_id);
                formData.append('product_series_id', product_series_id);
                    formData.append('status', status);
                if($("#inputProductCategoryID").val() == "1")
                {
                    formData.append('specification', specification);
                    formData.append('visibility', visibility);
                    // Attach file
                    formData.append('product_image', $('#inputProductImage').val());
                    formData.append('product_sub_image', $('#inputProductSubImage').val());
                    formData.append('pdf', $('#inputProductPdf').prop("files")[0]);
                }
                else if($("#inputProductCategoryID").val() == "2")
                {
                    formData.append('specification', specification);
                    formData.append('vendor_id', vendor_id);
                    // Attach file
                    formData.append('product_image', $('#inputProductImage').val());
                    formData.append('pdf', $('#inputProductPdf').prop("files")[0]);
                    formData.append('mds', $('#inputProductMds').prop("files")[0]);
                }
                else if($("#inputProductCategoryID").val() == "3")
                {
                    formData.append('specification', specification);
                    formData.append('vendor_id', vendor_id);
                    // Attach file
                } 

                var messageLength = specification.replace(/<[^>]*>/gi, '').trim().length;
                if( !messageLength && ( $(".specification").css('display') != 'none')) {
                    $("#ckEditorError").html("<span style='color:red;'>Please fill out this field.</span>");
                    btn.button("reset"); 
                    return false;
                }
                if( $(".product_image").css('display') != 'none' && $("#inputProductImage").val() == "")
                {
                    $("#productImageError").html("<span style='color:red;'>Please fill out this field.</span>");
                    btn.button("reset"); 
                    return false;
                }
                else
                {

                    var img = document.getElementById('prodImgPrev'); 
                    //or however you get a handle to the IMG
                    var width = img.naturalWidth;
                    var height = img.naturalHeight;
                    if($("#inputProductCategoryID").val() == "1")
                    {
                        if(width != "846" || height != "203")
                        {                  
                            img_error = "<span style='color:red;'>Invalid cover size use 846x203</span>";   
                            btn.button("reset");
                            $("#productImageError").html(img_error);
                            return false;
                        }
                        else
                        {
                            $("#productImageError").html("");  
                        }
                    }
                    else if($("#inputProductCategoryID").val() == "2")
                    {  
                        if(width != "450" || height != "450")
                        {                  
                            img_error = "<span style='color:red;'>Invalid cover size use 450x450</span>";   
                            btn.button("reset");
                            $("#productImageError").html(img_error);
                            return false;
                        }
                        else
                        {
                            $("#productImageError").html("");  
                        }
                    }

                }
                
                if( $(".product_sub_image").css('display') != 'none'  && $("#inputProductSubImage").val() == "")
                {
                    
                    $("#productSubImageError").html("<span style='color:red;'>Please fill out this field.</span>");
                    btn.button("reset"); 
                    return false;
                }
                else
                {
                    if($("#inputProductCategoryID").val() == "1")
                    {
                        img = document.getElementById('prodSubImgPrev');  
                        width = img.naturalWidth;
                        height = img.naturalHeight;
                        if(width != "399" || height != "206")
                        {                  
                            img_error = "<span style='color:red;'>Invalid cover size use 399x206</span>";   
                            btn.button("reset");
                            $("#productSubImageError").html(img_error);
                            return false;
                        }
                        else
                        {
                            $("#productImageError").html("");  
                        }
                    }
                }

                var url = "<?php echo base_url()."cms/products/add_products";?>";
                var message = "New products successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."cms/products/edit_products";?>";
                    message = "Products successfully updated";
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
                        $('#uploadBoxMain').html('<div id="progressOverlay"><div class="progress progress-striped"><div class="bar" id="progressBar" style="width: 0%;">0%</div></div></div>');       

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
                        $("#productForm").validator('destroy');
                        $('#uploadBoxMain').html('');       
                        $("#productModal").modal("hide"); 
                    }
                });
            }
               return false;
        });

        $("#deleteProducts").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."cms/products/delete_products";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#deleteProductsModal").modal("hide");
                            toastr.error('Product ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#productModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
                editor.setData('');
            $("#inputProductCategoryID,#inputProductVendorID,#inputProductCategoryID,#inputProductSeriesID").val('').trigger('change');
            $("#inputVisibility").val("promotion_only");
            $("#productForm").validator('destroy');
            $("#inputStatus").val('1').trigger("change");
        });

        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
      
      
    };
    
    function _edit(id)
    {
        $("#productModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#productForm').validator();    
        $("#action").val("edit");
        
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."cms/products/get_products_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputProductName").val(data.products.product_name);
                    $("#inputProductDescription").val(data.products.product_description);
                    $("#inputProductImage").val(data.products.product_image_id);
                    $("#inputProductSubImage").val(data.products.product_sub_image_id);
                    editor.setData(data.products.specification);
                    $("#productID").val(data.products.id);
                    $("#prodImgPrev").attr("src","<?php echo base_url()."uploads/products/";?>"+data.products.product_image);
                    $("#prodSubImgPrev").attr("src","<?php echo base_url()."uploads/products/";?>"+data.products.product_sub_image);
                    $("#inputProductCategoryID").val(data.products.product_category_id).trigger("change");
                    $("#inputVisibility").val(data.products.visibility).trigger("change");
                    $("#inputProductVendorID").val(data.products.product_vendor_id).trigger("change");
                    $("#inputStatus").val(data.products.status).trigger("change");
                    setTimeout(set_series(data.products.product_series_id), 1000);
                    $("#productModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }

    function _delete(id,item)
    {
        $("#deleteProductsModal .modal-title").html("Delete <?php echo rtrim(ucfirst($module_name),"s");?>");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteProductsModal").modal("show");
    }
    
    function img_preview(img_src)
    {
        $("#imgPreview").attr("src","<?php echo base_url()."uploads/products/"?>"+img_src);
        $("#imgPreviewModal").modal("show");
    }

    function check_series()
    {
        if($("#inputProductCategoryID").val() == "" || $("#inputProductVendorID").val() == "")
        {
            $("#inputProductSeriesID").attr("disabled","disabled");
        }
        else
        {
            var vendor_id = $("#inputProductVendorID").val();
            var product_category_id = $("#inputProductCategoryID").val()
            var data = {"vendor_id" : vendor_id , "product_category_id": product_category_id};
            $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."cms/products/get_product_series";?>",
                success: function(data){
                    $("#inputProductSeriesID").html(data);
                    $("#inputProductSeriesID").removeAttr("disabled");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
            });
        }
    }
    function set_series(id)
    { 
        if($("#inputProductCategoryID").val() == "" || $("#inputProductVendorID").val() == "")
        {
            $("#inputProductSeriesID").attr("disabled","disabled");
        }
        else
        {
            var vendor_id = $("#inputProductVendorID").val();
            var product_category_id = $("#inputProductCategoryID").val()
            var data = {"vendor_id" : vendor_id , "product_category_id": product_category_id};
            $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."cms/products/get_product_series";?>",
                success: function(data){
                    $("#inputProductSeriesID").html(data);
                    $("#inputProductSeriesID").removeAttr("disabled");
                    if(id == undefined || id == "")
                    {
                        id = "None";
                    }
                    $("#inputProductSeriesID").val(id).trigger("change");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
            });
        }
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
            "ajax" : "<?php echo base_url()."cms/media/get_media_list?module=products";?>",
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
                url: "<?php echo base_url()."cms/media/delete_media";?>",
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