<?php
/**
 * @Author: Patrik Vaďura
 * @package acdfevelop
 **/

namespace acdfevelop;

// Registers the post types
class Services extends Post_Type {

    public function register() {
        $generated_labels = [
            'menu_name'             => __( 'Naše služby', __NAMESPACE__ ),
            'name'                  => _x( 'Naše služby', 'post type general name', __NAMESPACE__ ),
            'singular_name'         => _x( 'Naše služby', 'post type singular name', __NAMESPACE__ ),
            'name_admin_bar'        => _x( 'Naše služby', 'add new on admin bar', __NAMESPACE__ ),
            'add_new'               => _x( 'Vytvořit službu', 'thing', __NAMESPACE__ ),
            'add_new_item'          => __( 'Vytvořit novou službu', __NAMESPACE__ ),
            'new_item'              => __( 'Nová', __NAMESPACE__ ),
            'edit_item'             => __( 'Upravit', __NAMESPACE__ ),
            'view_item'             => __( 'Zobrazit', __NAMESPACE__ ),
            'all_items'             => __( 'Všechny', __NAMESPACE__ ),
            'search_items'          => __( 'Vyhledat', __NAMESPACE__ ),
            'parent_item_colon'     => __( 'Nadřazená:', __NAMESPACE__ ),
            'not_found'             => __( 'Žádná služba nenalezena.', __NAMESPACE__ ),
            'not_found_in_trash'    => __( 'Žádá služba nebyla v koši nalezena.', __NAMESPACE__ ),
            'featured_image'        => __( 'Ikona služby', __NAMESPACE__ ),
            'set_featured_image'    => __( 'Použít jako ikonu', __NAMESPACE__ ),
            'remove_featured_image' => __( 'Odebrat ikonu', __NAMESPACE__ ),
            'use_featured_image'    => __( 'Použít jako ikonu', __NAMESPACE__ )
        ];

        $args = [
            'labels'              => $generated_labels,
            'description'         => '',
            'menu_icon'           => 'dashicons-editor-textcolor',
            'public'              => false,
            'has_archive'         => false,
            'exclude_from_search' => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => false,
            'rewrite'             => [
                'with_front'  => false,
                'slug'        => 'services',
            ],
            'supports'            => [ 'title', 'editor', 'thumbnail' ],
            'taxonomies'          => [],
        ];

        $this->register_wp_post_type( $this->slug, $args );
    }
}
