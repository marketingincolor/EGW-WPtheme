<?php

/***** Get current category page ID and meta boxes options from category admin panel *****/

$current_cat_id = discussion_get_current_object_id();
$cat_array = get_option( "post_tax_term_$current_cat_id");

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

/***** Get unique category template layout *****/

$template = 'type1';

if(isset($cat_array['template']) && $cat_array['template'] != 'default'){
	$template = $cat_array['template'];
}
elseif (discussion_options()->getOptionValue('category_unique_layout') !== ''){
	$template = discussion_options()->getOptionValue('category_unique_layout');
}

/***** Get unique category template pagination *****/

$pagination_type = 'np-horizontal';
if(isset($cat_array['pagination_type']) && $cat_array['pagination_type'] != ''){
    $pagination_type = $cat_array['pagination_type'];
}

/***** Get layout options *****/

$excerpt_length = 24;
if(isset($cat_array['excerpt_length']) && $cat_array['excerpt_length'] != ''){
	$excerpt_length = $cat_array['excerpt_length'];
}

$thumb_image_width = '';
if(isset($cat_array['thumb_image_width']) && $cat_array['thumb_image_width'] != ''){
	$thumb_image_width = $cat_array['thumb_image_width'];
}

$thumb_image_height = '';
if(isset($cat_array['thumb_image_height']) && $cat_array['thumb_image_height'] != ''){
	$thumb_image_height = $cat_array['thumb_image_height'];
}

/***** Get number of posts from current category *****/

$query_params = array();
$query_params['cat'] = $current_cat_id;
$category_query = new WP_Query($query_params);
$posts_in_category = $category_query->found_posts;
wp_reset_postdata();

/***** Get number of posts per page for current category *****/

$posts_per_page = 0;
if(isset($cat_array['number_of_posts']) && $cat_array['number_of_posts'] !== ''){
    $posts_per_page = intval($cat_array['number_of_posts']);
}

/***** Set params for posts on category page *****/

$params['archive_type'] = 'category';
$params['category_id'] = $current_cat_id;
$params['posts_in_category'] = $posts_in_category;
$params['template_type'] = $template;
$params['thumb_image_width'] = $thumb_image_width;
$params['thumb_image_height'] = $thumb_image_height;
$params['excerpt_length'] = $excerpt_length;
$params['posts_per_page'] = $posts_per_page;
$params['pagination_type'] = $pagination_type;

discussion_get_module_template_part('templates/lists/unique-layouts', 'blog','',$params);