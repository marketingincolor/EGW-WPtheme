<div class="mkd-container-inner clearfix">
    <?php
    $title_tag = 'h3';
    $title_length = '20';
    $display_date = 'yes';
    $date_format = 'd. F Y';
    $display_comments = 'yes';
    $display_category = 'no';
    $display_share = 'no';
    $display_count = 'no';
    ?>
    <div class="mkd-post-image-area fsp-pad-btm-30">
        <?php discussion_post_info_category(array('category' => 'no')) ?>
        <?php
        $video_url = get_field('video_url');

        $video_file = get_field('video_file');

        if ($video_url != "") {
            $val = get_videoid_from_url($video_url);
            if (strpos($val, 'youtube') > 0) {
                ?>

                <iframe width="600" height="338" frameborder="0" src="<?php echo $val; ?>" allowfullscreen></iframe>

                <?php
            } else {
                ?>
                <iframe width="600" height="338"  src="<?php echo $val; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

                <?php
            }
        }
        if ($video_file != "") {
            ?>                                                 
            <video width="100%" height="100%" controls >
                <source src="<?php echo $video_file; ?>" type="video/mp4">
            </video>                                                    
        <?php }
        ?>
    </div>
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
                                            discussion_post_info(array(
                                                'comments' => $display_comments,
                                                'count' => $display_count,
                                                'date' => $display_date,
                                                'author' => $display_author,
                                                'like' => $display_like,
                                                'category' => $display_category
                                            ));
                                            ?>
                                        </div>
                                    <?php } ?>

                                    <?php discussion_get_module_template_part('templates/single/parts/title', 'blog'); ?>
                                    <br>
                                    <div class="mkd-post-infoi" style="border-right">
                                        <?php
                                        discussion_post_info(array(
                                            'date' => $display_date,
                                        ))
                                        ?>
                                    </div>       
                                    <a href="#">Social</a>
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                        <?php do_action('discussion_before_blog_article_closed_tag'); ?>
                    </article>
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
                <div class="fsp-recommended-stories-cont">
                    <?php echo do_shortcode('[AuthorRecommendedPosts]'); ?> 
                    <?php comments_template('', true); ?>
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