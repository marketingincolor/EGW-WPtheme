<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Template Name: Saved Article
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
                        <?php
                        global $post;
                        $require_post = $post;
                        $user_data = get_user_meta(get_current_user_id(), 'wpfp_favorites');
                        $post_id_ar = array();
                        if (!empty($user_data) && isset($user_data[0]))
                            $post_id_ar = $user_data[0];

                        $args = array(
                            'post__in' => $post_id_ar,
                            'posts_per_page' => 2,
                            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),
                        );
                        $saved_posts = query_posts($args);
                        ?>
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <?php if (($sidebar == 'default') || ($sidebar == '')) : ?>
                                    <li><a href="<?php the_permalink(); ?>"> <?php the_title('<h3>', '</h3>'); ?></a></li>

                                    <?php the_content(); ?>
                                    <?php do_action('discussion_page_after_content'); ?>
                                <?php elseif ($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>
                                    <div <?php echo discussion_sidebar_columns_class(); ?>>
                                        <div class="mkd-column1 mkd-content-left-from-sidebar">
                                            <div class="mkd-column-inner">
                                                <?php the_content(); ?>
                                                <?php do_action('discussion_page_after_content'); ?>
                                            </div>
                                        </div>
                                        <div class="mkd-column2">
                                            <?php get_sidebar(); ?>
                                        </div>
                                    </div>
                                <?php elseif ($sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left'): ?>
                                    <div <?php echo discussion_sidebar_columns_class(); ?>>
                                        <div class="mkd-column1">
                                            <?php get_sidebar(); ?>
                                        </div>
                                        <div class="mkd-column2 mkd-content-right-from-sidebar">
                                            <div class="mkd-column-inner">
                                                <?php the_content(); ?>
                                                <?php do_action('discussion_page_after_content'); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>


                            <?php endwhile; ?> 

                            <div class="navigation">
                                <div class="alignleft"><?php previous_posts_link('&laquo; Previous') ?></div>
                                <div class="alignright"><?php next_posts_link('More &raquo;') ?></div>
                            </div>


                        <?php
                        endif;
                        $post = $require_post;
                        ?>
                    </div>
                </div> 

            </div></div>
    </div>    
    <?php get_footer(); ?>




