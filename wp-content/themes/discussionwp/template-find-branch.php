<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="white-popup-block">
    <?php
    $url = (!empty($_SERVER['HTTPS'])) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $url = $_SERVER['REQUEST_URI'];
    $my_url = explode('wp-content', $url);
    $path = $_SERVER['DOCUMENT_ROOT'] . $my_url[0];
    define('WP_USE_THEMES', false);
    require($path . 'wp-load.php');
    //$blog_list = wp_get_sites();
    //echo "<li type='square'><a href='http://" . $blog['domain'] . $blog['path'] . "' target='_blank'>" . $blog['domain'] . $blog['path'] . "</a></li>";
    ?>
</div>
<span style="display:none"><?php print_r($blog_list); ?></span>
<div class="white-popup-block">
    <div class="find-a-branch-container">
        <h4>Visit A Branch</h4>
        <div class="fs-custom-select-container">
            <div class="egw-homesite">
                <a href="<?php echo network_site_url(); ?>">Go back to myEvergreenWellness Home Page</a>
            </div>
            <div class="fs-custom-select">
                <select id="findavillage">
                    <option value="" selected="selected">Select A Branch</option>
                    <?php
                    // Query for getting blogs
                    $blogs = $wpdb->get_results($wpdb->prepare("SELECT blog_id, domain, path FROM $wpdb->blogs WHERE site_id = %d AND public = '1' AND archived = '0' AND mature = '0' AND spam = '0' AND deleted = '0' ORDER BY registered DESC", $wpdb->siteid), ARRAY_A);

                    // put it in array  
                    foreach ((array) $blogs as $details) {
                        $blog_list[$details['blog_id']] = $details;
                    }
                    unset($blogs);
                    $blogs = $blog_list;

                    // if is valid array
                    if (is_array($blogs)) {

                        $array = array();
                        // reorder
                        $array = array_slice($blogs, 0, count($blogs));
                        for ($i = 0; $i < count($array); $i++) {
                            // get data for each id
                            $blog = get_blog_details($array[$i]['blog_id']);
                            // print it
                            ?>
                            <option id="<?php echo $array[$i]['blog_id']; ?>" value="<?php echo $blog->siteurl; ?>"><?php echo $blog->blogname; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="ev-btn-container">
            <button type="button" id="myevergreen">Visit</button>
        </div>
    </div>
</div>
