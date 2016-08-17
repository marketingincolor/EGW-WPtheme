<div class="mkd-related-posts-holder">
	<?php if ( $related_posts && $related_posts->have_posts() ) : ?>
		<div class="mkd-related-posts-title">
			<?php echo discussion_execute_shortcode('mkd_section_title', array('title' => esc_html__('Related Articles','discussionwp'))); ?>
		</div>
		<div class="mkd-related-posts-inner clearfix">
			<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
				<div class="mkd-related-post">
					<div class="mkd-related-post-inner">
						<div class="mkd-related-top-content">
							<?php if (has_post_thumbnail()){ ?>
								<div class="mkd-related-image">
									<a itemprop="url" class="mkd-related-link mkd-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
		                                <?php if($related_posts_image_size !== '') {
		                                    the_post_thumbnail(array($related_posts_image_size, 0));
		                                } else {
		                                    the_post_thumbnail('discussion_landscape');
		                                } ?>
									</a>
								</div>
							<?php } ?>
							<div class="mkd-related-content">
								<h4 class="mkd-related-title">
									<a itemprop="url" class="mkd-related-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo discussion_get_title_substring(get_the_title(), $related_posts_title_size) ?></a>
								</h4>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	<?php endif; 
	wp_reset_postdata();
	?>
</div>