<?php 

$template_type = discussion_options()->getOptionValue('blog_list_type');



$params = array();

if ($template_type == "type1") {

	$template_type_layout = 'post-template-five';

	$template_classes="mkd-pl-five-holder mkd-post-columns-1";

	$params['title_tag'] = 'h3';
	$params['title_length'] = '';
	$params['display_date'] = 'yes';
	$params['date_format'] = 'd. F Y';
	$params['display_category'] = 'no';
	$params['display_comments'] = 'yes';
	$params['display_share'] = 'yes';
	$params['display_count'] = 'yes';
	$params['display_excerpt'] = 'no';
	$params['excerpt_length'] = '20';
	$params['display_read_more'] = 'no';
	$params['thumb_image_size'] = '';
	$params['thumb_image_width'] = '';
	$params['thumb_image_height'] = '';

} else if ($template_type == "type2") {

	$template_type_layout = 'post-template-one';

	$template_classes="mkd-pl-one-holder mkd-post-columns-1";

	$params['title_tag'] = 'h3';
	$params['title_length'] = '';
	$params['display_date'] = 'yes';
	$params['date_format'] = 'd. F Y';
	$params['display_category'] = 'no';
	$params['display_comments'] = 'yes';
	$params['display_share'] = 'yes';
	$params['display_count'] = 'yes';
	$params['display_rating'] = 'no';
	$params['display_excerpt'] = 'yes';
	$params['excerpt_length'] = '40';
	$params['display_read_more'] = 'yes';
	$params['thumb_image_size'] = '';
	$params['thumb_image_width'] = '';
	$params['thumb_image_height'] = '';

} else if ($template_type == "type3") {

	$template_type_layout = 'post-template-two';

	$template_classes="mkd-pl-two-holder mkd-post-columns-1";

	$params['title_tag'] = 'h3';
	$params['title_length'] = '29';
	$params['display_date'] = 'yes';
	$params['date_format'] = 'd. F Y';
	$params['display_category'] = 'yes';
	$params['display_comments'] = 'yes';
	$params['display_share'] = 'yes';
	$params['display_count'] = 'no';
	$params['display_excerpt'] = 'yes';
	$params['excerpt_length'] = '35';
	$params['custom_thumb_image_width'] = '312';
	$params['custom_thumb_image_height'] = '240';
	$params['image_style'] = 'width: 312px';

} else if ($template_type == "type4") {

	$template_type_layout = 'post-template-three';

	$template_classes="mkd-pl-three-holder mkd-post-columns-2";

	$params['title_tag'] = 'h5';
	$params['title_length'] = '33';
	$params['display_date'] = 'yes';
	$params['date_format'] = 'd. F Y';
	$params['display_category'] = 'yes';
	$params['display_comments'] = 'yes';
	$params['display_share'] = 'no';
	$params['display_excerpt'] = 'yes';
	$params['excerpt_length'] = '6';
	$params['thumb_image_size'] = 'custom_size';
	$params['thumb_image_width'] = '474';
	$params['thumb_image_height'] = '410';

} else if ($template_type == "type5") {

	$template_type_layout = 'post-template-six';

	$template_classes="mkd-pl-six-holder mkd-post-columns-2";

	$params['title_tag'] = 'h4';
	$params['title_length'] = '30';
	$params['display_date'] = 'yes';
	$params['date_format'] = 'd. F Y';
	$params['display_category'] = 'yes';
	$params['display_comments'] = 'no';
	$params['display_share'] = 'no';
	$params['display_excerpt'] = 'no';
	$params['excerpt_length'] = '28';
	$params['thumb_image_size'] = '';
	$params['thumb_image_width'] = '';
	$params['thumb_image_height'] = '';
	$params['display_post_type_icon'] = 'no';

} else if ($template_type == "type6") {

	$template_type_layout = 'post-template-six';

	$template_classes="mkd-pl-six-holder mkd-post-columns-3";

	$params['title_tag'] = 'h5';
	$params['title_length'] = '32';
	$params['display_date'] = 'yes';
	$params['date_format'] = 'd. F Y';
	$params['display_category'] = 'yes';
	$params['display_comments'] = 'no';
	$params['display_share'] = 'no';
	$params['display_excerpt'] = 'no';
	$params['excerpt_length'] = '430';
	$params['thumb_image_size'] = '';
	$params['thumb_image_width'] = '';
	$params['thumb_image_height'] = '';
	$params['display_post_type_icon'] = 'no';
}

?>

<div class="mkd-unique-type clearfix">
	<?php
		if($blog_query->have_posts()){ ?>
			<div class="mkd-bnl-holder <?php echo esc_attr($template_classes);?>">
				<div class="mkd-bnl-outer">
					<div class="mkd-bnl-inner">
					<?php
						while ( $blog_query->have_posts() ) : $blog_query->the_post();
							echo discussion_get_list_shortcode_module_template_part($template_type_layout, 'templates', '', $params);
						endwhile;
					?>
					</div>
				</div>
			</div>
		<?php
		}
		else{
			discussion_get_module_template_part('templates/parts/no-posts', 'blog');
		}
	?>
</div>
<?php
	if(discussion_options()->getOptionValue('pagination') == 'yes') {
		discussion_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
	}
?>