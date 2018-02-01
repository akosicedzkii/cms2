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

<div class="modal fade" id="productSeriesModal">
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
                                <input type="file" class="form-control" id="inputProductSeriesImage" placeholder="Series Image" style="resize:none" required>
                                <div class="help-block with-errors" id="coverError"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputProductSeriesTitleImage" class="col-sm-2 control-label">Series Title Image</label>

                                <div class="col-sm-10">
                                <input type="file" class="form-control" id="inputProductSeriesTitleImage" placeholder="Series Title Image" style="resize:none" required>
                                <div class="help-block with-errors" id="coverError"></div>
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
<div class="modal fade" id="deleteProductSeriessModal">
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
<div class="modal fade" id="imgPreviewModal">
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
<div class="modal fade" id="imgTitlePreviewModal">
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
            "ajax" : "<?php echo base_url()."cms/product_series/get_product_series_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 1 ] }
        ]
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

                var formData = new FormData();
                formData.append('id', product_series_id);
                formData.append('series_name', series_name);
                formData.append('series_description', series_description);
                formData.append('vendor_id', vendor_id);
                formData.append('product_category_id', product_category_id);
                // Attach file
                formData.append('series_image', $('#inputProductSeriesImage').prop("files")[0]);
                formData.append('series_title_image', $('#inputProductSeriesTitleImage').prop("files")[0]);

              /*   var fileUpload = document.getElementById("inputProductSeriesImage");
                
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
                                    var url = "<?php echo base_url()."cms/product_series/add_product_series";?>";
                                    var message = "New product_series successfully added";
                                    if(action == "edit")
                                    {
                                        url =  "<?php echo base_url()."cms/product_series/edit_product_series";?>";
                                        message = "ProductSeriess successfully updated";
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
                                                    $("#productSeriesForm").validator('destroy');
                                                    $("#productSeriesModal").modal("hide");     
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

        $("#deleteProductSeriess").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."cms/product_series/delete_product_series";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw();
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
            $("#inputStatus").val('1').trigger('change');
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
                url: "<?php echo base_url()."cms/product_series/get_product_series_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputProductSeriesName").val(data.product_series.series_name);
                    $("#inputProductSeriesDescription").val(data.product_series.series_description);
                    $("#productSeriesID").val(data.product_series.id);
                    $("#inputProductCategoryID").val(data.product_series.product_category_id).trigger("change");
                    $("#inputProductVendorID").val(data.product_series.vendor_id).trigger("change");
                    $("#productSeriesModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteProductSeriessModal .modal-title").html("Delete <?php echo rtrim(ucfirst($module_name),"s");?>");
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
    $(document).ready(main);
</script>