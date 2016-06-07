<div class="mkd-pswt-slide-thumb">
	<div class="mkd-pswt-slide-thumb-inner">
		<?php if (has_post_thumbnail()) { ?>
			<div class="mkd-pswt-image" <?php discussion_inline_style($thumbnail_background_image);?>>
			</div>
		<?php } ?>
		<div class="mkd-pswt-thumb-content">
			<h5 class="mkd-pswt-title">
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
</div>