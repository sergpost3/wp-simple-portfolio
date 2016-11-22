<?php

/**
 * Plugin Name: WP Simple Portfolio
 * Description: Simple Portfolio in your site
 * Version: 0.7.7
 * Author: Krigus
 * Author URI: http://krigus.com/
 * License: GPL2 or later
 * Author e-mail: sergpost33@gmail.com
 */

define( 'SIMPO_VERSION', '0.7.7' );
define( 'SIMPO__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SIMPO__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SIMPO_VIEWS_FRONT', SIMPO__PLUGIN_DIR . "views/frontend/" );

// Check if PRO version is active
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( is_plugin_active( 'wp-simple-portfolio-pro/wp-simple-portfolio-pro.php' ) ) {
    define( 'SIMPO_PRO_ACTIVE', true );
    define( 'SIMPO_NAMESPACE', "SimpoPro" );
}
else {
    define( 'SIMPO_PRO_ACTIVE', false );
    define( 'SIMPO_NAMESPACE', "Simpo" );
}

include_once( SIMPO__PLUGIN_DIR . "autoload.php" );

// Register activation and deactivation hooks
register_activation_hook( __FILE__, array( 'Simpo\Simpo', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Simpo\Simpo', 'plugin_deactivation' ) );

// Register Post Type Portfolio
add_action( 'init', array( SIMPO_NAMESPACE . '\Post_Type', 'register_portfolio' ) );

// Load language
add_action( 'plugins_loaded', array( SIMPO_NAMESPACE . '\Simpo', 'load_language' ) );

// Add meta boxes to edit portfolio page
add_action( 'add_meta_boxes', array( SIMPO_NAMESPACE . '\Meta_Boxes', 'add_meta_boxes' ) );

// Save portfolio data
add_action( 'save_post', array( SIMPO_NAMESPACE . '\Meta_Boxes', 'save_post' ), 30 );

// Save portfolio images
add_action( 'save_post', array( SIMPO_NAMESPACE . '\Images', 'save_post' ), 90 );

// Enqueue scripts
add_action( 'wp_enqueue_scripts', array( SIMPO_NAMESPACE . '\Simpo', 'enqueue_scripts' ) );

// Add settings page
add_action( 'admin_menu', array( SIMPO_NAMESPACE . '\Settings', 'add_menu_page' ) );

// Register admin styles
add_action( 'init', array( SIMPO_NAMESPACE . '\Meta_Boxes', 'admin_styles_register' ) );

// Enqueue admin styles
add_action( 'admin_head', array( SIMPO_NAMESPACE . '\Meta_Boxes', 'admin_styles_enqueue' ) );

// Load template
add_filter( 'template_include', array( SIMPO_NAMESPACE . '\Content', 'template_include' ) );

// Display if page is portfolio page (in pages list)
add_filter( 'display_post_states', array( SIMPO_NAMESPACE . '\Settings', 'display_post_state' ), 95, 2 );

// Display content of page portfolio
add_filter( 'the_content', array( SIMPO_NAMESPACE . '\Content', 'display_portfolio_content' ), 99 );

// Change plugin action links
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( SIMPO_NAMESPACE . '\Simpo', 'action_links' ), 10, 2 );