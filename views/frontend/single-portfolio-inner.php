<div class="post single-portfolio">
    <div class="portfolio-image">
        <?php if( Simpo()->Simpo_Pro_Active ) : ?>
            <?php Simpo()->Images()->portfolio_image( $post->ID, 'full', get_the_title(), get_the_title(), true ); ?>
        <?php else : ?>
            <?php the_post_thumbnail( 'full' ); ?>
        <?php endif; ?>
    </div>

    <?php if( $details = Simpo()->Simpo()->get_single_detalis( $post->ID ) ) : ?>
        <h3 class="portfolio-details"><?= __( 'Details', 'simpo' ); ?></h3>

        <table class="portfolio-details-table">

            <?php foreach( Simpo()->Content()->get_single_table_data( $post->ID ) as $row ) : ?>
                <tr>
                    <th><?= $row["name"]; ?></th>
                    <td><?= $row["value"]; ?></td>
                </tr>
            <?php endforeach; ?>

        </table>
    <?php endif; ?>
</div>

<?php comments_template(); ?>