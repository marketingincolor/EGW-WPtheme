<?php

function my_theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style('fsp_custom_css_child', get_bloginfo( 'stylesheet_directory' ).'/assets/css/fspstyles_child.css');
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

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
        wp_enqueue_script('fsp-custom-popupjs', MIKADO_ASSETS_ROOT.'/js/jquery.magnific-popup.js' , array('jquery'), false, true);
        wp_enqueue_script('common script', MIKADO_ASSETS_ROOT . '/js/common.js', array('jquery'), false, true);

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
    
    
 /**
 * Author - Akilan
 * Date - 15-07-2016
 * Purpose - for set out class article title based on fixed heights
 */
function village_article_title_class() {
    global $wp_query;
    $next_post = $wp_query->posts[$wp_query->current_post + 1];
    $data = array(get_the_title(), $next_post->post_title);
    return get_title_class($data);
    
}


/**
 * Author - Akilan
 * Date - 18-07-2016
 * Purpose - Fetch next and next most article for scroll based article load
 */
function village_next_post_scrollarticle($blog_title_ar, $i) {
    $current =isset($blog_title_ar[$i]) ? $blog_title_ar[$i] : "";
    $next_title = isset($blog_title_ar[$i + 1]) ? $blog_title_ar[$i + 1] : "";
    $data = array($current, $next_title);   
    return get_title_class($data);
}
?>
