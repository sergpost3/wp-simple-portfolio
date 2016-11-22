<?php

namespace Simpo;

class Post_Type
{
    public static function register_portfolio() {
        self::register_taxonomies();
        self::register_post_type();
    }

    private static function register_taxonomies() {
        register_taxonomy( 'portfolio_category', 'portfolio', array(
            'hierarchical' => true,
            'rewrite' => true,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true
        ) );

        register_taxonomy( 'portfolio_post_tag', 'portfolio', array(
            'hierarchical' => false,
            'rewrite' => true,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true
        ) );
    }

    private static function register_post_type() {
        register_post_type( 'portfolio', array(
            'label' => 'Portfolio',
            'labels' => array(
                'name' => __( 'Portfolio', 'simpo' ),
                'singular_name' => __( 'Portfolio item', 'simpo' ),
                'add_new' => __( 'Add new', 'simpo' ),
                'add_new_item' => __( 'Add new portfolio', 'simpo' ),
                'edit_item' => __( 'Edit portfolio', 'simpo' ),
                'new_item' => __( 'New portfolio', 'simpo' ),
                'view_item' => __( 'View portfolio', 'simpo' ),
                'search_items' => __( 'Search', 'simpo' ),
                'not_found' => __( 'Not found', 'simpo' ),
                'not_found_in_trash' => __( 'Not found in trash', 'simpo' ),
                'parent_item_colon' => '',
                'menu_name' => __( 'Portfolio', 'simpo' ),
            ),
            'description' => '',
            'public' => true,
            'menu_position' => 7,
            'menu_icon' => null,
            'hierarchical' => false,
            'supports' => array( 'title', 'thumbnail', 'excerpt', 'comments' ),
            'taxonomies' => array( 'portfolio_category', 'portfolio_post_tag' ),
            'rewrite' => true
        ) );
    }
}