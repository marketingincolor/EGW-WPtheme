<div class="mkd-psi-slide-thumb">
    <?php if (has_post_thumbnail()) { ?>
    <div class="mkd-psi-image" <?php discussion_inline_style($background_image_thumbs);?>>
    </div>
    <?php } ?>
    <div class="mkd-psi-thumb-content">
        <h5 class="mkd-psi-title">
            <?php echo esc_html(get_the_title()) ?>
        </h5>
		<?php
			discussion_post_info_date(array(
				'date' => $display_date,
				'date_format' => $date_format
			));
		?>
    </div>
</div>