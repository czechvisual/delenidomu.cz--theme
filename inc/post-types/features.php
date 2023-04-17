<?php
/**
 * @Author: Patrik Vaďura
 * @package acdfevelop
 **/

namespace acdfevelop;

// Registers the post types
class Features extends Post_Type {

    public function register() {
        $generated_labels = [
            'menu_name'          => __( 'Features', __NAMESPACE__ ),
            'name'               => _x( 'Features', 'post type general name', __NAMESPACE__ ),
            'singular_name'      => _x( 'Features', 'post type singular name', __NAMESPACE__ ),
            'name_admin_bar'     => _x( 'Features', 'add new on admin bar', __NAMESPACE__ ),
            'add_new'            => _x( 'Vytvořit nový', 'thing', __NAMESPACE__ ),
            'add_new_item'       => __( 'Vytvořit nový', __NAMESPACE__ ),
            'new_item'           => __( 'Nový', __NAMESPACE__ ),
            'edit_item'          => __( 'Upravit', __NAMESPACE__ ),
            'view_item'          => __( 'Zobrazit', __NAMESPACE__ ),
            'all_items'          => __( 'Všechny', __NAMESPACE__ ),
            'search_items'       => __( 'Vyhledat', __NAMESPACE__ ),
            'parent_item_colon'  => __( 'Nadřazený:', __NAMESPACE__ ),
            'not_found'          => __( 'Žádná položka nenalezena.', __NAMESPACE__ ),
            'not_found_in_trash' => __( 'Žádná položka nebyla v koši nalezena.', __NAMESPACE__ )
        ];

        $args = [
            'labels'              => $generated_labels,
            'description'         => '',
            'menu_icon'           => 'dashicons-heart',
            'public'              => false,
            'has_archive'         => false,
            'exclude_from_search' => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => false,
            'rewrite'             => [
                'with_front'  => false,
                'slug'        => 'features',
            ],
            'supports'            => [ 'title', 'editor' ],
            'taxonomies'          => [],
        ];

        $this->register_wp_post_type( $this->slug, $args );
    }
}
