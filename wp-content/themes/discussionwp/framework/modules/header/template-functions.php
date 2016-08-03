<?php

use Discussion\Modules\Header\Lib\HeaderFactory;

if(!function_exists('discussion_get_header')) {
    /**
     * Loads header HTML based on header type option. Sets all necessary parameters for header
     * and defines discussion_header_type_parameters filter
     */
    function discussion_get_header() {
        $id = discussion_get_page_id();

        //will be read from options
        $header_type     = 'header-type3';
        $header_behavior = discussion_options()->getOptionValue('header_behaviour');

        if(HeaderFactory::getInstance()->validHeaderObject()) {
            $parameters = array(
                'hide_logo'          => discussion_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
                'show_sticky'        => in_array($header_behavior, array(
                    'sticky-header-on-scroll-up',
                    'sticky-header-on-scroll-down-up'
                )) ? true : false,
            );

            $parameters = apply_filters('discussion_header_type_parameters', $parameters, $header_type);

            HeaderFactory::getInstance()->getHeaderObject()->loadTemplate($parameters);
        }
    }
}

if(!function_exists('discussion_get_header_top')) {
    /**
     * Loads header top HTML and sets parameters for it
     */
    function discussion_get_header_top() {

        $params = array(
            'column_widths'      => '50-50',
            'show_header_top'    => discussion_options()->getOptionValue('top_bar') == 'yes' ? true : false,
            'top_bar_in_grid'    => discussion_options()->getOptionValue('top_bar_in_grid') == 'yes' ? true : false
        );

        $params = apply_filters('discussion_header_top_params', $params);

        discussion_get_module_template_part('templates/parts/header-top', 'header', '', $params);
    }
}

if(!function_exists('discussion_get_logo')) {
    /**
     * Loads logo HTML
     *
     * @param $slug
     */
    function discussion_get_logo($slug = '') {

        $slug = $slug !== '' ? $slug : 'header-type3';

        if($slug == 'sticky'){
            $logo_image = discussion_options()->getOptionValue('logo_image_sticky');
        }else{
            $logo_image = discussion_options()->getOptionValue('logo_image');
        }

        $logo_image_dark = discussion_options()->getOptionValue('logo_image_dark');
        $logo_image_light = discussion_options()->getOptionValue('logo_image_light');

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = discussion_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px;'; //divided with 2 because of retina screens
        }

        $params = array(
            'logo_image'  => $logo_image,
            'logo_image_dark' => $logo_image_dark,
            'logo_image_light' => $logo_image_light,
            'logo_styles' => $logo_styles
        );

        discussion_get_module_template_part('templates/parts/logo', 'header', $slug, $params);
    }
}

if(!function_exists('discussion_get_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function discussion_get_main_menu($additional_class = 'mkd-default-nav') {
        discussion_get_module_template_part('templates/parts/navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('discussion_get_sticky_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function discussion_get_sticky_main_menu($additional_class = 'mkd-default-nav') {
        discussion_get_module_template_part('templates/parts/sticky-navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('discussion_get_sticky_header')) {
    /**
     * Loads sticky header behavior HTML
     * * @param $slug
     */
    function discussion_get_sticky_header($slug = '') {

        $parameters = array(
            'hide_logo' => discussion_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
        );

        discussion_get_module_template_part('templates/behaviors/sticky-header', 'header', $slug, $parameters);
    }
}

if(!function_exists('discussion_get_mobile_header')) {
    /**
     * Loads mobile header HTML only if responsiveness is enabled
     */
    function discussion_get_mobile_header() {
        if(discussion_is_responsive_on()) {
            $header_type = 'header-type3';

            //this could be read from theme options
            $mobile_header_type = 'mobile-header';

            $parameters = array(
                'show_logo'              => discussion_options()->getOptionValue('hide_logo') == 'yes' ? false : true,
                'show_navigation_opener' => has_nav_menu('mobile-navigation')
            );

            discussion_get_module_template_part('templates/types/'.$mobile_header_type, 'header', $header_type, $parameters);
        }
    }
}

if(!function_exists('discussion_get_mobile_logo')) {
    /**
     * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
     *
     * @param string $slug
     */
    function discussion_get_mobile_logo($slug = '') {

        $slug = $slug !== '' ? $slug : 'header-type3';

        //check if mobile logo has been set and use that, else use normal logo
        if(discussion_options()->getOptionValue('logo_image_mobile') !== '') {
            $logo_image = discussion_options()->getOptionValue('logo_image_mobile');
        } else {
            $logo_image = discussion_options()->getOptionValue('logo_image');
        }

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = discussion_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px'; //divided with 2 because of retina screens
        }

        //set parameters for logo
        $parameters = array(
            'logo_image'      => $logo_image,
            'logo_dimensions' => $logo_dimensions,
            'logo_height'     => $logo_height,
            'logo_styles'     => $logo_styles
        );

        discussion_get_module_template_part('templates/parts/mobile-logo', 'header', $slug, $parameters);
    }
}

if(!function_exists('discussion_get_mobile_nav')) {
    /**
     * Loads mobile navigation HTML
     */
    function discussion_get_mobile_nav() {

        $slug = 'header-type3';

        discussion_get_module_template_part('templates/parts/mobile-navigation', 'header', $slug);
    }
}