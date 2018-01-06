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

<div class="modal fade" id="productVendorsModal">
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
                                <label for="inputDescription" class="col-sm-2 control-label">Description</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputProductVendorDescription" placeholder="Description" style="resize:none" required></textarea>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputProductVendorImage" class="col-sm-2 control-label">Vendor Image (Recommended Size: 570x267)</label>

                                <div class="col-sm-10">
                                <input type="file" class="form-control" id="inputProductVendorImage" placeholder="Vendor Image" style="resize:none" required>
                                <div class="help-block with-errors" id="coverError"></div>
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
<div class="modal fade" id="deleteProductVendorsModal">
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
<div class="modal fade" id="imgPreviewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Product Vendors Image Preview</h3>
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

    var main = function(){
        var table = $('#product_vendorsList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."cms/product_vendors/get_product_vendors_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 1 ] }
        ]
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

                var formData = new FormData();
                formData.append('id', product_vendor_id);
                formData.append('vendor_name', vendor_name);
                formData.append('vendor_description', vendor_description);
                // Attach file
                formData.append('vendor_image', $('#inputProductVendorImage').prop("files")[0]);

                var fileUpload = document.getElementById("inputProductVendorImage");
                
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
                                {
                                    var url = "<?php echo base_url()."cms/product_vendors/add_product_vendors";?>";
                                    var message = "New product_vendors successfully added";
                                    if(action == "edit")
                                    {
                                        url =  "<?php echo base_url()."cms/product_vendors/edit_product_vendors";?>";
                                        message = "ProductVendors successfully updated";
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
                                                    $("#productVendorsForm").validator('destroy');
                                                    $("#productVendorsModal").modal("hide");     
                                                }
                                            
                                            },
                                            error: function (request, status, error) {
                                                alert(request.responseText);
                                            }
                                    });
                                }
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
                }
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
                        url: "<?php echo base_url()."cms/product_vendors/delete_product_vendors";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw();
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
            editor.setData("");
            $("#inputStatus").val('1').trigger('change');
            $("#productVendorsForm").validator('destroy');
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
                url: "<?php echo base_url()."cms/product_vendors/get_product_vendor_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputProductVendorName").val(data.product_vendors.vendor_name);
                    $("#inputProductVendorDescription").val(data.product_vendors.vendor_description);
                    $("#productVendorsID").val(data.product_vendors.id);
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
    $(document).ready(main);
</script>