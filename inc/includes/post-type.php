<?php
/**
 * The base for a post type object
 * @Author: Patrik Vaďura
 * @package acdfevelop
 */

namespace acdfevelop;

// A base for Post Type creation
abstract class Post_Type {
    public $post_type = null;

    public $slug;

    public function __construct( $slug ) {
        $this->slug = $slug;
    }

    abstract protected function register();

    public function register_wp_post_type( $slug, $args ) {
        return register_post_type( $slug, $args );
    }
}
