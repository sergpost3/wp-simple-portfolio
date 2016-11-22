<?php

namespace Simpo;

class Content
{
    public static function display_portfolio_content( $content ) {
        if( !is_page( \Simpo\Settings::get_settings()["portfolio_page_id"] ) )
            return $content;
        return self::get_part( SIMPO_VIEWS_FRONT . "portfolio.php" );
    }

    public static function get_part( $path ) {
        ob_start();
        include( $path );
        return ob_get_clean();
    }

    public static function template_include( $template ) {
        if( is_single() && ( get_post_type( get_the_ID() ) == 'portfolio' ) ) {
            $sett = simpo_core()->Settings();
            $template_name = $sett::get_settings()['single_page_template'];
            if( $template_name == 'plugin' )
                return apply_filters( 'simpo_select_template', simpo_core()->Simpo_Views_Front . "single-portfolio.php" );
            elseif( $template_name == 'theme' )
                return $template;
            else
                return locate_template( $template_name );
        }
        else
            return $template;
    }

    public static function get_single_table_data( $id ) {
        $settings = \Simpo\Settings::get_settings();
        $meta = get_post_meta( $id, '', true );
        $data = array();

        if( $settings['show_link'] == 'on' && !empty( $meta["address"] ) )
            $data[] = array(
                "name" => $settings['link_header'],
                "value" => sprintf( ' < a href = "%1$s" target = "_blank" >%1$s </a > ', $meta["address"][0] )
            );

        foreach( \Simpo\Meta_Boxes::get_list_fields() as $field ) {
            $id = $field->term_id;
            $value = ( empty( $meta["field_" . $id] ) ) ? false : $meta["field_" . $id][0];
            if( $value ) {
                $data[] = array(
                    "name" => $field->name,
                    "value" => $value
                );
            }
        }
        return $data;
    }
}
