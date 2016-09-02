<?php
$video_url = get_field('video_url');
$videoId = "";
if ($video_url != "") {
    /**
     * wistia video only return video id before load
     * loaded wideo vistia url based on its div id other videos get loaded as it is
     */
    list($videoId, $val) = get_videoid_from_url($video_url);
}
?>
<div class="mkd-post-image-area wistia_embed wistia_async_<?= $videoId; ?> videoFoam=true">

    <?php
    discussion_post_info_category(array('category' => 'no'));
    $video_file = get_field('video_file');
    if ($val != "" && $videoId == "") {
        if (strpos($val, 'youtube') > 0) {
            ?>

            <iframe width="600" height="338" frameborder="0" src="<?php echo $val; ?>" allowfullscreen></iframe>

            <?php
        } else {
            ?>
            <iframe  width="600" height="338"  src="<?php echo $val; ?>" frameborder="0"  allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen></iframe>

            <?php
        }
    }
    if ($video_file != "" && $video_url == "") {
        ?>                                                 
        <video width="100%" height="100%" controls >
            <source src="<?php echo $video_file; ?>" type="video/mp4">
        </video>                                                    
    <?php }
    ?>
</div>

<!--added script for loading videos wistia url-->
<script src="//fast.wistia.com/assets/external/E-v1.js" async></script>