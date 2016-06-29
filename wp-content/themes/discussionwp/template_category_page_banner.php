<?php
/**
 * Author - Akilan
 * Date - 20-06-2016
 * Purpose - For displaying category image as banner
 */

?>

<div id="category_banner" class="vc_row wpb_row vc_row-fluid mkd-section mkd-content-aligment-left">
    <div class="clearfix mkd-full-section-inner">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                    <div data-max_pages="1" data-paged="1" data-sort="featured_first" data-post_in="205, 215, 218, 225, 232" data-category_id="4" data-number_of_posts="5" data-slider_height="735" data-base="mkd_post_slider_interactive" class="mkd-bnl-holder mkd-psi-holder  mkd-psi-number-5" style="opacity: 1;">
                        <div class="mkd-bnl-outer">
                            <?php
                            $category_id = get_cat_id( single_cat_title("",false));     
                            $cat = get_category($category_id);
                          
                          
                            
                            $args = array(
                                'title_tag' => 'h2',
                                'display_category' => 'no',
                                'display_date' => 'no',
                                'date_format' => 'd. F Y',
                                'display_comments' => 'no',
                                'display_count' => 'no',
                                'display_share' => 'no',
                                'slider_height' => ''
                            );
                            
                            if ($cat):
                                $title_ta = 'h2';
                                $display_category = 'no';
                                $display_date = 'no';
                                $date_format = 'd. F Y';
                                $display_comments = 'no';
                                $display_count = 'no';
                                $display_share = 'yes';
                                $slider_height = '';
                                $params = shortcode_atts($args, $atts);
                                    $url= z_taxonomy_image_url($cat->term_id);
                                    if($url!=""){
                                     $image_params = discussion_custom_categoryImageParams($cat->term_id);
                                     $params = array_merge($params, $image_params);
                                    }
                                    
                                   
                                    
                                    $redirect_url = esc_url(get_permalink());
                                    ?>
                                    <div class="mkd-psi-slider">      

                                        <div class="mkd-psi-slide" data-image-proportion="<?php echo esc_attr($params['proportion']) ?>" <?php discussion_inline_style($params['background_image']); ?>>
                                            <div class="mkd-psi-content">
                                                <div class="mkd-grid">
                                                     

                                                    <?php
                                                    discussion_post_info_category(array(
                                                        'category' => $display_category
                                                    ))
                                                    ?>
                                                    <h2 class="mkd-psi-title">
<!--                                                        <a itemprop="url" href="javascript:void(0)" target="_self">-->
                                                            <?php echo esc_attr($cat->name) ?>
<!--                                                        </a>-->
                                                    </h2>
                                                    <?php
                                                    discussion_post_info_date(array(
                                                        'date' => $display_date,
                                                        'date_format' => $date_format
                                                    ));
                                                    ?>
                                                    <?php if ($display_share == 'yes' || $display_comments == 'yes' || $display_count == 'yes') { ?>
                                                      <!--   <div class="mkd-pt-info-section clearfix">
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
                                                        </div> -->
                                                     <div class="mkd-follow-category">
                                                        <a href="">Follow</a>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                              
                             
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