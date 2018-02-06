<section id="page-content">
        <section id="page-title">
            <h3>GAS STATION FRANCHISE &amp; LUBRICANT DISTRIBUTORSHIP</h3>
        </section>
        <section id="video-banner-container">
            <?php
                if(FRANCHISE_VIDEO != null){
                    ?>    
                        <video id="video-banner" src="<?php echo base_url()."uploads/franchise_video/".FRANCHISE_VIDEO;?>" loop poster="<?php echo base_url()."uploads/franchise_video/".FRANCHISE_VIDEO_POSTER;?>"></video>
                    <?php
                        }else{
                    ?>   
                        <video id="video-banner" src="#" loop poster="<?php echo base_url()."assets_site"?>/images/unioil-franchise-banner-poster.jpg"></video>
                <?php   
                }
            ?>
        </section>
        <section id="lead-in">
            <div class="copy-wrapper clearfix">
                <div class="copy-container animate fade-in" data-group="lead-in">
                    <h3>Partner with the industry’s <br class="hidden-sm-down">cleanest range of high-performance fuels</h3>
                </div>
            </div>
            <div class="img-container">
                <img src="<?php echo base_url()."assets_site"?>/images/unioil-franchise-station.png" alt="" id="station">
                <img src="<?php echo base_url()."assets_site"?>/images/unioil-franchise-euro5.png" alt="" id="euro5" class="animate fade-in" data-group="lead-in">
            </div>
        </section>
        <div class="partial-border-container">
            <div class="partial-border left animate from-left-offscreen">
            </div>
        </div>
        <section id="process-container">
            <h4 class="section-heading animate fade-in">FRANCHISE PROCESS</h4>
            <div class="process-item-container">
                <div class="background-dark hidden-sm-down">
                </div>
                <div class="process-item animate from-left-offscreen" data-group="steps">
                    <div class="content-container">
                        <p>Submit your Letter of Intent and accomplished application form</p>
                        <a href="<?php echo base_url()."franchise_application";?>" class="ghost-btn white">SUBMIT APPLICATION</a>
                    </div>
                </div>
                <div class="process-item animate from-left-offscreen" data-group="steps">
                    <div class="content-container">
                        <p>Assessment:</p>
                        <ol>
                            <li>Initial interview</li>
                            <li>Presentation</li>
                            <li>House Visit</li>
                        </ol>
                    </div>
                </div>
                <div class="process-item animate from-left-offscreen" data-group="steps">
                    <div class="content-container">
                        <p>Business Plan
                            <br>Presentation</p>
                    </div>
                </div>
                <div class="process-item animate from-left-offscreen" data-group="steps">
                    <div class="content-container">
                        <p>Dealer’s
                            <br>Appointment</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="partial-border-container">
            <div class="partial-border right animate from-right-offscreen">
            </div>
        </div>
        <section id="franchise-qualifications">
            <div class="container animate fade-in">
                <div class="row">
                    <div class="col-12">
                        <h4 class="section-heading">FRANCHISE PROCESS</h4>
                    </div>
                </div>
                <div class="row justify-content-sm-center justify-content-md-center justify-content-lg-center justify-content-xl-center">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-5">
                        <p>Must have:</p>
                        <ul>
                            <li><span>Hands-on Management / Close Supervision</span></li>
                            <li><span>People Management (incl. Coach Motivation) Skills</span></li>
                            <li><span>Financially Capable</span></li>
                            <li><span>Alignment with UPPI's Retail Vision</span></li>
                            <li><span>No conflict of interest up to 1st Degree of Consanguinity</span></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                        <p>Advantages if with:</p>
                        <ul>
                            <li><span>Retailing Values / Experience</span></li>
                            <li><span>Trading Area familiarity</span></li>
                            <li><span>Experience in managing Key Accounts</span></li>
                            <li><span>Knowledgeable in Automotive Business</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <div class="partial-border-container thin animate fade-in">
            <div class="partial-border center">
            </div>
        </div>
        <section id="franchise-contact">
            <div class="container animate fade-in">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <h3>CONTACT DETAILS:</h3>
                        <p>Franchise Officer : <?php echo FRANCHISE_OFFICER;?><br>Email : <a href="mailto:<?php echo FRANCHISE_EMAIL_ADDRESS;?>"><?php echo FRANCHISE_EMAIL_ADDRESS;?></a></p>
                    </div>
                </div>
            </div>
        </section>
    </section>
