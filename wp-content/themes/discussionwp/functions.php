<?php
include_once get_template_directory() . '/theme-includes.php'; // File containing all theme includes/requires at one place

if (!function_exists('discussion_styles')) {

    /**
     * Function that includes theme's core styles
     */
    function discussion_styles() {

        //include theme's core styles
        wp_enqueue_style('discussion_default_style', MIKADO_ROOT . '/style.css');
        wp_enqueue_style('discussion_modules', MIKADO_ASSETS_ROOT . '/css/modules.css');
        wp_enqueue_style('fsp_custom_css', MIKADO_ASSETS_ROOT . '/css/fspstyles.css');
        wp_enqueue_style('fsp_custom_popup', MIKADO_ASSETS_ROOT . '/css/magnific-popup.css');

        discussion_icon_collections()->enqueueStyles();

        wp_enqueue_style('wp-mediaelement');

        //define files afer which style dynamic needs to be included. It should be included last so it can override other files
        $style_dynamic_deps_array = array();
        if (discussion_load_woo_assets()) {
            $style_dynamic_deps_array = array('discussion_woo', 'discussion_woo_responsive');
        }


        if (file_exists(MIKADO_ROOT_DIR . '/assets/css/style_dynamic.css') && discussion_is_css_folder_writable() && !is_multisite()) {
            wp_enqueue_style('discussion_style_dynamic', MIKADO_ASSETS_ROOT . '/css/style_dynamic.css', $style_dynamic_deps_array, filemtime(MIKADO_ROOT_DIR . '/assets/css/style_dynamic.css')); //it must be included after woocommerce styles so it can override it
        }

        //is responsive option turned on?
        if (discussion_is_responsive_on()) {
            wp_enqueue_style('discussion_modules_responsive', MIKADO_ASSETS_ROOT . '/css/modules-responsive.min.css');

            //include proper styles
            if (file_exists(MIKADO_ROOT_DIR . '/assets/css/style_dynamic_responsive.css') && discussion_is_css_folder_writable() && !is_multisite()) {
                wp_enqueue_style('discussion_style_dynamic_responsive', MIKADO_ASSETS_ROOT . '/css/style_dynamic_responsive.css', array(), filemtime(MIKADO_ROOT_DIR . '/assets/css/style_dynamic_responsive.css'));
            }
        }

        //include Visual Composer styles
        if (class_exists('WPBakeryVisualComposerAbstract')) {
            wp_enqueue_style('js_composer_front');
        }
    }

    add_action('wp_enqueue_scripts', 'discussion_styles');
}

if (!function_exists('discussion_google_fonts_styles')) {

    /**
     * Function that includes google fonts defined anywhere in the theme
     */
    function discussion_google_fonts_styles() {
        $font_simple_field_array = discussion_options()->getOptionsByType('fontsimple');
        if (!(is_array($font_simple_field_array) && count($font_simple_field_array) > 0)) {
            $font_simple_field_array = array();
        }

        $font_field_array = discussion_options()->getOptionsByType('font');
        if (!(is_array($font_field_array) && count($font_field_array) > 0)) {
            $font_field_array = array();
        }

        $available_font_options = array_merge($font_simple_field_array, $font_field_array);
        $font_weight_str = '100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';

        //define available font options array
        $fonts_array = array();
        foreach ($available_font_options as $font_option) {
            //is font set and not set to default and not empty?
            $font_option_value = discussion_options()->getOptionValue($font_option);
            if (discussion_is_font_option_valid($font_option_value) && !discussion_is_native_font($font_option_value)) {
                $font_option_string = $font_option_value . ':' . $font_weight_str;
                if (!in_array($font_option_string, $fonts_array)) {
                    $fonts_array[] = $font_option_string;
                }
            }
        }

        wp_reset_postdata();

        $fonts_array = array_diff($fonts_array, array('-1:' . $font_weight_str));
        $google_fonts_string = implode('|', $fonts_array);

        //default fonts should be separated with %7C because of HTML validation
        $default_font_string = 'Roboto Slab:' . $font_weight_str . '|Lato:' . $font_weight_str;
        $protocol = is_ssl() ? 'https:' : 'http:';

        //is google font option checked anywhere in theme?
        if (count($fonts_array) > 0) {

            //include all checked fonts
            $fonts_full_list = $default_font_string . '|' . str_replace('+', ' ', $google_fonts_string);
            $fonts_full_list_args = array(
                'family' => urlencode($fonts_full_list),
                'subset' => urlencode('latin,latin-ext'),
            );

            $discussion_fonts = add_query_arg($fonts_full_list_args, $protocol . '//fonts.googleapis.com/css');
            wp_enqueue_style('discussion_google_fonts', esc_url_raw($discussion_fonts), array(), '1.0.0');
        } else {
            //include default google font that theme is using
            $default_fonts_args = array(
                'family' => urlencode($default_font_string),
                'subset' => urlencode('latin,latin-ext'),
            );
            $discussion_fonts = add_query_arg($default_fonts_args, $protocol . '//fonts.googleapis.com/css');
            wp_enqueue_style('discussion_google_fonts', esc_url_raw($discussion_fonts), array(), '1.0.0');
        }
    }

    add_action('wp_enqueue_scripts', 'discussion_google_fonts_styles');
}

if (!function_exists('discussion_scripts')) {

    /**
     * Function that includes all necessary scripts
     */
    function discussion_scripts() {
        global $wp_scripts;

        //init theme core scripts
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('wp-mediaelement');


        wp_enqueue_script('discussion_third_party', MIKADO_ASSETS_ROOT . '/js/third-party.min.js', array('jquery'), false, true);

        if (discussion_is_smoth_scroll_enabled()) {
            wp_enqueue_script("discussion_smooth_page_scroll", MIKADO_ASSETS_ROOT . "/js/smoothPageScroll.js", array(), false, true);
        }

        //include google map api script
        wp_enqueue_script('google_map_api', '//maps.googleapis.com/maps/api/js?sensor=false', array(), false, true);

        wp_enqueue_script('discussion_modules', MIKADO_ASSETS_ROOT . '/js/modules.min.js', array('jquery'), false, true);
        wp_enqueue_script('fsp-custom-popupjs', MIKADO_ASSETS_ROOT . '/js/jquery.magnific-popup.js', array('jquery'), false, true);

        wp_enqueue_script('common script', MIKADO_ASSETS_ROOT . '/js/common.js', array('jquery'), false, true);


        //include comment reply script
        $wp_scripts->add_data('comment-reply', 'group', 1);
        if (is_singular()) {
            wp_enqueue_script("comment-reply");
        }

        //include Visual Composer script
        if (class_exists('WPBakeryVisualComposerAbstract')) {
            wp_enqueue_script('wpb_composer_front_js');
        }

        //Remove article from the user profile page
        if (is_page('user-profile')) {
            wp_enqueue_script('custom-remove-save-article', MIKADO_ASSETS_ROOT . '/js/fsp-remove-save-article.js');
        }

        //Remove article from the user profile page
        if (is_page('login')) {
            wp_enqueue_script('jquery validation', MIKADO_ASSETS_ROOT . '/js/jquery.validate.js');
        }
    }

    add_action('wp_enqueue_scripts', 'discussion_scripts');
}

//defined content width variable
if (!isset($content_width))
    $content_width = 1060;

if (!function_exists('discussion_theme_setup')) {

    /**
     * Function that adds various features to theme. Also defines image sizes that are used in a theme
     */
    function discussion_theme_setup() {
        //add support for feed links
        add_theme_support('automatic-feed-links');

        //add support for post formats
        add_theme_support('post-formats', array('gallery', 'link', 'quote', 'video', 'audio'));

        //add theme support for post thumbnails
        add_theme_support('post-thumbnails');

        //add theme support for title tag
        add_theme_support('title-tag');

        //define thumbnail sizes
        add_image_size('discussion_square', 550, 550, true);
        add_image_size('discussion_landscape', 800, 600, true);
        add_image_size('discussion_portrait', 600, 800, true);
        add_image_size('discussion_post_feature_image', 1300);
        add_image_size('discussion_thumb', 128, 86, true);
        add_image_size('discussion_single_post_title', 1300, 580, true);
        add_image_size('discussion_large_width', 1100, 550, true);
        add_image_size('discussion_large_height', 550, 1100, true);

        add_filter('widget_text', 'do_shortcode');

        load_theme_textdomain('discussionwp', get_template_directory() . '/languages');
    }

    add_action('after_setup_theme', 'discussion_theme_setup');
}


if (!function_exists('discussion_rgba_color')) {

    /**
     * Function that generates rgba part of css color property
     *
     * @param $color string hex color
     * @param $transparency float transparency value between 0 and 1
     *
     * @return string generated rgba string
     */
    function discussion_rgba_color($color, $transparency) {
        if ($color !== '' && $transparency !== '') {
            $rgba_color = '';

            $rgb_color_array = discussion_hex2rgb($color);
            $rgba_color .= 'rgba(' . implode(', ', $rgb_color_array) . ', ' . $transparency . ')';

            return $rgba_color;
        }
    }

}

if (!function_exists('discussion_wp_title_text')) {

    /**
     * Function that sets page's title. Hooks to wp_title filter
     *
     * @param $title string current page title
     * @param $sep string title separator
     *
     * @return string changed title text if SEO plugins aren't installed
     */
    function discussion_wp_title_text($title, $sep) {

        //is SEO plugin installed?
        if (discussion_seo_plugin_installed()) {
            //don't do anything, seo plugin will take care of it
        } else {
            //get current post id
            $id = discussion_get_page_id();
            $sep = ' | ';
            $title_prefix = get_bloginfo('name');
            $title_suffix = '';

            //is WooCommerce installed and is current page shop page?
            if (discussion_is_woocommerce_installed() && discussion_is_woocommerce_shop()) {
                //get shop page id
                $id = discussion_get_woo_shop_page_id();
            }

            //set unchanged title variable so we can use it later
            $title_array = explode($sep, $title);
            $unchanged_title = array_shift($title_array);

            if (empty($title_suffix)) {
                //if current page is front page append site description, else take original title string
                $title_suffix = is_front_page() ? get_bloginfo('description') : $unchanged_title;
            }

            //concatenate title string
            $title = $title_prefix . $sep . $title_suffix;

            //return generated title string
            return $title;
        }
    }

    add_filter('wp_title', 'discussion_wp_title_text', 10, 2);
}

if (!function_exists('discussion_header_meta')) {

    /**
     * Function that echoes meta data if our seo is enabled
     */
    function discussion_header_meta() {
        ?>          

        <meta charset="<?php bloginfo('charset'); ?>"/>       
        <!--        <link rel="profile" href="http://gmpg.org/xfn/11"/>-->
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
        <?php
    }

    add_action('discussion_header_meta', 'discussion_header_meta');
}

if (!function_exists('discussion_user_scalable_meta')) {

    /**
     * Function that outputs user scalable meta if responsiveness is turned on
     * Hooked to discussion_header_meta action
     */
    function discussion_user_scalable_meta() {
        //is responsiveness option is chosen?
        if (discussion_is_responsive_on()) {
            ?>
            <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
        <?php } else { ?>
            <meta name="viewport" content="width=1200,user-scalable=yes">
            <?php
        }
    }

    add_action('discussion_header_meta', 'discussion_user_scalable_meta');
}

if (!function_exists('discussion_get_page_id')) {

    /**
     * Function that returns current page / post id.
     * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
     * page that is created in WP admin.
     *
     * @return int
     *
     * @version 0.1
     *
     */
    function discussion_get_page_id() {

        if (discussion_is_woocommerce_installed() && discussion_is_woocommerce_shop()) {
            return discussion_get_woo_shop_page_id();
        }

        if (is_archive() || is_search() || is_404() || (is_home() && is_front_page())) {
            return -1;
        }

        return get_queried_object_id();
    }

}


if (!function_exists('discussion_is_default_wp_template')) {

    /**
     * Function that checks if current page archive page, search, 404 or default home blog page
     * @return bool
     *
     * @see is_archive()
     * @see is_search()
     * @see is_404()
     * @see is_front_page()
     * @see is_home()
     */
    function discussion_is_default_wp_template() {
        return is_archive() || is_search() || is_404() || (is_front_page() && is_home());
    }

}

if (!function_exists('discussion_get_page_template_name')) {

    /**
     * Returns current template file name without extension
     * @return string name of current template file
     */
    function discussion_get_page_template_name() {
        $file_name = '';

        if (!discussion_is_default_wp_template()) {
            $file_name_without_ext = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename(get_page_template()));

            if ($file_name_without_ext !== '') {
                $file_name = $file_name_without_ext;
            }
        }

        return $file_name;
    }

}

if (!function_exists('discussion_has_shortcode')) {

    /**
     * Function that checks whether shortcode exists on current page / post
     *
     * @param string shortcode to find
     * @param string content to check. If isn't passed current post content will be used
     *
     * @return bool whether content has shortcode or not
     */
    function discussion_has_shortcode($shortcode, $content = '') {
        $has_shortcode = false;

        if ($shortcode) {
            //if content variable isn't past
            if ($content == '') {
                //take content from current post
                $page_id = discussion_get_page_id();
                if (!empty($page_id)) {
                    $current_post = get_post($page_id);

                    if (is_object($current_post) && property_exists($current_post, 'post_content')) {
                        $content = $current_post->post_content;
                    }
                }
            }

            //does content has shortcode added?
            if (stripos($content, '[' . $shortcode) !== false) {
                $has_shortcode = true;
            }
        }

        return $has_shortcode;
    }

}

if (!function_exists('discussion_rewrite_rules_on_theme_activation')) {

    /**
     * Function that flushes rewrite rules on deactivation
     */
    function discussion_rewrite_rules_on_theme_activation() {
        flush_rewrite_rules();
    }

    add_action('after_switch_theme', 'discussion_rewrite_rules_on_theme_activation');
}

if (!function_exists('discussion_get_dynamic_sidebar')) {

    /**
     * Return Custom Widget Area content
     *
     * @return string
     */
    function discussion_get_dynamic_sidebar($index = 1) {
        ob_start();
        dynamic_sidebar($index);
        $sidebar_contents = ob_get_clean();

        return $sidebar_contents;
    }

}

if (!function_exists('discussion_get_sidebar')) {

    /**
     * Return Sidebar
     *
     * @return string
     */
    function discussion_get_sidebar() {

        $id = discussion_get_page_id();

        $sidebar = "sidebar";

        if (is_category()) {

            $current_cat_id = discussion_get_current_object_id();
            $cat_array = get_option("post_tax_term_$current_cat_id");
            $cat_custom_sidebar = $cat_array['custom_sidebar'];

            $category_custom_sidebar = '';
            if (!empty($cat_custom_sidebar)) {
                $category_custom_sidebar = $cat_custom_sidebar;
            } else if (discussion_options()->getOptionValue('blog_custom_category_sidebar') !== '') {
                $category_custom_sidebar = discussion_options()->getOptionValue('blog_custom_category_sidebar');
            }
        }

        if (get_post_meta($id, 'mkd_custom_sidebar_meta', true) !== '') {
            $sidebar = get_post_meta($id, 'mkd_custom_sidebar_meta', true);
        } else {
            if (is_single() && discussion_options()->getOptionValue('blog_single_custom_sidebar') != '') {
                $sidebar = esc_attr(discussion_options()->getOptionValue('blog_single_custom_sidebar'));
            } elseif (is_archive() && !is_author() && !is_category() && !is_tag() && discussion_options()->getOptionValue('blog_custom_sidebar') != '') {
                $sidebar = esc_attr(discussion_options()->getOptionValue('blog_custom_sidebar'));
            } elseif (is_search() && discussion_options()->getOptionValue('search_page_custom_sidebar') != '') {
                $sidebar = esc_attr(discussion_options()->getOptionValue('search_page_custom_sidebar'));
            } elseif (is_page() && discussion_options()->getOptionValue('page_custom_sidebar') != '') {
                $sidebar = esc_attr(discussion_options()->getOptionValue('page_custom_sidebar'));
            } elseif (is_category() && $category_custom_sidebar != '') {
                $sidebar = esc_attr($category_custom_sidebar);
            } elseif (is_author() && discussion_options()->getOptionValue('blog_custom_author_sidebar') != '') {
                $sidebar = esc_attr(discussion_options()->getOptionValue('blog_custom_author_sidebar'));
            } elseif (is_tag() && discussion_options()->getOptionValue('blog_custom_tag_sidebar')) {
                $sidebar = esc_attr(discussion_options()->getOptionValue('blog_custom_tag_sidebar'));
            }
        }

        return $sidebar;
    }

}

if (!function_exists('discussion_sidebar_columns_class')) {

    /**
     * Return classes for columns holder when sidebar is active
     *
     * @return array
     */
    function discussion_sidebar_columns_class() {

        $sidebar_class = array();
        $sidebar_layout = discussion_sidebar_layout();

        switch ($sidebar_layout):
            case 'sidebar-33-right':
                $sidebar_class[] = 'mkd-two-columns-66-33';
                break;
            case 'sidebar-25-right':
                $sidebar_class[] = 'mkd-two-columns-75-25';
                break;
            case 'sidebar-33-left':
                $sidebar_class[] = 'mkd-two-columns-33-66';
                break;
            case 'sidebar-25-left':
                $sidebar_class[] = 'mkd-two-columns-25-75';
                break;

        endswitch;

        $sidebar_class[] = ' mkd-content-has-sidebar clearfix';

        return discussion_class_attribute($sidebar_class);
    }

}

if (!function_exists('discussion_sidebar_layout')) {

    /**
     * Function that check is sidebar is enabled and return type of sidebar layout
     */
    function discussion_sidebar_layout() {

        $sidebar_layout = '';
        $page_id = discussion_get_page_id();

        $page_sidebar_meta = get_post_meta($page_id, 'mkd_sidebar_meta', true);

        $category_sidebar = false;
        if (is_category()) {

            $current_cat_id = discussion_get_current_object_id();
            $cat_array = get_option("post_tax_term_$current_cat_id");
            $cat_sidebar = $cat_array['sidebar_layout'];

            if (!empty($cat_sidebar)) {
                $category_sidebar = $cat_sidebar !== 'default' ? true : false;
                $category_sidebar_layout = $cat_sidebar !== 'default' ? $cat_sidebar : '';
            } else if (discussion_options()->getOptionValue('category_sidebar_layout') !== 'default') {
                $category_sidebar = true;
                $category_sidebar_layout = discussion_options()->getOptionValue('category_sidebar_layout');
                if ($category_sidebar_layout == 'no-sidebar') {
                    $category_sidebar_layout = '';
                }
            }
        }

        $author_sidebar = false;
        $author_sidebar_layout = '';
        if (is_author()) {
            $a_sidebar = discussion_options()->getOptionValue('author_sidebar_layout');
            if ($a_sidebar !== 'default') {
                $author_sidebar = true;
                $author_sidebar_layout = $a_sidebar;
                if ($author_sidebar_layout == 'no-sidebar') {
                    $author_sidebar_layout = '';
                }
            }
        }

        $tag_sidebar = false;
        $tag_sidebar_layout = '';
        if (is_tag()) {
            $t_sidebar = discussion_options()->getOptionValue('tag_sidebar_layout');
            if ($t_sidebar !== 'default') {
                $tag_sidebar = true;
                $tag_sidebar_layout = $t_sidebar;
                if ($tag_sidebar_layout == 'no-sidebar') {
                    $tag_sidebar_layout = '';
                }
            }
        }

        if ($page_sidebar_meta !== '' && $page_id !== -1) {
            if ($page_sidebar_meta == 'no-sidebar') {
                $sidebar_layout = '';
            } else {
                $sidebar_layout = $page_sidebar_meta;
            }
        } else {
            if (is_single() && discussion_options()->getOptionValue('blog_single_sidebar_layout')) {
                $sidebar_layout = esc_attr(discussion_options()->getOptionValue('blog_single_sidebar_layout'));
            } elseif (
                    (is_archive() || (is_home() && is_front_page())) && !(is_author() && $author_sidebar) //if is not author page or author sidebar is inherited (default value)
                    && !(is_category() && $category_sidebar) && !(is_tag() && $tag_sidebar) && discussion_options()->getOptionValue('archive_sidebar_layout')) {
                $sidebar_layout = esc_attr(discussion_options()->getOptionValue('archive_sidebar_layout'));
            } elseif (is_page() && discussion_options()->getOptionValue('page_sidebar_layout')) {
                $sidebar_layout = esc_attr(discussion_options()->getOptionValue('page_sidebar_layout'));
            } elseif (is_category() && $category_sidebar) {
                $sidebar_layout = esc_attr($category_sidebar_layout);
            } elseif (is_author() && $author_sidebar) {
                $sidebar_layout = esc_attr($author_sidebar_layout);
            } elseif (is_tag() && $tag_sidebar) {
                $sidebar_layout = esc_attr($tag_sidebar_layout);
            }
        }

        return $sidebar_layout;
    }

}

if (!function_exists('discussion_container_style')) {

    /**
     * Function that return container style
     */
    function discussion_container_style($style) {
        $id = discussion_get_page_id();
        $class_prefix = discussion_get_unique_page_class();

        $container_selector = array(
            $class_prefix . ' .mkd-wrapper-inner',
            $class_prefix . ' .mkd-content',
            $class_prefix . '.mkd-boxed .mkd-wrapper .mkd-wrapper-inner',
            $class_prefix . '.mkd-boxed .mkd-wrapper .mkd-content',
        );

        $container_class = array();
        $page_backgorund_color = get_post_meta($id, "mkd_page_background_color_meta", true);

        if ($page_backgorund_color) {
            $container_class['background-color'] = $page_backgorund_color;
        }

        $current_style = discussion_dynamic_css($container_selector, $container_class);
        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter('discussion_add_page_custom_style', 'discussion_container_style');
}

if (!function_exists('discussion_boxed_style')) {

    /**
     * Function that return container style
     */
    function discussion_boxed_style($style) {

        $id = discussion_get_page_id();

        $class_prefix = discussion_get_unique_page_class();

        $container_selector = array(
            $class_prefix . '.mkd-boxed'
        );

        $container_style = array();

        if (get_post_meta($id, "mkd_boxed_meta", true) == 'yes') {
            $page_backgorund_color = get_post_meta($id, "mkd_page_background_color_in_box_meta", true);
            $page_backgorund_image = get_post_meta($id, "mkd_boxed_background_image_meta", true);
            $page_backgorund_image_pattern = get_post_meta($id, "mkd_boxed_pattern_background_image_meta", true);
            $page_backgorund_attachment = get_post_meta($id, "mkd_boxed_background_image_attachment_meta", true);

            if ($page_backgorund_color) {
                $container_style['background-color'] = $page_backgorund_color;
            }
            if ($page_backgorund_image) {
                $container_style['background-image'] = 'url(' . $page_backgorund_image . ')';
                $container_style['background-position'] = 'center 0px';
                $container_style['background-repeat'] = 'no-repeat';
            }
            if ($page_backgorund_image_pattern) {
                $container_style['background-image'] = 'url(' . $page_backgorund_image_pattern . ')';
                $container_style['background-position'] = '0px 0px';
                $container_style['background-repeat'] = 'repeat';
            }
            if ($page_backgorund_attachment) {
                $container_style['background-attachment'] = $page_backgorund_attachment;
                if ($page_backgorund_attachment == 'fixed') {
                    $container_style['background-size'] = 'cover';
                } else {
                    $container_style['background-size'] = 'contain';
                }
            }
        }
        $current_style = discussion_dynamic_css($container_selector, $container_style);

        $current_style = $current_style . $style;
        return $current_style;
    }

    add_filter('discussion_add_page_custom_style', 'discussion_boxed_style');
}

if (!function_exists('discussion_post_classic_slider_responsive_style')) {

    /**
     * Function that return container style
     */
    function discussion_post_classic_slider_responsive_style($style) {
        $class_prefix = discussion_get_unique_page_class();

        $container_selector = array(
            $class_prefix . ' .mkd-psc-holder.mkd-psc-full-screen .mkd-psc-slides .mkd-psc-content .mkd-psc-content-inner2'
        );
        $navigation_selector = array(
            $class_prefix . ' .mkd-psc-holder.mkd-psc-full-screen .flex-direction-nav'
        );

        $container_style = array();
        $navigation_style = array();

        $current_style = '@media only screen and (min-width: 1024px) and (max-width: 1400px){';
        $current_style .= discussion_dynamic_css($container_selector, $container_style);
        $current_style .= discussion_dynamic_css($navigation_selector, $navigation_style);
        $current_style .= '}';
        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter('discussion_add_page_custom_style', 'discussion_post_classic_slider_responsive_style');
}

if (!function_exists('discussion_get_unique_page_class')) {

    /**
     * Returns unique page class based on post type and page id
     *
     * @return string
     */
    function discussion_get_unique_page_class() {
        $id = discussion_get_page_id();

        return is_single() ? '.postid-' . $id : '.page-id-' . $id;
    }

}

if (!function_exists('discussion_print_custom_css')) {

    /**
     * Prints out custom css from theme options
     */
    function discussion_print_custom_css() {
        $custom_css = discussion_options()->getOptionValue('custom_css');
        $style = '';
        $custom_css .= apply_filters('discussion_add_page_custom_style', $style);

        if ($custom_css !== '') {
            wp_add_inline_style('discussion_modules', $custom_css);
        }
    }

    add_action('wp_enqueue_scripts', 'discussion_print_custom_css');
}

if (!function_exists('discussion_print_custom_js')) {

    /**
     * Prints out custom css from theme options
     */
    function discussion_print_custom_js() {
        $custom_js = discussion_options()->getOptionValue('custom_js');
        $output = '';

        if ($custom_js !== '') {
            $output .= '<script type="text/javascript" id="discussion-custom-js">';
            $output .= '(function($) {';
            $output .= $custom_js;
            $output .= '})(jQuery)';
            $output .= '</script>';
        }

        print $output;
    }

    add_action('wp_footer', 'discussion_print_custom_js', 1000);
}


if (!function_exists('discussion_get_global_variables')) {

    /**
     * Function that generates global variables and put them in array so they could be used in the theme
     */
    function discussion_get_global_variables() {

        $global_variables = array();
        $element_appear_amount = -150;

        $global_variables['mkdAddForAdminBar'] = is_admin_bar_showing() ? 32 : 0;
        $global_variables['mkdElementAppearAmount'] = discussion_options()->getOptionValue('element_appear_amount') !== '' ? discussion_options()->getOptionValue('element_appear_amount') : $element_appear_amount;
        $global_variables['mkdFinishedMessage'] = esc_html__('No more posts', 'discussionwp');
        $global_variables['mkdMessage'] = esc_html__('Loading new posts...', 'discussionwp');
        $global_variables['mkdAjaxUrl'] = admin_url('admin-ajax.php');

        $global_variables = apply_filters('discussion_js_global_variables', $global_variables);

        wp_localize_script('discussion_modules', 'mkdGlobalVars', array(
            'vars' => $global_variables
        ));
    }

    add_action('wp_enqueue_scripts', 'discussion_get_global_variables');
}

if (!function_exists('discussion_per_page_js_variables')) {

    function discussion_per_page_js_variables() {
        $per_page_js_vars = apply_filters('discussion_per_page_js_vars', array());

        wp_localize_script('discussion_modules', 'mkdPerPageVars', array(
            'vars' => $per_page_js_vars
        ));
    }

    add_action('wp_enqueue_scripts', 'discussion_per_page_js_variables');
}

if (!function_exists('discussion_content_elem_style_attr')) {

    /**
     * Defines filter for adding custom styles to content HTML element
     */
    function discussion_content_elem_style_attr() {
        $styles = apply_filters('discussion_content_elem_style_attr', array());

        discussion_inline_style($styles);
    }

}

if (!function_exists('discussion_is_woocommerce_installed')) {

    /**
     * Function that checks if woocommerce is installed
     * @return bool
     */
    function discussion_is_woocommerce_installed() {
        return function_exists('is_woocommerce');
    }

}

if (!function_exists('discussion_visual_composer_installed')) {

    /**
     * Function that checks if visual composer installed
     * @return bool
     */
    function discussion_visual_composer_installed() {
        //is Visual Composer installed?
        if (class_exists('WPBakeryVisualComposerAbstract')) {
            return true;
        }

        return false;
    }

}

if (!function_exists('discussion_seo_plugin_installed')) {

    /**
     * Function that checks if popular seo plugins are installed
     * @return bool
     */
    function discussion_seo_plugin_installed() {
        //is 'YOAST' or 'All in One SEO' installed?
        if (defined('WPSEO_VERSION') || class_exists('All_in_One_SEO_Pack')) {
            return true;
        }

        return false;
    }

}

if (!function_exists('discussion_contact_form_7_installed')) {

    /**
     * Function that checks if contact form 7 installed
     * @return bool
     */
    function discussion_contact_form_7_installed() {
        //is Contact Form 7 installed?
        if (defined('WPCF7_VERSION')) {
            return true;
        }

        return false;
    }

}

if (!function_exists('discussion_is_wpml_installed')) {

    /**
     * Function that checks if WPML plugin is installed
     * @return bool
     *
     * @version 0.1
     */
    function discussion_is_wpml_installed() {
        return defined('ICL_SITEPRESS_VERSION');
    }

}

if (!function_exists('discussion_content_padding_top')) {

    /**
     * Function that return padding for content
     */
    function discussion_content_padding_top($style) {

        $id = discussion_get_page_id();
        $current_style = '';

        if (is_single()) {
            $post_type = '.postid-';
        } else {
            $post_type = '.page-id-';
        }

        $content_selector = array(
            $post_type . $id . ' .mkd-content .mkd-content-inner > .mkd-container > .mkd-container-inner',
            $post_type . $id . ' .mkd-content .mkd-content-inner > .mkd-full-width > .mkd-full-width-inner',
        );

        $content_class = array();

        $page_padding_top = get_post_meta($id, "mkd_page_content_top_padding", true);

        if ($page_padding_top !== '') {
            if (get_post_meta($id, "mkd_page_content_top_padding_mobile", true) == 'yes') {
                $content_class['padding-top'] = discussion_filter_px($page_padding_top) . 'px!important';
            } else {
                $content_class['padding-top'] = discussion_filter_px($page_padding_top) . 'px';
            }
            $current_style .= discussion_dynamic_css($content_selector, $content_class);
        }

        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter('discussion_add_page_custom_style', 'discussion_content_padding_top');
}

if (!function_exists('discussion_max_image_width_srcset')) {

    /**
     * Set max width for srcset to 1920
     *
     * @return int
     */
    function discussion_max_image_width_srcset() {
        return 1920;
    }

    add_filter('max_srcset_image_width', 'discussion_max_image_width_srcset');
}

if (!function_exists('discussion_get_max_number_of_pages')) {

    /**
     * Function that return max number of posts/pages for pagination
     * @return int
     *
     * @version 0.1
     */
    function discussion_get_max_number_of_pages() {
        global $wp_query;

        $max_number_of_pages = 10; //default value

        if ($wp_query) {
            $max_number_of_pages = $wp_query->max_num_pages;
        }

        return $max_number_of_pages;
    }

}

if (!function_exists('discussion_get_current_object_id')) {

    /**
     * Function that return current object id
     * @return int
     *
     * @version 0.1
     */
    function discussion_get_current_object_id() {
        global $wp_query;

        $current_object_id = -1; //default value

        if ($wp_query) {
            $current_object_id = $wp_query->get_queried_object_id();
        }

        return $current_object_id;
    }

}

if (!function_exists('discussion_get_blog_page_range')) {

    /**
     * Function that return current page for blog list pagination
     * @return int
     *
     * @version 0.1
     */
    function discussion_get_blog_page_range() {
        global $wp_query;

        if (discussion_options()->getOptionValue('blog_page_range') != "") {
            $blog_page_range = esc_attr(discussion_options()->getOptionValue('blog_page_range'));
        } else {
            $blog_page_range = $wp_query->max_num_pages;
        }

        return $blog_page_range;
    }

}

/**
 * Author - Akilan
 * Update - 20-06-2016
 * Purpose - For retrieve video id and generate video url
 */
if (!function_exists('get_videoid_from_url')) {

    function get_videoid_from_url($url) {
        $arg = array();
        $videoId = "";
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
            $url_string = parse_url($url, PHP_URL_QUERY);
            parse_str($url_string, $args);
            $arg['video_url'] = 'http://www.youtube.com/embed/';
            $arg['video_src'] = 'youtube';
            $url = isset($args['v']) ? $arg['video_url'] . $args['v'] : false;
        } else if (preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/", $url, $output_array)) {
            $urlParts = explode("/", parse_url($url, PHP_URL_PATH));
            $arg['video_url'] = 'http://player.vimeo.com/video/';
            $url = $arg['video_url'] . $arg['video_id'] = (int) $urlParts[count($urlParts) - 1];
        } elseif (preg_match('%https*://.*(?:wistia\.com|wi\.st)/(?:medias|embed)/(.*?)\?%', $url, $matched)) {
            $videoId = $matched[1];
            $arg['video_url'] = 'http://fast.wistia.net/embed/iframe/';
            $arg['video_id'] = $videoId . '?videoFoam=true';
            $url = $arg['video_url'] . $arg['video_id'];
        }
        return array($videoId, $url);
    }

}


/**
 * Author -Akilan
 * Date  - 20-06-2016
 * Purpose -  For custom template featured query
 */
if (!function_exists('discussion_custom_featured_query')) {

    function discussion_custom_featured_query($category) {
        $args1 = array(
            'category_name' => $category,
            'post_status' => 'publish',
            'order' => 'DESC',
            'posts_per_page' => 1
        );
        return $result = query_posts($args1);
    }

}


/**
 * Author - Akilan
 * Date - 20-07-2016
 * Purpose - For getting category based post except from followed categories
 */
if (!function_exists('follow_categorypost_detail')) {

    function follow_categorypost_detail($post_type, $subcat_id_sgl, $display_postid_ar) {
        $posts = get_posts(array(
            'post_type' => $post_type,
            'cat' => $subcat_id_sgl,
            'order' => 'DESC',
            'posts_per_page' => 2,
            'post__not_in' => $display_postid_ar
        ));
        return $posts;
    }

}




/**
 * Author - Akilan
 * Date  - 21-07-2016
 * Purpose - For displaying unfollow category detail
 */
if (!function_exists('unfollow_categorypost_detail')) {

    function unfollow_categorypost_detail($post_type, $category, $display_postid_ar, $post_per_section) {
        $args = array(
            'cat' => $category,
            'post_status' => 'publish',
            'order' => 'cat',
            'post_type' => $post_type,
            'posts_per_page' => $post_per_section,
            'post__not_in' => $display_postid_ar,
            'paged' => 1,
        );
        return $my_query = query_posts($args);
    }

}

/**
 * Author - Akilan
 * Date - 22-07-2016
 * Purpose - For calling home page followed article scroll based template
 */
function follow_category_scroll() {
    get_template_part('block/followed-scroll-article');
    exit;
}

add_action('wp_ajax_follow_category_scroll', 'follow_category_scroll');
add_action('wp_ajax_nopriv_follow_category_scroll', 'follow_category_scroll');

/**
 * Author - Akilan
 * Date - 22-07-2016
 * Purpose - For category tag display with parent category remove if subcategory exist
 */
function organize_catgory($id) {
    $getPostcat = wp_get_post_categories($id);
    $getResultset = check_cat_subcat($getPostcat);
    count($getResultset);
    $j = 1;
    $out = "";
    foreach ($getResultset as $getKeyrel) {
        $out.='<a href="' . get_category_link($getKeyrel) . '">';
        $out.=get_cat_name($getKeyrel) . '</a>';
        if ($j > count($getResultset) - 1) {
            echo "";
        } else {
            $out.= "\x20/\x20";
        }
        $j++;
    }
    return $out;
}

/**
 * 
 * Author -Akilan
 * Date  - 20-06-2016
 * Purpose -  For featured template image background
 */
if (!function_exists('discussion_custom_getImageBackground')) {

    function discussion_custom_getImageBackground($id) {
        $background_image_style = '';

        $background_image = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full');

        if (count($background_image) && is_array($background_image)) {
            $background_image_style = 'background-image: url(' . $background_image[0] . ')';
        }

        return $background_image_style;
    }

}

/**
 * Author -Akilan
 * Date  - 20-06-2016
 * purpose-  Returns title tag for smaller posts
 */
if (!function_exists('discussion_custom_gettitletagsmaller')) {

    function discussion_custom_gettitletagsmaller($params) {
        $title_tag = 'h4';

        switch ($params['title_tag']) {
            case 'h1':
                $title_tag = 'h2';
                break;
            case 'h2':
                $title_tag = 'h3';
                break;
            case 'h3':
                $title_tag = 'h4';
                break;
            case 'h4':
                $title_tag = 'h5';
                break;
            case 'h5':
                $title_tag = 'h6';
                break;
            case 'h6':
                $title_tag = 'h6';
                break;
            default:
                $title_tag = 'h4';
                break;
        }

        return $title_tag;
    }

}

/**
 * Author -Akilan
 * Date  - 20-06-2016
 * get data of attributes
 * @param type $params
 * @param type $atts
 * @return string
 */
if (!function_exists('discussion_custom_getData')) {

    function discussion_custom_getData($params, $atts) {
        $data = '';

        if ($params['slider_height'] !== '') {
            $data .= 'data-image-height=' . esc_attr($params['slider_height']) . ' ';
        }

        if ($atts['number_of_posts'] !== '') {
            $data .= 'data-posts-no=' . esc_attr($atts['number_of_posts']) . ' ';
        }

        return $data;
    }

}

/** Author -Akilan
 *  Date  - 20-06-2016
 *  purpose - For implementing custom template image params detail
 * @param type $id
 * @return string
 */
if (!function_exists('discussion_custom_getImageParams')) {

    function discussion_custom_getImageParams($id) {
        $params = array();
        $params['proportion'] = 1;
        $params['background_image'] = '';
        $params['background_image_thumbs'] = '';

        $background_image = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full');
        $background_image_thumbs = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'discussion_landscape');

        if (count($background_image) && is_array($background_image)) {
            $width = $background_image[1];
            $height = $background_image[2];
            $params['proportion'] = $height / $width; //get height/width proportion
            $params['background_image'] = 'background-image: url(' . $background_image[0] . ')';
        }

        if (count($background_image_thumbs) && is_array($background_image_thumbs)) {
            $params['background_image_thumbs'] = 'background-image: url(' . $background_image_thumbs[0] . ')';
        }

        return $params;
    }

}


/**
 * Author -Akilan
 * Date  - 20-06-2016
 * purpose - For implementing custom category template for getting category image detail
 * 
 * @param type $id
 * @return string
 */
if (!function_exists('discussion_custom_categoryImageParams')) {

    function discussion_custom_categoryImageParams($id) {
        $params = array();
        $params['proportion'] = 1;
        $params['background_image'] = '';
        $params['background_image_thumbs'] = '';
        $url = z_taxonomy_image_url($id);
        $background_image_url = wp_get_attachment_image_src($url, 'full');
        if ($url != "") {
            $background_image = getimagesize($url);
        }

        $background_image_thumbs = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'discussion_landscape');

        if (count($background_image) && is_array($background_image)) {
            $width = $background_image[0];
            $height = $background_image[1];
            $params['proportion'] = $height / $width; //get height/width proportion
            $params['background_image'] = 'background-image: url(' . $url . ')';
        }

        if (count($background_image_thumbs) && is_array($background_image_thumbs)) {
            $params['background_image_thumbs'] = 'background-image: url(' . $background_image_thumbs[0] . ')';
        }

        return $params;
    }

}

/**
 * Author -Akilan
 * Date  - 20-06-2016
 * Purpose - For custom template for category query
 * paramater
 * $post_type => type of post
 * $category =>category name
 * $post_per_section => post per page
 */
if (!function_exists('discussion_custom_category_query')) {

    function discussion_custom_category_query($post_type, $category, $post_per_section) {
        $args = array(
            'category_name' => $category,
            'post_status' => 'publish',
            'order' => 'DESC',
            'post_type' => $post_type,
            'posts_per_page' => $post_per_section,
            'paged' => 1
        );
        return $my_query = query_posts($args);
    }

}

/**
 * Author - Akilan
 * Date - 20-06-2016
 * Purpose - For custom template for category query 
 */
if (!function_exists('discussion_custom_categorylist_query')) {

    function discussion_custom_categorylist_query($post_type, $category, $post_per_section) {
        $args = array(
            'cat' => $category,
            'post_status' => 'publish',
            'order' => 'DESC',
            'post_type' => $post_type,
            'posts_per_page' => $post_per_section,
            'paged' => 1
        );
        return $my_query = query_posts($args);
    }

}

/**
 * Author - Akilan
 * Date - 20-06-2016
 * Purpose - Custom function for changing image post reating extension
 */
function custom_rating_image_extension() {
    return 'png';
}

add_filter('wp_postratings_image_extension', 'custom_rating_image_extension');

/**
 * Returns ID of top-level parent category, or current category if you are viewing a top-level
 *
 * @param	string		$catid 		Category ID to be checked
 * @return 	string		$catParent	ID of top-level parent category
 */
if (!function_exists('category_top_parent_id')) {

    function category_top_parent_id($catid) {

        while ($catid) {
            $cat = get_category($catid); // get the object for the catid
            $catid = $cat->category_parent; // assign parent ID (if exists) to $catid
            // the while loop will continue whilst there is a $catid
            // when there is no longer a parent $catid will be NULL so we can assign our $catParent
            $catParent = $cat->cat_ID;
        }

        return $catParent;
    }

}

/* *
 * 
 * Purpose: Enable PHP in widgets
 * Author: Ramkumar.S 
 * Date : 20 June 2016
 * Last Modified : 20 June 2016
 * */

add_filter('widget_text', 'execute_php', 100);

function execute_php($html) {
    if (strpos($html, "<" . "?php") !== false) {
        ob_start();
        eval("?" . ">" . $html);
        $html = ob_get_contents();
        ob_end_clean();
    }
    return $html;
}

/**
 * Purpose: Enable Additional Fields for users
 * Author: Ramkumar S
 * Create Date: June 1, 2016
 * Last Modified: June 23, 2016
 *
 */
function modify_contact_methods($profile_fields) {

    // Add new fields
    $profile_fields['twitter'] = 'Twitter Username';
    $profile_fields['facebook'] = 'Facebook URL';
    $profile_fields['dob'] = 'Date of Birth';
    $profile_fields['phone'] = 'Phone';
    $profile_fields['address'] = 'Address';
    $profile_fields['city'] = 'City';
    $profile_fields['state'] = 'State';
    $profile_fields['postalcode'] = 'Postal Code';

    return $profile_fields;
}

add_filter('user_contactmethods', 'modify_contact_methods');

/* *
 * 
 * Purpose: Public Profile
 * Author: Ramkumar.S 
 * Date : 22 June 2016
 * Last Modified : 22 June 2016
 * */

// Create the query var so that WP catches the custom /member/username url
function userpage_rewrite_add_var($vars) {
    $vars[] = 'public';
    return $vars;
}

add_filter('query_vars', 'userpage_rewrite_add_var');

// Create the rewrites
function userpage_rewrite_rule() {
    add_rewrite_tag('%public%', '([^&]+)');
    add_rewrite_rule(
            '^public/([^/]*)/?', 'index.php?public=$matches[1]', 'top'
    );
}

add_action('init', 'userpage_rewrite_rule');

// Catch the URL and redirect it to a template file
function userpage_rewrite_catch() {
    global $wp_query;

    if (array_key_exists('public', $wp_query->query_vars)) {
        include (TEMPLATEPATH . '/public-profile.php');
        exit;
    }
}

add_action('template_redirect', 'userpage_rewrite_catch');


/**
 * Author- Vinoth Raja
 * Date  - 21-06-2016
 * Purpose - For related videos using tags
 */
if (!function_exists('custom_related_posts')) {

    function custom_related_posts($post_id, $post_type, $tag_ids) {

        $posts_per_page = 5;

        $args = array(
            'post__not_in' => array($post_id),
            'post_type' => $post_type,
            'tag_id' => implode(",", $tag_ids),
            'order' => 'DESC',
            'orderby' => 'date',
            'posts_per_page' => $posts_per_page
        );

        $related_posts = query_posts($args);

        return $related_posts;
    }

}

/**
 * Author- Muthupandi
 * Create Date  - 23-06-2016
 * Updated Date - 01-08-2016
 * Purpose - Related to Author Recommended posts section
 */
add_action('init', 'discussion_author_recommended_posts');

function discussion_author_recommended_posts() {

    //Remove default short code
    remove_shortcode('AuthorRecommendedPosts');
    global $AuthorRecommendedPosts;
    remove_action('add_meta_boxes', array($AuthorRecommendedPosts,'add_recommended_meta_box'));

    //Create class and extend author recommended post class to override author recommended section design
    class DiscussionAuthorRecommendPosts extends AuthorRecommendedPosts {

        function __construct() {

            $this->option_name = '_' . $this->namespace . '--options';
            add_shortcode('AuthorRecommendedPosts', array(&$this, 'shortcode'));
            add_action( 'add_meta_boxes', array( &$this, 'add_recommended_meta_box' ) );
        }

        function shortcode($atts) {
            global $post;
            $namespace = $this->namespace;

            if (isset($atts['post_id']) && !empty($atts['post_id'])) {
                $shortcode_post_id = $atts['post_id'];
            } else {
                $shortcode_post_id = $post->ID;
            }

            $recommended_ids = get_post_meta($shortcode_post_id, $namespace, true);

            $html = '';

            if ($recommended_ids) {

                $html_title = $this->get_option("{$namespace}_title");
                $show_title = $this->get_option("{$namespace}_show_title");
                $show_featured_image = $this->get_option("{$namespace}_show_featured_image");
                $format_horizontal = $this->get_option("{$namespace}_format_is_horizontal");
                $author_recommended_posts_post_types = $this->get_option("{$namespace}_post_types");

                ob_start();
                include('custom_author-recommended-posts-list.php' );
                $html .= ob_get_contents();
                ob_end_clean();
            }

            return $html;
        }
        
        function add_recommended_meta_box() {
            // set post_types that this meta box shows up on.
            $author_recommended_posts_post_types = $this->get_option( "{$this->namespace}_post_types" );

            foreach( $author_recommended_posts_post_types as $author_recommended_posts_post_type ) {
                // adds to posts $post_type
                add_meta_box( 
                    $this->namespace . '-recommended_meta_box',
                    __( 'Author Recommended Posts', $this->namespace ),
                    array( &$this, 'recommended_meta_box' ),
                    $author_recommended_posts_post_type,
                    'side',
                    'high'
                );
            }

        }
        
        function recommended_meta_box( $object, $box ) {
        
        $author_recommended_posts = get_post_meta( $object->ID, $this->namespace, true );
        $author_recommended_posts_post_types = $this->get_option( "{$this->namespace}_post_types" );
        $author_recommended_posts_search_results = $this->author_recommended_posts_search();
        $author_recommended_posts_options_url = admin_url() . '/options-general.php?page=' . $this->namespace;
        
        include( AUTHOR_RECOMMENDED_POSTS_DIRNAME . '/views/_recommended-meta-box.php' );
    }
    
    function author_recommended_posts_search(){
        global $post;
        $post_id = $post->ID;
        $html = '';
        
        // set post_types that get filtered in the search box.
        $author_recommended_posts_post_types = $this->get_option( "{$this->namespace}_post_types" );
        
        // set default query options
        $options = array(
            'post_type' =>  $author_recommended_posts_post_types,
            'posts_per_page' => '-1',
            'paged' => 0,
            'order' => 'DESC',
            'post_status' => array('publish'),
            'suppress_filters' => false,
            'post__not_in' => array($post_id),
            's' => ''
        );
        
        // check if ajax
        $ajax = isset( $_POST['action'] ) ? true : false;
        
        // if ajax merge $_POST
        if( $ajax ) {
            $options = array_merge($options, $_POST);
        }
        
        // search
        if( $options['s'] ) {
            // set temp title to search query
            $options['like_title'] = $options['s'];
            // filter query by title
            add_filter( 'posts_where', array($this, 'posts_where'), 10, 2 );
        }
        
        // unset search so results are accurate and not muddled 
        unset( $options['s'] );
        
        $searchable_posts = get_posts( $options );
        
        if( $searchable_posts ) {
            foreach( $searchable_posts as $searchable_post ) {
                // right aligned info
                $title = '<span class="recommended-posts-post-type">';
                $title .= $searchable_post->post_type;
                $title .= '</span>';
                $title .= '<span class="recommended-posts-title">';
                $title .= apply_filters( 'the_title', $searchable_post->post_title, $searchable_post->ID );
                $title .= '</span>';
                
                $html .= '<li><a href="' . get_permalink($searchable_post->ID) . '" data-post_id="' . $searchable_post->ID . '">' . $title .  '</a></li>' . "\n";
            }
        }
        
        // if ajax, die and echo $html otherwise just return
        if( $ajax ) {
            die( $html );
        } else {
            return $html;
        }
    }
    
    

    }

    $DiscussionAuthorRecommedPost = new DiscussionAuthorRecommendPosts();
}

/* *
 * 
 * Purpose: Login direct after login 
 * Author: Ramkumar.S 
 * Date : 24 June 2016
 * Last Modified : 24 June 2016
 * */

function redirect_login_page() {
    // Store for checking if this page equals wp-login.php
    $page_viewed = basename($_SERVER['REQUEST_URI']);
    // permalink to the custom login page
    $login_page = home_url('/login');
    $register_page = home_url('/register');

    if ($page_viewed == "wp-login.php") {
        wp_redirect($login_page);
        exit();
    }
    if ($page_viewed == "wp-signup.php") {
        wp_redirect($register_page);
        exit();
    }
}

add_action('init', 'redirect_login_page');

/* *
 * 
 * Purpose: Disable top menu based on admin/super admin role
 * Author: Ramkumar.S 
 * Date : 24 June 2016
 * Last Modified : 27 June 2016
 * */

if ((current_user_can('administrator') && is_admin()) || (is_super_admin())) {
    show_admin_bar(true);
} else {
    show_admin_bar(false);
}

/**
 * Author - Akilan
 * Date - 22-06-2015
 * Purpose - For implementing scroll based post loading
 */
function custom_scroll_post_load() {
    get_template_part('scroll-article');
    exit;
}

add_action('wp_ajax_custom_scroll_post_load', 'custom_scroll_post_load');
add_action('wp_ajax_nopriv_custom_scroll_post_load', 'custom_scroll_post_load');

/**
 * Author -Akilan
 * Date  - 22-06-2016
 * Purpose - For custom template for category query
 */
if (!function_exists('discussion_home_custom_category_query')) {

    function discussion_home_custom_category_query($type, $category, $per_page = 6) {
        $args = array(
            'category_name' => $category,
            'post_status' => 'publish',
            'order' => 'DESC',
            'post_type' => $type,
            'posts_per_page' => $per_page,
            'paged' => 1
        );
        return $my_query = query_posts($args);
    }

}



/**
 * Author- Vinoth Raja
 * Date  - 25-06-2016
 * Purpose - For forgot password functionality
 */
add_action('wp_ajax_nopriv_ajax_forgotPassword', 'ajax_forgotPassword');

add_action('wp_ajax_ajax_forgotPassword', 'ajax_forgotPassword');

function ajax_forgotPassword() {
    check_ajax_referer('fp-ajax-nonce', 'security');

    global $wpdb;

    $account = $_POST['user_email'];

    if (empty($account)) {
        $error = '<div class="error">Lost your password? Please enter your email address.</div>';
    } else {
        if (is_email($account)) {

            if (email_exists($account))
                $get_by = 'email';
            else
                $error = '<div class="error">Please enter your valid email address.</div>';
        } else
            $error = '<div class="error">Invalid e-mail address.</div>';
    }

    if (empty($error)) {

        $random_password = wp_generate_password();

        $user = get_user_by($get_by, $account);

        $update_user = wp_update_user(array('ID' => $user->ID, 'user_pass' => $random_password));

        if ($update_user) {

            $from = get_option('admin_email');

            $to = $user->user_email;
            $subject = 'myEvergreenWellness';
            $sender = 'From: ' . get_option('name') . ' <' . $from . '>' . "\r\n";

            $message = 'Hi '. $user->user_nicename .',<br>We received a request for password change. Your new password is: ' . $random_password.'<br>Please use this password for further login.<br>Thanks!';

            $headers[] = 'MIME-Version: 1.0' . "\r\n";
            $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers[] = "X-Mailer: PHP \r\n";
            $headers[] = $sender;

            $mail = wp_mail($to, $subject, $message, $headers);
            if ($mail) {
                $success = '<div class="frp-success">You will received a new password via email.<div>';
            } else
                $error = '<div class="error">System is unable to send you mail containg your new password.</div>';
        } else {
            $error = '<div class="error">Oops! Something went wrong while updaing your account.</div>';
        }
    }

    if (!empty($error))
        echo $error;

    if (!empty($success))
        echo $success;

    die();
}

/**
 * Author : Akilan
 * Date : 28-06-2016
 * Purpose - For maintaing common variables and functionalities for scroll based post loading
 * First parameter => per page section
 * second parameter => post type
 */
function scroll_loadpost_settings() {
    return array(6, array('post', 'videos'));
}

/**
 * Author : Vinoth Raja
 * Date : 02-07-2016
 * Purpose - For display comment section with loggined user profile image
 */
function custom_comment($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;
    global $post;

    $is_pingback_comment = $comment->comment_type == 'pingback';
    $is_author_comment = $post->post_author == $comment->user_id;

    $comment_class = 'mkd-comment clearfix';

    if ($is_author_comment) {
        $comment_class .= ' mkd-post-author-comment';
    }

    if ($is_pingback_comment) {
        $comment_class .= ' mkd-pingback-comment';
    }
    ?>
    <li>
        <div class="<?php echo esc_attr($comment_class); ?>">
            <?php if (!$is_pingback_comment) { ?>
                <div class="mkd-comment-image"> 
                    <?php
                    $user = $comment->user_id;
                    $custom_avatar_meta_data = get_user_meta($user, 'custom_avatar');
                    if (isset($custom_avatar_meta_data) && !empty($custom_avatar_meta_data[0])):
                        $attachment = wp_get_attachment_image_src($custom_avatar_meta_data[0]);
                        ?>
                        <img src="<?php echo $attachment[0]; ?>" width="85px" height="85px"/>
                    <?php else : ?>                                                    
                        <img src="<?php echo MIKADO_ASSETS_ROOT . '/img/aavathar.jpg' ?>" width="85px" height="85px" />
                    <?php endif; ?>
                </div>
            <?php } ?>
            <div class="mkd-comment-text-and-info">
                <div class="mkd-comment-info-and-links">
                    <h6 class="mkd-comment-name">
                        <?php
                        if ($is_pingback_comment) {
                            esc_html_e('Pingback:', 'discussionwp');
                        }
                        $user_name = get_user_meta($user);
                        ?><span class="mkd-comment-author"><?php if(!empty($user_name['first_name'][0])&&!empty($user_name['first_name'][0])){ echo $user_name['first_name'][0] . ' ' . $user_name['last_name'][0]; } else { echo wp_kses_post(get_comment_author_link()); } ?></span>
                        <?php if ($is_author_comment) { ?>
                            <span class="mkd-comment-mark"><?php esc_html_e('/', 'discussionwp'); ?></span>
                            <span class="mkd-comment-author-label"><?php esc_html_e('Author', 'discussionwp'); ?></span>
                        <?php } ?>
                    </h6>
                    <h6 class="mkd-comment-links">
                        <?php if (!is_user_logged_in()) : ?>
                            <a href="<?php echo home_url('/login') ?>"><?php _e('Login To Reply', 'discussionwp'); ?></a>
                            <?php
                        else :
                            $userid = get_current_user_id();
                            $user_blog_id = get_user_meta($userid, 'primary_blog', true);
                            $blog_id = get_current_blog_id();
                            if ($blog_id != $user_blog_id):
                                ?>
                                <a href="<?php echo home_url('/login') ?>"><?php _e('Login To Reply', 'discussionwp'); ?></a>                                                                   
                                <?php
                            else :
                                comment_reply_link(array_merge($args, array('reply_text' => esc_html__('Reply', 'discussionwp'), 'depth' => $depth, 'max_depth' => $args['max_depth'])));
                            endif;
                        endif;
                        ?>
                        <span class="mkd-comment-mark"><?php esc_html_e('/', 'discussionwp'); ?></span>
                        <?php
                        edit_comment_link(esc_html__('Edit', 'discussionwp'));
                        ?>
                    </h6>
                </div>
                <?php if (!$is_pingback_comment) { ?>
                    <div class="mkd-comment-text">
                        <div class="mkd-text-holder" id="comment-<?php echo comment_ID(); ?>">
                            <?php comment_text(); ?>
                            <span class="mkd-comment-date"><?php comment_time(get_option('date_format')); ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }

    function SocialNetworkShareLink($net, $image) {

        switch ($net) {
            case 'facebook':
                $link = 'window.open(\'http://www.facebook.com/sharer/sharer.php?s=100&amp;p[title]=' . urlencode(discussion_addslashes(get_the_title())) . '&amp;p[summary]=' . urlencode(discussion_addslashes(get_the_excerpt())) . '&amp;u=' . urlencode(get_permalink()) . '/' . rand() . '&amp;p[images][0]=' . $image[0] . '&v=' . rand() . '\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');';
                break;
            case 'twitter':
                $count_char = (isset($_SERVER['https'])) ? 23 : 22;
                $twitter_via = (discussion_options()->getOptionValue('twitter_via') !== '') ? ' via ' . discussion_options()->getOptionValue('twitter_via') . ' ' : '';
                $link = 'window.open(\'https://twitter.com/intent/tweet?text='. urlencode(discussion_addslashes(get_the_title())) .'&url=' . urlencode(discussion_the_excerpt_max_charlength($count_char) . $twitter_via) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'google_plus':
                $link = 'popUp=window.open(\'https://plus.google.com/share?url=' . urlencode(get_permalink()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'linkedin':
                $link = 'popUp=window.open(\'http://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'tumblr':
                $link = 'popUp=window.open(\'http://www.tumblr.com/share/link?url=' . urlencode(get_permalink()) . '&amp;name=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'pinterest':
                $link = 'popUp=window.open(\'http://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . discussion_addslashes(get_the_title()) . '&amp;media=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'vk':
                $link = 'popUp=window.open(\'http://vkontakte.ru/share.php?url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '&amp;image=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            default:
                $link = '';
        }

        return $link;
    }

    /**
     * Author - Akilan 
     * Date - 08-07-2016
     * Purpose - For adding thumb image for facebook sharing
     */
    add_action('wp_head', 'fbfixheads');

    function fbfixheads() {
        global $post;
        $ftf_head = "";
        if (has_post_thumbnail()) {
            $featuredimg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "Full");
            $ftf_description = get_the_excerpt($post->ID);
            $ftf_head = '
        <!--/ Facebook Thumb Fixer Open Graph /-->
        <meta property="og:type" content="' . $default . '" />
        <meta property="og:url" content="' . get_permalink() . '" />
        <meta property="og:title" content="' . wp_kses_data(get_the_title($post->ID)) . '" />
        <meta property="og:description" content="' . wp_kses($ftf_description, array()) . '" />
        <meta property="og:site_name" content="' . wp_kses_data(get_bloginfo('name')) . '" />
        <meta property="og:image" content="' . $featuredimg[0] . '" />

        <meta itemscope itemtype="' . $default . '" />
        <meta itemprop="description" content="' . wp_kses($ftf_description, array()) . '" />
        <meta itemprop="image" content="' . $featuredimg[0] . '" />
        ';
        }
        echo $ftf_head;
    }

    /**
     * Author - Akilan
     * Date - 11-07-2016
     * Purpose - For getting main category name
     */
    function main_category_name() {
        return array('activity', 'medical', 'financial', 'relationships', 'nutrition', 'mind-spirit');
    }

    /**
     * Author - Akilan
     * Date - 11-07-2016
     * Purpose - For getting category id from category name
     */
    function get_main_category_detail() {
        $cat_ar = main_category_name();
        if (!empty($cat_ar)) {
            foreach ($cat_ar as $our_cat_each) {
                $cat = get_term_by('slug', $our_cat_each, 'category');
                if ($cat) {
                    $cat_id_ar[$cat->term_id] = $cat->term_id;
                }
            }
        }
        return $cat_id_ar;
    }

    /**
     * Author - Akilan
     * Date  - 11-07-2016
     * Purpose - For hiding pages from search
     * 
     */
    function remove_pages_from_search() {
        global $wp_post_types;
        $wp_post_types['page']->exclude_from_search = true;
    }

    add_action('init', 'remove_pages_from_search');

    /**
     * Author - Vinoth Raja
     * Date  - 14-07-2016
     * Purpose - For adding comment approved email functionality
     * 
     */
    add_filter('wp_mail_content_type', create_function('', 'return "text/html"; ')); //for adding html content in wp_mail
//for except admin users
    add_action('wp_set_comment_status', 'custom_set_comment_status', 10, 2);

    function custom_set_comment_status($comment_id, $comment_status) {
        if ($comment_status == 'approve') {
            $comment = get_comment($comment_id);
            if ($comment->comment_parent) {
                $parent_comment = get_comment($comment->comment_parent);
                wp_mail($parent_comment->comment_author_email, 'myEvergreenWellness', 'New comment on your post ' . get_the_title($comment->comment_post_ID) . '<br>Author:' . $comment->comment_author . '<br>Email:' . $comment->comment_author_email . '<br>Comment:' . $comment->comment_content . '<br>You can see all comments on this post here:' . get_comment_link($comment->comment_ID));
            }
        }
    }

//for admin user
    add_action('comment_post', 'notify_author_of_reply', 10, 2);

    function notify_author_of_reply($comment_id, $approved) {
        if ($approved === 1) {
            $comment = get_comment($comment_id);
            if ($comment->comment_parent) {
                $parent_comment = get_comment($comment->comment_parent);
                wp_mail($parent_comment->comment_author_email, 'myEvergreenWellness', 'New comment on your post ' . get_the_title($comment->comment_post_ID) . '<br>Author:' . $comment->comment_author . '<br>Email:' . $comment->comment_author_email . '<br>Comment:' . $comment->comment_content . '<br>You can see all comments on this post here:' . get_comment_link($comment->comment_ID));
            }
        }
    }

    /**
     * Author - Akilan
     * Date  - 14-07-2016
     * Purpose - change link layout to have a pipe prepended (safety comment)
     */
    add_filter('safe_report_comments_flagging_link', 'adjust_flagging_link');

    function adjust_flagging_link($link) {
        return ' / ' . $link;
    }

    /**
     * Author - Akilan
     * Date - 15-07-2016
     * Purpose - for set out class article title based on fixed heights
     */
    function article_title_class() {
        global $wp_query;
        $next_post = $wp_query->posts[$wp_query->current_post + 1];
        $next_next_post = $wp_query->posts[$wp_query->current_post + 2];
        $data = array(get_the_title(), $next_post->post_title, $next_next_post->post_title);
        return get_title_class($data);
    }

    /**
     * Author - Akilan
     * Date - 18-07-2016
     * Purpose - Fetch next and next most article for scroll based article load
     */
    function next_post_scrollarticle($blog_title_ar, $i) {
        $current = isset($blog_title_ar[$i]) ? $blog_title_ar[$i] : "";
        $next_title = isset($blog_title_ar[$i + 1]) ? $blog_title_ar[$i + 1] : "";
        $next_next_title = isset($blog_title_ar[$i + 2]) ? $blog_title_ar[$i + 2] : "";
        $data = array($current, $next_title, $next_next_title);
        return get_title_class($data);
    }

    /**
     * Author - Akilan
     * Date - 18-07-2016
     * Purpose - For setting class based on title length
     */
    function get_title_class($data) {
        $lengths = array_map('strlen', $data);
        $max_length = max($lengths);
        switch ($max_length) {
            case $max_length > 75:
                return 'title_length_four';
                break;
            case $max_length > 50 && $max_length <= 75:
                return 'title_length_three';
                break;
            case $max_length <= 50 && $max_length > 25:
                return 'title_length_two';
                break;
            case $max_length <= 25:
                return 'title_length_one';
                break;
        }
    }

    /**
     * Author - Rajasingh
     * Date  - 15-07-2016
     * Purpose - Check the post contains both category and subcategory.
     */
    function check_cat_subcat($getPostcat) {
        $temp_cat = array_flip($getPostcat);
        foreach ($temp_cat as $key => $val) {
            $top_parent = category_top_parent_id($key);
            if ($top_parent != $key) {
                if (isset($temp_cat[$top_parent]))
                    unset($temp_cat[$top_parent]);
            }
        }
        $temp_catval = array_flip($temp_cat);
        return $temp_catval;
    }

    /**
     * Author - Vinoth Raja
     * Date  - 16-07-2016
     * Purpose - For customizing wp_favorite_posts plugin for remove star from remove favorites section  
     * 
     */
    function customized_saved_stories() {
        global $post;
        $post_id = &$post->ID;
        extract($args);
        $str = "";
        if ($show_span)
            $str = "<span class='wpfp-span'>";
        $str .= wpfp_before_link_img();
        $str .= wpfp_loading_img();
        if ($action == "remove"):
            $str .= "<a class='wpfp-link' href='?wpfpaction=remove&amp;postid=" . esc_attr($post_id) . "' title='" . wpfp_get_option('remove_favorite') . "' rel='nofollow'>" . wpfp_get_option('remove_favorite') . "</a>";
        elseif ($action == "add"):
            $str .= "<i class='fa fa-star-o' aria-hidden='true'></i><a class='wpfp-link' href='?wpfpaction=add&amp;postid=" . esc_attr($post_id) . "' title='" . wpfp_get_option('add_favorite') . "' rel='nofollow'>" . wpfp_get_option('add_favorite') . "</a>";
        elseif (wpfp_check_favorited($post_id)):
            $str .= "<a class='wpfp-link' href='?wpfpaction=remove&amp;postid=" . esc_attr($post_id) . "' title='" . wpfp_get_option('remove_favorite') . "' rel='nofollow'>" . wpfp_get_option('remove_favorite') . "</a>";
        else:
            $str .= "<i class='fa fa-star-o' aria-hidden='true'></i><a class='wpfp-link' href='?wpfpaction=add&amp;postid=" . esc_attr($post_id) . "' title='" . wpfp_get_option('add_favorite') . "' rel='nofollow'>" . wpfp_get_option('add_favorite') . "</a>";
        endif;
        if ($show_span)
            $str .= "</span>";
        if ($return) {
            return $str;
        } else {
            echo $str;
        }
    }

    /**
     * Author - Vinoth Raja
     * Date  - 19-07-2016
     * Purpose - For Disabling WordPress comment flood prevention  
     * 
     */
    add_filter('comment_flood_filter', '__return_false');

    /**
     * Created By   - Muthupandi
     * Created Date - 20-07-2016
     * Updated By   - Muthupandi 
     * Updated Date - 20-07-2016
     * Purpose      - For implementing append saved articles while click 'load more' button
     */
    function custom_scroll_saved_articles_load() {
        get_template_part('block/saved-articles');
        exit;
    }

    add_action('wp_ajax_custom_scroll_saved_articles_load', 'custom_scroll_saved_articles_load');
    add_action('wp_ajax_nopriv_custom_scroll_saved_articles_load', 'custom_scroll_saved_articles_load');

    /**
     * Created By   - Rajasingh
     * Created Date - 25-07-2016
     * Updated By   - Rajasingh 
     * Updated Date - 25-07-2016
     * Purpose      - Getting username using user email address
     */
    function login_with_email_address($username) {
        $user = get_user_by('email', $username);
        $userDetails = $user->data;
        // print_r($userDetails->user_login);
        // exit;
        if (!empty($userDetails->user_login))
            $user_username = $userDetails->user_login;
        return $user_username;
    }

    add_action('init', 'login_with_email_address');

    /**
     * Created By   - Ramkumar.S
     * Created Date - 27-07-2016
     * Updated By   - Ramkumar.S 
     * Updated Date - 27-07-2016
     * Purpose      - Add Find Branch/Join link to naviagation menu
     */
//    function add_login_logout_to_menu($items, $args) {
//        //change theme location with your them location name
//        if (is_admin())
//            return $items;
//
//        $redirect = ( is_home() ) ? home_url('/') : home_url('/');
//        $homeurl = home_url('/');
//        if (!is_user_logged_in()  && get_current_blog_id()==1)
//            $link = '<a class="" href="' . $homeurl . 'register"><span class="item_outer"><span class="item_inner"><span class="menu_icon_wrapper"><i class="menu_icon blank fa"></i></span><span class="item_text">Join</span></span></span></a>';
//        // else  
//        //  $link = '<a class="" href="' . $homeurl . 'register"><span class="item_outer"><span class="item_inner"><span class="menu_icon_wrapper"><i class="menu_icon blank fa"></i></span><span class="item_text">Find a Branch</span></span></span></a>';
//
//        return $items.= '<li id="log-in-out-link" class="menu-item menu-item-type-custom menu-item-object-custom  mkd-menu-narrow">' . $link . '</li>';
//    }
//    add_filter('wp_nav_menu_items', 'add_login_logout_to_menu', 50, 2);

    