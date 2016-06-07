<?php

if(!function_exists('discussion_content_responsive_styles')) {
    /**
     * Generates content responsive custom styles
     */
    function discussion_content_responsive_styles() {
        $content_style = array();
        if (discussion_options()->getOptionValue('content_top_padding_mobile') !== '') {
            $padding_top_mobile = (discussion_options()->getOptionValue('content_top_padding_mobile'));
            $content_style['padding-top'] = discussion_filter_px($padding_top_mobile) . 'px!important';

        }
        $content_selector = array(
            '.mkd-content .mkd-content-inner > .mkd-container > .mkd-container-inner',
            '.mkd-content .mkd-content-inner > .mkd-full-width > .mkd-full-width-inner',
        );
        echo discussion_dynamic_css($content_selector, $content_style);
    }

    add_action('discussion_style_dynamic_responsive_1024', 'discussion_content_responsive_styles');
}

if (!function_exists('discussion_h1_h2_h3_first_responsive_styles')) {

    function discussion_h1_h2_h3_first_responsive_styles() {

        if(discussion_options()->getOptionValue('h1_fontsize') !== '') {
            echo discussion_dynamic_css('h1',array('font-size' => discussion_filter_px(discussion_options()->getOptionValue('h1_fontsize')).'px'));
        }

        if(discussion_options()->getOptionValue('h2_fontsize') !== '') {
            echo discussion_dynamic_css('h2',array('font-size' => discussion_filter_px(discussion_options()->getOptionValue('h2_fontsize')).'px'));
        }

        if(discussion_options()->getOptionValue('h3_fontsize') !== '') {
            echo discussion_dynamic_css('h3',array('font-size' => discussion_filter_px(discussion_options()->getOptionValue('h3_fontsize')).'px'));
        }
    }

    add_action('discussion_style_dynamic_responsive_1024', 'discussion_h1_h2_h3_first_responsive_styles');
}

if (!function_exists('discussion_h1_responsive_styles')) {

    function discussion_h1_responsive_styles() {

        $h1_styles = array();

        if(discussion_options()->getOptionValue('h1_responsive_fontsize') !== '') {
            $h1_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h1_responsive_fontsize')).'px';
        }
        if(discussion_options()->getOptionValue('h1_responsive_lineheight') !== '') {
            $h1_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h1_responsive_lineheight')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo discussion_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('discussion_style_dynamic_responsive_480_768', 'discussion_h1_responsive_styles');
}

if (!function_exists('discussion_h2_responsive_styles')) {

    function discussion_h2_responsive_styles() {

        $h2_styles = array();

        if(discussion_options()->getOptionValue('h2_responsive_fontsize') !== '') {
            $h2_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h2_responsive_fontsize')).'px';
        }
        if(discussion_options()->getOptionValue('h2_responsive_lineheight') !== '') {
            $h2_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h2_responsive_lineheight')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo discussion_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('discussion_style_dynamic_responsive_480_768', 'discussion_h2_responsive_styles');
}

if (!function_exists('discussion_h3_responsive_styles')) {

    function discussion_h3_responsive_styles() {

        $h3_styles = array();

        if(discussion_options()->getOptionValue('h3_responsive_fontsize') !== '') {
            $h3_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h3_responsive_fontsize')).'px';
        }
        if(discussion_options()->getOptionValue('h3_responsive_lineheight') !== '') {
            $h3_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h3_responsive_lineheight')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo discussion_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('discussion_style_dynamic_responsive_480_768', 'discussion_h3_responsive_styles');
}

if (!function_exists('discussion_h4_responsive_styles')) {

    function discussion_h4_responsive_styles() {

        $h4_styles = array();

        if(discussion_options()->getOptionValue('h4_responsive_fontsize') !== '') {
            $h4_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h4_responsive_fontsize')).'px';
        }
        if(discussion_options()->getOptionValue('h4_responsive_lineheight') !== '') {
            $h4_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h4_responsive_lineheight')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if (!empty($h4_styles)) {
            echo discussion_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('discussion_style_dynamic_responsive_480_768', 'discussion_h4_responsive_styles');
}

if (!function_exists('discussion_h5_responsive_styles')) {

    function discussion_h5_responsive_styles() {

        $h5_styles = array();

        if(discussion_options()->getOptionValue('h5_responsive_fontsize') !== '') {
            $h5_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h5_responsive_fontsize')).'px';
        }
        if(discussion_options()->getOptionValue('h5_responsive_lineheight') !== '') {
            $h5_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h5_responsive_lineheight')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo discussion_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('discussion_style_dynamic_responsive_480_768', 'discussion_h5_responsive_styles');
}

if (!function_exists('discussion_h6_responsive_styles')) {

    function discussion_h6_responsive_styles() {

        $h6_styles = array();

        if(discussion_options()->getOptionValue('h6_responsive_fontsize') !== '') {
            $h6_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h6_responsive_fontsize')).'px';
        }
        if(discussion_options()->getOptionValue('h6_responsive_lineheight') !== '') {
            $h6_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h6_responsive_lineheight')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo discussion_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('discussion_style_dynamic_responsive_480_768', 'discussion_h6_responsive_styles');
}

if (!function_exists('discussion_text_responsive_styles')) {

    function discussion_text_responsive_styles() {

        $text_styles = array();

        if(discussion_options()->getOptionValue('text_fontsize_res1') !== '') {
            $text_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('text_fontsize_res1')).'px';
        }
        if(discussion_options()->getOptionValue('text_lineheight_res1') !== '') {
            $text_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('text_lineheight_res1')).'px';
        }

        $text_selector = array(
            'body',
            'p'
        );

        if (!empty($text_styles)) {
            echo discussion_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('discussion_style_dynamic_responsive_480_768', 'discussion_text_responsive_styles');
}

if (!function_exists('discussion_h1_responsive_styles2')) {

    function discussion_h1_responsive_styles2() {

        $h1_styles = array();

        if(discussion_options()->getOptionValue('h1_responsive_fontsize2') !== '') {
            $h1_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h1_responsive_fontsize2')).'px';
        }
        if(discussion_options()->getOptionValue('h1_responsive_lineheight2') !== '') {
            $h1_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h1_responsive_lineheight2')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo discussion_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('discussion_style_dynamic_responsive_480', 'discussion_h1_responsive_styles2');
}

if (!function_exists('discussion_h2_responsive_styles2')) {

    function discussion_h2_responsive_styles2() {

        $h2_styles = array();

        if(discussion_options()->getOptionValue('h2_responsive_fontsize2') !== '') {
            $h2_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h2_responsive_fontsize2')).'px';
        }
        if(discussion_options()->getOptionValue('h2_responsive_lineheight2') !== '') {
            $h2_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h2_responsive_lineheight2')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo discussion_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('discussion_style_dynamic_responsive_480', 'discussion_h2_responsive_styles2');
}

if (!function_exists('discussion_h3_responsive_styles2')) {

    function discussion_h3_responsive_styles2() {

        $h3_styles = array();

        if(discussion_options()->getOptionValue('h3_responsive_fontsize2') !== '') {
            $h3_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h3_responsive_fontsize2')).'px';
        }
        if(discussion_options()->getOptionValue('h3_responsive_lineheight2') !== '') {
            $h3_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h3_responsive_lineheight2')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo discussion_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('discussion_style_dynamic_responsive_480', 'discussion_h3_responsive_styles2');
}

if (!function_exists('discussion_h4_responsive_styles2')) {

    function discussion_h4_responsive_styles2() {

        $h4_styles = array();

        if(discussion_options()->getOptionValue('h4_responsive_fontsize2') !== '') {
            $h4_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h4_responsive_fontsize2')).'px';
        }
        if(discussion_options()->getOptionValue('h4_responsive_lineheight2') !== '') {
            $h4_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h4_responsive_lineheight2')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if (!empty($h4_styles)) {
            echo discussion_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('discussion_style_dynamic_responsive_480', 'discussion_h4_responsive_styles2');
}

if (!function_exists('discussion_h5_responsive_styles2')) {

    function discussion_h5_responsive_styles2() {

        $h5_styles = array();

        if(discussion_options()->getOptionValue('h5_responsive_fontsize2') !== '') {
            $h5_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h5_responsive_fontsize2')).'px';
        }
        if(discussion_options()->getOptionValue('h5_responsive_lineheight2') !== '') {
            $h5_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h5_responsive_lineheight2')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo discussion_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('discussion_style_dynamic_responsive_480', 'discussion_h5_responsive_styles2');
}

if (!function_exists('discussion_h6_responsive_styles2')) {

    function discussion_h6_responsive_styles2() {

        $h6_styles = array();

        if(discussion_options()->getOptionValue('h6_responsive_fontsize2') !== '') {
            $h6_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h6_responsive_fontsize2')).'px';
        }
        if(discussion_options()->getOptionValue('h6_responsive_lineheight2') !== '') {
            $h6_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h6_responsive_lineheight2')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo discussion_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('discussion_style_dynamic_responsive_480', 'discussion_h6_responsive_styles2');
}

if (!function_exists('discussion_text_responsive_styles2')) {

    function discussion_text_responsive_styles2() {

        $text_styles = array();

        if(discussion_options()->getOptionValue('text_fontsize_res2') !== '') {
            $text_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('text_fontsize_res2')).'px';
        }
        if(discussion_options()->getOptionValue('text_lineheight_res2') !== '') {
            $text_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('text_lineheight_res2')).'px';
        }

        $text_selector = array(
            'body',
            'p'
        );

        if (!empty($text_styles)) {
            echo discussion_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('discussion_style_dynamic_responsive_480', 'discussion_text_responsive_styles2');
}

if(!function_exists('discussion_design_responsive_styles')) {
    /**
     * Generates general responsive custom styles
     */
    function discussion_design_responsive_styles() {

        $parallax_style = array();
        if (discussion_options()->getOptionValue('parallax_min_height') !== '') {
            $parallax_style['height'] = 'auto !important';
            $parallax_min_height = discussion_options()->getOptionValue('parallax_min_height');
            $parallax_style['min-height'] = discussion_filter_px($parallax_min_height) . 'px';
        }

		echo discussion_dynamic_css('.mkd-parallax-section-holder', $parallax_style);
    }

    add_action('discussion_style_dynamic_responsive_480', 'discussion_design_responsive_styles');
    add_action('discussion_style_dynamic_responsive_480_768', 'discussion_design_responsive_styles');
}