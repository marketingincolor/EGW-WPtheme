<?php

if (!function_exists('discussion_register_content_top_sidebar')) {

	function discussion_register_content_top_sidebar() {

		register_sidebar(array(
			'name' => 'Content Top',
			'id' => 'content_top',
			'description' => 'Content Top',
			'before_widget' => '<div id="%1$s" class="widget mkd-content-top %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="mkd-content-top-title">',
			'after_title' => '</h6>'
		));

	}

	add_action('widgets_init', 'discussion_register_content_top_sidebar');

}


//Functions for loading sidebars

if (!function_exists('discussion_get_content_top')) {

	function discussion_get_content_top() {

		$parameters = array();

		//Current page id
		$id = discussion_get_page_id();

		//is content bottom area enabled for current page?
		$parameters['show_content_top'] = discussion_get_meta_field_intersect('show_content_top');
		if ($parameters['show_content_top'] == 'yes') {
			//Content bottom area background color

			$parameters['content_top_background_color'] = '';
			
			$background_color = discussion_get_meta_field_intersect('content_top_background_color');
			if ($background_color !== ''){
				$parameters['content_top_background_color'] = 'background-color: '.$background_color;
			}
		}

		discussion_get_module_template_part('templates/content-top', 'contenttop','',$parameters);
	}
}