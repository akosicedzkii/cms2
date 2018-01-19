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
        <table id="careerList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Career</th>
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

<div class="modal fade" id="careerModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Career</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="careerID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="careerForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputCareerTitle" class="col-sm-2 control-label">Job title</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputCareerTitle" placeholder="Job title" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCareerDescription" class="col-sm-2 control-label">Category Description</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputCareerDescription" placeholder="Category Description" style="resize:none" required></textarea>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveCareer">Save Career</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteCareerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Career</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteCareer">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>

    var editor = CKEDITOR.replace('inputCareerDescription');
    var main = function(){
        /*var table = $('#careerList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."cms/loyalty/get_career_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 1 ] }
        ]
        });*/
        $("#addBtn").click(function(){
            $("#careerModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
            $('#careerForm').validator();
            $("#careerModal").modal("show");
        });

        $("#saveCareer").click(function(){
            $("#careerForm").submit();
        });
        $("#careerForm").validator().on('submit', function (e) {
           
            var btn = $("#saveCareer");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var job_title = $("#inputCareerTitle").val();
                var job_description = editor.getData();
                var career_id = $("#careerID").val();

                var data = {
                    'id':career_id,
                    "job_title" : job_title,
                    "job_description" : job_description
                };
               
                var url = "<?php echo base_url()."cms/loyalty/add_career";?>";
                var message = "New Career successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."cms/loyalty/edit_career";?>";
                    message = "Career successfully updated";
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
                                $("#careerForm").validator('destroy');
                                $("#careerModal").modal("hide");     
                            }
                        
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
            }              
               return false;
        });

        $("#deleteCareer").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."cms/loyalty/delete_career";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw();
                            $("#deleteCareerModal").modal("hide");
                            toastr.error('Career ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#careerModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            editor.setData("");
            $("#inputStatus").val('1').trigger('change');
            $("#careerForm").validator('destroy');
        });

        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
      
    };
    function _edit(id)
    {
        $("#careerModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#careerForm').validator();    
        $("#action").val("edit");
        $("#inputCoverImage").removeAttr("required");
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."cms/loyalty/get_career_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputCareerTitle").val(data.career.job_title);
                    editor.setData(data.career.job_description);
                    $("#careerID").val(data.career.id);
                    $("#careerModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteCareerModal .modal-title").html("Delete <?php echo rtrim(ucfirst($module_name),"s");?>");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteCareerModal").modal("show");
    }
    
    $(document).ready(main);
</script>