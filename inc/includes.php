<?php
/**
 * Include custom features etc.
 *
 * @Author: Patrik Vaďura
 * @package acdfevelop
 */

namespace acdfevelop;

require get_theme_file_path( '/inc/includes/theme-setup.php' );
require get_theme_file_path( '/inc/includes/localization.php' );
require get_theme_file_path( '/inc/includes/nav-walker.php' );

// Functions & features
require get_theme_file_path( 'inc/functions/features.php' );
require get_theme_file_path( 'inc/functions/security.php' );

// Post type and taxonomy
if ( file_exists( get_theme_file_path( '/inc/includes/taxonomy.php' ) ) ) {
    require get_theme_file_path( '/inc/includes/taxonomy.php' );
}

if ( file_exists( get_theme_file_path( '/inc/includes/post-type.php' ) ) ) {
    require get_theme_file_path( '/inc/includes/post-type.php' );
}

// ACF
require get_theme_file_path( 'inc/acf.php' );
// Custom functions
