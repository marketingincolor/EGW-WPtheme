
<?php
/**
 * Template Name: child home page
 *
 * For displaying featured article and showing latest category feeds
 */
?>

<?php
get_header();

list($post_per_section, $post_type) = scroll_loadpost_settings();
$category = 'feature-home';
$my_query = null;
$subcat_id_ar = array();
$cat_id_ar = get_main_category_detail();
$total_subcat_posts = 0;
$merged_new_ar = array();
/* for showing post type feeds with feature category as home banner image */
?>
<div class="mkd-content">
    <div class="mkd-content-inner"> 
        <div class="mkd-full-width">
            <div class="mkd-full-width-inner">               
                <?php get_template_part('block/home-page-banner'); ?>
                <!-- Articles display block --->
                <div class="mkd-container">
                    <div class="mkd-container-inner clearfix">
                        <div class="mkd-two-columns-75-25  mkd-content-has-sidebar clearfix">
                            <div class="mkd-column1 mkd-content-left-from-sidebar">
                                <div class="mkd-column-inner">
                                    <?php
                                    /**
                                     * Fetching category if user follows subcategory and displaying article based on that categories
                                     */
                                    if (is_user_logged_in()) {
                                        $userid = get_current_user_id();
                                        $fetchresult = $wpdb->get_results("SELECT categoryid FROM wp_follow_category where userid=" . $userid . " AND flag=1 ORDER BY date DESC");
                                        if (!empty($fetchresult)) {
                                            foreach ($fetchresult as $results) {
                                                $subcat_id_ar[$results->categoryid] = $results->categoryid;
                                            }
                                            if (!empty($subcat_id_ar)) {
                                                $total_followed_posts = count(get_posts(array('post_type' => $post_type, 'category' => $subcat_id_ar, 'nopaging' => true)));
                                                $total_unfollowed_posts = count(get_posts(array('post_type' => $post_type, 'category__not_in' => $subcat_id_ar, 'category' => $cat_id_ar, 'nopaging' => true)));
                                                include(locate_template('block/followed-article-list.php'));
                                            }
                                        } else {
                                            $my_query = discussion_custom_categorylist_query($post_type, $cat_id_ar, $post_per_section);
                                        }
                                    } else {
                                        /**
                                         * if user not login                                 */
                                        $my_query = discussion_custom_categorylist_query($post_type, $cat_id_ar, $post_per_section);
                                    }


                                    if (empty($subcat_id_ar)) {
                                        global $wp_query;
                                        get_template_part('block/category-blog-list');   
                                        include(locate_template('block/ajax-pagination.php'));
                                    }
                                    ?>      
                                </div>
                            </div>		
                            <div class="mkd-column2">
                                <div class="mkd-column-inner">
                                    <div class="vc_empty_space" style="height: 40px"><span class="vc_empty_space_inner"></span></div>
                                    <aside class="mkd-sidebar" style="transform: translateY(0px);">
                                        <div class="widget widget_apsc_widget">   
                                            <?php get_template_part('sidebar/template-sidebar-home'); ?>
                                        </div>    
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- For post pagintation maintain -->
<?php get_footer(); ?>

