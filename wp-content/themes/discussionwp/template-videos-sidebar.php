<?php
/**
 * Author - Vinoth Raja
 * Date - 21-06-2016
 * Purpose - For displaying sidebar section of the videos page
 */
?>
<aside class="mkd-sidebar" style="transform: translateY(0px);"> 
        <div class="mkd-section-title-holder clearfix"><span class="mkd-st-title">Stay Connected</span></div>
        <div class="mkd-pt-seven-item mkd-post-item "> 
          <div class="social-icons-footer" style="font-size: 0">
       <?php  
             echo do_shortcode ('[mkd_icon icon_pack="font_elegant" fe_icon="social_facebook" size="mkd-icon-tiny"  type="landscape" shape_width="42" custom_size="12" shape_height="33" link="https://www.facebook.com/" target="_blank" icon_color="#ffffff" border_width="0" background_color="#3b5998" hover_icon_color="#ffffff" hover_background_color="#3b5998" margin="0"]');
              
             echo do_shortcode ('[mkd_verticalsep color="#212121" height="33" thickness="1" margin_left="0" margin_right="0"]'); 
             
             echo do_shortcode('[mkd_icon icon_pack="font_elegant" fe_icon="social_pinterest" size="mkd-icon-tiny"  type="landscape" shape_width="42" custom_size="12" shape_height="33" link="https://www.pinterest.com/" target="_blank" icon_color="#ffffff" border_width="0" background_color="#cb2027" hover_icon_color="#ffffff" hover_background_color="#cb2027" margin="0"]');

             echo do_shortcode('[mkd_verticalsep color="#212121" height="33" thickness="1" margin_left="0" margin_right="0"]');

             echo do_shortcode('[mkd_icon icon_pack="font_elegant" fe_icon="social_twitter" size="mkd-icon-tiny"  type="landscape" shape_width="42" custom_size="12" shape_height="33" link="https://www.twitter.com/" target="_blank" icon_color="#ffffff" border_width="0" background_color="#1dcaff" hover_icon_color="#ffffff" hover_background_color="#1dcaff" margin="0"]');

             echo do_shortcode('[mkd_verticalsep color="#212121" height="33" thickness="1" margin_left="0" margin_right="0"]');

             echo do_shortcode('[mkd_icon icon_pack="font_elegant" fe_icon="social_googleplus" size="mkd-icon-tiny"  type="landscape" shape_width="42" custom_size="12" shape_height="33" link="https://plus.google.com/" target="_blank" icon_color="#ffffff" border_width="0" background_color="#f44336" hover_icon_color="#ffffff" hover_background_color="#f44336" margin="0px"]');
        ?>
         </div>
        </div>
        <div class="mkd-section-title-holder clearfix"><span class="mkd-st-title">Rate This Article</span></div>
        <div class="mkd-ratings-holder">
            <div class="mkd-ratings-text-holder">
                <div class="mkd-ratings-stars-holder">
                    <?php if (function_exists('the_ratings')) {
                        the_ratings();
                    } ?>
                </div>
            </div>
            <div class="mkd-ratings-message-holder">
                <div class="mkd-rating-value"></div>
                <div class="mkd-rating-message"></div>
            </div>
        </div>
        <div class="mkd-section-title-holder clearfix"><span class="mkd-st-title">Related Articles</span></div>
        <div class="mkd-pt-seven-item mkd-post-item ">    
            <?php
            $id = get_the_ID();
            $post_type = 'Videos';
            $related_posts = discussion_related_posts($id, $post_type);
            while ($related_posts->have_posts()) : $related_posts->the_post();
                ?>   

                <div class="mkd-pt-seven-item-inner clearfix">
                    <div class="mkd-pt-seven-image-holder" style="width: 100px">
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
                        <div class="mkd-post-info-date entry-date updated" itemprop="dateCreated">
                            <?php ?>
                        </div>
                    </div>
                </div>            
            <?php endwhile;
            wp_reset_query();
            ?> 
        </div>  
</aside>