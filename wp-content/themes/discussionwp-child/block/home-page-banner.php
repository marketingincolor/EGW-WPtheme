<?php
/**
 * Author - Akilan
 * Date - 20-07-2015
 * Purpose - For keeping home page banner as seperate process
 */
$category='feature-home';
?>
<div style="" class="vc_row wpb_row vc_row-fluid mkd-section mkd-content-aligment-left">
    <div class="clearfix mkd-full-section-inner">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                    <div class="mkd-bnl-holder mkd-psi-holder  mkd-psi-number-5" style="opacity: 1;">
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
                            $atts['query_result'] = discussion_custom_featured_query($category);
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
                                    if (!empty($post_redirect_data) && isset($post_redirect_data[0]) && !empty($post_redirect_data[0])) {
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