<div class="portfolio-data">
    <input type="hidden" name="portfolio_addr_old" value="<?= $data["address"]; ?>"/>

    <h3><?= __( 'Site address and images', 'simpo' ); ?></h3>

    <table class="form_table">
        <tr class="form-field">
            <th scope="row">
                <label for="_portfolio_addr"><?= __( 'Enter site address', 'simpo' ); ?></label>
            </th>
            <td>
                <input type="text" name="portfolio_addr" id="_portfolio_addr" value="<?= $data["address"]; ?>" placeholder="<?= __( 'http://krigus.com/', 'simpo' ); ?>"/>

                <p class="description"></p>
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row">
                <?= __( 'Images actions', 'simpo' ); ?>
            </th>
            <td>
                <label for="dont_update_thumb" class="selectit">
                    <input name="dont_update_thumb" type="checkbox" value="on" id="dont_update_thumb">
                    <?= __( 'Update thumbnail image', 'simpo' ); ?>
                </label><br/>

                <?php if( Simpo()->Simpo_Pro_Active ) : ?>
                    <label for="dont_update_portfolio" class="selectit">
                        <input name="dont_update_portfolio" type="checkbox" value="on" id="dont_update_portfolio">
                        <?= __( 'Update portfolio image', 'simpo' ); ?>
                    </label>
                <?php endif; ?>
            </td>
        </tr>
    </table>

    <?php if( Simpo()->Simpo_Pro_Active )
        include( Simpo()->Simpo_Pro_Plugin_Dir . "meta-boxes/portfolio-addr.php" ); ?>
</div>