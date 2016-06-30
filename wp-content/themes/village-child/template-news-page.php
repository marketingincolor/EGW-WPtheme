<?php
/**
 * Template Name: Child News Page
 *
 * 
 */
?>
<?php get_header(); ?>
<div class="mkd-content">
    <div class="mkd-content-inner">
        <div class="mkd-full-width">
            <div class="mkd-full-width-inner"> 
                <?php get_template_part('template-page-featured-content'); ?>
                <div class="vc_empty_space" style="height: 40px"><span class="vc_empty_space_inner"></span></div>
                <div class="mkd-container">
                    <div class="mkd-container-inner clearfix">
                        <div class="mkd-two-columns-75-25  mkd-content-has-sidebar clearfix">
                            <div class="mkd-column1 mkd-content-left-from-sidebar">
                                <div class="mkd-column-inner">
                                    <?php
                                    $category = 'news';
                                    $my_query = null;
                                    $my_query = discussion_custom_category_query('post', $category);
                                    global $wp_query;
                                    get_template_part('template-blog-block');
                                    ?>                            
                                </div>
                            </div>		
                            <div class="mkd-column2">
                                <div class="mkd-column-inner">
                                    <aside class="mkd-sidebar" style="transform: translateY(0px);">
                                        <div class="widget widget_apsc_widget">   
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

<?php get_footer(); ?>


