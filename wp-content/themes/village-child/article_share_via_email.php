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
//        $articlefetched = '<ul style="width=50%;"><li style="margin:30px 0px 30px 0px; list-style: none; width:730px;">' . $original_arraylist['comments'] . '</li>';
//        if ($saved_posts_values) {
//            foreach ($saved_posts_values as $post) {
//                setup_postdata($post);
//                $articlefetched.='<li style="list-style: none;">';
//                $articlefetched.='<div class="art-cont-dis">';
//                $articlefetched.='<div class="saved_art_img">' . get_the_post_thumbnail($post->ID, array(2400, 400)) . '</div>';
//                $articlefetched.='<div class = "saved_art_cont-pop">';
//                $articlefetched.='<h4 id = "' . $post->ID . '" style="font-weight:bold; margin:30px 0px 30px 0px">' . get_the_title($post->ID) . '</h4>';
//                $articlefetched.= '<p style="margin:30px 0px 30px 0px; width:730px;">' . get_the_content($post->ID) . '</p>';
//                $articlefetched.='</div>';
//                $articlefetched.='</div>';
//                $articlefetched.='</li>';
//            }
//        }
        $articlefetched.='<table width="100%" style="margin:0 auto;  font-family:Arial, Helvetica, sans-serif;padding-top: 140px;padding-bottom: 140px; " cellspacing="0" cellpadding="0" bgcolor="#ccc" >
            <tbody>
                <tr>
                    <td>
                        <table width="600" style="margin:0 auto;  font-family:Arial, Helvetica, sans-serif;" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td style="text-align:center; background:#ffffff;  padding-top:15px;  padding-bottom:25px;">
                                        <a href="'.get_site_url().'"><img src="' . get_stylesheet_directory_uri() . '/assets/img/logo-email.png' . '" alt="logo"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background:#f4f4f4;">
                                        <table width="509" align="center" style="padding-top:30px;padding-bottom:30px;margin:0 auto;" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table align="center" style="" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="background:#ffffff; padding-top:20px; padding-bottom:25px; padding-left:20px; padding-right:20px;">
                                                                        <h2 style="font-size:18px; font-weight:normal; margin-top: 0; margin-bottom: 12px;">Hello,</h2>
                                                                        <p style="font-size:14px; color:#6c6b6b; margin-top: 0; line-height: 19px;">' . $original_arraylist['comments'] . ' </p> 
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>';
        if ($saved_posts_values) {
            foreach ($saved_posts_values as $post) {
                setup_postdata($post);
                $articlefetched.='<tr>
                                        <td>
                                            <table align="center" style="box-shadow: 1px 4px 12px #eeeeee;" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2" style="background: #3d7f3c; padding-top:10px; padding-bottom:10px;padding-left:15px;" > 
                                                            <h2 id = "' . $post->ID . '" style="color:#ffffff;font-size: 16px;margin-bottom: 0px;margin-top: 0px;">' . get_the_title($post->ID) . '</h2>
                                                        </td>
                                                    </tr>
                                                    <tr>                                            
                                                        <td style="padding-top:18px;  padding-bottom:18px; padding-left:18px;  padding-right:18px;background:#ffffff;">
                                                            <table align="center" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="top">' . get_the_post_thumbnail($post->ID, array(126, 126)) . ' </td>
                                                                        <td style="padding-left:20px; padding-right:20px;">
                                                                            <p style="font-size:13px; color:#787b80; margin-top: 0; line-height: 17px;min-height: 80px;">' . substr(get_the_content($post->ID), 0, 125) . '... </p> 
                                                                            <a href="' . get_post_permalink($post->ID) . '" target="_blank" style="background: #f39e46;color: #ffffff; float: left; font-size: 12px; font-weight: bold; padding-top:10px; padding-bottom:10px; padding-left:25px; padding-right:25px; text-decoration: none;">Read Article</a> 
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>';
            }
        }
        $articlefetched.=' </tbody>
                                       </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:center; background:#ffffff;">
                                        <p style="color:#787b80; font-size:12px;padding-top:10px;padding-bottom:10px;">Evergreen Wellness © copyright 2016</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>';
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