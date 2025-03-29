<?php
/*
Template Name: Contacts Page
*/

get_header();
?>

<!-- CONTACT FORM SECTION START -->
<section class="contact-page-section">
    <div class="wrapper">
        <div class="writeups">

            <?php
            $args = array(
                'post_type' => 'page',
                'name' => 'contact-us',
                'posts_per_page' => 1,
            );
            $contact_page_query = new WP_Query($args);

            if ($contact_page_query->have_posts()):
                while ($contact_page_query->have_posts()):
                    $contact_page_query->the_post();

                    ?>
                    <h1 class="section-title"><?php the_field('contact_heading') ?></h1>
                    <p><?php the_field('contact_description'); ?></p>
                    <?php
                endwhile;

            endif;
            ?>
            <?php
            $args = array(
                'post_type' => 'contact-detail',
                'posts_per_page' => 1,
            );
            $contacts_query = new WP_Query($args);

            if ($contacts_query->have_posts()):
                while ($contacts_query->have_posts()):
                    $contacts_query->the_post();

                    get_template_part('template-parts/content', 'contact');
                endwhile;

            endif;
            ?>


        </div>
        <div>
            <h1 class="section-title" style="font-size: 1.5rem; margin-top: 3rem;">MAKE AN ENQUIRY</h1>
            <iframe id="" allowtransparency="true" allowfullscreen="true" allow="geolocation; microphone; camera"
                src="https://my.forms.app/form/667e823c0ab1f70d92230e7f" frameborder="0"
                style="width: 100%; min-width:100%; height:1600px; border:none;"></iframe>
        </div>
</section>
<!-- CONTACT FORM SECTION END -->

<?php
get_footer();
?>