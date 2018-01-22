
    <section id="page-contact">
        <a class="anchor" id="contact-us"></a>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                    <h4 class="text-center">CONTACT US</h4>
                    <form action="" id="contact-form" novalidate>
                        <div class="row">
                            <div class="col-12">
                                <input type="text" id="contact-name" class="contact-textbox" placeholder="FULL NAME" data-fieldtype="text" />
                                <p class="error-msg"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <input type="tel" id="contact-mobile" class="contact-textbox" placeholder="MOBILE" data-fieldtype="number" />
                                <p class="error-msg"></p>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <input type="email" id="contact-email" class="contact-textbox" placeholder="EMAIL ADDRESS" data-fieldtype="email" />
                                <p class="error-msg"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <textarea placeholder="MESSAGE" id="contact-message" class="contact-textarea" data-fieldtype="text"></textarea>
                                <p class="error-msg hidden-md-up"></p>
                                <input id="contact-submit" type="submit" value="SEND" />
                                <p class="error-msg hidden-sm-down"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-0 col-md-1 col-lg-1 col-xl-1">
                    <div class="divider hidden-sm-down"></div>
                </div>
                <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                    <div class="contact-detail">
                        <img src="<?php echo base_url()."assets_site"?>/images/unioil-thumbnail-pin.png" class="contact-detail-thumbnail" alt="">
                        <p class="contact-detail-info">
                            <?php echo nl2br(COMPANY_ADDRESS);?> </p>
                    </div>
                    <div class="contact-detail">
                        <img src="<?php echo base_url()."assets_site"?>/images/unioil-thumbnail-phone.png" class="contact-detail-thumbnail" alt="">
                        <p class="contact-detail-info">
                            <span class="bold-text">Tel. no.</span>
                            <br>
                            <?php echo nl2br(CONTACT_NUMBER);?>
                            <br>
                            <br>
                            <span class="bold-text">Fax No.</span>
                            <br>
                            <?php echo nl2br(FAX_NUMBER);?>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="social-media-container">
                                <a href="<?php echo FACEBOOK_URL;?>">
                                    <img src="<?php echo base_url()."assets_site"?>/images/unioil-thumbnail-facebook.png" class="social-media-link" alt=""></a>
                                <a href="<?php echo TWITTER_URL;?>">
                                    <img src="<?php echo base_url()."assets_site"?>/images/unioil-thumbnail-twitter.png" class="social-media-link" alt=""></a>
                                <a href="<?php echo INSTAGRAM_URL;?>">
                                    <img src="<?php echo base_url()."assets_site"?>/images/unioil-thumbnail-instagram.png" class="social-media-link" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
		<div class="modal modal-lg fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="article-type" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="article-type">Employee Login Portal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<div class="container" style="background-color:#d2d6de; padding-top: 20px;">
						<p>Login here:</p>
						<form action="https://ap4.salesforce.com/sserv/login.jsp" method="POST">
							<input type="HIDDEN" name="orgId" value="00D90000000XlWr">
						  <div class="form-group has-feedback">
							<input type="text" class="form-control" placeholder="Username" id="un" name="un" required="">
							<span class="glyphicon glyphicon-user form-control-feedback"></span>
						  </div>
						  <div class="form-group has-feedback">
							<input type="password" class="form-control" placeholder="Password" id="pw" name="pw" required="">
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						  </div>
						  <div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4"></div>
							<div class="col-md-4">
							  <button type="submit" class="btn btn-primary btn-block btn-flat pull-right" value="Login">Sign In</button>
							</div>
						  </div>
						  </br>
						  <div class="row">
								<div class="col-md-12">
									  <h4>General Instructions:</h4>
									  <ol class="gi">
											<li>Please secure  the activation of your portal to HR Department.</li>
											<li>Temporary password will be sent to your e-mail upon activation.</li>
											<li>We suggest changing your password after initial login for security purposes.</li>
											<li>Kindly ensure that everything entered is correct.</li>
									  </ol>
								  </div>
							</div>
						  </div>
						  
						</form>
					 </div>
                </div>
            </div>
        </div>
    <footer id="page-copyright-footer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="copyright">Copyright 2017. Unioil Petroleum Philippines, Inc. ALL RIGHTS RESERVED.</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="<?php echo base_url()."assets_site/"?>js/validation.js"></script>

    <script>
          var to_contact_us_email = "<?php echo CONTACT_US_EMAIL_ADDRESS;?>";
          var to_franchise_email = "<?php echo FRANCHISE_EMAIL_ADDRESS;?>";

    </script>
    <script src="<?php echo base_url()."assets_site/"?>js/main.js"></script>
    <script src="<?php echo base_url()."assets_site/"?>js/scroll-events.js"></script>
    
    <?php if($module_name == "home"){?>
        <script src="<?php echo base_url()."assets_site/"?>js/index.js"></script>
        <script>
            var stores = null;
            $("#store-area").attr("disabled","disabled");
                $.ajax({
                        type: "get",
                        url: "<?php echo base_url()."home/get_all_station";?>",
                        success: function(data){
                            data = JSON.parse(data);
                            stores = data;
                            stores = JSON.parse(stores);
                            $("#store-area").removeAttr("disabled");
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        </script>
        <script src="<?php echo base_url()."assets_site/"?>js/store-locator.js"></script>
    <?php }?>
    <script src="<?php echo base_url()."assets_site/"?>js/careers.js"></script>
    <script src="<?php echo base_url()."assets_site/"?>js/franchise-application.js"></script>
    <script>
        var main = function(){
            $('#video-banner').click(function(){this.paused?this.play():this.pause();});
        };

        $(document).ready(main);
    </script>
    <!--Start of Zendesk Chat Script
    <script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
    $.src="https://v2.zopim.com/?5LqYeuqy9uK5S0ynsMKQgxfF9uESZO23";z.t=+new Date;$.
    type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
    </script>
    End of Zendesk Chat Script-->
</body>

</html>