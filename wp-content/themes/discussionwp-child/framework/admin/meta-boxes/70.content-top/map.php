<?php

$content_top_meta_box = discussion_add_meta_box(
    array(
        'scope' => array('page', 'post'),
        'title' => 'Content Top',
        'name' => 'content_top_meta'
    )
);

    discussion_add_meta_box_field(
        array(
            'name'        => 'mkd_show_content_top_meta',
            'type'        => 'select',
            'label'       => 'Show Content Top area',
            'description' => '',
            'parent'      => $content_top_meta_box,
            'options'     => array(
				''			=> 'Default',
				'no'		=> 'No',
				'yes'		=> 'Yes',
			)
        )
    );


    discussion_add_meta_box_field(
        array(
            'name'        => 'mkd_content_top_background_color_meta',
            'type'        => 'color',
            'label'       => 'Content Top Background Color',
            'description' => '',
            'parent'      => $content_top_meta_box
        )
    );
