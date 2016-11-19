<div class="underhead-img">
    <?php if( $img ): ?>
        <img src="<?= $img; ?>" width="100%"/>
    <?php else : ?>
        <img class="hidden" src="" width="100%"/>
    <?php endif; ?>

    <div>
        <input type="hidden" name="portfolio_image" id="portfolio_image" value="<?= $img_id; ?>"/>
        <button type="submit" class="upload_image_button button">Загрузить</button>
        <button type="submit" class="remove_image_button button">&times;</button>
    </div>
</div>


<script type="text/javascript">
    jQuery(function($) {
        /*
         * действие при нажатии на кнопку загрузки изображения
         * вы также можете привязать это действие к клику по самому изображению
         */
        $('.upload_image_button').click(function() {
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $(this);
            wp.media.editor.send.attachment = function(props, attachment) {
                $(button).parent().prev().removeClass('hidden').attr('src', attachment.url);
                $(button).prev().val(attachment.id);
                wp.media.editor.send.attachment = send_attachment_bkp;
            }
            wp.media.editor.open(button);
            return false;
        });
        /*
         * удаляем значение произвольного поля
         * если быть точным, то мы просто удаляем value у input type="hidden"
         */
        $('.remove_image_button').click(function() {
            var r = confirm("Уверены?");
            if(r == true) {
                $(this).parent().prev().addClass('hidden').attr('src', '');
                $(this).prev().prev().val('');
            }
            return false;
        });
    });
</script>