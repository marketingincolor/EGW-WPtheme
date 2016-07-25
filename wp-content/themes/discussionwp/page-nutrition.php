<?php
/**
 * Author - Akilan
 * Date - 13-06-2016
 * Template Name: Nutrition page
 * Purpose - For displaying nutrition based blogs
 * 
 */
?>

<?php get_header(); 
$category='nutrition';
list($post_per_section,$post_type)=scroll_loadpost_settings();
?>
<div class="mkd-content">
    <div class="mkd-content-inner">
        <div class="mkd-full-width">
            <div class="mkd-full-width-inner">               
               <?php
                get_template_part('template-page-featured-content');               
               ?>
                <div style="" class="vc_row wpb_row vc_row-fluid mkd-section mkd-content-aligment-left mkd-grid-section">
                    <div class="mkd-container-inner clearfix">
                        <div class="mkd-section-inner-margin clearfix">
                            <?php
                            $my_query = null;
                            $my_query = discussion_custom_category_query($post_type,$category,$post_per_section); 
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

