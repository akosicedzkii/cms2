<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<?php $module_name = ucwords(str_replace("_"," ",$module_name));?>
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
<section class="content">
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucfirst($module_name);?></h3>
    </div>
    <!-- /.box-header -->
<div class="box-body">
    <form class="form-horizontal" id="settingsForm" data-toggle="validator">
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
                <input type="file" class="form-control" id="inputSiteLogo"  accept=".png, .jpeg, .gif" placeholder="Site Logo">
                <?php if($site_settings->site_logo != ""){
                    ?>
                            <br><input type="button" id="previewImage" data-toggle="imgPreviewModal" class="btn btn-success" value="Preview">
                    <?php
                }?>
                <br>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSiteIcon" class="col-sm-2 control-label">Site Icon</label>

                <div class="col-sm-4">
                <input type="file" class="form-control" id="inputSiteIcon" accept=".ico" placeholder="Site Icon">
                <?php if($site_settings->site_icon != ""){
                    ?>
                            <br><input type="button" id="previewIconImage" data-toggle="imgIconPreviewModal" class="btn btn-success" value="Preview">
                    <?php
                }?>
                <br>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputCompanyAddress" class="col-sm-2 control-label">Company Address</label>

                <div class="col-sm-4">
                <textarea class="form-control" id="inputCompanyAddress" placeholder="Company Address"><?php echo $site_settings->company_address;?></textarea>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputCompanyContact" class="col-sm-2 control-label">Company Contact Number</label>

                <div class="col-sm-4">
                <textarea class="form-control" id="inputCompanyContact" placeholder="Company Contact Number"><?php echo $site_settings->contact_number;?></textarea>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputCompanyContactFax" class="col-sm-2 control-label">Company Fax Number</label>

                <div class="col-sm-4">
                <textarea class="form-control" id="inputCompanyContactFax" placeholder="Company Fax Number"><?php echo $site_settings->fax_number;?></textarea>
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
                <label for="inputContactUsReplySubject" class="col-sm-2 control-label">Contact Us Email Reply Subject</label>

                <div class="col-sm-4">
                <input type="text" class="form-control" id="inputContactUsReplySubject" placeholder="Contact Us Email Reply Subject" value="<?php echo $site_settings->contact_us_subject_reply;?>">
                <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputContactUsReplyBody" class="col-sm-2 control-label">Contact Us Email Reply Body</label>

                <div class="col-sm-4">
                <textarea class="form-control" id="inputContactUsReplyBody" placeholder="Contact Us Email Reply Body"><?php echo $site_settings->contact_us_body_reply;?></textarea>
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
            <div class="form-group">
                <div id="uploadBoxMain" class="col-md-12">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                <input type="submit" class="btn btn-success pull-right" id="saveSettings" value="Save Settings">
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
<div class="modal fade" id="imgPreviewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Site Logo Preview</h3>
            </div>
            <div class="modal-body">
                <center><img src="<?php echo base_url()."uploads/site_logo/".$site_settings->site_logo;?>" id="imgPreview" style="width:50%;"></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade" id="imgIconPreviewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Site Logo Preview</h3>
            </div>
            <div class="modal-body">
                <center><img src="<?php echo base_url()."uploads/site_icon/".$site_settings->site_icon;?>" id="imgIconPreview" style="width:50%;"></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script>

    var main = function(){
        
        $("#settingsForm").submit(function(e){
          e.preventDefault();
          var btn =  $("#saveSettings");

          btn.button("loading");


            var site_name = $("#inputSiteName").val();
            var company_address = $("#inputCompanyAddress").val();
            var contact_number = $("#inputCompanyContact").val();
            var fax_number = $("#inputCompanyContactFax").val();
            var contact_us_email_address = $("#inputContactUsEmail").val();
            var facebook_url = $("#inputFacebook").val();
            var twitter_url = $("#inputTwitter").val();
            var instagram_url = $("#inputInstagram").val();

            var contact_us_subject_reply = $("#inputContactUsReplySubject").val();
            
            var contact_us_body_reply = $("#inputContactUsReplyBody").val();

            var formData = new FormData();

            formData.append("site_name",site_name);
            formData.append('site_logo', $('#inputSiteLogo').prop("files")[0]);
            formData.append('site_icon', $('#inputSiteIcon').prop("files")[0]);
            formData.append("company_address" ,  company_address);
            formData.append("contact_number" , contact_number);
            formData.append("fax_number" , fax_number);

            formData.append("contact_us_email_address" , contact_us_email_address);

            formData.append("facebook_url" , facebook_url);
            formData.append("twitter_url" , twitter_url);
            formData.append( "instagram_url" , instagram_url);

            formData.append("contact_us_subject_reply" , contact_us_subject_reply);

            formData.append("contact_us_body_reply" , contact_us_body_reply);
        
            $('#uploadBoxMain').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBarMain" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
            $.ajax({
                data: formData,
                type: "post",
                processData: false,
                contentType: false,
                cache: false,
                url: "<?php echo base_url()."cms/site_settings/update_settings";?>" ,
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
              if(data == true)
              { 
                   btn.button("reset");
                    toastr.success('Settings successfully updated');
                    setTimeout(function() {
                       window.location = "";
                    }, 200);

              }else{
                    btn.button("reset");
                    toastr.error(data); $('#uploadBoxMain').html('');     
              }
            });

        });

            $("#previewImage").click(function(){
                $("#imgPreviewModal").modal("show");
            });
            $("#previewIconImage").click(function(){
                $("#imgIconPreviewModal").modal("show");
            });
    };

    $(document).ready(main);
</script>
