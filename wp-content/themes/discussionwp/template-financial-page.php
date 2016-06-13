<?php
/**
 * Template Name: Financial page
 *
 * For displaying featured article and home category blogs
 */
?>

<?php get_header(); 
$category='financial';
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
                            $my_query = discussion_custom_category_query('post',$category);
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

