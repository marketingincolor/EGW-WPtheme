<?php

function my_theme_enqueue_styles() {

    wp_enqueue_style(discussion_default_style, get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style('fsp_custom_css_child', get_stylesheet_directory_uri() . '/assets/css/fspstyles_child.css');
    wp_enqueue_style('discussion_modules', get_stylesheet_directory_uri() . '/assets/css/modules.css');
    wp_enqueue_style('fsp_custom_css', get_stylesheet_directory_uri() . '/assets/css/fspstyles.css');
    wp_enqueue_style('fsp_custom_popup', get_stylesheet_directory_uri() . '/assets/css/magnific-popup.css');
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

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
        wp_enqueue_script('fsp-custom-popupjs', get_stylesheet_directory_uri() . '/assets/js/jquery.magnific-popup.js', array('jquery'), false, true);
        wp_enqueue_script('common script', get_stylesheet_directory_uri() . '/assets/js/common.js', array('jquery'), false, true);

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
        if (is_page('login')) {
            wp_enqueue_script('jquery validation', MIKADO_ASSETS_ROOT . '/js/jquery.validate.js');
        }
    }

    add_action('wp_enqueue_scripts', 'discussion_scripts');
}

/**
 * Author - Akilan
 * Date - 18-07-2016
 * Purpose - Fetch next and next most article for scroll based article load
 */
function village_next_post_scrollarticle($blog_title_ar, $i) {
    $current = isset($blog_title_ar[$i]) ? $blog_title_ar[$i] : "";
    $next_title = isset($blog_title_ar[$i + 1]) ? $blog_title_ar[$i + 1] : "";
    $data = array($current, $next_title);
    return get_title_class($data);
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
            'posts_per_page' => 1,
            'post__not_in' => $display_postid_ar
        ));
        return $posts;
    }

}

    
function remainfollow_categorypost_detail($post_type, $subcat_id_sgl, $display_postid_ar,$limit) {
        $posts =get_posts( array(
            'post_type' => $post_type,
            'cat' => $subcat_id_sgl,
            'order' => 'DESC',
            'posts_per_page' => $limit,
            'post__not_in' => $display_postid_ar
        ));
        return $posts;
    }

/**
 * Author - Rajasingh
 * Date - 26-08-2016
 * Purpose - For getting category based post except from followed categories
 */
function follow_categorypost_detail_set($post_type, $subcat_id_sgl, $display_postid_ar) {
    $posts = array(
        'post_type' => $post_type,
        'cat' => $subcat_id_sgl,
        'order' => 'DESC',
        'posts_per_page' => 1,
        'post__not_in' => $display_postid_ar
    );
    return $posts;
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
    $restrict_id = get_cat_id('videos');
    $j = 1;
    $out = array();
    $output = "";
    $main_cat = get_main_category_detail();
    global $post;
    foreach ($getResultset as $getKeyrel) {
        if ($restrict_id != $getKeyrel) {
            $parent_id = category_top_parent_id($getKeyrel);
            if (isset($main_cat[$getKeyrel])) {
                $slug = get_category($getKeyrel);
                $out[] = '<a href="' . site_url() . '/' . $slug->slug . '">' . get_cat_name($getKeyrel) . '</a>';
            } else
                $out[] = '<a href="' . get_category_link($getKeyrel) . '">' . get_cat_name($getKeyrel) . '</a>';
        }
        $j++;
    }

    if (!empty($out))
        $output = implode("\x20/\x20", $out);

    return $output;
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
    $profile_fields['signature'] = 'Title';

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
    remove_action('add_meta_boxes', array($AuthorRecommendedPosts, 'add_recommended_meta_box'));

    //Create class and extend author recommended post class to override author recommended section design
    class DiscussionAuthorRecommendPosts extends AuthorRecommendedPosts {

        function __construct() {

            $this->option_name = '_' . $this->namespace . '--options';
            add_shortcode('AuthorRecommendedPosts', array(&$this, 'shortcode'));
            add_action('add_meta_boxes', array(&$this, 'add_recommended_meta_box'));
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
            $author_recommended_posts_post_types = $this->get_option("{$this->namespace}_post_types");

            foreach ($author_recommended_posts_post_types as $author_recommended_posts_post_type) {
                // adds to posts $post_type
                add_meta_box(
                        $this->namespace . '-recommended_meta_box', __('Author Recommended Posts', $this->namespace), array(&$this, 'recommended_meta_box'), $author_recommended_posts_post_type, 'side', 'high'
                );
            }
        }

        function recommended_meta_box($object, $box) {

            $author_recommended_posts = get_post_meta($object->ID, $this->namespace, true);
            $author_recommended_posts_post_types = $this->get_option("{$this->namespace}_post_types");
            $author_recommended_posts_search_results = $this->author_recommended_posts_search();
            $author_recommended_posts_options_url = admin_url() . '/options-general.php?page=' . $this->namespace;

            include( AUTHOR_RECOMMENDED_POSTS_DIRNAME . '/views/_recommended-meta-box.php' );
        }

        function author_recommended_posts_search() {
            global $post;
            $post_id = $post->ID;
            $html = '';

            // set post_types that get filtered in the search box.
            $author_recommended_posts_post_types = $this->get_option("{$this->namespace}_post_types");

            // set default query options
            $options = array(
                'post_type' => $author_recommended_posts_post_types,
                'posts_per_page' => '-1',
                'paged' => 0,
                'order' => 'DESC',
                'post_status' => array('publish'),
                'suppress_filters' => false,
                'post__not_in' => array($post_id),
                's' => ''
            );

            // check if ajax
            $ajax = isset($_POST['action']) ? true : false;

            // if ajax merge $_POST
            if ($ajax) {
                $options = array_merge($options, $_POST);
            }

            // search
            if ($options['s']) {
                // set temp title to search query
                $options['like_title'] = $options['s'];
                // filter query by title
                add_filter('posts_where', array($this, 'posts_where'), 10, 2);
            }

            // unset search so results are accurate and not muddled 
            unset($options['s']);

            $searchable_posts = get_posts($options);

            if ($searchable_posts) {
                foreach ($searchable_posts as $searchable_post) {
                    // right aligned info
                    $title = '<span class="recommended-posts-post-type">';
                    $title .= $searchable_post->post_type;
                    $title .= '</span>';
                    $title .= '<span class="recommended-posts-title">';
                    $title .= apply_filters('the_title', $searchable_post->post_title, $searchable_post->ID);
                    $title .= '</span>';

                    $html .= '<li><a href="' . get_permalink($searchable_post->ID) . '" data-post_id="' . $searchable_post->ID . '">' . $title . '</a></li>' . "\n";
                }
            }

            // if ajax, die and echo $html otherwise just return
            if ($ajax) {
                die($html);
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

            $message = 'Hi ' . $user->user_nicename . ',<br>We received a request for password change. Your new password is: ' . $random_password . '<br>Please use this password for further login.<br>Thanks!';

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
                        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/aavathar.jpg' ?>" width="85px" height="85px" />
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
            ?><span class="mkd-comment-author"><?php
                        if (!empty($user_name['first_name'][0])) {
                            echo $user_name['first_name'][0];
                        } else {
                            echo wp_kses_post(get_comment_author_link());
                        }
                        ?></span>
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
            $link = 'window.open(\'https://twitter.com/intent/tweet?text=' . urlencode(discussion_addslashes(get_the_title())) . '&url=' . urlencode(discussion_the_excerpt_max_charlength($count_char) . $twitter_via) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
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
function village_article_title_class() {
    global $wp_query;
    $next_post = $wp_query->posts[$wp_query->current_post + 1];
    $data = array(get_the_title(), $next_post->post_title);
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
        $str .= "<a href='" . home_url('/user-profile') . "'>" . wpfp_get_option('remove_favorite') . "</a>";
    elseif ($action == "add"):
        $str .= "<i class='fa fa-star-o fa-star-rightpad' aria-hidden='true'></i><a class='wpfp-link' href='?wpfpaction=add&amp;postid=" . esc_attr($post_id) . "' title='" . wpfp_get_option('add_favorite') . "' rel='nofollow'>" . wpfp_get_option('add_favorite') . "</a>";
    elseif (wpfp_check_favorited($post_id)):
        $str .= "<a href='" . home_url('/user-profile') . "'>" . wpfp_get_option('remove_favorite') . "</a>";
    else:
        $str .= "<i class='fa fa-star-o fa-star-rightpad' aria-hidden='true'></i><a class='wpfp-link' href='?wpfpaction=add&amp;postid=" . esc_attr($post_id) . "' title='" . wpfp_get_option('add_favorite') . "' rel='nofollow'>" . wpfp_get_option('add_favorite') . "</a>";
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
function add_login_logout_to_menu($items, $args) {
    //change theme location with your them location name
    if (is_admin())
        return $items;

    $redirect = ( is_home() ) ? home_url('/') : home_url('/');
    $homeurl = home_url('/');
    if (!is_user_logged_in() && get_current_blog_id() == 1)
        $link = '<a class="" href="' . $homeurl . 'register"><span class="item_outer"><span class="item_inner"><span class="menu_icon_wrapper"><i class="menu_icon blank fa"></i></span><span class="item_text">Join</span></span></span></a>';
    // else  
    //  $link = '<a class="" href="' . $homeurl . 'register"><span class="item_outer"><span class="item_inner"><span class="menu_icon_wrapper"><i class="menu_icon blank fa"></i></span><span class="item_text">Find a Branch</span></span></span></a>';

    return $items.= '<li id="log-in-out-link" class="menu-item menu-item-type-custom menu-item-object-custom  mkd-menu-narrow">' . $link . '</li>';
}

add_filter('wp_nav_menu_items', 'add_login_logout_to_menu', 50, 2);

/**
 * Author - Vinoth Raja
 * Date   - 30-07-2016
 * Purpose - For page view count increasing functionality
 */
remove_action('wp', 'discussion_update_post_count_views');

if (!function_exists('custom_update_post_count_views')) {

    function custom_update_post_count_views() {
        $postID = discussion_get_page_id();
        if (is_singular('post') || is_singular('videos')) {
            if (isset($_COOKIE['mkd-post-views_' . $postID])) {
                return;
            } else {
                $count = get_post_meta($postID, 'count_post_views', true);
                if ($count === '') {
                    update_post_meta($postID, 'count_post_views', 1);
                    setcookie('mkd-post-views_' . $postID, $postID, time() * 20, '/');
                } else {
                    $count++;
                    update_post_meta($postID, 'count_post_views', $count);
                    setcookie('mkd-post-views_' . $postID, $postID, time() * 20, '/');
                }
            }
        }
    }

    add_action('wp', 'custom_update_post_count_views');
}

if (!function_exists('custom_discussion_excerpt')) {

    /**
     * Function that cuts post excerpt to the number of word based on previosly set global
     * variable $word_count, which is defined in mkd_set_blog_word_count function.
     *
     * It current post has read more tag set it will return content of the post, else it will return post excerpt
     *
     */
    function custom_discussion_excerpt($excerpt_length_in_chars) {

        global $post;
        $empty_content_p = '<p class="mkd-post-excerpt-fsp"></p>';
        if (post_password_required()) {
            echo get_the_password_form();
        }

        //does current post has read more tag set?
        elseif (discussion_post_has_read_more()) {
            global $more;

            //override global $more variable so this can be used in blog templates
            $more = 0;
            the_content(true);
        } elseif ($post->post_content != "") {
            $post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);
            $post_excerpt_length = strlen($post_excerpt);
            if ($excerpt_length_in_chars == '0') {
                $post_excerpt = rtrim(substr($post_excerpt, 0, 100));
            } else if ($post_excerpt_length > $excerpt_length_in_chars) {
                $post_excerpt = rtrim(substr($post_excerpt, 0, $excerpt_length_in_chars));
            }
            echo '<p class="mkd-post-excerpt">' . $post_excerpt . '</p>';
        } else {
            echo $empty_content_p;
        }
    }

}

/**
 * Author - Akilan 
 * Date   - 03-08-2016
 * Purpose - For retrieve main category id related with category pages
 */
function get_maincategory_id() {
    $parent_category_name = basename(get_permalink());
    $main_catid = get_category_by_slug($parent_category_name)->term_id;
    if (empty($main_catid))
        $main_catid = get_cat_id(single_cat_title("", false));
    $parent_cat_id = category_top_parent_id($main_catid);
    $main_catid_ar = get_main_category_detail();
    $main_catid = isset($main_catid_ar[$parent_cat_id]) ? $main_catid : "";
    return $main_catid;
}

/**
 * Author - Akilan
 * Date  - 03-08-2016
 * Purpose - For generating post category link
 */
function post_category_link($id, $getPostcat, $main_cat_det, $main_cat_id, $slug_page) {

    if ((!empty($main_cat_det) && !empty($main_cat_id)) || $slug_page == 'videos'):
        $post_link = esc_url(custom_category_permalink($id, $getPostcat, $main_cat_det->term_id, $main_cat_det->slug, $slug_page));
    else:
        $post_link = esc_url(get_permalink());
    endif;
    return $post_link;
}

/**
 * Author - Akilan
 * Date - 03-08-2016
 * Purpose - For getting child categories as per random basis as corresponding category page
 * $getPostcat => post categories
 * $current_cat_id =>current category id (as per page)
 */
function get_child_catid($getPostcat, $current_cat_id) {
    $temp_cat = array_flip($getPostcat);
    $child_cat_ar = array();
    foreach ($temp_cat as $key => $val) {
        $top_parent = category_top_parent_id($key);
        if ($top_parent != $key && $top_parent == $current_cat_id) {
            $child_cat_ar[] = $key;
        }
    }
    if (!empty($child_cat_ar))
        return $child_catid = $child_cat_ar[array_rand($child_cat_ar)];
}

/**
 * Author - Akilan
 * Date  - 05-08-2016
 * Purpose - For generating permalink
 */
function custom_category_permalink($id, $getPostcat, $current_cat_id, $parent_cat_slug, $slug_page) {
    global $post;
    if ((!empty($current_cat_id) || !empty($parent_cat_slug)) || $slug_page == 'videos') {
        $child_cat_id = get_child_catid($getPostcat, $current_cat_id);
        $top_parent_id = category_top_parent_id($current_cat_id);
        $url = site_url();
        if ($slug_page == 'videos') {
            $url.='/' . $slug_page;
        } else {
            if ($top_parent_id != $current_cat_id)
                $url.='/' . get_category($top_parent_id)->slug;
            $url.='/' . $parent_cat_slug;
            if (!empty($child_cat_id))
                $url.='/' . get_category($child_cat_id)->slug;
        }
        $url.='/' . $post->post_name;
        return $url;
    } else {

        return esc_url(get_permalink());
        ;
    }
}

/**
 * Author - Muthupandi
 * Date  - 09-08-2016
 * Purpose - For mobile search bar
 */
add_action('init', 'remove_mobile_header');

function remove_mobile_header() {
    //mobile header
    remove_action('discussion_after_page_header', 'discussion_get_mobile_header');
    add_action('discussion_after_page_header', 'custom_get_mobile_header');
}

function custom_get_mobile_header() {

    if (discussion_is_responsive_on()) {
        $header_type = 'header-type3';

        //this could be read from theme options
        $mobile_header_type = 'mobile-header';

        $parameters = array(
            'show_logo' => discussion_options()->getOptionValue('hide_logo') == 'yes' ? false : true,
            'show_navigation_opener' => has_nav_menu('mobile-navigation')
        );
        include(locate_template('block/mobile-header.php'));
    }
}

function custom_get_mobile_nav() {

    $slug = 'header-type3';
    include(locate_template('block/mobile-navigation.php'));
}

/* Added script for mobile search header ends here */

/**
 * Author - Muthupandi
 * Date  - 19-08-2016
 * Purpose - For showing date,category and save atricle on the banner
 */
if (!function_exists('discussion_post_info')) {

    /**
     * Function that loads parts of blog post info section
     * Possible options are:
     * 1. date
     * 2. category
     * 3. author
     * 4. comments
     * 5. like
     * 6. share
     *
     * @param $config array of sections to load
     */
    function discussion_post_info($config, $slug = '') {
        $default_config = array(
            'date' => '',
            'category' => '',
            'author' => '',
            'comments' => '',
            'like' => '',
            'count' => '',
            'share' => '',
            'rating' => '',
            'category_singlepost' => '',
            'save_stories' => ''
        );

        extract(shortcode_atts($default_config, $config));

        if ($share == 'yes') {
            discussion_get_module_template_part('templates/parts/post-info/post-info-share', 'blog');
        }
        if ($comments == 'yes') {
            discussion_get_module_template_part('templates/parts/post-info/post-info-comments', 'blog');
        }
        if ($count == 'yes') {
            discussion_get_module_template_part('templates/parts/post-info/post-info-count', 'blog', $slug);
        }
        if ($date == 'yes') {
            discussion_get_module_template_part('templates/parts/post-info/post-info-date', 'blog', '', array('date_format' => ''));
        }
        if ($author == 'yes') {
            discussion_get_module_template_part('templates/parts/post-info/post-info-author', 'blog');
        }
        if ($like == 'yes') {
            discussion_get_module_template_part('templates/parts/post-info/post-info-like', 'blog');
        }
        if ($category == 'yes') {
            discussion_get_module_template_part('templates/parts/post-info/post-info-category', 'blog');
        }
        if ($category_singlepost == 'yes') {
            get_template_part('block/post-info-category_singlepost');
        }
        if ($save_stories == 'yes') {
            get_template_part('block/post-info-save-stories');
        }
        if ($rating == 'yes') {
            discussion_get_module_template_part('templates/parts/post-info/post-info-rating', 'blog');
        }
    }

}

/**
 * Author - Muthupandi
 * Date  - 19-08-2016
 * Purpose - Update Header top
 */
add_action('init', 'remove_discussion_get_header_top');

function remove_discussion_get_header_top() {
    //mobile header
    remove_action('discussion_after_page_header', 'discussion_get_header_top');
    add_action('discussion_after_page_header', 'add_custom_discussion_get_header_top');
}

if (!function_exists('add_custom_discussion_get_header_top')) {

    /**
     * Loads header top HTML and sets parameters for it
     */
    function discussion_get_header_top() {

        $column_widths = '50-50';
        $show_header_top = discussion_options()->getOptionValue('top_bar') == 'yes' ? true : false;
        $top_bar_in_grid = discussion_options()->getOptionValue('top_bar_in_grid') == 'yes' ? true : false;
        include_once('block/header-top.php');
    }

}

/**
 * Author - Muthupandi
 * Date  - 19-08-2016
 * Purpose - Update Logo
 */
if (!function_exists('discussion_get_logo')) {

    /**
     * Loads logo HTML
     *
     * @param $slug
     */
    function discussion_get_logo($slug = '') {

        $slug = $slug !== '' ? $slug : 'header-type3';

        if ($slug == 'sticky') {
            $logo_image = discussion_options()->getOptionValue('logo_image_sticky');
        } else {
            $logo_image = discussion_options()->getOptionValue('logo_image');
        }

        $logo_image_dark = discussion_options()->getOptionValue('logo_image_dark');
        $logo_image_light = discussion_options()->getOptionValue('logo_image_light');

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = discussion_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if (is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: ' . intval($logo_height / 2) . 'px;'; //divided with 2 because of retina screens
        }

        include_once('block/logo.php');
    }

}

if (!function_exists('discussion_get_mobile_logo')) {

    /**
     * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
     *
     * @param string $slug
     */
    function discussion_get_mobile_logo($slug = '') {

        $slug = $slug !== '' ? $slug : 'header-type3';

        //check if mobile logo has been set and use that, else use normal logo
        if (discussion_options()->getOptionValue('logo_image_mobile') !== '') {
            $logo_image = discussion_options()->getOptionValue('logo_image_mobile');
        } else {
            $logo_image = discussion_options()->getOptionValue('logo_image');
        }

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = discussion_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if (is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: ' . intval($logo_height / 2) . 'px'; //divided with 2 because of retina screens
        }
        include_once('block/mobile-logo.php');
    }

}

/**
 * Author - Akilan
 * Date - 20-06-2016
 * Purpose  - For displaying subcategory image based on main category in main menu section
 * Widget that adds post layout tabs
 *
 * Class DiscussionCategoryLayoutTabs
 */
include_once get_template_directory() . '/framework/lib/mkd.layout.inc';
include_once get_template_directory() . '/framework/lib/mkd.framework.inc';
include_once get_template_directory() . '/framework/modules/widgets/lib/widget-class.php';

class DiscussionCategoryLayoutTabs extends DiscussionWidget {

    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
                'mkd_category_layout_tabs_widget', // Base ID
                'Mikado Category Layout Tabs Widget' // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $categories = array(-1 => 'None') + array_flip(discussion_get_post_categories_VC());
        $this->params = array(
            array(
                'type' => 'dropdown',
                'title' => 'Layout',
                'name' => 'layout',
                'options' => array(
                    'five' => 'Layout 5',
                    'seven' => 'Layout 7'
                ),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Number of Columns',
                'name' => 'column_number',
                'options' => array(
                    4 => 'Four Columns',
                    1 => 'One Column',
                    2 => 'Two Columns',
                    3 => 'Three Columns',
                    5 => 'Five Columns'
                ),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'First Category',
                'name' => 'category_id_1',
                'options' => $categories,
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Second Category',
                'name' => 'category_id_2',
                'options' => $categories,
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Third Category',
                'name' => 'category_id_3',
                'options' => $categories,
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Fourth Category',
                'name' => 'category_id_4',
                'options' => $categories,
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Fifth Category',
                'name' => 'category_id_5',
                'options' => $categories,
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Sixth Category',
                'name' => 'category_id_6',
                'options' => $categories,
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Sort',
                'name' => 'sort',
                'options' => array_flip(discussion_get_sort_array()),
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'title' => 'Image Width (px)',
                'name' => 'thumb_image_width',
                'description' => 'Set custom image width (px)',
            ),
            array(
                'type' => 'textfield',
                'title' => 'Image Height (px)',
                'name' => 'thumb_image_height',
                'description' => 'Set custom image height (px)',
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Title Tag',
                'name' => 'title_tag',
                'options' => array(
                    'h6' => 'h6',
                    'h2' => 'h2',
                    'h3' => 'h3',
                    'h4' => 'h4',
                    'h5' => 'h5',
                )
            ),
            array(
                'type' => 'textfield',
                'title' => 'Title Max Characters',
                'name' => 'title_length',
                'description' => 'Enter max character of title post list that you want to display'
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Display Date',
                'name' => 'display_date',
                'options' => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                )
            ),
            array(
                'type' => 'textfield',
                'title' => 'Date Format',
                'name' => 'date_format',
                'description' => 'Enter the date format that you want to display'
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Display Excerpt',
                'name' => 'display_excerpt',
                'options' => array(
                    'no' => 'No',
                    'yes' => 'Yes',
                )
            ),
            array(
                'type' => 'textfield',
                'title' => 'Max. Excerpt Length',
                'name' => 'excerpt_length',
                'description' => 'Enter max of words that can be shown for excerpt',
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        extract($args);

        //prepare variables
        if (is_array($instance) && count($instance)) {
            $params_label = 'params';
            $categories = array();
            $layout = 'five';

            if (isset($instance['layout']) && $instance['layout'] !== '') {
                $layout = $instance['layout'];
            }

            if ($layout == 'five') {
                $instance['number_of_posts'] = $instance['column_number'];
                $instance['display_category'] = 'no';
                $instance['display_comments'] = 'no';
                $instance['display_share'] = 'no';
                $instance['display_count'] = 'no';
                $instance['display_read_more'] = 'no';
                $instance['thumb_image_size'] = 'custom_size';
                $instance['thumb_image_width'] = $instance['thumb_image_width'] != '' ? $instance['thumb_image_width'] : '220';
                $instance['thumb_image_height'] = $instance['thumb_image_height'] != '' ? $instance['thumb_image_height'] : '180';
                $instance['excerpt_length'] = $instance['excerpt_length'] != '' ? $instance['excerpt_length'] : '10';
            } else {
                $instance['number_of_posts'] = $instance['column_number'] * $instance['column_number'];
                $instance['display_image'] = 'yes';
                $instance['custom_thumb_image_width'] = $instance['thumb_image_width'] != '' ? $instance['thumb_image_width'] : '93';
                $instance['custom_thumb_image_height'] = $instance['thumb_image_height'] != '' ? $instance['thumb_image_height'] : '69';
                $instance['excerpt_length'] = $instance['excerpt_length'] != '' ? $instance['excerpt_length'] : '10';
            }


            //check how menu category fields we have
            $our_cat = main_category_name();
            $cat_id_ar = array();
            $cat_lnk = array();
            foreach ($our_cat as $our_cat_each) {
                $cat = get_term_by('slug', $our_cat_each, 'category');
                if ($cat) {
                    $cat_id_ar[$cat->term_id] = $cat->name;
                    $cat_lnk[$cat->term_id] = $our_cat_each;
                }
            }

            $count = 0;
//            foreach ($instance as $key => $value){
//                if(strpos($key,'category_id') !== false) {
//                    $count++;
//                }
//            }
            $i = 1;
            foreach ($cat_id_ar as $key => $value) {
                if (strpos($key, 'category_id') !== false) {
                    $count++;
                }
                $categories[$i] = $key;
                $i++;
            }

            //create category array of each category field
//            for($i = 1; $i <= $count; $i++) {
//                //${$params_label.$i} = '';
//                if($instance['category_id_'.$i] !== '-1') { //don't render 'all categories' item
//                    $categories[$i] = $instance['category_id_' . $i];
//                }
//                unset($instance['category_id_'.$i]);
//            }
            //generate shortcode params
            foreach ($categories as $key => $value) {

                ${$params_label . $key} = '';
                foreach ($instance as $id => $val) {
                    ${$params_label . $key} .= " " . $id . " = '" . $val . "' ";
                }
                ${$params_label . $key} .= " category_id = '" . $value . "' ";
            }
        }

        echo '<div class="widget mkd-plw-tabs">';
        echo '<div class="mkd-plw-tabs-inner">';
        echo '<div class="mkd-plw-tabs-tabs-holder">';
        foreach ($categories as $key => $value) {
            $category_name = $value != 0 ? get_the_category_by_ID($value) : esc_html__('All', 'discussionwp');
            echo '<div class="mkd-plw-tabs-tab"><a href="' . site_url() . "/" . $cat_lnk[$value] . '"><span class="item_text">' . $category_name . '</span></a></div>';
        }
        echo '</div>'; //close div.mkd-plw-tabs-tabs-holder

        echo '<div class="mkd-plw-tabs-content-holder">';
        foreach ($cat_id_ar as $key => $value) {
            $sub_categories = get_categories('child_of=' . $key . '&hide_empty=0');


            $i = 1;
            ?>
                <div class="mkd-plw-tabs-content">
                <?php foreach ($sub_categories as $category) { ?>

                    <?php if ($i == 1 || $i % 3 == 1): ?>
                            <div class="mkd-bnl-holder mkd-pl-five-holder  mkd-post-columns-3">
                                <div class="mkd-bnl-outer">
                                    <div class="mkd-bnl-inner">
                            <?php
                        endif;
                        ?>

                                    <div class="mkd-pt-five-item mkd-post-item">
                                        <div class="mkd-pt-five-item-inner">
                                            <div class="mkd-pt-five-top-content">

                                                <!-- image section -->
                                                <div class="mkd-pt-five-image">
                                                    <a itemprop="url" class="mkd-pt-five-link mkd-image-link" href="<?php echo esc_url(get_category_link($category->term_id)) ?>" target="_self">
                <?php
                $attr = array(
                    'class' => '',
                    'alt' => $category->name,
                    //                        'height' =>198,
                    //                        'width' => 302,
                    'title' => $category->name,
                );
                z_taxonomy_image($category->term_id, 'full', $attr);

                //echo '<img src="'.z_taxonomy_image_url($category->term_id).'" alt="'.$category->name.'" width="'.$instance['thumb_image_width'].'" height="'.$instance['thumb_image_height'].'" />';
                // echo discussion_generate_thumbnail(z_taxonomy_image_url($category->term_id),null,$thumb_image_width,$thumb_image_height);
                ?>	
                                                    </a></div>	


                                                <div class="mkd-pt-five-content">
                                                    <div class="mkd-pt-five-content-inner">
                                                        <h6 class="mkd-pt-five-title">
                                                            <a itemprop="url" class="mkd-pt-link" href="<?php echo esc_url(get_category_link($category->term_id)) ?>" target="_self">
                <?php
                echo $category->name;
                ?>
                                                            </a> 
                                                        </h6>   
                                                        <div class="mkd-pt-one-excerpt">                                                    
                                                        </div>
                                                    </div>			
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                <?php if ($i % 3 == 0 || $i == count($sub_categories)): ?>
                                    </div>
                                </div>
                            </div>
                                        <?php
                                    endif;
                                    $i++;
                                    //echo do_shortcode('[mkd_post_layout_'.$layout.' '.${$params_label.$key}.']'); // XSS OK
//                        echo'</div>';
                                }
                                ?>
                </div>
                    <?php
                }
                echo '</div>'; //close div.mkd-plw-tabs-content-holder
                echo '</div>'; //close div.mkd-plw-tabs-inner
                echo '</div>'; //close div.mkd-plw-tabs
            }

        }

        add_action('widgets_init', create_function('', 'return register_widget("DiscussionCategoryLayoutTabs");'));
        ?>
