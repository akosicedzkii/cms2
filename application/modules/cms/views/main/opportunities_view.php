<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<?php $module_name = ucwords(str_replace("_"," ",$module_name));?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo ucfirst($module_name)." Settings";?>
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
        <h3 class="box-title"><?php echo ucfirst($module_name)." Settings";?></h3>
    </div>
    <!-- /.box-header -->
<div class="box-body">
    <form class="form-horizontal" id="settingsForm" data-toggle="validator">
        <div class="box-body">
            

            <div class="form-group">
                <label for="inputFranchiseVideo" class="col-sm-2 control-label">Franchise Video</label>

                <div class="col-sm-4">
                <input type="file" class="form-control" id="inputFranchiseVideo" placeholder="Franchise Video">
                <?php if($site_settings->franchise_video != ""){
                    ?>
                            <br><input type="button" id="previewVideo" data-toggle="videoPreviewModal" class="btn btn-success" value="Preview">
                            <input type="button" id="videoDeleteButton" data-toggle="videoDeleteModal" class="btn btn-danger" value="Remove">
                    <?php
                }?>
                <br>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputFranchiseVideoPoster" class="col-sm-2 control-label">Franchise Video Poster</label>

                <div class="col-sm-4">
                <input type="file" class="form-control" id="inputFranchiseVideoPoster" placeholder="Franchise Video Poster">
                <?php if($site_settings->franchise_video_poster != ""){
                    ?>
                            <br><input type="button" id="previewVideoPoster" data-toggle="videoPosterPreviewModal" class="btn btn-success" value="Preview">
                            <input type="button" id="videoPosterDeleteButton" data-toggle="videoPosterDeleteModal" class="btn btn-danger" value="Remove">
                    <?php
                }?>
                <br>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputFranchiseOfficer" class="col-sm-2 control-label">Franchise Officer</label>

                <div class="col-sm-4">
                <input type="text" class="form-control" id="inputFranchiseOfficer" placeholder="Franchise Officer" value="<?php echo $site_settings->franchise_officer;?>">
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputFranchiseEmail" class="col-sm-2 control-label">Franchise Email Address</label>

                <div class="col-sm-4">
                <input type="email" class="form-control" id="inputFranchiseEmail" placeholder="Franchise Email Address" value="<?php echo $site_settings->franchise_email_address;?>">
                <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputFranchiseReplySubject" class="col-sm-2 control-label">Franchise Email Reply Subject</label>

                <div class="col-sm-4">
                <input type="text" class="form-control" id="inputFranchiseReplySubject" placeholder="Franchise Email Reply Subject" value="<?php echo $site_settings->franchise_subject_reply;?>">
                <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputFranchiseReplyBody" class="col-sm-2 control-label">Franchise Email Reply Body</label>

                <div class="col-sm-4">
                <textarea class="form-control" id="inputFranchiseReplyBody" placeholder="Franchise Email Reply Body"><?php echo $site_settings->franchise_body_reply;?></textarea>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputCareersEmail" class="col-sm-2 control-label">Careers Email Address</label>

                <div class="col-sm-4">
                <input type="email" class="form-control" id="inputCareersEmail" placeholder="Careers Email Address" value="<?php echo $site_settings->careers_email_address;?>">
                <div class="help-block with-errors"></div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputCareersReplySubject" class="col-sm-2 control-label">Careers Email Reply Subject</label>

                <div class="col-sm-4">
                <input type="text" class="form-control" id="inputCareersReplySubject" placeholder="Careers Email Reply Subject" value="<?php echo $site_settings->careers_subject_reply;?>">
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputCareersAttachment" class="col-sm-2 control-label">Careers File Attachment</label>

                <div class="col-sm-4">
                <input type="file" class="form-control" id="inputCareersAttachment" placeholder="Careers File Attachment">
                <?php if($site_settings->careers_attachment != ""){
                    ?>
                            <br><a target="_blank" href="<?php echo base_url()."uploads/careers_attachment/".$site_settings->careers_attachment;?>" class="btn btn-success">View Attachment</a>
                            <input id="careerAttachmentDeleteButton" type="button" data-toggle="careerAttachmentDeleteModal" class="btn btn-danger" value="Remove">
                   <?php
                }?>
                <br>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputCareersReplyBody" class="col-sm-2 control-label">Careers Email Reply Body</label>

                <div class="col-sm-4">
                <textarea class="form-control" id="inputCareersReplyBody" placeholder="Careers Email Reply Body"><?php echo $site_settings->careers_body_reply;?></textarea>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                <input type="submit" class="btn btn-success pull-right" id="saveSettings" value="Save Settings">
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
    <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
</div>

<!-- /.modal -->
<div class="modal fade" id="videoPreviewModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Franchise Video Preview</h3>
            </div>
            <div class="modal-body">
                <center><video controls src="<?php echo base_url()."uploads/franchise_video/".$site_settings->franchise_video;?>" style="width:100%;"></center>
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
<div class="modal fade" id="videoPosterPreviewModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Franchise Video Poster Preview</h3>
            </div>
            <div class="modal-body">
                <center><img  src="<?php echo base_url()."uploads/franchise_video/".$site_settings->franchise_video_poster;?>" style="width:100%;"></center>
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
<div class="modal fade" id="removeModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>

                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <center><h4 class="remove-title"></h4></center>
                <input type="hidden" id="file">
                <input type="hidden" id="modules">
                <input type="hidden" id="folder">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger pull-right" id="removeFilebutton">Remove</button>
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


            var careers_subject_reply = $("#inputCareersReplySubject").val();
            var franchise_subject_reply = $("#inputFranchiseReplySubject").val();
            
            var careers_body_reply = $("#inputCareersReplyBody").val();
            var franchise_body_reply = $("#inputFranchiseReplyBody").val();

            var franchise_email_address = $("#inputFranchiseEmail").val();
            var franchise_officer = $("#inputFranchiseOfficer").val();
            var careers_email_address = $("#inputCareersEmail").val();

            var formData = new FormData();

            formData.append('franchise_video', $('#inputFranchiseVideo').prop("files")[0]);
            formData.append('franchise_video_poster', $('#inputFranchiseVideoPoster').prop("files")[0]);
            formData.append('careers_attachment', $('#inputCareersAttachment').prop("files")[0]);
            formData.append("careers_subject_reply" , careers_subject_reply);
            formData.append("franchise_officer" , franchise_officer);
            formData.append("franchise_subject_reply" , franchise_subject_reply);

            formData.append("careers_body_reply" , careers_body_reply);
            formData.append("franchise_body_reply" , franchise_body_reply);
            
            formData.append("franchise_email_address" , franchise_email_address);
            formData.append("careers_email_address" , careers_email_address);

            $('#uploadBoxMain').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBarMain" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
                $.ajax({
                    data: formData,
                    type: "post",
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: "<?php echo base_url()."cms/opportunities/update_opportunities_settings";?>" ,
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
                        toastr.success('Opportunities settings successfully updated');
                        setTimeout(function() {
                        window.location = "";
                        }, 200);

                    }else{
                            btn.button("reset");
                            toastr.error(data); $('#uploadBoxMain').html('');     
                    }
                });   
            });           
            $("#previewVideo").click(function(){
                $("#videoPreviewModal").modal("show");
            });
            $("#previewVideoPoster").click(function(){
                $("#videoPosterPreviewModal").modal("show");
            });
            
            $("#videoDeleteButton").click(function(){
                $(".modal-title").html("Remove Franchise Video");
                $(".remove-title").html("Remove Franchise Video?");
                $("#file").val("<?php echo $site_settings->franchise_video;?>");
                $("#modules").val("franchise_video");
                $("#folder").val("franchise_video");
                $("#removeModal").modal("show");
            });

            $("#videoPosterDeleteButton").click(function(){
                $(".modal-title").html("Remove Franchise Video Poster");
                $(".remove-title").html("Remove Franchise Video Poster?");
                $("#file").val("<?php echo $site_settings->franchise_video_poster;?>");
                $("#modules").val("franchise_video_poster");
                $("#folder").val("franchise_video");
                $("#removeModal").modal("show");
            });

            $("#careerAttachmentDeleteButton").click(function(){
                $(".modal-title").html("Remove Careers Attachment");
                $(".remove-title").html("Remove Careers Attachment?");
                $("#file").val("<?php echo $site_settings->careers_attachment?>");
                $("#modules").val("careers_attachment");
                $("#folder").val("careers_attachment");
                $("#removeModal").modal("show");
            });

            $("#removeFilebutton").click(function(){
                btn = $(this);
                btn.button("loading");
                var file = $("#file").val();
                var modules = $("#modules").val();
                var folder = $("#folder").val();
                $.ajax({
                    type : "post",
                    data: {"file_name" : file , "settings_module" : modules,"folder": folder },
                    url : "<?php echo base_url()."cms/opportunities/remove_file"?>",
                    success : function(returns)
                    {
                        if(returns)
                        {
                            toastr.error("File Successfully Removed");
                            $("removeModal").modal("hide");
                            btn.button("reset");
                            setTimeout(function() {
                            window.location = "";
                            }, 200);
                        }
                    }
                });
            });
    };
    
    
    $(document).ready(main);
</script>
