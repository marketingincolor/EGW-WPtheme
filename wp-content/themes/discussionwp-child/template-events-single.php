<?php get_header(); ?>

    <div class="mkd-container-inner"> 
        <?php
        $title_tag = 'h3';
        $title_length = '20';
        $display_date = 'yes';
        $date_format = 'd. F Y';
        $display_category = 'yes';
        $display_category_singlepost = 'yes';
        $save_stories = 'yes';
        $display_comments = 'yes';
        $display_share = 'yes';
        $display_count = 'yes';
        $display_excerpt = 'yes';
        $thumb_image_width = '';
        $thumb_image_height = '';
        $thumb_image_size = '150';
        $excerpt_length = '12';
        ?>
        <?php if (has_post_thumbnail()) { ?>
            <div class="mkd-blog-holder mkd-blog-single">
                <?php ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="mkd-post-content">
                        <?php if (has_post_thumbnail()) { ?>
                            <div class="mkd-post-image-area">
                                <?php discussion_post_info_category(array('category' => 'no')) ?>
                                <?php discussion_get_module_template_part('templates/single/parts/image', 'blog'); ?>
                               <div class="mkd-post-info">
                                    <?php
                                    discussion_post_info(array(
                                        'date' => $display_date,
                                        'category_singlepost' => $display_category_singlepost,
                                        'save_stories' => $save_stories,
                                    ))
                                    ?>
                                </div>

                            </div>
                        <?php } ?>
                    </div>
                    <?php do_action('discussion_before_blog_article_closed_tag'); ?>
                </article>
            </div>
        <?php } ?>
        <div class="mkd-two-columns-75-25  mkd-content-has-sidebar clearfix">
            <div class="mkd-column1 mkd-content-left-from-sidebar">
                <div class="mkd-column-inner">
                    <div class="mkd-blog-holder mkd-blog-single">
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="mkd-post-content">
                                <div class="mkd-post-text">
                                    <div class="mkd-post-text-inner clearfix">
                                        <?php if (!has_post_thumbnail()) { ?>
                                            <div class="mkd-post-info">
                                                <?php
//                                                discussion_post_info(array(
//                                                    'comments' => $display_comments,
//                                                    'count' => $display_count,
//                                                    'date' => $display_date,
//                                                    'author' => $display_author,
//                                                    'like' => $display_like,
//                                                    'category' => $display_category
//                                                ));
                                                ?>
                                            </div>
                                        <?php } ?>
                                        <?php discussion_get_module_template_part('templates/single/parts/title', 'blog'); ?>
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <?php
                        //$post_format = get_post_format();

                        if ($post_format === false) {
                            $post_format = 'standard';
                        }

                        $params = array();

                        $display_category = 'yes';
                        if (discussion_options()->getOptionValue('blog_single_category') !== '') {
                            $display_category = discussion_options()->getOptionValue('blog_single_category');
                        }

                        $display_date = 'yes';
                        if (discussion_options()->getOptionValue('blog_single_date') !== '') {
                            $display_date = discussion_options()->getOptionValue('blog_single_date');
                        }

                        $display_author = 'no';
                        if (discussion_options()->getOptionValue('blog_single_author') !== '') {
                            $display_author = discussion_options()->getOptionValue('blog_single_author');
                        }

                        $display_comments = 'yes';
                        if (discussion_options()->getOptionValue('blog_single_comment') !== '') {
                            $display_comments = discussion_options()->getOptionValue('blog_single_comment');
                        }

                        $display_like = 'no';
                        if (discussion_options()->getOptionValue('blog_single_like') !== '') {
                            $display_like = discussion_options()->getOptionValue('blog_single_like');
                        }

                        $display_count = 'no';
                        if (discussion_options()->getOptionValue('blog_single_count') !== '') {
                            $display_count = discussion_options()->getOptionValue('blog_single_count');
                        }

                        $params['display_category'] = $display_category;
                        $params['display_date'] = $display_date;
                        $params['display_author'] = $display_author;
                        $params['display_comments'] = $display_comments;
                        $params['display_like'] = $display_like;
                        $params['display_count'] = $display_count;

                        discussion_get_module_template_part('templates/single/post-formats/' . $post_format, 'blog', '', $params);

                        discussion_get_module_template_part('templates/single/parts/tags', 'blog');
                        //discussion_get_module_template_part('templates/single/parts/single-navigation', 'blog');
                        // discussion_get_module_template_part('templates/single/parts/author-info', 'blog');
                        //discussion_get_single_related_posts();
                        ?>
                        <div class="fsp-recommended-stories-cont">
                            <?php echo do_shortcode('[AuthorRecommendedPosts]'); ?>
                        </div>
                        <?php
                        if (discussion_show_comments()) {
                            comments_template('', true);
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="mkd-column2">
                <div class="mkd-column-inner">
                    <aside class="mkd-sidebar" style="transform: translateY(0px);">
                            <?php get_template_part('sidebar/template-sidebar-single'); ?>
                    </aside>
                </div>
            </div>
        </div>
    </div>


<?php get_footer(); ?>