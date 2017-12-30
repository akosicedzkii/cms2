<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>HOME - Unioil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/scroll-events.css">
    <?php if($module_name == "home"){?>
        <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/index.css">
        <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/store-locator.css">
    <?php }?>
    <?php if($module_name == "about_us"){?>
        <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/about-us.css">
    <?php }?>
    <?php if($module_name == "home"){?>
        <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/franchise.css">
    <?php }?>
</head>

<body id="index">
    <!-- <div id="chat-button-container">
        <a href="#"><img src="<?php echo base_url()."assets_site/"?>images/unioil-index-img-chat-bubble.png" alt="" id="chat-button"></a>
    </div> -->
    <nav id="page-navbar" class="navbar navbar-toggleable-sm navbar-light bg-faded fixed-top">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"><img src="<?php echo base_url()."assets_site/";?>images/unioil-header-logo.png" alt=""></a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li id="home-link" class="nav-item<?php if($module_name=="home"){ echo " active";}?>">
                    <a class="nav-link<?php if($module_name=="home"){ echo " scroll-link";}?>" href="<?php echo base_url()."home"?>#home">HOME</a>
                </li>
                <li id="about-link" class="nav-item<?php if($module_name=="about_us"){ echo " active";}?>">
                    <a class="nav-link" href="<?php echo base_url()."about_us"?>">ABOUT US</a>
                </li>
                <li id="loyalty-link" class="nav-item">
                    <a class="nav-link<?php if($module_name=="home"){ echo " scroll-link";}?>" href="<?php echo base_url()."home"?>#loyalty">LOYALTY</a>
                </li>
                <li id="products-link" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PRODUCTS</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?php echo base_url()."assets_site/"?>lubricants.html">LUBRICANT</a>
                        <a class="dropdown-item" href="<?php echo base_url()."assets_site/"?>fuel.html">FUEL</a>
                        <a class="dropdown-item" href="<?php echo base_url()."assets_site/"?>asphalt.html">ASPHALT</a>
                    </div>
                </li>
                <li id="opportunities-link" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">OPPORTUNITIES</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?php echo base_url()."franchise"?>">FRANCHISING</a>
                        <!--<a class="dropdown-item" href="<?php echo base_url()."assets_site/"?>careers.html">CAREERS</a>-->
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PORTAL</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" data-toggle="modal" href="#login_modal">EMPLOYEES</a>
                        <a class="dropdown-item" href="https://ap1.salesforce.com/secur/login_portal.jsp?orgId=00D90000000XlWr&portalId=06090000000LaoB">CUSTOMERS</a>
                    </div>
                </li>
                <li id="contact-link" class="nav-item">
                    <a class="nav-link scroll-link" href="#contact-us">CONTACT US</a>
                </li>
            </ul>
        </div>
    </nav>