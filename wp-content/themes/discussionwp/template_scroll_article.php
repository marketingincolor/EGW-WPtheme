<?php
/**
 * Author - Akilan
 * Date - 27-06-2016
 * Purpose - For list out the blogs based on category
 */
?>
<div class="mkd-bnl-holder mkd-pl-five-holder  mkd-post-columns-3"  data-base="mkd_post_layout_five"  data-number_of_posts="3" data-column_number="3" data-category_id="7"         data-thumb_image_size="custom_size" data-thumb_image_width="302" data-thumb_image_height="198" data-title_tag="h6" data-title_length="27" data-display_date="no"  data-display_category="no" data-display_comments="no" data-display_share="no" data-display_count="no" data-display_excerpt="yes" data-excerpt_length="7" data-display_read_more="no"     data-paged="1" data-max_pages="8">
    <div class="mkd-bnl-outer">
        <div class="mkd-bnl-inner">
            <?php
            $args = array(
                'category' => $_POST['cat_id'],
                'post_status' => 'publish',
                'order' => 'DESC',
                'post_type' => explode(",", $_POST['post_type']),
                'offset' => $_POST['offset'],
                'numberposts' => $_POST['perpage']
            );
            $posts_array = get_posts($args);

            $i = 1;
            $title_cls = "";
            if ($posts_array) {
                $count = 0;
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
                $blog_title_ar=array();
                /**
                 * For counting no of posts exist
                 */
                $k=1;
                foreach ($posts_array as $single_post) {
                    $count++;
                    $blog_title_ar[$k]=$single_post->post_title;
                    $k++;
                }
                
                /**
                 * Generate blog detail with 3*3 design
                 */
                foreach ($posts_array as $post) : setup_postdata($post);
                    ?>

                    <?php
                    $id = get_the_ID();
                    $background_image_style = discussion_custom_getImageBackground($id);
                    $params['background_image_style'] = $background_image_style;
                    $post_no_class = 'mkd-post-number-' . $post_no;

                    if ($post_no > 1) {
                        $title_tag = $smaller_title_tag;
                    }

                    if ($i % 3 == 1):
                        /* for set out class article title based on fixed heights */
                        $title_cls=next_post_scrollarticle($blog_title_ar,$i);                        
                    endif;

                    /**
                     * For implement there coloumn based post in one row
                     */
                    ?>

                    <div class="mkd-pt-six-item mkd-post-item mkd-active-post-page">
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
                                            echo '<a href="' . get_category_link($getKeyrel) . '">';
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
                                <a itemprop="url" class="mkd-pt-six-slide-link mkd-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_blank">
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
                            <div class="mkd-pt-six-title-holder <?php echo $title_cls; ?>">
                                <<?php echo esc_html($title_tag) ?> class="mkd-pt-six-title">
                                <a itemprop="url" class="mkd-pt-link" href="<?php echo esc_url(get_permalink()); ?>" target="_blank"><?php echo discussion_get_title_substring(get_the_title(), $title_length) ?></a>
                                </<?php echo esc_html($title_tag) ?>>
                            </div>
                             <?php
                                   $month = get_the_time('m');
                                   $year = get_the_time('Y');
                                    ?>
                                    <div itemprop="dateCreated" class="mkd-post-info-date entry-date updated">
                                        <?php if (!discussion_post_has_title()) { ?>
                                            <a itemprop="url" href="<?php the_permalink() ?>" >
                                            <?php } else { ?>
                                                <a itemprop="url" href="<?php echo get_month_link($year, $month); ?>" target="_blank">
                                                <?php } ?>
                                                <?php
                                                if ($date_format !== '') {
                                                    the_time($date_format);
                                                } else {
                                                    the_time(get_option('date_format'));
                                                }
                                                ?>
                                                <?php if (!discussion_post_has_title()) { ?>
                                                </a>
                                            <?php } else { ?>
                                            </a>
                                        <?php } ?>
                                        <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(discussion_get_page_id()); ?>"/>
                                    </div>
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
                    $i++;

                endforeach;
                wp_reset_postdata();
                ?>



                <?php
            } else {
                discussion_get_module_template_part('templates/parts/no-posts', 'blog');
            }

            wp_reset_postdata();  // Restore global post data stomped by the_post().
            ?><!--/div-->

        </div>
    </div>
</div>
