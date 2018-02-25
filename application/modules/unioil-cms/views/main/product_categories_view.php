<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<?php $module_name = ucwords(str_replace("_"," ",$module_name));?>
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
        <table id="productCategoryList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Product Category</th>
            <th>Description</th>
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

<div class="modal fade" id="productCategoryModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Product Category</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="productCategoryID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="productCategoryForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputProductCategoryName" class="col-sm-2 control-label">Category Name</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputProductCategoryName" placeholder="Category Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputProductCategoryDescription" class="col-sm-2 control-label">Category Description</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputProductCategoryDescription" placeholder="Category Description" style="resize:none" required></textarea>
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
            <button type="button" class="btn btn-primary" id="saveProductCategory">Save Product Category</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteProductCategoryModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Product Category</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteProductCategory">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>

    var main = function(){
        var table = $('#productCategoryList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."unioil-cms/product_categories/get_product_category_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 1 ] }
        ], "order": [[ 3, 'desc' ]]
        });
        $("#addBtn").click(function(){
            $("#productCategoryModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
            $('#productCategoryForm').validator();
            $("#productCategoryModal").modal("show");
        });

        $("#saveProductCategory").click(function(){
            $("#productCategoryForm").submit();
        });
        $("#productCategoryForm").validator().on('submit', function (e) {
           
            var btn = $("#saveProductCategory");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var category_name = $("#inputProductCategoryName").val();
                var category_description = $("#inputProductCategoryDescription").val();
                var productCategory_id = $("#productCategoryID").val();
                if(category_name == "" || category_description == "")
                {
                    btn.button("reset"); 
                    return false;
                }
                var data = {
                    'id':productCategory_id,
                    "category_name" : category_name,
                    "category_description" : category_description
                };
               
                var url = "<?php echo base_url()."unioil-cms/product_categories/add_product_category";?>";
                var message = "New Product Category successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."unioil-cms/product_categories/edit_product_category";?>";
                    message = "Product Category successfully updated";
                }
                $('#uploadBoxMain').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBarMain" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
                $.ajax({
                    data: data,
                    type: "post",
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
                
                        $("#productCategoryForm").validator('destroy');
                        $("#productCategoryModal").modal("hide");     
                        $('#uploadBoxMain').html('');   
                    }
                }); 
            }              
               return false;
        });

        $("#deleteProductCategory").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."unioil-cms/product_categories/delete_product_category";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw();
                            $("#deleteProductCategoryModal").modal("hide");
                            toastr.error('Product Category ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#productCategoryModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $("#inputStatus").val('1').trigger('change');
            $("#productCategoryForm").validator('destroy');
        });

        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
      
    };
    function _edit(id)
    {
        $("#productCategoryModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#productCategoryForm').validator();    
        $("#action").val("edit");
        $("#inputCoverImage").removeAttr("required");
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."unioil-cms/product_categories/get_product_category_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputProductCategoryName").val(data.product_category.category_name);
                    $("#inputProductCategoryDescription").val(data.product_category.category_description);
                    $("#productCategoryID").val(data.product_category.id);
                    $("#productCategoryModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteProductCategoryModal .modal-title").html("Delete Category");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteProductCategoryModal").modal("show");
    }
    
    $(document).ready(main);
</script>