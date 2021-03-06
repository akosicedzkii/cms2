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

<div class="modal fade" id="careerModal" role="dialog"  data-backdrop="static">
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
                                <label for="inputCareerDescription" class="col-sm-2 control-label">Job Description</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputCareerDescription" placeholder="Job Description" style="resize:none" required></textarea>
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
            <button type="button" class="btn btn-primary" id="saveCareer">Save Career</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteCareerModal" role="dialog"  data-backdrop="static">
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
    $("#inputStatus").select2({
        dropdownAutoWidth : true,
        width: 'auto',
        placeholder: "--- Select Item ---"
    });
    var editor = CKEDITOR.replace('inputCareerDescription');
    var main = function(){
        var table = $('#careerList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."unioil-cms/careers/get_career_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 1 ] }
        ], "order": [[ 5, 'desc' ]]
        });
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
                var status  = $("#inputStatus").val();
                if(job_title == "" || status == "")
                {
                    btn.button("reset"); 
                    return false;
                }
                var messageLength = job_description.replace(/<[^>]*>/gi, '').trim().length;
                if( !messageLength ) {
                    $("#ckEditorError").html("<span style='color:red;'>Please fill out this field.</span>");
                    btn.button("reset"); 
                    return false;
                }else{
                    $("#ckEditorError").html("");
                }
                var data = {
                    'id':career_id,
                    "job_title" : job_title,
                    "job_description" : job_description,
                    "status" : status
                };
               
                var url = "<?php echo base_url()."unioil-cms/careers/add_career";?>";
                var message = "New Career successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."unioil-cms/careers/edit_career";?>";
                    message = "Career successfully updated";
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
                         $("#careerForm").validator('destroy');
                         $("#careerModal").modal("hide");    
                         $('#uploadBoxMain').html('');         
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
                        url: "<?php echo base_url()."unioil-cms/careers/delete_career";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
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
                url: "<?php echo base_url()."unioil-cms/careers/get_career_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputCareerTitle").val(data.career.job_title);
                    editor.setData(data.career.job_description);
                    $("#careerID").val(data.career.id);
                    $("#inputStatus").val(data.career.status).trigger('change');;
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