<?php
/**
 * Site branding & logo
 * @Author: Patrik Vaďura
 * @package acdfevelop
 */

namespace acdfevelop;

$description = get_bloginfo( 'description', 'display' );
?>

<div class="site-branding">
    <a href="<?php echo get_home_url(); ?>" class="site-branding-title" rel="home">
        <span class="screen-reader-text"><?=bloginfo( 'name' )?></span>
        <?php include get_theme_file_path( THEME_SETTINGS['logo'] );?>
    </a>

    <?php if ( $description || is_customize_preview() ) : ?>
        <p class="site-branding-description screen-reader-text">
            <?php echo $description;?>
        </p>
    <?php endif; ?>
</div>
