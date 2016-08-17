<div class="mkd-pt-three-item mkd-post-item">
    <div class="mkd-pt-three-item-inner">
        <div class="mkd-pt-three-item-inner2">
            <?php if(has_post_thumbnail()){ ?>
                <div class="mkd-pt-three-image-holder">
					<?php discussion_post_info_category(array(
						'category' => $display_category,
					)); ?>
                    <a itemprop="url" class="mkd-pt-three-link mkd-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                    <?php
                    if($thumb_image_size != 'custom_size') {
                        echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
                    }
                    elseif($thumb_image_width != '' && $thumb_image_height != ''){
                        echo discussion_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,$thumb_image_width,$thumb_image_height);
                    }
                    ?>
                    </a>
                </div>
            <?php } ?>
            <div class="mkd-pt-three-content-holder">
				<div class="mkd-pt-three-content-holder-inner">
					<div class="mkd-pt-three-content-top-holder">
						<div class="mkd-pt-three-content-top-holder-cell">
							<<?php echo esc_html( $title_tag)?> class="mkd-pt-three-title">
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
								<div class="mkd-pt-three-excerpt">
									<?php discussion_excerpt($excerpt_length); ?>
								</div>
							<?php } ?>
						</div>
					</div>
					<?php if($display_share == 'yes' || $display_comments == 'yes'){ ?>
						<div class="mkd-pt-three-content-bottom-holder">
							<div class="mkd-pt-info-section clearfix">
								<div>
									<?php discussion_post_info_share(array(
										'share' => $display_share
									));
									discussion_post_info_comments(array(
										'comments' => $display_comments
									));
									?>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
            </div>
        </div>
    </div>
</div>