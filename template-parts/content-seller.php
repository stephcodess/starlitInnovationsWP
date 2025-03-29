<?php

$display_order = get_field('display_order');

$image_url = get_field('image_long')['url'];
?>
<div class="each <?php echo $display_order === '1' ? 'long' : 'short' ?>" data-aos="zoom-out-up-"
    data-aos-duration="2000">
    <div class="image-title">
        <span><?php the_title() ?></span>
    </div>
    <img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" />
</div>