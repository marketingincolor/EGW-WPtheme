<div class="widget mkd-rpc-holder">
    <div class="widget widget_categories">
        <div class="mkd-section-title-holder clearfix"><span class="mkd-st-title">Ads</span></div>
        <div class="mkd-rpc-content">  
            <?php if( is_front_page() || is_home() || is_404() ) { ?>
            <!--- Insert Ads here --->
            <?php if(function_exists('drawAdsPlace')) drawAdsPlace(array('id' => 1), true); ?>
            <!--- Ads end here --->
            <?php
            }?>
            </div>
            </div>
            <div class = "mkd-section-title-holder clearfix"><span class = "mkd-st-title">Welcome to The Villages</span></div>
            <div class = "mkd-rpc-content">
            <ul>
            <li><a href = "#">Join This Village?</a></li>
            <li><a href = "#">Find Another Village</a></li>
            <li><a href = "#">Return to Main Site</a></li>
            </ul>
            </div>
            </div>
            <div class = "widget widget_categories">
            <div class = "mkd-section-title-holder clearfix"><span class = "mkd-st-title">Local News Stories</span></div>
            <div class = "mkd-rpc-content">
            <?php $posts = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1, 'showposts' => 3, 'orderby' => 'most_recent', 'category_name' => 'news'));
            ?>
            <ul>
                <?php while ($posts->have_posts()) : $posts->the_post(); ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile; ?>
            </ul>
<?php wp_reset_postdata(); ?>
        </div>
    </div> 
    <div class="mkd-section-title-holder clearfix"><span class="mkd-st-title">Local Events</span></div>
    <div class="mkd-rpc-inner">
        <div class="mkd-pt-seven-item mkd-post-item mkd-active-post-page">    
<?php $posts = new WP_Query(array('post_type' => 'ai1ec_event', 'post_status' => 'publish', 'posts_per_page' => -1, 'order' => 'ASC')); ?>
<?php while ($posts->have_posts()) : $posts->the_post(); ?>   

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
                        <?php
                        discussion_post_info_date(array(
                        'date' => $display_date,
                        'date_format' => $date_format
                        ));
                        ?>
                    </div>
                </div>
            </div>            
<?php endwhile; ?>
<?php wp_reset_postdata(); // restores the $post global to the current post    ?> 
        </div>  
    </div>   
    <div class="mkd-section-title-holder clearfix"><span class="mkd-st-title">Recent Comments</span></div> 
    <div class="mkd-rpc-inner">
        <?php
        $number = 3;
        global $current_user;
        $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1'   ORDER BY comment_date_gmt DESC LIMIT $number");
        ?>
        <ul>
            <?php
            if ($comments) : foreach ((array) $comments as $comment) :

            if (is_user_logged_in()) {
            if ($comment->user_id == $current_user->ID) {
            ?>                       
            <li>
                <div class="mkd-rpc-number-holder"><div class="mkd-rpc-number-holder"><span class="ion-android-chat"></span></div>   
                    <div class="mkd-rpc-content">
                        <?php
                        echo '<h6 class="mkd-rpc-link"><a itemprop="url" href="' . esc_url(get_comment_link($comment->comment_ID)) . '">' . get_the_title($comment->comment_post_ID) . '</a></h6>';
                        echo '<a class="mkd-rpc-date" itemprop="url" href="' . get_month_link($year, $month) . '">' . get_the_date('', $comment->comment_post_ID) . '</a>';
                        ?>
                    </div>
                </div>  
            </li>
            <?php
            }
            } else {
            ?>                       
            <li>
                <div class="mkd-rpc-number-holder"><div class="mkd-rpc-number-holder"><span class="ion-android-chat"></span></div>   
                    <div class="mkd-rpc-content">
                        <?php
                        echo '<h6 class="mkd-rpc-link"><a itemprop="url" href="' . esc_url(get_comment_link($comment->comment_ID)) . '">' . get_the_title($comment->comment_post_ID) . '</a></h6>';
                        echo '<a class="mkd-rpc-date" itemprop="url" href="' . get_month_link($year, $month) . '">' . get_the_date('', $comment->comment_post_ID) . '</a>';
                        ?>
                    </div>
                </div>  
            </li>
            <?php
            }
            endforeach;
            endif;
            ?>
        </ul>                
    </div>
</div>


