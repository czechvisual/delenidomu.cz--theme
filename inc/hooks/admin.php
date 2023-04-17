<?php
/**
 * General hooks.
 * @Author: Patrik Vaďura
 * @package acdfevelop
 */

namespace acdfevelop;

// Some hooks
function admin_scripts() {
    wp_enqueue_style('dv-admin-style',
        get_stylesheet_directory_uri() . '/admin/sass/dist/main.css');
    wp_enqueue_script('dv-admin-custom-js',
        get_stylesheet_directory_uri() . "/admin/js/dist/admin-front-end.js",
        array(), false, true);
}

function add_admin_color_schemes()
{
    wp_admin_css_color('vdesign',
        __('V-design'),
        get_stylesheet_directory_uri() . '/admin/sass/dist/admin-colors.css',
        array('#242E34', '#8D9080', '#21ca62', '#e93230'));
}

function set_default_admin_color($user_id)
{
    $args = array(
        'ID' => $user_id,
        'admin_color' => 'acdfevelop',
    );
    wp_update_user($args);
}
