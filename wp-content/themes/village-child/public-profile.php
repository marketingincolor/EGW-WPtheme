<?php
 get_header();?>
<?php

/*
 * Author: Ramkumar.S
 * Date: June 22, 2016
 */
$link = $_SERVER["REQUEST_URI"];
$server = $_SERVER['SERVER_NAME'];
$link_array = explode('/', $link);
//print_r($link_array);
if ($server == '192.168.1.154')
    $username = $link_array[3];
else
    $username = $link_array[2];
?>

<div class="mkd-content">
    <div class="mkd-content-inner">
       <?php global $current_user;
             wp_get_current_user ();
       ?>
        <div class="mkd-container">
            <div class="mkd-container-inner clearfix">
            <div class="mkd-blog-holder mkd-blog-single">
		<?php
		$args = array(
		    'search' => $username,
		    'search_columns' => array('user_login', 'user_email')
		);
		$user_query = new WP_User_Query($args);
//		echo '<pre>';
//		print_r($current_user);
//		echo '</pre>';

//		echo '<h2>Public Profile</h2>';

		if (!empty($user_query->results)) {
		    foreach ($user_query->results as $user) {
//			echo '<p> Display Name: ' . $user->display_name . '</p>';
//			echo '<p> User Login: ' . $user->user_login . '</p>';
//			echo '<p> User Email: ' . $user->user_email . '</p>';
//			echo '<p> User registered: ' . $user->user_registered . '</p>';
//			echo '<p> Role: ' . $user->roles[0] . '</p>';
		    }
		} else {
		    echo 'No users found.';
		}
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
                           <div class="mkd-author-description-image">
                                     <?php
                                    $custom_avatar_meta_data = get_user_meta($user->ID, 'custom_avatar');
                                    if (isset($custom_avatar_meta_data) && !empty($custom_avatar_meta_data[0])):
                                        $attachment = wp_get_attachment_image_src($custom_avatar_meta_data[0], 'thumbnail');
                                        ?>
                                        <img src="<?php echo $attachment[0]; ?>" width="176" height="176" class="avatar avatar-176 photo"/>
                                    <?php else : ?>                                                    
                                        <img src="<?php echo get_template_directory_uri();?>/assets/img/aavathar.jpg" width="176" height="176" class="avatar avatar-176 photo"/>
                                    <?php endif; ?>
                            </div>
                            <div class="mkd-author-description-text-holder">
                                <div class="mkd-author-text">
                                    <h3><?php echo $user->first_name." ".$user->last_name ?></h3>
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
<?php get_footer(); ?>
