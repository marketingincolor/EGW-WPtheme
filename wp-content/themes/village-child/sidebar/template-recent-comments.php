<?php if (is_user_logged_in()) : ?>
    <?php
        $number = 3;
        global $current_user;
        $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' AND user_id = '{$current_user->ID}' ORDER BY comment_date_gmt DESC LIMIT $number");
        if ($comments) : 
     ?>
        <div class="widget mkd-rpc-holder">
            <div class="mkd-section-title-holder clearfix"><span class="mkd-st-title">Recent Comments</span></div>
            <div class="mkd-rpc-inner village-sidebar-recent-comments">            
                <ul>
                    <?php
                    foreach ((array) $comments as $comment) :
                            ?>                       
                            <li>                                
                                <div class="mkd-rpc-number-holder"><span class="ion-android-chat"></span></div>   
                                <div class="mkd-rpc-content">
                                    <?php
                                    echo '<h6 class="mkd-rpc-link"><a itemprop="url" href="' . esc_url(get_comment_link($comment->comment_ID)) . '">' . get_the_title($comment->comment_post_ID) . '</a></h6>';
                                    echo '<a class="mkd-rpc-date" itemprop="url" href="' . get_month_link($year, $month) . '">' . get_the_date('d. F Y', $comment->comment_post_ID) . '</a>';
                                    ?>
                                </div>                                
                            </li>
                            <?php
                        endforeach;                
                    ?>
                </ul>          
            </div>
        </div>
<?php endif;
endif; ?>