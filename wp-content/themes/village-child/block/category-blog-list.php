<!-- Post block start-->
<?php
list($post_per_section, $post_type) = scroll_loadpost_settings();
?>
<div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="wpb_wrapper">
            <div class="vc_empty_space" style="height: 40px"><span class="vc_empty_space_inner"></span></div>
            <div class="mkd-bnl-holder mkd-pl-five-holder  mkd-post-columns-2"  data-base="mkd_post_layout_five"  data-number_of_posts="3" data-column_number="3" data-category_id="7"         data-thumb_image_size="custom_size" data-thumb_image_width="302" data-thumb_image_height="198" data-title_tag="h6" data-title_length="27" data-display_date="no"  data-display_category="no" data-display_comments="no" data-display_share="no" data-display_count="no" data-display_excerpt="yes" data-excerpt_length="7" data-display_read_more="no"  data-paged="1" data-max_pages="8">
                <div class="mkd-bnl-outer">
                    <div class="mkd-bnl-inner">

                        <?php
                        $i = 1;
                        $total_post = 0;
                        $title_cls = "";
                        if (have_posts()) {
                            while (have_posts()) :the_post();
                             if ($i % 2 == 1):
                                    /* for set out class article title based on fixed heights */
                                    $title_cls = village_article_title_class($wp_query);
                                endif;
                                $id = get_the_ID();
                                $background_image_style = discussion_custom_getImageBackground($id);
                                $params['background_image_style'] = $background_image_style;
                                $post_no_class = 'mkd-post-number-' . $post_no;
                                $total_post = $wp_query->found_posts;
                                if ($post_no > 1) {
                                    $title_tag = $smaller_title_tag;
                                }

                                /**
                                 * For hide date/category for videos section
                                 */
                                $title_tag = 'h4';
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
                        
                                <div class="mkd-pt-six-item mkd-post-item">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div class="mkd-pt-six-image-holder">
                                            <?php
                                            if ($display_category == 'yes') {
                                                $category = get_the_category();
                                                $the_category_id = $category[0]->cat_ID;
                                                if (function_exists('rl_color')) {
                                                    $rl_category_color = rl_color($the_category_id);
                                                }
                                                ?>
                                                <div  style="background: <?php echo $rl_category_color; ?>;" class="mkd-post-info-category">
                                                    <?php //the_category(' / '); ?>
                                                    <?php
                                                    $getPostcat = wp_get_post_categories($id);
                                                    $getResultset = check_cat_subcat($getPostcat);
                                                    count($getResultset);
                                                    $j = 1;
                                                    foreach ($getResultset as $getKeyrel) {
                                                        echo '<a href="' . get_category_link($getKeyrel) . '" target="_self">';
                                                        echo get_cat_name($getKeyrel) . '</a>';
                                                        if ($j > count($getResultset) - 1) {
                                                            echo "";
                                                        } else {
                                                            echo "\x20/\x20";
                                                        }
                                                        $j++;
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <a itemprop="url" class="mkd-pt-six-slide-link mkd-image-link" href="<?php echo esc_url(get_permalink()); ?>" >
                                                <?php
                                                if ($thumb_image_size != 'custom_size') {
                                                    echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
                                                } elseif ($thumb_image_width != '' && $thumb_image_height != '') {
                                                    echo discussion_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $thumb_image_width, $thumb_image_height);
                                                }

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
                                        <div class="mkd-pt-six-title-holder <?php echo $title_cls; ?>">
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
                                        <?php
                                        if ($display_excerpt == 'yes') {
                                            ?>
                                            <div class="mkd-pt-one-excerpt">
                                                <?php discussion_excerpt($excerpt_length); ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php if ($display_share == 'yes' || $display_comments == 'yes') { ?>
                                        <div class="mkd-pt-info-section clearfix">
                                            <div>
                                                <?php
                                                discussion_post_info_share(array(
                                                    'share' => $display_share
                                                ));
                                                ?>
                                               <?php   
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
                                $i++;
                            endwhile;
                        } else {
                            discussion_get_module_template_part('templates/parts/no-posts', 'blog');
                        }
                        ?>

                    </div>
                </div>
                <?php
                ?>
                <input type="hidden" id="processing" value="0">
                <input type="hidden" id="currentloop" value="1">
                <input type="hidden" id="total_post" value="<?php echo $wp_query->found_posts; ?>">
                <input type="hidden" id="current_post" value="<?php
                if ($wp_query->found_posts < $post_per_section): echo $wp_query->found_posts;
                else: echo $post_per_section;
                endif;
                ?>">
               <?php
               wp_reset_query();  // Restore global post data stomped by the_post().
               ?>

            </div>
            <?php
            /**
             * For displaying ads based on total count of post
             */
            if ($total_post >= $post_per_section) {
                $no_of_adds = floor($total_post / $post_per_section);
                for ($i = 1; $i <= $no_of_adds; $i++) {
                    ?> 

                    <div  class="fsp-ads-homepage"  id="adv_row_<?php echo $i; ?>" <?php if ($i != 1) { ?> style="display:none;clear:both" <?php } else { ?> style="clear:both" <?php } ?>>  
                        <?php
                        if (function_exists('drawAdsPlace'))
                            drawAdsPlace(array('id' => 1), true);
                        ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

</div>

<?php
/**
 * jquery loading image icon display block
 */
get_template_part('sidebar/template-ajax-image');
?>

