<div class="mkd-pt-two-item mkd-post-item">
	<div class="mkd-pt-two-item-inner">
		<?php if(has_post_thumbnail()){ ?>
			<div class="mkd-pt-two-image-holder">
				<?php
				discussion_post_info_category(array(
					'category' => $display_category
				)); ?>
				<a itemprop="url" class="mkd-pt-two-link mkd-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self" <?php discussion_inline_style($image_style); ?>>
					<?php
						echo discussion_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$custom_thumb_image_width,$custom_thumb_image_height);
					?>
				</a>
			</div>
		<?php } ?>
		<div class="mkd-pt-two-content-holder">
			<div class="mkd-pt-two-content-holder-inner">
				<div class="mkd-pt-two-content-top-holder">
					<div class="mkd-pt-two-content-top-holder-cell">
						<<?php echo esc_html( $title_tag)?> class="mkd-pt-two-title">
						<a itemprop="url" class="mkd-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self">
							<?php echo discussion_get_title_substring(get_the_title(), $title_length) ?>
						</a>
						</<?php echo esc_html($title_tag) ?>>
						<?php
							discussion_post_info_date(array(
								'date' => $display_date,
								'date_format' => $date_format
							));
						?>
						<?php if($display_excerpt == 'yes'){ ?>
							<div class="mkd-pt-two-excerpt">
								<?php discussion_excerpt($excerpt_length); ?>
							</div>
						<?php } ?>
					</div>
				</div>
				<?php if($display_share == 'yes' || $display_comments == 'yes' || $display_count == 'yes'){ ?>
					<div class="mkd-pt-two-content-bottom-holder">
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
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>