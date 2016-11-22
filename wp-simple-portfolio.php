<?php

/**
 * Plugin Name: WP Simple Portfolio
 * Description: Simple Portfolio in your site
 * Version: 0.8.0
 * Author: Krigus
 * Author URI: http://krigus.com/
 * License: GPL2 or later
 * Author e-mail: sergpost33@gmail.com
 */

include_once( plugin_dir_path( __FILE__ ) . "autoload.php" );

if( !function_exists( 'simpo_core' ) ) {
    function simpo_core() {
        return \Simpo\Registry::get_instance();
    }
}

simpo_core()->Simpo_Version = '0.8.0';
simpo_core()->Simpo_Plugin_Dir = plugin_dir_path( __FILE__ );
simpo_core()->Simpo_Plugin_Url = plugin_dir_url( __FILE__ );
simpo_core()->Simpo_Views_Front = simpo_core()->Simpo_Plugin_Dir . "views/frontend/";

// Check if PRO version is active
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( is_plugin_active( 'wp-simple-portfolio-pro/wp-simple-portfolio-pro.php' ) )
    simpo_core()->Simpo_Pro_Active = true;
else
    simpo_core()->Simpo_Pro_Active = false;

// Register activation and deactivation hooks
register_activation_hook( __FILE__, array( simpo_core()->Simpo(), 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( simpo_core()->Simpo(), 'plugin_deactivation' ) );

// Register Post Type Portfolio
add_action( 'init', array( simpo_core()->Post_Type(), 'register_portfolio' ) );

// Load language
add_action( 'plugins_loaded', array( simpo_core()->Simpo(), 'load_language' ) );

// Add meta boxes to edit portfolio page
add_action( 'add_meta_boxes', array( simpo_core()->Meta_Boxes(), 'add_meta_boxes' ) );

// Save portfolio data
add_action( 'save_post', array( simpo_core()->Meta_Boxes(), 'save_post' ), 30 );

// Save portfolio images
add_action( 'save_post', array( simpo_core()->Images(), 'save_post' ), 90 );

// Enqueue scripts
add_action( 'wp_enqueue_scripts', array( simpo_core()->Simpo(), 'enqueue_scripts' ) );

// Add settings page
add_action( 'admin_menu', array( simpo_core()->Settings(), 'add_menu_page' ) );

// Register admin styles
add_action( 'init', array( simpo_core()->Meta_Boxes(), 'admin_styles_register' ) );

// Enqueue admin styles
add_action( 'admin_head', array( simpo_core()->Meta_Boxes(), 'admin_styles_enqueue' ) );

// Load template
add_filter( 'template_include', array( simpo_core()->Content(), 'template_include' ) );

// Display if page is portfolio page (in pages list)
add_filter( 'display_post_states', array( simpo_core()->Settings(), 'display_post_state' ), 95, 2 );

// Display content of page portfolio
add_filter( 'the_content', array( simpo_core()->Content(), 'display_portfolio_content' ), 99 );

// Change plugin action links
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( simpo_core()->Simpo(), 'action_links' ), 10, 2 );