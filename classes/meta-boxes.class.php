<?php

namespace Simpo;

class Meta_Boxes
{
    public static function admin_styles_register() {
        wp_register_style( "style-admin-simpo", SIMPO__PLUGIN_URL . "/css/admin-style.css" );
    }

    public static function admin_styles_enqueue() {
        wp_enqueue_style( "style-admin-simpo" );
    }

    public static function add_meta_boxes() {
        add_meta_box( 'portfolio_addr', __( 'Portfolio data', 'simpo' ), array( 'Simpo\Meta_Boxes', 'portfolio_addr' ), array( 'portfolio' ), 'normal', 'high' );
        add_meta_box( 'portfolio_image', __( 'Portfolio image', 'simpo' ), array( 'Simpo\Meta_Boxes', 'portfolio_image' ), array( 'portfolio' ), 'side', 'low' );
    }

    public static function save_post( $postID ) {
        if( !empty( $_POST['portfolio_addr'] ) )
            self::save_portfolio_addr( $postID, $_POST['portfolio_addr'] );
        if( !empty( $_POST['portfolio_image'] ) )
            self::save_portfolio_image( $postID, $_POST['portfolio_image'] );

        foreach( \Simpo\Meta_Boxes::get_list_fields() as $field ) {
            $id = $field->term_id;
            update_post_meta( $postID, "field_" . $id, $_POST['portfolio_details'][$id] );
        }
    }

    public static function portfolio_addr( $post ) {
        $meta = get_post_meta( $post->ID, '', true );
        $data = array(
            "address" => ( empty( $meta["address"] ) ) ? '' : $meta["address"][0]
        );
        foreach( \Simpo\Meta_Boxes::get_list_fields() as $field ) {
            $id = $field->term_id;
            $data[$id] = ( empty( $meta["field_" . $id] ) ) ? '' : $meta["field_" . $id][0];
        }
        include( SIMPO__PLUGIN_DIR . 'meta-boxes/portfolio-addr.php' );
    }

    public static function portfolio_image( $post ) {
        $img_id = get_post_meta( $post->ID, "portfolio_image", true );
        $img = ( $img_id ) ? wp_get_attachment_image_src( $img_id, array( 640, 480 ) )[0] : false;
        include( SIMPO__PLUGIN_DIR . 'meta-boxes/portfolio-image.php' );
    }

    public static function save_portfolio_addr( $postID, $value ) {
        update_post_meta( $postID, 'address', $value );
    }

    public static function save_portfolio_image( $postID, $value ) {
        update_post_meta( $postID, 'portfolio_image', $value );
    }

    public static function get_list_fields() {
        return get_terms( array(
            'taxonomy' => 'portfolio_fields',
            'hide_empty' => false,
            'orderby' => "meta_value",
            'meta_key' => "field_order"
        ) );
    }

    public static function is_textarea_feld( $id ) {
        $value = get_term_meta( $id, "field_textarea", true );
        $value = ( $value && $value == "on" ) ? true : false;
        return $value;
    }
}