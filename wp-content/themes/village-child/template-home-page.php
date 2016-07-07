<?php
/**
 * Template Name: Child home page
 *
 * 
 */
?>
<?php
get_header();
$post_per_section = 6;
?>
<div class="mkd-full-width">
    <div class="mkd-full-width-inner">   
        <div class="wpb_wrapper">
            <div data-max_pages="1" data-paged="1" data-sort="featured_first" data-post_in="205, 215, 218, 225, 232" data-category_id="4" data-number_of_posts="5" data-slider_height="735" data-base="mkd_post_slider_interactive" class="mkd-bnl-holder mkd-psi-holder  mkd-psi-number-5" style="opacity: 1;">
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

                    $atts['query_result'] = discussion_custom_featured_query('home', 'featured_article');

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
                        $html .= '<div class="mkd-psi-slider">  </div>';
                    else:
                        discussion_get_module_template_part('templates/parts/no-posts', 'blog');

                    endif;
                    wp_reset_postdata();
                    echo $html;
                    ?>
                </div>
            </div>
        </div>
        <div class="mkd-container">
            <div class="mkd-container-inner clearfix">
                <div class="mkd-two-columns-75-25  mkd-content-has-sidebar clearfix">
                    <div class="mkd-column1 mkd-content-left-from-sidebar">
                        <div class="mkd-column-inner">
                            <?php
                            $category = 'home';
                            $my_query = null;
                            $my_query = discussion_custom_category_query('post', $category);
                            global $wp_query;
                            get_template_part('template-blog-block');
                            ?>                            
                        </div>
                    </div>		
                    <div class="mkd-column2">
                        <div class="mkd-column-inner">
                            <aside class="mkd-sidebar" style="transform: translateY(0px);">
                                <div class="widget widget_apsc_widget">   
<?php get_template_part('sidebar/template-sidebar-home'); ?>
                                </div>    
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include(locate_template('template-ajax-pagination.php'));
?>
<?php get_footer(); ?>


