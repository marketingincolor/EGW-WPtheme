<?php
/**
 * Author - Akilan
 * Date - 10-06-2016
 * Purpose - For displaying article 3*3 based on category
 * Modified - 01-07-2016
 */
?>
<?php
list($post_per_section, $post_type) = scroll_loadpost_settings();
?>
<div class="wpb_column vc_column_container vc_col-sm-12">
    <div class="vc_column-inner ">
        <div class="wpb_wrapper">
            <div class="vc_empty_space" style="height: 40px"><span class="vc_empty_space_inner"></span></div>
            <div class="mkd-bnl-holder mkd-pl-five-holder  mkd-post-columns-3"  data-base="mkd_post_layout_five"  data-number_of_posts="3" data-column_number="3" data-category_id="7"         data-thumb_image_size="custom_size" data-thumb_image_width="302" data-thumb_image_height="198" data-title_tag="h6" data-title_length="27" data-display_date="no"  data-display_category="no" data-display_comments="no" data-display_share="no" data-display_count="no" data-display_excerpt="yes" data-excerpt_length="7" data-display_read_more="no"     data-paged="1" data-max_pages="8">
                <div class="mkd-bnl-outer">
                    <div class="mkd-bnl-inner">

                        <?php
                        if ($total_followed_posts != 0 && !empty($subcat_id_ar)) {
                            $i = 0;
                            $total_post = 0;
                            $title_cls = "";
                            $loaded_cat = array();
                            $display_postid_ar = array();
                            $remaining=0;
                            $found_posts=0;
                            $display_post_title_ar=array();
                           /**
                            * show 2 article from each subcategories belongs to follow subcategories
                            */
                            foreach ($subcat_id_ar as $subcat_id_sgl) {                               
                                $posts =  follow_categorypost_detail($post_type,array($subcat_id_sgl),$display_postid_ar);                                
                                if (!empty($posts)) {
                                    foreach ($posts as $post): setup_postdata($post);
                                        if ($i == $post_per_section)
                                            break;                                       
                                        array_push ($display_postid_ar, get_the_ID ());
                                        $display_post_title_ar[]=get_the_title();                                                                      
                                        $i++;
                                    endforeach;
                                    wp_reset_postdata();                                   
                                } 
                                $title_cls=0;
                            }
                            /*
                             * Show remaining article belongs to following subcategories
                             */
                            $j=0;
                            if($i<$post_per_section && $total_followed_posts>=$post_per_section) {                              
                                $remaining=$post_per_section-$i;
                                $posts =  follow_categorypost_detail($post_type,$subcat_id_ar,$display_postid_ar);                                  
                                if (!empty($posts)) {
                                    foreach ($posts as $post): setup_postdata($post);
                                        if ($j == $remaining)
                                            break;                           
                                        array_push ($display_postid_ar, get_the_ID ());
                                        $display_post_title_ar[]=get_the_title();                                                                  
                                        $j++;
                                    endforeach;
                                    wp_reset_postdata();                                   
                                } 
                            }
                            
                            $k=0;                         
                            /**
                             * displaying remaining unfollow article if we have less followed articles
                             */
                            if(($i+$j)<$post_per_section){
                                $remaining=$post_per_section-($i+$j);
                                unfollow_categorypost_detail($post_type,$cat_id_ar,$display_postid_ar,$remaining);
                                global $wp_query;
                                $found_posts=$wp_query->found_posts;
                                if (have_posts()):                                   
                                    while (have_posts()) :the_post();
                                        array_push ($display_postid_ar,get_the_ID ());
                                        $display_post_title_ar[]=get_the_title();                                       
                                    endwhile;
                                endif;
                                wp_reset_postdata();                             
                            } 
                            /**
                             * collected post id and display detail
                             */
                            if(!empty($display_postid_ar)){
                                $followed_posts = query_posts(array('post_type' => $post_type, 'post__in' => $display_postid_ar, 'nopaging' => true));
                                global $wp_query;
                                get_template_part('block/home-article-detail');  
                            }
                            
                        }
                        
                        $current_post=$i+$j+$remaining;
                        $total_post=$total_followed_posts+$total_unfollowed_posts;
                        ?>

                    </div>
                </div>
                <?php
                $total_followed_posts=count(get_posts(array('post_type' => $post_type,'post__not_in'=>$display_postid_ar, 'category' => $subcat_id_ar, 'nopaging' => true)));
                $total_unfollowed_posts=count(get_posts(array('post_type' => $post_type,'post__not_in'=>$display_postid_ar, 'category' => $cat_id_ar, 'nopaging' => true)));
                ?>
                <input type="hidden" id="processing" value="0">
                <input type="hidden" id="currentloop" value="1">
                <input type="hidden" id="total_followed_post" value="<?php echo $total_followed_posts ?>">
                <input type="hidden" id="total_unfollowed_post" value="<?php echo $total_unfollowed_posts ?>">
                <input type="hidden" id="followed_current_post" value="0">
                <input type="hidden" id="unfollowed_current_post" value="0">
                <input type="hidden" id="total_post" value="<?php echo $total_followed_posts+$total_unfollowed_posts; ?>">
                <input type="hidden" id="current_post" value="0">
            </div>
            <?php
            
            /**
             * For displaying ads based on total count of post
             */
            if ($total_post >= $post_per_section) {
                $no_of_adds = floor($total_post / $post_per_section);
                for ($i = 1; $i <= $no_of_adds; $i++) {
                    ?>                    
                    <div class="fsp-ads-homepage" id="adv_row_<?php echo $i; ?>" <?php if ($i != 1) { ?> style="display:none;clear:both" <?php } else { ?> style="clear:both" <?php } ?>>  
                        <?php
                        if (function_exists('drawAdsPlace'))
                            drawAdsPlace(array('id' => 1), true);
                        ?>
                    </div>                    
                    <?php
                }
            }
            ?>
        </div>
    </div>

</div>
<?php
/**
 * jquery loading image icon display block
 */
include(locate_template('sidebar/template-ajax-image.php'));
include(locate_template('block/followed-article-pagination.php'));

?>
