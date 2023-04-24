<?php

/**
 * Template Name: Privacy policy
 */

get_header(); ?>

    <div class="container-fluid px-0 single-page">
        <div class="row">
            <div class="single-page-feature">
                <div class="container">
                    <h1>
                        <?= get_the_title() ?>
                    </h1>
                </div>
            </div>

            <?php the_post(); ?>

            <div class="container">
                <div class="row gy-5">
                    <div class="single-page-content col">
                        <?=the_content()?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();
