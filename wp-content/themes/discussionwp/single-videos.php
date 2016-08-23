<?php get_header(); ?>
<div class="mkd-container-inner">
     <?php
    $title_tag = 'h3';
    $title_length = '20';
    $display_date = 'yes';
    $date_format = 'd. F Y';
    $display_category = 'no';
    $display_share = 'no';
    $display_count = 'yes';
    $display_comments = 'yes';
    ?>

    <div class="mkd-blog-holder mkd-blog-single mkd-fsp-blog-holder">
        <?php ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="mkd-post-content">
                  <?php get_template_part('block/template-single-video-block'); ?>
            </div>
            <?php do_action('discussion_before_blog_article_closed_tag'); ?>
        </article>
         <div class="single-article-video-fsp-info">
                <article>
                    <div class="mkd-post-info">
                            <?php
                            discussion_post_info(array(
                                'date' => $display_date,
                                'count' => $display_count,
                                'comments' => $display_comments,
                            ))
                            ?>
<!--                         <div class="mkd-post-fsp-savestories">
                        <?php
                           //customized_saved_stories();
                        ?>
                        </div>-->
                        </div>
                </article>
            </div>
    </div>
    <div class="mkd-two-columns-75-25  mkd-content-has-sidebar clearfix">
        <div class="mkd-column1 mkd-content-left-from-sidebar">
            <div class="mkd-column-inner">
                <div class="mkd-blog-holder mkd-blog-single">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="mkd-post-content">
                            <div class="mkd-post-text">
                                <div class="mkd-post-text-inner clearfix">
                                    <?php discussion_get_module_template_part('templates/single/parts/title', 'blog'); ?>
                                    <div class="mdk-sng-pst">
                                    <?php the_content(); ?>
                                    <?php do_action('last_updated'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php do_action('discussion_before_blog_article_closed_tag'); ?>
                    </article>
                    <?php include(locate_template('block/get-post-author.php')); ?>
                    <div class="disclamier">
                        <p><span>Disclaimer:</span> This content is for entertainment purposes only and it is not meant to be relied on as medical advice, diagnosis, or treatment. Consult your physician before starting any exercise or dietary program or taking any other action respecting your health. In case of a medical emergency, call 911.</p>
                    </div>
                </div>
                <?php
                if ($post_format === false) {
                    $post_format = 'standard';
                }

                $params = array();

                $display_category = 'no';
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
                ?>
                <?php get_template_part('sidebar/template-ads-mobile'); ?>
                <div class="fsp-recommended-stories-cont">
                    <?php echo do_shortcode('[AuthorRecommendedPosts]'); ?>
                </div>
                <?php
//                   get_template_part('block/comments-guidelines');
//                   comments_template('', true);
                ?>
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
