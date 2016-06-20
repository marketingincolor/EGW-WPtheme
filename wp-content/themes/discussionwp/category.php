<?php
/**
 * Author - Akilan
 * Date - 20-06-2016
 * Purpose - For changing template based on requirement
 */

?>

<?php get_header(); ?>
<div class="mkd-content">
    <div class="mkd-content-inner">
        <div class="mkd-full-width">
            <div class="mkd-full-width-inner">               
               <?php
                $parent_category_id="";
                $cat=array();
                $category_id = get_cat_id( single_cat_title("",false));     
                if(!empty($category_id)){
                    $parent_category_id=category_top_parent_id($category_id);                
                    $cat = get_category($parent_category_id);
                }                
                get_template_part('template_category_page_banner');               
               ?>
                <div style="" class="vc_row wpb_row vc_row-fluid mkd-section mkd-content-aligment-left mkd-grid-section">
                    <div class="mkd-container-inner clearfix">
                        <div class="mkd-section-inner-margin clearfix">
                            <?php
                            
                            $my_query = null;                           
                            $my_query = discussion_custom_categorylist_query($category_id);
                            global $wp_query;
                            get_template_part('template-blog-block');   
                            ?>      
                            </div>
                        </div><!-- #content -->

                </div>
                </div>
            </div></div>
    </div>
    <?php
    ?>
    <?php get_footer(); ?>
