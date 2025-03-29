<!--==============================
     landing Banner
    ==============================-->

<section class="landing-banner d-sm-none"
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
        <div class="left display-flex flex-column">
            <span>
                <?php the_field('section_1_leader_text'); ?>
            </span>
        </div>

        <div class="right display-flex flex-column" data-aos="zoom-out-up" data-aos-duration="3000">

            <?php the_field('section_1_text'); ?>


        </div>
    </div>
</section>

<section class="internal-page-section-3 about-us">
    <div class="grey-bg">
    </div>
    <div class="container">
        <div class="row-bgs">
            <div class="row1">
                <div class="img" data-aos="zoom-out-up" data-aos-duration="2000"
                    style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/about-us/image-1.png);">
                </div>
                <div class="text-wrapper">
                    <h3 data-aos="zoom-out-up" data-aos-duration="1000"><?php the_field("section_2_title") ?></h3>
                    <p data-aos="zoom-out-up" data-aos-duration="2000"><?php the_field("section_2_text") ?></p>
                    <a href="<?php the_field("section_1_button_url") ?>">
                        <div data-aos="zoom-out-up" data-aos-duration="3000" class="primary">
                            <button style="text-transform: uppercase;"><?php the_field("section_1_button"); ?></button>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row2" data-aos="zoom-out-up" data-aos-duration="3000">
                <div class="img"
                    style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/about-us/basin.png);">
                </div>
            </div>
        </div>
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
    </div>
</section>
<section class="internal-page-section-3">
    <div class="container">
        <div class="row-bgs">
            <div class="row1">
                <div class="img" data-aos="zoom-out-up" data-aos-duration="2000"
                    style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/about-us/image2.png);">
                    <!-- <img src="./assets/images/brochure/leftBg.png" /> -->
                </div>
                <div class="text-wrapper">
                    <h3 data-aos="zoom-out-up" data-aos-duration="1000"><?php the_field('section_4_title') ?></h3>
                    <p data-aos="zoom-out-up" data-aos-duration="2000"><?php the_field('section_4_text') ?></p>
                    <a href="<?php the_field('section_4_button_url') ?>">
                        <div data-aos="zoom-out-up" data-aos-duration="3000" class="primary">
                            <button style="text-transform: uppercase;"><?php the_field('section_4_button') ?></button>
                        </div>
                    </a>

                </div>
            </div>
            <div class="row2" data-aos="zoom-out-up" data-aos-duration="2000">
                <div class="img"
                    style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/about-us/image3.png); background-position: 20% 20%">
                    <!-- <img src="./assets/images/brochure/rightBg.png" /> -->
                </div>
            </div>
        </div>
    </div>
</section>