<?php

/**
 * Template Name: Kontakt
 */

get_header(); ?>
    <div class="contact">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <div class="contact-feature">
                <?php if ( has_post_thumbnail() ) :
                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>

                    <img
                            src="<?=$featured_image[0]?>"
                            loading="lazy"
                            alt="<?=the_title()?>"
                    />

                    <div class="container">
                        <h1>
                            <?=the_title()?>
                        </h1>
                    </div>
                <?php endif; ?>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        the_content();
                        ?>
                    </div>

                    <div class="col-md-6">
                        <?=do_shortcode('[contact-form-7 id="61" title="Kontaktní formulář"]')?>
                    </div>
                </div>
            </div>

        <?php endwhile;endif; ?>
    </div>
<?php
get_footer();
