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
        'post_type' => array('post', 'videos'),
    );
    $saved_posts = query_posts($args);
    ?>                                      
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php if (($sidebar == 'default') || ($sidebar == '')) : ?>  
                <div class="sv-art-inside-container">
                                            <input type="checkbox" name="saved-posts[]" value="<?php the_ID(); ?>" class="save-article-checkbox" id="<?php the_ID(); ?>" style="display:none" />
                                                <div class="saved-articles-sidelist-nw">
                                                <div class="sidelist-nw-innercontainer clearfix">
                                                    <div class="sidelist-nw-imgblk">
                                                        <?php if (has_post_thumbnail()) : ?>
                                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                                <?php the_post_thumbnail([70, 70]) ?>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="sidelist-nw-contblk">
                                                        <h6 class="mkd-pt-seven-title">
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>                                            
                                                        </h6>   
                                                    </div>
                                                </div>
                                                <div class="saved_art_cont_btns sidelist-nw_cont_btns">                                             
                                                    <a class="fsp_remove_btn" href="?wpfpaction=remove&postid=<?php the_ID(); ?>" title="Remove" rel="">Remove</a>
                                                    <a class="fsp_readart_btn" href="<?php the_permalink(); ?>" title="Read Article" rel="">Read</a>
                                                </div> 
                                            </div>
                                        </div>
            <?php endif; ?>
        <?php endwhile; ?> 
    <?php
    endif;
    $post = $require_post;
endif;
?>                      
