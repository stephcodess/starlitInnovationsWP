<?php
/*
Template Name: Blog Detail
*/

get_header();
?>

<section class="blog-detail-section">
    <div class="container">
        <div class="detail-wrapper">
            <?php

            $post_slug = get_query_var('post_slug');
            if ($post_slug) {
                // Set up a custom query to fetch the post by its slug
                $args = array(
                    'name' => $post_slug,
                    'post_type' => 'post',
                    'posts_per_page' => 1,
                );

                $details_query = new WP_Query($args);

                if ($details_query->have_posts()):
                    while ($details_query->have_posts()):
                        $details_query->the_post();
                        ?>
                        <div class="blog-img" data-aos="fade-up" data-aos-duration="3000">
                            <img src="<?php echo get_field('display_image')['url']; ?>" alt="" />
                        </div>
                        <?php echo get_field('post_content'); ?>
                        <?php
                    endwhile;

                    wp_reset_postdata();
                else:
                    echo '<p>No post found.</p>';
                endif;
            } else {
                echo '<p>No post slug provided.</p>';
            }

            ?>
        </div>
    </div>
</section>

<?php get_footer() ?>