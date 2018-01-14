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
<button class="btn btn-danger btn-circle btn-lg fix-btn" id="clear"  data-toggle="tooltip" title="Clear Logs">
    <span class="glyphicon glyphicon-trash"></span>
</button>
<!-- Main content -->
<section class="content">
<div class="box" id="main-list">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucfirst($module_name);?> List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="logsList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Log</th>
            <th>Date Created</th>
            <th>Created By</th>
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
<!-- /.modal -->
<div class="modal fade" id="deleteLogsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete All Logs</h3>
            </div>
            <div class="modal-body">
                <center><h4>Are you sure to delete all Logs?</h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteLogs">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script>

    var table = $('#logsList').DataTable({ 
        "order": [[ 2, "desc" ]] ,
        'autoWidth'   : true,
        "processing" : true,
        "serverSide" : true, 
        "ajax" : "<?php echo base_url()."cms/logs/get_logs_list";?>",
        "initComplete": function(settings,json){
            $('[data-toggle="tooltip"]').tooltip()
        }
        ,"columnDefs": [
        { "visible": false,  "targets": [ 0 ] },
        { "width": "20%",  "targets": [ 1 ] }
    ]
    });
    var main = function(){
       
       
        $("#clear").click(function(){
            $("#deleteLogsModal").modal("show");
        });

        $("#deleteLogs").click(function(){
            $("#deleteLogs").button("loading");
            var values = {"action" : "delete"}
            $.ajax({
                url: "<?php echo base_url();?>cms/logs/delete_all_logs",
                type: "post",
                data: values ,
                success: function (response) {
                    toastr.success("All logs successfully deleted");
                    $("#deleteLogsModal").modal("hide");
                    table.draw();
                    $("#deleteLogs").button("reset");
                    //window.location = "";
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                $("#deleteLogs").button("reset");
                }


            });
        });
    }
    $(document).ready(main);

</script>