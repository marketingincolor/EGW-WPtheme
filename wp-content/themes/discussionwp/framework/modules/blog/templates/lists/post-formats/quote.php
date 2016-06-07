<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkd-post-content">
		<div class="mkd-post-text">
			<div class="mkd-post-text-inner clearfix">
				<div class="mkd-post-title">
					<span class="mkd-post-icon ion-quote"></span>
					<h1 class="mkd-quote-text"><?php the_title(); ?></h1>
				</div>
				<?php if($display_share == 'yes' || $display_comments == 'yes' || $display_count == 'yes' || $display_category == 'yes' || $display_author == 'yes' || $display_like == 'yes' || $display_read_more == 'yes'){ ?>
					<div class="mkd-post-info clearfix">
						<div class="mkd-post-info-left">
							<?php discussion_post_info(array(
								'share' => $display_share,
								'comments' => $display_comments,
								'category' => $display_category,
								'count' => $display_count,
								'date' => $display_date,
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
				<a itemprop="url" class="mkd-post-quote-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
			</div>
		</div>
	</div>
	<?php do_action('discussion_before_blog_list_article_closed_tag'); ?>
</article>