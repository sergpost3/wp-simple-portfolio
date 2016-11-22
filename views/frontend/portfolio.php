<?php

/*
 * Template Name: Portfolio Page
 */

global $post;

$settings = Simpo()->Settings()->get_settings();
$args = array(
    'posts_per_page' => -1,
    "post_type" => "portfolio"
);

$col = intval( 12 / $settings["portfolio_columns"] );

$query = new WP_Query( $args );

?>

<div class="row">
    <div class="col-md-12">

        <?php if( $settings['show_header'] == 'on' ) : ?>
            <h2><?= $settings['header']; ?></h2>
        <?php endif; ?>

        <ul class="portfolio-menu">
            <?php foreach( Simpo()->Simpo()->get_categories_list() as $key => $category ): ?>
                <li>
                    <a href="#" data-filter="<?= $category['slug']; ?>"><?= $category['name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<div class="row grid">
    <?php while( $query->have_posts() ): $query->the_post(); ?>
        <div class="col-md-<?= $col; ?> mix grid-item <?= Simpo()->Simpo()->get_portfolio_post_categories( $post->ID ); ?>">
            <?php
            $size = 'post-thumbnail';
            the_post_thumbnail( $size );
            ?>
            <a class="grid-item-hover" href="<?= get_permalink( $post->ID ); ?>">
                <?php //<h3 class="title"><?php the_title(); </h3>?>
                <div class="circle">
                    <span class="dashicons dashicons-search"></span>
                </div>
            </a>
        </div>
    <?php endwhile; ?>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="pagination-container text-center">

            <ul class="pager-list pagination"></ul>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".grid").mixItUp({
            load: {page: 1},
            pagination: {
                limit: <?= $settings['posts_per_page']; ?>,
                loop: false,
                generatePagers: true,
                maxPagers: false,
                pagerClass: ''
            },
            selectors: {
                pagersWrapper: '.pager-list',
                pager: '.pager',
                filter: ".portfolio-menu a"
            }
        });
    });
</script>