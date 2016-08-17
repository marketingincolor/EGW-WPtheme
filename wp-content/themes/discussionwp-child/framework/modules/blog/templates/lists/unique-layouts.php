<?php

$params = '';

if ($archive_type == 'category'){
	$posts_in_archive = $posts_in_category;
	$params .= ' category_id="'.$category_id.'"';
}
elseif($archive_type == 'author'){
	$posts_in_archive = '';
	$params .= ' author_id="'.$author_id.'"';
	$params .= ' title="'.$layout_title.'"';
}
elseif($archive_type == 'tag'){
	$posts_in_archive = '';
	$params .= ' tag_slug="'.$tag_slug.'"';
}

if($thumb_image_width != '' && $thumb_image_height != '') {
	$params .= ' thumb_image_size="custom_size"';
	$params .= ' thumb_image_width="'.$thumb_image_width.'"';
	$params .= ' thumb_image_height="'.$thumb_image_height.'"';
}

if($excerpt_length != ''){
	$params .= ' excerpt_length="'.$excerpt_length.'"';
}

$params .= ' title="'.esc_html__('Archive','discussionwp').'"';

if ($template_type == "type1") {

	if($posts_in_archive > 8 || $posts_in_archive == ''){
        $per_page  = $posts_per_page !== 0 ? $posts_per_page : 4;
		$number_of_posts = $per_page;
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	} else {
		$number_of_posts = $posts_in_archive;
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	}

	$column_number = 1;
	$params .= ' column_number="'.$column_number.'"';

	$display_pagination = 'yes';
	$params .= ' display_pagination="'.$display_pagination.'"';

	$params .= ' pagination_type="'.$pagination_type.'"';

	$extra_class_name = 'unique-category-template-one';
	$params .= ' extra_class_name="'.$extra_class_name.'"';

} else if ($template_type == "type2") {

	if($posts_in_archive > 9 || $posts_in_archive == ''){
        $per_page  = $posts_per_page !== 0 ? $posts_per_page : 4;
		$number_of_posts = $per_page;

		$params .= ' number_of_posts="'.$number_of_posts.'"';
	} else {
		$number_of_posts = $posts_in_archive;
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	}

	$column_number = 1;
	$params .= ' column_number="'.$column_number.'"';

	$display_pagination = 'yes';
	$params .= ' display_pagination="'.$display_pagination.'"';

	$params .= ' pagination_type="'.$pagination_type.'"';

	$extra_class_name = 'unique-category-template-two';
	$params .= ' extra_class_name="'.$extra_class_name.'"';

} else if ($template_type == "type3") {

	if($posts_in_archive > 9 || $posts_in_archive == ''){
        $per_page  = $posts_per_page !== 0 ? $posts_per_page : 9;
		$number_of_posts = $per_page;
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	} else {
		$number_of_posts = $posts_in_archive;
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	}

	$column_number = 1;
	$params .= ' column_number="'.$column_number.'"';

	$display_pagination = 'yes';
	$params .= ' display_pagination="'.$display_pagination.'"';

	$params .= ' pagination_type="'.$pagination_type.'"';

    $title_length = 29;
    $params .= ' title_length="'.$title_length.'"';

    $excerpt_length = 28;
    $params .= ' excerpt_length="'.$excerpt_length.'"';

	$extra_class_name = 'unique-category-template-three';
	$params .= ' extra_class_name="'.$extra_class_name.'"';

} else if ($template_type == "type4") {

    $per_page  = $posts_per_page !== 0 ? $posts_per_page : 14;
    $params .= ' number_of_posts="'.$per_page.'"';

	$column_number = 2;
	$params .= ' column_number="'.$column_number.'"';

	$display_pagination = 'yes';
	$params .= ' display_pagination="'.$display_pagination.'"';

	$params .= ' pagination_type="'.$pagination_type.'"';

    $title_length = 33;
    $params .= ' title_length="'.$title_length.'"';

    $excerpt_length = 6;
    $params .= ' excerpt_length="'.$excerpt_length.'"';

	$thumb_image_size = 'custom_size';
	$params .= ' thumb_image_size="'.$thumb_image_size.'"';

	$thumb_image_width = 474;
	$params .= ' thumb_image_width="'.$thumb_image_width.'"';

	$thumb_image_height = 410;
	$params .= ' thumb_image_height="'.$thumb_image_height.'"';

	$extra_class_name = 'unique-category-template-four';
	$params .= ' extra_class_name="'.$extra_class_name.'"';

} else if ($template_type == "type5") {

	if($posts_in_archive > 12 || $posts_in_archive == ''){
        $per_page  = $posts_per_page !== 0 ? $posts_per_page : 12;
        $number_of_posts = $per_page;

		$params .= ' number_of_posts="'.$number_of_posts.'"';
	} else {
		$number_of_posts = $posts_in_archive;
		$params .= ' number_of_posts="'.$number_of_posts.'"';
	}

	$column_number = 2;
	$params .= ' column_number="'.$column_number.'"';

	$display_pagination = 'yes';
	$params .= ' display_pagination="'.$display_pagination.'"';

	$params .= ' pagination_type="'.$pagination_type.'"';

	$title_tag = 'h4';
	$params .= ' title_tag="'.$title_tag.'"';

    $title_length = 28;
    $params .= ' title_length="'.$title_length.'"';

	$extra_class_name = 'unique-category-template-five';
	$params .= ' extra_class_name="'.$extra_class_name.'"';

} else if ($template_type == "type6") {

    $per_page  = $posts_per_page !== 0 ? $posts_per_page : 15;
    $params .= ' number_of_posts="'.$per_page.'"';

    $column_number = 3;
    $params .= ' column_number="'.$column_number.'"';

	$display_pagination = 'yes';
	$params .= ' display_pagination="'.$display_pagination.'"';

	$params .= ' pagination_type="'.$pagination_type.'"';

    $title_length = 32;
    $params .= ' title_length="'.$title_length.'"';

	$extra_class_name = 'unique-category-template-six';
	$params .= ' extra_class_name="'.$extra_class_name.'"';
}

?>

<div class="mkd-unique-category-layout clearfix">
	<?php
		switch ($template_type) {								 
			case 'type1':						
				echo do_shortcode("[mkd_post_layout_five $params]"); // XSS OK
			break;
			case 'type2':						
				echo do_shortcode("[mkd_post_layout_one $params]"); // XSS OK
			break;
			case 'type3':						
				echo do_shortcode("[mkd_post_layout_two $params]"); // XSS OK
			break;
			case 'type4':						
				echo do_shortcode("[mkd_post_layout_three $params]"); // XSS OK
			break;
			case 'type5':						
				echo do_shortcode("[mkd_post_layout_six $params]"); // XSS OK
			break;
			case 'type6':
				echo do_shortcode("[mkd_post_layout_six $params]"); // XSS OK
			break;
		}
    ?>
</div>