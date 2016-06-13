<?php
/**
 * Template Name: News Page
 *
 * Selectable from a dropdown menu on the edit page screen.
 */
?>

<?php $category ='news';
?>

<?php get_header(); ?>
<div class="mkd-content">
    <div class="mkd-content-inner">
        <?php do_action('discussion_after_container_open'); ?>
        <div class="mkd-full-width">
            <div class="mkd-full-width-inner">               
                <?php
                get_template_part('template-page-featured-content');               
                ?>                
                <div style="" class="vc_row wpb_row vc_row-fluid mkd-section mkd-content-aligment-left mkd-grid-section">
                    <div class="mkd-container-inner clearfix">
                        <div class="mkd-section-inner-margin clearfix">
                            <!-- Post block start-->
                             <?php
                                $my_query = null;
                                $my_query = discussion_custom_category_query('post',$category);
                                global $wp_query;
                                get_template_part('template-blog-block');   
                        ?>
                    </div><!-- #content -->
                </div>
            </div> 
        </div>
    </div>
</div>    
<?php get_footer(); ?>

