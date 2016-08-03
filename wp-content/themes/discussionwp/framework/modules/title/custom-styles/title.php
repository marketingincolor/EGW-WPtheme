<?php

if (!function_exists('discussion_title_area_typography_style')) {

    function discussion_title_area_typography_style(){

        $breadcrumb_styles = array();

        if(discussion_options()->getOptionValue('page_breadcrumb_color') !== '') {
        	echo discussion_dynamic_css(
        		'.mkd-title .mkd-title-holder .mkd-breadcrumbs',
        		array('color' => discussion_options()->getOptionValue('page_breadcrumb_color'))
    		);
        }
        if(discussion_options()->getOptionValue('page_breadcrumb_google_fonts') !== '-1') {
            $breadcrumb_styles['font-family'] = discussion_get_formatted_font_family(discussion_options()->getOptionValue('page_breadcrumb_google_fonts'));
        }
        if(discussion_options()->getOptionValue('page_breadcrumb_fontsize') !== '') {
            $breadcrumb_styles['font-size'] = discussion_options()->getOptionValue('page_breadcrumb_fontsize').'px';
        }
        if(discussion_options()->getOptionValue('page_breadcrumb_lineheight') !== '') {
            $breadcrumb_styles['line-height'] = discussion_options()->getOptionValue('page_breadcrumb_lineheight').'px';
        }
        if(discussion_options()->getOptionValue('page_breadcrumb_texttransform') !== '') {
            $breadcrumb_styles['text-transform'] = discussion_options()->getOptionValue('page_breadcrumb_texttransform');
        }
        if(discussion_options()->getOptionValue('page_breadcrumb_fontstyle') !== '') {
            $breadcrumb_styles['font-style'] = discussion_options()->getOptionValue('page_breadcrumb_fontstyle');
        }
        if(discussion_options()->getOptionValue('page_breadcrumb_fontweight') !== '') {
            $breadcrumb_styles['font-weight'] = discussion_options()->getOptionValue('page_breadcrumb_fontweight');
        }
        if(discussion_options()->getOptionValue('page_breadcrumb_letter_spacing') !== '') {
            $breadcrumb_styles['letter-spacing'] = discussion_options()->getOptionValue('page_breadcrumb_letter_spacing').'px';
        }

        $breadcrumb_selector = array(
            '.mkd-title .mkd-title-holder .mkd-breadcrumbs a, .mkd-title .mkd-title-holder .mkd-breadcrumbs span'
        );

        echo discussion_dynamic_css($breadcrumb_selector, $breadcrumb_styles);

        $breadcrumb_selector_styles = array();
        if(discussion_options()->getOptionValue('page_breadcrumb_hovercolor') !== '') {
            $breadcrumb_selector_styles['color'] = discussion_options()->getOptionValue('page_breadcrumb_hovercolor').' !important';
        }

        $breadcrumb_hover_selector = array(
            '.mkd-title .mkd-title-holder .mkd-breadcrumbs a:hover'
        );

        echo discussion_dynamic_css($breadcrumb_hover_selector, $breadcrumb_selector_styles);

    }

    add_action('discussion_style_dynamic', 'discussion_title_area_typography_style');

}


