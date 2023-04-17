<?php
/**
 * Security and Optimalization
 * @Author: Patrik Vaďura
 * @package acdfevelop
 */

namespace acdfevelop;

// Hide WordPress version for security reasons
function remove_version()
{
    return '';
}
add_filter('the_generator', __NAMESPACE__ . '\remove_version');

// Disable support for comments and trackbacks in post types
function disable_comments_post_types_support()
{
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', __NAMESPACE__ . '\disable_comments_post_types_support');

// Close comments on the front-end
function disable_comments_status()
{
    return false;
}
add_filter('comments_open', __NAMESPACE__ . '\disable_comments_status', 20, 2);
add_filter('pings_open', __NAMESPACE__ . '\disable_comments_status', 20, 2);

// Hide existing comments
function disable_comments_hide_existing_comments($comments)
{
    $comments = array();
    return $comments;
}
add_filter('comments_array', __NAMESPACE__ . '\disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function disable_comments_admin_menu()
{
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', __NAMESPACE__ . '\disable_comments_admin_menu');

// Redirect any user trying to access comments page
function disable_comments_admin_menu_redirect()
{
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }
}
add_action('admin_init', __NAMESPACE__ . '\disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function disable_comments_dashboard()
{
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', __NAMESPACE__ . '\disable_comments_dashboard');

// Remove comments links from admin bar
function disable_comments_admin_bar()
{
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', __NAMESPACE__ . '\disable_comments_admin_bar');

// Remove comment count from admin bar
function hide_comments_bar_link()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', __NAMESPACE__ . '\hide_comments_bar_link');

// Rewrite login errors
function wrong_login()
{
    return 'Chybné uživatelské jméno nebo heslo.';
}
add_filter('login_errors', 'wrong_login');

//Set max file size upload limit for media
function limit_image_size($file)
{
    $image_size = $file['size'] / 1024;
    $limit = 20480; // Set file size limit in KB
    $is_image = strpos($file['type'], 'image');

    if (($image_size > $limit) && ($is_image !== false)) {
        $file['error'] = esc_html__('Obrázek je příliš velký. Musí být menší než ' . $limit . 'KB', 'dv');
    }
    return $file;
}
add_filter('wp_handle_upload_prefilter', __NAMESPACE__ . '\limit_image_size');

// Sanitize UTF-8 special characters of uploaded file
function sanitize_filename($filename)
{
    if (strpos($filename, '.')) {
        $file_parts = explode('.', $filename);
        $extension = array_pop($file_parts);
        $filename = sanitize_title(preg_replace('/[^A-Za-z0-9\-]/', '', join('.', $file_parts)));

        return sprintf('%s.%s', $filename, $extension);
    } else {
        return $filename;
    }
}
add_filter('sanitize_file_name', __NAMESPACE__ . '\sanitize_filename');
