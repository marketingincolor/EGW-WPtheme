<?php

if(!function_exists('discussion_header_top_bar_styles')) {
    /**
     * Generates styles for header top bar
     */
    function discussion_header_top_bar_styles() {
        global $discussion_options;

        $background_color = discussion_options()->getOptionValue('top_bar_background_color');
        $top_bar_styles = array();

        if($background_color !== '') {
            $top_bar_styles['background-color'] = $background_color;
        }

        echo discussion_dynamic_css('.mkd-top-bar', $top_bar_styles);
    }

    add_action('discussion_style_dynamic', 'discussion_header_top_bar_styles');
}

if(!function_exists('discussion_header_top_bar_responsive_styles')) {
    /**
     * Generates styles for header top bar
     */
    function discussion_header_top_bar_responsive_styles() {
        global $discussion_options;

        $top_bar_responsive_styles = array();
        $hide_top_bar_on_mobile = discussion_options()->getOptionValue('hide_top_bar_on_mobile');

        if($hide_top_bar_on_mobile === 'yes') { ?>
            @media only screen and (max-width: 700px) {
                .mkd-top-bar {
                    height: 0;
                    display: none;
                }
            }
        <?php }
    }

    add_action('discussion_style_dynamic', 'discussion_header_top_bar_responsive_styles');
}

if(!function_exists('discussion_header_type3_logo_styles')) {
    /**
     * Generates styles for header type 3 logo
     */
    function discussion_header_type3_logo_styles() {
        global $discussion_options;

        $logo_area_header_type3_styles = array();

        if($discussion_options['logo_area_height_header_type3'] !== '') {
            $header_type3_height = discussion_filter_px($discussion_options['logo_area_height_header_type3']);

            $logo_area_header_type3_styles['height'] = $header_type3_height.'px';

            $max_height = intval($header_type3_height).'px';
            echo discussion_dynamic_css('.mkd-header-type3 .mkd-page-header .mkd-logo-wrapper a', array('max-height' => $max_height));
        }

        if($discussion_options['logo_area_background_color'] !== '') {
            $logo_area_header_type3_styles['background-color'] = $discussion_options['logo_area_background_color'];
        }

        echo discussion_dynamic_css('.mkd-header-type3 .mkd-page-header .mkd-logo-area', $logo_area_header_type3_styles);
    }

    add_action('discussion_style_dynamic', 'discussion_header_type3_logo_styles');
}

if(!function_exists('discussion_header_type3_menu_area_styles')) {
    /**
     * Generates styles for header type 3 menu area
     */
    function discussion_header_type3_menu_area_styles() {
        global $discussion_options;

        $menu_area_header_type3_styles = array();
        if($discussion_options['menu_area_height_header_type3'] !== '') {
            $menu_area_header_type3_styles['height'] = discussion_filter_px($discussion_options['menu_area_height_header_type3']).'px';
            echo discussion_dynamic_css('.mkd-page-header .mkd-menu-area .mkd-shopping-cart-outer',array('height' => $menu_area_header_type3_styles['height']));
        }
        if($discussion_options['menu_area_background_color'] !== '') {
            $menu_area_header_type3_styles['background-color'] = $discussion_options['menu_area_background_color'];
        }
        echo discussion_dynamic_css('.mkd-header-type3 .mkd-page-header .mkd-menu-area', $menu_area_header_type3_styles);

        $menu_area_header_type3_separator_styles = array();
        $menu_area_header_type3_separator_selector = '.mkd-main-menu > ul > li > a,
                                                      .mkd-page-header .mkd-left-from-main-menu,
                                                      .mkd-page-header .mkd-right-from-main-menu';
        if($discussion_options['menu_area_separator_color'] !== '') {
            $menu_area_header_type3_separator_styles['border-color'] = $discussion_options['menu_area_separator_color'].' !important';
        }
        echo discussion_dynamic_css($menu_area_header_type3_separator_selector, $menu_area_header_type3_separator_styles);

    }

    add_action('discussion_style_dynamic', 'discussion_header_type3_menu_area_styles');
}

if(!function_exists('discussion_sticky_header_styles')) {
    /**
     * Generates styles for sticky haeder
     */
    function discussion_sticky_header_styles() {
        global $discussion_options;

        if($discussion_options['sticky_header_background_color'] !== '') {

            $sticky_header_background_color              = $discussion_options['sticky_header_background_color'];
            $sticky_header_background_color_transparency = 1;

            if($discussion_options['sticky_header_transparency'] !== '') {
                $sticky_header_background_color_transparency = $discussion_options['sticky_header_transparency'];
            }

            echo discussion_dynamic_css('.mkd-page-header .mkd-sticky-header .mkd-sticky-holder', array('background-color' => discussion_rgba_color($sticky_header_background_color, $sticky_header_background_color_transparency)));
        }

        if($discussion_options['sticky_header_height'] !== '') {
            $sticky_header_height = discussion_filter_px($discussion_options['sticky_header_height']);
            $max_height = intval($sticky_header_height * 0.9).'px';

            echo discussion_dynamic_css('.mkd-page-header .mkd-sticky-header', array('height' => $sticky_header_height.'px'));
            echo discussion_dynamic_css('.mkd-page-header .mkd-sticky-header .mkd-sticky-holder .mkd-logo-wrapper a', array('max-height' => $max_height));
        }

        $sticky_menu_item_styles = array();
        if($discussion_options['sticky_color'] !== '') {
            $sticky_menu_item_styles['color'] = $discussion_options['sticky_color'];
        }
        if($discussion_options['sticky_google_fonts'] !== '-1') {
            $sticky_menu_item_styles['font-family'] = discussion_get_formatted_font_family($discussion_options['sticky_google_fonts']);
        }
        if($discussion_options['sticky_fontsize'] !== '') {
            $sticky_menu_item_styles['font-size'] = $discussion_options['sticky_fontsize'].'px';
        }
        if($discussion_options['sticky_lineheight'] !== '') {
            $sticky_menu_item_styles['line-height'] = $discussion_options['sticky_lineheight'].'px';
        }
        if($discussion_options['sticky_texttransform'] !== '') {
            $sticky_menu_item_styles['text-transform'] = $discussion_options['sticky_texttransform'];
        }
        if($discussion_options['sticky_fontstyle'] !== '') {
            $sticky_menu_item_styles['font-style'] = $discussion_options['sticky_fontstyle'];
        }
        if($discussion_options['sticky_fontweight'] !== '') {
            $sticky_menu_item_styles['font-weight'] = $discussion_options['sticky_fontweight'];
        }
        if($discussion_options['sticky_letterspacing'] !== '') {
            $sticky_menu_item_styles['letter-spacing'] = $discussion_options['sticky_letterspacing'].'px';
        }

        $sticky_menu_item_selector = array(
            '.mkd-page-header .mkd-sticky-header .mkd-main-menu.mkd-sticky-nav > ul > li > a'
        );

        echo discussion_dynamic_css($sticky_menu_item_selector, $sticky_menu_item_styles);

        $sticky_menu_item_hover_styles = array();
        if($discussion_options['sticky_hovercolor'] !== '') {
            $sticky_menu_item_hover_styles['color'] = $discussion_options['sticky_hovercolor'];
        }

        $sticky_menu_item_hover_selector = array(
            '.mkd-page-header .mkd-sticky-header .mkd-main-menu.mkd-sticky-nav > ul > li:hover > a',
            '.mkd-page-header .mkd-sticky-header .mkd-main-menu.mkd-sticky-nav > ul > li.mkd-active-item:hover > a'
        );

        echo discussion_dynamic_css($sticky_menu_item_hover_selector, $sticky_menu_item_hover_styles);
    }

    add_action('discussion_style_dynamic', 'discussion_sticky_header_styles');
}

if(!function_exists('discussion_main_menu_styles')) {
    /**
     * Generates styles for main menu
     */
    function discussion_main_menu_styles() {
        global $discussion_options;

        if($discussion_options['menu_color'] !== '' || $discussion_options['menu_fontsize'] != '' || $discussion_options['menu_lineheight'] != '' || $discussion_options['menu_fontstyle'] !== '' || $discussion_options['menu_fontweight'] !== '' || $discussion_options['menu_texttransform'] !== '' || $discussion_options['menu_letterspacing'] !== '' || $discussion_options['menu_google_fonts'] != "-1") { ?>
            .mkd-main-menu.mkd-default-nav > ul > li > a {
            <?php if($discussion_options['menu_color']) { ?> color: <?php echo esc_attr($discussion_options['menu_color']); ?>; <?php } ?>
            <?php if($discussion_options['menu_google_fonts'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $discussion_options['menu_google_fonts'])); ?>', sans-serif;
            <?php } ?>
            <?php if($discussion_options['menu_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($discussion_options['menu_fontsize']); ?>px; <?php } ?>
            <?php if($discussion_options['menu_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($discussion_options['menu_lineheight']); ?>px; <?php } ?>
            <?php if($discussion_options['menu_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($discussion_options['menu_fontstyle']); ?>; <?php } ?>
            <?php if($discussion_options['menu_fontweight'] !== '') { ?> font-weight: <?php echo esc_attr($discussion_options['menu_fontweight']); ?>; <?php } ?>
            <?php if($discussion_options['menu_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($discussion_options['menu_texttransform']); ?>;  <?php } ?>
            <?php if($discussion_options['menu_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($discussion_options['menu_letterspacing']); ?>px; <?php } ?>
            }
        <?php } ?>

        <?php if($discussion_options['menu_hovercolor'] !== '') { ?>
            .mkd-main-menu.mkd-default-nav > ul > li:hover > a,
            .mkd-main-menu.mkd-default-nav > ul > li.mkd-active-item:hover > a {
                color: <?php echo esc_attr($discussion_options['menu_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if($discussion_options['menu_activecolor'] !== '') { ?>
            .mkd-main-menu.mkd-default-nav > ul > li.mkd-active-item > a {
                color: <?php echo esc_attr($discussion_options['menu_activecolor']); ?>;
            }
        <?php } ?>

        <?php

        $dropdown_styles = array();
        if($discussion_options['dropdown_background_color'] !== '') {
            $dropdown_styles['background-color'] = $discussion_options['dropdown_background_color'];
        }

        $dropdown_selector = array(
            '.mkd-drop-down .mkd-menu-second .mkd-menu-inner > ul,
            li.mkd-menu-narrow .mkd-menu-second .mkd-menu-inner ul,
            .mkd-top-bar #lang_sel ul ul'
        );

        echo discussion_dynamic_css($dropdown_selector, $dropdown_styles);

        $dropdown_border_styles = array();
        if($discussion_options['dropdown_border_color'] !== '') {
            $dropdown_border_styles['border-color'] = $discussion_options['dropdown_border_color'];
        }

        $dropdown_border_selector = array('
            .mkd-drop-down .mkd-menu-second .mkd-menu-inner > ul,
            li.mkd-menu-narrow .mkd-menu-second .mkd-menu-inner ul,
            .mkd-drop-down .mkd-menu-second .mkd-menu-inner ul li
        ');
        echo discussion_dynamic_css($dropdown_border_selector, $dropdown_border_styles);
    }

    add_action('discussion_style_dynamic', 'discussion_main_menu_styles');
}