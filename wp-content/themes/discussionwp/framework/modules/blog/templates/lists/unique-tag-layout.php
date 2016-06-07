<?php

/***** Get current tag page ID*****/

$tag = get_queried_object();
$current_tag_slug = $tag->slug;

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

/***** Get unique category template layout *****/

$template = 'type1';

if (discussion_options()->getOptionValue('tag_unique_layout') !== ''){
	$template = discussion_options()->getOptionValue('tag_unique_layout');
}

/***** Set params for posts on tag page *****/

$params['archive_type'] = 'tag';
$params['tag_slug'] = $current_tag_slug;
$params['template_type'] = $template;
$params['thumb_image_width'] = '';
$params['thumb_image_height'] = '';
$params['excerpt_length'] = '';
$params['posts_per_page'] = 0;
$params['pagination_type'] = 'np-horizontal';

discussion_get_module_template_part('templates/lists/unique-layouts', 'blog','',$params);