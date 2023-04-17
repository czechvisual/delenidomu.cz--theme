<?php
/**
 * @Author: Patrik Vaďura
 * @package acdfevelop
 **/

namespace acdfevelop;

// Registers the post types
class Carousel extends Post_Type {

    public function register() {
        $generated_labels = [
            'menu_name'          => __( 'Carousel', __NAMESPACE__ ),
            'name'               => _x( 'Carousel', 'post type general name', __NAMESPACE__ ),
            'singular_name'      => _x( 'Carousel', 'post type singular name', __NAMESPACE__ ),
            'name_admin_bar'     => _x( 'Carousel', 'add new on admin bar', __NAMESPACE__ ),
            'add_new'            => _x( 'Vytvořit nový', 'thing', __NAMESPACE__ ),
            'add_new_item'       => __( 'Vytvořit nový Carousel', __NAMESPACE__ ),
            'new_item'           => __( 'Nový', __NAMESPACE__ ),
            'edit_item'          => __( 'Upravit', __NAMESPACE__ ),
            'view_item'          => __( 'Zobrazit', __NAMESPACE__ ),
            'all_items'          => __( 'Všechny', __NAMESPACE__ ),
            'search_items'       => __( 'Vyhledat', __NAMESPACE__ ),
            'parent_item_colon'  => __( 'Nadřazený:', __NAMESPACE__ ),
            'not_found'          => __( 'Žádný carousel nenalezen.', __NAMESPACE__ ),
            'not_found_in_trash' => __( 'Žádný carousel nebyl v koši nalezen.', __NAMESPACE__ )
        ];

        $args = [
            'labels'              => $generated_labels,
            'description'         => '',
            'menu_icon'           => 'dashicons-cover-image',
            'public'              => false,
            'has_archive'         => false,
            'exclude_from_search' => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => false,
            'rewrite'             => [
                'with_front'  => false,
                'slug'        => 'carousel',
            ],
            'supports'            => [ 'title', 'editor' ],
            'taxonomies'          => [],
        ];

        $this->register_wp_post_type( $this->slug, $args );
    }
}
