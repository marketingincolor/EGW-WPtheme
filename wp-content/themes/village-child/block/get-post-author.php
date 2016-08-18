<?php
$user = get_userdatabylogin(get_the_author());
$user = new WP_User($user->ID);
if (!empty($user->roles) && is_array($user->roles)) {
    foreach ($user->roles as $role)
        $role;
}
?>
<?php if ($role == "coach") { ?>
    <div class="monitorcomments">                        
        <p>This article created by <a href="<?php echo site_url(); ?>/public/<?php echo get_the_author(); ?>"><?php echo $author = get_the_author(); ?></a></p>
    </div> 
<?php
}?>