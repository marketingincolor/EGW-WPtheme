<?php

if(!function_exists('discussion_header_class')) {
    /**
     * Function that adds class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added header class
     */
    function discussion_header_class($classes) {
        $header_type = 'header-type3';

        $classes[] = 'mkd-'.$header_type;

        return $classes;
    }

    add_filter('body_class', 'discussion_header_class');
}

if(!function_exists('discussion_header_behaviour_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function discussion_header_behaviour_class($classes) {

        $classes[] = 'mkd-'.discussion_options()->getOptionValue('header_behaviour');

        return $classes;
    }

    add_filter('body_class', 'discussion_header_behaviour_class');
}

if(!function_exists('discussion_mobile_header_class')) {
    function discussion_mobile_header_class($classes) {
        $classes[] = 'mkd-default-mobile-header';

        $classes[] = 'mkd-sticky-up-mobile-header';

        return $classes;
    }

    add_filter('body_class', 'discussion_mobile_header_class');
}

if(!function_exists('discussion_header_global_js_var')) {
    function discussion_header_global_js_var($global_variables) {

        $global_variables['mkdTopBarHeight'] = discussion_get_top_bar_height();
        $global_variables['mkdStickyHeaderHeight'] = discussion_get_sticky_header_height();
        $global_variables['mkdStickyHeaderTransparencyHeight'] = discussion_get_sticky_header_height_of_complete_transparency();
        $global_variables['mkdMobileHeaderHeight'] = discussion_get_mobile_header_height();

        return $global_variables;
    }

    add_filter('discussion_js_global_variables', 'discussion_header_global_js_var');
}

if(!function_exists('discussion_header_per_page_js_var')) {
    function discussion_header_per_page_js_var($perPageVars) {

        $perPageVars['mkdStickyScrollAmount'] = discussion_get_sticky_scroll_amount();

        return $perPageVars;
    }

    add_filter('discussion_per_page_js_vars', 'discussion_header_per_page_js_var');
}

if(!function_exists('discussion_aps_custom_style_class')) {
    function discussion_aps_custom_style_class($classes) {

        if(discussion_options()->getOptionValue('aps_custom_style') !== ''){
            $classes[] = 'mkd-'.discussion_options()->getOptionValue('aps_custom_style');
        }

        return $classes;
    }

    add_filter('body_class', 'discussion_aps_custom_style_class');
}