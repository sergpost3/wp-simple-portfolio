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
                    <?= __( 'Dont update thumbnail image', 'simpo' ); ?>
                </label><br/>

                <label for="dont_update_portfolio" class="selectit">
                    <input name="dont_update_portfolio" type="checkbox" value="on" id="dont_update_portfolio">
                    <?= __( 'Dont update portfolio image', 'simpo' ); ?>
                </label>
            </td>
        </tr>
    </table>

    <h3><?= __( 'Details', 'simpo' ); ?></h3>

    <table class="form_table">
        <?php foreach( \Simpo\Meta_Boxes::get_list_fields() as $field ) : ?>
            <tr class="form-field">
                <th scope="row">
                    <label for="field_<?= $field->term_id; ?>"><?= $field->name; ?></label>
                </th>
                <td>
                    <?php if( \Simpo\Meta_Boxes::is_textarea_feld( $field->term_id ) ) : ?>
                        <textarea name="portfolio_details[<?= $field->term_id; ?>]" id="field_<?= $field->term_id; ?>" placeholder="<?= $field->name; ?>"><?= $data[$field->term_id]; ?></textarea>
                    <?php else : ?>
                        <input type="text" name="portfolio_details[<?= $field->term_id; ?>]" id="field_<?= $field->term_id; ?>" value="<?= $data[$field->term_id]; ?>" placeholder="<?= $field->name; ?>"/>
                    <?php endif; ?>

                    <p class="description"><?= ( ( class_exists( 'QTX_Translator' ) ) ? QTX_Translator::get_translator()->translate_text( $field->description ) : $field->description ); ?></p>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>