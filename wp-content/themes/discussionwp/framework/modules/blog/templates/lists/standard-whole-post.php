<div class="mkd-blog-holder mkd-blog-type-standard">
	<?php
		if($blog_query->have_posts()) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
			discussion_get_post_format_html($blog_type);
		endwhile;
		else:
			discussion_get_module_template_part('templates/parts/no-posts', 'blog');
		endif;
	?>
</div>
<?php
	if(discussion_options()->getOptionValue('pagination') == 'yes') {
		discussion_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
	}
?>