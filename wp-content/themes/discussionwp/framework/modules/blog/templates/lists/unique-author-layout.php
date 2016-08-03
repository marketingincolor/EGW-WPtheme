<?php

/***** Get current author page ID and meta boxes options from author admin panel *****/
$author_id = discussion_get_current_object_id();

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

/***** Set params for posts on author page *****/

$template = 'type1';
if (discussion_options()->getOptionValue('author_unique_layout') !== ''){
	$template = discussion_options()->getOptionValue('author_unique_layout');
}


$params['archive_type'] = 'author';
$params['author_id'] = $author_id;
$params['template_type'] = $template;
$params['thumb_image_width'] = '';
$params['thumb_image_height'] = '';
$params['excerpt_length'] = '';
$params['posts_per_page'] = 0;
$params['pagination_type'] = 'np-horizontal';
$params['layout_title'] = esc_html__('Don\'t Miss','discussionwp');

?>

<div class="mkd-unique-author-layout clearfix">
	<div class="mkd-author-description">
		<div class="mkd-author-description-inner">
			<div class="mkd-author-description-image">
				<span class="mkd-author-tag"><?php esc_html_e('Author','discussionwp');?></span>
				<a itemprop="url" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" title="<?php the_title_attribute(); ?>" target="_self">
					<?php echo discussion_kses_img(get_avatar(get_the_author_meta( 'ID' ), 176)); ?>
				</a>
				<h6 class="mkd-author-name vcard author">
					<a itemprop="url" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" title="<?php the_title_attribute(); ?>" target="_self">
						<?php
							if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
								echo esc_attr(get_the_author_meta('first_name')) . " " . esc_attr(get_the_author_meta('last_name'));
							} else {
								echo esc_attr(get_the_author_meta('display_name'));
							}
						?>
					</a>	
				</h6>
			</div>
			<div class="mkd-author-description-text-holder">
				<?php if(get_the_author_meta('description') != "") { ?>
					<div class="mkd-author-text">
						<p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
					</div>
				<?php } ?>
				<?php if(is_email(get_the_author_meta('email'))){ ?>
					<p class="mkd-author-email"><?php echo sanitize_email(get_the_author_meta('email')); ?></p>
				<?php } ?>
			</div>
		</div>
	</div>

	<?php
		discussion_get_module_template_part('templates/lists/unique-layouts', 'blog','',$params);
	?>
</div>