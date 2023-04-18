<?php
/**
 * @Author: Patrik Vaďura
 * @package acdfevelop
 **/

namespace acdfevelop;

// Registers the post types
class Reference extends Post_Type {

    public function register() {
        $generated_labels = [
            'menu_name'             => __( 'Reference', __NAMESPACE__ ),
            'name'                  => _x( 'Reference', 'post type general name', __NAMESPACE__ ),
            'singular_name'         => _x( 'Reference', 'post type singular name', __NAMESPACE__ ),
            'name_admin_bar'        => _x( 'Reference', 'add new on admin bar', __NAMESPACE__ ),
            'add_new'               => _x( 'Vytvořit referenci', 'thing', __NAMESPACE__ ),
            'add_new_item'          => __( 'Vytvořit novou referenci', __NAMESPACE__ ),
            'new_item'              => __( 'Nová', __NAMESPACE__ ),
            'edit_item'             => __( 'Upravit', __NAMESPACE__ ),
            'view_item'             => __( 'Zobrazit', __NAMESPACE__ ),
            'all_items'             => __( 'Všechny', __NAMESPACE__ ),
            'search_items'          => __( 'Vyhledat', __NAMESPACE__ ),
            'parent_item_colon'     => __( 'Nadřazená:', __NAMESPACE__ ),
            'not_found'             => __( 'Žádná reference nenalezena.', __NAMESPACE__ ),
            'not_found_in_trash'    => __( 'Žádá reference nebyla v koši nalezena.', __NAMESPACE__ ),
            'featured_image'        => __( 'Fotografie reference', __NAMESPACE__ ),
            'set_featured_image'    => __( 'Použít jako fotografii', __NAMESPACE__ ),
            'remove_featured_image' => __( 'Odebrat fotografii', __NAMESPACE__ ),
            'use_featured_image'    => __( 'Použít jako fotografii', __NAMESPACE__ )
        ];

        $args = [
            'labels'              => $generated_labels,
            'description'         => '',
            'menu_icon'           => 'dashicons-visibility',
            'public'              => false,
            'has_archive'         => false,
            'exclude_from_search' => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => false,
            'rewrite'             => [
                'with_front'  => false,
                'slug'        => 'reference',
            ],
            'supports'            => [ 'title', 'editor', 'thumbnail' ],
            'taxonomies'          => [],
        ];

        $this->register_wp_post_type( $this->slug, $args );
    }
}
