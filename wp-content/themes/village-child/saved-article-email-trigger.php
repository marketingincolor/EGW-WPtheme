<div class="saved-articles-popup-nw">
    <div id="enquiry-form" class="popup-inline-content">
        <h2>Share a list of your saved article stories with your friends:</h2>
        <div class="sv-art-popup-nw-cont">
            <form id="enquiryForm" name="selectedArticleform" action="" method="POST">
                <div class="row">
                    <div class="form-group">
                        <div class="vc_col-lg-12 saved_art_form-box">
                            <?php $selectedArticles = $_POST['offset']; ?>
                            <input type="text" value="" maxlength="100" class="form-control" name="emailaddress" id="email_address" placeholder="Email">
                            <div id="errorBox-email"></div>
                            <textarea  name="comments" placeholder="Type Message here..."  rows="4" cols="50"></textarea>
                            <div id="errorBox-comments"></div>
                        </div>
                        <div class="vc_col-lg-12">
                            <!-- saved articles starts here -->
                            <div class="fsp-saved-articles-pop">
                                <div class="saved-articles-cont-pop">                                    
                                    <?php
                                    //print_r($selectedArticles);
                                    parse_str($selectedArticles, $original_array); // Converting serialize value to array

                                    if (isset($selectedArticles) && !empty($selectedArticles)):
                                        global $post;
                                        $args = array(
                                            'orderby' => 'post__in',
                                            'post__in' => $original_array['saved-posts'],
                                            'posts_per_page' => 100,
                                            'paged' => 1,
                                            'post_type' => array('post', 'videos')
                                        );
                                        $saved_posts = query_posts($args);
                                        $loopCount = 0;
                                        ?>
                                        <input type="hidden" name="articlefetched" value="<?php echo $selectedArticles ?>">
                                        <ul id="saved-artiles-list">                        
                                            <?php
                                            if (have_posts()) : while (have_posts()) : the_post();
                                                    $loopCount++;
                                                    ?>
                                                    <li id="element_<?php echo $loopCount; ?>">
                                                        <div class="art-cont-dis">
                                                            <div class="saved_art_img"><?php the_post_thumbnail([117, 117]) ?></div>
                                                            <div class="saved_art_cont-pop">
                                                                <h4 id="<?php the_ID(); ?>"><?php the_title(); ?></h4>
                                                                <p><?php custom_discussion_excerpt(15); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="saved_art_cont_btns-close">
                                                            <div class="ion-android-close" id="<?php echo $loopCount; ?>" data-pack="android" data-tags="delete, remove" style="display: inline-block;"></div>
                                                        </div>
                                                        <input type="hidden" name="fetchedarticles[]" value="<?php the_ID(); ?>">
                                                    </li>

                                                <?php endwhile; ?>     
                                                <?php
                                            endif;
                                            ?>
                                        </ul>
                                    <?php else: ?>
                                        <span>No articles found</span> 
                                    <?php endif; ?>  
                                </div>
                            </div>
                            <div class="saved_art_action_btns-pop">
                                <input class="fsp_send_btn_pop" id="emailsend" type="button" value="Send" name="Send">
                                <input class="fsp_cancel_btn_pop" type="reset" value="Cancel" name="Cancel">
                               
<!--                                        <a class="fsp_send_btn_pop" href="<?php //the_permalink();                                           ?>" title="Send" rel="">Send</a>-->

                            </div>
                            <!-- saved articles ends here -->
                        </div>
                    </div>
                </div>
            </form>
            <div id="successmsg"> 
                <h3> </h3>
            </div>
        </div>
    </div>
</div>



