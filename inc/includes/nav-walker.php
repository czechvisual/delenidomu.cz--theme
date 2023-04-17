<?php
/**
 * The core navigation file.
 * @Author: Patrik Vaďura
 * @package acdfevelop
 */

namespace acdfevelop;

// Add class to menu list items
function add_menu_list_item_class($classes, $item, $args)
{
    if (property_exists($args, 'list_item_class')) {
        $classes[] = $args->list_item_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', __NAMESPACE__ . '\add_menu_list_item_class', 1, 3);

// Add class to menu list item links
function add_menu_link_class($atts, $item, $args)
{
    if (property_exists($args, 'link_class')) {
        $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', __NAMESPACE__ . '\add_menu_link_class', 1, 3);

// Current menu item - active class
function add_menu_link_active_class($classes, $item)
{
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter('nav_menu_css_class', __NAMESPACE__ . '\add_menu_link_active_class', 10, 2);

// Modify class and wrapper of the sub-menu
class Nav_Walker extends \Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='sub-menu__container'><ul class='sub-menu'>\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }
}
