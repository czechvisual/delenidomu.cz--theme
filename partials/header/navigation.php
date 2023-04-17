<?php
/**
 * Navigation layout
 * @Author: Patrik Vaďura
 * @package acdfevelop
 */

namespace acdfevelop;

?>

<i class="bi bi-list" id="openIcon" onclick="openMenu()"></i>
<i class="bi bi-x-lg" id="closeIcon" onclick="closeMenu()"></i>



<?php wp_nav_menu( array(
    'theme_location' => 'primary',
    'container'      => false,
    'depth'          => 4,
    'menu_class'     => 'site-navigation',
    'menu_id'        => 'site-navigation',
    'echo'           => true,
    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'has_dropdown'   => true,
    'walker'         => new Nav_Walker(),
) ); ?>
