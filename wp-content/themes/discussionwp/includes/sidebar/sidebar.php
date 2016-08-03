<?php

if(!function_exists('mkd_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function mkd_register_sidebars() {

        register_sidebar(array(
            'name' => 'Sidebar',
            'id' => 'sidebar',
            'description' => 'Default Sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="mkd-section-title-holder clearfix"><span class="mkd-st-title">',
            'after_title' => '</span></div>'
        ));

    }

    add_action('widgets_init', 'mkd_register_sidebars');
}

if(!function_exists('mkd_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates DiscussionSidebar object
     */
    function mkd_add_support_custom_sidebar() {
        add_theme_support('DiscussionSidebar');
        if (get_theme_support('DiscussionSidebar')) new DiscussionSidebar();
    }

    add_action('after_setup_theme', 'mkd_add_support_custom_sidebar');
}
