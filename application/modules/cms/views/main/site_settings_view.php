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
    <form class="form-horizontal" id="userForm" data-toggle="validator">
        <div class="box-body">
            <div class="form-group">
                <label for="inputSiteName" class="col-sm-2 control-label">Site Name</label>

                <div class="col-sm-4">
                <input type="text" class="form-control" id="inputSiteName" placeholder="Site Name" value="<?php echo $site_settings->site_name;?>" required>
                <div class="help-block with-errors"></div>
                </div>
            </div>


            <div class="form-group">
                <label for="inputSiteLogo" class="col-sm-2 control-label">Site Logo</label>

                <div class="col-sm-4">
                <input type="file" class="form-control" id="inputSiteLogo" placeholder="Site Logo">
                <button id="previewImage" class="btn btn-success">Preview</button>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputCompanyAddress" class="col-sm-2 control-label">Company Address</label>

                <div class="col-sm-4">
                <textarea class="form-control" id="inputCompanyAddress" placeholder="Company Address" style="resize:none"><?php echo $site_settings->company_address;?></textarea>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputCompanyContact" class="col-sm-2 control-label">Company Contact Number</label>

                <div class="col-sm-4">
                <input type="text" class="form-control" id="inputCompanyContact" placeholder="Company Contact Number" value="<?php echo $site_settings->contact_number;?>">
                <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputCompanyContactFax" class="col-sm-2 control-label">Company Fax Number</label>

                <div class="col-sm-4">
                <input type="text" class="form-control" id="inputCompanyContactFax" placeholder="Company Fax Number" value="<?php echo $site_settings->fax_number;?>">
                <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputContactUsEmail" class="col-sm-2 control-label">Contact Us Email Address</label>

                <div class="col-sm-4">
                <input type="email" class="form-control" id="inputContactUsEmail" placeholder="Contact Us Email Address" value="<?php echo $site_settings->contact_us_email_address;?>">
                <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputFacebook" class="col-sm-2 control-label">Facebook URL</label>

                <div class="col-sm-4">
                <input type="text" class="form-control" id="inputFacebook" placeholder="Facebook URL" value="<?php echo $site_settings->facebook_url;?>">
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputInstagram" class="col-sm-2 control-label">Instagram URL</label>

                <div class="col-sm-4">
                <input type="text" class="form-control" id="inputInstagram" placeholder="Instagram URL" value="<?php echo $site_settings->instagram_url;?>">
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputTwitter" class="col-sm-2 control-label">Twitter URL</label>

                <div class="col-sm-4">
                <input type="text" class="form-control" id="inputTwitter" placeholder="Twitter URL" value="<?php echo $site_settings->twitter_url;?>">
                <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
    </form>
</div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
</div>


<!-- /.modal -->
<div class="modal fade" id="deleteUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete User</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteUser">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
