<div class="mkd-pt-five-item mkd-post-item" data-image-proportion="<?php echo esc_attr($proportion)?>" <?php discussion_inline_style($background_image);?>>
    <a itemprop="url" class="mkd-post-item-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
    </a>
	<?php if ($content_in_grid == 'yes'){ ?>
	<div class="mkd-grid">
	<?php } ?>
		<div class="mkd-pt-five-item-inner">
			<div class="mkd-pt-five-top-content">
				<div class="mkd-pt-five-content">
					<div class="mkd-pt-five-content-inner">
						<?php
						discussion_post_info_category(array(
							'category' => $display_category
						)); ?>
						<<?php echo esc_html($title_tag)?> class="mkd-pt-five-title">
							<a itemprop="url" class="mkd-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo discussion_get_title_substring(get_the_title(), $title_length) ?></a>
						</<?php echo esc_html($title_tag) ?>>
						<?php
							discussion_post_info_date(array(
								'date' => $display_date,
								'date_format' => $date_format
							));
						?>
						<?php if($display_excerpt == 'yes'){ ?>
							<div class="mkd-pt-five-excerpt">
								<?php discussion_excerpt($excerpt_length); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	<?php if ($content_in_grid == 'yes'){ ?>
	</div>
	<?php } ?>
</div>