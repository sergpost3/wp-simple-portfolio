<?php

/*
 * Template Name: Single Portfolio
 */

get_header();

while( have_posts() ): the_post();

    include( Simpo()->Simpo_Views_Front . "single-portfolio-inner.php" );

endwhile;

get_footer();

?>