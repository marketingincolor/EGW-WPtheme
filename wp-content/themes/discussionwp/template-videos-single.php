<div class="mkd-content">
    <div class="mkd-content-inner">
        <div class="mkd-container">
            <div class="mkd-container-inner">
                <div class="mkd-two-columns-75-25  mkd-content-has-sidebar clearfix">
                    <div class="mkd-column1 mkd-content-left-from-sidebar">
                        <div class="mkd-blog-holder mkd-blog-single">              
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="mkd-post-content">
                                    	<?php if (has_post_thumbnail()) { ?>
                                        <div class="mkd-post-image-area">
                                            <?php discussion_post_info_category(array('category' => $display_category)) ?>
                                            <?php discussion_get_module_template_part('templates/single/parts/image', 'blog'); ?>
                                            <div class="mkd-post-info">
                                                <?php
                                                discussion_post_info(array(
                                                    'comments' => $display_comments,
                                                    'count' => $display_count,
                                                    'date' => $display_date,
                                                    'author' => $display_author,
                                                    'like' => $display_like,
                                                ))
                                                ?>
                                            </div>
                                        </div>
                                       <?php } ?>
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
                                            <?php discussion_get_module_template_part('templates/single/parts/title', 'blog'); ?>
                                            <?php the_content(); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php do_action('discussion_before_blog_article_closed_tag'); ?>
                            </article>
                        </div>
                        <div class="mkd-column-inner">
                            <div class="mkd-blog-holder mkd-blog-single">
                                <?php discussion_get_module_template_part('templates/single/parts/single-navigation', 'blog'); ?>	
                                <?php discussion_get_module_template_part('templates/single/parts/author-info', 'blog'); ?> 
                                <?php discussion_get_module_template_part('templates/single/parts/related-posts', 'blog'); ?>   
                                <?php get_template_part('comments'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mkd-column2">
                        <div class="mkd-column-inner">
                            <aside class="mkd-sidebar" style="transform: translateY(0px);">
                                <?php // get_template_part('template-videos-sidebar'); ?>
                                <?php get_sidebar(); ?>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>