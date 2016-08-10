<?php get_header(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php discussion_get_title(); ?>
<?php get_template_part('slider'); ?>
	<div class="mkd-container">
		<?php do_action('discussion_after_container_open'); ?>
		<div class="mkd-container-inner">
                    <div class="vc_empty_space" style="height: 30px"><span class="vc_empty_space_inner"></span></div>
		    <?php  discussion_get_blog_single(); ?>
		</div>
		<?php do_action('discussion_before_container_close'); ?>
	</div>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>