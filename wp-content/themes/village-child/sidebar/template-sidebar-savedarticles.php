<div class="mkd-section-title-holder clearfix"><span class="mkd-st-title">Saved Articles</span></div>
<div id="mkd-widget-tab-4" class="mkd-ptw-holder mkd-tabs" aria-labelledby="ui-id-5" role="tabpanel" aria-hidden="false">
    <div class="mkd-plw-tabs-content">
        <div data-max_pages="4" data-paged="1" data-display_excerpt="no" data-display_date="yes" data-title_length="30" data-title_tag="h6" data-display_image="yes" data-custom_thumb_image_height="84" data-custom_thumb_image_width="117" data-category_id="4" data-number_of_posts="5" data-base="mkd_post_layout_seven">
            <div class="mkd-bnl-outer">
                <div class="mkd-bnl-inner">
                    <?php
                    global $post;
                    $require_post = $post;
                    $user_data = get_user_meta(get_current_user_id(), 'wpfp_favorites');
                    $post_id_ar = array();


                    if (isset($user_data) && !empty($user_data[0])):                                        
                        $post_id_ar = array_reverse($user_data[0]); 
                        $total_count=count($post_id_ar);
                        $args = array(  
                            'orderby' => 'post__in',
                            'post__in' => $post_id_ar,
                            'posts_per_page' => 3,
                            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),
                            'post_type' => array('post','videos'),
                        );
                        $saved_posts = query_posts($args);   
                        ?>
                    <div class="mkd-pt-seven-item mkd-post-item mkd-active-post-page">
                        <div class="mkd-pt-seven-item-inner clearfix">
                            <div class="mkd-pt-seven-content-holder">
                                <a id="enable_story_playlist" href="#">Send stories to friends</a>
                                <div id="story-send" style="display:none">
                                    <div style="float:left;width:190px">
                                        Select Stories you would <br/>
                                        like to send to your friends
                                    </div>
                                    <a class="fsp_readart_btn send-button" href="<?php the_permalink(); ?>" title="Read Article" rel="">Send</a>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <?php if (($sidebar == 'default') || ($sidebar == '')) : ?>                        
                        <div class="mkd-pt-seven-item mkd-post-item mkd-active-post-page saved-articles-list">
                            <div class="mkd-pt-seven-item-inner clearfix">
                                <div class="mkd-pt-seven-image-holder" style="width: 117px">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail([117,117]) ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="mkd-pt-seven-content-holder">
                                    <div class="mkd-pt-seven-title-holder">
                                        <h6 class="mkd-pt-seven-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>                                            
                                        </h6>                                        
                                        <div class="saved_art_cont_btns" style="float:left">                                             
                                            <a class="fsp_remove_btn" href="?wpfpaction=remove&postid=<?php the_ID(); ?>" title="Remove" rel="">Remove</a>
                                            <a class="fsp_readart_btn" href="<?php the_permalink(); ?>" title="Read Article" rel="">Read Article</a>
                                        </div>    
                                        <input type="checkbox" class="save-article-checkbox" id="<?php the_ID(); ?>" style="display:none" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                     <?php endwhile; ?> 
                    <?php endif;
                    $post = $require_post;
                    ?>                    
                    <div id="displayed_article_count" style="display:none">3</div>
                    <div id="total_saved_article_count" style="display:none"><?php echo $total_count; ?></div>
                    
                    
                    <?php if($total_count>3): ?>
                        <div class="mkd-pt-seven-item mkd-post-item mkd-active-post-page load-save-article-button-section">
                            <div class="mkd-pt-seven-item-inner clearfix">
                                <div class="mkd-pt-seven-content-holder">

                                <div class="fsporange_btn" id="load-save-article-button">
                                    <input onclick="load_saved_articles(event)" type="submit" value="Load More" name="Load More">
                                </div>      

                                <div class="fsp-ads-homepage loader_img" style="display: none;">
                                   <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/loading.svg'; ?>" width="75">
                                </div>  
                                </div>
                            </div>
                        </div>                                      
                    <?php endif; ?>                                                                            
                    <?php else: ?>
                        <span>No articles found</span> 
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(locate_template('block/ajax-pagination.php'));  ?> 
<style>
    .fsp_readart_btn.send-button {
    color: #fff;
    display: block;
    float: left;
    margin-top: 5px;
    text-align: center;
    width: 50px;
}
</style>