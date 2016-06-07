<?php
if( !function_exists('discussion_get_blog') ) {
	/**
	 * Function which return holder for all blog lists
	 *
	 * @return holder.php template
	 */
	function discussion_get_blog($type) {

		$sidebar = discussion_sidebar_layout();

		$params = array(
			"blog_type" => $type,
			"sidebar" => $sidebar
		);

		discussion_get_module_template_part('templates/lists/holder', 'blog', '', $params);
	}
}

if( !function_exists('discussion_get_blog_type') ) {

	/**
	 * Function which create query for blog lists
	 *
	 * @return blog list template
	 */

	function discussion_get_blog_type($type) {
		global $wp_query;

		$id = discussion_get_page_id();
		$category = get_post_meta($id, "mkd_blog_category_meta", true);
		$post_number = esc_attr(get_post_meta($id, "mkd_show_posts_per_page_meta", true));

		$paged = discussion_paged();

		if(!is_archive()) {
			$blog_query = new WP_Query('post_type=post&paged=' . $paged . '&cat=' . $category . '&posts_per_page=' . $post_number);
		}else{
			$blog_query = $wp_query;
		}

		if(discussion_options()->getOptionValue('blog_page_range') != ""){
			$blog_page_range = esc_attr(discussion_options()->getOptionValue('blog_page_range'));
		} else{
			$blog_page_range = $blog_query->max_num_pages;
		}
		$params = array(
			'blog_query' => $blog_query,
			'paged' => $paged,
			'blog_page_range' => $blog_page_range,
			'blog_type' => $type
		);

		discussion_get_module_template_part('templates/lists/' .  $type, 'blog', '', $params);
	}
}

if( !function_exists('discussion_get_post_format_html') ) {

	/**
	 * Function which return html for post formats
	 * @param $type
	 * @return post hormat template
	 */

	function discussion_get_post_format_html($type = "") {

		$post_format = get_post_format();
		$supported_post_formats = array('audio', 'video', 'link', 'quote', 'gallery');
		
		if(in_array($post_format, $supported_post_formats)) {
			$post_format = $post_format;
		} else {
			$post_format = 'standard';
		}

		$slug = '';
		if($type !== ""){
			$slug = $type;
		}

		$params = array();

		$chars_array = discussion_blog_lists_number_of_chars();
		if(isset($chars_array[$type])) {
			$params['excerpt_length'] = $chars_array[$type];
		} else {
			$params['excerpt_length'] = '';
		}

		$display_category = 'yes';
		if(discussion_options()->getOptionValue('blog_list_category') !== ''){
			$display_category = discussion_options()->getOptionValue('blog_list_category');
		}

		$params['display_category'] = $display_category;

		$display_date = 'yes';
		if(discussion_options()->getOptionValue('blog_list_date') !== ''){
			$display_date = discussion_options()->getOptionValue('blog_list_date');
		}

		$params['display_date'] = $display_date;

		$display_author = 'no';
		if(discussion_options()->getOptionValue('blog_list_author') !== ''){
			$display_author = discussion_options()->getOptionValue('blog_list_author');
		}

		$params['display_author'] = $display_author;
	
		$display_comments = 'yes';
		if(discussion_options()->getOptionValue('blog_list_comment') !== ''){
			$display_comments = discussion_options()->getOptionValue('blog_list_comment');
		}

		$params['display_comments'] = $display_comments;
	
		$display_like = 'no';
		if(discussion_options()->getOptionValue('blog_list_like') !== ''){
			$display_like = discussion_options()->getOptionValue('blog_list_like');
		}

		$params['display_like'] = $display_like;
	
		$display_share = 'no';
		if(discussion_options()->getOptionValue('blog_list_share') !== ''){
			$display_share = discussion_options()->getOptionValue('blog_list_share');
		}

		$params['display_share'] = $display_share;

		$display_count = 'no';
		if(discussion_options()->getOptionValue('blog_list_count') !== ''){
			$display_count = discussion_options()->getOptionValue('blog_list_count');
		}

		$params['display_count'] = $display_count;
	
		$display_feature_image = true;
		if(discussion_options()->getOptionValue('blog_list_feature_image') === 'no'){
			$display_feature_image = false;
		}

		$params['display_feature_image'] = $display_feature_image;
	
		$display_read_more = false;
		if(discussion_options()->getOptionValue('blog_list_read_more') === 'yes'){
			$display_read_more = true;
		}

		$params['display_read_more'] = $display_read_more;
	
		discussion_get_module_template_part('templates/lists/post-formats/' . $post_format, 'blog', $slug, $params);
	}
}

if( !function_exists('discussion_get_default_blog_list') ) {
	/**
	 * Function which return default blog list for archive post types
	 *
	 * @return post format template
	 */

	function discussion_get_default_blog_list() {

		$blog_list = discussion_options()->getOptionValue('blog_list_type');

		if (strpos($blog_list, 'type') !== false){
			$blog_list = 'unique-type';
		}

		return $blog_list;
	}
}

if( !function_exists('discussion_get_category_blog_list') ) {
	/**
	 * Function which return blog list for category post types
	 *
	 * @return post format template
	 */

	function discussion_get_category_blog_list() {

		$blog_list = discussion_options()->getOptionValue('blog_list_type');
		
		if (strpos($blog_list, 'type') !== false){
			$blog_list = 'unique-type';
		}

		if(discussion_options()->getOptionValue('unique_category_layout') === 'yes'){
			$blog_list = 'unique-category-layout';
		}

		return $blog_list;
	}
}

if( !function_exists('discussion_get_author_blog_list') ) {
	/**
	 * Function which return blog list for author post types
	 *
	 * @return post format template
	 */

	function discussion_get_author_blog_list() {

		$blog_list = discussion_options()->getOptionValue('blog_list_type');
		
		if (strpos($blog_list, 'type') !== false){
			$blog_list = 'unique-type';
		}

		if(discussion_options()->getOptionValue('unique_author_layout') === 'yes'){
			$blog_list = 'unique-author-layout';
		}

		return $blog_list;
	}
}

if( !function_exists('discussion_get_tag_blog_list') ) {
	/**
	 * Function which return blog list for tag post types
	 *
	 * @return post format template
	 */

	function discussion_get_tag_blog_list() {

		$blog_list = discussion_options()->getOptionValue('blog_list_type');
		
		if (strpos($blog_list, 'type') !== false){
			$blog_list = 'unique-type';
		}
		
		if(discussion_options()->getOptionValue('unique_tag_layout') === 'yes'){
			$blog_list = 'unique-tag-layout';
		}

		return $blog_list;
	}
}

if (!function_exists('discussion_pagination')) {

	/**
	 * Function which return pagination
	 *
	 * @return blog list pagination html
	 */

	function discussion_pagination($pages = '', $range = 4, $paged = 1){

		$showitems = $range+1;

		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages){
				$pages = 1;
			}
		}
		if(1 != $pages){

			echo '<span class="mkd-pagination-new-holder">'. get_the_posts_pagination().'</span>';

			echo '<div class="mkd-pagination">';
				echo '<ul>';
					if($paged > 2 && $paged > $range+1 && $showitems < $pages){
						echo '<li class="mkd-pagination-first-page"><a href="'.esc_url(get_pagenum_link(1)).'"><span class="mkd-pagination-icon arrow_carrot-2left"></span></a></li>';
					}
					if ($paged > 1) {
						echo "<li class='mkd-pagination-prev'><a href='".esc_url(get_pagenum_link($paged - 1))."'><span class='mkd-pagination-icon arrow_carrot-left'></span></a></li>";
					}
					for ($i=1; $i <= $pages; $i++){
						if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
							echo ($paged == $i)? "<li class='active'><span>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
						}
					}
					if ($paged !== intval($pages)){
						echo '<li class="mkd-pagination-next"><a href="';
						if($pages > $paged){
							echo esc_url(get_pagenum_link($paged + 1));
						} else {
							echo esc_url(get_pagenum_link($paged));
						}
						echo '"><span class="mkd-pagination-icon arrow_carrot-right"></span></a></li>';
					}

					if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
						echo '<li class="mkd-pagination-last-page"><a href="'.esc_url(get_pagenum_link($pages)).'"><span class="mkd-pagination-icon arrow_carrot-2right"></span></a></li>';
					}
				echo '</ul>';
			echo "</div>";
		}
	}
}

if(!function_exists('discussion_post_info')){
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
	function discussion_post_info($config,$slug = ''){
		$default_config = array(
			'date' => '',
			'category' => '',
			'author' => '',
			'comments' => '',
			'like' => '',
			'count' => '',
			'share' => '',
			'rating' => ''
		);

		extract(shortcode_atts($default_config, $config));

		if($share == 'yes'){
			discussion_get_module_template_part('templates/parts/post-info/post-info-share', 'blog');
		}
		if($comments == 'yes'){
			discussion_get_module_template_part('templates/parts/post-info/post-info-comments', 'blog');
		}
		if($count == 'yes'){
			discussion_get_module_template_part('templates/parts/post-info/post-info-count', 'blog',$slug);
		}
		if($date == 'yes'){
			discussion_get_module_template_part('templates/parts/post-info/post-info-date', 'blog','',array('date_format' => ''));
		}
		if($author == 'yes'){
			discussion_get_module_template_part('templates/parts/post-info/post-info-author', 'blog');
		}
		if($like == 'yes'){
			discussion_get_module_template_part('templates/parts/post-info/post-info-like', 'blog');
		}
		if($category == 'yes'){
			discussion_get_module_template_part('templates/parts/post-info/post-info-category', 'blog');
		}
		if($rating == 'yes'){
			discussion_get_module_template_part('templates/parts/post-info/post-info-rating', 'blog');
		}
	}
}

if(!function_exists('discussion_post_info_date')){
	/**
	 * Function that loads parts of blog post date info section
	 *
	 * @param $config array of sections to load
	 */
	function discussion_post_info_date($config){
		$default_config = array(
			'date' => '',
            'date_format' => ''
		);

		$params = (shortcode_atts($default_config, $config));

		if($params['date'] == 'yes'){
			discussion_get_module_template_part('templates/parts/post-info/post-info-date', 'blog', '', $params);
		}
	}
}

if(!function_exists('discussion_post_info_category')){
	/**
	 * Function that loads parts of blog post category info section
	 *
	 * @param $config array of sections to load
	 */
	function discussion_post_info_category($config){
		$default_config = array(
			'category' => ''
		);

        $params = (shortcode_atts($default_config, $config));

		if($params['category'] == 'yes'){
			discussion_get_module_template_part('templates/parts/post-info/post-info-category', 'blog', '', $params);
		}
	}
}

if(!function_exists('discussion_post_info_author')){
	/**
	 * Function that loads parts of blog post author info section
	 *
	 * @param $config array of sections to load
	 */
	function discussion_post_info_author($config){
		$default_config = array(
			'author' => ''
		);

        $params = (shortcode_atts($default_config, $config));

		if($params['author'] == 'yes'){
			discussion_get_module_template_part('templates/parts/post-info/post-info-author', 'blog', '', $params);
		}
	}
}

if(!function_exists('discussion_post_info_comments')){
	/**
	 * Function that loads parts of blog post comments info section
	 *
	 * @param $config array of sections to load
	 */
	function discussion_post_info_comments($config){
		$default_config = array(
			'comments' => ''
		);

        $params = (shortcode_atts($default_config, $config));

        if($params['comments'] == 'yes'){
            discussion_get_module_template_part('templates/parts/post-info/post-info-comments', 'blog', '', $params);
		}
	}
}

if(!function_exists('discussion_post_info_like')){
    /**
     * Function that loads parts of blog post author info section
     *
     * @param $config array of sections to load
     */
    function discussion_post_info_like($config){
        $default_config = array(
            'like' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        if($params['like'] == 'yes'){
            discussion_get_module_template_part('templates/parts/post-info/post-info-like', 'blog', '', $params);
        }
    }
}

if(!function_exists('discussion_post_info_count')){
    /**
     * Function that loads parts of blog post author info section
     *
     * @param $config array of sections to load
     */
    function discussion_post_info_count($config,$slug = ''){
        $default_config = array(
            'count' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        if($params['count'] == 'yes'){
            discussion_get_module_template_part('templates/parts/post-info/post-info-count', 'blog', $slug, $params);
        }
    }
}

if(!function_exists('discussion_post_info_share')){
    /**
     * Function that loads parts of blog post share info section
     *
     * @param $config array of sections to load
     */
    function discussion_post_info_share($config){
        $default_config = array(
            'share' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        if($params['share'] == 'yes'){
            discussion_get_module_template_part('templates/parts/post-info/post-info-share', 'blog', '', $params);
        }
    }
}

if(!function_exists('discussion_post_info_rating')){
    /**
     * Function that loads parts of blog post rating info section
     *
     * @param $config array of sections to load
     */
    function discussion_post_info_rating($config){
        $default_config = array(
            'rating' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        if($params['rating'] == 'yes'){
            discussion_get_module_template_part('templates/parts/post-info/post-info-rating', 'blog', '', $params);
        }
    }
}

if(!function_exists('discussion_post_info_type')){
    /**
     * Function that loads parts of blog post type icon section
     *
     * @param $config array of sections to load
     */
    function discussion_post_info_type($config){
        $default_config = array(
            'icon' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        $params['post_type'] = get_post_format() ? 'mkd-post-'.get_post_format(): 'mkd-post-standard';

        if($params['icon'] == 'yes'){
            discussion_get_module_template_part('templates/parts/post-info/post-info-icon-type', 'blog', '', $params);
        }
    }
}

if(!function_exists('discussion_excerpt')) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in mkd_set_blog_word_count function.
	 *
	 * It current post has read more tag set it will return content of the post, else it will return post excerpt
	 *
	 */
	function discussion_excerpt($excerpt_length) {
		global $post;

		if(post_password_required()) {
			echo get_the_password_form();
		}

		//does current post has read more tag set?
		elseif(discussion_post_has_read_more()) {
			global $more;

			//override global $more variable so this can be used in blog templates
			$more = 0;
			the_content(true);
		}

		//is word count set to something different that 0?
		elseif($excerpt_length != '0') {
			//if word count is set and different than empty take that value, else that general option from theme options
			$word_count = '45';
			if(isset($excerpt_length) && $excerpt_length != "") {
				$word_count = $excerpt_length;
			} elseif (discussion_options()->getOptionValue('number_of_chars') != '') {
				$word_count = esc_attr(discussion_options()->getOptionValue('number_of_chars'));
			}
			//if post excerpt field is filled take that as post excerpt, else that content of the post
			$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);

			//remove leading dots if those exists
			$clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

			//if clean excerpt has text left
			if($clean_excerpt !== '') {
				//explode current excerpt to words
				$excerpt_word_array = explode (' ', $clean_excerpt);

				//cut down that array based on the number of the words option
				$excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);

				//and finally implode words together
				$excerpt = implode (' ', $excerpt_word_array);

				//is excerpt different than empty string?
				if($excerpt !== '') {
					echo '<p class="mkd-post-excerpt">'.wp_kses_post($excerpt).'</p>';
				}
			}
		}
	}
}

if(!function_exists('discussion_get_blog_single')) {

	/**
	 * Function which return holder for single posts
	 *
	 * @return single holder.php template
	 */

	function discussion_get_blog_single() {
		$sidebar = discussion_sidebar_layout();

		$params = array(
			"sidebar" => $sidebar
		);

		discussion_get_module_template_part('templates/single/holder', 'blog', '', $params);
	}
}

if( !function_exists('discussion_get_single_html') ) {

	/**
	 * Function return all parts on single.php page
	 *
	 *
	 * @return single.php html
	 */
	function discussion_get_single_html() {

		$post_format = get_post_format();
		if($post_format === false){
			$post_format = 'standard';
		}

		$params = array();

		$display_category = 'yes';
		if(discussion_options()->getOptionValue('blog_single_category') !== ''){
			$display_category = discussion_options()->getOptionValue('blog_single_category');
		}

		$display_date = 'yes';
		if(discussion_options()->getOptionValue('blog_single_date') !== ''){
			$display_date = discussion_options()->getOptionValue('blog_single_date');
		}

		$display_author = 'yes';
		if(discussion_options()->getOptionValue('blog_single_author') !== ''){
			$display_author = discussion_options()->getOptionValue('blog_single_author');
		}

		$display_comments = 'yes';
		if(discussion_options()->getOptionValue('blog_single_comment') !== ''){
			$display_comments = discussion_options()->getOptionValue('blog_single_comment');
		}

		$display_like = 'no';
		if(discussion_options()->getOptionValue('blog_single_like') !== ''){
			$display_like = discussion_options()->getOptionValue('blog_single_like');
		}

		$display_count = 'yes';
		if(discussion_options()->getOptionValue('blog_single_count') !== ''){
			$display_count = discussion_options()->getOptionValue('blog_single_count');
		}

		$params['display_category'] = $display_category;
		$params['display_date'] = $display_date;
		$params['display_author'] = $display_author;
		$params['display_comments'] = $display_comments;
		$params['display_like'] = $display_like;
		$params['display_count'] = $display_count;

		discussion_get_module_template_part('templates/single/post-formats/' . $post_format, 'blog','',$params);
		
		discussion_get_module_template_part('templates/single/parts/tags', 'blog');
		discussion_get_module_template_part('templates/single/parts/single-navigation', 'blog');

		$show_ratings = (discussion_options()->getOptionValue('blog_single_ratings') == 'yes') ? true : false;
		if($show_ratings){
			discussion_get_module_template_part('templates/single/parts/ratings', 'blog', '');
		}

		discussion_get_module_template_part('templates/single/parts/author-info', 'blog');

		discussion_get_single_related_posts();

		if(discussion_show_comments()){
			comments_template('', true);
		}
	}
}

if( !function_exists('discussion_get_single_related_posts') ) {

	/**
	 * Function returns related posts on single.php page
	 *
	 *
	 * @return single.php html
	 */
	function discussion_get_single_related_posts() {

		$post_id = discussion_get_page_id();

		//Related posts
		$related_posts_params = array();
		$show_related = (discussion_options()->getOptionValue('blog_single_related_posts') == 'yes') ? true : false;
		if ($show_related) {
			$hasSidebar = discussion_sidebar_layout();
			$related_post_number = ($hasSidebar == '' || $hasSidebar == 'default' || $hasSidebar == 'no-sidebar') ? 4 : 3;
			$related_posts_options = array('posts_per_page' => $related_post_number);
			$related_posts_image_size = (discussion_options()->getOptionValue('blog_single_related_image_size') !== '') ? intval(discussion_options()->getOptionValue('blog_single_related_image_size')) : '';
			$related_posts_title_size = (discussion_options()->getOptionValue('blog_single_related_title_size') !== '') ? intval(discussion_options()->getOptionValue('blog_single_related_title_size')) : '30';
			$related_posts_params = array('related_posts' => discussion_get_related_post_type($post_id, $related_posts_options), 'related_posts_image_size' => $related_posts_image_size, 'related_posts_title_size' => $related_posts_title_size);
		}

		if ($show_related) {
			discussion_get_module_template_part('templates/single/parts/related-posts', 'blog', '', $related_posts_params);
		}
	}
}

if( !function_exists('discussion_additional_post_items') ) {

	/**
	 * Function which return parts on single.php which are just below content
	 *
	 * @return single.php html
	 */
	function discussion_additional_post_items() {

		if(discussion_options()->getOptionValue('blog_single_share') == 'yes'){
			discussion_get_module_template_part('templates/single/parts/share', 'blog');
		}

		$args_pages = array(
			'before'           => '<div class="mkd-single-links-pages"><div class="mkd-single-links-pages-inner">',
			'after'            => '</div></div>',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'pagelink'         => '%'
		);

		wp_link_pages($args_pages);
	}
	add_action('discussion_before_blog_article_closed_tag', 'discussion_additional_post_items');
}

if( !function_exists('discussion_additional_post_list_items') ) {

    /**
     * Function which return parts on default blog list which are just below content
     *
     * @return tags html
     */
    function discussion_additional_post_list_items() {

        discussion_get_module_template_part('templates/lists/parts/tags', 'blog');

        $args_pages = array(
            'before'           => '<div class="mkd-single-links-pages"><div class="mkd-single-links-pages-inner">',
            'after'            => '</div></div>',
            'link_before'      => '<span>',
            'link_after'       => '</span>',
            'pagelink'         => '%'
        );

        wp_link_pages($args_pages);

    }
    add_action('discussion_blog_list_tags', 'discussion_additional_post_list_items');
}


if (!function_exists('discussion_comment')) {

	/**
	 * Function which modify default wordpress comments
	 *
	 * @return comments html
	 */
	function discussion_comment($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;

		global $post;

		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment  = $post->post_author == $comment->user_id;

		$comment_class = 'mkd-comment clearfix';

		if($is_author_comment) {
			$comment_class .= ' mkd-post-author-comment';
		}

		if($is_pingback_comment) {
			$comment_class .= ' mkd-pingback-comment';
		}
		?>
		<li>
		<div class="<?php echo esc_attr($comment_class); ?>">
			<?php if(!$is_pingback_comment) { ?>
				<div class="mkd-comment-image"> <?php echo discussion_kses_img(get_avatar($comment, 85)); ?> </div>
			<?php } ?>
			<div class="mkd-comment-text-and-info">
				<div class="mkd-comment-info-and-links">
					<h6 class="mkd-comment-name">
						<?php if($is_pingback_comment) { esc_html_e('Pingback:', 'discussionwp'); } ?><span class="mkd-comment-author"><?php echo wp_kses_post(get_comment_author_link()); ?></span>
						<?php if($is_author_comment) { ?>
						<span class="mkd-comment-mark"><?php esc_html_e('/', 'discussionwp'); ?></span>
						<span class="mkd-comment-author-label"><?php esc_html_e('Author', 'discussionwp'); ?></span>
						<?php } ?>
					</h6>
					<h6 class="mkd-comment-links">
						<?php
							comment_reply_link( array_merge( $args, array('reply_text' => esc_html__('Reply', 'discussionwp'), 'depth' => $depth, 'max_depth' => $args['max_depth']) ) );
						?>
							<span class="mkd-comment-mark"><?php esc_html_e('/', 'discussionwp'); ?></span>
						<?php
							edit_comment_link(esc_html__('Edit','discussionwp'));
						?>
					</h6>
				</div>
				<?php if(!$is_pingback_comment) { ?>
					<div class="mkd-comment-text">
						<div class="mkd-text-holder" id="comment-<?php echo comment_ID(); ?>">
							<?php comment_text(); ?>
							<span class="mkd-comment-date"><?php comment_time(get_option('date_format')); ?></span>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>
		<?php
	}
}

if( !function_exists('discussion_blog_archive_pages_classes') ) {

	/**
	 * Function which create classes for container in archive pages
	 *
	 * @return array
	 */
	function discussion_blog_archive_pages_classes($blog_type) {

		$classes = array();
		if(in_array($blog_type, discussion_blog_full_width_types())){
			$classes['holder'] = 'mkd-full-width';
			$classes['inner'] = 'mkd-full-width-inner';
		} elseif(in_array($blog_type, discussion_blog_grid_types())){
			$classes['holder'] = 'mkd-container';
			$classes['inner'] = 'mkd-container-inner clearfix';
		}

		return $classes;
	}
}

if( !function_exists('discussion_blog_full_width_types') ) {

	/**
	 * Function which return all full width blog types
	 *
	 * @return array
	 */
	function discussion_blog_full_width_types() {

		$types = array();

		return $types;
	}
}

if( !function_exists('discussion_blog_grid_types') ) {

	/**
	 * Function which return in grid blog types
	 *
	 * @return array
	 */
	function discussion_blog_grid_types() {

		$types = array('standard', 'standard-whole-post', 'unique-category-layout', 'unique-author-layout','unique-tag-layout','unique-type');

		return $types;
	}
}

if( !function_exists('discussion_blog_types') ) {

	/**
	 * Function which return all blog types
	 *
	 * @return array
	 */
	function discussion_blog_types() {

		$types = array_merge(discussion_blog_grid_types(), discussion_blog_full_width_types());

		return $types;
	}
}

if( !function_exists('discussion_blog_templates') ) {

	/**
	 * Function which return all blog templates names
	 *
	 * @return array
	 */
	function discussion_blog_templates() {

		$templates = array();
		$grid_templates = discussion_blog_grid_types();
		$full_templates = discussion_blog_full_width_types();
		foreach($grid_templates as $grid_template){
			array_push($templates, 'blog-'.$grid_template);
		}
		foreach($full_templates as $full_template){
			array_push($templates, 'blog-'.$full_template);
		}

		return $templates;
	}
}

if( !function_exists('discussion_blog_lists_number_of_chars') ) {

	/**
	 * Function that return number of characters for different lists based on options
	 *
	 * @return int
	 */
	function discussion_blog_lists_number_of_chars() {

		$number_of_chars = array();
		if(discussion_options()->getOptionValue('standard_number_of_chars')) {
			$number_of_chars['standard'] = discussion_options()->getOptionValue('standard_number_of_chars');
		}

		return $number_of_chars;
	}
}

if (!function_exists('discussion_excerpt_length')) {
	
	/**
	 * Function that changes excerpt length based on theme options
	 * @param $length int original value
	 * @return int changed value
	 */
	function discussion_excerpt_length( $length ) {

		if(discussion_options()->getOptionValue('number_of_chars') !== ''){
			return esc_attr(discussion_options()->getOptionValue('number_of_chars'));
		} else {
			return 45;
		}
	}

	add_filter( 'excerpt_length', 'discussion_excerpt_length', 999 );
}

if(!function_exists('discussion_post_has_read_more')) {
	
	/**
	 * Function that checks if current post has read more tag set
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function discussion_post_has_read_more() {
		global $post;

		return strpos($post->post_content, '<!--more-->');
	}
}

if(!function_exists('discussion_post_has_title')) {
	
	/**
	 * Function that checks if current post has title or not
	 * @return bool
	 */
	function discussion_post_has_title() {
		return get_the_title() !== '';
	}
}

if (!function_exists('discussion_modify_read_more_link')) {
	
	/**
	 * Function that modifies read more link output.
	 * Hooks to the_content_more_link
	 * @return string modified output
	 */
	function discussion_modify_read_more_link() {
		$link = '<div class="mkd-more-link-container">';
		$link .= discussion_get_button_html(array(
			'link' => get_permalink().'#more-'.get_the_ID(),
			'text' => esc_html__('Continue reading', 'discussionwp')
		));

		$link .= '</div>';

		return $link;
	}

	add_filter( 'the_content_more_link', 'discussion_modify_read_more_link');
}

if(!function_exists('discussion_load_blog_assets')) {
	
	/**
	 * Function that checks if blog assets should be loaded
	 *
	 * @see mkd_is_blog_template()
	 * @see is_home()
	 * @see is_single()
	 * @see mkd_has_blog_shortcode()
	 * @see is_archive()
	 * @see is_search()
	 * @see mkd_has_blog_widget()
	 * @return bool
	 */
	function discussion_load_blog_assets() {
		return discussion_is_blog_template() || is_home() || is_single() || is_archive() || is_search();
	}
}

if(!function_exists('discussion_is_blog_template')) {
	
	/**
	 * Checks if current template page is blog template page.
	 *
	 *@param string current page. Optional parameter.
	 *
	 *@return bool
	 *
	 * @see discussion_get_page_template_name()
	 */
	function discussion_is_blog_template($current_page = '') {

		if($current_page == '') {
			$current_page = discussion_get_page_template_name();
		}

		$blog_templates = discussion_blog_templates();

		return in_array($current_page, $blog_templates);
	}
}

if(!function_exists('discussion_read_more_button')) {
	
	/**
	 * Function that outputs read more button html if necessary.
	 * It checks if read more button should be outputted only if option for given template is enabled and post does'nt have read more tag
	 * and if post isn't password protected
	 *
	 * @param string $option name of option to check
	 * @param string $class additional class to add to button
	 *
	 */
	function discussion_read_more_button($option = '', $class = '') {
		if($option != '') {
			$show_read_more_button = discussion_options()->getOptionValue($option) == 'yes';
		}else {
			$show_read_more_button = 'yes';
		}
		if($show_read_more_button && !discussion_post_has_read_more() && !post_password_required()) {
			echo discussion_get_button_html(array(
				'size'         => '',
				'type'         => 'transparent',
				'link'         => get_the_permalink(),
				'text'         => esc_html__('Read More', 'discussionwp'),
				'icon_pack'    => 'ion_icons',
                'ion_icon'     => 'ion-log-in',
				'custom_class' => $class
			));
		}
	}
}

if(!function_exists('discussion_update_post_count_views')) {

	function discussion_update_post_count_views(){
		$postID = discussion_get_page_id();
		if(is_singular('post')){	
			if(isset($_COOKIE['mkd-post-views_'. $postID])){
				return;
			} else {
				$count = get_post_meta($postID, 'count_post_views', true);
				if ($count === ''){
					update_post_meta($postID, 'count_post_views', 1);
					setcookie('mkd-post-views_'. $postID, $postID, time()*20, '/');
				} else {
					$count++;
					update_post_meta($postID, 'count_post_views', $count);
					setcookie('mkd-post-views_'. $postID, $postID, time()*20, '/');
				}	
			}		
		}
	}

	add_action('wp', 'discussion_update_post_count_views');
}

if(!function_exists('discussion_get_post_count_views')) {

	function discussion_get_post_count_views($postID){
		$count = get_post_meta($postID, 'count_post_views', true);
		if($count === ''){
			update_post_meta($postID, 'count_post_views', '0');
			return 0;
		}
		return $count;
	}
}

if(!function_exists('discussion_post_rating_ajax_function')) {
    function discussion_post_rating_ajax_function() {

        $post_ID = '';
        $rating_value = '';
        if (!empty($_POST['postID'])) {
            $post_ID = $_POST['postID'];
        }
        if (!empty($_POST['value'])) {
            $rating_value = $_POST['value'];
        }

        $rateResponse = discussion_set_post_rating($rating_value, $post_ID); //update total count of rates

        $newRateCount = discussion_get_post_rating($post_ID); // get total count of votes

        $return_obj = array(
            'newCount' => $newRateCount,
            'rateAnswer' => $rateResponse
        );

        echo json_encode($return_obj);
        exit;

    }

    add_action('wp_ajax_discussion_post_rating_ajax_function', 'discussion_post_rating_ajax_function');
    add_action('wp_ajax_nopriv_discussion_post_rating_ajax_function', 'discussion_post_rating_ajax_function' );
}

if(!function_exists('discussion_get_post_rating')) {

    function discussion_get_post_rating($post_id = false){

        if($post_id == false) {
            $post_id = get_the_ID();
        }

        $rating_value = get_post_meta($post_id, 'mkd_post_rating_value' , true);
        $rating_number_of_rates = get_post_meta($post_id, 'mkd_post_rating_number' , true);
        if($rating_value == '' || $rating_number_of_rates == ''){
            update_post_meta($post_id, 'mkd_post_rating_value' , '0');
            update_post_meta($post_id, 'mkd_post_rating_number' , '0');
        }

        if($rating_number_of_rates > 0 && $rating_value > 0){
            return round($rating_value/$rating_number_of_rates, 2);
        }
        else{
            return 0;
        }
    }
}

if(!function_exists('discussion_set_post_rating')) {
/*
 * return string message in html
 */
    function discussion_set_post_rating($new_rating_value, $post_id = false){

        if($post_id == false){
            $post_id = get_the_ID();
        }

        if(isset($_COOKIE['mkd_post_rating_'. $post_id])){
            return '<span>'. esc_html__('You already rated this post!', 'discussionwp').'</span>';
        } else {

            $rating_number_of_rates = get_post_meta($post_id, 'mkd_post_rating_number' , true);
            $rating_value = get_post_meta($post_id, 'mkd_post_rating_value', true);

            if ($rating_number_of_rates == ''){
                update_post_meta($post_id, 'mkd_post_rating_number' , 1);
            } else {
                $rating_number_of_rates++;
                update_post_meta($post_id, 'mkd_post_rating_number', $rating_number_of_rates);
            }

            if ($rating_value == ''){
                update_post_meta($post_id, 'mkd_post_rating_value' , $new_rating_value);
                setcookie('mkd_post_rating_'. $post_id, $post_id, time()*20, '/');
                return '<span>'. esc_html__('Thank you! You have succesfully rated this post!', 'discussionwp').'</span>';
            } else {
                $rating_value += $new_rating_value ;
                update_post_meta($post_id, 'mkd_post_rating_value', $rating_value);
                setcookie('mkd_post_rating_'. $post_id, $post_id, time()*20, '/');
                return '<span>'. esc_html__('Thank you! You have succesfully rated this post!', 'discussionwp').'</span>';
            }
        }
    }
}

function discussion_taxonomy_custom_fields($tag) {
    $t_id = $tag->term_id; // Get the ID of the category you're editing  
	$term_meta = get_option( "post_tax_term_$t_id" );
    ?>

    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Template', 'discussionwp'); ?></label>
        </th>
        <td>
            <select name="term_meta[template]" id="term_meta[template]">
                <option <?php if( isset($term_meta['template']) && $term_meta['template'] == 'default' ){ echo "selected='selected'"; } ?> value='default'>Default</option>
                <option <?php if( isset($term_meta['template']) && $term_meta['template'] == 'type1' ){ echo "selected='selected'"; } ?> value='type1'>Template 1</option>
				<option <?php if( isset($term_meta['template']) && $term_meta['template'] == 'type2' ){ echo "selected='selected'"; } ?> value='type2'>Template 2</option>
				<option <?php if( isset($term_meta['template']) && $term_meta['template'] == 'type3' ){ echo "selected='selected'"; } ?> value='type3'>Template 3</option>
				<option <?php if( isset($term_meta['template']) && $term_meta['template'] == 'type4' ){ echo "selected='selected'"; } ?> value='type4'>Template 4</option>
				<option <?php if( isset($term_meta['template']) && $term_meta['template'] == 'type5' ){ echo "selected='selected'"; } ?> value='type5'>Template 5</option>
				<option <?php if( isset($term_meta['template']) && $term_meta['template'] == 'type6' ){ echo "selected='selected'"; } ?> value='type6'>Template 6</option>
            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Sidebar Layout', 'discussionwp'); ?></label>
        </th>
        <td>
            <select name="term_meta[sidebar_layout]" id="term_meta[sidebar_layout]">
                <option <?php if( isset($term_meta['sidebar_layout']) && $term_meta['sidebar_layout'] == '' ){ echo "selected='selected'"; } ?> value=''></option>
                <option <?php if( isset($term_meta['sidebar_layout']) && $term_meta['sidebar_layout'] == 'default' ){ echo "selected='selected'"; } ?> value='default'>No Sidebar</option>
                <option <?php if( isset($term_meta['sidebar_layout']) && $term_meta['sidebar_layout'] == 'sidebar-33-right' ){ echo "selected='selected'"; } ?> value='sidebar-33-right'>Sidebar 1/3 Right</option>
                <option <?php if( isset($term_meta['sidebar_layout']) && $term_meta['sidebar_layout'] == 'sidebar-25-right' ){ echo "selected='selected'"; } ?> value='sidebar-25-right'>Sidebar 1/4 Right</option>
                <option <?php if( isset($term_meta['sidebar_layout']) && $term_meta['sidebar_layout'] == 'sidebar-33-left' ){ echo "selected='selected'"; } ?> value='sidebar-33-left'>Sidebar 1/3 Left</option>
                <option <?php if( isset($term_meta['sidebar_layout']) && $term_meta['sidebar_layout'] == 'sidebar-25-left' ){ echo "selected='selected'"; } ?> value='sidebar-25-left'>Sidebar 1/4 Left</option>
            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Custom Sidebar To Display', 'discussionwp'); ?></label>
        </th>
        <td>
            <select name="term_meta[custom_sidebar]" id="term_meta[custom_sidebar]">
                <option <?php if( isset($term_meta['custom_sidebar']) && $term_meta['custom_sidebar'] == '' ){ echo "selected='selected'"; } ?> value=''></option>
                <?php
                $custom_sidebars = discussion_get_custom_sidebars();
                foreach ($custom_sidebars as $key => $value) { ?>
                    <option <?php if( isset($term_meta['custom_sidebar']) && $term_meta['custom_sidebar'] == $key ){ echo "selected='selected'"; } ?> value='<?php echo esc_attr($key); ?>'><?php echo esc_html($value); ?></option>
                <?php } ?>

            </select>
        </td>
    </tr>
	<tr class="form-field">
		<th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Template Settings', 'discussionwp'); ?></label>
        </th>
    </tr>
    <tr>
    	<th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e(' - Post Settings', 'discussionwp'); ?></label>
        </th>
        <td>
        	<div style="display: inline;">
				<label style="margin-right:5px" for="shortcode"><?php esc_html_e('Custom Image Width(px)', 'discussionwp'); ?></label>
				<input style="width:100px" type="text" name="term_meta[thumb_image_width]" id="term_meta[thumb_image_width]" size="3" value="<?php if( isset($term_meta['thumb_image_width']) && $term_meta['thumb_image_width'] != '' ){ echo esc_attr($term_meta['thumb_image_width']); } ?>">
			</div>
			<div style="display: inline;">
				<label style="margin-right:5px" for="shortcode"><?php esc_html_e('Custom Image Height(px)', 'discussionwp'); ?></label>
				<input style="width:100px" type="text" name="term_meta[thumb_image_height]" id="term_meta[thumb_image_height]" size="3" value="<?php if( isset($term_meta['thumb_image_height']) && $term_meta['thumb_image_height'] != '' ){ echo esc_attr($term_meta['thumb_image_height']); } ?>">
			</div>
			<div style="display: inline;">
				<label style="margin-right:5px" for="shortcode"><?php esc_html_e('Excerpt Length', 'discussionwp'); ?></label>
				<input style="width:100px" type="text" name="term_meta[excerpt_length]" id="term_meta[excerpt_length]" size="3" value="<?php if( isset($term_meta['excerpt_length']) && $term_meta['excerpt_length'] != '' ){ echo esc_attr($term_meta['excerpt_length']); } ?>">
			</div>
		</td>
    </tr>
    <tr>
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Number of posts per page', 'discussionwp'); ?></label>
        </th>
        <td>
            <input style="width:100px" type="text" name="term_meta[number_of_posts]" id="term_meta[number_of_posts]" size="3" value="<?php if( isset($term_meta['number_of_posts']) && $term_meta['number_of_posts'] != '' ){ echo esc_attr($term_meta['number_of_posts']); } ?>">
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Pagination Type', 'discussionwp'); ?></label>
        </th>
        <td>
            <select name="term_meta[pagination_type]" id="term_meta[pagination_type]">
                <option <?php if( isset($term_meta['pagination_type']) && $term_meta['pagination_type'] == 'np-horizontal' ){ echo "selected='selected'"; } ?> value='np-horizontal'>Horizontal Navigation</option>
                <option <?php if( isset($term_meta['pagination_type']) && $term_meta['pagination_type'] == 'load-more' ){ echo "selected='selected'"; } ?> value='load-more'>Load More</option>
                <option <?php if( isset($term_meta['pagination_type']) && $term_meta['pagination_type'] == 'infinite' ){ echo "selected='selected'"; } ?> value='infinite'>Infinite Scroll</option>
            </select>
        </td>
    </tr>
<?php
}

function discussion_save_taxonomy_custom_fields( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;		
		$term_meta = get_option( "post_tax_term_$t_id" );
		
        $cat_keys = array_keys( $_POST['term_meta'] );
        foreach ( $cat_keys as $key ){
            if ( isset( $_POST['term_meta'][$key] ) ){
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
		update_option( "post_tax_term_$t_id", $term_meta );		
    }
}

add_action( 'category_edit_form_fields', 'discussion_taxonomy_custom_fields', 10, 2 );
add_action( 'edited_term', 'discussion_save_taxonomy_custom_fields', 10, 2 );

?>