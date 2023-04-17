<?php
/**
 * Enqueue and localize theme scripts and styles
 * @Author: Patrik Vaďura
 * @package acdfevelop
 */

namespace acdfevelop;

// Enqueue scripts and styles
function enqueue_theme_scripts() {
    // Enqueue styles
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    wp_enqueue_style('cookie-consent', 'https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.8.6/dist/cookieconsent.css');
    wp_enqueue_style('wow-animate', get_template_directory_uri() . '/assets/sass/helpers/animate.css');
    wp_enqueue_style('styles', get_template_directory_uri() . '/assets/sass/dist/main.css');
    wp_enqueue_style('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css');
    wp_enqueue_style('owl-carousel-min', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');

    // Enqueue jquery and javascript
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js');
    wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/c15086c90a.js');
    wp_enqueue_script('cookie-consent', 'https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.8.6/dist/cookieconsent.js');
    wp_enqueue_script('front-end', get_template_directory_uri() . '/assets/js/front-end.js');
    wp_enqueue_script('front-end', get_template_directory_uri() . '/assets/js/wow-init.js', NULL, NULL, true);
    wp_enqueue_script('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');

    // Required comment-reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
