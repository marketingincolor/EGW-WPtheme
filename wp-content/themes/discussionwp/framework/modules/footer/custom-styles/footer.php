<?php

if (!function_exists('discussion_footer_top_style')) {

	function discussion_footer_top_style(){
		$selector = '.mkd-footer-top';
		$footer_top_style = array();

		$background_image = discussion_options()->getOptionValue('footer_top_background_image');
		if ($background_image !== '') {
			$footer_top_style['background-image'] = 'url('.$background_image.')';
			$footer_top_style['background-position'] = 'center';

			echo discussion_dynamic_css($selector, $footer_top_style);
		}
	}

	add_action('discussion_style_dynamic', 'discussion_footer_top_style');

}