<?php
$image_gallery_val = get_post_meta( get_the_ID(), 'mkd_post_gallery_images_meta' , true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkd-post-content">
		<?php if ($image_gallery_val !== ''){ ?>
			<div class="mkd-post-image-area">
				<?php discussion_post_info_category(array('category' => $display_category)) ?>
				<?php discussion_get_module_template_part('templates/single/parts/gallery', 'blog'); ?>
				<div class="mkd-post-info">
					<?php discussion_post_info(array(
						'comments' => $display_comments, 
						'count' => $display_count,
						'date' => $display_date,
						'author' => $display_author,
						'like' => $display_like,
					)) ?>
				</div>
			</div>
		<?php } ?>
		<div class="mkd-post-text">
			<div class="mkd-post-text-inner clearfix">
				<?php if ($image_gallery_val == ''){ ?>
					<div class="mkd-post-info">
						<?php discussion_post_info(array(
							'comments' => $display_comments, 
							'count' => $display_count,
							'date' => $display_date,
							'author' => $display_author,
							'like' => $display_like,
							'category' => $display_category
						)) ?>
					</div>
				<?php } ?>
				<?php discussion_get_module_template_part('templates/single/parts/title', 'blog'); ?>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<?php do_action('discussion_before_blog_article_closed_tag'); ?>
</article>