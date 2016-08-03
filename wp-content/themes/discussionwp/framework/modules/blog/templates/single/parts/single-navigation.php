<?php if(discussion_options()->getOptionValue('blog_single_navigation') == 'yes'){ ?>
	<?php $navigation_blog_through_category = discussion_options()->getOptionValue('blog_navigation_through_same_category') ?>
	<div class="mkd-blog-single-navigation">
		<?php if(get_previous_post() != ""){

			if($navigation_blog_through_category == 'yes'){
				if(get_previous_post(true) != ""){
					$prev_post = get_previous_post(true);
				}
			} else {
				if(get_previous_post() != ""){
					$prev_post = get_previous_post();
				}
			}

			$prev_post_ID = $prev_post->ID;
			$prev_background_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($prev_post_ID),'discussion_landscape');
			$prev_post_thumbnail = $prev_background_image_src[0];
			$prev_classes = '';

			if ($prev_post_thumbnail == ''){
				$prev_classes = 'mkd-nav-no-img';
			}

			$prev_post_title = '';

			if($prev_post->post_title != '') {
				$prev_post_title = $prev_post->post_title;
			}

			$prev_html = '<div class="mkd-prev-holder '.esc_attr($prev_classes).'">';
			$prev_html .= '<span class="mkd-nav-arrows ion-ios-arrow-left"></span>';
			$prev_html .= '<div class="mkd-prev-image" style="background-image:url('.esc_url($prev_post_thumbnail).');">';
			$prev_html .= '</div>';
			$prev_html .= '<div class="mkd-prev-title">';
			$prev_html .= '<span class="mkd-prev-text">'.esc_html__('Previous Article','discussionwp').'</span>';
			$prev_html .= '<h5>'.esc_html(discussion_get_title_substring($prev_post_title, 34)).'</h5>';
			$prev_html .= '</div>';
			$prev_html .= '</div>';
			?>
			<div class="mkd-blog-single-prev">
				<?php
				if($navigation_blog_through_category == 'yes'){
					previous_post_link('%link', $prev_html, true,'','category');
					
				} else {
					previous_post_link('%link',$prev_html);
				}
				?>
			</div>
		<?php } ?>
		<?php if(get_next_post() != ""){
			if($navigation_blog_through_category == 'yes'){
				if(get_next_post(true) != ""){
					$next_post = get_next_post(true);
				}
			} else {
				if(get_next_post() != ""){
					$next_post = get_next_post();
				}
			}

			$next_post_ID = $next_post->ID;
			$next_background_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($next_post_ID),'discussion_landscape');
			$next_post_thumbnail = $next_background_image_src[0];
			$next_classes = '';

			if ($next_post_thumbnail == ''){
				$next_classes = 'mkd-nav-no-img';
			}

			$next_post_title = '';

			if($next_post->post_title != '') {
				$next_post_title = $next_post->post_title;
			}

			$next_html = '<div class="mkd-next-holder '.esc_attr($next_classes).'">';
			$next_html .= '<div class="mkd-next-title">';
			$next_html .= '<span class="mkd-next-text">'.esc_html__('Next Article','discussionwp').'</span>';
			$next_html .= '<h5>'.esc_html(discussion_get_title_substring($next_post_title, 34)).'</h5>';
			$next_html .= '</div>';
			$next_html .= '<div class="mkd-next-image" style="background-image:url('.esc_url($next_post_thumbnail).');">';
			$next_html .= '</div>';
			$next_html .= '<span class="mkd-nav-arrows ion-ios-arrow-right"></span>';
			$next_html .= '</div>';

			?>
			<div class="mkd-blog-single-next">
				<?php
				if($navigation_blog_through_category == 'yes'){
					next_post_link('%link', $next_html, true,'','category');
				} else {
					next_post_link('%link',$next_html);
				}
				?>
			</div>
		<?php } ?>
	</div>
<?php } ?>