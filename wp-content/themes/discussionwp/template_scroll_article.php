
                <?php
                /**
                 * Author - Akilan
                 * Date - 22 -06-2016
                 * Purpose - For creating ajax template for scroll based post loading
                 */
              

               $args = array(
                'category' => $_POST['cat_id'],
                'post_status' => 'publish',
                'order' => 'DESC',
                'post_type' => $_POST['post_type'],
                'offset'=>$_POST['offset'],
                'numberposts'=>$_POST['perpage']
              
                );
               $posts_array = get_posts( $args );
              
                $i = 1;
                if ($posts_array) {
                    $count=0;
                    /**
                     * For counting no of posts exist
                     */
                    foreach($posts_array as $single_post ){
                        $count++;
                    }      
                    /**
                     * Generate blog detail with 3*3 design
                     */
                    foreach ( $posts_array as $post ) : setup_postdata( $post ); ?>
                       
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
                        
                        ?>
                      
                        <?php if ($i % 3 == 1 && $count >$i) : ?>

                            <div class="mkd-bnl-outer"><div class="mkd-bnl-inner">
                                 
                                <?php endif; ?>
                                <!--div class="mkd-post-block-part clearfix"-->
                                <div class="mkd-pt-six-item mkd-post-item mkd-active-post-page">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div class="mkd-pt-six-image-holder">
                                           <?php

                                            $category = get_the_category();
                                            $the_category_id = $category[0]->cat_ID;
                                            if(function_exists('rl_color')){
                                                $rl_category_color = rl_color($the_category_id);
                                            }

                                            ?>
                                            <div  style="background: <?php echo $rl_category_color; ?>;" class="mkd-post-info-category">
                                                <?php the_category(' / '); ?>
                                            </div>

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
                                <?php if ($i % 3 == 0 || $count == $i) : ?>
                                </div>
                            </div>
                        <?php endif; ?>


                        <?php
                        $i++;

                        endforeach; 
                        wp_reset_postdata();?>
        


                    <?php
                    echo "</ul>";
                } else {                   
			discussion_get_module_template_part('templates/parts/no-posts', 'blog');		
                }             
               
                wp_reset_postdata();  // Restore global post data stomped by the_post().
                ?><!--/div-->
           