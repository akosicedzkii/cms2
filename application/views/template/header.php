<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="<?php echo base_url()."uploads/site_icon/".SITE_ICON;?>" /> 
    <title><?php echo $title;?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/scroll-events.css">

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <?php if($module_name == "home"){?>
        <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/index.css">
        <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/store-locator.css">
    <?php }?>
    <?php if($module_name == "about_us"){?>
        <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/about-us.css">
    <?php }?>
    <?php if($module_name == "franchise"){?>
        <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/franchise.css">
    <?php }?>
    
    <?php if($module_name == "franchise_application"){?>
        <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/franchise-application.css">
    <?php }?>

    <?php if($module_name == "news_and_updates"){?>
        <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/news.css">
    <?php }?>


    <?php if($module_name == "products"){?>
        <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/fuel.css">
        <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/asphalt.css">
        <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/lubricants.css">
    <?php }?>

    <?php if($module_name == "careers"){?>
        <link rel="stylesheet" href="<?php echo base_url()."assets_site/"?>css/careers.css">
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
        <a class="navbar-brand" href="#"><img src="<?php echo base_url()."uploads/site_logo/".SITE_LOGO;?>" alt=""></a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li id="home-link" class="nav-item<?php if($module_name=="home"){ echo " active";}?>">
                    <a class="nav-link<?php if($module_name=="home"){ echo " scroll-link";}?>" href="<?php echo base_url()."home";?>#home">HOME</a>
                </li>
                <li id="about-link" class="nav-item<?php if($module_name=="about_us"){ echo " active";}?>">
                    <a class="nav-link" href="<?php echo base_url()."about_us";?>">ABOUT US</a>
                </li>
                <li id="loyalty-link" class="nav-item">
                    <a class="nav-link<?php if($module_name=="home"){ echo " scroll-link";}?>" href="<?php echo base_url()."home"?>#loyalty">LOYALTY</a>
                </li>
                <li id="products-link" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PRODUCTS</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?php echo base_url()."products/";?>lubricants">LUBRICANT</a>
                        <a class="dropdown-item" href="<?php echo base_url()."products/";?>fuel">FUEL</a>
                        <a class="dropdown-item" href="<?php echo base_url()."products/";?>asphalt">ASPHALT</a>
                    </div>
                </li>
                <li id="opportunities-link" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">OPPORTUNITIES</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?php echo base_url()."franchise";?>">FRANCHISING</a>
                      <a class="dropdown-item" href="<?php echo base_url()."careers";?>">CAREERS</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PORTAL</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if($module_name == "products" || $module_name == "news_and_updates"){
                        ?>
                            <a class="dropdown-item" href="<?php echo base_url()."home"?>#login_modal">EMPLOYEES</a>
                        <?php
                        }else{?>
                            <a class="dropdown-item" data-toggle="modal" href="#login_modal">EMPLOYEES</a>
                        <?php }?>
                        <a class="dropdown-item" href="https://ap1.salesforce.com/secur/login_portal.jsp?orgId=00D90000000XlWr&portalId=06090000000LaoB">CUSTOMERS</a>
                    </div>
                </li>
                <li id="contact-link" class="nav-item">
                    <a class="nav-link scroll-link" href="#contact-us">CONTACT US</a>
                </li>
            </ul>
        </div>
    </nav>