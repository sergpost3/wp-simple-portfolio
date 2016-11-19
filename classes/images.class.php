<?php

namespace Simpo;

class Images
{
    public static function save_post( $postID ) {
        $settings = \Simpo\Settings::get_settings();

        if( !empty( $_POST['portfolio_addr'] ) && ( trim( $_POST['portfolio_addr_old'] ) != trim( $_POST['portfolio_addr'] ) ) ) {
            if( $settings['del_img_after_change'] == 'on' )
                self::delete_post_images( $postID );

            if( empty( $_POST['dont_update_thumb'] ) )
                update_post_meta( $postID, '_thumbnail_id', self::upload_thumbnail( trim( $_POST['portfolio_addr'] ) ) );
            if( empty( $_POST['dont_update_portfolio'] ) )
                update_post_meta( $postID, 'portfolio_image', self::upload_portfolio_image( $_POST['portfolio_addr'] ) );
        }
    }

    private static function delete_post_images( $postID ) {
        if( empty( $_POST['dont_update_thumb'] ) )
            wp_delete_attachment( get_post_meta( $postID, '_thumbnail_id' ) );
        if( empty( $_POST['dont_update_portfolio'] ) )
            wp_delete_attachment( get_post_meta( $postID, 'portfolio_image' ) );
    }

    private static function upload_thumbnail( $addr ) {
        $url = parse_url( $addr );
        $url = "{$url['scheme']}://{$url['host']}/";
        $url = "http://mini.s-shot.ru/1366x1366/1366/jpeg/?" . $url;
        $url = "http://mini.s-shot.ru/1366x1366/450/jpeg/?" . $url;

        $desc = "FoxInvest 1";
        $file_array = array(
            'name' => 'FoxInvest.jpg',
            'tmp_name' => download_url( $url )
        );

        return media_handle_sideload( $file_array, 0, $desc );
    }

    private static function upload_portfolio_image( $addr ) {
        $url = get_home_url() . "/wp-content/plugins/wp-simple-portfolio/image.php?key=7anb39N410nx5Mw0b2hwm2odnwt&site=" . $addr;

        $desc = trim( $_POST['post_title'] );
        $file_array = array(
            'name' => 'FoxInvest.png',
            'tmp_name' => download_url( $url )
        );

        return media_handle_sideload( $file_array, 0, $desc );
    }

    public static function portfolio_image( $postID, $size = 'thumbnail', $alt = '', $title = '', $lightbox = false ) {
        echo self::get_portfolio_image( $postID, $size, $alt, $title, $lightbox );
    }

    public static function get_portfolio_image( $postID, $size = 'thumbnail', $alt = '', $title = '', $lightbox = false ) {
        $image = get_post_meta( $postID, 'portfolio_image', true );
        if( !$image )
            return self::get_default_image();
        return self::get_image_by_id( $image, $size, $alt, $title, $lightbox );
    }

    public static function get_image_by_id( $id, $size = 'thumbnail', $alt = '', $title = '', $lightbox = false ) {
        if( !$id || !$code = wp_get_attachment_image_src( $id, $size ) )
            return self::get_default_image();
        else {
            $img = "<img src='{$code[0]}' alt='{$alt}' title='{$title}' />";
            $link = "<a href='{$code[0]}' rel='lightbox' title='{$title}'>%s</a>";
            if( !$lightbox )
                return $img;
            return sprintf( $link, $img );
        }
    }

    public static function get_default_image() {
        return "<img src='" . self::get_default_image_src() . "' alt='no-image' title='no-image' />";
    }

    public static function get_default_image_src() {
        return SIMPO__PLUGIN_URL . "images/no-photo.jpg";
    }
}