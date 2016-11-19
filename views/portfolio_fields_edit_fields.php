<tr class="form-field term-order-wrap">
    <th scope="row"><label for="tag-order"><?= __( 'Order', 'simpo' ); ?></label></th>
    <td>
        <input name="tag-order" id="tag-order" type="number" min="1" value="<?= $order; ?>"/>

        <p class="description"><?= __( 'Order of fields in admin panel and in frontend or your site', 'simpo' ); ?></p>
    </td>
</tr>
<tr class="form-field term-textarea-wrap">
    <th scope="row"><label for="tag-textarea"><?= __( 'Textarea', 'simpo' ); ?></label></th>
    <td>
        <label for="tag-textarea">
            <?php if( $textarea == "on" ) : ?>
                <input name="tag-textarea" id="tag-textarea" type="checkbox" checked="checked"/>
            <?php else : ?>
                <input name="tag-textarea" id="tag-textarea" type="checkbox"/>
            <?php endif; ?>
            <?= __( 'Select if you want to enter multi-row data', 'simpo' ); ?>
        </label>
    </td>
</tr>