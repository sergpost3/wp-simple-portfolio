<?php

namespace Simpo;

class Content
{
    public static function display_portfolio_content( $content ) {
        if( !is_page( \Simpo\Settings::get_settings()["portfolio_page_id"] ) )
            return $content;
        return include( SIMPO_VIEWS_FRONT . "portfolio.php" );
    }

    public static function template_include( $template ) {
        $post_id = get_the_ID();

        if( is_single() && ( get_post_type( $post_id ) == 'portfolio' ) ) {
            $filename = "single-portfolio.php";
            if( !$file = locate_template( $filename ) )
                $file = SIMPO_VIEWS_FRONT . $filename;
            return apply_filters( 'simpo_select_template', $file );
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
                "value" => sprintf( '<a href="%1$s" target="_blank">%1$s</a>', $meta["address"][0] )
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
