<div id="apsc_widget-4" class="widget widget_apsc_widget">
    <div class="mkd-section-title-holder clearfix">
        <span class="mkd-st-title">Share</span>
    </div>
    <?php echo do_shortcode('[aps-counter theme="theme-2"]'); ?>  
</div>
<div class="widget mkd-rpc-holder">
    <div class="widget widget_categories">
        <div class="mkd-rpc-content">             
            <!--- Insert Ads here --->
            <?php if (function_exists('drawAdsPlace')) drawAdsPlace(array('id' => 1), true); ?>
            <!--- Ads end here --->            
        </div>
    </div>
</div>
<div class="mkd-ratings-holder-container">
    <div class="mkd-section-title-holder clearfix"><span class="mkd-st-title"><?php esc_html_e('Rate This Article', 'discussionwp'); ?></span></div>
    <div class="mkd-ratings-holder">
            <div class="mkd-ratings-stars-holder">
                <?php
                if (function_exists('the_ratings')) {
                    the_ratings();
                }
                ?>
            </div>
     
        <div class="mkd-ratings-message-holder">
            <div class="mkd-rating-value"></div>
            <div class="mkd-rating-message"></div>
        </div>
    </div>
</div>
<?php get_template_part('sidebar/template-related-articles'); ?>