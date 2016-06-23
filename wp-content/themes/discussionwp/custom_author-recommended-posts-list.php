<div class="mkd-related-posts-holder <?php echo ( $format_horizontal ) ? ' horizontal' : ' vertical'; ?>">

    <?php if ($html_title && $show_title) { ?>
        <h3><?php echo $html_title; ?></h3>
    <?php } ?> 

    <div class="mkd-related-posts-inner clearfix">
        <?php
        foreach ($recommended_ids as $recommended_id) :
            if (in_array(get_post_type($recommended_id), $author_recommended_posts_post_types)) {
                $recommended_post_thumbnail = false;
                if ($show_featured_image)
                    $recommended_post_thumbnail_id = get_post_thumbnail_id($recommended_id);
                $recommended_post_thumbnail_src = wp_get_attachment_image_src($recommended_post_thumbnail_id, 'medium', true);
                $recommended_post_large_src = wp_get_attachment_image_src($recommended_post_thumbnail_id, 'large', true);
                ?>  
                <?php do_action("{$namespace}_before_related", $recommended_id); ?>
                <div class="mkd-related-post">
                    <div class="mkd-related-post-inner">
                        <div class="mkd-related-top-content">
                            <div class="mkd-related-image">
                                <?php if ($recommended_post_thumbnail_id) { ?>
                                    <a target="_self" href="<?php echo get_permalink($recommended_id); ?>" class="mkd-related-link mkd-image-link" itemprop="url">
                                        <img height="444" width="800" sizes="(max-width: 800px) 100vw, 800px" srcset="<?php echo $recommended_post_thumbnail_src[0]; ?> 300w, <?php echo $recommended_post_large_src[0]; ?> 768w, <?php echo $recommended_post_thumbnail_src[0]; ?> 1024w, <?php echo $recommended_post_thumbnail_src[0]; ?> 1300w" alt="a" class="attachment-discussion_landscape size-discussion_landscape wp-post-image" src="<?php echo $recommended_post_thumbnail_src[0]; ?>">
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="mkd-related-content">
                                <h4 class="mkd-related-title">
                                    <a target="_self" href="<?php echo get_permalink($recommended_id); ?>" class="mkd-related-link" itemprop="url"><?php echo get_the_title($recommended_id); ?></a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div> 
                <?php do_action("{$namespace}_after_related", $recommended_id); ?>
            <?php
            }
        endforeach;
        ?>
    </div>

</div>