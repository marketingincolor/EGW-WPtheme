<div class="widget mkd-rpc-holder">
    <div class="widget widget_categories">
        <div class="mkd-rpc-content">  
            <?php if (is_front_page() || is_home() || is_404()) { ?>
                <!--- Insert Ads here --->
                <?php if (function_exists('drawAdsPlace')) drawAdsPlace(array('id' => 1), true); ?>
                <!--- Ads end here --->
                <?php }
            ?>
        </div>
    </div>    
</div>