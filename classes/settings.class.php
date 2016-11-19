<?php

namespace Simpo;

class Settings
{
    public static function add_menu_page() {
        add_menu_page(
            __( 'Portfolio settings', 'simpo' ),
            __( 'Portfolio settings', 'simpo' ),
            'edit_posts',
            'simpo',
            array( "Simpo\Settings", "settings_page" ),
            '',
            85
        );
    }

    public static function display_post_state( $state, $post ) {
        if( $post->ID == self::get_settings()["portfolio_page_id"] ) {
            $state[] = __( 'Page portfolio', 'simpo' );
        }
        return $state;
    }

    public static function settings_page() {
        if( !empty( $_POST ) && wp_verify_nonce( $_POST['_wpnonce'], 'simpo-settings-update' ) )
            self::save_settings();
        $settings = self::get_settings();
        include( SIMPO__PLUGIN_DIR . 'views/settings_page.php' );
    }

    private static function save_settings() {
        if( !empty( $_POST['simpo'] ) )
            $data = $_POST['simpo'];
        else
            $data = array();

        $data['show_header'] = self::get_checkbox_value( 'show_header' );
        $data['del_img_after_change'] = self::get_checkbox_value( 'del_img_after_change' );

        update_option( 'simple_portfolio_data', $data );
    }

    private static function get_checkbox_value( $key ) {
        return ( !empty( $_POST['simpo'][$key] ) && $_POST['simpo'][$key] == 'on' ) ? 'on' : 'off';
    }

    public static function get_settings() {
        $settings = get_option( "simple_portfolio_data" );
        if( !$settings )
            $settings = self::get_default_settings();
        else
            $settings = array_merge( self::get_default_settings(), $settings );
        return $settings;
    }

    private static function get_default_settings() {
        return array(
            'del_img_after_change' => 'on',
            'portfolio_columns' => 3,
            'posts_per_page' => 3,
            "portfolio_page_id" => -1,
            'header' => 'Portfolio',
            'show_header' => 'on',
            'link_header' => 'Site link',
            'show_link' => 'on',
        );
    }
}