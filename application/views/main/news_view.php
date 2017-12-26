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
        <table id="newsList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
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

<div class="modal fade" id="newsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add News</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="newsID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="newsForm" data-toggle="validator">
                        <div class="box-body">
                        <div class="form-group">
                            <label for="inputNewsname" class="col-sm-4 control-label">Newsname</label>

                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputNewsname" data-minlength="5" name="newsname" placeholder="Newsname" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group add">
                            <label for="inputPassword" class="col-sm-4 control-label">Password</label>

                            <div class="col-sm-8">
                            <input type="password" class="form-control" data-minlength="8" id="inputPassword" placeholder="Password" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group add">
                            <label for="inputPassword2" class="col-sm-4 control-label">Validate Password</label>

                            <div class="col-sm-8 add">
                            <input type="password" class="form-control" data-minlength="8" id="inputPassword2"  data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Password" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputFirstname" class="col-sm-4 control-label">Firstname</label>

                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputFirstname" placeholder="Firstname" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputMiddlename" class="col-sm-4 control-label">Middlename</label>

                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputMiddlename" placeholder="Middlename">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputLastname" class="col-sm-4 control-label">Lastname</label>

                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputLastname" placeholder="Lastname"  required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputContact" class="col-sm-4 control-label">Contact Number</label>

                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputContact" placeholder="Contact Number">
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-4 control-label">Email Address</label>

                            <div class="col-sm-8">
                            <input type="email" class="form-control" id="inputEmail" placeholder="Email Address">
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress" class="col-sm-4 control-label">Address</label>

                            <div class="col-sm-8">
                            <textarea class="form-control" id="inputAddress" placeholder="Address" style="resize:none"></textarea>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newsRole" class="col-sm-4 control-label">News Role</label>

                            <div class="col-sm-8">
                            <select class="form-control" id="inputRole" required>
                                <option value=""></option>
                                <?php 
                                    if($roles != null){
                                        foreach($roles as $row){
                                            ?>
                                                <option value="<?php echo $row->id;?>"><?php echo $row->role_name;?></option>
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
            <button type="button" class="btn btn-primary" id="saveNews">Save News</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteNewsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete News</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteNews">Delete</button>
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

        var table = $('#newsList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."news/get_news_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] }
        ]
        });
        $("#addBtn").click(function(){
            $("#newsModal .modal-title").html("Add <?php echo rtrim(ucfirst($module_name),"s");?>");
            $("#action").val("add");
            $("#inputNewsname").attr("data-remote","<?php echo base_url()."news/check_newsname_exist?method=add";?>");
            $(".add").show();     
            $('#newsForm').validator();
            $("#newsModal").modal("show");
        });

        $("#saveNews").click(function(){
            $("#newsForm").submit();
        });
        $("#newsForm").validator().on('submit', function (e) {
           
            var btn = $("#saveNews");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var newsname = $("#inputNewsname").val();
                var password = $("#inputPassword2").val();
                var first_name = $("#inputFirstname").val();
                var middle_name = $("#inputMiddlename").val();
                var last_name = $("#inputLastname").val();
                var email_address = $("#inputEmail").val();
                var contact_number = $("#inputContact").val();
                var address = $("#inputAddress").val();
                var role = $("#inputRole").val();
                var news_id = $("#newsID").val();

                var data = {
                    "news_id" : news_id,
                    "newsname" : newsname,
                    "password" : password,
                    "first_name" : first_name,
                    "middle_name" : middle_name,
                    "last_name" :  last_name,
                    "email_address" : email_address,
                    "contact_number" : contact_number,
                    "address" : address,
                    "role" : role
                };
                
                var url = "<?php echo base_url()."news/add_news";?>";
                var message = "New news successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."news/edit_news";?>";
                    message = "News successfully updated";
                }
                $.ajax({
                        data: data,
                        type: "post",
                        url: url ,
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw();
                            toastr.success(message);
                            $("#newsForm").validator('destroy');
                            $("#newsModal").modal("hide");
                            $(".select2-inputRole-container").attr("html", "--- Select Item ---"); 
                            $(".select2-inputRole-container").attr("title", "--- Select Item ---"); 
                            $("#inputRole").select2("val", "null");
                           
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
            }
               return false;
        });

        $("#deleteNews").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."news/delete_news";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw();
                            $("#deleteNewsModal").modal("hide");
                            toastr.error('News ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#newsModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        });

        $('#inputRole').select2(inputRoleConfig);
        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
      
    };
    function _edit(id)
    {
        $("#newsModal .modal-title").html("Edit <?php echo rtrim(ucfirst($module_name),"s");?>");
        $(".add").hide();    
        $('#newsForm').validator();    
        $("#action").val("edit");
        $("#inputNewsname").attr("data-remote","<?php echo base_url()."news/check_newsname_exist?method=edit&news_id=";?>" + id);
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."news/get_news_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#newsID").val(data.news_account.id);
                    $("#inputNewsname").val(data.news_account.newsname);
                    $("#inputPassword").val("this is not the real password");
                    $("#inputPassword2").val("this is not the real password");
                    $("#inputFirstname").val(data.news_profile.first_name);
                    $("#inputMiddlename").val(data.news_profile.middle_name);
                    $("#inputLastname").val(data.news_profile.last_name);
                    $("#inputEmail").val(data.news_profile.email_address);
                    $("#inputContact").val(data.news_profile.contact_number);
                    $("#inputAddress").val(data.news_profile.address);
                    $("#inputRole").select2(inputRoleConfig).val(data.news_account.role_id).trigger("change");
                    $("#newsModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteNewsModal .modal-title").html("Delete <?php echo rtrim(ucfirst($module_name),"s");?>");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteNewsModal").modal("show");
    }
    $(document).ready(main);
</script>