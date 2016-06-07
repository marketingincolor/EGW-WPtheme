<?php

if ( ! function_exists('discussion_search_options_map') ) {

	function discussion_search_options_map() {

		discussion_add_admin_page(
			array(
				'slug' => '_search_page',
				'title' => 'Search Page',
				'icon' => 'icon_search'
			)
		);

		$search_panel = discussion_add_admin_panel(
			array(
				'title' => 'Search Page',
				'name' => 'search',
				'page' => '_search_page'
			)
		);

		discussion_add_admin_field(array(
			'name'        => 'enable_search_page_sidebar',
			'type'        => 'select',
			'label'       => 'Enable Sidebar for Search Pages',
			'description' => 'Enabling this option you will display sidebar on your Search Pages',
			'default_value' => 'yes',
			'parent'      => $search_panel,
			'options'     => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		));

		$custom_sidebars = discussion_get_custom_sidebars();

		if(count($custom_sidebars) > 0) {
			discussion_add_admin_field(array(
				'name' => 'search_page_custom_sidebar',
				'type' => 'selectblank',
				'label' => 'Custom Sidebar to Display',
				'description' => 'Choose a custom sidebar to display on your Search Pages. Default sidebar is "Sidebar Page"',
				'parent' => $search_panel,
				'options' => discussion_get_custom_sidebars()
			));
		}

	}

	add_action('discussion_options_map', 'discussion_search_options_map', 5);
}