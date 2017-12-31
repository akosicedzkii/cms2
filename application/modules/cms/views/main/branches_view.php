<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo ucwords(str_replace("_"," ",$module_name));?>
    <small>Management</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo ucwords(str_replace("_"," ",$module_name));?></li>
    </ol>
</section>
<button class="btn btn-success btn-circle btn-lg fix-btn" id="addBtn"  data-toggle="tooltip" title="Add New">
    <span class="glyphicon glyphicon-plus"></span>
</button>
<!-- Main content -->
<section class="content">
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucwords(str_replace("_"," ",$module_name));?> List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="branchList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Branch Name</th>
            <th>Details</th>
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

<div class="modal fade" id="branchModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Branch</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="branchID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="branchForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputBranchName" class="col-sm-2 control-label">Branch Name</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputBranchName" placeholder="Branch Name" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputDetails" class="col-sm-2 control-label">Details</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputDetails" placeholder="Details" style="resize:none" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                             </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveBranch">Save Branch</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteBranchModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Branch</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
                <center><h5>* Note: Station and Gas Prices will also be deleted</h5></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteBranch">Delete</button>
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
        var table = $('#branchList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."cms/branches/get_branches_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] }
        ]
        });
        $("#addBtn").click(function(){
            $("#branchModal .modal-title").html("Add <?php echo ucwords(str_replace("_"," ",$module_name));?>");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
            $('#branchForm').validator();
            $("#branchModal").modal("show");
        });

        $("#saveBranch").click(function(){
            $("#branchForm").submit();
        });
        $("#branchForm").validator().on('submit', function (e) {
           
            var btn = $("#saveBranch");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var branch_name = $("#inputBranchName").val();
                var details = $("#inputDetails").val();
                var id = $("#branchID").val();
                var data = {
                    "id" : id,
                    "branch_name" : branch_name,
                    "details" : details
                }

                var url = "<?php echo base_url()."cms/branches/add_branch";?>";
                var message = "New branch successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."cms/branches/edit_branch";?>";
                    message = "Branch successfully updated";
                }
                $.ajax({
                        data: data,
                        type: "post",
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
                                $("#branchForm").validator('destroy');
                                $("#branchModal").modal("hide");     
                            }
                           
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
            }
               return false;
        });

        $("#deleteBranch").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."cms/branches/delete_branch";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw();
                            $("#deleteBranchModal").modal("hide");
                            toastr.error('Branch ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#branchModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $("#branchForm").validator('destroy');
        });

        $('#inputBranch').select2(inputRoleConfig);
        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
      
    };
    function _edit(id)
    {
        $("#branchModal .modal-title").html("Edit <?php echo ucwords(str_replace("_"," ",$module_name));?>");
        $('#branchForm').validator();    
        $("#action").val("edit");
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."cms/branches/get_branches_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    console.log(data);
                    $("#inputBranchName").val(data.branches.branch_name);
                    $("#inputDetails").val(data.branches.details);
                    $("#branchID").val(data.branches.id);
                    $("#branchModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteBranchModal .modal-title").html("Delete <?php echo rtrim(ucwords(str_replace("_"," ",$module_name)),"s");?>");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteBranchModal").modal("show");
    }
    $(document).ready(main);
</script>