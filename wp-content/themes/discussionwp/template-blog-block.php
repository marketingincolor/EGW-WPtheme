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
                        <?php
                        /**
                         * For implement two coloumn based post in one row
                         */
                        ?>

                        <?php if ($i % 3 == 1 && $wp_query->post_count > $i) : ?>
                            <div class="mkd-bnl-outer"><div class="mkd-bnl-inner">
                                <?php endif; ?>
                                <!--div class="mkd-post-block-part clearfix"-->
                                <div class="mkd-pt-six-item mkd-post-item">
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
                                <?php if ($i % 3 == 0 || $wp_query->post_count == $i) : ?>
                                </div>
                            </div>
                        <?php endif; ?>


                        <?php
                        $i++;
                    endwhile;
                    ?>


                    <?php
                    echo "</ul>";
                } else {                   
			discussion_get_module_template_part('templates/parts/no-posts', 'blog');		
                }
               
                discussion_pagination($wp_query->max_num_pages, 6, get_query_var('paged') ? get_query_var('paged') : 1);
                wp_reset_query();  // Restore global post data stomped by the_post().
                ?><!--/div-->

            </div>
        </div>
    </div>

</div>
