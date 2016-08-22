<?php
/**
 * Author - Akilan 
 * Date - 14-07-2016
 * Purpose - For display ajax loader and show more button
 */

?>
<div class="fsp-ads-homepage loader_img" style="display:none">
    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/loading.svg'; ?>" width="75">
</div>

<div class="fsp-ads-homepage">
    <div class="mkd-bnl-navigation-holder">
        <div id="showmore" style="display:none" class="mkd-btn mkd-bnl-load-more mkd-load-more mkd-btn-solid">
            <?php echo esc_html__('Show More', 'discussionwp') ?>
        </div>
        <div id="loading" style="display:none" class="mkd-btn mkd-bnl-load-more mkd-load-more mkd-btn-solid">            
                <?php echo esc_html__('LOADING...', 'discussionwp') ?>            
        </div>
    </div>
</div>
