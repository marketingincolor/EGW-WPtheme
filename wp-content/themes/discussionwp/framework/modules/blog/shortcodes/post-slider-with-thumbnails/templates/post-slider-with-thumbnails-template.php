<div class="mkd-pswt-slide" data-thumb="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id()))?>">
	<div class="mkd-pswt-content-outer">
		<?php if (has_post_thumbnail()) { ?>
		<div class="mkd-pswt-image">
			<a itemprop="url" class="mkd-pswt-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
				<?php
					if($thumb_image_size != 'custom_size') {
						echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
					} elseif($thumb_image_width != '' && $thumb_image_height != ''){
						echo discussion_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$thumb_image_width,$thumb_image_height);
					}
				?>
			</a>
		</div>
		<?php } ?>
		<div class="mkd-pswt-content">
			<?php discussion_post_info_category(array(
				'category' => $display_category
			)) ?>
			<<?php echo esc_html($title_tag)?> class="mkd-pswt-title">
				<a itemprop="url" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo esc_attr(get_the_title()) ?></a>
			</<?php echo esc_html($title_tag) ?>>
			<?php
				discussion_post_info_date(array(
					'date' => $display_date,
					'date_format' => $date_format
				));
			?>
			<?php if($display_share == 'yes' || $display_comments == 'yes' || $display_count == 'yes'){ ?>
				<div class="mkd-pt-info-section clearfix">
					<div>
						<?php discussion_post_info_share(array(
							'share' => $display_share
						));
						discussion_post_info_comments(array(
							'comments' => $display_comments
						));
						discussion_post_info_count(array(
							'count' => $display_count
						),'list'); ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>