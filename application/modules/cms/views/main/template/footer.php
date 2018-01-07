
<div class="modal fade" id="profileModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">My Profile</h3>
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="profileForm" data-toggle="validator">
                        <div class="box-body">
                          <div class="form-group">
                              <label for="inputProfileUsername" class="col-sm-4 control-label">Username</label>

                              <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputProfileUsername" data-minlength="5" name="username" placeholder="Username" disabled>
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                         
                          <div class="form-group">
                              <label for="inputProfileFirstname" class="col-sm-4 control-label">Firstname</label>

                              <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputProfileFirstname" placeholder="Firstname" required>
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputProfileMiddlename" class="col-sm-4 control-label">Middlename</label>

                              <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputProfileMiddlename" placeholder="Middlename">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputProfileLastname" class="col-sm-4 control-label">Lastname</label>

                              <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputProfileLastname" placeholder="Lastname"  required>
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputProfileContact" class="col-sm-4 control-label">Contact Number</label>

                              <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputProfileContact" placeholder="Contact Number">
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputProfileEmail" class="col-sm-4 control-label">Email Address</label>

                              <div class="col-sm-8">
                              <input type="email" class="form-control" id="inputProfileEmail" placeholder="Email Address">
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputProfileAddress" class="col-sm-4 control-label">Address</label>

                              <div class="col-sm-8">
                              <textarea class="form-control" id="inputProfileAddress" placeholder="Address" style="resize:none"></textarea>
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputProfilePassword" class="col-sm-4 control-label">New Password</label>

                              <div class="col-sm-8">
                              <input type="password" class="form-control" data-minlength="8" id="inputProfilePassword" placeholder="Password">
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputProfilePassword2" class="col-sm-4 control-label">Validate Password</label>

                              <div class="col-sm-8">
                              <input type="password" class="form-control" data-minlength="8" id="inputProfilePassword2"  data-match="#inputProfilePassword" data-match-error="Whoops, these don't match" placeholder="Password">
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="inputProfileOldPassword" class="col-sm-4 control-label">Old Password Password</label>

                              <div class="col-sm-8">
                              <input type="password" class="form-control" id="inputProfileOldPassword" placeholder="Old Password" required>
                              <div class="help-block with-errors"></div>
                              </div>
                          </div>
                        </div>
                    </form>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveProfile">Update Profile</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<script>
  $("#viewProfile").click(function(e){
    e.preventDefault();
        $.ajax({
                type: "post",
                url: "<?php echo base_url()."cms/main/get_profile_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#profileID").val(data.user_account.id);
                    $("#inputProfileUsername").val(data.user_account.username);
                    $("#inputProfileFirstname").val(data.user_profile.first_name);
                    $("#inputProfileMiddlename").val(data.user_profile.middle_name);
                    $("#inputProfileLastname").val(data.user_profile.last_name);
                    $("#inputProfileEmail").val(data.user_profile.email_address);
                    $("#inputProfileContact").val(data.user_profile.contact_number);
                    $("#inputProfileAddress").val(data.user_profile.address);
                    
                    $("#inputProfilePassword").val("");
                    $("#inputProfilePassword2").val("");
                    $("#profileModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
  });

  $("#saveProfile").click(function(){
      $("#profileForm").submit();
  });
  $("#profileForm").validator().on('submit', function (e) {
           var btn = $("#saveProfile");
           btn.button("loading");
           if (e.isDefaultPrevented()) {
               btn.button("reset"); 
           } else {
               e.preventDefault();
               var username = $("#inputProfileUsername").val();
               var password = $("#inputProfilePassword2").val();
               var old_password = $("#inputProfileOldPassword").val();
               var first_name = $("#inputProfileFirstname").val();
               var middle_name = $("#inputProfileMiddlename").val();
               var last_name = $("#inputProfileLastname").val();
               var email_address = $("#inputProfileEmail").val();
               var contact_number = $("#inputProfileContact").val();
               var address = $("#inputProfileAddress").val();
               var user_id = $("#userID").val();

               var data = {
                   "username" : username,
                   "password" : password,
                   "old_password" : old_password,
                   "first_name" : first_name,
                   "middle_name" : middle_name,
                   "last_name" :  last_name,
                   "email_address" : email_address,
                   "contact_number" : contact_number,
                   "address" : address
               };
               
              url =  "<?php echo base_url()."cms/main/update_profile";?>";
              message = "Profile successfully updated";
          
               $.ajax({
                       data: data,
                       type: "post",
                       url: url ,
                       success: function(data){
                           //alert("Data Save: " + data);
                           if(data){
                            btn.button("reset");
                            toastr.success(message);
                            $("#profileForm").validator('destroy');
                            $("#profileModal").modal("hide");
                           }
                           else
                           {
                            btn.button("reset");
                            toastr.error(data);
                           }
                          
                       },
                       error: function (request, status, error) {
                           alert(request.responseText);
                       }
               });
           }
              return false;
       });
</script>
 <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2017 <a href="#"><?php echo SITE_NAME;?></a>.</strong> All rights
    reserved.
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
</body>
</html>
