<?php
/**
 * Hooks
 * @Author: Patrik Vaďura
 * @package acdfevelop
 */

namespace acdfevelop;

// Enable search view
// add_filter( 'air_helper_disable_views_search', '__return_false' );

// Breadcrumb
// require get_theme_file_path( 'inc/hooks/breadcrumb.php' );

// Admin hooks
require get_theme_file_path( 'inc/hooks/admin.php' );
require get_template_directory() . '/admin/template-tags.php';
require get_template_directory() . '/admin/customizer.php';
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\admin_scripts' );
add_action('admin_init',  __NAMESPACE__ . '\add_admin_color_schemes');
add_action('user_register', __NAMESPACE__ . '\set_default_admin_color');

// Scripts and styles associated hooks
require get_theme_file_path( 'inc/hooks/scripts-styles.php' );
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_theme_scripts' );
