<?php
/**
 * Author - Akilan
 * Date - 22-07-2016
 * Purpose - For gathering followed/unfollowed category article in home page
 *
 */
?>
<?php
list($post_per_section, $post_type) = scroll_loadpost_settings();
?>
<div class="wpb_column vc_column_container vc_col-sm-12">
    <div class="vc_column-inner ">
        <div class="wpb_wrapper">
            <div class="vc_empty_space" style="height: 20px"><span class="vc_empty_space_inner"></span></div>
            <div class="mkd-bnl-holder mkd-pl-five-holder  mkd-post-columns-2">
                <div class="mkd-bnl-outer">
                    <div class="mkd-bnl-inner">

                        <?php
                       
                        $total_unfollowed_posts=0;
                        if ($total_followed_posts != 0 && !empty($subcat_id_ar)) {
                            $i = 0;
                            $total_post = 0;
                            $title_cls = "";
                            $loaded_cat = array();
                            $display_postid_ar = array();
                            $remaining = 0;
                            $found_posts = 0;
                            $display_post_title_ar = array();
                            $displayed_sub_cat_ar = array();
                            /**
                             * show 1 article from each subcategories belongs to follow subcategories
                             */
                            foreach ($subcat_id_ar as $subcat_id_sgl) {
                                $posts = follow_categorypost_detail($post_type, array($subcat_id_sgl), $display_postid_ar);
                                if (!empty($posts)) {
                                    foreach ($posts as $post): setup_postdata($post);
                                        if ($i == $post_per_section)
                                            break;
                                        array_push($display_postid_ar, get_the_ID());
                                        array_push($displayed_sub_cat_ar, $subcat_id_sgl);
                                        $display_post_title_ar[] = get_the_title();
                                        $i++;
                                    endforeach;
                                    wp_reset_postdata();
                                }
                                $title_cls = 0;
                            }
                       
                            /*
                             * Show remaining article belongs to following subcategories
                             */
                            $j = 0;
                            if ($i < $post_per_section) {
                              $remaining = $post_per_section - $i;
                                $posts = remainfollow_categorypost_detail($post_type, $subcat_id_ar, $display_postid_ar,$remaining);
                                if (!empty($posts)) {
                                    foreach ($posts as $post): setup_postdata($post);
                                        if ($j == $remaining)
                                            break;
                                        array_push($display_postid_ar, get_the_ID());
                                        $display_post_title_ar[] = get_the_title();
                                        $j++;
                                    endforeach;
                                    wp_reset_postdata();
                                }
                            }
                            $k = 0;
                            
                            // echo "Article Total-".$total_followed_posts = count(get_posts(array('post_type' => $post_type, 'post__not_in' => $display_postid_ar, 'category' => $subcat_id_ar, 'nopaging' => true)));
                            /**
                             * displaying remaining unfollow article if we have less followed articles
                             */
//                            $remaining=0;
//                            if (($i + $j) < $post_per_section) {
//                                $remaining = $post_per_section - ($i + $j);
//                                unfollow_categorypost_detail($post_type, $cat_id_ar, $display_postid_ar, $remaining);
//                                global $wp_query;
//                                $found_posts = $wp_query->found_posts;
//                                if (have_posts()):
//                                    while (have_posts()) :the_post();
//                                        array_push($display_postid_ar, get_the_ID());
//                                        $display_post_title_ar[] = get_the_title();
//                                    endwhile;
//                                endif;
//                                wp_reset_postdata();
//                            }
                            
                            $_SESSION["display_postid_ar"] = $display_postid_ar;
                            $_SESSION["displayed_sub_cat_ar"] = $displayed_sub_cat_ar;
                            
                            /**
                             * collected post id and display detail
                             */
                            if (!empty($display_postid_ar)) {
                                $followed_posts = query_posts(array('post_type' => $post_type, 'post__in' => $display_postid_ar, 'nopaging' => true, 'orderby' => 'post__in'));
                                global $wp_query;
                                get_template_part('block/home-article-detail');
                            }
                        }
                        $current_post = $i + $j;
                        $total_post = $total_followed_posts;
                        ?>

                    </div>
                </div>
                <?php
        //        $total_followed_posts=count($displayed_sub_cat_ar);
                $total_followed_posts = count(get_posts(array('post_type' => $post_type, 'post__not_in' => $display_postid_ar, 'category' => $subcat_id_ar, 'nopaging' => true)));
                $total_unfollowed_posts = 0;
                ?>
                <input type="hidden" id="processing" value="0">
                <input type="hidden" id="currentloop" value="1">
                <input type="hidden" id="total_followed_post" value="<?php echo $total_followed_posts ?>">
                <input type="hidden" id="total_unfollowed_post" value="<?php echo $total_unfollowed_posts ?>">
                <input type="hidden" id="followed_current_post" value="0">
                <input type="hidden" id="unfollowed_current_post" value="0">
                <input type="hidden" id="total_post" value="<?php echo $total_followed_posts ?>">
                <input type="hidden" id="current_post" value="0">
            </div>
            <?php
            /**
             * For displaying ads based on total count of post
             */
            include(locate_template('block/post-middle-adsblock.php'));
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