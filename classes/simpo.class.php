<?php

namespace Simpo;

class Simpo
{
    public static function plugin_activation() {

    }

    public static function plugin_deactivation() {
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        if( is_plugin_active( 'wp-simple-portfolio-pro/wp-simple-portfolio-pro.php' ) ) {
            deactivate_plugins( "wp-simple-portfolio-pro/wp-simple-portfolio-pro.php" );
        }
    }

    public static function action_links( $actions, $plugin_file ) {
        unset( $actions['edit'] );
        $link = array(
            "proupgrade" => '<a href="http://krigus.com/" target="_blank">' . __( "Upgrade to Pro", 'simpo' ) . '</a>',
            "settings" => '<a href="admin.php?page=simpo">' . __( "Settings", 'simpo' ) . '</a>'
        );
        $actions = array_merge( $link, $actions );
        return $actions;
    }

    public static function load_language() {
        load_plugin_textdomain( 'simpo', '', 'wp-simple-portfolio/languages/' );
    }

    public static function get_categories_list() {
        $categories = array(
            array(
                'name' => __( 'All', 'simpo' ),
                'slug' => 'all'
            )
        );
        $cats = (array) get_terms( array(
            'taxonomy' => "portfolio_category"
        ) );
        foreach( $cats as $category ) {
            $categories[] = array(
                'name' => $category->name,
                'slug' => "." . $category->slug
            );
        }
        return $categories;
    }

    public static function get_portfolio_post_categories( $id ) {
        $terms = array();
        if( $_terms = get_the_terms( $id, 'portfolio_category' ) )
            foreach( $_terms as $term )
                $terms[] = $term->slug;
        return implode( ' ', $terms );
    }

    public static function enqueue_scripts() {
        wp_enqueue_script( 'mixitup', Simpo()->Simpo_Plugin_Url . 'js/mixitup.min.js', array( "jquery" ), false, true );

        wp_enqueue_style( 'dashicons' );
    }

    public static function get_single_detalis( $postID ) {
        if( !Simpo()->Simpo_Pro_Active )
            return false;

        $keys = array(
            //'address' => __( '', 'simpo' ),
            'base_cms' => __( 'CMS', 'simpo' ),
            'base_framework' => __( 'Framework', 'simpo' ),
            'project_description' => __( 'Description', 'simpo' ),
            'project_times' => __( 'Start/end date', 'simpo' ),
            'my_role' => __( 'My Role', 'simpo' )
        );

        $result = array();

        $address = get_post_meta( $postID, 'address', true );
        $result[__( 'Site', 'simpo' )] = sprintf( '<a href="%1$s">%1$s</a>', $address );

        foreach( $keys as $key => $value )
            if( $data = get_post_meta( $postID, $key, true ) )
                $result[$value] = $data;

        return $result;
    }
}