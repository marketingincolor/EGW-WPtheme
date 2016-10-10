<?php
/**
 * Author - Doe
 * Date - 10-10-2016
 * Purpose - For displaying registration ads
*/

if( !is_user_logged_in()) { ?>
<div class="widget mkd-rpc-holder hidden-sm hidden-md hidden-lg" style="margin-top:41px;">
    <div class="widget widget_categories">
        <div class="mkd-rpc-content">
            <!-- Insert Ads here -->
            <?php //if (function_exists('drawAdsPlace')) drawAdsPlace(array('id' => 2), true); ?>
            <ins data-revive-zoneid="6" data-revive-id="0be604ef9a1ab68c1665959c06390bf9"></ins>
            <script async src="//myevergreenwellness.net/www/delivery/asyncjs.php"></script>
            <!-- Ads end here -->
        </div>
    </div>
</div>
<?php } ?>