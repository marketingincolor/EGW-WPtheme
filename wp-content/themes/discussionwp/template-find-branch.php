<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>
    .white-popup-block {
        background: #FFF;
        padding: 20px 30px;
        text-align: left;
        max-width: 650px;
        margin: 40px auto;
        position: relative;
    }
</style>
<div class="white-popup-block">
    <?php
    $url = (!empty($_SERVER['HTTPS'])) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $url = $_SERVER['REQUEST_URI'];
    $my_url = explode('wp-content', $url);
    $path = $_SERVER['DOCUMENT_ROOT'] . $my_url[0];
    define('WP_USE_THEMES', false);
    require($path . 'wp-load.php');
    $blog_list = get_blog_list(0, 'all');
    foreach ($blog_list AS $blog) {
        echo "<li type='square'><a href='http://" . $blog['domain'] . $blog['path'] . "' target='_blank'>" . $blog['domain'] . $blog['path'] . "</a></li>";
    }
    ?>
</div>
