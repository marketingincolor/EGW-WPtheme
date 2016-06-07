<div class="mkd-pt-six-item mkd-post-item">
    <?php if ( has_post_thumbnail() ) { ?>
        <div class="mkd-pt-six-image-holder">
            <?php
            discussion_post_info_category(array(
                'category' => $display_category
            )); ?>
            <a itemprop="url" class="mkd-pt-six-slide-link mkd-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                <?php
                if($thumb_image_size != 'custom_size') {
                    echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
                }
                elseif($thumb_image_width != '' && $thumb_image_height != ''){
                    echo discussion_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$thumb_image_width,$thumb_image_height);
                } ?>
				<?php
					if($display_post_type_icon == 'yes') {
						discussion_post_info_type(array(
							'icon' => 'yes',
						));
					}
				?>
            </a>
        </div>
    <?php } ?>
    <div class="mkd-pt-six-content-holder">
        <div class="mkd-pt-six-title-holder">
            <<?php echo esc_html($title_tag)?> class="mkd-pt-six-title">
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
            <div class="mkd-pt-one-excerpt">
                <?php discussion_excerpt($excerpt_length); ?>
            </div>
        <?php } ?>
    </div>
	<?php if($display_share == 'yes' || $display_comments == 'yes'){ ?>
		<div class="mkd-pt-info-section clearfix">
			<div>
				<?php discussion_post_info_share(array(
					'share' => $display_share
				));
				discussion_post_info_comments(array(
					'comments' => $display_comments
				)); ?>
			</div>
            <div class="mkd-pt-info-section-background"></div>
		</div>
	<?php } ?>
</div>