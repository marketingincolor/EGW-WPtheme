<?php
/**
 * Template Name: Videos Page
 * 
 * Author - Vinoth Raja
 * Date - 21-06-2016
 * For displaying featured article and videos blog
 */
?>

<?php
get_header();
$category = '';
list($post_per_section, $post_type) = scroll_loadpost_settings();
$post_type=array('videos');
?>
<div class="mkd-content">
    <div class="mkd-content-inner">         
        <div class="mkd-full-width">

            <?php
            get_template_part('template-page-featured-content');
            ?>
            <?php
            /*
              videos section
             */
            ?>
            <div style="" class="vc_row wpb_row vc_row-fluid mkd-section mkd-content-aligment-left mkd-grid-section">
                <div class="mkd-container-inner clearfix">
                    <div class="mkd-section-inner-margin clearfix">
                        <?php
                        $my_query = null;
                        $my_query = discussion_custom_category_query('videos', $category, $post_per_section);
                        global $wp_query;
                       get_template_part('block/category-blog-list');   
                        ?>
                    </div>
                </div><!-- #content -->
            </div>
        </div>
    </div>
</div>
<?php
/**
 * For loading scroll based post loading
 */
include(locate_template('block/ajax-pagination.php'));
get_footer(); 
?>