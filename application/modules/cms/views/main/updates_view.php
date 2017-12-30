<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucfirst($module_name);?> List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="updatesList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
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

<div class="modal fade" id="updatesModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Updates</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="updatesID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="updatesForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputUpdatesTitle" class="col-sm-2 control-label">Title</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputUpdatesTitle" placeholder="Title" required>
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
                                <label for="inputCoverImage" class="col-sm-2 control-label">Cover Image</label>

                                <div class="col-sm-10">
                                <input type="file" class="form-control" id="inputCoverImage" placeholder="Cover Image" style="resize:none" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

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

                        </div>
                    </form>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveUpdates">Save Updates</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteUpdatesModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Updates</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteUpdates">Delete</button>
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
        var table = $('#updatesList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."cms/updates/get_updates_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] }
        ]
        });
        $("#addBtn").click(function(){
            $("#updatesModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
            $('#updatesForm').validator();
            $("#updatesModal").modal("show");
        });

        $("#saveUpdates").click(function(){
            $("#updatesForm").submit();
        });
        $("#updatesForm").validator().on('submit', function (e) {
           
            var btn = $("#saveUpdates");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var title = $("#inputUpdatesTitle").val();
                var description = $("#inputDescription").val();
                var content = editor.getData();;
                var status = $("#inputStatus").val();
                var updates_id = $("#updatesID").val();

                var formData = new FormData();
                formData.append('id', updates_id);
                formData.append('title', title);
                formData.append('description', description);
                formData.append('content', content);
                formData.append('status', status);
                // Attach file
                formData.append('cover_image', $('#inputCoverImage').prop("files")[0]);
                var messageLength = content.replace(/<[^>]*>/gi, '').trim().length;

                if( !messageLength ) {
                    $("#ckEditorError").html("<span style='color:red;'>Please fill out this field.</span>");
                    btn.button("reset"); 
                    return false;
                }

                var url = "<?php echo base_url()."cms/updates/add_updates";?>";
                var message = "New updates successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."cms/updates/edit_updates";?>";
                    message = "Updates successfully updated";
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
                                editor.setData('');
                                $("#updatesForm").validator('destroy');
                                $("#updatesModal").modal("hide");     
                            }
                           
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
            }
               return false;
        });

        $("#deleteUpdates").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."cms/updates/delete_updates";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw();
                            $("#deleteUpdatesModal").modal("hide");
                            toastr.error('Updates ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#updatesModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            editor.setData("");
            $("#inputStatus").val('1').trigger('change');
            $("#updatesForm").validator('destroy');
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
        $("#updatesModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#updatesForm').validator();    
        $("#action").val("edit");
        $("#inputCoverImage").removeAttr("required");
        $("#inputUpdatesname").attr("data-remote","<?php echo base_url()."updates/check_updatesname_exist?method=edit&updates_id=";?>" + id);
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."updates/get_updates_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputUpdatesTitle").val(data.updates.title);
                    $("#inputDescription").val(data.updates.description);
                    editor.setData(data.updates.content);
                    $("#inputStatus").val(data.updates.status).trigger('change');
                    $("#updatesID").val(data.updates.id);
                    $("#updatesModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteUpdatesModal .modal-title").html("Delete <?php echo rtrim(ucfirst($module_name),"s");?>");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteUpdatesModal").modal("show");
    }
    $(document).ready(main);
</script>