<?php
/**
 * Author - Akilan
 * Date - 27-06-2016
 * Purpose - For list out the blogs based on category
 */
?>
<div class="mkd-bnl-holder mkd-pl-five-holder  mkd-post-columns-2">
    <div class="mkd-bnl-outer">
        <div class="mkd-bnl-inner">
            <?php
            if($_POST['query_type1']=='followed'){
                 $args[] = array(
                    'category' => explode(",",$_POST['sub_catid_ar']),
                    'post_status' => 'publish',                    
                    'post_type' => explode(",", $_POST['post_type']),                              
                    'post__not_in' => explode(",",$_POST['display_postid_ar']),
                    'offset' => $_POST['offset1'],
                    'numberposts' => $_POST['per_page1']
                );
                 
            }
            
            
            if($_POST['query_type2']=='unfollowed'){
                 $args[] = array(
                    'category' => $_POST['cat_id'],
                    'post_status' => 'publish',                    
                    'post_type' => explode(",", $_POST['post_type']),
                    'posts_per_page' => $_POST['per_page2'],
                    'category__not_in'=>explode(",",$_POST['sub_catid_ar']),
                    'post__not_in' => explode(",",$_POST['display_postid_ar']),
                    'offset' => $_POST['offset2'],
                    'numberposts' => $_POST['per_page2']
                );
            }
            
            foreach($args as $arg1){
            $posts_array = get_posts($arg1);

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
                    if ($i % 2 == 1):
                        /* for set out class article title based on fixed heights */
                        $title_cls=village_next_post_scrollarticle($blog_title_ar,$i);                             
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
                                        echo organize_catgory($id);
                                        ?>
                                    </div>
                                    <?php
                                }
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
            } 

            wp_reset_postdata();  // reset query
            }
            ?><!--/div-->

        </div>
    </div>
</div>
