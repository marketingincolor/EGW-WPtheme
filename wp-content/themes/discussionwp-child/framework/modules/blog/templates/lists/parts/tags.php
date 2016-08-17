<?php if(discussion_options()->getOptionValue('blog_single_tags') == 'yes' && has_tag()){ ?>
	<div class="mkd-single-tags-holder">
		<h6 class="mkd-single-tags-title"><?php esc_html_e('POST TAGS:', 'discussionwp'); ?></h6>
		<div class="mkd-tags">
			<?php the_tags('', '', ''); ?>
		</div>
	</div>
<?php } ?>