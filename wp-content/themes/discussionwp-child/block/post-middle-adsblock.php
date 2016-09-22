<?php
/**
 * Author - Akilan
 * Date  - 29-07-2016
 * Purpose -  For displaying ads based on total count of post and based on mobile & desktop view
 */
if ($total_post >= $post_per_section) {
    $no_of_adds = ceil($total_post / $post_per_section);
    for ($i = 1; $i <= $no_of_adds; $i++) {
        /**
         * For desktop view  ads
         * id => 1 => desktop large screen
         * id => 2 => for mobile screen ads display
         */
        ?>

        <!--<div class="fsp-ads-homepage hidden-xs" id="adv_row_<?php echo $i; ?>" <?php if ($i != 1) { ?> style="display:none;clear:both" <?php } else { ?> style="clear:both" <?php } ?>>
            <?php
            //if (function_exists('drawAdsPlace'))
            //    drawAdsPlace(array('id' => 1), true);
            ?>
        </div>-->
        <?php
        /**
         * For mobile view ads
         */
        ?>
        <!--<div class="fsp-ads-homepage hidden-sm hidden-md hidden-lg"  id="mob_adv_row_<?php echo $i; ?>" <?php if ($i != 1) { ?> style="display:none;clear:both" <?php } else { ?> style="clear:both" <?php } ?>>
            <?php
            //if (function_exists('drawAdsPlace'))
            //    drawAdsPlace(array('id' => 3), true);
            ?>
        </div>-->

        <div class="fsp-ads-homepage" id="mob_adv_row_<?php echo $i; ?>" <?php if ($i != 1) { ?> style="display:none;clear:both" <?php } else { ?> style="clear:both" <?php } ?>>

            <ins data-revive-zoneid="3" id="zoneid" data-revive-id="0be604ef9a1ab68c1665959c06390bf9"></ins>
            <script async src="//myevergreenwellness.net/www/delivery/asyncjs.php"></script>
            <script type="text/javascript">
    			(function() {
    				var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    				var elem = document.getElementById("zoneid");
    				if ( w > 480 ) {
    					elem.setAttribute("data-revive-zoneid", "3"); // normal banner
    				} else {
    					elem.setAttribute("data-revive-zoneid", "1"); // mobile banner
    				}
    			})();
    		</script>

        </div>

        <?php
    }
}
?>
