<?php
$author_email = get_the_author_meta('user_email');
$user = get_user_by('email', $author_email);
$getUserID = $user->ID;
$user = new WP_User($getUserID);

if (!empty($user->roles) && is_array($user->roles)) {
    foreach ($user->roles as $role) {
        $role;
        $user->first_name;
        $user->last_name;
    }
}
if (!empty($user->first_name) && !empty($user->last_name)) {
    $displayNameis = $user->first_name . " " . $user->last_name;
} else {
    $displayNameis = $author_email = get_the_author_meta('user_nicename');
}
?>

<?php
?>
<?php if ($role == "coach") { ?>
    <div class="article-created">
        <div class="vc_col-md-4 vc_col-sm-6 vc_col-xs-12">
            <div class="vc_row">
                <div class="article-cr-lft">
                    <?php
//                    $custom_avatar_meta_data = get_user_meta($getUserID, 'custom_avatar');
//                    if (isset($custom_avatar_meta_data) && !empty($custom_avatar_meta_data[0])):
//                        $attachment = wp_get_attachment_image_src($custom_avatar_meta_data[0], 'thumbnail');
                    // Retirived the profile image from wp_cimy_uef_data table [Cimy User Extra Fields plugin]
                    $fetchresult = get_user_meta($getUserID);
                    if (!empty($fetchresult['wpcf-user-profile-avatar'][0])):
                            $fetchresultRel = $fetchresult['wpcf-user-profile-avatar'][0];
                        ?>
                        <img src="<?php echo $fetchresultRel; ?>" width="100" height="100" class="avatar avatar-176 photo"/>
                    <?php else : ?>                                                    
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/aavathar.jpg" width="100" height="100" class="avatar avatar-176 photo"/>
                    <?php endif; ?>
                </div>
                <div class="article-cr-rgt">
                    <p>Written by</p>
                    <p><span><?php echo $displayNameis; ?></span></p>
                    <p><?php echo $user->signature; ?></p>
            <!--            <a href="<?php //echo site_url();         ?>/public/<?php //echo get_the_author_meta('user_nicename');         ?>"><?php //echo $displayNameis;         ?></a>-->
                </div>
            </div>
        </div>
        <div class="vc_col-md-8 vc_col-sm-6 vc_col-xs-12">
            <div class="vc_row">
                <div class="article-cr-cont">
                    <p><?php echo $user->description; ?></p>
                </div>
            </div>
        </div>
    </div>

<?php }
?>