<?php
/**
 * Template Name: Child News Page
 *
 * 
 */
?>
<?php get_header(); 
$post_per_section=6;
$category = 'news';
?>
<div class="mkd-content">
    <div class="mkd-content-inner">
        <div class="mkd-full-width">
            <div class="mkd-full-width-inner"> 
                <?php     
                    $category_id=get_cat_id($category);
                    include(locate_template('template_category_page_banner.php')); 
                ?>
                <div class="vc_empty_space" style="height: 0px"><span class="vc_empty_space_inner"></span></div>
                <div class="mkd-container">
                    <div class="mkd-container-inner clearfix">
                        <div class="mkd-two-columns-75-25  mkd-content-has-sidebar clearfix">
                            <div class="mkd-column1 mkd-content-left-from-sidebar">
                                <div class="mkd-column-inner">
                                    <?php                                 
                                    $my_query = null;
                                    $my_query = discussion_custom_category_query('post', $category);
                                    global $wp_query;
                                    get_template_part('block/category-blog-list'); 
                                    ?>                            
                                </div>
                            </div>		
                            <div class="mkd-column2">
                                <div class="mkd-column-inner">
                                    <aside class="mkd-sidebar" style="transform: translateY(0px);">
                                        <div class="widget widget_apsc_widget">   
                                          <div class="vc_empty_space" style="height: 40px"><span class="vc_empty_space_inner"></span></div>    
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
<?php
    include(locate_template('block/ajax-pagination.php'));   
?>
<?php get_footer(); ?>


