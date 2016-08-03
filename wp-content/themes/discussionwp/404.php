<?php

/***** Set params for posts on 404 page *****/

$params = '';

$number_of_posts = 8;
$params .= ' number_of_posts="'.$number_of_posts.'"';	

$column_number = 4;
$params .= ' column_number="'.$column_number.'"';

$title_tag = 'h5';
$params .= ' title_tag="'.$title_tag.'"';

$display_category = 'yes';
$params .= ' display_category="'.$display_category.'"';

$display_excerpt = 'no';
$params .= ' display_excerpt="'.$display_excerpt.'"';

$display_share = 'no';
$params .= ' display_share="'.$display_share.'"';

$display_count = 'no';
$params .= ' display_count="'.$display_count.'"';

$display_comments = 'no';
$params .= ' display_comments="'.$display_comments.'"';

$display_read_more = 'no';
$params .= ' display_read_more="'.$display_read_more.'"';
?>
<?php get_header(); ?>
<?php discussion_get_title(); ?>
	<div class="mkd-container">
	<?php do_action('discussion_after_container_open'); ?>
		<div class="mkd-container-inner mkd-404-page">
			<div class="mkd-page-not-found">
				<span class="mkd-not-found-icon ion-sad-outline"></span>
				<h1>
					<?php if(discussion_options()->getOptionValue('404_title')){
						echo esc_html(discussion_options()->getOptionValue('404_title'));
					} else {
						esc_html_e('Sorry.......404 Error Page', 'discussionwp');
					} ?>
				</h1>
				<h4>
					<?php if(discussion_options()->getOptionValue('404_text')){
						echo esc_html(discussion_options()->getOptionValue('404_text'));
					} else {
						esc_html_e("Sorry, but the page you are looking for doesn't exist.", "discussionwp");
					} ?>
				</h4>
				<?php
					$button_params = array();
					if (discussion_options()->getOptionValue('404_back_to_home')){
						$button_params['text'] = discussion_options()->getOptionValue('404_back_to_home');
					} else {
						$button_params['text'] = "Back To Home Page";
					}
					$button_params['type'] = 'solid';
					$button_params['size'] = 'medium';
					$button_params['link'] = esc_url(home_url('/'));
					$button_params['target'] = '_self';
				echo discussion_execute_shortcode('mkd_button', $button_params);?>


			</div>
			<?php echo discussion_execute_shortcode('mkd_section_title', array('title' => esc_html__('Don\'t Miss','discussionwp'))); ?>
			<?php echo do_shortcode("[mkd_post_layout_one $params]"); ?>
		</div>
		<?php do_action('discussion_before_container_close'); ?>
	</div>
<?php get_footer(); ?>