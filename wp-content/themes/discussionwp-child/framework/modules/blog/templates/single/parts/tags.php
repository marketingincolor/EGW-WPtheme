<?php if(discussion_options()->getOptionValue('blog_single_tags') == 'yes' && has_tag()){ ?>
<div class="mkd-single-tags-holder">
	<span class="mkd-single-tags-title"><?php esc_html_e('Tags', 'discussionwp'); ?></span>
	<div class="mkd-tags">
		<?php the_tags('', '', ''); ?>
	</div>
</div>
<?php } ?>