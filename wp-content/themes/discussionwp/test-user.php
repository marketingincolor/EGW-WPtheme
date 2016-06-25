<?php
/**
* Template Name: User Page
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/

get_header(); ?>

<div id="main-content">

<div id="primary">
<div id="content" role="main">
<?php
global $current_user;
wp_get_current_user();

$current_user_id = $current_user->ID;

if (isset($_POST['submit'])){

require_once(ABSPATH . '/wp-load.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/image.php');

$filename =  $_FILES['userProfileImage']['name'];

$uploaddir = wp_upload_dir(); // get wordpress upload directory
$myDirPath = $uploaddir['path'];
$myDirUrl = $uploaddir['url'];

$MyImage = rand(0,5000).$_FILES['userProfileImage']['name'];
$image_path = $myDirPath.'/'.$MyImage;
move_uploaded_file($_FILES['userProfileImage']['tmp_name'],$image_path);

$file_array = array(
'name' => $_FILES['userProfileImage']['name'],
'type'    => $_FILES['userProfileImage']['type'],
'tmp_name'    => $_FILES['userProfileImage']['tmp_name'],
'error'    => $_FILES['userProfileImage']['error'],
'size'    => $_FILES['userProfileImage']['size'],
);

$file = $MyImage;
$uploadfile = $myDirPath.'/' . basename( $file );
$filename = basename( $uploadfile );
$wp_filetype = wp_check_filetype(basename($filename), null );

$attachment = array(
'guid'           => $uploaddir['url'] . '/' . basename( $uploadfile ),
'post_mime_type' => $wp_filetype['type'],
'post_title' => preg_replace('/\.[^.]+$/', "", $_FILES['userProfileImage']['name']),
'post_content' => "",
'post_status' => 'inherit'
);

$attachment_id = wp_insert_attachment( $attachment, $uploadfile );
$attach_data = wp_generate_attachment_metadata( $attachment_id, $uploadfile );
wp_update_attachment_metadata( $attachment_id, $attach_data );
update_field( 'custom_avatar', $attachment_id, "user_".$current_user_id);
}
?>
<?php

global $current_user;
wp_get_current_user();
$current_user_id = $current_user->ID;
$profile_image = get_field( 'custom_avatar','user_'.$current_user_id);


?>
<form name="artist_basic_profile" id="artist_basic_profile" action="" method="post" enctype="multipart/form-data">
<img src="<?php echo $profile_image; ?>" width="255" height="255">
<?php if($current_user_id){ ?>
<input type="file" id="userProfileImage" name="userProfileImage" >
<input id="submit" type="submit" name="submit" value="Save" >
<img src="<?php echo $profile_image ?>" width="255" height="255"/>
<?php } ?>
</form>
</div><!– #content –>
</div><!– #primary –>
</div><!– #main-content –>

<?php
get_sidebar();
get_footer();