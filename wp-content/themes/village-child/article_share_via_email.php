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
        global $post;
        $args = array(
            'orderby' => 'post__in',
            'post__in' => $original_fetchedarticles['saved-posts'],
            'posts_per_page' => 100,
            'paged' => 1,
            'post_type' => array('post', 'videos')
        );

        $saved_posts_values = query_posts($args);
        $articlefetched = '<div>'.$original_arraylist['comments'].'</div>';
        $articlefetched .= '<ul id="saved-artiles-list">';
        if (have_posts()) : while (have_posts()) : the_post();
                $articlefetched.='<li>';
                $articlefetched.='<div class="art-cont-dis">';
                $articlefetched.='<div class="saved_art_img">' . the_post_thumbnail([117, 117]) . '</div>';
                $articlefetched.='<div class = "saved_art_cont-pop">';
                $articlefetched.='<h4 id = "' . the_ID() . '">' . the_title() . '</h4>';
                $articlefetched.= '<p>' . custom_discussion_excerpt(15) . '</p>';
                $articlefetched.='</div>';
                $articlefetched.='</div>';
                $articlefetched.='<div class="saved_art_cont_btns-close">';
                $articlefetched.='<div class="ion-android-close" data-pack="android" data-tags="delete, remove" style="display: inline-block;"></div>';
                $articlefetched.='</div>';
                $articlefetched.='</li>';
            endwhile;
        endif;
        $articlefetched.='</ul>';
        $emailsend = 1;
    }else {
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
            wp_mail($sharingemail, $articlefetched, $subject, $headers);
        }
        echo "Email send successfully... ";
    } else {
        echo "Email not sent ";
    }
}
?>