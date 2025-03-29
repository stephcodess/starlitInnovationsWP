<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!--==============================
     Preloader
    ==============================-->
    <div class="preloader">
        <div class="preloader-inner">
             <img class="loader-logo" src="<?php echo get_template_directory_uri().'/assets/images/logo.png';  ?>" alt="loading" />
        </div>
    </div>

    <div class="contact-btn"><button>GET IN TOUCH</button></div>

    <div class="mobile-nav show">
        <div class="mobile-sub-menu">
            <div class="mobile-close-btn">
                <span>CLOSE</span>
            </div>
            <div class="services.html-nav">
                <ul class="sub-menu">
                    <li>
                        <a href="services.html">Websites design</a>
                    </li>
                    <li>
                        <a href="services.html">website development</a>
                    </li>
                    <li>
                        <a href="services.html">Mobile app</a>
                    </li>
                    <li>
                        <a href="services.html"> WC's</a>
                    </li>
                    <li>
                        <a href="services.html">Bathtubs</a>
                    </li>
                    <li>
                        <a href="services.html">Spa & Wellness</a>
                    </li>
                </ul>
            </div>
            <div class="contacts-nav">
                <ul class="sub-menu">
                    <li>
                        <a href="contact.html">Contact Details</a>
                    </li>
                    <li>
                        <a href="contact.html#information">Showroom Details</a>
                    </li>
                    <li>
                        <a href="">Make An Enquiry</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="nav-container">
            <ol class="container-ul">
                <li><a class="active" href="index.html">home</a></li>
                <li><a class="href-link" href="<?php echo home_url("about-us"); ?>">why us?</a></li>
                <li><a class="href-link" href="process.html">process</a></li>
                <li class="menu-item-has-children open-menu-btn" id="sellers"><a href="<?php echo home_url("services"); ?>">services</a><i
                        class="fas fa-angle-right"></i></li>
                <li><a class="href-link" href="<?php echo home_url( "advice-and-insiprations" ) ?>">projects & inspiration</a></li>
                <li><a class="href-link" href="team.html">professionals</a></li>
                <li><a class="href-link" href="<?php echo home_url( "advice-and-insiprations" ) ?>">advice</a></li>
                <li class="menu-item-has-children open-menu-btn" id="contact">contact <i class="fas fa-angle-right"></i>
                </li>
            </ol>

            <div class="mobile-nav-btns display-flex flex-column">
                <span><a class="href-link" href="">REQUEST APPOINTMENT</a></span>
                <span><a href="Ï">REQUEST QUOTE</a></span>
            </div>
        </div>

    </div>
    <!--==============================
     Header Section
    ==============================-->
    <header class="header-wrapper">
        <div class="header-container">
            <div class="header-content display-flex flex-row">

                <div class="header-logo">
                    <a href="<?php echo site_url(); ?>"> <img
                            src="<?php echo get_template_directory_uri() . '/assets/images/logo.png' ?>" alt="" /></a>
                    <div class="nav-toggle">
                        <!-- <i class="fas fa-bars"></i> -->
                        <div class="toggle-bars"></div>
                    </div>
                </div>
                <div class="header-btns display-flex flex-row">
                    <div class="btn"><button>REQUEST APPOINTMENT</button></div>
                    <div class="btn"><button>REQUEST QUOTE</button></div>
                </div>

            </div>
        </div>
        <div class="header-nav display-flex flex-column">
            <nav class="header-nav-inner display-flex flex-row">
                <ul class="nav-ul">
                    <li><a class="active" href="index.html">home</a>
                    </li>
                    <li><a class="href-link" href="<?php echo home_url("about-us"); ?>">why us?</a></li>
                    <li><a class="href-link" href="">process</a></li>
                    <li class="menu-item-has-children sellers"> <a href="">services <img
                                class="nav-dropdown"
                                src="<?php echo get_template_directory_uri() . '/assets/images/icons/dropdown.png' ?>"
                                alt="" /></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo home_url("services"); ?>">Websites design</a>
                            </li>
                            <li>
                                <a href="services.html">website development</a>
                            </li>
                            <li>
                                <a href="services.html">Mobile app</a>
                            </li>
                            <li>
                                <a href="services.html"> UI/UX</a>
                            </li>
                            <li>
                                <a href="services.html">Graphics design</a>
                            </li>
                            <li>
                                <a href="services.html">Spa & Wellness</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="href-link" href="<?php echo home_url( "portfolio"); ?>">projects & inspiration</a></li>

                    <li><a class="href-link" href="<?php echo home_url( "advice-and-insiprations"); ?>">blogs</a></li>
                    <li class="menu-item-has-children contact"><a href="<?php echo home_url('contact-us') ?>">contact <img class="nav-dropdown"
                                src="./assets/images/icons/dropdown.png" alt="" /></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo home_url('contact-us') ?>">Contact Details</a>
                            </li>
                            <li>
                                <a href="">Make An Enquiry</a>
                            </li>
                        </ul></span>
                </ul>

            </nav>
        </div>
    </header>