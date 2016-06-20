<?php
/**
 * Template Name: Videos Page
 *
 * Selectable from a dropdown menu on the edit page screen.
 */
?>

<?php get_header(); ?>

<div class="mkd-container">
    <div id="content" class="mkd-container-inner">   
                 <?php
                   /*
                      banner section
                   */
                  ?>
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
                                                'display_count' => 'yes',
                                                'slider_height' => ''
                                            );

                                            $atts['query_result'] = discussion_custom_featured_query('Videos', 'featured_article');
                                                        
                                            $params = shortcode_atts($args, $atts); //combines user attributes($atts) with known attributes
                   
                                            $html = '';
                                            $thumb_html = '';

                                            $data = discussion_custom_getData($params, $atts);
                                         
                                            if (have_posts()):
                                                $title_ta = 'h2';
                                                $display_category = 'no';
                                                $display_date = 'yes';
                                                $date_format = 'd. F Y';
                                                $display_count = 'yes';                    
                                                $slider_height = '';

                                                while (have_posts()) : the_post();
                                                    $id = get_the_ID();

                                                    $image_params = discussion_custom_getImageParams($id);
                                                    $params = array_merge($params, $image_params);
                                                 
                                                    ?>
                                                    <div class="mkd-psi-slider">      

                                                        <div  class="mkd-psi-slide" data-image-proportion="<?php echo esc_attr($params['proportion']) ?>" <?php discussion_inline_style($params['background_image']); ?>>
                                                            <div class="mkd-psi-content">
                                                                <div class="mkd-grid">
                                                                    <?php
                                                                    discussion_post_info_category(array(
                                                                        'category' => $display_category
                                                                    ))
                                                                    ?>
                                                                    <h2 class="mkd-psi-title">
                                                                        <a itemprop="url" href="<?php echo $redirect_url; ?>" target="_self"><?php echo esc_attr(get_the_title()) ?></a>
                                                                    </h2>
                                                                    <?php
                                                                    discussion_post_info_date(array(
                                                                        'date' => $display_date,
                                                                        'date_format' => $date_format
                                                                    ));
                                                                    ?>
                                                                    <?php if ( $display_count == 'yes') { ?>
                                                                        <div class="mkd-pt-info-section clearfix">
                                                                            <div>
                                                                                <?php
                                                                             
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
                                                endif;
                                                wp_reset_query();
                                            ?>
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
              /*
                 videos section
              */
              ?>
       <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <div class="vc_empty_space" style="height: 40px"><span class="vc_empty_space_inner"></span></div>
                                        <div class="mkd-bnl-holder mkd-pl-five-holder  mkd-post-columns-3"  data-base="mkd_post_layout_five"  data-number_of_posts="3" data-column_number="3" data-category_id="7"  data-thumb_image_size="custom_size" data-thumb_image_width="302" data-thumb_image_height="198" data-title_tag="h6" data-title_length="27" data-display_date="no"  data-display_category="no" data-display_comments="no" data-display_share="no" data-display_count="no" data-display_excerpt="yes" data-excerpt_length="7" data-display_read_more="no"     data-paged="1" data-max_pages="8">
                                            <div class="mkd-layout-title-holder">
                                                <span class="mkd-section-title-holder clearfix mkd-pattern-light">
                                                    <span class="mkd-st-title"> Latest Videos </span>    
                                                </span>
                                            </div>
                                            <?php
                                            $i = 1;
                                            $type = 'videos';
                                            $args = array(
                                            'post_type' => $type,
                                            'post_status' => 'publish',
                                            'posts_per_page'=>6,
                                            'paged'=> get_query_var('paged') ? get_query_var('paged') : 1
                                             );
                                            $my_query = null;
                                            $my_query = query_posts($args);
                                            if(have_posts()) 
                                            {
                                                while (have_posts()) :the_post();
                                                    $display_excerpt = 'yes';
                                                    $excerpt_length = '12';
                                                                                
                                              if ($i % 3 == 1 && $wp_query->post_count > $i) : ?>
                                             <div class="mkd-bnl-outer"><div class="mkd-bnl-inner">
                                               <?php endif; ?>
                                                     <div class="mkd-pt-six-item mkd-post-item">  
                                                            <div class="mkd-pt-six-image-holder">
                                                                   <?php
                                                                             $image_file = get_field('image_file');
                                                                             
                                                                             if($image_file != "") 
                                                                             { ?>
                                                                              <a href="<?php echo esc_url(get_permalink()); ?>" target="_self"> <img src="<?php echo $image_file; ?>" width="100%" height="250px"> </a>
                                                                             <?php
                                                                             }  
                                                                             ?>
                                                            </div>    
                                                         <div class="mkd-pt-six-content-holder">
                                                            <div class="mkd-pt-six-title-holder">  
                                                                        <a itemprop="url" class="mkd-pt-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self"><?php echo the_title(); ?></a>                   
                                                            </div>
                                                            <?php if ($display_excerpt == 'yes') { ?>
                                                            <div class="mkd-pt-one-excerpt">
                                                            <?php discussion_excerpt($excerpt_length); ?>
                                                            </div>
                                                             <?php } ?> 
                                                         </div>
                                                   </div>                      
                                                 <?php if ($i % 3 == 0 || $wp_query->post_count == $i) : ?>
                                                 </div>
                                               </div>
                                                <?php endif; ?>
                                                    <?php
                                                    $i++;
                                                endwhile;?>
                                            <?php
                                                echo discussion_pagination($wp_query->max_num_pages, 1, get_query_var('paged') ? get_query_var('paged') : 1);  
                                              } 
                                              else 
                                              {
                                                echo "No content found";
                                              }
                                              wp_reset_query();  
                                            ?>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php get_footer(); ?>