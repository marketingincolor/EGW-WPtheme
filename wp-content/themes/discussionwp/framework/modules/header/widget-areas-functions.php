<?php

if(!function_exists('discussion_register_top_header_areas')) {
    /**
     * Registers widget areas for top header bar when it is enabled
     */
    function discussion_register_top_header_areas() {
        $top_bar_enabled = discussion_options()->getOptionValue('top_bar');

        if($top_bar_enabled == 'yes') {
            register_sidebar(array(
                'name'          => esc_html__('Top Bar Left', 'discussionwp'),
                'id'            => 'mkd-top-bar-left',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-top-bar-widget">',
                'after_widget'  => '</div>'
            ));

            register_sidebar(array(
                'name'          => esc_html__('Top Bar Right', 'discussionwp'),
                'id'            => 'mkd-top-bar-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-top-bar-widget">',
                'after_widget'  => '</div>'
            ));
        }
    }

    add_action('widgets_init', 'discussion_register_top_header_areas');
}

if(!function_exists('discussion_register_header_areas')) {
    /**
     * Registers widget areas for mobile header
     */
    function discussion_register_header_areas() {

        if(discussion_is_responsive_on()) {
            register_sidebar(array(
                'name'          => esc_html__('Left From Main Menu', 'discussionwp'),
                'id'            => 'mkd-left-from-main-menu',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-left-from-main-menu">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the left hand side, next to main menu', 'discussionwp')
            ));
        }

        if(discussion_is_responsive_on()) {
            register_sidebar(array(
                'name'          => esc_html__('Right From Main Menu', 'discussionwp'),
                'id'            => 'mkd-right-from-main-menu',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-main-menu">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the main menu', 'discussionwp')
            ));
        }

        if(discussion_is_responsive_on()) {
            register_sidebar(array(
                'name'          => esc_html__('Right From Logo', 'discussionwp'),
                'id'            => 'mkd-right-from-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-logo">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the logo, only if position of logo is "left"', 'discussionwp')
            ));
        }
    }

    add_action('widgets_init', 'discussion_register_header_areas');
}

if(!function_exists('discussion_register_sticky_header_areas')) {
    /**
     * Registers widget area for sticky header
     */
    function discussion_register_sticky_header_areas() {
        if(in_array(discussion_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {
            register_sidebar(array(
                'name'          => esc_html__('Sticky Right', 'discussionwp'),
                'id'            => 'mkd-sticky-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-sticky-right">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side in sticky menu', 'discussionwp')
            ));
        }
    }

    add_action('widgets_init', 'discussion_register_sticky_header_areas');
}

if(!function_exists('discussion_register_mobile_header_areas')) {
    /**
     * Registers widget areas for mobile header
     */
    function discussion_register_mobile_header_areas() {
        if(discussion_is_responsive_on()) {
            register_sidebar(array(
                'name'          => esc_html__('Right From Mobile Logo', 'discussionwp'),
                'id'            => 'mkd-right-from-mobile-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-mobile-logo">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the mobile logo', 'discussionwp')
            ));
        }
    }

    add_action('widgets_init', 'discussion_register_mobile_header_areas');
}