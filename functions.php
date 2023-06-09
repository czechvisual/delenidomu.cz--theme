<?php
/**
 * @Author: czechvisual
 * @package acdfevelop
 */

namespace acdfevelop;

define( 'acdfevelop_VERSION', '1.0.0' );

// Theme settings
add_action( 'after_setup_theme', function() {
    $theme_settings = [
        'textdomain' => 'acdfevelop',

        // Image and content sizes
        'image_sizes' => [
            'small'   => 300,
            'medium'  => 700,
            'large'   => 1200,
        ],
        'content_width' => 800,

        // Logo and featured image
        'default_featured_image'  => null,
        'logo'                    => '/assets/img/logo.svg',
        'copyright-name'          => 'delenidomu.cz',
        'creator'                 => 'czechvisual',
        'creator-url'             => 'https://czechvisual.cz/',
        'logo-creator'            => '/assets/img/logo-creator.svg',

        // Menu locations
        'menu_locations' => [
            'primary' => __( 'Primární', __NAMESPACE__ ),
        ],

        // Taxonomies
        'taxonomies' => [
            // 'your-taxonomy' => [
            //   'name' => 'Your_Taxonomy',
            //   'post_types' => [ 'post', 'page' ],
            // ],
        ],

        // Post types
        'post_types' => [
            'carousel' => 'Carousel',
            'features' => 'Features',
            'team' => 'Team',
            'services' => 'Services',
            'reference' => 'Reference',
        ],

        // Add your own settings and use them wherever you need, for example THEME_SETTINGS['my_custom_setting']
        'my_custom_setting' => true,
    ];

    $theme_settings = apply_filters( __NAMESPACE__ . '\theme_settings', $theme_settings );

    define( 'THEME_SETTINGS', $theme_settings );
} );

// Required files
require get_theme_file_path( '/inc/hooks.php' );
require get_theme_file_path( '/inc/includes.php' );
// require get_theme_file_path( '/inc/template-tags.php' );

// Run theme setup
add_action( 'init', __NAMESPACE__ . '\theme_setup' );
add_action( 'after_setup_theme', __NAMESPACE__ . '\build_theme_support' );

// Remove items from menu
function disable_items_admin_menu()
{
    // For everybody
    remove_menu_page('edit-comments.php');
    remove_menu_page('edit.php');

    // Only for roles
    $user = wp_get_current_user();
    if ( in_array( 'editor', (array) $user->roles ) ) {
        remove_menu_page('users.php');
        remove_menu_page('profile.php');
        remove_menu_page('tools.php');
    }
}
add_action('admin_menu', __NAMESPACE__ . '\disable_items_admin_menu');

// Option page
// require get_theme_file_path( '/inc/option-page.php' );
