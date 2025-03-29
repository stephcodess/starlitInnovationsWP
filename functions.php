<?php
function your_theme_enqueue_assets()
{
    // Enqueue local stylesheets
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/fontawesome.min.css');
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css');
    wp_enqueue_style('theme-setup-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('aos', get_template_directory_uri() . '/assets/css/aos.css');
    wp_enqueue_style('swiper-css', get_template_directory_uri() . '/assets/js/vendor/swiper/swiper-bundle.min.css');

    // Enqueue stylesheet from CDN
    wp_enqueue_style('circe-font', 'https://use.typekit.net/col4zqg.css');
    wp_enqueue_style('glightbox-css', get_template_directory_uri() . '/assets/js/vendor/glightbox/css/glightbox.min.css');
    wp_enqueue_style('the-seasons-font', 'https://use.typekit.net/col4zqg.css');

    // Enqueue JavaScript files
    wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/vendor/jquery-3.6.0.min.js', array(), null, true);
    wp_enqueue_script('aos', get_template_directory_uri() . '/assets/js/aos.js', array(), null, true);
    wp_enqueue_script('glightbox', get_template_directory_uri() . '/assets/js/vendor/glightbox/js/glightbox.min.js', array(), null, true);
    wp_enqueue_script('swiper-js', get_template_directory_uri() . '/assets/js/vendor/swiper/swiper-bundle.min.js', array(), null, true);
    wp_enqueue_script('isotope-layout', get_template_directory_uri() . '/assets/js/vendor/isotope-layout/isotope.pkgd.min.js', array(), null, true);
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);

    // Initialize AOS in a custom script
    wp_add_inline_script('aos', 'AOS.init({ once: true });');

}
add_action('wp_enqueue_scripts', 'your_theme_enqueue_assets');


function set_permalink_structure()
{
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();
}
add_action('init', 'set_permalink_structure');


function create_custom_page($page_title, $page_template = '')
{
    $page_check = get_page_by_title($page_title);
    $new_page_id = '';

    if (!isset($page_check->ID)) {
        $new_page = array(
            'post_type' => 'page',
            'post_title' => $page_title,
            'post_status' => 'publish',
            'post_author' => 1,
        );
        $new_page_id = wp_insert_post($new_page);

        if (!empty($page_template)) {
            update_post_meta($new_page_id, '_wp_page_template', $page_template);
        }
    }
}

function create_all_pages()
{
    create_custom_page('About Us', 'template-about.php');
    create_custom_page('Team', 'template-team.php');
    create_custom_page('Advice And Insiprations', 'template-blogs.php');
    create_custom_page('Home', 'index.php');
    create_custom_page('Services', 'template-services.php');
    create_custom_page('Portfolio', 'template-portfolio.php');
    create_custom_page('Blog details', 'template-blog-details.php');
    create_custom_page('Contact Us', 'template-contact.php');
}

function create_and_set_pages()
{
    create_all_pages();
    $home_page = get_page_by_title('Home');
    if ($home_page != null) {
        update_option('page_on_front', $home_page->ID);
        update_option('show_on_front', 'page');
    }
}
add_action('after_setup_theme', 'create_and_set_pages');

function enqueue_ajax_search_script()
{
    wp_enqueue_script('ajax-search', get_template_directory_uri() . '/js/ajax-search.js', array('jquery'), null, true);
    wp_localize_script('ajax-search', 'ajax_search_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax_search_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_search_script');


function handle_ajax_search()
{
    // Verify nonce for security
    check_ajax_referer('ajax_search_nonce', 'nonce');

    $search_query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        's' => $search_query, // WordPress standard search for relevance
    );

    // Use custom SQL LIKE queries for fuzzy search
    global $wpdb;
    $search_query_escaped = esc_sql($search_query);
    $fuzzy_query = "
        SELECT DISTINCT ID
        FROM {$wpdb->posts}
        WHERE (post_title LIKE '%$search_query_escaped%' 
            OR post_content LIKE '%$search_query_escaped%') 
            AND post_type = 'post'
            AND post_status = 'publish'
    ";

    $fuzzy_results = $wpdb->get_col($fuzzy_query);

    // Combine standard WP_Query with fuzzy results
    if (!empty($fuzzy_results)) {
        $args['post__in'] = $fuzzy_results; // Include only IDs that matched fuzzy search
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            // Highlight the search term in the title
            $highlighted_title = str_ireplace($search_query, "<span class='highlight'>$search_query</span>", get_the_title());
            // $highlighted_excerpt = str_ireplace($search_query, "<span class='highlight'>$search_query</span>", the_field('caption_text'));

            ?>
            <div class="each-blog" data-aos="fade-up" data-aos-duration="1000">
                <img src="<?php echo get_field('display_image')['url']; ?>" alt="" />
                <div class="blog-details">
                    <h1><?php echo $highlighted_title; ?></h1>
                    <p><?php the_field('caption_text'); ?></p>
                    <a class="href-link" href="<?php the_permalink(); ?>">Read more</a>
                </div>
            </div>
            <?php
        }
    } else {
        echo '<p>No posts found.</p>';
    }


    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_ajax_search', 'handle_ajax_search');
add_action('wp_ajax_nopriv_ajax_search', 'handle_ajax_search');


function handle_ajax_category_filter()
{
    // Verify nonce for security
    check_ajax_referer('ajax_search_nonce', 'nonce');

    $category_id = isset($_POST['category_id']) && $_POST['category_id'] !== 'all' ? intval($_POST['category_id']) : '';

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
    );

    if ($category_id) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $category_id,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="each-blog" data-aos="fade-up" data-aos-duration="1000">
                <img src="<?php echo get_field('display_image')['url']; ?>" alt="" />
                <div class="blog-details">
                    <h1><?php the_title(); ?></h1>
                    <p><?php the_field('caption_text'); ?></p>
                    <a class="href-link" href="<?php the_permalink(); ?>">Read more</a>
                </div>
            </div>
            <?php
        }
    } else {
        echo '<p>No posts found for this category.</p>';
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_ajax_category_filter', 'handle_ajax_category_filter');
add_action('wp_ajax_nopriv_ajax_category_filter', 'handle_ajax_category_filter');


function enqueue_infinite_scroll_script()
{
    wp_enqueue_script('infinite-scroll', get_template_directory_uri() . '/js/infinite-scroll.js', array('jquery'), null, true);
    wp_localize_script('infinite-scroll', 'ajax_search_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax_search_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_infinite_scroll_script');


function handle_ajax_load_more_posts()
{
    // Verify nonce
    check_ajax_referer('ajax_search_nonce', 'nonce');

    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'paged' => $page,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="each-blog" data-aos="fade-up" data-aos-duration="1000">
                <img src="<?php echo get_field('display_image')['url']; ?>" alt="" />
                <div class="blog-details">
                    <h1><?php the_title(); ?></h1>
                    <p><?php the_field('caption_text'); ?></p>
                    <a class="href-link" href="<?php the_permalink(); ?>">Read more</a>
                </div>
            </div>
            <?php
        }
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_more_posts', 'handle_ajax_load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'handle_ajax_load_more_posts');

function add_custom_rewrite_rules()
{
    add_rewrite_rule('^blog-details/([^/]*)/?', 'index.php?pagename=blog-details&post_slug=$matches[1]', 'top');
    add_rewrite_rule('^project-details/([^/]*)/?', 'index.php?pagename=project-details&post_slug=$matches[1]', 'top');
    add_rewrite_rule('^best-sellers/([^/]*)/?', 'index.php?pagename=best-sellers&post_slug=$matches[1]', 'top');
}
add_action('init', 'add_custom_rewrite_rules');

function add_query_vars($vars)
{
    $vars[] = 'post_slug';
    return $vars;
}
add_filter('query_vars', 'add_query_vars');


// CONTACT US SECTION
// Enqueue inline AJAX script for contact form
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('jquery');

    // Output inline JS for the contact form
    add_action('wp_footer', function () {
        ?>
        <script>
            jQuery(document).ready(function ($) {
                $('#contactForm').on('submit', function (e) {
                    e.preventDefault();

                    let formData = $(this).serialize();

                    $.ajax({
                        url: "<?php echo admin_url('admin-ajax.php'); ?>",
                        type: 'POST',
                        data: {
                            action: 'submit_contact_form',
                            form_data: formData
                        },
                        success: function (response) {
                            $('#form-response').html('<p style="color: green;">' + response.data + '</p>');
                        },
                        error: function (xhr) {
                            $('#form-response').html('<p style="color: red;">Something went wrong. Please try again.</p>');
                        }
                    });
                });
            });
        </script>
        <?php
    });
});

// Handle form submission (AJAX)
add_action('wp_ajax_submit_contact_form', 'handle_contact_form');
add_action('wp_ajax_nopriv_submit_contact_form', 'handle_contact_form');

function handle_contact_form()
{
    parse_str($_POST['form_data'], $form_data);

    $name = sanitize_text_field($form_data['name']);
    $company = sanitize_text_field($form_data['company']);
    $message = sanitize_textarea_field($form_data['message']);
    $email = sanitize_email($form_data['email']);
    $phone = sanitize_text_field($form_data['phone']);
    $referral = sanitize_text_field($form_data['referral']);

    $to = get_option('admin_email');
    $subject = "New Contact Form Submission";
    $body = "Name: $name\nCompany: $company\nEmail: $email\nPhone: $phone\nReferral: $referral\n\nMessage:\n$message";
    $headers = ['Content-Type: text/plain; charset=UTF-8'];

    if (wp_mail($to, $subject, $body, $headers)) {
        wp_send_json_success("Thanks! We'll get back to you soon.");
    } else {
        wp_send_json_error("Failed to send. Try again later.");
    }

    wp_die(); // Important to terminate AJAX
}
