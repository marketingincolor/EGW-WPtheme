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
            <script type="text/javascript">
                function getzonenum() {
                    var zonenum = '1';
    				var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    				if ( w > 480 ) {
                        zonenum = '3';
    				} else {
                        zonenum = '1';
    				}
                    document.write('<ins data-revive-zoneid="'+zonenum+'" id="adzoneid" data-revive-id="0be604ef9a1ab68c1665959c06390bf9"></ins>'); // creates INS tag for Revive based on window width
                };
                getzonenum();
    		</script>
            <script async src="//myevergreenwellness.net/www/delivery/asyncjs.php"></script>
        </div>

        <?php
    }
}
?>
