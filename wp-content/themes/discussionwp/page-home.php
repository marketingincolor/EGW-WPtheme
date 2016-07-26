<?php
/**
 * Template Name: home-index page
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
                <?php
                if ($_REQUEST['redirect'] == "success") {
                    get_template_part('block/register-success');
                }
                ?>
                <!--home page banner display-->
                <?php get_template_part('block/home-page-banner'); ?>
                <!-- article list display-->
                <div style="" class="vc_row wpb_row vc_row-fluid mkd-section mkd-content-aligment-left mkd-grid-section">
                    <div class="mkd-container-inner clearfix">
                        <div class="mkd-section-inner-margin clearfix">
                            <?php
                            $my_query = discussion_custom_categorylist_query($post_type, $cat_id_ar, $post_per_section);
                            global $wp_query;
                            get_template_part('block/category-blog-list');
                            include(locate_template('block/ajax-pagination.php'));
                            ?>      
                        </div>
                    </div>
                </div><!-- #content -->
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>

