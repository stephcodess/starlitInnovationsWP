</div>

<div class="information" id="information">
    <div class="row1">
        <div>
            <h3>Call Us</h3>
            <p>Tel: <a class="href-link" style="color: grey"
                    href="tel:<?php the_field('phone_number'); ?>"><?php the_field('phone_number'); ?></a></p>
        </div>
        <div>
            <h3>Get In Touch</h3>
            <p><a style="color: grey" class="href-link" href="mailto:<?php the_field('email_address'); ?>"><?php the_field('email_address'); ?></a>
            </p>
        </div>
    </div>
    <div class="row2">
        <div>
            <h3>Find Us</h3>
            <p><?php the_field('address'); ?></p>
        </div>
        <div >
            <h3>Showroom</h3>
            <p><?php the_field('opening_times'); ?></p>
        </div>
        <div id="enquiry">
            <h3>Car Parking</h3>
            <p><?php the_field('car_parking'); ?></p>
        </div>
    </div>
</div>