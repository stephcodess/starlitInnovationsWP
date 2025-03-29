<?php
/*
Template Name: Advice and Inspirations Page
*/

get_header();

$blog_post_query = new WP_Query(
    array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'paged' => 1, // Default to the first page
    )
);
?>

<section class="blog-section">
    <div class="blog-section-header">
        <h2>EMBRACE THE ART OF WINDING DOWN</h2>
        <p class="container">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque iure, ab veniam quia ipsa autem distinctio
            repellat dignissimos ex obcaecati qui sed ratione quae eveniet dolore! Voluptatem, autem! Vero, dolorem?
        </p>
        <div class="blog-search">
            <input id="blog-search-input" type="text" placeholder="SEARCH FOR BLOG POST" />
        </div>

    </div>
    <div class="container-xl">

        <div class="post-categories display-flex">
            <h2>ALL CATEGORIES</h2>
            <div class="categories display-flex flex-row">
                <span style="cursor:pointer;" class="href-link active" data-category-id="all">All</span>
                <?php
                $taxonomy = 'category';

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
                        <span style="cursor:pointer;" class="href-link"
                            data-category-id="<?php echo $service_category->term_id; ?>">
                            <?php echo $service_category->name; ?>
                        </span>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>

        <h2 class="post-header">LATEST BLOG POSTS</h2>
        <div class="blog-listing" data-page="1" data-max-pages="<?php echo $blog_post_query->max_num_pages; ?>">
            <?php
           
            if ($blog_post_query->have_posts()):
                while ($blog_post_query->have_posts()):
                    $blog_post_query->the_post();
                    ?>
                    <div class="each-blog" data-aos="fade-up" data-aos-duration="1000">
                        <img src="<?php echo get_field('display_image')['url']; ?>" alt="" />
                        <div class="blog-details">
                            <h1><?php the_title(); ?></h1>
                            <p><?php the_field('caption_text'); ?></p>
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
        <div class="loading-spinner" style="display: none;">Loading...</div>

        <!-- <div class="btn" style="margin: auto; margin-top: 5rem;">
            <button>VIEW MORE POSTS</button>
        </div> -->
    </div>
</section>


<?php get_footer(); ?>

<style>
    .highlight {
        background-color: yellow;
        font-weight: bold;
    }

    .href-link.active {
        font-weight: bold;
        border-bottom: 3px solid var(--theme-color);
        color: var(--primary-font-color) !important;
    }

    .loading-spinner {
        text-align: center;
        margin: 20px 0;
        font-size: 16px;
    }
</style>

<script>
    jQuery(document).ready(function ($) {
        let searchTimeout;

        $('#blog-search-input').on('input', function () {
            clearTimeout(searchTimeout);
            const query = $(this).val();

            searchTimeout = setTimeout(function () {
                $.ajax({
                    url: ajax_search_params.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'ajax_search',
                        query: query,
                        nonce: ajax_search_params.nonce,
                    },
                    beforeSend: function () {
                        $('.blog-listing').html('<p>Loading...</p>'); // Show loading message
                    },
                    success: function (response) {
                        $('.blog-listing').html(response);
                    },
                    error: function () {
                        $('.blog-listing').html('<p>An error occurred. Please try again.</p>');
                    },
                });
            }, 300); // Debounce for better UX
        });

        $('.categories .href-link').on('click', function () {
            const categoryId = $(this).data('category-id');

            $('.categories .href-link').removeClass('active');
            $(this).addClass('active');

            $.ajax({
                url: ajax_search_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'ajax_category_filter',
                    category_id: categoryId,
                    nonce: ajax_search_params.nonce,
                },
                beforeSend: function () {
                    $('.blog-listing').html('<p>Loading...</p>'); // Show loading message
                },
                success: function (response) {
                    $('.blog-listing').html(response);
                },
                error: function () {
                    $('.blog-listing').html('<p>An error occurred. Please try again.</p>');
                },
            });
        });


        let loading = false;

        function loadMorePosts() {
            if (loading) return;

            const container = $('.blog-listing');
            const page = parseInt(container.attr('data-page'), 10);
            const maxPages = parseInt(container.attr('data-max-pages'), 10);

            if (page >= maxPages) return;

            loading = true;
            $('.loading-spinner').show();

            $.ajax({
                url: ajax_search_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'load_more_posts',
                    page: page + 1,
                    nonce: ajax_search_params.nonce,
                },
                success: function (response) {
                    container.append(response);
                    container.attr('data-page', page + 1);
                    loading = false;
                    $('.loading-spinner').hide();
                },
                error: function () {
                    console.log('An error occurred while loading more posts.');
                    $('.loading-spinner').hide();
                    loading = false;
                },
            });
        }

        $(window).on('scroll', function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                loadMorePosts();
            }
        });
    });


</script>