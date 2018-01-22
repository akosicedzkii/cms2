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
        <table id="achievementList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Year</th>
            <th>Achievement</th>
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

<div class="modal fade" id="achievementModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Achievement</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="achievementID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="achievementForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputAchievementYear" class="col-sm-2 control-label">Year</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputAchievementYear" placeholder="Year" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAchievement" class="col-sm-2 control-label">Achievement</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputAchievement" placeholder="Achievement" style="resize:none" required></textarea>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveAchievement">Save Achievement</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteAchievementModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Achievement</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteAchievement">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $("#inputAchievementYear").datepicker( {
        format: " yyyy", // Notice the Extra space at the beginning
        viewMode: "years", 
        minViewMode: "years"
    });
    var main = function(){
        var table = $('#achievementList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."cms/achievements/get_achievement_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "5%",  "targets": [ 1 ] }
        ]
        });
        $("#addBtn").click(function(){
            $("#achievementModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
            $('#achievementForm').validator();
            $("#achievementModal").modal("show");
        });

        $("#saveAchievement").click(function(){
            $("#achievementForm").submit();
        });
        $("#achievementForm").validator().on('submit', function (e) {
           
            var btn = $("#saveAchievement");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var year = $("#inputAchievementYear").val();
                var achievement = $("#inputAchievement").val();
                var achievement_id = $("#achievementID").val();

                var data = {
                    'id':achievement_id,
                    "year" : year,
                    "achievement" : achievement
                };
               
                var url = "<?php echo base_url()."cms/achievements/add_achievement";?>";
                var message = "New Achievement successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."cms/achievements/edit_achievement";?>";
                    message = "Achievement successfully updated";
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
                                $("#achievementForm").validator('destroy');
                                $("#achievementModal").modal("hide");     
                            }
                        
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
            }              
               return false;
        });

        $("#deleteAchievement").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."cms/achievements/delete_achievement";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw();
                            $("#deleteAchievementModal").modal("hide");
                            toastr.error('Achievement ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#achievementModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $("#inputStatus").val('1').trigger('change');
            $("#achievementForm").validator('destroy');
        });

        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
      
    };
    function _edit(id)
    {
        $("#achievementModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#achievementForm').validator();    
        $("#action").val("edit");
        $("#inputCoverImage").removeAttr("required");
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."cms/achievements/get_achievement_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputAchievementYear").val(data.achievement.year);
                    $("#inputAchievement").val(data.achievement.achievement);
                    $("#achievementID").val(data.achievement.id);
                    $("#achievementModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteAchievementModal .modal-title").html("Delete <?php echo rtrim(ucfirst($module_name),"s");?>");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteAchievementModal").modal("show");
    }
    
    $(document).ready(main);
</script>