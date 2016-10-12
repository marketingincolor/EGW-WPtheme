<?php

if (isset($_POST)) {
    $errors = array();
    //Fetching user email address
    $fetchedEmail = $_REQUEST['emaildata'];
    parse_str($fetchedEmail, $original_arraylist);
    $fetchedEmailrel = explode(",", $original_arraylist['emailaddress']);

    $original_arraylist['comments'];

    //Fetching thier selected articles
    $fetchedArtcilelist = $original_arraylist['articlefetched'];
    parse_str($fetchedArtcilelist, $original_fetchedarticles);

    if (isset($fetchedArtcilelist) && !empty($fetchedArtcilelist)) {
        $args = array(
            'orderby' => 'post__in',
            'post__in' => $original_fetchedarticles['saved-posts'],
            'posts_per_page' => 100,
            'paged' => 1,
            'post_type' => array('post', 'videos')
        );
        $saved_posts_values = get_posts($args);
//        if (have_posts()) : while (have_posts()) : the_post();
        $articlefetched = '<ul style="width=50%;"><li style="margin:30px 0px 30px 0px; list-style: none;">' . $original_arraylist['comments'] . '</li>';
        if ($saved_posts_values) {
            foreach ($saved_posts_values as $post) {
                setup_postdata($post);
                $articlefetched.='<li style="list-style: none;">';
                $articlefetched.='<div class="art-cont-dis">';
                $articlefetched.='<div class="saved_art_img">' . get_the_post_thumbnail($post->ID, array(2000,300)) . '</div>';
                $articlefetched.='<div class = "saved_art_cont-pop">';
                $articlefetched.='<h4 id = "' . $post->ID . '" style="font-weight:bold; margin:30px 0px 30px 0px">' . get_the_title($post->ID) . '</h4>';
                $articlefetched.= '<p style="margin:30px 0px 30px 0px">' . get_the_content($post->ID) . '</p>';
                $articlefetched.='</div>';
                $articlefetched.='</div>';
                $articlefetched.='</li>';
            }
        }
        $articlefetched.='</ul>';
        $emailsend = 1;
    } else {
        $articlefetched = '<span>No articles found</span>';
        $emailsend = 0;
    }

    $sender = 'From: Admin <rajasingh@farshore.com>' . "\r\n";
    $headers[] = 'MIME-Version: 1.0' . "\r\n";
    $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers[] = "X-Mailer: PHP \r\n";
    $headers[] = $sender;

    $subject = "Share a list of your saved article stories with your friends";

    if ($emailsend) {
        foreach ($fetchedEmailrel as $key => $sharingemail) {
            //mail($sharingemail, $subject, $articlefetched, $headers);
            wp_mail($sharingemail, $subject, $articlefetched, $headers);
        }
        echo $success = "Email send successfully... ";
    } else {
        echo $error = "Email not sent ";
    }
}
?>