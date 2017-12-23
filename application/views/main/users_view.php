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
        <table id="userList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Username</th>
            <th>Username</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Usertype</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <!--<tr>
            <td>Cedzkii</td>
            <td>Cederic Ferrer Martinez</td>
            <td>Admin</td>
            <td>
                <a href="#" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" title="View Details"></a>
                <a href="#" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" title="Edit"></a>
                <a href="#" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" title="Delete"></a>
            </td>
        </tr>-->
        </tbody>
        <tfoot>
        <tr>
            <th>Username</th>
            <th>Full Name</th>
            <th>Full Name</th>
            <th>Full Name</th>
            <th>Usertype</th>
            <th>Actions</th>
        </tr>
        </tfoot>
        </table>
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
</div>

<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add User</h3>
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="AddUserForm" data-toggle="validator">
                        <div class="box-body">
                        <div class="form-group">
                            <label for="inputUsername" class="col-sm-2 control-label">Username</label>

                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username" data-remote="<?php echo base_url()."users/check_username_exist?method=add";?>" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-2 control-label">Password</label>

                            <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Password" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword2" class="col-sm-2 control-label">Validate Password</label>

                            <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword2"  data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Password" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputFirstname" class="col-sm-2 control-label">Firstname</label>

                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputFirstname" placeholder="Firstname" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputMiddlename" class="col-sm-2 control-label">Middlename</label>

                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputMiddlename" placeholder="Middlename">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputLastname" class="col-sm-2 control-label">Lastname</label>

                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputLastname" placeholder="Lastname"  required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputContact" class="col-sm-2 control-label">Contact Number</label>

                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputContact" placeholder="Contact Number">
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress" class="col-sm-2 control-label">Address</label>

                            <div class="col-sm-10">
                            <textarea class="form-control" id="inputAddress" placeholder="Address" style="resize:none"></textarea>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress" class="col-sm-2 control-label">User Type</label>

                            <div class="col-sm-10">
                            <select class="form-control" name="state" id="userType" required></select>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        </div>
                    </form>
                    </div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveUser">Save User</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    var main = function(){
        $('#userList').DataTable({  
            'autoWidth'   : true,
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo base_url()."users/get_user_list";?>"
        });
        $("#addBtn").click(function(){
            $("#addModal").modal("show");
        });

        $("#saveUser").click(function(){
            $("#AddUserForm").submit();
        });
        $("#AddUserForm").submit(function(e){
            e.preventDefault();
            
            var password = $("#inputPassword").val();
            var password2 = $("#inputPassword2").val();
            if( password != password2 )
            {
                alert.show();
                $(".alert").html("Passwords are not same!");
            }
        });
        $('#userType').select2({
            dropdownAutoWidth : true,
            width: 'auto',
            placeholder: '--- Select Item ---',
            ajax: {
            url: '<?php echo base_url()."users/get_user_roles";?>',
            dataType: 'json',
            delay: 250,
            type: "post",
            processResults: function (data) {
                return {
                results: data
                };
            },
            cache: true
            }
        });

    };
    $(document).ready(main);
</script>