<div id="apsc_widget-4" class="widget widget_apsc_widget">
    <div class="mkd-section-title-holder clearfix">
        <span class="mkd-st-title">Share</span>
    </div>
    <?php echo do_shortcode('[aps-counter theme="theme-2"]'); ?>  
</div>
<div class="mkd-ratings-holder-container">
    <div class="mkd-section-title-holder clearfix"><span class="mkd-st-title"><?php esc_html_e('Rate This Article', 'discussionwp'); ?></span></div>
    <div class="mkd-ratings-holder">
            <div class="mkd-ratings-stars-holder">
                <?php
                if (function_exists('the_ratings')) {
                    the_ratings();
                }
                ?>
            </div>
     
        <div class="mkd-ratings-message-holder">
            <div class="mkd-rating-value"></div>
            <div class="mkd-rating-message"></div>
        </div>
    </div>
</div>
<div class="mkd-section-title-holder clearfix"><span class="mkd-st-title">Related Articles</span></div>
        <div id="mkd-widget-tab-4" class="mkd-ptw-holder mkd-tabs" aria-labelledby="ui-id-5" role="tabpanel" aria-hidden="false">
            <div class="mkd-plw-tabs-content">
                <div data-max_pages="4" data-paged="1" data-display_excerpt="no" data-display_date="yes" data-title_length="30" data-title_tag="h6" data-display_image="yes" data-custom_thumb_image_height="84" data-custom_thumb_image_width="117" data-category_id="4" data-number_of_posts="5" data-base="mkd_post_layout_seven">
                    <div class="mkd-bnl-outer">
                        <div class="mkd-bnl-inner">
                            <?php
                            $id = get_the_ID();
                            $post_type = 'Videos';
                            $related_posts = discussion_related_posts($id, $post_type);
                            while ($related_posts->have_posts()) : $related_posts->the_post();
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