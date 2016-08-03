<?php
/**
 * Author - Akilan
 * Date - 10-06-2016
 * Purpose - For displaying article 3*3 based on category
 * Modified - 01-07-2016
 */
?>
<?php
list($post_per_section, $post_type) = scroll_loadpost_settings();
?>


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
        $excerpt_length = '9';
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
                if ($display_excerpt == 'yes') {
                    ?>
                    <div class="mkd-pt-one-excerpt">
                        <?php custom_discussion_excerpt(60);?>
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


<?php wp_reset_query();  // Restore global post data stomped by the_post().?>


