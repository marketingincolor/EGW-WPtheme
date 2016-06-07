<?php

if ( ! function_exists('discussion_content_top_options_map') ) {
	/**
	 * Add Content Top options
	 */
	function discussion_content_top_options_map() {

		discussion_add_admin_page(
			array(
				'slug' => '_content_top_page',
				'title' => 'Content Top',
				'icon' => 'arrow_carrot-2up'
			)
		);

		$content_top_panel = discussion_add_admin_panel(
			array(
				'title' => 'Content Top',
				'name' => 'content_top',
				'page' => '_content_top_page'
			)
		);

		discussion_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_content_top',
				'default_value' => 'no',
				'label' => 'Show Content Top',
				'description' => 'Enabling this option will show Content Top area',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_show_content_top_container'
				),
				'parent' => $content_top_panel,
			)
		);

		$show_content_top_container = discussion_add_admin_container(
			array(
				'name' => 'show_content_top_container',
				'hidden_property' => 'show_content_top',
				'hidden_value' => 'no',
				'parent' => $content_top_panel
			)
		);

		discussion_add_admin_field(
			array(
				'type' => 'color',
				'name' => 'content_top_background_color',
				'label' => 'Background Color',
				'description' => 'Choose background color for Content Top',
				'parent' => $show_content_top_container,
			)
		);

	}

	add_action( 'discussion_options_map', 'discussion_content_top_options_map', 13);
}