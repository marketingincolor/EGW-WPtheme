<?php
/**
 * Template Name: Home page
 *
 * For displaying featured article and home category blogs
 */
?>

<?php get_header();
$post_per_section=6;
?>

<div class="mkd-content">
    <div class="mkd-content-inner">
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
                                            $args = array(
                                                'title_tag' => 'h2',
                                                'display_category' => 'no',
                                                'display_date' => 'no',
                                                'date_format' => 'd. F Y',
                                                'display_comments' => 'no',
                                                'display_count' => 'yes',
                                                'display_share' => 'no',
                                                'slider_height' => ''
                                            );

                                           



                                            $my_query = null;

                                            $atts['query_result'] = discussion_custom_featured_query('home', 'featured_article');

                                            $params = shortcode_atts($args, $atts);

                                            $html = '';
                                            $thumb_html = '';

                                            $data = discussion_custom_getData($params, $atts);

                                            if (have_posts()):
                                                $title_ta = 'h2';
                                                $display_category = 'no';
                                                $display_date = 'yes';
                                                $date_format = 'd. F Y';
                                                $display_comments = 'yes';
                                                $display_count = 'yes';
                                                $display_share = 'yes';
                                                $slider_height = '';

                                                while (have_posts()) : the_post();
                                                    $id = get_the_ID();
                                                    $image_params = discussion_custom_getImageParams($id);
                                                    $params = array_merge($params, $image_params);
                                                    $redirect_url = esc_url(get_permalink());
                                                    $post_redirect_data = get_post_meta($id, 'feature_article_url');                                                    
                                                    if (!empty($post_redirect_data) && isset($post_redirect_data[0]) && !empty($post_redirect_data[0])){                                                        
                                                        $redirect_url = esc_url($post_redirect_data[0]);
                                                    }                                                   
                                                    ?>
                                                    <div class="mkd-psi-slider">      

                                                        <div onclick="window.location.href = '<?php echo $redirect_url; ?>'" class="mkd-psi-slide" data-image-proportion="<?php echo esc_attr($params['proportion']) ?>" <?php discussion_inline_style($params['background_image']); ?>>
                                                            <div class="mkd-psi-content">
                                                                <div class="mkd-grid">
                                                                    <?php
                                                                    discussion_post_info_category(array(
                                                                        'category' => $display_category
                                                                    ))
                                                                    ?>
                                                                    <h2 class="mkd-psi-title">
                                                                        <a itemprop="url" href="<?php echo $redirect_url; ?>" target="_self"><?php echo esc_attr(the_title()) ?></a>
                                                                    </h2>
                                                                    <?php
                                                                    discussion_post_info_date(array(
                                                                        'date' => $display_date,
                                                                        'date_format' => $date_format
                                                                    ));
                                                                    ?>
                                                                            <?php if ($display_share == 'yes' || $display_comments == 'yes' || $display_count == 'yes') { ?>
                                                                        <div class="mkd-pt-info-section clearfix">
                                                                            <div>
                                                                                <?php
                                                                                discussion_post_info_share(array(
                                                                                    'share' => $display_share
                                                                                ));
                                                                                discussion_post_info_comments(array(
                                                                                    'comments' => $display_comments
                                                                                ));
                                                                                discussion_post_info_count(array(
                                                                                    'count' => $display_count
                                                                                        ), 'list');
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                endwhile;
                                                $html .= '<div class="mkd-psi-slider">  </div>';
                                            else:
                                                discussion_get_module_template_part('templates/parts/no-posts', 'blog');

                                            endif;
                                            wp_reset_postdata();
                                            echo $html;
                                            ?>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>



                <div style="" class="vc_row wpb_row vc_row-fluid mkd-section mkd-content-aligment-left mkd-grid-section">
                    <div class="mkd-container-inner clearfix">
                        <div class="mkd-section-inner-margin clearfix">


                            <?php
                            $my_query = null;
                            $my_query = discussion_home_custom_category_query('post','home',$post_per_section);       
                          
                            global $wp_query;
                              
                            ?>


                            <!-- Post block start-->

                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <div class="vc_empty_space" style="height: 40px"><span class="vc_empty_space_inner"></span></div>
                                        <div class="mkd-bnl-holder mkd-pl-five-holder  mkd-post-columns-3"  data-base="mkd_post_layout_five"  data-number_of_posts="3" data-column_number="3" data-category_id="7"         data-thumb_image_size="custom_size" data-thumb_image_width="302" data-thumb_image_height="198" data-title_tag="h6" data-title_length="27" data-display_date="no"  data-display_category="no" data-display_comments="no" data-display_share="no" data-display_count="no" data-display_excerpt="yes" data-excerpt_length="7" data-display_read_more="no"     data-paged="1" data-max_pages="8">


                                            <?php
                                            $i = 1;
                                            if (have_posts()) {
                                                while (have_posts()) :the_post();
                                                    ?>
                                                    <?php
                                                    $id = get_the_ID();
                                                    $background_image_style = discussion_custom_getImageBackground($id);
                                                    $params['background_image_style'] = $background_image_style;
                                                    $post_no_class = 'mkd-post-number-' . $post_no;

                                                    if ($post_no > 1) {
                                                        $title_tag = $smaller_title_tag;
                                                    }

                                                    $title_tag = 'h3';
                                                    $title_length = '20';
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
                                                    <?php
                                                    /**
                                                     * For implement two coloumn based post in one row
                                                     */
//                                                   
                                                    ?>

                                    <?php if ($i % 3 == 1 && $wp_query->post_count > $i) : ?>
                                            <div class="mkd-bnl-outer"><div class="mkd-bnl-inner">
                                                            <?php endif; ?>
                                                            <!--div class="mkd-post-block-part clearfix"-->
                                                            <div class="mkd-pt-six-item mkd-post-item">
                                                                <?php if (has_post_thumbnail()) { ?>
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
                                                                <?php } ?>
                                                                <div class="mkd-pt-six-content-holder">
                                                                    <div class="mkd-pt-six-title-holder">
                                                                        <<?php echo esc_html($title_tag) ?> class="mkd-pt-six-title">
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
                                                            <?php if ($i % 3 == 0 || $wp_query->post_count == $i) : ?>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                         <?php
                                                  
                                                        
                                                      
                                                        $i++;
                                                    endwhile;
                                                    
                                                    $total_post=$wp_query->found_posts;
                                                    $no_of_adds=floor($wp_query->found_posts/$post_per_section);
                                                    for ($i = 1; $i <=$no_of_adds; $i++) { ?> 
                                                        <div  id="adv_row_<?php echo $i; ?>" <?php if($i!=1) { ?> style="display:none" <?php } ?>>  
                                                            <?php if (function_exists('drawAdsPlace'))
                                                                drawAdsPlace(array('id' => 1), true);
                                                            ?>
                                                        </div>
                                                        <?php
                                                    }
                                                                                                    ?>
                                                   

                                                    <?php
                                                    echo "</ul>";
                                                } else {
                                                    echo "No content found";
                                                }?>
                                                <input type="hidden" id="processing" value="0">
                                                <input type="hidden" id="currentloop" value="1">
                                                <input type="hidden" id="total_post" value="<?php echo $wp_query->found_posts;?>">
                                                <input type="hidden" id="current_post" value="<?php if($wp_query->found_posts<6): echo $wp_query->found_posts; else: echo '6'; endif;?>">
                                                <?php
                                                wp_reset_query();  // Restore global post data stomped by the_post().
                                                ?><!--/div-->
                                                 
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div><!-- #content -->

                    </div>
                
              
                
                <div class="mkd-ratings-holder" style="background:none;display:none" align="center">
                    <div class="mkd-ratings-text-holder">                      
                        <div class="mkd-ratings-stars-holder">
                            <div class="mkd-ratings-stars-inner">
                                <img src="<?php echo MIKADO_ASSETS_ROOT . '/img/loading.svg'; ?>" width="75">
                            </div>
                        </div>
                    </div>

                </div>
               
                </div>
            </div>
            </div>
    </div>
     <!-- For post pagintation maintain -->
    
    <?php
//    $mysqll=custom_scroll_post_load('home','post');
//    global $wp_query;
    get_template_part('template-ajax-pagination');
   
   
    ?>
    <?php get_footer(); ?>

