<div class="mkd-pt-eight-item mkd-post-item">
	<div class="mkd-pt-eight-item-inner">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="mkd-pt-eight-image-holder">
				<div class="mkd-pt-eight-image-inner-holder">
					<?php
					if($thumb_image_size != 'custom_size') {
						echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
					} elseif($thumb_image_width != '' && $thumb_image_height != ''){
						echo discussion_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$thumb_image_width,$thumb_image_height);
					}
					?>
				</div>
			</div>
		<?php } ?>
		<div class="mkd-pt-eight-content-holder">
			<div class="mkd-pt-eight-content-holder-inner">
				<div class="mkd-pt-eight-content">
					<div class="mkd-pt-eight-title-holder">
						<<?php echo esc_html($title_tag)?> class="mkd-pt-eight-title">
						<a itemprop="url" class="mkd-pt-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"><?php echo discussion_get_title_substring(get_the_title(), $title_length) ?></a>
					</<?php echo esc_html($title_tag) ?>>
					</div>
					<?php
						discussion_post_info_date(array(
							'date' => $display_date,
							'date_format' => $date_format
						));
					?>
					<?php if($display_excerpt == 'yes'){ ?>
						<div class="mkd-pt-eight-excerpt">
							<?php discussion_excerpt($excerpt_length); ?>
						</div>
					<?php } ?>
					<?php if($display_read_more == 'yes'){
							discussion_read_more_button();
					} ?>
				</div>
			</div>
		</div>
		<a itemprop="url" class="mkd-pt-eight-slide-link mkd-pt-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"></a>
	</div>
</div>