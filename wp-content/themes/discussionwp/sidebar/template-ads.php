<?php
/**
 * Modifier - Akilan
 * Date - 14-07-2016
 * Purpose - Added hidden xs class for hiding in mobile view
 */
?>

<div class="widget mkd-rpc-holder hidden-xs">
    <div class="widget widget_categories">
        <div class="mkd-rpc-content">  
            <!--- Insert Ads here --->
            <?php if (function_exists('drawAdsPlace')) drawAdsPlace(array('id' => 2), true); ?>
            <!--- Ads end here --->
        </div>
    </div>    
</div>