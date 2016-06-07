<?php

if (!function_exists('discussion_register_footer_sidebar')) {

	function discussion_register_footer_sidebar() {

		register_sidebar(array(
			'name' => 'Footer Column 1',
			'id' => 'footer_column_1',
			'description' => 'Footer Column 1',
			'before_widget' => '<div id="%1$s" class="widget mkd-footer-column-1 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="mkd-footer-widget-title">',
			'after_title' => '</h5>'
		));

		register_sidebar(array(
			'name' => 'Footer Column 2',
			'id' => 'footer_column_2',
			'description' => 'Footer Column 2',
			'before_widget' => '<div id="%1$s" class="widget mkd-footer-column-2 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="mkd-footer-widget-title">',
			'after_title' => '</h5>'
		));

		register_sidebar(array(
			'name' => 'Footer Column 3',
			'id' => 'footer_column_3',
			'description' => 'Footer Column 3',
			'before_widget' => '<div id="%1$s" class="widget mkd-footer-column-3 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="mkd-footer-widget-title">',
			'after_title' => '</h5>'
		));

		register_sidebar(array(
			'name' => 'Footer Column 4',
			'id' => 'footer_column_4',
			'description' => 'Footer Column 4',
			'before_widget' => '<div id="%1$s" class="widget mkd-footer-column-4 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="mkd-footer-widget-title">',
			'after_title' => '</h5>'
		));

		register_sidebar(array(
			'name' => 'Footer Text',
			'id' => 'footer_text',
			'description' => 'Footer Text',
			'before_widget' => '<div id="%1$s" class="widget mkd-footer-text %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="mkd-footer-widget-title">',
			'after_title' => '</h5>'
		));

		register_sidebar(array(
			'name' => 'Footer Bottom Left',
			'id' => 'footer_bottom_left',
			'description' => 'Footer Bottom Left',
			'before_widget' => '<div id="%1$s" class="widget mkd-footer-bottom-left %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="mkd-footer-widget-title">',
			'after_title' => '</h5>'
		));

		register_sidebar(array(
			'name' => 'Footer Bottom Right',
			'id' => 'footer_bottom_right',
			'description' => 'Footer Bottom Right',
			'before_widget' => '<div id="%1$s" class="widget mkd-footer-bottom-left %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="mkd-footer-widget-title">',
			'after_title' => '</h5>'
		));

	}

	add_action('widgets_init', 'discussion_register_footer_sidebar');

}

if (!function_exists('discussion_get_footer')) {
	/**
	 * Loads footer HTML
	 */
	function discussion_get_footer() {

		$parameters = array();
		$id = discussion_get_page_id();
		$parameters['display_footer_top'] = (discussion_options()->getOptionValue('show_footer_top') == 'yes') ? true : false;
		$parameters['display_footer_bottom'] = (discussion_options()->getOptionValue('show_footer_bottom') == 'yes') ? true : false;

		discussion_get_module_template_part('templates/footer', 'footer', '', $parameters);
	}
}

if (!function_exists('discussion_get_footer_top')) {
	/**
	 * Return footer top HTML
	 */
	function discussion_get_footer_top() {

		$parameters = array();

		$parameters['footer_in_grid'] = (discussion_options()->getOptionValue('footer_in_grid') == 'yes') ? true : false;
		$parameters['footer_top_classes'] = (discussion_options()->getOptionValue('footer_in_grid') == 'yes') ? '' : 'mkd-footer-top-full';
		$parameters['footer_top_columns'] = discussion_options()->getOptionValue('footer_top_columns');

		discussion_get_module_template_part('templates/parts/footer-top', 'footer', '', $parameters);
	}
}

if (!function_exists('discussion_get_footer_bottom')) {
	/**
	 * Return footer bottom HTML
	 */
	function discussion_get_footer_bottom() {

		$parameters = array();

		$parameters['footer_in_grid'] = (discussion_options()->getOptionValue('footer_in_grid') == 'yes') ? true : false;
        $parameters['footer_bottom_classes'] = (discussion_options()->getOptionValue('footer_in_grid') == 'yes') ? '' : 'mkd-footer-top-full';
		$parameters['footer_bottom_columns'] = discussion_options()->getOptionValue('footer_bottom_columns');

		discussion_get_module_template_part('templates/parts/footer-bottom', 'footer', '', $parameters);
	}
}

//Functions for loading sidebars

if (!function_exists('discussion_get_footer_sidebar_25_25_50')) {

	function discussion_get_footer_sidebar_25_25_50() {
		discussion_get_module_template_part('templates/sidebars/sidebar-three-columns-25-25-50', 'footer');
	}
}

if (!function_exists('discussion_get_footer_sidebar_50_25_25')) {

	function discussion_get_footer_sidebar_50_25_25() {
		discussion_get_module_template_part('templates/sidebars/sidebar-three-columns-50-25-25', 'footer');
	}
}

if (!function_exists('discussion_get_footer_sidebar_four_columns')) {

	function discussion_get_footer_sidebar_four_columns() {
		discussion_get_module_template_part('templates/sidebars/sidebar-four-columns', 'footer');
	}
}

if (!function_exists('discussion_get_footer_sidebar_three_columns')) {

	function discussion_get_footer_sidebar_three_columns() {
		discussion_get_module_template_part('templates/sidebars/sidebar-three-columns', 'footer');
	}
}

if (!function_exists('discussion_get_footer_sidebar_two_columns')) {

	function discussion_get_footer_sidebar_two_columns() {
		discussion_get_module_template_part('templates/sidebars/sidebar-two-columns', 'footer');
	}
}

if (!function_exists('discussion_get_footer_sidebar_one_column')) {

	function discussion_get_footer_sidebar_one_column() {
		discussion_get_module_template_part('templates/sidebars/sidebar-one-column', 'footer');
	}
}

if (!function_exists('discussion_get_footer_bottom_sidebar_three_columns')) {

	function discussion_get_footer_bottom_sidebar_three_columns() {
		discussion_get_module_template_part('templates/sidebars/sidebar-bottom-three-columns', 'footer');
	}
}

if (!function_exists('discussion_get_footer_bottom_sidebar_two_columns')) {

	function discussion_get_footer_bottom_sidebar_two_columns() {
		discussion_get_module_template_part('templates/sidebars/sidebar-bottom-two-columns', 'footer');
	}
}

if (!function_exists('discussion_get_footer_bottom_sidebar_one_column')) {

	function discussion_get_footer_bottom_sidebar_one_column() {
		discussion_get_module_template_part('templates/sidebars/sidebar-bottom-one-column', 'footer');
	}
}