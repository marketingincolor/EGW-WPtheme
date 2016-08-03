<?php
/**
 * 
 * Author - Akilan
 * Date - 29-06-2016
 * 
 * Purpose - For displaying activity based blogs
 * Template Name: Activity page
 *
 * 
 */
?>

<?php get_header(); 
$category='activity';
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
                           
                           // $my_query = discussion_custom_category_query('post',$category);
                            $my_query = discussion_custom_category_query($post_type,$category,$post_per_section);      
                            global $wp_query;
                            get_template_part('block/category-blog-list');                             
                            ?>      
                        </div>
                    </div>
                </div><!-- #content -->
            </div>
        </div>
    </div>
</div>
   

    <?php
    /**
     * For loading post based on scrolling
     */

    include(locate_template('block/ajax-pagination.php'));   
    get_footer(); ?>

