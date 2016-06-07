<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkd-post-content">
		<div class="mkd-post-image-holder">
            <?php discussion_post_info_category(array('category' => $display_category)) ?>
			<?php discussion_get_module_template_part('templates/parts/video', 'blog'); ?>
		</div>
        <div class="mkd-post-content-inner">
			<?php 
				discussion_get_module_template_part('templates/lists/parts/title', 'blog');
				discussion_post_info_date(array(
					'date' => $display_date
				));
				discussion_excerpt($excerpt_length);
			?>
		</div>

		<?php if($display_share == 'yes' || $display_comments == 'yes' || $display_count == 'yes' || $display_author == 'yes' || $display_like == 'yes' || $display_read_more == 'yes'){ ?>
			<div class="mkd-post-info clearfix">
				<div class="mkd-post-info-left">
					<?php discussion_post_info(array(
						'share' => $display_share,
						'comments' => $display_comments, 
						'count' => $display_count,
						'author' => $display_author,
						'like' => $display_like,
					),'list') ?>
				</div>
				<div class="mkd-post-info-right">
					<?php if ($display_read_more == 'yes') {
						discussion_read_more_button();
					} ?>
				</div>
			</div>
		<?php } ?>

	</div>
	<?php do_action('discussion_before_blog_list_article_closed_tag'); ?>
</article>