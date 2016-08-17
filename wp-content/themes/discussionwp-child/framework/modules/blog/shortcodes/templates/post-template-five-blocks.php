<div class="mkd-pt-five-item mkd-post-item <?php echo esc_attr($post_no_class);?>" <?php discussion_inline_style($background_image_style);?>>
    <a itemprop="url" class="mkd-post-item-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
    </a>
	<div class="mkd-pt-five-item-inner">
		<div class="mkd-pt-five-top-content">
			<?php
			discussion_post_info_category(array(
				'category' => $display_category
			)); ?>
			<div class="mkd-pt-five-content">
				<div class="mkd-pt-five-content-inner">
					<<?php echo esc_html($title_tag)?> class="mkd-pt-five-title">
						<a itemprop="url" class="mkd-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo discussion_get_title_substring(get_the_title(), $title_length) ?></a>
					</<?php echo esc_html($title_tag) ?>>
					<?php
						discussion_post_info_date(array(
							'date' => $display_date,
							'date_format' => $date_format
						));
					?>
				</div>
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
</div>