<?php
/*
Template Name: Front Page
*/

get_header();
?>
<?php
$args = array(
    'post_type' => 'page',
    'name' => 'home',
    'posts_per_page' => 1,
);

$contacts_query = new WP_Query($args);

?>
<?php

if ($contacts_query->have_posts()):
    while ($contacts_query->have_posts()):
        $contacts_query->the_post();
        ?>
        <section class="landing-banner">
            <div class="left-banner-text">
                <span><?php the_field('banner_header_text'); ?></span>
                <p><?php the_field('banner_paragraph_text'); ?></p>
                <button><?php the_field('banner_button_text'); ?></button>
            </div>
            <div class="stars" id="stars"></div>
            <div class="globe-container">

            </div>
        </section>

        <section class="services-section">
            <div class="container">
                <h1 class="section-title"><?php the_field('section_1_title'); ?></h1>
                <p class="section-paragraph"><?php the_field('section_1_paragraph'); ?></p>
                <div class="services-wrapper display-flex flex-row">
                    <?php
                    $taxonomy = 'service-category';

                    // Fetch all terms for the taxonomy
                    $service_categories = get_terms(
                        array(
                            'taxonomy' => $taxonomy,
                            'hide_empty' => true,
                        )
                    );

                    if (!empty($service_categories) && !is_wp_error($service_categories)):
                        foreach ($service_categories as $service_category):
                            ?>
                            <div class="service">
                                <img src="<?php echo get_template_directory_uri() . '/assets/images/icons/service-icon-uiux-design.svg' ?>"
                                    alt="services" />
                                <h2><?php echo $service_category->name; ?></h2>

                                <?php
                                // Query services in this category
                                $services_query = new WP_Query(
                                    array(
                                        'post_type' => 'service', // Your custom post type name
                                        'posts_per_page' => -1,
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => $taxonomy,
                                                'field' => 'term_id',
                                                'terms' => $service_category->term_id,
                                            ),
                                        ),
                                    )
                                );

                                if ($services_query->have_posts()):
                                    ?>
                                    <ul>
                                        <?php
                                        while ($services_query->have_posts()):
                                            $services_query->the_post();
                                            ?>
                                            <li>
                                                <a href="<?php the_permalink(); ?>" class="href-link"><?php the_title(); ?></a>
                                            </li>
                                            <?php
                                        endwhile;
                                        ?>
                                    </ul>
                                    <?php
                                    wp_reset_postdata();
                                endif;
                                ?>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?>

                </div>
                <div class="btn"><button><?php the_field('section_1_button_text'); ?></button></div>
            </div>
        </section>

        <section class="technologies-section">
            <h1 class="section-title">
                <?php the_field('section_2_title'); ?>
            </h1>
            <p class="section-paragraph"><?php the_field('section_2_description'); ?></p>
            <div class="tech-wrapper">
                <?php
                $technologies_query = new WP_Query(
                    array(
                        'post_type' => 'programming-language',
                        'posts_per_page' => -1,
                    )
                );

                if ($technologies_query->have_posts()):
                    while ($technologies_query->have_posts()):
                        $technologies_query->the_post();
                        ?>
                        <a href="<?php the_permalink(); ?>" class="each-tech">

                            <img src="<?php echo get_field('image')['url']; ?>" alt="" />
                            <span><?php the_title(); ?></span>


                        </a>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </section>

        <!-- ======= Services Section ======= -->
        <section id="services" class="call-to-collab section-bg ">
            <div class="container" data-aos="fade-up">
                <h1><?php the_field('section_3_header'); ?></h1>
                <span><?php the_field('section_3_desc1'); ?></span>
                <p><?php the_field('section_3_desc2'); ?></p>
                <div class="btn"><button><?php the_field('section_3_button_text'); ?></button></div>
            </div>
        </section><!-- End Services Section -->


        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials">
            <div class="container-xl" data-aos="fade-up">
                <h2 class="section-title"><?php the_field('testimonial_section_title') ?></h2>
                <p class="section-paragraph"><?php the_field('testimonial_section_desc') ?></p>

                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">

                        <?php
                        $technologies_query = new WP_Query(
                            array(
                                'post_type' => 'testimonial',
                                'posts_per_page' => -1,
                            )
                        );

                        if ($technologies_query->have_posts()):
                            while ($technologies_query->have_posts()):
                                $technologies_query->the_post();
                                ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-wrap">
                                        <div class="testimonial-item">
                                            <img src="<?php echo get_field('image')['url']; ?>" class="testimonial-img" alt="">
                                            <h3><?php the_field('name'); ?></h3>
                                            <h4><?php the_field('role'); ?></h4>
                                            <p>
                                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                                <?php the_field('testimony'); ?>
                                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>



                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Testimonials Section -->

        <section class="advice-section">
            <div class="container-xl">
                <h1 class="section-title" data-aos="zoom-out"><?php the_field('work_with_us_title') ?></h1>
                <p class="section-paragraph"><?php the_field('work_with_us_desc') ?></p>
                <div class="blog-wrapper">
                    <div class="each-blog" data-aos="zoom-out-up" data-aos-duration="1000">
                        <div class="blog-img">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/blog/blog1.png' ?>" alt="" />
                        </div>
                        <div class="blog-text">
                            <h1>starlit Title</h1>
                            <span class="category"><a class="href-link" href="">UI/UX</a></span>
                            <p>
                                Lorem ipsum, or lipsum as it is sometimes known, is dummy text used
                            </p>
                        </div>
                    </div>
                    <div class="each-blog" data-aos="zoom-out-up" data-aos-duration="2000">
                        <div class="blog-img">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/blog/blog2.png' ?>" alt="" />
                        </div>
                        <div class="blog-text">
                            <h1>starlit Title</h1>
                            <span class="category"><a class="href-link" href="">UI/UX</a></span>
                            <p>
                                Lorem ipsum, or lipsum as it is sometimes known, is dummy text used
                            </p>
                        </div>
                    </div>
                    <div class="each-blog" data-aos="zoom-out-up" data-aos-duration="3000">
                        <div class="blog-img">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/blog/blog3.png' ?>" alt="" />
                        </div>
                        <div class="blog-text">
                            <h1>starlit Title</h1>
                            <span class="category"><a class="href-link" href="">UI/UX</a></span>
                            <p>
                                Lorem ipsum, or lipsum as it is sometimes known, is dummy text used
                            </p>
                        </div>
                    </div>
                </div>
                <div class="btn"><button>SEE MORE CASE STUDIES</button></div>
            </div>
        </section>
        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="" data-aos="fade-up">
                <h2 class="section-title"><?php the_field('portfolio_section_title') ?></h2>
                <p style="text-align: center;"><?php the_field('portfolio_section_desc') ?></p>
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-app">App</li>
                            <li data-filter=".filter-card">Card</li>
                            <li data-filter=".filter-web">Web</li>
                        </ul>
                    </div>
                </div>

                <div class="display-flex flex-row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                    <div class="portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-1.jpg' ?>"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>App 1</h4>
                                <p>App</p>
                                <div class="portfolio-links">
                                    <a href="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-1.jpg' ?> "
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i
                                            class="bx bx-plus"></i>ghg</a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="portfolio-item filter-web">
                        <div class="portfolio-wrap">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-2.jpg' ?>"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Web 3</h4>
                                <p>Web</p>
                                <div class="portfolio-links">
                                    <a href="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-2.jpg' ?> "
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-3.jpg' ?>"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>App 2</h4>
                                <p>App</p>
                                <div class="portfolio-links">
                                    <a href="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-3.jpg' ?> "
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 2"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="portfolio-item filter-card">
                        <div class="portfolio-wrap">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-4.jpg' ?>"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Card 2</h4>
                                <p>Card</p>
                                <div class="portfolio-links">
                                    <a href="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-4.jpg' ?> "
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 2"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="portfolio-item filter-web">
                        <div class="portfolio-wrap">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-5.jpg' ?>"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Web 2</h4>
                                <p>Web</p>
                                <div class="portfolio-links">
                                    <a href="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-5.jpg' ?> "
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 2"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-6.jpg' ?>"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>App 3</h4>
                                <p>App</p>
                                <div class="portfolio-links">
                                    <a href="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-6.jpg' ?> "
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 3"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="portfolio-item filter-card">
                        <div class="portfolio-wrap">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-7.jpg' ?>"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Card 1</h4>
                                <p>Card</p>
                                <div class="portfolio-links">
                                    <a href="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-7.jpg' ?> "
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 1"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="portfolio-item filter-card">
                        <div class="portfolio-wrap">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-8.jpg' ?>"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Card 3</h4>
                                <p>Card</p>
                                <div class="portfolio-links">
                                    <a href="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-8.jpg' ?> "
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 3"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="portfolio-item filter-web">
                        <div class="portfolio-wrap">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-9.jpg' ?>"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Web 3</h4>
                                <p>Web</p>
                                <div class="portfolio-links">
                                    <a href="<?php echo get_template_directory_uri() . '/assets/images/portfolio/portfolio-9.jpg' ?> "
                                        data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i
                                            class="bx bx-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="btn" style="margin: auto;"><button><?php the_field('portfolio_section_btn') ?></button></div>

            </div>
        </section><!-- End Portfolio Section -->

        <!-- Blog the Blog -->
        <section class="advice-section">
            <h1 class="section-title" data-aos="zoom-out"><?php the_field('blog_section_title') ?></h1>
            <p class="section-paragraph"><?php the_field('blog_section_desc') ?></p>

            <div class="blog-wrapper">
                <?php
                $blogs_query = new WP_Query(
                    array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'meta_query' => array(
                            array(
                                'key' => 'show_on_homepage',
                                'value' => 'yes',
                                'compare' => 'LIKE',
                            ),
                        ),
                    )
                );

                if ($blogs_query->have_posts()):
                    while ($blogs_query->have_posts()):
                        $blogs_query->the_post();
                        ?>
                        <div class="each-blog" data-aos="zoom-out-up" data-aos-duration="1000">
                            <div class="blog-img">
                                <img src="<?php echo get_field('display_image')['url']; ?>" alt="" />
                            </div>
                            <div class="blog-text">
                                <h1><?php the_title(); ?></h1>
                                <!-- <span class="category"><a class="href-link" href="">UI/UX</a></span> -->
                                <p>
                                    <?php the_field('caption_text'); ?>
                                </p>
                                <!-- <a class="href-link" href="<php the_permalink(); ?>">Read more</a> -->
                                <a class="href-link" href="<?php echo site_url('/blog-details/' . $post->post_name); ?>">Read
                                    more</a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>

            </div>
            <div class="btn"><button><?php the_field('blog_section_btn_text') ?></button></div>
        </section>

        <section class="footer-mobile-nav" data-aos="zoom-out">
            <div class="container dropdowns">
                <h1 class="section-title"><?php the_field('faq_section_title') ?>
                </h1>
                <p><?php the_field('faqs_section_description') ?>
                </p>
                <?php
                $technologies_query = new WP_Query(
                    array(
                        'post_type' => 'faq',
                        'posts_per_page' => -1,
                    )
                );

                if ($technologies_query->have_posts()):
                    while ($technologies_query->have_posts()):
                        $technologies_query->the_post();
                        ?>
                        <div class="dropdown-item">
                            <div class="dropdown-header">
                                <h2><?php the_title(); ?></h2><img
                                    src="<?php echo get_template_directory_uri() . '/assets/images/icons/plus.png' ?>" alt="" />
                            </div>
                            <div class="dropdown-answer">
                                <div class="answers">
                                    <p><?php the_field('answer'); ?></p>

                                </div>
                            </div>
                        </div>

                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </section>

        <section class="contact-section">
            <div class="container-xl">
                <div class="contact-info">
                    <h1><?php the_field('contact_section_title') ?></h1>
                    <p><?php the_field('contact_section_description') ?></p>
                    <ul>
                        <?php
                        $contact_query = new WP_Query(
                            array(
                                'post_type' => 'contact-detail',
                                'posts_per_page' => 1,
                            )
                        );
                        if ($contact_query->have_posts()):
                            while ($contact_query->have_posts()):
                                $contact_query->the_post();
                                ?>
                                <li><?php the_field('email_address'); ?></li>
                                <li><?php the_field('phone_number') ?></li>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>

                    </ul>
                </div>
                <div class="contact-form">
                    <form id="contactForm">

                        <div class="display-flex flex-column">
                            <label>Name <span class="required">*</span></label>
                            <input placeholder="Your Name" type="text" name="name" required />
                        </div>
                        <div class="display-flex flex-column">
                            <label>Company <span class="required">*</span></label>
                            <input placeholder="Company Name or Website" type="text" name="company" required />
                        </div>
                        <div class="display-flex flex-column">
                            <label>How we can help? <span class="required">*</span></label>
                            <textarea name="message" required
                                placeholder="Tell us about your Product or Business challenge. We will contact you back shortly to discuss details."></textarea>
                        </div>
                        <div class="display-flex flex-column">
                            <label>Email Address <span class="required">*</span></label>
                            <input placeholder="Your Email Address" type="email" name="email" required />
                        </div>
                        <div class="display-flex flex-column">
                            <label>Phone Number <span class="required">*</span></label>
                            <input placeholder="Your Phone Number" type="text" name="phone" required />
                        </div>
                        <div class="display-flex flex-column">
                            <label>How did you find us? <span class="required">*</span></label>
                            <input placeholder="Google, Clutch, Facebook etc" type="text" name="referral" />
                        </div>
                        <div id="form-response"></div>

                        <div class="btn"><button type="submit">REQUEST BROCHURE</button></div>
                        </>

                </div>
            </div>
        </section>
        <?php
    endwhile;
    wp_reset_postdata();
endif;
?>
<?php get_footer(); ?>