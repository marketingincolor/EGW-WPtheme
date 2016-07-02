<div class="widget mkd-rpc-holder">
    <div class="mkd-section-title-holder clearfix"><span class="mkd-st-title">Local News Stories</span></div>
    <div class="mkd-rpc-inner village-sidebar-news-stories">
        <?php $posts = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1, 'showposts' => 3, 'orderby' => 'most_recent', 'category_name' => 'news'));
        ?>
        <ul>            
           <?php while ($posts->have_posts()) : $posts->the_post(); ?>                      
                <li>          
                    <div class="mkd-rpc-number-holder"><span class="ion-android-chat"></span></div>
                    <div class="mkd-rpc-content">                            
                        <h6 class="mkd-rpc-link"><a href="<?php the_permalink(); ?>" itemprop="url"><?php the_title(); ?></a></h6>
                        <a href="<?php echo get_month_link($year, $month); ?>" itemprop="url" class="mkd-rpc-date"><?php the_time('d. F Y') ?></a>                            
                    </div>                    
                </li>
                <?php
            endwhile;
            ?>
        </ul>   
        <?php wp_reset_postdata(); ?>
    </div>
</div>