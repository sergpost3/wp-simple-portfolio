<?php

namespace Simpo;

class Registry
{
    protected $data;
    protected $classes;
    protected static $instance = null;

    public static function get_instance() {
        if( self::$instance == null )
            self::$instance = new self();
        return self::$instance;
    }

    protected function __construct() {
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

    private function get_namespaces() {
        return array( 'Simpo' => "wp-simple-portfolio" );
    }

    protected function load_class( $name, $namespaces = false ) {
        if( !$namespaces )
            $namespaces = $this->get_namespaces();
        $classname = false;
        foreach( $namespaces as $namespace => $path ) {
            if( !$classname ) {
                $classname = $namespace . '\\' . $name;
                if( !class_exists( $classname ) ) {
                    if( !$this->load_file( $path, $name ) )
                        $classname = false;
                }
            }
        }
        $this->classes[$name] = new $classname();
        return true;
    }

    protected function load_file( $path, $name ) {
        //spl_autoload_unregister( 'simpo_autoload' );

        if( empty( $path ) || empty( $name ) )
            return false;

        $file = ABSPATH . "wp-content/plugins/" . $path . "/classes/" . str_replace( "_", "-", strtolower( $name ) ) . ".class.php";

        if( !file_exists( $file ) )
            return false;

        include_once( $file );
    }
}