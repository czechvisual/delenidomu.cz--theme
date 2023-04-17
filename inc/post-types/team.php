<?php
/**
 * @Author: Patrik Vaďura
 * @package acdfevelop
 **/

namespace acdfevelop;

// Registers the post types
class Team extends Post_Type {

    public function register() {
        $generated_labels = [
            'menu_name'          => __( 'Náš tým', __NAMESPACE__ ),
            'name'               => _x( 'Náš tým', 'post type general name', __NAMESPACE__ ),
            'singular_name'      => _x( 'Náš tým', 'post type singular name', __NAMESPACE__ ),
            'name_admin_bar'     => _x( 'Náš tým', 'add new on admin bar', __NAMESPACE__ ),
            'add_new'            => _x( 'Přidat čelna', 'thing', __NAMESPACE__ ),
            'add_new_item'       => __( 'Přidat nového člena', __NAMESPACE__ ),
            'new_item'           => __( 'Přidat', __NAMESPACE__ ),
            'edit_item'          => __( 'Upravit', __NAMESPACE__ ),
            'view_item'          => __( 'Zobrazit', __NAMESPACE__ ),
            'all_items'          => __( 'Všichni', __NAMESPACE__ ),
            'search_items'       => __( 'Vyhledat', __NAMESPACE__ ),
            'parent_item_colon'  => __( 'Nadřazený:', __NAMESPACE__ ),
            'not_found'          => __( 'Žádný člen nenalezen.', __NAMESPACE__ ),
            'not_found_in_trash' => __( 'Žádná člen nebyl v koši nalezen.', __NAMESPACE__ )
        ];

        $args = [
            'labels'              => $generated_labels,
            'description'         => '',
            'menu_icon'           => 'dashicons-groups',
            'public'              => false,
            'has_archive'         => false,
            'exclude_from_search' => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => false,
            'rewrite'             => [
                'with_front'  => false,
                'slug'        => 'team',
            ],
            'supports'            => [ 'title', 'editor' ],
            'taxonomies'          => [],
        ];

        $this->register_wp_post_type( $this->slug, $args );
    }
}
