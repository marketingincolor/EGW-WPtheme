
<div class="mkd-section-title-holder clearfix"><span class="mkd-st-title">Live Events</span></div>
<?php $posts = new WP_Query(array('post_type' => 'ai1ec_event', 'post_status' => 'publish', 'posts_per_page' => -1, 'order' => 'ASC')); ?>  
<div class="widget mkd-ptw-holder mkd-tabs  ui-tabs ui-widget ui-widget-content ui-corner-all village-sidebar-local-events">
    <div id="mkd-widget-tab-4" class="mkd-ptw-content mkd-tab-container ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-5" role="tabpanel" aria-hidden="false">
        <div class="mkd-plw-tabs-content">
            <div data-max_pages="4" data-paged="1" data-display_excerpt="no" data-display_date="yes" data-title_length="30" data-title_tag="h6" data-display_image="yes" data-custom_thumb_image_height="84" data-custom_thumb_image_width="117" data-category_id="4" data-number_of_posts="5" data-base="mkd_post_layout_seven" class="mkd-bnl-holder mkd-pl-seven-holder  ">
                <div class="mkd-bnl-outer">
                    <?php while ($posts->have_posts()) : $posts->the_post(); ?> 
                    <div class="mkd-bnl-inner">
                        <div class="mkd-pt-seven-item mkd-post-item mkd-active-post-page">
                            <div class="mkd-pt-seven-item-inner clearfix">
                                <div style="width: 117px" class="mkd-pt-seven-image-holder">
                                    <a target="_self" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="mkd-pt-seven-link mkd-image-link" itemprop="url">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img height="84" width="117" alt="a" src="<?php the_post_thumbnail_url(); ?>">				
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="mkd-pt-seven-content-holder">
                                    <div class="mkd-pt-seven-title-holder">
                                        <h6 class="mkd-pt-seven-title">
                                            <a target="_self" href="<?php the_permalink(); ?>" class="mkd-pt-link" itemprop="url"><?php the_title(); ?></a>
                                        </h6>
                                    </div>
				   <div class="mkd-post-info-date entry-date updated" itemprop="dateCreated" style="display:block">
                                        <a href="<?php echo get_month_link($year, $month); ?>" itemprop="url">
                                           <?php the_time('d. F Y') ?>			</a>
                                        <meta content="UserComments: 0" itemprop="interactionCount">
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>

