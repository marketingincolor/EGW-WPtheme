<?php
/**
 * Template Name: News Page
 *
 * Selectable from a dropdown menu on the edit page screen.
 */
?>
<style type="text/css">
    .mkd-psi-content .mkd-grid:first-child{
        /*        display:none;*/
    }
</style>
<?php $currentcat = 9;
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

                                            <?php
//                                            $args = array(
//                                                'title_tag' => 'h2',
//                                                'display_category' => 'no',
//                                                'display_date' => 'no',
//                                                'date_format' => 'd. F Y',
//                                                'display_comments' => 'no',
//                                                'display_count' => 'yes',
//                                                'display_share' => 'no',
//                                                'slider_height' => ''
//                                            );
//                                            $args1 = array(
//                                                'category_name' => 'News',
//                                                'post_status' => 'publish',
//                                                'order' => 'ASC',
//                                                'posts_per_page' => 1,
//                                                    // 'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1)
//                                            );
//                                            $type = 'posts';
//
//
//
//                                            $my_query = null;
//
//                                            $atts['query_result'] = query_posts($args1);
//
//                                            $params = shortcode_atts($args, $atts);
//
//                                            $html = '';
//                                            $thumb_html = '';
//
//                                            $data = getData($params, $atts);
//
//                                            if (have_posts()):
//                                                $html .= '<div class="mkd-psi-slider">';
//
//                                                while (have_posts()) : the_post();
//
//                                                    $id = get_the_ID();
//                                                    $image_params = getImageParams($id);
//                                                    $params = array_merge($params, $image_params);
//
//                                                    //Get HTML from template
//                                                    $html .= discussion_get_list_shortcode_module_template_part('templates/post-slider-interactive-template', 'post-slider-interactive', '', $params);
//
//                                                    discussion_get_list_shortcode_module_template_part('templates/post-slider-int-thumbnails-template', 'post-slider-interactive', '', $params);
//                                                endwhile;
//
//                                                $html .= '</div>';
//                                            else:
//                                                $html .= $this->errorMessage();
//
//                                            endif;
//
//                                            if ($thumb_html !== '') {
//                                                $html .= '<div class="mkd-psi-thumb-slider-holder">';
//                                                $html .= '<div class="mkd-grid">';
//                                                $html .= '<div class="mkd-psi-slider-thumb">';
//                                                $html .= $thumb_html;
//                                                $html .= '</div>';
//                                                $html .= '</div>';
//                                                $html .= '<div class="mkd-psi-thumb-slider-backg">';
//                                                $html .= '</div>';
//                                                $html .= '</div>';
//                                            }
//
//                                            wp_reset_postdata();
//
//                                            echo $html;
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>

                <?php if (have_posts()) { ?>
                    <!-- Segment 2: display all post (title permalink and except) for $catstub category -->
                    <?php
                    $cat_id = $currentcat;
                    $args = array(
                        'cat' => $cat_id,
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'caller_get_posts' => 1,
                        'title_tag' => 'h3',
                        'title_length' => '',
                        'display_date' => 'no',
                        'date_format' => 'd. F Y',
                        'display_category' => 'yes',
                        'display_comments' => 'yes',
                        'display_share' => 'yes',
                        'display_count' => 'yes',
                    );
                    $my_query = null;
                    $my_query = new WP_Query($args);
                    
                    /* settings for post display*/
                    $title_tag = 'h3';
                    $title_length = '';
                    $display_date = 'yes';
                    $date_format = 'd. F Y';
                    $display_category = 'yes';
                    $display_comments = 'yes';
                    $display_share = 'yes';
                    $display_count = 'yes';
                    $display_excerpt = 'yes';
                    $thumb_image_width = '';
                    $thumb_image_height = '';
                    $thumb_image_size = '150';
                    $excerpt_length = '12';
                    ?>

                    <div style="" class="vc_row wpb_row vc_row-fluid mkd-section mkd-content-aligment-left mkd-grid-section">
                        <div class="mkd-container-inner clearfix">
                            <div class="mkd-section-inner-margin clearfix">
                                                                <!-- Post block start-->
                                <div class="wpb_column vc_column_container vc_col-sm-12">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <div class="vc_empty_space" style="height: 40px"><span class="vc_empty_space_inner"></span></div>
                                            <div class="mkd-bnl-holder mkd-pl-five-holder  mkd-post-columns-3"  data-base="mkd_post_layout_five"  data-number_of_posts="3" data-column_number="3" data-category_id="7"         data-thumb_image_size="custom_size" data-thumb_image_width="302" data-thumb_image_height="198" data-title_tag="h6" data-title_length="27" data-display_date="no"  data-display_category="no" data-display_comments="no" data-display_share="no" data-display_count="no" data-display_excerpt="yes" data-excerpt_length="7" data-display_read_more="no"     data-paged="1" data-max_pages="8">
                                                <div class="mkd-bnl-outer">
                                                    <div class="mkd-bnl-inner">
                                                        <?php
                                                if ($my_query->have_posts()) {
                                                    while ($my_query->have_posts()) : $my_query->the_post();
                                                        ?> 
                                                        <!-- Post loop started -->
                                                        <div class="mkd-pt-six-item mkd-post-item mkd-active-post-page">
                                                           <div class="mkd-pt-six-image-holder">
                                                                        <?php
                                                                        discussion_post_info_category(array(
                                                                            'category' => $display_category
                                                                        ));
                                                                        ?>
                                                                        <a itemprop="url" class="mkd-pt-six-slide-link mkd-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                                                                            <?php
                                                                            if ($thumb_image_size != 'custom_size') {
                                                                                echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
                                                                            } elseif ($thumb_image_width != '' && $thumb_image_height != '') {
                                                                                echo discussion_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $thumb_image_width, $thumb_image_height);
                                                                            }
                                                                            ?>
                                                                            <?php
                                                                            if ($display_post_type_icon == 'yes') {
                                                                                discussion_post_info_type(array(
                                                                                    'icon' => 'yes',
                                                                                ));
                                                                            }
                                                                            ?>
                                                                        </a>
                                                                    </div>
                                                            <div class="mkd-pt-six-content-holder">
                                                                    <div class="mkd-pt-six-title-holder">
                                                                        </<?php echo esc_html($title_tag) ?> class="mkd-pt-six-title">
                                                                        <a itemprop="url" class="mkd-pt-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"><?php echo discussion_get_title_substring(get_the_title(), $title_length) ?></a>
                                                                        </<?php echo esc_html($title_tag) ?>>
                                                                    </div>
                                                                    <?php
                                                                    discussion_post_info_date(array(
                                                                        'date' => $display_date,
                                                                        'date_format' => $date_format
                                                                    ));
                                                                    ?>
                                                                    <?php if ($display_excerpt == 'yes') { ?>
                                                                        <div class="mkd-pt-one-excerpt">
                                                                            <?php discussion_excerpt($excerpt_length); ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php if ($display_share == 'yes' || $display_comments == 'yes') { ?>
                                                                    <div class="mkd-pt-info-section clearfix">
                                                                        <div>
                                                                            <?php
                                                                            discussion_post_info_share(array(
                                                                                'share' => $display_share
                                                                            ));
                                                                            discussion_post_info_comments(array(
                                                                                'comments' => $display_comments
                                                                            ));
                                                                            ?>
                                                                        </div>
                                                                        <div class="mkd-pt-info-section-background"></div>
                                                                    </div>
                                                                <?php } ?>
                                                        </div>
                                                        <?php
                                                        endwhile;
                }
                wp_reset_query();  // Restore global post data stomped by the_post().
                ?>
                                                        <!-- Post Loop ended  -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                           
                        </div><!-- #content -->

                    </div>
                </div> <?php }?>
                
            </div></div>
    </div>    
    <?php get_footer(); ?>

