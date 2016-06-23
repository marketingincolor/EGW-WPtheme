<?php

/*
 * Author: Ramkumar.S
 * Date: June 22, 2016
 */
$link = $_SERVER["REQUEST_URI"];
$server = $_SERVER['SERVER_NAME'];
$link_array = explode('/', $link);
//print_r($link_array);
if ($server == 'localhost')
    $username = $link_array[3];
else
    $username = $link_array[2];
?>
<?php

$blog_archive_pages_classes = discussion_blog_archive_pages_classes(discussion_get_author_blog_list());
?>
<?php get_header(); ?>

<?php

$args = array(
    'search' => $username,
    'search_columns' => array('user_login', 'user_email')
);
$user_query = new WP_User_Query($args);
//echo '<pre>';
//print_r($user_query->results);
//echo '</pre>';

echo '<h2>Public Profile</h2>';

if (!empty($user_query->results)) {
    foreach ($user_query->results as $user) {
        echo '<p> Display Name: ' . $user->display_name . '</p>';
        echo '<p> User Login: ' . $user->user_login . '</p>';
        echo '<p> User Email: ' . $user->user_email . '</p>';
        echo '<p> User registered: ' . $user->user_registered . '</p>';
        echo '<p> Role: ' . $user->roles[0] . '</p>';
    }
} else {
    echo 'No users found.';
}

echo '<h2>Related posts</h2>';

if (isset($username) && !empty($username)) {
    echo "<ul>";
    $args = array(
        'posts_per_page' => -1,
        'offset' => 0,
        'category' => '',
        'category_name' => '',
        'orderby' => 'date',
        'order' => 'DESC',
        'include' => '',
        'exclude' => '',
        'meta_key' => '',
        'meta_value' => '',
        'post_type' => 'post',
        'post_mime_type' => '',
        'post_parent' => '',
        'author' => '',
        'author_name' => $username,
        'post_status' => 'publish',
        'suppress_filters' => true
    );
    $posts = get_posts($args);

    //if this author has posts, then include his name in the list otherwise don't
    if (isset($posts) && !empty($posts)) {
        echo "<ul>";
        foreach ($posts as $post) {
            echo "<li>" . $post->post_title . "</li>";
        }
        echo "</ul>";
    }
    echo "</ul>";
}
?>
<?php get_footer(); ?>