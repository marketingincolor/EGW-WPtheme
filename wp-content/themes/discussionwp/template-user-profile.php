<?php
/*
  Template Name: User Profile
 */

$wpdb->hide_errors();
nocache_headers();


if (!empty($_POST['action'])) {

    require_once(ABSPATH . 'wp-admin/includes/user.php');
    require_once(ABSPATH . WPINC . '/registration.php');

    check_admin_referer('update-profile_' . $user_ID);

    $errors = edit_user($user_ID);

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

<div class="mkd-full-width">
    <div class="mkd-full-width-inner"> 
        <div class="mkd-grid-section">
            <div class="clearfix mkd-section-inner">
                <!-- page container starts here -->
                <div class="clearfix fsp-page-container">
                    <div class="mkd-section-inner-margin clearfix">
                        <!-- Info container starts here -->
                        <div class="vc_col-md-6 vc_col-sm-12">
                            <div class="user-profile-container"> 
                                <!-- info left starts here -->
                                <div class=" vc_column_container vc_col-md-5">
                                    <div class="user-profile-lft">
                                        <div class="aavthar">
                                            <img src="wp-content/themes/discussionwp/assets/img/aavathar.jpg" width="248" height="248"/>
                                            <div class="fspgray_btn">
                                                <input type="submit" value="Upload Image" name="upload">
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
                                        <form name="profile" action="" method="post" enctype="multipart/form-data">
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
                                                <li><input type="text" name="email" class="mid2" id="email" placeholder="Email" value="<?php echo $userdata->user_email ?>" /></li>
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
                                        </form>

                                    </div>
                                </div>
                                <!-- info right ends here -->
                            </div>	
                        </div>
                        <!-- Info container ends here -->


                        <!-- saved articles starts here -->
                        <div class="wpb_column vc_col-md-6 vc_col-sm-12">
                            <div class="fsp-saved-articles">
                                <h2>Saved Articles</h2>
                                <div class="saved-articles-container">
                                    <ul>
                                        <li>
                                            <div class="saved_art_img">
                                                <img src="wp-content/wp-content/uploads/2016/03/saved-articles-117x117.jpg" width="117" height="117"/>
                                            </div>
                                            <div class="saved_art_cont">
                                                <h4>How to Lose Weight When...</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipis elit. Morbi nec lacus in nisl tristique vulputate..</p>
                                            </div>
                                            <div class="saved_art_cont_btns">
                                                <a class="fsp_remove_btn" href="#" title="Remove" rel="">Remove</a>
                                                <a class="fsp_readart_btn" href="#" title="Read Article" rel="">Read Article</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="saved_art_img">
                                                <img src="wp-content/wp-content/uploads/2016/03/saved-articles-117x117.jpg" width="117" height="117"/>
                                            </div>
                                            <div class="saved_art_cont">
                                                <h4>How to Lose Weight When...</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipis elit. Morbi nec lacus in nisl tristique vulputate..</p>
                                            </div>
                                            <div class="saved_art_cont_btns">
                                                <a class="fsp_remove_btn" href="#" title="Remove" rel="">Remove</a>
                                                <a class="fsp_readart_btn" href="#" title="Read Article" rel="">Read Article</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="saved_art_img">
                                                <img src="wp-content/wp-content/uploads/2016/03/saved-articles-117x117.jpg" width="117" height="117"/>
                                            </div>
                                            <div class="saved_art_cont">
                                                <h4>How to Lose Weight When...</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipis elit. Morbi nec lacus in nisl tristique vulputate..</p>
                                            </div>
                                            <div class="saved_art_cont_btns">
                                                <a class="fsp_remove_btn" href="#" title="Remove" rel="">Remove</a>
                                                <a class="fsp_readart_btn" href="#" title="Read Article" rel="">Read Article</a>
                                            </div>
                                        </li>

                                    </ul>
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
                            <ul>
                                <li class="vc_col-md-3 vc_col-sm-6 vc_col-xs-6">
                                    <div class="ctg_list">
                                        <img src="wp-content/wp-content/uploads/2016/03/Member-01.jpg" />
                                        <h4>Activity <span class="ion-android-close"></span></h4>
                                    </div>
                                </li>
                                <li class="vc_col-md-3 vc_col-sm-6 vc_col-xs-6">
                                    <div class="ctg_list">
                                        <img src="wp-content/wp-content/uploads/2016/03/Member-01.jpg" />
                                        <h4>Mind - Spirit<span class="ion-android-close"></span></h4>
                                    </div>
                                </li>
                                <li class="vc_col-md-3 vc_col-sm-6 vc_col-xs-6">
                                    <div class="ctg_list">
                                        <img src="wp-content/wp-content/uploads/2016/03/Member-01.jpg" />
                                        <h4>Nutrition<span class="ion-android-close"></span></h4>
                                    </div>
                                </li>
                                <li class="vc_col-md-3 vc_col-sm-6 vc_col-xs-6">
                                    <div class="ctg_list">
                                        <img src="wp-content/wp-content/uploads/2016/03/Member-01.jpg" />
                                        <h4>Relationships<span class="ion-android-close"></span></h4>
                                    </div>
                                </li>
                                <li class="vc_col-md-3 vc_col-sm-6 vc_col-xs-6">
                                    <div class="ctg_list">
                                        <img src="wp-content/wp-content/uploads/2016/03/Member-01.jpg" />
                                        <h4>Activity <span class="ion-android-close"></span></h4>
                                    </div>
                                </li>
                                <li class="vc_col-md-3 vc_col-sm-6 vc_col-xs-6">
                                    <div class="ctg_list">
                                        <img src="wp-content/wp-content/uploads/2016/03/Member-01.jpg" />
                                        <h4>Mind - Spirit<span class="ion-android-close"></span></h4>
                                    </div>
                                </li>
                                <li class="vc_col-md-3 vc_col-sm-6 vc_col-xs-6">
                                    <div class="ctg_list">
                                        <img src="wp-content/wp-content/uploads/2016/03/Member-01.jpg" />
                                        <h4>Nutrition<span class="ion-android-close"></span></h4>
                                    </div>
                                </li>
                                <li class="vc_col-md-3 vc_col-sm-6 vc_col-xs-6">
                                    <div class="ctg_list">
                                        <img src="wp-content/wp-content/uploads/2016/03/Member-01.jpg" />
                                        <h4>Relationships<span class="ion-android-close"></span></h4>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- page container ends here -->
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>