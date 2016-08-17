<?php
	$author_info_box = esc_attr(discussion_options()->getOptionValue('blog_author_info'));
	$author_info_email = esc_attr(discussion_options()->getOptionValue('blog_author_info_email'));
	$author_id = esc_attr(get_the_author_meta('ID'));
?>
<?php if($author_info_box === 'yes') { ?>
	<div class="mkd-author-description">
		<div class="mkd-author-description-inner">
			<div class="mkd-author-description-image">
				<span class="mkd-author-tag"><?php esc_html_e('Author','discussionwp');?></span>
				<a itemprop="url" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" title="<?php the_title_attribute(); ?>" target="_self">
					<?php echo discussion_kses_img(get_avatar(get_the_author_meta( 'ID' ), 176)); ?>
				</a>
				<h6 class="mkd-author-name vcard author">
					<a itemprop="url" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" title="<?php the_title_attribute(); ?>" target="_self">
						<?php
							if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
								echo esc_attr(get_the_author_meta('first_name')) . " " . esc_attr(get_the_author_meta('last_name'));
							} else {
								echo esc_attr(get_the_author_meta('display_name'));
							}
						?>
					</a>	
				</h6>
			</div>
			<div class="mkd-author-description-text-holder">
				<?php if(get_the_author_meta('description') != "") { ?>
					<div class="mkd-author-text">
						<p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
					</div>
				<?php } ?>
				<?php if($author_info_email === 'yes' && is_email(get_the_author_meta('email'))){ ?>
					<p class="mkd-author-email"><?php echo sanitize_email(get_the_author_meta('email')); ?></p>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>