<div class="mkd-ps-item mkd-post-item">
	<div class="mkd-ps-item-inner">
		<div class="mkd-ps-top-content">
			<?php if (has_post_thumbnail()){ ?>
				<div class="mkd-ps-image">
					<a itemprop="url" class="mkd-ps-link mkd-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
						<?php
							echo discussion_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$custom_thumb_image_width,$custom_thumb_image_height);
						?>
					</a>
				</div>
			<?php } ?>
			<div class="mkd-ps-content">
				<div class="mkd-ps-content-inner">
					<?php
					discussion_post_info_category(array(
						'category' => $display_category
					)); ?>
					<<?php echo esc_html($title_tag)?> class="mkd-ps-title">
						<a itemprop="url" class="mkd-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo discussion_get_title_substring(get_the_title(), $title_length) ?></a>
					</<?php echo esc_html($title_tag) ?>>
					<?php
						discussion_post_info_date(array(
							'date' => $display_date,
							'date_format' => $date_format
						));
					?>
				</div>
			</div>
		</div>
	</div>
</div>