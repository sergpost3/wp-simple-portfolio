<?php

if( !function_exists( 'simpo_autoload' ) ) {
    function simpo_autoload( $class ) {
        $class = explode( '\\', $class );
        if( count( $class ) != 2 )
            return;

        if( $class[0] == "Simpo" )
            $folder = "wp-simple-portfolio";
        elseif( $class[0] == "SimpoPro" )
            $folder = "wp-simple-portfolio-pro";
        else
            return;

        include_once( ABSPATH . "wp-content/plugins" . "/" . $folder . "/classes/" . str_replace( "_", "-", strtolower( $class[1] ) ) . ".class.php" );
    }

    spl_autoload_register( 'simpo_autoload' );
}