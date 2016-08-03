<?php

if (!function_exists('discussion_side_area_over_content_style')) {

	function discussion_side_area_over_content_style()
	{

		if (discussion_options()->getOptionValue('side_area_type') == 'side-menu-slide-over-content') {


			$width = discussion_options()->getOptionValue('side_area_slide_over_content_width');
			if ($width !== '') {

				if ($width == 'width-280'){
					$width = '280px';
				}
				elseif ($width == 'width-340'){
					$width = '340px';
				}
				else{
					$width = '440px';
				}

				echo discussion_dynamic_css('.mkd-side-menu-slide-over-content .mkd-side-menu', array(
					'left' => '-'.$width,
					'width' => $width
				));
			}
		}

	}

	add_action('discussion_style_dynamic', 'discussion_side_area_over_content_style');

}

if (!function_exists('discussion_side_area_icon_color_styles')) {

	function discussion_side_area_icon_color_styles()
	{

		if (discussion_options()->getOptionValue('side_area_icon_font_size') !== '') {

			echo discussion_dynamic_css('.mkd-side-menu-button-opener span', array(
				'font-size' => discussion_filter_px(discussion_options()->getOptionValue('side_area_icon_font_size')) . 'px'
			));

			if (discussion_options()->getOptionValue('side_area_icon_font_size') > 30) {
				echo '@media only screen and (max-width: 480px) {
						.mkd-side-menu-button-opener span{
						font-size: 30px;
						}
					}';
			}

		}

		if (discussion_options()->getOptionValue('side_area_icon_color') !== '') {

			echo discussion_dynamic_css('a.mkd-side-menu-button-opener', array(
				'color' => discussion_options()->getOptionValue('side_area_icon_color')
			));

		}
		if (discussion_options()->getOptionValue('side_area_icon_hover_color') !== '') {

			echo discussion_dynamic_css('a.mkd-side-menu-button-opener:hover', array(
				'color' => discussion_options()->getOptionValue('side_area_icon_hover_color')
			));

		}


	}

	add_action('discussion_style_dynamic', 'discussion_side_area_icon_color_styles');

}

if (!function_exists('discussion_side_area_alignment')) {

	function discussion_side_area_alignment()
	{

		if (discussion_options()->getOptionValue('side_area_aligment')) {

			echo discussion_dynamic_css('.mkd-side-menu-slide-over-content .mkd-side-menu', array(
				'text-align' => discussion_options()->getOptionValue('side_area_aligment')
			));

		}

	}

	add_action('discussion_style_dynamic', 'discussion_side_area_alignment');

}

if (!function_exists('discussion_side_area_styles')) {

	function discussion_side_area_styles()
	{

		$side_area_styles = array();

		if (discussion_options()->getOptionValue('side_area_background_color') !== '') {
			$side_area_styles['background-color'] = discussion_options()->getOptionValue('side_area_background_color');
		}

		if (!empty($side_area_styles)) {
			echo discussion_dynamic_css('.mkd-side-menu', $side_area_styles);
		}

		if (discussion_options()->getOptionValue('side_area_close_icon') == 'dark') {
			echo discussion_dynamic_css('.mkd-side-menu a.mkd-close-side-menu span, .mkd-side-menu a.mkd-close-side-menu i', array(
				'color' => '#000000'
			));
		}

		if (discussion_options()->getOptionValue('side_area_close_icon_size') !== '') {
			echo discussion_dynamic_css('.mkd-side-menu a.mkd-close-side-menu', array(
				'height' => discussion_filter_px(discussion_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'width' => discussion_filter_px(discussion_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'line-height' => discussion_filter_px(discussion_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'padding' => 0,
			));
			echo discussion_dynamic_css('.mkd-side-menu a.mkd-close-side-menu span, .mkd-side-menu a.mkd-close-side-menu i', array(
				'font-size' => discussion_filter_px(discussion_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'height' => discussion_filter_px(discussion_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'width' => discussion_filter_px(discussion_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'line-height' => discussion_filter_px(discussion_options()->getOptionValue('side_area_close_icon_size')) . 'px',
			));
		}

	}

	add_action('discussion_style_dynamic', 'discussion_side_area_styles');

}

if (!function_exists('discussion_side_area_title_styles')) {

	function discussion_side_area_title_styles()
	{

		$title_styles = array();

		if (discussion_options()->getOptionValue('side_area_title_color') !== '') {
			$title_styles['color'] = discussion_options()->getOptionValue('side_area_title_color');
		}

		if (discussion_options()->getOptionValue('side_area_title_fontsize') !== '') {
			$title_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('side_area_title_fontsize')) . 'px';
		}

		if (discussion_options()->getOptionValue('side_area_title_lineheight') !== '') {
			$title_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('side_area_title_lineheight')) . 'px';
		}

		if (discussion_options()->getOptionValue('side_area_title_texttransform') !== '') {
			$title_styles['text-transform'] = discussion_options()->getOptionValue('side_area_title_texttransform');
		}

		if (discussion_options()->getOptionValue('side_area_title_google_fonts') !== '-1') {
			$title_styles['font-family'] = discussion_get_formatted_font_family(discussion_options()->getOptionValue('side_area_title_google_fonts')) . ', sans-serif';
		}

		if (discussion_options()->getOptionValue('side_area_title_fontstyle') !== '') {
			$title_styles['font-style'] = discussion_options()->getOptionValue('side_area_title_fontstyle');
		}

		if (discussion_options()->getOptionValue('side_area_title_fontweight') !== '') {
			$title_styles['font-weight'] = discussion_options()->getOptionValue('side_area_title_fontweight');
		}

		if (discussion_options()->getOptionValue('side_area_title_letterspacing') !== '') {
			$title_styles['letter-spacing'] = discussion_filter_px(discussion_options()->getOptionValue('side_area_title_letterspacing')) . 'px';
		}

		if (!empty($title_styles)) {

			echo discussion_dynamic_css('.mkd-side-menu-title h4, .mkd-side-menu-title h5', $title_styles);

		}

	}

	add_action('discussion_style_dynamic', 'discussion_side_area_title_styles');

}

if (!function_exists('discussion_side_area_text_styles')) {

	function discussion_side_area_text_styles()
	{
		$text_styles = array();

		if (discussion_options()->getOptionValue('side_area_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = discussion_get_formatted_font_family(discussion_options()->getOptionValue('side_area_text_google_fonts')) . ', sans-serif';
		}

		if (discussion_options()->getOptionValue('side_area_text_fontsize') !== '') {
			$text_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('side_area_text_fontsize')) . 'px';
		}

		if (discussion_options()->getOptionValue('side_area_text_lineheight') !== '') {
			$text_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('side_area_text_lineheight')) . 'px';
		}

		if (discussion_options()->getOptionValue('side_area_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = discussion_filter_px(discussion_options()->getOptionValue('side_area_text_letterspacing')) . 'px';
		}

		if (discussion_options()->getOptionValue('side_area_text_fontweight') !== '') {
			$text_styles['font-weight'] = discussion_options()->getOptionValue('side_area_text_fontweight');
		}

		if (discussion_options()->getOptionValue('side_area_text_fontstyle') !== '') {
			$text_styles['font-style'] = discussion_options()->getOptionValue('side_area_text_fontstyle');
		}

		if (discussion_options()->getOptionValue('side_area_text_texttransform') !== '') {
			$text_styles['text-transform'] = discussion_options()->getOptionValue('side_area_text_texttransform');
		}

		if (discussion_options()->getOptionValue('side_area_text_color') !== '') {
			$text_styles['color'] = discussion_options()->getOptionValue('side_area_text_color');
		}

		if (!empty($text_styles)) {

			echo discussion_dynamic_css(array(
				'.mkd-side-menu .widget',
				'.mkd-side-menu .widget.widget_search form',
				'.mkd-side-menu .widget.widget_search form input[type="text"]',
				'.mkd-side-menu .widget.widget_search form input[type="submit"]',
				'.mkd-side-menu .widget h6',
				'.mkd-side-menu .widget h6 a',
				'.mkd-side-menu .widget p',
				'.mkd-side-menu .widget li a',
				'.mkd-side-menu #wp-calendar caption',
				'.mkd-side-menu .widget li',
				'.mkd-side-menu h3',
				'.mkd-side-menu .widget.widget_archive select',
				'.mkd-side-menu .widget.widget_categories select',
				'.mkd-side-menu .widget.widget_text select',
				'.mkd-side-menu .widget.widget_search form input[type="submit"]',
				'.mkd-side-menu #wp-calendar th',
				'.mkd-side-menu #wp-calendar td',
				'.mkd-side-menu .q_social_icon_holder i.simple_social',
				'.mkd-side-menu .widget .screen-reader-text',
				'.mkd-side-menu span'
				),
				$text_styles
			);
		}

	}

	add_action('discussion_style_dynamic', 'discussion_side_area_text_styles');

}

if (!function_exists('discussion_side_area_link_styles')) {

	function discussion_side_area_link_styles()
	{
		$link_styles = array();

		if (discussion_options()->getOptionValue('sidearea_link_font_family') !== '-1') {
			$link_styles['font-family'] = discussion_get_formatted_font_family(discussion_options()->getOptionValue('sidearea_link_font_family')) . ',sans-serif';
		}

		if (discussion_options()->getOptionValue('sidearea_link_font_size') !== '') {
			$link_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('sidearea_link_font_size')) . 'px';
		}

		if (discussion_options()->getOptionValue('sidearea_link_line_height') !== '') {
			$link_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('sidearea_link_line_height')) . 'px';
		}

		if (discussion_options()->getOptionValue('sidearea_link_letter_spacing') !== '') {
			$link_styles['letter-spacing'] = discussion_filter_px(discussion_options()->getOptionValue('sidearea_link_letter_spacing')) . 'px';
		}

		if (discussion_options()->getOptionValue('sidearea_link_font_weight') !== '') {
			$link_styles['font-weight'] = discussion_options()->getOptionValue('sidearea_link_font_weight');
		}

		if (discussion_options()->getOptionValue('sidearea_link_font_style') !== '') {
			$link_styles['font-style'] = discussion_options()->getOptionValue('sidearea_link_font_style');
		}

		if (discussion_options()->getOptionValue('sidearea_link_text_transform') !== '') {
			$link_styles['text-transform'] = discussion_options()->getOptionValue('sidearea_link_text_transform');
		}

		if (discussion_options()->getOptionValue('sidearea_link_color') !== '') {
			$link_styles['color'] = discussion_options()->getOptionValue('sidearea_link_color');
		}

		if (!empty($link_styles)) {

			echo discussion_dynamic_css('.mkd-side-menu .widget li a, .mkd-side-menu .widget a:not(.qbutton),.mkd-side-menu .widget.widget_rss li a.rsswidget', $link_styles);

		}

		if (discussion_options()->getOptionValue('sidearea_link_hover_color') !== '') {
			echo discussion_dynamic_css('.mkd-side-menu .widget a:hover, .mkd-side-menu .widget li:hover, .mkd-side-menu .widget li:hover>a,.mkd-side-menu .widget.widget_rss li a.rsswidget:hover', array(
				'color' => discussion_options()->getOptionValue('sidearea_link_hover_color')
			));
		}

	}

	add_action('discussion_style_dynamic', 'discussion_side_area_link_styles');

}