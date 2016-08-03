<?php
/**
 * Author - Akilan
 * Date - 20-06-2016
 * Purpose - For changing template based on requirement
 */
list($post_per_section,$post_type)=scroll_loadpost_settings();
?>

<?php get_header(); ?>
<div class="mkd-content">
    <div class="mkd-content-inner">
        <div class="mkd-full-width">
            <div class="mkd-full-width-inner">               
                <?php
                $parent_category_id = "";
                $cat = array();
                $category_id = get_cat_id(single_cat_title("", false));
                if (!empty($category_id)) {
                    $parent_category_id = category_top_parent_id($category_id);
                    $cat = get_category($parent_category_id);
                }
                $main_cat=get_main_category_detail();
                get_template_part('template_category_page_banner');
                ?>
                
                <div style="" class="vc_row wpb_row vc_row-fluid mkd-section mkd-content-aligment-left mkd-grid-section">
                    <div class="mkd-container-inner clearfix">
                        <div class="mkd-section-inner-margin clearfix">
                            <?php
                            $my_query = null;
                            $my_query = discussion_custom_categorylist_query($post_type,$category_id,$post_per_section);   
//                            $my_query = discussion_custom_categorylist_query($category_id);
                            global $wp_query;
                            get_template_part('block/category-blog-list');   
                            ?>      
                        </div>
                    </div><!-- #content -->

                </div>
            </div>
        </div></div>
</div>
<?php
 /**
 * For loading post based on scrolling
 */
include(locate_template('block/ajax-pagination.php'));
?>
<?php get_footer(); ?>
