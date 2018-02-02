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
            <th>Visibility</th>
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

<div class="modal fade" id="productModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Product Product</h3>
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
                            
                                <div class="form-group">
                                    <label for="inputVisibility" class="col-sm-2 control-label">Visibility</label>

                                    <div class="col-sm-10">
                                    <select class="form-control" id="inputVisibility"  style="resize:none" required>
                                        <option value="promotion_only">Promotion Only</option>
                                        <option value="price_only">Price Only</option>
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
                            <div class="form-group promotion">
                                <label for="inputSpecification" class="col-sm-2 control-label">Specification</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputSpecification" placeholder="Specification" required></textarea>
                                <div class="help-block with-errors" id="ckEditorError"></div>
                                </div>
                            </div>

                            <div class="form-group promotion">
                                <label for="inputProductImage" class="col-sm-2 control-label">Product Image</label>

                                <div class="col-sm-10">
                                <center><img  id="prodImgPrev" class='img-thumbnail' style='height:300px;'><center>
                                <input type="file" class="form-control" id="inputProductImage" placeholder="Product Image" style="resize:none">
                                <div class="help-block with-errors" id="coverError"></div>
                                </div>
                            </div>

                            <div class="form-group promotion">
                                <label for="inputProductSubImage" class="col-sm-2 control-label">Product Sub Image(For Fuels)</label>

                                <div class="col-sm-10"> 
                                <center><img  id="prodSubImgPrev" class='img-thumbnail' style='height:300px;'><center>
                                <input type="file" class="form-control" id="inputProductSubImage" placeholder="Product Sub Image" style="resize:none">
                                <div class="help-block with-errors" id="coverError"></div>
                                </div>
                            </div>

                            <div class="form-group promotion lubricant">
                                <label for="inputProductPdf" class="col-sm-2 control-label">PDF file</label>

                                <div class="col-sm-10">
                                <input type="file" class="form-control" id="inputProductPdf" placeholder="PDF file" style="resize:none" accept=".pdf">
                                <div class="help-block with-errors" id="pdfError"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveProducts">Save Product Product</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteProductsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Product Product</h3>
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
<div class="modal fade" id="imgPreviewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Product Product Image Preview</h3>
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
            { "visible": false,  "targets": [ 0 ] },
            { "width": "15%",  "targets": [ 1 ] }
        ], "order": [[ 8, 'desc' ]]
        });
        
        $('#inputProductCategoryID,#inputProductVendorID').select2(inputRoleConfig);
        $('#inputProductCategoryID').on('change', function() {
            check_series();
            if($("#inputProductCategoryID").val() != "2")
            {
                $(".lubricant").hide();
            }
            else
            {
                $(".lubricant").show();
            }
        });
        $('#inputProductVendorID').on('change', function() {
            check_series();
        })
        
        check_series();
        $("#addBtn").click(function(){
            $("#productModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
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

                var formData = new FormData();
                formData.append('id', products_id);
                formData.append('product_name', product_name);
                formData.append('specification', specification);
                formData.append('product_description', product_description);
                formData.append('vendor_id', vendor_id);
                formData.append('product_category_id', product_category_id);
                formData.append('product_series_id', product_series_id);
                formData.append('visibility', visibility);
                // Attach file
                formData.append('product_image', $('#inputProductImage').prop("files")[0]);
                formData.append('product_sub_image', $('#inputProductSubImage').prop("files")[0]);
                formData.append('pdf', $('#inputProductPdf').prop("files")[0]);
                var messageLength = specification.replace(/<[^>]*>/gi, '').trim().length;

                if( !messageLength ) {
                    $("#ckEditorError").html("<span style='color:red;'>Please fill out this field.</span>");
                    btn.button("reset"); 
                    return false;
                }
              /*   var fileUpload = document.getElementById("inputProductImage");
                
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
                                if(this.width != "570" || this.height != "267")
                                {
                                    $("#coverError").html("<span style='color:red;'>Invalid cover size use 570x267</span>");                    
                                    btn.button("reset"); 
                                    return false;
                                }
                                else
                                { */
                                    var url = "<?php echo base_url()."cms/products/add_products";?>";
                                    var message = "New products successfully added";
                                    if(action == "edit")
                                    {
                                        url =  "<?php echo base_url()."cms/products/edit_products";?>";
                                        message = "Products successfully updated";
                                    }
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
                                                    $("#productForm").validator('destroy');
                                                    $("#productModal").modal("hide");     
                                                }
                                            
                                            },
                                            error: function (request, status, error) {
                                                alert(request.responseText);
                                            }
                                    });
                                /* }
                            };

                        }
                    } else {
                        alert("This browser does not support HTML5.");
                        btn.button("reset"); 
                        return false;
                    }
                } else {
                    alert("Please select a valid Image file.");
                    btn.button("reset"); 
                    return false;
                } */
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
                            table.draw();
                            $("#deleteProductsModal").modal("hide");
                            toastr.error('Product Product ' + deleteItem + ' successfully deleted');
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
            $("#inputProductCategoryID,#inputProductVendorID,#inputProductCategoryID,#inputProductSeriesID,#inputVisibility").val('').trigger('change');
            $("#productForm").validator('destroy');
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
        $("#inputProductImage").removeAttr("required");
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."cms/products/get_products_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputProductName").val(data.products.product_name);
                    $("#inputProductDescription").val(data.products.product_description);
                    editor.setData(data.products.specification);
                    $("#productID").val(data.products.id);
                    if(data.products.product_image != null)
                    {
                        $("#prodImgPrev").show();
                        $("#prodImgPrev").attr("src","<?php echo base_url()."uploads/products/";?>"+data.products.product_image);
                    }
                    else
                    {
                        $("#prodImgPrev").hide();
                    }
                    if(data.products.product_sub_image != null)
                    {
                        $("#prodSubImgPrev").show();
                        $("#prodSubImgPrev").attr("src","<?php echo base_url()."uploads/products/";?>"+data.products.product_sub_image);
                    }
                    else
                    {
                        $("#prodSubImgPrev").hide();
                    }
                    $("#inputProductCategoryID").val(data.products.product_category_id).trigger("change");
                    $("#inputVisibility").val(data.products.visibility).trigger("change");
                    $("#inputProductVendorID").val(data.products.product_vendor_id).trigger("change");
                    set_series(data.products.product_series_id);
                    $("#productModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    $("#inputVisibility").change(function(){
        if($("#inputVisibility").val() != "promotion_only")
        {
            $(".promotion").hide();
        }
        else
        {
            $(".promotion").show();
        }
    });


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
        console.log(id);
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
    $(document).ready(main);
</script>