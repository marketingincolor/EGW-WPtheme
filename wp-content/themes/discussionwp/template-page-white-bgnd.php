<?php
/*
 * Author - MIC
 * Date - 13-06-2016
 * Purpose - For displaying specific pages and landing pages with a white background 
 * Template Name: White Background
 *
*/ 
$sidebar = discussion_sidebar_layout(); ?>
<?php get_header(); ?>
<style>
/* Start Custom layouts from MIC */
.page-template-template-page-white-bgnd { background-color: #ffffff; }
.page-template-template-page-white-bgnd .mkd-content { background-color: #ffffff; }
.page-template-template-page-white-bgnd .mkd-title .mkd-title-holder { height:auto; }
/* End Custom layouts from MIC */
</style>
	<?php discussion_get_title(); ?>
	<?php get_template_part('slider'); ?>
	<div class="mkd-container">
		<?php do_action('discussion_after_container_open'); ?>
		<div class="mkd-container-inner clearfix">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php if(($sidebar == 'default')||($sidebar == '')) : ?>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="page-feature-image">
							<?php the_post_thumbnail('full'); ?>
						</div>
					<?php endif; ?>

					<?php the_title( '<h2 class="page-title">', '</h2>' ); ?>
					<?php the_content(); ?>
					<?php do_action('discussion_page_after_content'); ?>

				<?php elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>
					<div <?php echo discussion_sidebar_columns_class(); ?>>
						<div class="mkd-column1 mkd-content-left-from-sidebar">
							<div class="mkd-column-inner">

							<?php if ( has_post_thumbnail() ) : ?>
								<div class="page-feature-image">
									<?php the_post_thumbnail('full'); ?>
								</div>
							<?php endif; ?>

								<?php the_title( '<h2 class="page-title">', '</h2>' ); ?>
								<?php the_content(); ?>
								<?php //do_action('discussion_page_after_content'); ?>
							</div>
						</div>
						<div class="mkd-column2">
							<?php get_sidebar(); ?>
						</div>
					</div>
				<?php elseif($sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left'): ?>
					<div <?php echo discussion_sidebar_columns_class(); ?>>
						<div class="mkd-column1">
							<?php get_sidebar(); ?>
						</div>
						<div class="mkd-column2 mkd-content-right-from-sidebar">
							<div class="mkd-column-inner">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="page-feature-image">
										<?php the_post_thumbnail('full'); ?>
									</div>
								<?php endif; ?>

								<?php the_title( '<h2 class="page-title">', '</h2>' ); ?>
								<?php the_content(); ?>
								<?php //do_action('discussion_page_after_content'); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>

			<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<?php do_action('discussion_before_container_close'); ?>
	</div>
<?php get_footer(); ?>