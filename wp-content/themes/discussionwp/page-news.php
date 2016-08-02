<?php
/**
 * Author - Akilan
 * Date - 10-06-2016
 * Purpose - For displaying news based blogs  
 * Template Name: News Page *
 * 
 */
?>

<?php $category ='news';
list($post_per_section,$post_type)=scroll_loadpost_settings();
?>

<?php get_header(); ?>
<div class="mkd-content">
    <div class="mkd-content-inner">
        <?php do_action('discussion_after_container_open'); ?>
        <div class="mkd-full-width">
            <div class="mkd-full-width-inner">               
                <?php
                $category_id=get_cat_id($category);
                include(locate_template('template_category_page_banner.php'));               
                ?>                
                <div style="" class="vc_row wpb_row vc_row-fluid mkd-section mkd-content-aligment-left mkd-grid-section">
                    <div class="mkd-container-inner clearfix">
                        <div class="mkd-section-inner-margin clearfix">
                            <!-- Post block start-->
                             <?php
                                $my_query = null;
                                $my_query = discussion_custom_category_query($post_type,$category,$post_per_section); 
                                global $wp_query;
                                get_template_part('block/category-blog-list');   
                        ?>
                    </div><!-- #content -->
                </div>
            </div> 
        </div>
     </div>
  </div>    
</div>
<?php
/**
* For loading scroll based post loading
*/
 include(locate_template('block/ajax-pagination.php'));
get_footer(); ?>

