<div class="wrap">
    <h1><?= __( 'Portfolio settings', 'simpo' ); ?></h1>

    <form method="post" action="" novalidate="novalidate">
        <?php wp_nonce_field( 'simpo-settings-update' ); ?>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="portfolio_page_id"><?= __( 'Portfolio page', 'simpo' ); ?></label></th>
                <td>
                    <?php wp_dropdown_pages( array(
                        "name" => "simpo[portfolio_page_id]",
                        "id" => "portfolio_page_id",
                        "show_option_none" => "---",
                        "option_none_value" => "-1",
                        "selected" => $settings['portfolio_page_id']
                    ) ); ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?= __( 'Delete images', 'simpo' ); ?></th>
                <td>
                    <fieldset>
                        <label for="del_img_after_change">
                            <?php if( $settings['del_img_after_change'] == 'on' ): ?>
                                <input name="simpo[del_img_after_change]" type="checkbox" id="del_img_after_change" value="on" checked="checked">
                            <?php else : ?>
                                <input name="simpo[del_img_after_change]" type="checkbox" id="del_img_after_change" value="on">
                            <?php endif; ?>
                            <?= __( 'Delete images after change site URL', 'simpo' ); ?>
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row"><?= __( 'Portfolio columns', 'simpo' ); ?></th>
                <td>
                    <fieldset>
                        <label>
                            <input type="radio" name="simpo[portfolio_columns]" value="2" <?php if( $settings['portfolio_columns'] == '2' )
                                echo 'checked="checked"'; ?> />
                            <?= __( '2 columns', 'simpo' ); ?>
                        </label><br/>
                        <label>
                            <input type="radio" name="simpo[portfolio_columns]" value="3" <?php if( $settings['portfolio_columns'] == '3' )
                                echo 'checked="checked"'; ?> />
                            <?= __( '3 columns', 'simpo' ); ?>
                        </label><br/>
                        <label>
                            <input type="radio" name="simpo[portfolio_columns]" value="4" <?php if( $settings['portfolio_columns'] == '4' )
                                echo 'checked="checked"'; ?> />
                            <?= __( '4 columns', 'simpo' ); ?>
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="posts_per_page"><?= __( 'Portfolio per page', 'simpo' ); ?></label></th>
                <td>
                    <input name="simpo[posts_per_page]" type="number" step="1" min="1" id="posts_per_page" value="<?= $settings['posts_per_page']; ?>" class="small-text"/> <?= __( 'items', 'simpo' ); ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?= __( 'Show header', 'simpo' ); ?></th>
                <td>
                    <fieldset>
                        <label for="show_header">
                            <?php if( $settings['show_header'] == 'on' ): ?>
                                <input name="simpo[show_header]" type="checkbox" id="show_header" value="on" checked="checked">
                            <?php else : ?>
                                <input name="simpo[show_header]" type="checkbox" id="show_header" value="on">
                            <?php endif; ?>
                            <?= __( 'Show header portfolio on the page', 'simpo' ); ?>
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="header"><?= __( 'Portfolio header', 'simpo' ); ?></label></th>
                <td>
                    <input name="simpo[header]" type="text" id="header" value="<?= $settings['header']; ?>" class="regular-text"/>
                </td>
            </tr>
            <tr>
                <th scope="row"><?= __( 'Show link', 'simpo' ); ?></th>
                <td>
                    <fieldset>
                        <label for="show_link">
                            <?php if( $settings['show_link'] == 'on' ): ?>
                                <input name="simpo[show_link]" type="checkbox" id="show_link" value="on" checked="checked">
                            <?php else : ?>
                                <input name="simpo[show_link]" type="checkbox" id="show_link" value="on">
                            <?php endif; ?>
                            <?= __( 'Show site link in details table', 'simpo' ); ?>
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="link_header"><?= __( 'Link header', 'simpo' ); ?></label></th>
                <td>
                    <input name="simpo[link_header]" type="text" id="link_header" value="<?= $settings['link_header']; ?>" class="regular-text"/>
                    <p class="description" id="tagline-description"><?= __( 'Header in row with site link in details table', 'simpo' ); ?></p>
                </td>
            </tr>
        </table>

        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="<?= __( 'Save', 'simpo' ); ?>">
        </p>
    </form>
</div>