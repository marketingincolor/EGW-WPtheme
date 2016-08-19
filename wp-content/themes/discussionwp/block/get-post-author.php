<?php
$author_display_name = get_the_author();
echo "Checking:".$author_display_name;
function get_user_id_by_display_name($author_display_name) {
    global $wpdb;

    if (!$user = $wpdb->get_row($wpdb->prepare(
                    "SELECT `ID` FROM $wpdb->users WHERE `display_name` = %s", $author_display_name
            )))
        return false;

    return $user->ID;
}

$getUserID = get_user_id_by_display_name($author_display_name);

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
    $displayNameis = get_the_author();
}
?>
<?php if ($role == "coach") { ?>
    <div class="article-created">
        <div class="article-cr-lft">
            <?php
            $custom_avatar_meta_data = get_user_meta($getUserID, 'custom_avatar');
            if (isset($custom_avatar_meta_data) && !empty($custom_avatar_meta_data[0])):
                $attachment = wp_get_attachment_image_src($custom_avatar_meta_data[0], 'thumbnail');
                ?>
                <img src="<?php echo $attachment[0]; ?>" width="100" height="100" class="avatar avatar-176 photo"/>
            <?php else : ?>                                                    
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/aavathar.jpg" width="100" height="100" class="avatar avatar-176 photo"/>
            <?php endif; ?>
        </div>
        <div class="article-cr-rgt">
            <p>This article was created by</p>
            <a href="<?php echo site_url(); ?>/public/<?php echo get_the_author(); ?>"><?php echo $displayNameis; ?></a>
        </div>
    </div>

<?php }
?>