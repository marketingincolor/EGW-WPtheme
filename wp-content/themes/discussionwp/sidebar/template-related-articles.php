<div class="mkd-section-title-holder clearfix"><span class="mkd-st-title">Related Articles</span></div>
<div id="mkd-widget-tab-4" class="mkd-ptw-holder mkd-tabs" aria-labelledby="ui-id-5" role="tabpanel" aria-hidden="false">
    <div class="mkd-plw-tabs-content">
        <div data-max_pages="4" data-paged="1" data-display_excerpt="no" data-display_date="yes" data-title_length="30" data-title_tag="h6" data-display_image="yes" data-custom_thumb_image_height="84" data-custom_thumb_image_width="117" data-category_id="4" data-number_of_posts="5" data-base="mkd_post_layout_seven">
            <div class="mkd-bnl-outer">
                <div class="mkd-bnl-inner">
                    <?php
                    $post_id = get_the_ID();

                    $tags = get_the_tags();

		    $tag_ids = array();
		    if ($tags) {
			foreach ($tags as $tag) {
				$tag_ids[] = $tag->term_id;
			}
		    }

                    $post_type = 'Videos';
                    $related_posts = custom_related_posts($post_id, $post_type, $tag_ids);
 
                    while (have_posts()) : the_post();
                        ?>   
                        <div class="mkd-pt-seven-item mkd-post-item mkd-active-post-page">
                            <div class="mkd-pt-seven-item-inner clearfix">
                                <div class="mkd-pt-seven-image-holder" style="width: 117px">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <img src="<?php the_post_thumbnail_url(); ?>"/>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="mkd-pt-seven-content-holder">
                                    <div class="mkd-pt-seven-title-holder">
                                        <h6 class="mkd-pt-seven-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_query();
                    ?> 
                </div>
            </div>
        </div>
    </div>
</div>
