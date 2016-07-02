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