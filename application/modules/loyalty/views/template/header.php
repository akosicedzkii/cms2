<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="<?php echo base_url()."uploads/site_icon/".SITE_ICON;?>" /> 
    <title>Unioil Loyalty</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets_loyalty/css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets_loyalty/css/scroll-events.css">
    <?php if($page == "main" || $page == "faq"){?>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets_loyalty/css/index.css">
    <?php }?>
    <?php if($page == "profile"){?>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets_loyalty/css/profile.css">
    <?php }?>
    <?php if($page == "faq"){?>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets_loyalty/css/faq.css">
    <?php }?>
</head>

<body id="index">
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>LOG IN</h4>
                    <form action="" id="login-form">
                        <div class="login-field-group">
                            <label for="login-birthday" class="form-label">Card No.</label>
                            <input type="text" class="login-field" id="login-card-number" data-fieldtype="number" />
                            <p class="error-msg"></p>
                        </div>
                        <div class="login-field-group date-autofill">
                            <label for="login-birthday" class="form-label">Birthday</label>
                            <select name="" id="login-birthday-year" class="login-birthday date-year" data-fieldtype="select-date" >
                                <option disabled selected value="default">YYYY</option>
                            </select>
                            <select name="" id="login-birthday-month" class="login-birthday date-month" disabled data-fieldtype="select-date" >
                                <option disabled selected value="default">MM</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <select name="" id="login-birthday-day" class="login-birthday date-day" disabled data-fieldtype="select-date" >
                                <option disabled selected value="default">DD</option>
                            </select>
                            <p class="error-msg"></p>
                        </div>
                            <p class="error-msg" id="login-error"></p>
                        <input type="submit" id="login-submit" value="SUBMIT" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="privacy-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>PRIVACY​ ​POLICY</h4>
                    <div class="privacy-container">
                        <?php echo $loyalty_settings->loyalty_privacy_policy;?>
                    </div>
                    <form action="" id="privacy-form">
                        <div class="privacy-field-group text-center">
                            <input type="checkbox" class="privacy-field" id="privacy-agree" data-fieldtype="checkbox" />
                            <label for="privacy-agree" class="form-label">I have read the privacy and conditions stated and accept the stipulations included therein.</label>
                            <p class="error-msg"></p>
                        </div>
                        <div class="text-center">
                            <input type="button" data-dismiss="modal" id="privacy-cancel" value="CANCEL" />
                            <input type="submit" id="privacy-submit" value="SUBMIT" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <nav id="page-navbar" class="navbar navbar-toggleable-sm navbar-light bg-faded fixed-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url()."loyalty";?>"><img src="<?php echo base_url();?>/assets_loyalty/images/unioil-loyalty-header-logo.png" alt=""></a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li id="home-link" class="nav-item<?php if($page == "main"){ echo " active";}?>">
                    <a class="nav-link" href="<?php echo base_url()."loyalty";?>">HOME</a>
                </li>
                <?php
                if($this->session->userdata("card_number") != null)
                { 
                ?>
                 <li id="privlink" class="nav-item<?php if($page == "profile"){ echo " active";}?>">
                    <a class="nav-link" href="<?php echo base_url()."loyalty/profile";?>">PROFILE</a>
                </li>
                <?php 
                }
                ?>
                <li id="about-link" class="nav-item<?php if($page == "faq"){ echo " active";}?>">
                    <a class="nav-link" href="<?php echo base_url()."loyalty/faq";?>">FAQs</a>
                </li>
                <li id="account-control-link" class="nav-item">
                    <div class="login-button-container">
                        <?php 
                        if($this->session->userdata("card_number") != null)
                        {   
                            ?>
                                <a class="nav-link" href="<?php echo base_url()."loyalty/main/logout"?>">LOG OUT</a>
                            <?php
                        }
                        else
                        {
                            ?>
                                <a class="nav-link" data-toggle="modal" href="#privacy-modal">LOG IN</a>
                            <?php
                        }
                        ?>
                    </div>
                </li>
            </ul>
        </div>
    </nav>