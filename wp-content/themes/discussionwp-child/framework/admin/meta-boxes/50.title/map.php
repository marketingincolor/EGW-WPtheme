<?php

$title_meta_box = discussion_add_meta_box(
    array(
        'scope' => array('page', 'post'),
        'title' => 'Title',
        'name' => 'title_meta'
    )
);

    discussion_add_meta_box_field(
        array(
            'name' => 'mkd_show_title_area_meta',
            'type' => 'select',
            'default_value' => '',
            'label' => 'Show Title Area',
            'description' => 'Disabling this option will turn off page title area',
            'parent' => $title_meta_box,
            'options' => array(
                '' => '',
                'no' => 'No',
                'yes' => 'Yes'
            ),
            'args' => array(
                "dependence" => true,
                "hide" => array(
                    "" => "",
                    "no" => "#mkd_mkd_show_title_area_meta_container",
                    "yes" => ""
                ),
                "show" => array(
                    "" => "#mkd_mkd_show_title_area_meta_container",
                    "no" => "",
                    "yes" => "#mkd_mkd_show_title_area_meta_container"
                )
            )
        )
    );

    $show_title_area_meta_container = discussion_add_admin_container(
        array(
            'parent' => $title_meta_box,
            'name' => 'mkd_show_title_area_meta_container',
            'hidden_property' => 'mkd_show_title_area_meta',
            'hidden_value' => 'no'
        )
    );

        discussion_add_meta_box_field(
            array(
                'name' => 'mkd_show_title_text_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Show Title Text',
                'description' => 'This option will enable/disable Title Text',
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => '',
                    'yes' => 'Yes',
                    'no' => 'No'
                )
            )
        );

        discussion_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_content_alignment_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Content Alignment',
                'description' => 'Specify title content alignment',
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => '',
                    'left' => 'Left',
                    'center' => 'Center',
                    'right' => 'Right'
                )
            )
        );

        discussion_add_meta_box_field(
            array(
                'name' => 'mkd_title_color_meta',
                'type' => 'color',
                'label' => 'Title Color',
                'description' => 'Choose a color for title text',
                'parent' => $show_title_area_meta_container
            )
        );

        discussion_add_meta_box_field(
            array(
                'name' => 'mkd_title_breadcrumb_color_meta',
                'type' => 'color',
                'label' => 'Title Breadcrumbs Color',
                'description' => 'Choose a color for breadcrumb text',
                'parent' => $show_title_area_meta_container
            )
        );

        discussion_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_background_color_meta',
                'type' => 'color',
                'label' => 'Background Color',
                'description' => 'Choose a background color for Title Area',
                'parent' => $show_title_area_meta_container
            )
        );

        discussion_add_meta_box_field(
            array(
                'name' => 'mkd_hide_background_image_meta',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => 'Hide Background Image',
                'description' => 'Enable this option to hide background image in Title Area',
                'parent' => $show_title_area_meta_container,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "#mkd_mkd_hide_background_image_meta_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $hide_background_image_meta_container = discussion_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'mkd_hide_background_image_meta_container',
                'hidden_property' => 'mkd_hide_background_image_meta',
                'hidden_value' => 'yes'
            )
        );

        discussion_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_background_image_meta',
                'type' => 'image',
                'label' => 'Background Image',
                'description' => 'Choose an Image for Title Area',
                'parent' => $hide_background_image_meta_container
            )
        );

        discussion_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_background_image_responsive_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => 'Background Responsive Image',
                'description' => 'Enabling this option will make Title background image responsive',
                'parent' => $hide_background_image_meta_container,
                'options' => array(
                    '' => '',
                    'no' => 'No',
                    'yes' => 'Yes'
                ),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "" => "",
                        "no" => "",
                        "yes" => "#mkd_mkd_title_area_height_meta"
                    ),
                    "show" => array(
                        "" => "#mkd_mkd_title_area_height_meta",
                        "no" => "#mkd_mkd_title_area_height_meta",
                        "yes" => ""
                    )
                )
            )
        );

        discussion_add_meta_box_field(array(
            'name' => 'mkd_title_area_height_meta',
            'type' => 'text',
            'label' => 'Height',
            'description' => 'Set a height for Title Area',
            'parent' => $show_title_area_meta_container,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        ));