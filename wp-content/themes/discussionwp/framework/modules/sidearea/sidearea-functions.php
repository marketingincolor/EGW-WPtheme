<?php
if (!function_exists('discussion_register_side_area_sidebar')) {
	/**
	 * Register side area sidebar
	 */
	function discussion_register_side_area_sidebar() {

		register_sidebar(array(
			'name' => 'Side Area',
			'id' => 'sidearea',
			'description' => 'Side Area',
			'before_widget' => '<div id="%1$s" class="widget mkd-sidearea %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="mkd-section-title-holder clearfix mkd-pattern-dark"><span class="mkd-st-title">',
			'after_title' => '</span></div>'
		));

	}

	add_action('widgets_init', 'discussion_register_side_area_sidebar');

}

if(!function_exists('discussion_side_menu_body_class')) {
    /**
     * Function that adds body classes for different side menu styles
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function discussion_side_menu_body_class($classes) {

		if (is_active_widget( false, false, 'mkd_side_area_opener' )) {

			if (discussion_options()->getOptionValue('side_area_type')) {

				$classes[] = 'mkd-' . discussion_options()->getOptionValue('side_area_type');

				if (discussion_options()->getOptionValue('side_area_type') === 'side-menu-slide-with-content') {

					$classes[] = 'mkd-' . discussion_options()->getOptionValue('side_area_slide_with_content_width');

				}

                if (discussion_options()->getOptionValue('side_area_type') === 'side-menu-slide-over-content') {

                    $classes[] = 'mkd-' . discussion_options()->getOptionValue('side_area_slide_over_content_width');

                }

        	}

		}

		return $classes;

    }

    add_filter('body_class', 'discussion_side_menu_body_class');
}


if(!function_exists('discussion_get_side_area')) {
	/**
	 * Loads side area HTML
	 */
	function discussion_get_side_area() {

		if (is_active_widget( false, false, 'mkd_side_area_opener' )) {

			$parameters = array(
				'show_side_area_title' => discussion_options()->getOptionValue('side_area_title') !== '' ? true : false, //Dont show title if empty
			);

			discussion_get_module_template_part('templates/sidearea', 'sidearea', '', $parameters);

		}

	}

}

if (!function_exists('discussion_get_side_area_title')) {
	/**
	 * Loads side area title HTML
	 */
	function discussion_get_side_area_title() {

		$parameters = array(
			'side_area_title' => discussion_options()->getOptionValue('side_area_title')
		);

		discussion_get_module_template_part('templates/parts/title', 'sidearea', '', $parameters);

	}

}

if(!function_exists('discussion_get_side_menu_icon_html')) {
    /**
     * Function that outputs html for side area icon opener.
     * Uses $discussion_IconCollections global variable
     * @return string generated html
     */
    function discussion_get_side_menu_icon_html() {

        $icon_html = '';

		if (discussion_options()->getOptionValue('side_area_button_icon_pack') !== '') {
			$icon_pack = discussion_options()->getOptionValue('side_area_button_icon_pack');

			$icons = discussion_icon_collections()->getIconCollection($icon_pack);
			$icon_options_field = 'side_area_icon_' . $icons->param;

			if (discussion_options()->getOptionValue($icon_options_field) !== '') {

				$icon = discussion_options()->getOptionValue($icon_options_field);
				$icon_html = discussion_icon_collections()->renderIcon($icon, $icon_pack);

			}

		}

        return $icon_html;
    }
}