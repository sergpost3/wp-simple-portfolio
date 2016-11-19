<?php

/**
 * Plugin Name: WP Simple Portfolio
 * Description: Simple Portfolio in your site
 * Version: 1.0
 * Author: Krigus
 * Author URI: http://krigus.com/
 * License: GPL2 or later
 * Author e-mail: sergpost33@gmail.com
 */

define( 'SIMPO_VERSION', '0.0.1' );
define( 'SIMPO__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SIMPO__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SIMPO_VIEWS_FRONT', SIMPO__PLUGIN_DIR . "views/frontend/" );

require_once( SIMPO__PLUGIN_DIR . 'classes/simpo.class.php' );
require_once( SIMPO__PLUGIN_DIR . 'classes/post-type.class.php' );
require_once( SIMPO__PLUGIN_DIR . 'classes/meta-boxes.class.php' );
require_once( SIMPO__PLUGIN_DIR . 'classes/images.class.php' );
require_once( SIMPO__PLUGIN_DIR . 'classes/settings.class.php' );
require_once( SIMPO__PLUGIN_DIR . 'classes/content.class.php' );

register_activation_hook( __FILE__, array( 'Simpo\Simpo', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Simpo\Simpo', 'plugin_deactivation' ) );

add_action( 'init', array( 'Simpo\Post_Type', 'register_portfolio' ) );
add_action( 'init', array( 'Simpo\Simpo', 'init' ) );
add_action( 'plugins_loaded', array( 'Simpo\Simpo', 'load_language' ) );
add_action( 'add_meta_boxes', array( 'Simpo\Meta_Boxes', 'add_meta_boxes' ) );
add_action( 'save_post', array( 'Simpo\Meta_Boxes', 'save_post' ), 30 );
add_action( 'save_post', array( 'Simpo\Images', 'save_post' ), 90 );
add_action( 'wp_enqueue_scripts', array( 'Simpo\Simpo', 'enqueue_scripts' ) );
add_action( 'admin_menu', array( 'Simpo\Settings', 'add_menu_page' ) );
add_action( 'init', array( 'Simpo\Meta_Boxes', 'admin_styles_register' ) );
add_action( 'admin_head', array( 'Simpo\Meta_Boxes', 'admin_styles_enqueue' ) );
add_filter( 'template_include', array( 'Simpo\Content', 'template_include' ) );
add_filter( 'display_post_states', array( 'Simpo\Settings', 'display_post_state' ), 95, 2 );
add_filter( 'the_content', array( 'Simpo\Content', 'display_portfolio_content' ), 99 );

add_action( 'portfolio_fields_add_form_fields', array( 'Simpo\Post_Type', 'portfolio_fields_add_new_fields' ) );
add_action( 'portfolio_fields_edit_form_fields', array( 'Simpo\Post_Type', 'portfolio_fields_add_edit_fields' ), 95, 2 );

add_filter( 'manage_edit-portfolio_fields_columns', array( 'Simpo\Post_Type', 'portfolio_fields_edit_table_columns' ) );
add_filter( 'manage_portfolio_fields_custom_column', array( 'Simpo\Post_Type', 'portfolio_fields_edit_table_column_content' ), 95, 3 );

add_action( "create_term", array( 'Simpo\Post_Type', 'edit_term' ), 95, 3 );
add_action( "edit_term", array( 'Simpo\Post_Type', 'edit_term' ), 95, 3 );