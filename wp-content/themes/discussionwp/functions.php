<?php
include_once get_template_directory().'/theme-includes.php'; // File containing all theme includes/requires at one place

if(!function_exists('discussion_styles')) {
    /**
     * Function that includes theme's core styles
     */
    function discussion_styles() {

        //include theme's core styles
        wp_enqueue_style('discussion_default_style', MIKADO_ROOT.'/style.css');
        wp_enqueue_style('discussion_modules', MIKADO_ASSETS_ROOT.'/css/modules.min.css');

        discussion_icon_collections()->enqueueStyles();

        wp_enqueue_style('wp-mediaelement');

        //define files afer which style dynamic needs to be included. It should be included last so it can override other files
        $style_dynamic_deps_array = array();
        if(discussion_load_woo_assets()) {
            $style_dynamic_deps_array = array('discussion_woo', 'discussion_woo_responsive');
        }


        if(file_exists(MIKADO_ROOT_DIR.'/assets/css/style_dynamic.css') && discussion_is_css_folder_writable() && !is_multisite()) {
            wp_enqueue_style('discussion_style_dynamic', MIKADO_ASSETS_ROOT . '/css/style_dynamic.css', $style_dynamic_deps_array, filemtime(MIKADO_ROOT_DIR . '/assets/css/style_dynamic.css')); //it must be included after woocommerce styles so it can override it
        }

        //is responsive option turned on?
        if(discussion_is_responsive_on()) {
            wp_enqueue_style('discussion_modules_responsive', MIKADO_ASSETS_ROOT.'/css/modules-responsive.min.css');

            //include proper styles
            if(file_exists(MIKADO_ROOT_DIR.'/assets/css/style_dynamic_responsive.css') && discussion_is_css_folder_writable() && !is_multisite()) {
                wp_enqueue_style('discussion_style_dynamic_responsive', MIKADO_ASSETS_ROOT . '/css/style_dynamic_responsive.css', array(), filemtime(MIKADO_ROOT_DIR . '/assets/css/style_dynamic_responsive.css'));
            }

        }

        //include Visual Composer styles
        if(class_exists('WPBakeryVisualComposerAbstract')) {
            wp_enqueue_style('js_composer_front');
        }
    }

    add_action('wp_enqueue_scripts', 'discussion_styles');
}

if(!function_exists('discussion_google_fonts_styles')) {
	/**
	 * Function that includes google fonts defined anywhere in the theme
	 */
    function discussion_google_fonts_styles() {
        $font_simple_field_array = discussion_options()->getOptionsByType('fontsimple');
        if(!(is_array($font_simple_field_array) && count($font_simple_field_array) > 0)) {
            $font_simple_field_array = array();
        }

        $font_field_array = discussion_options()->getOptionsByType('font');
        if(!(is_array($font_field_array) && count($font_field_array) > 0)) {
            $font_field_array = array();
        }

        $available_font_options = array_merge($font_simple_field_array, $font_field_array);
        $font_weight_str        = '100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';

        //define available font options array
        $fonts_array = array();
        foreach($available_font_options as $font_option) {
            //is font set and not set to default and not empty?
            $font_option_value = discussion_options()->getOptionValue($font_option);
            if(discussion_is_font_option_valid($font_option_value) && !discussion_is_native_font($font_option_value)) {
                $font_option_string = $font_option_value.':'.$font_weight_str;
                if(!in_array($font_option_string, $fonts_array)) {
                    $fonts_array[] = $font_option_string;
                }
            }
        }

        wp_reset_postdata();

        $fonts_array         = array_diff($fonts_array, array('-1:'.$font_weight_str));
        $google_fonts_string = implode('|', $fonts_array);

        //default fonts should be separated with %7C because of HTML validation
        $default_font_string = 'Roboto Slab:'.$font_weight_str.'|Lato:'.$font_weight_str;
        $protocol = is_ssl() ? 'https:' : 'http:';

        //is google font option checked anywhere in theme?
        if (count($fonts_array) > 0) {

            //include all checked fonts
            $fonts_full_list = $default_font_string . '|' . str_replace('+', ' ', $google_fonts_string);
            $fonts_full_list_args = array(
                'family' => urlencode($fonts_full_list),
                'subset' => urlencode('latin,latin-ext'),
            );

            $discussion_fonts = add_query_arg( $fonts_full_list_args, $protocol.'//fonts.googleapis.com/css' );
            wp_enqueue_style( 'discussion_google_fonts', esc_url_raw($discussion_fonts), array(), '1.0.0' );

        } else {
            //include default google font that theme is using
            $default_fonts_args = array(
                'family' => urlencode($default_font_string),
                'subset' => urlencode('latin,latin-ext'),
            );
            $discussion_fonts = add_query_arg( $default_fonts_args, $protocol.'//fonts.googleapis.com/css' );
            wp_enqueue_style( 'discussion_google_fonts', esc_url_raw($discussion_fonts), array(), '1.0.0' );
        }

    }

	add_action('wp_enqueue_scripts', 'discussion_google_fonts_styles');
}

if(!function_exists('discussion_scripts')) {
    /**
     * Function that includes all necessary scripts
     */
    function discussion_scripts() {
        global $wp_scripts;

        //init theme core scripts
		wp_enqueue_script( 'jquery-ui-core');
		wp_enqueue_script( 'jquery-ui-tabs');
		wp_enqueue_script( 'wp-mediaelement');

        wp_enqueue_script('discussion_third_party', MIKADO_ASSETS_ROOT.'/js/third-party.min.js', array('jquery'), false, true);

        if(discussion_is_smoth_scroll_enabled()) {
            wp_enqueue_script("discussion_smooth_page_scroll", MIKADO_ASSETS_ROOT . "/js/smoothPageScroll.js", array(), false, true);
        }

        //include google map api script
        wp_enqueue_script('google_map_api', '//maps.googleapis.com/maps/api/js?sensor=false', array(), false, true);
        
        wp_enqueue_script('discussion_modules', MIKADO_ASSETS_ROOT.'/js/modules.min.js', array('jquery'), false, true);

        //include comment reply script
        $wp_scripts->add_data('comment-reply', 'group', 1);
        if(is_singular()) {
            wp_enqueue_script("comment-reply");
        }

        //include Visual Composer script
        if(class_exists('WPBakeryVisualComposerAbstract')) {
            wp_enqueue_script('wpb_composer_front_js');
        }
    }

    add_action('wp_enqueue_scripts', 'discussion_scripts');
}

//defined content width variable
if (!isset( $content_width )) $content_width = 1060;

if(!function_exists('discussion_theme_setup')) {
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

        load_theme_textdomain( 'discussionwp', get_template_directory().'/languages' );
    }

    add_action('after_setup_theme', 'discussion_theme_setup');
}


if(!function_exists('discussion_rgba_color')) {
    /**
     * Function that generates rgba part of css color property
     *
     * @param $color string hex color
     * @param $transparency float transparency value between 0 and 1
     *
     * @return string generated rgba string
     */
    function discussion_rgba_color($color, $transparency) {
        if($color !== '' && $transparency !== '') {
            $rgba_color = '';

            $rgb_color_array = discussion_hex2rgb($color);
            $rgba_color .= 'rgba('.implode(', ', $rgb_color_array).', '.$transparency.')';

            return $rgba_color;
        }
    }
}

if(!function_exists('discussion_wp_title_text')) {
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
        if(discussion_seo_plugin_installed()) {
            //don't do anything, seo plugin will take care of it
        } else {
            //get current post id
            $id           = discussion_get_page_id();
            $sep          = ' | ';
            $title_prefix = get_bloginfo('name');
            $title_suffix = '';

            //is WooCommerce installed and is current page shop page?
            if(discussion_is_woocommerce_installed() && discussion_is_woocommerce_shop()) {
                //get shop page id
                $id = discussion_get_woo_shop_page_id();
            }

            //set unchanged title variable so we can use it later
            $title_array     = explode($sep, $title);
            $unchanged_title = array_shift($title_array);

            if(empty($title_suffix)) {
                //if current page is front page append site description, else take original title string
                $title_suffix = is_front_page() ? get_bloginfo('description') : $unchanged_title;
            }

            //concatenate title string
            $title = $title_prefix.$sep.$title_suffix;

            //return generated title string
            return $title;
        }
    }

    add_filter('wp_title', 'discussion_wp_title_text', 10, 2);
}

if(!function_exists('discussion_header_meta')) {
    /**
     * Function that echoes meta data if our seo is enabled
     */
    function discussion_header_meta() {

        ?>

        <meta charset="<?php bloginfo('charset'); ?>"/>

        <link rel="profile" href="http://gmpg.org/xfn/11"/>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
        <?php 
    }

    add_action('discussion_header_meta', 'discussion_header_meta');
}

if(!function_exists('discussion_user_scalable_meta')) {
    /**
     * Function that outputs user scalable meta if responsiveness is turned on
     * Hooked to discussion_header_meta action
     */
    function discussion_user_scalable_meta() {
        //is responsiveness option is chosen?
        if(discussion_is_responsive_on()) { ?>
            <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
        <?php } else { ?>
            <meta name="viewport" content="width=1200,user-scalable=yes">
        <?php }
    }

    add_action('discussion_header_meta', 'discussion_user_scalable_meta');
}

if(!function_exists('discussion_get_page_id')) {
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

        if(discussion_is_woocommerce_installed() && discussion_is_woocommerce_shop()) {
            return discussion_get_woo_shop_page_id();
        }

		if(is_archive() || is_search() || is_404() || (is_home() && is_front_page())) {
			return -1;
		}

		return get_queried_object_id();
	}
}


if(!function_exists('discussion_is_default_wp_template')) {
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

if(!function_exists('discussion_get_page_template_name')) {
    /**
     * Returns current template file name without extension
     * @return string name of current template file
     */
    function discussion_get_page_template_name() {
        $file_name = '';

        if(!discussion_is_default_wp_template()) {
            $file_name_without_ext = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename(get_page_template()));

            if($file_name_without_ext !== '') {
                $file_name = $file_name_without_ext;
            }
        }

        return $file_name;
    }
}

if(!function_exists('discussion_has_shortcode')) {
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

        if($shortcode) {
            //if content variable isn't past
            if($content == '') {
                //take content from current post
                $page_id = discussion_get_page_id();
                if(!empty($page_id)) {
                    $current_post = get_post($page_id);

                    if(is_object($current_post) && property_exists($current_post, 'post_content')) {
                        $content = $current_post->post_content;
                    }
                }
            }

            //does content has shortcode added?
            if(stripos($content, '['.$shortcode) !== false) {
                $has_shortcode = true;
            }
        }

        return $has_shortcode;
    }
}

if(!function_exists('discussion_rewrite_rules_on_theme_activation')) {
    /**
     * Function that flushes rewrite rules on deactivation
     */
    function discussion_rewrite_rules_on_theme_activation() {
        flush_rewrite_rules();
    }

    add_action('after_switch_theme', 'discussion_rewrite_rules_on_theme_activation');
}

if(!function_exists('discussion_get_dynamic_sidebar')) {
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

if(!function_exists('discussion_get_sidebar')) {
    /**
     * Return Sidebar
     *
     * @return string
     */
    function discussion_get_sidebar() {

        $id = discussion_get_page_id();

        $sidebar = "sidebar";

        if(is_category()) {

            $current_cat_id = discussion_get_current_object_id();
            $cat_array = get_option("post_tax_term_$current_cat_id");
            $cat_custom_sidebar = $cat_array['custom_sidebar'];

            $category_custom_sidebar = '';
            if(!empty($cat_custom_sidebar)) {
                $category_custom_sidebar = $cat_custom_sidebar;
            }else if(discussion_options()->getOptionValue('blog_custom_category_sidebar') !== ''){
                $category_custom_sidebar = discussion_options()->getOptionValue('blog_custom_category_sidebar');
            }

        }

        if (get_post_meta($id, 'mkd_custom_sidebar_meta', true) !== '') {
            $sidebar = get_post_meta($id, 'mkd_custom_sidebar_meta', true);
        } else {
            if (is_single() && discussion_options()->getOptionValue('blog_single_custom_sidebar') != '' ) {
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
            } elseif(is_tag() && discussion_options()->getOptionValue('blog_custom_tag_sidebar')) {
                $sidebar = esc_attr(discussion_options()->getOptionValue('blog_custom_tag_sidebar'));
            }
        }

        return $sidebar;
    }
}

if( !function_exists('discussion_sidebar_columns_class') ) {

    /**
     * Return classes for columns holder when sidebar is active
     *
     * @return array
     */

    function discussion_sidebar_columns_class() {

        $sidebar_class = array();
        $sidebar_layout = discussion_sidebar_layout();

        switch($sidebar_layout):
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

if( !function_exists('discussion_sidebar_layout') ) {

    /**
     * Function that check is sidebar is enabled and return type of sidebar layout
     */

    function discussion_sidebar_layout() {

        $sidebar_layout = '';
        $page_id        = discussion_get_page_id();

        $page_sidebar_meta = get_post_meta($page_id, 'mkd_sidebar_meta', true);

        $category_sidebar = false;
        if(is_category()) {

            $current_cat_id = discussion_get_current_object_id();
            $cat_array = get_option("post_tax_term_$current_cat_id");
            $cat_sidebar = $cat_array['sidebar_layout'];

            if(!empty($cat_sidebar)) {
                $category_sidebar = $cat_sidebar !== 'default' ? true : false;
                $category_sidebar_layout = $cat_sidebar !== 'default' ? $cat_sidebar : '';
            }else if(discussion_options()->getOptionValue('category_sidebar_layout') !== 'default'){
                $category_sidebar = true;
                $category_sidebar_layout = discussion_options()->getOptionValue('category_sidebar_layout');
				if($category_sidebar_layout == 'no-sidebar'){
					$category_sidebar_layout = '';
				}
            }

        }

		$author_sidebar = false;
		$author_sidebar_layout = '';
		if (is_author()){
			$a_sidebar = discussion_options()->getOptionValue('author_sidebar_layout');
			if ($a_sidebar !== 'default'){
				$author_sidebar = true;
				$author_sidebar_layout = $a_sidebar;
				if($author_sidebar_layout == 'no-sidebar'){
					$author_sidebar_layout = '';
				}
			}
		}

		$tag_sidebar = false;
		$tag_sidebar_layout = '';
		if (is_tag()){
			$t_sidebar = discussion_options()->getOptionValue('tag_sidebar_layout');
			if ($t_sidebar !== 'default'){
				$tag_sidebar = true;
				$tag_sidebar_layout = $t_sidebar;
				if($tag_sidebar_layout == 'no-sidebar'){
					$tag_sidebar_layout = '';
				}
			}
		}

        if($page_sidebar_meta !== '' && $page_id !== -1) {
            if($page_sidebar_meta == 'no-sidebar') {
                $sidebar_layout = '';
            } else {
                $sidebar_layout = $page_sidebar_meta;
            }
        } else {
            if(is_single() && discussion_options()->getOptionValue('blog_single_sidebar_layout')) {
                $sidebar_layout = esc_attr(discussion_options()->getOptionValue('blog_single_sidebar_layout'));
            } elseif(
            	(is_archive() || (is_home() && is_front_page()))
            	&& !(is_author() && $author_sidebar) //if is not author page or author sidebar is inherited (default value)
            	&& !(is_category() && $category_sidebar)
            	&& !(is_tag() && $tag_sidebar)
            	&& discussion_options()->getOptionValue('archive_sidebar_layout')) {
                $sidebar_layout = esc_attr(discussion_options()->getOptionValue('archive_sidebar_layout'));
            } elseif(is_page() && discussion_options()->getOptionValue('page_sidebar_layout')) {
                $sidebar_layout = esc_attr(discussion_options()->getOptionValue('page_sidebar_layout'));
            } elseif(is_category() && $category_sidebar) {
                $sidebar_layout = esc_attr($category_sidebar_layout);
            } elseif(is_author() && $author_sidebar) {
                $sidebar_layout = esc_attr($author_sidebar_layout);
            } elseif(is_tag() && $tag_sidebar) {
                $sidebar_layout = esc_attr($tag_sidebar_layout);
            }
        }

        return $sidebar_layout;
    }
}

if( !function_exists('discussion_container_style') ) {

    /**
     * Function that return container style
     */

    function discussion_container_style($style) {
        $id = discussion_get_page_id();
        $class_prefix = discussion_get_unique_page_class();

        $container_selector = array(
            $class_prefix.' .mkd-wrapper-inner',
            $class_prefix.' .mkd-content',
            $class_prefix.'.mkd-boxed .mkd-wrapper .mkd-wrapper-inner',
            $class_prefix.'.mkd-boxed .mkd-wrapper .mkd-content',
        );

        $container_class = array();
        $page_backgorund_color = get_post_meta($id, "mkd_page_background_color_meta", true);

        if($page_backgorund_color){
            $container_class['background-color'] = $page_backgorund_color;
        }

        $current_style = discussion_dynamic_css($container_selector, $container_class);
        $current_style = $current_style . $style;

        return $current_style;

    }
    add_filter('discussion_add_page_custom_style', 'discussion_container_style');
}

if( !function_exists('discussion_boxed_style') ) {

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

        if(get_post_meta($id, "mkd_boxed_meta", true) == 'yes') {
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

if( !function_exists('discussion_post_classic_slider_responsive_style') ) {

    /**
     * Function that return container style
     */

    function discussion_post_classic_slider_responsive_style($style) {
        $class_prefix = discussion_get_unique_page_class();

        $container_selector = array(
            $class_prefix.' .mkd-psc-holder.mkd-psc-full-screen .mkd-psc-slides .mkd-psc-content .mkd-psc-content-inner2'
        );
        $navigation_selector = array(
            $class_prefix.' .mkd-psc-holder.mkd-psc-full-screen .flex-direction-nav'
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

if(!function_exists('discussion_get_unique_page_class')) {
    /**
     * Returns unique page class based on post type and page id
     *
     * @return string
     */
    function discussion_get_unique_page_class() {
        $id = discussion_get_page_id();

        return is_single() ? '.postid-'.$id : '.page-id-'.$id;
    }
}

if(!function_exists('discussion_print_custom_css')) {
    /**
     * Prints out custom css from theme options
     */
    function discussion_print_custom_css() {
        $custom_css = discussion_options()->getOptionValue('custom_css');
        $style = '';
        $custom_css .= apply_filters('discussion_add_page_custom_style', $style);

        if($custom_css !== '') {
            wp_add_inline_style( 'discussion_modules', $custom_css);
        }
    }

    add_action('wp_enqueue_scripts', 'discussion_print_custom_css');
}

if(!function_exists('discussion_print_custom_js')) {
    /**
     * Prints out custom css from theme options
     */
    function discussion_print_custom_js() {
        $custom_js = discussion_options()->getOptionValue('custom_js');
        $output = '';

        if($custom_js !== '') {
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


if(!function_exists('discussion_get_global_variables')) {
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

if(!function_exists('discussion_per_page_js_variables')) {
    function discussion_per_page_js_variables() {
        $per_page_js_vars = apply_filters('discussion_per_page_js_vars', array());

        wp_localize_script('discussion_modules', 'mkdPerPageVars', array(
            'vars' => $per_page_js_vars
        ));
    }

    add_action('wp_enqueue_scripts', 'discussion_per_page_js_variables');
}

if(!function_exists('discussion_content_elem_style_attr')) {
    /**
     * Defines filter for adding custom styles to content HTML element
     */
    function discussion_content_elem_style_attr() {
        $styles = apply_filters('discussion_content_elem_style_attr', array());

        discussion_inline_style($styles);
    }
}

if(!function_exists('discussion_is_woocommerce_installed')) {
    /**
     * Function that checks if woocommerce is installed
     * @return bool
     */
    function discussion_is_woocommerce_installed() {
        return function_exists('is_woocommerce');
    }
}

if(!function_exists('discussion_visual_composer_installed')) {
    /**
     * Function that checks if visual composer installed
     * @return bool
     */
    function discussion_visual_composer_installed() {
        //is Visual Composer installed?
        if(class_exists('WPBakeryVisualComposerAbstract')) {
            return true;
        }

        return false;
    }
}

if(!function_exists('discussion_seo_plugin_installed')) {
    /**
     * Function that checks if popular seo plugins are installed
     * @return bool
     */
    function discussion_seo_plugin_installed() {
        //is 'YOAST' or 'All in One SEO' installed?
        if(defined('WPSEO_VERSION') || class_exists('All_in_One_SEO_Pack')) {
            return true;
        }

        return false;
    }
}

if(!function_exists('discussion_contact_form_7_installed')) {
    /**
     * Function that checks if contact form 7 installed
     * @return bool
     */
    function discussion_contact_form_7_installed() {
        //is Contact Form 7 installed?
        if(defined('WPCF7_VERSION')) {
            return true;
        }

        return false;
    }
}

if(!function_exists('discussion_is_wpml_installed')) {
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

if( !function_exists('discussion_content_padding_top') ) {

    /**
     * Function that return padding for content
     */

    function discussion_content_padding_top($style) {

        $id = discussion_get_page_id();
        $current_style = '';

        if(is_single()) {
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

        if($page_padding_top !== ''){
            if(get_post_meta($id, "mkd_page_content_top_padding_mobile", true) == 'yes') {
                $content_class['padding-top'] = discussion_filter_px($page_padding_top).'px!important';
            }
            else {
                $content_class['padding-top'] = discussion_filter_px($page_padding_top).'px';
            }
            $current_style .= discussion_dynamic_css($content_selector, $content_class);
        }

        $current_style = $current_style . $style;

        return $current_style;

    }
    add_filter('discussion_add_page_custom_style', 'discussion_content_padding_top');
}

if(!function_exists('discussion_max_image_width_srcset')) {
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

if(!function_exists('discussion_get_max_number_of_pages')) {
    /**
     * Function that return max number of posts/pages for pagination
     * @return int
     *
     * @version 0.1
     */
    function discussion_get_max_number_of_pages() {
        global $wp_query;

        $max_number_of_pages = 10; //default value
        
        if($wp_query) {
            $max_number_of_pages = $wp_query->max_num_pages;
        }

        return $max_number_of_pages;
    }
}

if(!function_exists('discussion_get_current_object_id')) {
    /**
     * Function that return current object id
     * @return int
     *
     * @version 0.1
     */
    function discussion_get_current_object_id() {
        global $wp_query;

        $current_object_id = -1; //default value
        
        if($wp_query) {
            $current_object_id = $wp_query->get_queried_object_id();
        }

        return $current_object_id;
    }
}

if(!function_exists('discussion_get_blog_page_range')) {
    /**
     * Function that return current page for blog list pagination
     * @return int
     *
     * @version 0.1
     */
    function discussion_get_blog_page_range() {
        global $wp_query;

        if(discussion_options()->getOptionValue('blog_page_range') != ""){
            $blog_page_range = esc_attr(discussion_options()->getOptionValue('blog_page_range'));
        } else{
            $blog_page_range = $wp_query->max_num_pages;
        }

        return $blog_page_range;
    }
}