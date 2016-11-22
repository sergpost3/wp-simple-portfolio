<?php

namespace Simpo;

class Registry
{
    private $data;
    private $classes;
    private static $instance = null;

    public static function get_instance() {
        if( self::$instance == null )
            self::$instance = new self();
        return self::$instance;
    }

    private function __construct() {
        $this->data = array();
        $this->classes = array();
    }

    public function __set( $name, $value ) {
        $this->data[$name] = $value;
    }

    public function __get( $name ) {
        if( isset( $this->data[$name] ) )
            return $this->data[$name];
        return false;
    }

    public function __call( $name, $args ) {
        if( !isset( $this->classes[$name] ) ) {
            if( !$this->load_class( $name ) )
                return false;
        }
        return $this->classes[$name];
    }

    private function load_class( $name ) {
        $classname = 'Simpo\\' . $name;
        if( !class_exists( $classname ) ) {
            if( !$this->load_file( $classname ) )
                return false;
        }
        $this->classes[$name] = new $classname();
        return true;
    }

    private function load_file( $classname ) {
        spl_autoload_unregister( 'simpo_autoload' );

        $class = explode( '\\', $classname );
        if( count( $class ) != 2 )
            return false;

        if( $class[0] == "Simpo" )
            $folder = "wp-simple-portfolio";
        elseif( $class[0] == "SimpoPro" )
            $folder = "wp-simple-portfolio-pro";
        else
            return false;

        $file = ABSPATH . "wp-content/plugins" . "/" . $folder . "/classes/" . str_replace( "_", "-", strtolower( $class[1] ) ) . ".class.php";
        if( !file_exists( $file ) )
            return false;
        include_once( $file );
    }
}