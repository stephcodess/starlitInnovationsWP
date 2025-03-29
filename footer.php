<footer id="footer">
    <div class="footer-top">
        <div class="container-xl">
            <div class="footer-logo"
                style="width: 15rem;height: 5rem; overflow-y: hidden;  display: flex; justify-content: center; align-items: center;">
                <a href="./index.html"> <img style="width: 100%; height: auto;"
                        src="<?php echo get_template_directory_uri() . '/assets/images/logo.png' ?>" alt="" /></a>

            </div>
            <div class="display-flex flex-row">
                <div class="footer-contact">

                    <h3>Contact</h3>
                    <?php
                    $technologies_query = new WP_Query(
                        array(
                            'post_type' => 'contact-detail',
                            'posts_per_page' => 1,
                        )
                    );

                    if ($technologies_query->have_posts()):
                        while ($technologies_query->have_posts()):
                            $technologies_query->the_post();
                            ?>
                            <p><?php the_field('address'); ?>
                                <strong>Phone:</strong> <?php the_field('phone_number') ?><br>
                                <strong>Email:</strong> <?php the_field('email'); ?><br>
                            </p>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>

                </div>

                <div class="footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="footer-newsletter">
                    <h4>Join Our Newsletter</h4>
                    <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                    <form action="" method="post">
                        <input placeholder="Enter your email" type="email" name="email">
                        <div class="btn"><button>SUBSCRIBE</button></div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container-xl display-flex flex-row" style="align-items: center;">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>Presento</span></strong>. All Rights Reserved
            </div>
        </div>
        <div class="social-links text-center text-md-end pt-3 pt-md-0">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>
</footer><!-- End Footer -->


<!-- Scroll To Top -->
<div class="scroll-top">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
            style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
        </path>
    </svg>
</div>

<script src="assets/js/vendor/swiper/swiper-bundle.min.js"></script>
<script>
    // ---------- STAR FIELD ----------
    const starsContainer = document.getElementById('stars');
    const starCount = 600;
    for (let i = 0; i < starCount; i++) {
        const star = document.createElement('div');
        star.className = 'star';
        const size = Math.random() * 2 + 1;
        star.style.width = `${size}px`;
        star.style.height = `${size}px`;
        star.style.top = `${Math.random() * window.innerHeight}px`;
        star.style.left = `${Math.random() * window.innerWidth}px`;
        star.style.opacity = `${Math.random() * 0.8 + 0.2}`;
        star.style.animation = `
    twinkle ${Math.random() * 5 + 5}s infinite alternate,
    drift ${Math.random() * 30 + 20}s linear infinite
  `;
        starsContainer.appendChild(star);
    }

</script>


<?php wp_footer(); ?>

</body>

</html>