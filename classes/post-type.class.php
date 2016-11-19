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

        register_taxonomy( 'portfolio_fields', 'portfolio', array(
            'labels' => array(
                'name' => __( 'Fields', 'simpo' ),
                'singular_name' => __( 'Field', 'simpo' ),
                'search_items' => __( 'Search Fields', 'simpo' ),
                'all_items' => __( 'All Fields', 'simpo' ),
                'parent_item' => __( 'Parent Field', 'simpo' ),
                'parent_item_colon' => __( 'Parent Field:', 'simpo' ),
                'edit_item' => __( 'Edit Field', 'simpo' ),
                'update_item' => __( 'Update Field', 'simpo' ),
                'add_new_item' => __( 'Add New Field', 'simpo' ),
                'new_item_name' => __( 'New Field Name', 'simpo' ),
                'menu_name' => __( 'Fields', 'simpo' ),
                'separate_items_with_commas' => __( 'Separate writers with commas', 'simpo' ),
                'add_or_remove_items' => __( 'Add or remove writers', 'simpo' ),
                'choose_from_most_used' => __( 'Choose from the most used writers', 'simpo' ),
            ),
            'hierarchical' => false,
            'rewrite' => true,
            'public' => true,
            'show_ui' => true,
            'publicly_queryable' => false,
            'show_in_quick_edit' => false,
            'show_tagcloud' => false,
            'show_in_nav_menus' => false,
            'meta_box_cb' => false,
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

    public static function portfolio_fields_add_new_fields() {
        include( SIMPO__PLUGIN_DIR . "views/portfolio_fields_new_fields.php" );
    }

    public static function portfolio_fields_add_edit_fields( $tag, $taxonomy ) {
        $order = get_term_meta( $tag->term_id, "field_order", true );
        if( $order === "false" )
            $order = 1;
        $order = intval( $order );
        $textarea = get_term_meta( $tag->term_id, "field_textarea", true );
        if( $textarea === "false" || $textarea != "on" )
            $textarea = "off";
        include( SIMPO__PLUGIN_DIR . "views/portfolio_fields_edit_fields.php" );
    }

    public static function portfolio_fields_edit_table_columns( $columns ) {
        unset( $columns['slug'] );
        unset( $columns['posts'] );
        $columns['order'] = __( 'Order', 'simpo' );
        $columns['textarea'] = __( 'Textarea', 'simpo' );
        return $columns;
    }

    public static function portfolio_fields_edit_table_column_content( $content, $column, $id ) {
        if( $column == "order" )
            $content = get_term_meta( $id, "field_order", true );
        elseif( $column == "textarea" ) {
            $value = get_term_meta( $id, "field_textarea", true );
            $value = ( $value && $value == "on" ) ? "yes" : "no";
            $content = "<span class='dashicons dashicons-{$value}'></span>";
        }
        return $content;
    }

    public static function edit_term( $term_id, $tt_id, $taxonomy ) {
        update_term_meta( $term_id, "field_order", intval( $_POST['tag-order'] ) );
        $value = ( !empty( $_POST['tag-textarea'] ) && $_POST['tag-textarea'] == 'on' ) ? 'on' : 'off';
        update_term_meta( $term_id, "field_textarea", $value );
    }
}