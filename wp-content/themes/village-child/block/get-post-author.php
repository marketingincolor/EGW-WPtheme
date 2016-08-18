<?php
$author_display_name = get_the_author();

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
    <div class="monitorcomments">                        
        <p>This article created by <a href="<?php echo site_url(); ?>/public/<?php echo get_the_author(); ?>"><?php echo $displayNameis; ?></a></p>
    </div> 
    <?php
} ?>