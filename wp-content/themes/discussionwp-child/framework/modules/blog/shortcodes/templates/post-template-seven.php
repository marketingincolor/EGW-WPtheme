<div class="mkd-pt-seven-item mkd-post-item">
	<div class="mkd-pt-seven-item-inner clearfix">
		<?php if(has_post_thumbnail() && $display_image == 'yes'){ ?>
			<div class="mkd-pt-seven-image-holder" <?php discussion_inline_style($image_style); ?>>
				<a itemprop="url" class="mkd-pt-seven-link mkd-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
					<?php
						echo discussion_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$custom_thumb_image_width,$custom_thumb_image_height);
					?>
				</a>
			</div>
		<?php } ?>
		<div class="mkd-pt-seven-content-holder">
			<div class="mkd-pt-seven-title-holder">
				<<?php echo esc_html($title_tag)?> class="mkd-pt-seven-title">
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
				<div class="mkd-pt-seven-excerpt">
					<?php discussion_excerpt($excerpt_length); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>