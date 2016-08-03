<div class="mkd-pt-nine-item mkd-post-item">
	<div class="mkd-pt-nine-item-inner">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="mkd-pt-nine-image-holder">
				<div class="mkd-pt-nine-image-inner-holder">
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
		<div class="mkd-pt-nine-content-holder">
			<div class="mkd-pt-nine-content">
				<?php
					if($display_post_type_icon == 'yes') {
						discussion_post_info_type(array(
							'icon' => 'yes',
						));
					}
				?>
				<?php discussion_post_info_category(array(
					'category' => $display_category,
				)); ?>
				<div class="mkd-pt-nine-title-holder">
					<<?php echo esc_html($title_tag)?> class="mkd-pt-nine-title">
					<a itemprop="url" class="mkd-pt-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"><?php echo discussion_get_title_substring(get_the_title(), $title_length) ?></a>
				</<?php echo esc_html($title_tag) ?>>
				</div>
				<?php if($display_author == 'yes' || $display_date == 'yes') { ?>
					<div class="mkd-pt-nine-bottom-holder">
						<div>
							<?php
							if($display_author == 'yes') {
								discussion_post_info_author(array(
									'author' => $display_author
								));
							} ?>
							<?php
								discussion_post_info_date(array(
									'date' => $display_date,
									'date_format' => $date_format
								));
							?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<a itemprop="url" class="mkd-pt-nine-slide-link mkd-pt-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"></a>
	</div>
</div>