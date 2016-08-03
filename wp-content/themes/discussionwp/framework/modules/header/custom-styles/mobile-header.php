<?php

if(!function_exists('discussion_mobile_header_general_styles')) {
    /**
     * Generates general custom styles for mobile header
     */
    function discussion_mobile_header_general_styles() {
        $mobile_header_styles = array();
        if(discussion_options()->getOptionValue('mobile_header_height') !== '') {
            $mobile_header_styles['height'] = discussion_filter_px(discussion_options()->getOptionValue('mobile_header_height')).'px';
        }

        if(discussion_options()->getOptionValue('mobile_header_background_color')) {
            $mobile_header_styles['background-color'] = discussion_options()->getOptionValue('mobile_header_background_color');
        }

        echo discussion_dynamic_css('.mkd-mobile-header .mkd-mobile-header-inner', $mobile_header_styles);


		if(discussion_options()->getOptionValue('mobile_menu_background_color')) {
			echo discussion_dynamic_css(
				'.mkd-mobile-header .mkd-mobile-nav',
				array("background-color" => discussion_options()->getOptionValue('mobile_menu_background_color'))
			);
		}
    }

    add_action('discussion_style_dynamic', 'discussion_mobile_header_general_styles');
}

if(!function_exists('discussion_mobile_logo_styles')) {
    /**
     * Generates styles for mobile logo
     */
    function discussion_mobile_logo_styles() {
        if(discussion_options()->getOptionValue('mobile_logo_height') !== '') { ?>
            @media only screen and (max-width: 1024px) {
            <?php echo discussion_dynamic_css(
                '.mkd-mobile-header .mkd-mobile-logo-wrapper a',
                array('height' => discussion_filter_px(discussion_options()->getOptionValue('mobile_logo_height')).'px !important')
            ); ?>
            }
        <?php }

        if(discussion_options()->getOptionValue('mobile_logo_height_phones') !== '') { ?>
            @media only screen and (max-width: 480px) {
            <?php echo discussion_dynamic_css(
                '.mkd-mobile-header .mkd-mobile-logo-wrapper a',
                array('height' => discussion_filter_px(discussion_options()->getOptionValue('mobile_logo_height_phones')).'px !important')
            ); ?>
            }
        <?php }
    }

    add_action('discussion_style_dynamic', 'discussion_mobile_logo_styles');
}

if(!function_exists('discussion_mobile_icon_styles')) {
    /**
     * Generates styles for mobile icon opener
     */
    function discussion_mobile_icon_styles() {
    	
        if(discussion_options()->getOptionValue('mobile_icon_color') !== '') {
            echo discussion_dynamic_css(
                '.mkd-mobile-header .mkd-mobile-menu-opener .mkd-mobile-opener-icon-holder .mkd-line',
                array('background-color' => discussion_options()->getOptionValue('mobile_icon_color')));
        }

        if(discussion_options()->getOptionValue('mobile_icon_hover_color') !== '') {
            echo discussion_dynamic_css(
                '.mkd-mobile-header .mkd-mobile-menu-opener a:hover .mkd-mobile-opener-icon-holder .mkd-line',
                array('background-color' => discussion_options()->getOptionValue('mobile_icon_hover_color')));
        }
    }

    add_action('discussion_style_dynamic', 'discussion_mobile_icon_styles');
}