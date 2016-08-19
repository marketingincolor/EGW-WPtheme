<?php get_header(); ?>
<?php
/*
 * Author: Ramkumar.S
 * Date: June 22, 2016
 */
$link = $_SERVER["REQUEST_URI"];
$server = $_SERVER['SERVER_NAME'];
$link_array = explode('/', $link);
$username = $link_array[count($link_array)-2];
?>
<?php

function get_user_id_by_user_nicename($author_display_name) {
    global $wpdb;

    if (!$user = $wpdb->get_row($wpdb->prepare(
                    "SELECT `ID` FROM $wpdb->users WHERE `user_nicename` = %s", $author_display_name
            )))
        return false;

    return $user->ID;
}

$getUserID = get_user_id_by_user_nicename($username);
?>

<div class="mkd-content">
    <div class="mkd-content-inner">
        <?php
        global $current_user;
        wp_get_current_user();
        ?>
        <div class="mkd-container">
            <div class="mkd-container-inner clearfix">
                <div class="mkd-blog-holder mkd-blog-single">
                    <?php
                    $user = new WP_User($getUserID);
                    if (!empty($user->roles) && is_array($user->roles)) {
                        foreach ($user->roles as $role) {
                            $role;
                            $user->first_name;
                            $user->last_name;
                        }
                    }
//		$args = array(
//		    'search' => $username,
//		    'search_columns' => array('user_login', 'user_email')
//		);
//		$user_query = new WP_User($getUserID);
//		echo '<pre>';
//		print_r($user_query);
//		echo '</pre>';
//		echo '<h2>Public Profile</h2>';
//		if (!empty($user_query)) {
//		    foreach ($user_query as $user) {
//                        print_r($user);
//			//echo '<p> Display Name: ' . $user->display_name . '</p>';
////			echo '<p> User Login: ' . $user->user_login . '</p>';
////			echo '<p> User Email: ' . $user->user_email . '</p>';
////			echo '<p> User registered: ' . $user->user_registered . '</p>';
////			echo '<p> Role: ' . $user->roles[0] . '</p>';
//		  }
//		} else {
//		    echo 'Not found.';
//		}
//                
//                echo $user->display_name;
//                echo $user->ID;
//
//		echo '<h2>Related posts</h2>';
//
//		if (isset($username) && !empty($username)) {
//		    echo "<ul>";
//		    $args = array(
//			'posts_per_page' => -1,
//			'offset' => 0,
//			'category' => '',
//			'category_name' => '',
//			'orderby' => 'date',
//			'order' => 'DESC',
//			'include' => '',
//			'exclude' => '',
//			'meta_key' => '',
//			'meta_value' => '',
//			'post_type' => 'post',
//			'post_mime_type' => '',
//			'post_parent' => '',
//			'author' => '',
//			'author_name' => $username,
//			'post_status' => 'publish',
//			'suppress_filters' => true
//		    );
//		    $posts = get_posts($args);
//
//		    //if this author has posts, then include his name in the list otherwise don't
//		    if (isset($posts) && !empty($posts)) {
//			echo "<ul>";
//			foreach ($posts as $post) {
//			    echo "<li>" . $post->post_title . "</li>";
//			}
//			echo "</ul>";
//		    }
//		    echo "</ul>";
//		}
                    ?>
                    <div class="mkd-container-inner">
                        <div class="mkd-author-description">
                            <div class="mkd-author-description-inner">
                                <div class="coach-profile">
                                    <div class="coach-profile-image">
                                        <?php
                                        $custom_avatar_meta_data = get_user_meta($getUserID, 'custom_avatar');
                                        if (isset($custom_avatar_meta_data) && !empty($custom_avatar_meta_data[0])):
                                            $attachment = wp_get_attachment_image_src($custom_avatar_meta_data[0], 'thumbnail');
                                            ?>
                                            <img src="<?php echo $attachment[0]; ?>" width="176" height="176" class="avatar avatar-176 photo"/>
                                        <?php else : ?>                                                    
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/aavathar.jpg" width="176" height="176" class="avatar avatar-176 photo"/>
                                        <?php endif; ?>
                                    </div>
                                    <div class="coach-profile-text">
                                        <div class="mkd-coach-profile-text">
                                            <?php
                                            if (!empty($user->first_name) && !empty($user->last_name)) {
                                                $displayNameis = $user->first_name . " " . $user->last_name;
                                            } else {
                                                $displayNameis = $user->display_name;
                                            }
                                            ?>
                                            <h3><?php echo $displayNameis; ?></h3>
                                            <p><?php echo $user->description ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
