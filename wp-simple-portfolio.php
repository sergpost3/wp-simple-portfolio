<?php

/**
 * Plugin Name: WP Simple Portfolio
 * Description: Simple Portfolio in your site
 * Version: 0.7.5
 * Author: Krigus
 * Author URI: http://krigus.com/
 * License: GPL2 or later
 * Author e-mail: sergpost33@gmail.com
 */

define( 'SIMPO_VERSION', '0.7.5' );
define( 'SIMPO__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SIMPO__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SIMPO_VIEWS_FRONT', SIMPO__PLUGIN_DIR . "views/frontend/" );

// Check if PRO version is active
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( is_plugin_active( 'wp-simple-portfolio-pro/wp-simple-portfolio-pro.php' ) )
    define( 'SIMPO_PRO_ACTIVE', true );
else
    define( 'SIMPO_PRO_ACTIVE', false );

include_once( SIMPO__PLUGIN_DIR . "autoload.php" );

// Include classes
//require_once( SIMPO__PLUGIN_DIR . 'classes/simpo.class.php' );
//require_once( SIMPO__PLUGIN_DIR . 'classes/post-type.class.php' );
//require_once( SIMPO__PLUGIN_DIR . 'classes/meta-boxes.class.php' );
//require_once( SIMPO__PLUGIN_DIR . 'classes/images.class.php' );
//require_once( SIMPO__PLUGIN_DIR . 'classes/settings.class.php' );
//require_once( SIMPO__PLUGIN_DIR . 'classes/content.class.php' );

// Register activation and deactivation hooks
register_activation_hook( __FILE__, array( 'Simpo\Simpo', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Simpo\Simpo', 'plugin_deactivation' ) );

// Register Post Type Portfolio
add_action( 'init', array( 'Simpo\Post_Type', 'register_portfolio' ) );

// Load language
add_action( 'plugins_loaded', array( 'Simpo\Simpo', 'load_language' ) );

// Add meta boxes to edit portfolio page
add_action( 'add_meta_boxes', array( 'Simpo\Meta_Boxes', 'add_meta_boxes' ) );

// Save portfolio data
add_action( 'save_post', array( 'Simpo\Meta_Boxes', 'save_post' ), 30 );

// Save portfolio images
add_action( 'save_post', array( 'Simpo\Images', 'save_post' ), 90 );

// Enqueue scripts
add_action( 'wp_enqueue_scripts', array( 'Simpo\Simpo', 'enqueue_scripts' ) );

// Add settings page
add_action( 'admin_menu', array( 'Simpo\Settings', 'add_menu_page' ) );

// Register admin styles
add_action( 'init', array( 'Simpo\Meta_Boxes', 'admin_styles_register' ) );

// Enqueue admin styles
add_action( 'admin_head', array( 'Simpo\Meta_Boxes', 'admin_styles_enqueue' ) );

// Load template
add_filter( 'template_include', array( 'Simpo\Content', 'template_include' ) );

// Display if page is portfolio page (in pages list)
add_filter( 'display_post_states', array( 'Simpo\Settings', 'display_post_state' ), 95, 2 );

// Display content of page portfolio
add_filter( 'the_content', array( 'Simpo\Content', 'display_portfolio_content' ), 99 );

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( 'Simpo\Simpo', 'action_links' ), 10, 2 );