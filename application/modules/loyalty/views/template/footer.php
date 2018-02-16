
    <section id="page-contact">
        <a class="anchor" id="contact-us"></a>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 my-auto">
                    <div class="row">
                        <div class="col-12">
                            <div class="social-media-container">
                                <a href="#">
                                    <img src="<?php echo base_url();?>/assets_loyalty/images/unioil-thumbnail-facebook.png" class="social-media-link" alt=""></a>
                                <a href="#">
                                    <img src="<?php echo base_url();?>/assets_loyalty/images/unioil-thumbnail-twitter.png" class="social-media-link" alt=""></a>
                                <a href="#">
                                    <img src="<?php echo base_url();?>/assets_loyalty/images/unioil-thumbnail-instagram.png" class="social-media-link" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="row">
                        <div class="col-12 col-md-6 contact-detail">
                            <img src="<?php echo base_url();?>/assets_loyalty/images/unioil-thumbnail-phone.png" class="contact-detail-thumbnail" alt="">
                            <p class="contact-detail-info">
                                <span class="bold-text">Tel. no.</span>
                                <br> (632) 687 8877 loc. 269
                            </p>
                        </div>
                        <div class="col-12 col-md-6 contact-detail">
                            <img src="<?php echo base_url();?>/assets_loyalty/images/unioil-thumbnail-pin.png" class="contact-detail-thumbnail" alt="">
                            <p class="contact-detail-info">2702A West Tower building, PSE Exchange Center, Exchange Road, Ortigas Center, Pasig City 1600 </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="<?php echo base_url();?>/assets_loyalty/js/validation.js"></script>
    <script src="<?php echo base_url();?>/assets_loyalty/js/date-autofill.js"></script>
    <script>
        var base_url = "<?php echo base_url();?>";
    </script>
    <?php if($page == "main"){?>
    <script src="<?php echo base_url();?>/assets_loyalty/js/main.js"></script>
    <?php }?>
    <?php if($page == "profile"){?>
    <script src="<?php echo base_url();?>/assets_loyalty/js/profile.js"></script>
    <?php }?>
    <script src="<?php echo base_url();?>/assets_loyalty/js/scroll-events.js"></script>
</body>

</html>