<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Template Name: Find branch
 *
 * Selectable from a dropdown menu on the edit page screen.
 */
?>

<?php get_header(); ?>
<div class="mkd-content">
    <div class="mkd-content-inner">
        <?php do_action('discussion_after_container_open'); ?>
        <div class="mkd-full-width">
            <div class="mkd-full-width-inner">               
                <div style="" class="vc_row wpb_row vc_row-fluid mkd-section mkd-content-aligment-left">
                    <div class="clearfix mkd-full-section-inner">
                        <div class="wpb_column vc_column_container vc_col-sm-12">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper">
                                    <div data-max_pages="1" data-paged="1" data-sort="featured_first" data-post_in="205, 215, 218, 225, 232" data-category_id="4" data-number_of_posts="5" data-slider_height="735" data-base="mkd_post_slider_interactive" class="mkd-bnl-holder mkd-psi-holder  mkd-psi-number-5" style="opacity: 1;">
                                        <div class="mkd-bnl-outer">
                                            <!-- Full page banner at top f the page -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
                <div style="" class="vc_row wpb_row vc_row-fluid mkd-section mkd-content-aligment-left mkd-grid-section">
                    <div class="mkd-container-inner clearfix">
                        <div class="mkd-column1 mkd-content-left-from-sidebar">
                            <div class="mkd-column-inner">
                                <ul>
                                <?php
                                $blog_list = get_blog_list(0, 'all');
                                foreach ($blog_list AS $blog) {
                                    
                                    //echo 'Blog ' . $blog['blog_id'] . ': ' . $blog['domain'] . $blog['path'] . '';
                                    echo "<li type='square'><a href='http://".$blog['domain'] . $blog['path']."' target='_blank'>". $blog['domain'] . $blog['path'] . "</a></li>";
                                }
                                ?>
                            </ul>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>    
    <?php get_footer(); ?>




