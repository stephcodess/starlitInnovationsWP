<!--==============================
     landing Banner
    ==============================-->
<section class="landing-banner home d-sm-none"
    style="background-image:url(<?php echo get_field('banner_image_desktop')['url'] ?>)">
    <div class="landing-banner-text display-flex flex-column" data-aos="fade-in-right" data-aos-duration="3000">
        <span><?php the_field('main_banner_text') ?></span>
        <span><?php the_field('main_banner_title') ?></span>

    </div>
</section>
<section class="landing-banner d-lg-none"
    style="background-image:url(<?php echo get_field('banner_image_mobile')['url'] ?>)">
    <div class="landing-banner-text display-flex flex-column" data-aos="fade-in-right" data-aos-duration="3000">
        <span><?php the_field('main_banner_text') ?></span>
        <span><?php the_field('main_banner_title') ?></span>

    </div>
</section>

<!--==============================
     section one
    ==============================-->
<section class="internal-page-section-1">
    <div class="inner display-flex flex-row container">
        <div class="left display-flex flex-column" data-aos="zoom-out-right" data-aos-duration="2000">
            <span>
                <?php the_field('section_1_leader_text') ?>
            </span>
        </div>

        <div class="right display-flex flex-column" data-aos="zoom-out-left" data-aos-duration="3000">

            <?php the_field('section_1_text') ?>


        </div>
    </div>
</section>

<section class="internal-page-section-2" data-aos="zoom-out-up" data-aos-duration="2000">
    <h1 class="section-title"><?php the_field('section_2_title') ?></h1>
    <div class="container">
        <div class="dropdowns">
            <div class="dropdown-item">
                <div class="toggle open"><img
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/dropdown.png" /></div>
                <div class="column">
                    <div class="dropdown-header">
                        <h2><?php the_field('interior_designers_title') ?></h2>
                    </div>
                    <div class="dropdown-content">
                        <p><?php the_field('interior_designers_text') ?></p>
                    </div>
                </div>
            </div>
            <div class="dropdown-item">
                <div class="toggle closed"><img
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/dropdown.png" /></div>
                <div class="column">
                    <div class="dropdown-header">
                        <h2><?php the_field('architects_title') ?></h2>
                    </div>
                    <div class="dropdown-content">
                        <p> <?php the_field('architects_text') ?></p>
                    </div>
                </div>
            </div>
            <div class="dropdown-item">
                <div class="toggle closed"><img
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/dropdown.png" /></div>
                <div class="column" style="border: none;">
                    <div class="dropdown-header">
                        <h2><?php the_field('developers_title') ?></h2>
                    </div>
                    <div class="dropdown-content">
                        <p><?php the_field('developers_text') ?></p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <br/>
    <div class="dual-btn-wrapper" data-aos="zoom-out-up-" data-aos-duration="3000">
            <a href="<?php echo esc_url(home_url('/contact')); ?>" data-aos="zoom-out-up-" data-aos-duration="2000">
                <div class="primary"> <button>Contact us</button></div>
            </a>
            <a href="<?php echo esc_url(home_url('/project-listings')); ?>" data-aos="zoom-out-up-" data-aos-duration="2000">
                <div class="primary"> <button>Discover More</button></div>
            </a>
        </div>
</section>
<section class="internal-page-section-3">
    <h1><?php the_field('section_3_title') ?></h1>
    <div class="container">
        <div class="first-row">
            <div class="each" data-aos="zoom-out-up" data-aos-duration="1000">
                <span class="number">01</span>
                <p><?php the_field('section_3a_text') ?></p>
            </div>
            <div class="each" data-aos="zoom-out-up" data-aos-duration="2000">
                <span class="number">02</span>
                <p><?php the_field('section_3b_text') ?></p>
            </div>
            <div class="each" data-aos="zoom-out-up" data-aos-duration="3000">
                <span class="number">03</span>
                <p><?php the_field('section_3c_text') ?></p>
            </div>
        </div>

        <div class="row-bgs">
            <div class="row1">
                <div class="img" data-aos="zoom-out-right" data-aos-duration="2000"
                    style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/brochure/leftBg.png);">
                    <!-- <img src="/assets/images/brochure/leftBg.png" /> -->
                </div>
                <div class="text-wrapper" data-aos="zoom-out-up" data-aos-duration="3000">
                    <h3><?php the_field('section_4_title') ?></h3>
                    <p><?php the_field('section_4_text') ?></p>
                    <a class="primary" href="<?php the_field('section_4_button_url') ?>">
                      <button><?php the_field('section_4_button') ?></button>
                    </a>
                </div>
            </div>
            <div class="row2">
                <div class="img" data-aos="zoom-out-left" data-aos-duration="3000"
                    style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/brochure/rightBg.png);">
                    <!-- <img src="/assets/images/brochure/rightBg.png" /> -->
                </div>
            </div>
        </div>
    </div>
</section>