<?php
$blog_archive_pages_classes = discussion_blog_archive_pages_classes(discussion_get_default_blog_list());
?>
<?php get_header(); ?>
<?php discussion_get_title(); ?>
<div class="<?php echo esc_attr($blog_archive_pages_classes['holder']); ?>">
	<?php do_action('discussion_after_container_open'); ?>
	<div class="<?php echo esc_attr($blog_archive_pages_classes['inner']); ?>">
		<?php discussion_get_blog(discussion_get_default_blog_list()); ?>
	</div>
	<?php do_action('discussion_before_container_close'); ?>
</div>
<?php get_footer(); ?>
