<?php
/*
  Template Name: User Profile
 * Author: Ramkumar.S
 * Date: June 23,2016
 * Updated by : Muthupandi
 */

$wpdb->hide_errors();
nocache_headers();

if (!empty($_POST['action'])) {

    require_once(ABSPATH . 'wp-admin/includes/user.php');
    require_once(ABSPATH . WPINC . '/registration.php');

    check_admin_referer('update-profile_' . $user_ID);

    $errors = edit_user($user_ID);

    /*     * ********* Upload User profile Image:start **************** */

    if (!empty($_FILES['userProfileImage']['name'])) {

        require_once(ABSPATH . '/wp-load.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');

        $filename = $_FILES['userProfileImage']['name'];
        $uploaddir = wp_upload_dir(); // get wordpress upload directory

        $MyImage = rand(0, 5000) . $_FILES['userProfileImage']['name'];
        $image_path = $uploaddir['path'] . '/' . $MyImage;
        move_uploaded_file($_FILES['userProfileImage']['tmp_name'], $image_path);

        $uploadfile = $uploaddir['path'] . '/' . basename($MyImage);
        $filename = basename($uploadfile);
        $wp_filetype = wp_check_filetype(basename($filename), null);

        $attachment = array(
            'guid' => $uploaddir['url'] . '/' . basename($uploadfile),
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => preg_replace('/\.[^.]+$/', "", $_FILES['userProfileImage']['name']),
            'post_content' => "",
            'post_status' => 'inherit'
        );

        $attachment_id = wp_insert_attachment($attachment, $uploadfile);
        $attach_data = wp_generate_attachment_metadata($attachment_id, $uploadfile);
        wp_update_attachment_metadata($attachment_id, $attach_data);
        //update_field( 'custom_avatar', $attachment_id, "user_".$user_ID);
        update_user_meta($user_ID, 'custom_avatar', $attachment_id);
    }

    /*     * *********** Upload User profile Image:end ******************** */

    if (is_wp_error($errors)) {
        foreach ($errors->get_error_messages() as $message)
            $errmsg = "$message";
    }

    if ($errmsg == '') {
        do_action('personal_options_update', $user_ID);
        $d_url = $_POST['dashboard_url'];
        wp_redirect(get_option("siteurl") . '?page_id=' . $post->ID . '&updated=true');
    } else {
        $errmsg = '<div class="box-red">' . $errmsg . '</div>';
        $errcolor = 'style="background-color:#FFEBE8;border:1px solid #CC0000;"';
    }
}

get_header();
?>
<script type = "text/javascript">
    jQuery(function () {
        jQuery(".ion-android-close").unbind().click(function () {
            var dataString = jQuery('#requiredvalues :input').serialize() + '&categoryid=' + this.id;
            jQuery.ajax({
                type: "POST",
                url: "<?php echo get_stylesheet_directory_uri();?>/unfollowajax.php",
                data: dataString,
                cache: false,
                success: function (successvalue) {
                    jQuery('.followed_ctg_content').html(successvalue);
                    jQuery('#unfollowedmsg').html("<div class='fspfollow-msg'><i aria-hidden='true' class='fa fa-check'></i> Unfollowed successfully</div>").fadeOut(3000);
                }
            });
            return false;
        });
    });
</script>
<div class="mkd-full-width">
    <div class="mkd-full-width-inner"> 
        <div class="mkd-grid-section">
            <div class="clearfix mkd-section-inner">
                <!-- page container starts here -->
                <div class="clearfix fsp-page-container">
                    <div class="mkd-section-inner-margin clearfix">
                        <!-- Info container starts here -->
                        <div class="vc_col-1g-6 vc_col-md-6 vc_col-sm-12 user-profile-resize">
                            <div class="user-profile-container"> 
                                <form name="profile" action="" method="post" enctype="multipart/form-data" id="user-profile-form">
                                    <!-- info left starts here -->
                                    <div class=" vc_column_container vc_col-md-5">
                                        <div class="user-profile-lft">
                                            <div class="aavthar">
                                                <?php
                                                $custom_avatar_meta_data = get_user_meta($user_ID, 'custom_avatar');
                                                if (isset($custom_avatar_meta_data) && !empty($custom_avatar_meta_data[0])):
                                                    $attachment = wp_get_attachment_image_src($custom_avatar_meta_data[0], 'medium');
                                                    ?>
                                                    <img id="image_upload_preview" src="<?php echo $attachment[0]; ?>" width="248" height="248"/>
                                                <?php else : ?>                                                    
                                                    <img id="image_upload_preview" src="<?php echo get_stylesheet_directory_uri();?>/assets/img/aavathar.jpg" width="248" height="248"/>
                                                <?php endif; ?>
                                                <div class="fspgray_btn">
                                                    <input type="file" id="userProfileImage" name="userProfileImage" style="display:none">                                                
                                                    <input type="button" value="Upload Image" name="upload" id="upload"><br/>  
                                                    <span id="user-profile-avatar"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- info left ends here -->

                                    <!-- info right starts here -->
                                    <div class="vc_column_container vc_col-md-7">
                                        <div class="user-profile-rgtinfo">
                                            <h2>Info</h2>
                                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                                                    <?php
                                                    the_title();
                                                    the_content();
                                                    ?>
                                                <?php endwhile; ?>
                                            <?php endif; ?>                                        
                                            <?php
                                            wp_nonce_field('update-profile_' . $user_ID);
                                            //echo $user_ID;
                                            ?>
                                            <input type="hidden" name="from" value="profile" />
                                            <input type="hidden" name="action" value="update" />
                                            <input type="hidden" name="checkuser_id" value="<?php echo $user_ID ?>" />
                                            <input type="hidden" name="dashboard_url" value="<?php echo get_option("dashboard_url"); ?>" />
                                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>" />
                                            <ul>
                                                <?php
                                                if (isset($_GET['updated'])):
                                                    $d_url = $_GET['d'];
                                                    ?>
                                                    <li>
                                                        <div align="center" colspan="2"><span style="color: #FF0000; font-size: 11px;">Your profile changed successfully</span></div>
                                                    </li>
                                                <?php elseif ($errmsg != ""): ?>
                                                    <li>
                                                        <div align="center" colspan="2"><span style="color: #FF0000; font-size: 11px;"><?php echo $errmsg; ?></span></div>
                                                    </li>
                                                <?php endif; ?>
                                                <li><input type="text" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $userdata->first_name ?>"/></li>
                                                <li><input type="text" name="last_name" class="mid2" id="last_name" placeholder="Last Name" value="<?php echo $userdata->last_name ?>" /></li>
                                                <li style="padding:0px;"><input type="hidden" name="nickname" class="mid2" id="nickname" value="<?php echo $userdata->nickname ?>"  /></li>
                                                <li><input type="text" name="email" class="mid2" id="email" placeholder="Email" value="<?php echo $userdata->user_email ?>" readonly /></li>
                                                <li><input type="password" name="pass1" placeholder="New Password" class="mid2" id="pass1" value="" /></li>
                                                <li><input type="password" name="pass2" placeholder="New Password Confirm" class="mid2" id="pass2" value="" /></li>
                                                <li><input type="text" name="city" id="city" placeholder="City" value="<?php echo esc_attr(get_the_author_meta('city', $userdata->ID)); ?>"  /></li>
                                                <li><input type="text" name="state" id="state" placeholder="State" value="<?php echo esc_attr(get_the_author_meta('state', $userdata->ID)); ?>"  /></li>
                                                <li><input type="text" name="postalcode" id="postalcode" placeholder="Postal Code"  value="<?php echo esc_attr(get_the_author_meta('postalcode', $userdata->ID)); ?>" /></li>
                                                <li><input type="text" name="address" id="address" placeholder="Address"  value="<?php echo esc_attr(get_the_author_meta('address', $userdata->ID)); ?>" /></li>                                                
                                                <!--<li>
                                                     <div>Facebook URL</div>
                                                     <div><input type="text" name="facebook" id="facebook" value="<?php echo esc_attr(get_the_author_meta('facebook', $userdata->ID)); ?>" style="width: 300px;" /></div>
                                                 </li>
                                                 <li>
                                                     <div>Twitter</div>
                                                     <div><input type="text" name="twitter" id="twitter" value="<?php echo esc_attr(get_the_author_meta('twitter', $userdata->ID)); ?>" style="width: 300px;" /></div>
                                                 </li>
                                                 <li>
                                                     <div>Date Of Birth</div>
                                                     <div><input type="text" name="dob" id="dob" value="<?php echo esc_attr(get_the_author_meta('dob', $userdata->ID)); ?>" style="width: 300px;" /></div>
                                                 </li>
                                                 <li>
                                                     <div>Phone</div>
                                                     <div><input type="text" name="phone" id="phone" value="<?php echo esc_attr(get_the_author_meta('phone', $userdata->ID)); ?>" style="width: 300px;" /></div>
                                                 </li>-->
                                                <input type="hidden" name="update-profile-nonce" value="<?php echo wp_create_nonce('update-profile-nonce'); ?>"/>
                                            </ul>
                                            <div class="fsporange_btn">
                                                <input type="submit" value="Update" name="update">
                                            </div>                                        

                                        </div>
                                    </div>
                                    <!-- info right ends here -->
                                </form>
                            </div>	
                        </div>
                        <!-- Info container ends here -->


                        <!-- saved articles starts here -->
                        <div class="wpb_column vc_col-lg-6 vc_col-md-6 vc_col-sm-12 user-profile-resize">
                            <div class="fsp-saved-articles">
                                <h2>Saved Articles</h2>
                                <div class="saved-articles-container">                                    
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
                                        <ul id="saved-artiles-list">                        
                                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                                    <?php if (($sidebar == 'default') || ($sidebar == '')) : ?>
                                                        <li>
                                                            <div class="saved_art_img">
                                                                <?php the_post_thumbnail([117, 117]) ?>
                                                            </div>
                                                            <div class="saved_art_cont">
                                                                <h4 id="<?php the_ID(); ?>"><?php the_title(); ?></h4>
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
                                            ?>
                                        </ul> 
                                        <div id="displayed_article_count" style="display:none">3</div>
                                        <div id="total_saved_article_count" style="display:none"><?php echo $total_count; ?></div>
                                        <?php if($total_count>3): ?>
                                            <div class="fsporange_btn" id="load-save-article-button">
                                                <input onclick="load_saved_articles(event)" type="submit" value="Load More" name="Load More">
                                            </div>                                          
                                        <?php endif; ?>
                                        <div class="fsp-ads-homepage loader_img" style="display: none;">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/loading.svg'; ?>" width="75">
                                        </div>
                                    <?php else: ?>
                                        <span>No articles found</span> 
                                    <?php endif; ?>  
                                          
                                </div>
                            </div>
                        </div>
                        <!-- saved articles ends here -->
                    </div>
                </div>

                <div class="clearfix fsp-page-container">
                    <div class="fsp-followed-categories">
                        <h2>Followed Subcategories</h2>
                        
                        <div class="followed_ctg_content">
                            <?php
                            $userid = get_current_user_id();
                            $fetchresult = $wpdb->get_results("SELECT *from wp_follow_category where userid=" . $userid . " and flag=1 ORDER BY date DESC");
                            $rowresult = $wpdb->num_rows;
                            ?>
                            <div id="unfollowedmsg"></div>
                            <div id="requiredvalues">
                                <!-- TO update the div after unfollowed any category from profile. "unfollowedCat" is just page reference -->
                                <input type="hidden" name="updateflag" id="flagvalue" value="0">                                
                                <input type="hidden" name="ajaxupdate" id="flagvalue" value="unfollowedCat">
                                <input type="hidden" name="submit" id="submitvalue" value="update">
                                <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                            </div>
                            <ul>
                                <?php
                                foreach ($fetchresult as $results) {
                                    ?>
                                    <li class="vc_col-md-3 vc_col-sm-6 vc_col-xs-6">

                                        <div class="ctg_list">
                                            <?php
                                            $attr = array(
                                                'class' => '',
                                                'alt' => get_the_category_by_ID($results->categoryid),
                                                'height' => 198,
                                                'width' => 302,
                                                'title' => get_the_category_by_ID($results->categoryid),
                                            );
                                            z_taxonomy_image($results->categoryid, 'full', $attr);
                                            ?>

                                            <h4><?php echo get_the_category_by_ID($results->categoryid); ?> <span class="ion-android-close" id="<?php echo $results->categoryid; ?>"></span></h4>
                                        </div>
                                    </li>
                                <?php } ?>
                                <?php if ($rowresult == 0) { ?>

                                    <li class="vc_col-md-8">
                                        No Record found.
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- page container ends here -->
            </div>
        </div>
    </div>
</div>
<script type = "text/javascript">
    jQuery(document).ready(function () {
        formmodified = 0;
        jQuery('#user-profile-form :input').keyup(function () {
            formmodified = 1;
        });
        jQuery('#upload').click(function () {
            formmodified = 1;
        });
        window.onbeforeunload = confirmExit;
        function confirmExit() {
            if (formmodified == 1) {
                return "New information not saved. Do you wish to leave the page?";
            }
        }
        jQuery("input[name='update']").click(function () {
            formmodified = 0;
        });
    });
    
</script>
<?php include(locate_template('block/ajax-pagination.php'));  ?> 
<?php get_footer(); ?>