<?php

namespace Simpo;

class Meta_Boxes
{
    public static function admin_styles_register() {
        wp_register_style( "style-admin-simpo", simpo_core()->Simpo_Plugin_Url . "/css/admin-style.css" );
    }

    public static function admin_styles_enqueue() {
        wp_enqueue_style( "style-admin-simpo" );
    }

    public static function add_meta_boxes() {
        add_meta_box( 'portfolio_addr', __( 'Portfolio data', 'simpo' ), array( 'Simpo\Meta_Boxes', 'portfolio_addr' ), array( 'portfolio' ), 'normal', 'high' );
        //if( SIMPO_PRO_ACTIVE )
        //    \SimpoPro\Meta_Boxes::add_meta_boxes();
    }

    public static function save_post( $postID ) {
        if( !empty( $_POST['portfolio_addr'] ) )
            self::save_portfolio_addr( $postID, $_POST['portfolio_addr'] );
        //\SimpoPro\Meta_Boxes::save_post( $postID );
    }

    public static function portfolio_addr( $post ) {
        $meta = get_post_meta( $post->ID, '', true );
        $data = array(
            "address" => ( empty( $meta["address"] ) ) ? '' : $meta["address"][0]
        );
        //if( SIMPO_PRO_ACTIVE )
        //    $data = \SimpoPro\Meta_Boxes::portfolio_addr( $meta, $data );
        include( simpo_core()->Simpo_Plugin_Dir . 'meta-boxes/portfolio-addr.php' );
    }

    public static function save_portfolio_addr( $postID, $value ) {
        update_post_meta( $postID, 'address', $value );
    }

    public static function is_textarea_feld( $id ) {
        $value = get_term_meta( $id, "field_textarea", true );
        $value = ( $value && $value == "on" ) ? true : false;
        return $value;
    }
}