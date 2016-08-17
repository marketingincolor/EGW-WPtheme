<?php

if ( ! function_exists('discussion_header_options_map') ) {

	function discussion_header_options_map() {

		discussion_add_admin_page(
			array(
				'slug' => '_header_page',
				'title' => 'Header',
				'icon' => 'icon_folder-open_alt'
			)
		);

			/****** HEADER PANEL ******/

			$panel_header = discussion_add_admin_panel(
				array(
					'page' => '_header_page',
					'name' => 'panel_header',
					'title' => 'Header'
				)
			);

				discussion_add_admin_field(
					array(
						'parent' => $panel_header,
						'type' => 'select',
						'name' => 'header_behaviour',
						'default_value' => 'sticky-header-on-scroll-down-up',
						'label' => 'Choose Header behaviour',
						'description' => 'Select the behaviour of header when you scroll down to page',
						'options' => array(
                            'sticky-header-on-scroll-up' => 'Sticky on scrol up',
                            'sticky-header-on-scroll-down-up' => 'Sticky on scrol up/down'
						)
					)
				);

				discussion_add_admin_field(
					array(
						'name' => 'top_bar',
						'type' => 'yesno',
						'default_value' => 'yes',
						'label' => 'Top Bar',
						'description' => 'Enabling this option will show top bar area',
						'parent' => $panel_header,
						'args' => array(
							"dependence" => true,
							"dependence_hide_on_yes" => "",
							"dependence_show_on_yes" => "#mkd_top_bar_container"
						)
					)
				);

					$top_bar_container = discussion_add_admin_container(array(
						'name' => 'top_bar_container',
						'parent' => $panel_header,
						'hidden_property' => 'top_bar',
						'hidden_value' => 'no'
					));

						discussion_add_admin_field(
							array(
								'name' => 'top_bar_in_grid',
								'type' => 'yesno',
								'default_value' => 'yes',
								'label' => 'Top Bar in grid',
								'description' => 'Set top bar content to be in grid',
								'parent' => $top_bar_container,
								'args' => array()
							)
						);

						discussion_add_admin_field(array(
							'name' => 'top_bar_background_color',
							'type' => 'color',
							'label' => 'Background Color',
							'description' => 'Set background color for top bar',
							'parent' => $top_bar_container
						));

                        discussion_add_admin_field(
                            array(
                                'name' => 'hide_top_bar_on_mobile',
                                'type' => 'yesno',
                                'default_value' => 'yes',
                                'label' => 'Hide Top Bar on Mobile Devices',
                                'description' => 'Enabling this option you will hide top header area on mobile devices',
                                'parent' => $top_bar_container
                            )
                        );


				discussion_add_admin_field(
					array(
						'parent' => $panel_header,
						'type' => 'text',
						'name' => 'logo_area_height_header_type3',
						'default_value' => '',
						'label' => 'Logo Area Height',
						'description' => 'Enter logo area height (default is 220px)',
						'args' => array(
							'col_width' => 3,
							'suffix' => 'px'
						)
					)
				);

				discussion_add_admin_field(
					array(
						'parent' => $panel_header,
						'type' => 'text',
						'name' => 'menu_area_height_header_type3',
						'default_value' => '',
						'label' => 'Menu Area Height',
						'description' => 'Enter menu area height (default is 50px)',
						'args' => array(
							'col_width' => 3,
							'suffix' => 'px'
						)
					)
				);

                discussion_add_admin_field(array(
                    'name' => 'logo_area_background_color',
                    'type' => 'color',
                    'label' => 'Logo Area Background Color',
                    'description' => 'Set background color for logo area',
                    'parent' => $panel_header
                ));

                discussion_add_admin_field(array(
                    'name' => 'menu_area_background_color',
                    'type' => 'color',
                    'label' => 'Menu Area Background Color',
                    'description' => 'Set background color for menu area',
                    'parent' => $panel_header
                ));

                discussion_add_admin_field(array(
                    'name' => 'menu_area_separator_color',
                    'type' => 'color',
                    'label' => 'Menu Area Separator Color',
                    'description' => 'Set separator color in menu area',
                    'parent' => $panel_header
                ));

			/****** STICKY HEADER PANEL ******/

            $panel_sticky_header = discussion_add_admin_panel(
                array(
                    'title' => 'Sticky Header',
                    'name' => 'panel_sticky_header',
                    'page' => '_header_page'
                )
            );

                discussion_add_admin_field(
                    array(
                        'name' => 'scroll_amount_for_sticky',
                        'type' => 'text',
                        'label' => 'Scroll Amount for Sticky',
                        'description' => 'Enter scroll amount for Sticky Menu to appear (deafult is header height)',
                        'parent' => $panel_sticky_header,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => 'px'
                        )
                    )
                );

                discussion_add_admin_field(array(
                    'name' => 'sticky_header_background_color',
                    'type' => 'color',
                    'label' => 'Background Color',
                    'description' => 'Set background color for sticky header',
                    'parent' => $panel_sticky_header
                ));

                discussion_add_admin_field(array(
                    'name' => 'sticky_header_transparency',
                    'type' => 'text',
                    'label' => 'Sticky Header Transparency',
                    'description' => 'Enter transparency for sticky header (value from 0 to 1)',
                    'parent' => $panel_sticky_header,
                    'args' => array(
                        'col_width' => 1
                    )
                ));

                discussion_add_admin_field(array(
                    'name' => 'sticky_header_height',
                    'type' => 'text',
                    'label' => 'Sticky Header Height',
                    'description' => 'Enter height for sticky header (default is 60px)',
                    'parent' => $panel_sticky_header,
                    'args' => array(
                        'col_width' => 2,
                        'suffix' => 'px'
                    )
                ));

                $group_sticky_header_menu = discussion_add_admin_group(array(
                    'title' => 'Sticky Header Menu',
                    'name' => 'group_sticky_header_menu',
                    'parent' => $panel_sticky_header,
                    'description' => 'Define styles for sticky menu items',
                ));

                    $row1_sticky_header_menu = discussion_add_admin_row(array(
                        'name' => 'row1',
                        'parent' => $group_sticky_header_menu
                    ));

                        discussion_add_admin_field(array(
                            'name' => 'sticky_color',
                            'type' => 'colorsimple',
                            'label' => 'Text Color',
                            'description' => '',
                            'parent' => $row1_sticky_header_menu
                        ));

                        discussion_add_admin_field(array(
                            'name' => 'sticky_hovercolor',
                            'type' => 'colorsimple',
                            'label' => 'Hover/Active color',
                            'description' => '',
                            'parent' => $row1_sticky_header_menu
                        ));

                    $row2_sticky_header_menu = discussion_add_admin_row(array(
                        'name' => 'row2',
                        'parent' => $group_sticky_header_menu
                    ));

                        discussion_add_admin_field(
                            array(
                                'name' => 'sticky_google_fonts',
                                'type' => 'fontsimple',
                                'label' => 'Font Family',
                                'default_value' => '-1',
                                'parent' => $row2_sticky_header_menu,
                            )
                        );

                        discussion_add_admin_field(
                            array(
                                'type' => 'textsimple',
                                'name' => 'sticky_fontsize',
                                'label' => 'Font Size',
                                'default_value' => '',
                                'parent' => $row2_sticky_header_menu,
                                'args' => array(
                                    'suffix' => 'px'
                                )
                            )
                        );

                        discussion_add_admin_field(
                            array(
                                'type' => 'textsimple',
                                'name' => 'sticky_lineheight',
                                'label' => 'Line height',
                                'default_value' => '',
                                'parent' => $row2_sticky_header_menu,
                                'args' => array(
                                    'suffix' => 'px'
                                )
                            )
                        );

                        discussion_add_admin_field(
                            array(
                                'type' => 'selectblanksimple',
                                'name' => 'sticky_texttransform',
                                'label' => 'Text transform',
                                'default_value' => '',
                                'options' => discussion_get_text_transform_array(),
                                'parent' => $row2_sticky_header_menu
                            )
                        );

                    $row3_sticky_header_menu = discussion_add_admin_row(array(
                        'name' => 'row3',
                        'parent' => $group_sticky_header_menu
                    ));

                        discussion_add_admin_field(
                            array(
                                'type' => 'selectblanksimple',
                                'name' => 'sticky_fontstyle',
                                'default_value' => '',
                                'label' => 'Font Style',
                                'options' => discussion_get_font_style_array(),
                                'parent' => $row3_sticky_header_menu
                            )
                        );

                        discussion_add_admin_field(
                            array(
                                'type' => 'selectblanksimple',
                                'name' => 'sticky_fontweight',
                                'default_value' => '',
                                'label' => 'Font Weight',
                                'options' => discussion_get_font_weight_array(),
                                'parent' => $row3_sticky_header_menu
                            )
                        );

                        discussion_add_admin_field(
                            array(
                                'type' => 'textsimple',
                                'name' => 'sticky_letterspacing',
                                'label' => 'Letter Spacing',
                                'default_value' => '',
                                'parent' => $row3_sticky_header_menu,
                                'args' => array(
                                    'suffix' => 'px'
                                )
                            )
                        );

			/****** MAIN MENU PANEL ******/

				$panel_main_menu = discussion_add_admin_panel(
					array(
						'title' => 'Main Menu',
						'name' => 'panel_main_menu',
						'page' => '_header_page'
					)
				);

					discussion_add_admin_section_title(
						array(
							'parent' => $panel_main_menu,
							'name' => 'main_menu_area_title',
							'title' => 'Main Menu General Settings'
						)
					);

					$first_level_group = discussion_add_admin_group(
						array(
							'parent' => $panel_main_menu,
							'name' => 'first_level_group',
							'title' => '1st Level Menu',
							'description' => 'Define styles for 1st level in Top Navigation Menu'
						)
					);

						$first_level_row1 = discussion_add_admin_row(
							array(
								'parent' => $first_level_group,
								'name' => 'first_level_row1'
							)
						);

							discussion_add_admin_field(
								array(
									'parent' => $first_level_row1,
									'type' => 'colorsimple',
									'name' => 'menu_color',
									'default_value' => '',
									'label' => 'Text Color',
								)
							);

							discussion_add_admin_field(
								array(
									'parent' => $first_level_row1,
									'type' => 'colorsimple',
									'name' => 'menu_hovercolor',
									'default_value' => '',
									'label' => 'Hover Text Color',
								)
							);

							discussion_add_admin_field(
								array(
									'parent' => $first_level_row1,
									'type' => 'colorsimple',
									'name' => 'menu_activecolor',
									'default_value' => '',
									'label' => 'Active Text Color',
								)
							);

						$first_level_row5 = discussion_add_admin_row(
							array(
								'parent' => $first_level_group,
								'name' => 'first_level_row5',
								'next' => true
							)
						);

							discussion_add_admin_field(
								array(
									'parent' => $first_level_row5,
									'type' => 'fontsimple',
									'name' => 'menu_google_fonts',
									'default_value' => '-1',
									'label' => 'Font Family',
								)
							);

							discussion_add_admin_field(
								array(
									'parent' => $first_level_row5,
									'type' => 'textsimple',
									'name' => 'menu_fontsize',
									'default_value' => '',
									'label' => 'Font Size',
									'args' => array(
										'suffix' => 'px'
									)
								)
							);

							discussion_add_admin_field(
								array(
									'parent' => $first_level_row5,
									'type' => 'textsimple',
									'name' => 'menu_lineheight',
									'default_value' => '',
									'label' => 'Line Height',
									'args' => array(
										'suffix' => 'px'
									)
								)
							);

							discussion_add_admin_field(
								array(
									'parent' => $first_level_row5,
									'type' => 'selectblanksimple',
									'name' => 'menu_fontweight',
									'default_value' => '',
									'label' => 'Font Weight',
									'options' => discussion_get_font_weight_array()
								)
							);

						$first_level_row6 = discussion_add_admin_row(
							array(
								'parent' => $first_level_group,
								'name' => 'first_level_row6',
								'next' => true
							)
						);

							discussion_add_admin_field(
								array(
									'parent' => $first_level_row6,
									'type' => 'selectblanksimple',
									'name' => 'menu_fontstyle',
									'default_value' => '',
									'label' => 'Font Style',
									'options' => discussion_get_font_style_array()
								)
							);

							discussion_add_admin_field(
								array(
									'parent' => $first_level_row6,
									'type' => 'textsimple',
									'name' => 'menu_letterspacing',
									'default_value' => '',
									'label' => 'Letter Spacing',
									'args' => array(
										'suffix' => 'px'
									)
								)
							);

							discussion_add_admin_field(
								array(
									'parent' => $first_level_row6,
									'type' => 'selectblanksimple',
									'name' => 'menu_texttransform',
									'default_value' => '',
									'label' => 'Text Transform',
									'options' => discussion_get_text_transform_array()
								)
							);

                    discussion_add_admin_field(
                        array(
                            'parent' => $panel_main_menu,
                            'type' => 'color',
                            'name' => 'dropdown_background_color',
                            'default_value' => '',
                            'label' => 'Dropdown Background Color',
                        )
                    );

                    discussion_add_admin_field(
                        array(
                            'parent' => $panel_main_menu,
                            'type' => 'color',
                            'name' => 'dropdown_border_color',
                            'default_value' => '',
                            'label' => 'Dropdown Border/Separator Color',
                        )
                    );

                    do_action('discussion_after_header_options_map');
	}

	add_action( 'discussion_options_map', 'discussion_header_options_map', 3);
}