<?php
/**
 * Features
 * @Author: Patrik Vaďura
 * @package acdfevelop
 */

namespace acdfevelop;

// Allow upload and preview Webp
function allow_webp_upload($mimes)
{
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('mime_types', __NAMESPACE__ . '\allow_webp_upload');

function webp_is_displayable($result, $path)
{
    if ($result === false) {
        $displayable_image_types = array(IMAGETYPE_WEBP);
        $info = @getimagesize($path);

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }

    return $result;
}
add_filter('file_is_displayable_image', __NAMESPACE__ . '\webp_is_displayable', 10, 2);

// Allow upload SVG
function allow_svg_upload($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', __NAMESPACE__ . '\allow_svg_upload');

// Allow native lazy loading on content img.
function native_lazy_loading($content)
{
    $content = str_replace('<img', '<img loading="lazy"', $content);
    return $content;
}
add_filter('the_content', __NAMESPACE__ . '\native_lazy_loading');

// Site URL shortcode -> [site_url]
add_action( 'init', function() {
    add_shortcode( 'site_url', function( $atts = null, $content = null ) {
        return site_url();
    } );
} );

// Disable Guttenberg editor
add_filter('use_block_editor_for_post', '__return_false', 10);
