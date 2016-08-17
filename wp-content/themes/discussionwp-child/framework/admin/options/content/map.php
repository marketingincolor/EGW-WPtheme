<?php

if ( ! function_exists('discussion_content_options_map') ) {

    function discussion_content_options_map() {

        discussion_add_admin_page(
            array(
                'slug'  => '_content_page',
                'title' => 'Content',
                'icon'  => 'icon_document'
            )
        );

        $panel_content = discussion_add_admin_panel(
            array(
                'page'  => '_content_page',
                'name'  => 'panel_content',
                'title' => 'General'
            )
        );

        discussion_add_admin_field(array(
            'type'			=> 'text',
            'name'			=> 'content_top_padding',
            'description'   => 'Enter top padding for content area for templates in full width. If you set this value then it\'s important to set also Content top padding for mobile header value',
            'default_value'	=> '0',
            'label'			=> 'Content Top Padding for Template in Full Width',
            'args'			=> array(
                'suffix'	=> 'px',
                'col_width' => 3
            ),
            'parent'		=> $panel_content
        ));

        discussion_add_admin_field(array(
            'type'			=> 'text',
            'name'			=> 'content_top_padding_in_grid',
            'description'   => 'Enter top padding for content area for Templates in grid. If you set this value then it\'s important to set also Content top padding for mobile header value',
            'default_value'	=> '0',
            'label'			=> 'Content Top Padding for Templates in Grid',
            'args'			=> array(
                'suffix'	=> 'px',
                'col_width' => 3
            ),
            'parent'		=> $panel_content
        ));

        discussion_add_admin_field(array(
            'type'			=> 'text',
            'name'			=> 'content_top_padding_mobile',
            'description'   => 'Enter top padding for content area for Mobile Header',
            'default_value'	=> '0',
            'label'			=> 'Content Top Padding for Mobile Header',
            'args'			=> array(
                'suffix'	=> 'px',
                'col_width' => 3
            ),
            'parent'		=> $panel_content
        ));

    }

    add_action( 'discussion_options_map', 'discussion_content_options_map', 8);

}