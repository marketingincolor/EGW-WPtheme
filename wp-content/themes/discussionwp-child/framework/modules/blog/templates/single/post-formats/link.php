<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkd-post-content">
		<div class="mkd-post-title-area">
			<div class="mkd-post-title">
				<span class="mkd-post-icon ion-link"></span>
				<h1 class="mkd-link-title">
					<a href="<?php echo esc_url(get_post_meta(get_the_ID(), "mkd_post_link_link_meta", true)); ?>"><?php echo the_title() ?></a>
				</h1>
			</div>
			<div class="mkd-post-info">
				<?php discussion_post_info(array(
					'comments' => $display_comments,
					'category' => $display_category,
					'count' => $display_count,
					'date' => $display_date,
					'author' => $display_author,
					'like' => $display_like,
				)) ?>
			</div>
		</div>
		<div class="mkd-post-text">
			<div class="mkd-post-text-inner clearfix">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<?php do_action('discussion_before_blog_article_closed_tag'); ?>
</article>