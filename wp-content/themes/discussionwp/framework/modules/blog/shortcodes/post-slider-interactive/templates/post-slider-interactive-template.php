<div class="mkd-psi-slide" data-image-proportion="<?php echo esc_attr($proportion)?>" <?php discussion_inline_style($background_image);?>>
    <div class="mkd-psi-content">
		<div class="mkd-grid">
	        <?php discussion_post_info_category(array(
	            'category' => $display_category
	        )) ?>
	        <<?php echo esc_html($title_tag)?> class="mkd-psi-title">
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