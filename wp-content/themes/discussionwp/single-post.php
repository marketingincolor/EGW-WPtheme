<?php get_header(); ?>
<div class="mkd-content">
    <div class="mkd-content-inner">
        <div class="mkd-full-width">
            <div class="mkd-full-width-inner">               
                <!-- Feature images should be here... -->
                <div class="vc_empty_space" style="height: 0px"><span class="vc_empty_space_inner"></span></div>
                <div class="mkd-container">
                    
                    <div class="mkd-container-inner clearfix">
                        <?php
                $title_tag = 'h3';
                $title_length = '20';
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
                <?php if (has_post_thumbnail()) { ?>
                    <div class="mkd-post-image-area">
                        <?php discussion_post_info_category(array('category' => 'no')) ?>
                        <?php discussion_get_module_template_part('templates/single/parts/image', 'blog'); ?>

                    </div>
                <?php } ?>
                        <div class="mkd-two-columns-75-25  mkd-content-has-sidebar clearfix">
                            <div class="mkd-column1 mkd-content-left-from-sidebar">
                                <div class="mkd-blog-holder mkd-blog-single">
                                    <div class="mkd-column-inner">
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
                                                            <a href="#"><?php the_category();?></a>
                                                        </div>
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
                                        ?><div class="mkd-ratings-holder">
                                        <?php echo do_shortcode( '[AuthorRecommendedPosts]' ); ?>
                                     
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
                                        <div class="widget widget_apsc_widget">   
                                            <?php get_template_part('template_sidebar_single'); ?>
                                            <?php //get_sidebar();    ?>
                                        </div>    
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>


