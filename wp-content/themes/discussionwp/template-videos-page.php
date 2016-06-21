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
            videos section
        */
        ?>
       <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <div class="vc_empty_space" style="height: 40px"><span class="vc_empty_space_inner"></span></div>
                                        <div class="mkd-bnl-holder mkd-pl-five-holder  mkd-post-columns-3"  data-base="mkd_post_layout_five"  data-number_of_posts="3" data-column_number="3" data-category_id="7"  data-thumb_image_size="custom_size" data-thumb_image_width="302" data-thumb_image_height="198" data-title_tag="h6" data-title_length="27" data-display_date="no"  data-display_category="no" data-display_comments="no" data-display_share="no" data-display_count="no" data-display_excerpt="yes" data-excerpt_length="7" data-display_read_more="no"     data-paged="1" data-max_pages="8">
                                       
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