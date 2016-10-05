
<div class="mkd-section-title-holder clearfix"><span class="mkd-st-title">Live Events</span></div>

<div id="mkd-widget-tab-4" class="mkd-ptw-holder mkd-tabs" aria-labelledby="ui-id-5" role="tabpanel" aria-hidden="false">
    <div class="mkd-plw-tabs-content">
        <div data-max_pages="4" data-paged="1" data-display_excerpt="no" data-display_date="yes" data-title_length="30" data-title_tag="h6" data-display_image="yes" data-custom_thumb_image_height="84" data-custom_thumb_image_width="117" data-category_id="4" data-number_of_posts="5" data-base="mkd_post_layout_seven">
            <div class="mkd-bnl-outer">
                <div class="mkd-bnl-inner">
                    <?php
                    global $ai1ec_registry;
                    $date_system = $ai1ec_registry->get('date.system');
                    $search = $ai1ec_registry->get('model.search');

                    // gets localized time
                    $local_date = $ai1ec_registry->get('date.time', $date_system->current_time(), 'sys.default');

                    //sets start time to today
                    $start_time = clone $local_date;
                    $start_time->set_time(0, 0, 0);

                    //sets end time to a year from today
                    $end_time = clone $start_time;
                    $end_time->adjust_month(12);

                    $events_result = $search->get_events_between($start_time, $end_time, array(), true);

                    if (!empty($events_result)) {
                        $event_count = '0';
                        foreach ($events_result as $event) {
                            if ($event_count < '2') {
                                $event_count ++;
                                $event_long_date = $event->get('start');
                                $event_date = $ai1ec_registry->get('view.event.time')->get_long_date($event_long_date);
                                $event_title = $event->get('post')->post_title;
                                $postid = $event->get('post_id');
                                $year = get_the_date("Y", $postid);
                                $month = get_the_date("m", $postid);
                                ?>

                                <div class="mkd-pt-seven-item mkd-post-item mkd-active-post-page">
                                    <div class="mkd-pt-seven-item-inner clearfix">
                                        <div class="mkd-pt-seven-image-holder" style="width: 117px">
                                            <a target="_self" href="<?php echo get_permalink($postid) ?>" title="<?php the_title_attribute(); ?>" class="mkd-pt-seven-link mkd-image-link" itemprop="url">
                                                <img width="117px" alt="a" src="<?php
                                                $imageid = get_post_meta($postid, 'event_banner_image', true);
                                                //$feature_image = wp_get_attachment_url(get_post_thumbnail_id($postid));
                                                if ($imageid) {
                                                    $feature_image = wp_get_attachment_url($imageid);
                                                } else {
                                                    $feature_image = wp_get_attachment_url(get_post_thumbnail_id($postid));
                                                }
                                                echo $feature_image;
                                                ?> ">
                                            </a>
                                        </div>
                                        <div class="mkd-pt-seven-content-holder">
                                            <div class="mkd-pt-seven-title-holder">
                                                <h6 class="mkd-pt-seven-title">
                                                    <a href="<?php echo get_permalink($postid) ?>"> <?php echo $event_title ?></a>
                                                </h6>
                                            </div>
                                            <div class="mkd-post-info-date entry-date updated" itemprop="dateCreated" style="display:block">
                                                <a href="<?php echo get_month_link($year, $month); ?>" itemprop="url"> <?php echo $event_date; ?> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div><br>
            </div>
        </div>
    </div>
</div>
