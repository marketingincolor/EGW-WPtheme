<div class="mkd-pb-three-item mkd-post-item">
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="mkd-pb-three-image-holder">
			<div class="mkd-pb-three-image-inner-holder">
				<a itemprop="url" class="mkd-pb-three-slide-link mkd-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
				<?php
					echo discussion_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$custom_thumb_image_width,$custom_thumb_image_height);
				?>
				</a>
			</div>
		</div>
	<?php } ?>
	<div class="mkd-pb-three-content-holder-outer">
		<div class="mkd-pb-three-content-holder">
			<div class="mkd-pb-three-content-holder-inner">
					<?php
					discussion_post_info_category(array(
						'category' => $display_category
					)); ?>
				<div class="mkd-pb-three-title-holder">
					<<?php echo esc_html($title_tag)?> class="mkd-pb-three-title">
					<a itemprop="url" class="mkd-pt-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"><?php echo discussion_get_title_substring(get_the_title(), $title_length) ?></a>
				</<?php echo esc_html($title_tag) ?>>
				</div>
				<?php if($display_excerpt == 'yes'){ ?>
					<div class="mkd-pb-three-excerpt">
						<?php discussion_excerpt($excerpt_length); ?>
					</div>
				<?php } ?>
				<?php if($display_author == 'yes'){ ?>
				<div class="mkd-pt-info-section clearfix">
					<div class="mkd-pbt-author-image">
						<?php echo discussion_kses_img(get_avatar(get_the_author_meta('ID'), 30)); ?>
					</div>
					<div class="mkd-pbt-author">
						<span><?php esc_html_e('By','discussionwp')?></span>
						<?php discussion_post_info_author(array(
							'author' => $display_author
						)) ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>