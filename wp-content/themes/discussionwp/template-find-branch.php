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
    $blog_list = get_blog_list(0, 'all');
    //echo "<li type='square'><a href='http://" . $blog['domain'] . $blog['path'] . "' target='_blank'>" . $blog['domain'] . $blog['path'] . "</a></li>";
    ?>
</div>
<div class="white-popup-block">
    <div class="find-a-branch-container">
        <h4>Find A Branch</h4>
        <div class="fs-custom-select">
            <select id="findavillage">
                <option value="" selected="selected">Select Your Village</option>
                <?php foreach ($blog_list AS $blog) { ?>
                    <?php
                    $getRel = explode('/', $blog['path']);

                    print_r($getRel);
                    ?>
                    <option value="<?php echo "http://" . $blog['domain'] . $blog['path'] ?>"><?php echo $getRel[count($getRel) - 2]; ?></option>
<?php } ?>
            </select>
        </div>
        <div class="ev-btn-container">
            <button type="button" id="myevergreen">myEveergreen Home</button>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        jQuery("#myevergreen").click(function () {
            if (jQuery("#findavillage").val() == "") {
                return false;
            } else {
                window.open(jQuery("#findavillage").val(), '_blank');
            }

        });
    });

</script>
