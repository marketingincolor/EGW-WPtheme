<?php
/**
 * Author - Muthupandi
 * Date - 20-07-2016
 * Purpose - List out saved articles while click 'load more' button
 */
?>

                                   
    <?php
    global $post;
    $require_post = $post;
    $user_data = get_user_meta(get_current_user_id(), 'wpfp_favorites');
    $post_id_ar = array();

    if (isset($user_data) && !empty($user_data[0])):
        $post_id_ar = array_reverse($user_data[0]);
        $args = array(
            'orderby' => 'post__in',                                            
            'post__in' => $post_id_ar,
            'posts_per_page' => 3,
            'offset' => $_POST['offset'],
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),
            'post_type' => array('post','videos'),
        );
        $saved_posts = query_posts($args);
        ?>                                      
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php if (($sidebar == 'default') || ($sidebar == '')) : ?>
                        <li>
                            <div class="saved_art_img">
                                <?php the_post_thumbnail([117, 117]) ?>
                            </div>
                            <div class="saved_art_cont">
                                <h4><?php the_title(); ?></h4>
                                <p><?php custom_discussion_excerpt(15); ?></p>
                            </div>
                            <div class="saved_art_cont_btns">
                                <a class="fsp_remove_btn" href="?wpfpaction=remove&postid=<?php the_ID(); ?>" title="Remove" rel="">Remove</a>
                                <a class="fsp_readart_btn" href="<?php the_permalink(); ?>" title="Read Article" rel="">Read Article</a>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endwhile; ?>     
                <?php
            endif;
            $post = $require_post;
    endif;
            ?>                      
