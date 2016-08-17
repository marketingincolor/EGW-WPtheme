<?php

    $standard_post_format_meta_box = discussion_add_meta_box(
        array(
            'scope' => array('post'),
            'title' => 'Standard Post Format',
            'name'  => 'post_format_standard_meta'
        )
    );

    discussion_add_meta_box_field(
        array(
            'name'        => 'mkd_show_featured_post',
            'type'        => 'select',
            'default_value' => 'no',
            'label'       => 'Set as featured post',
            'description' => 'Enable this option will show this post as featured',
            'parent'      => $standard_post_format_meta_box,
            'options'     => array(
                'no' => 'No',
                'yes' => 'Yes'
            )
        )
    );