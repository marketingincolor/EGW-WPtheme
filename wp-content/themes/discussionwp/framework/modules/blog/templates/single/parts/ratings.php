<div class="mkd-related-posts-title">
    <span class="mkd-section-title-holder clearfix ">
        <span class="mkd-st-title">
            Gallery Images
        </span>
    </span>
</div>
<?php $getGaleryId = get_field("gallery_pick");?>
<?php echo nggShowGallery($getGaleryId); ?>
<div class="mkd-ratings-holder">
    <div class="mkd-ratings-text-holder">
        <h6 class="mkd-ratings-text-title"><?php esc_html_e('Rate This Article', 'discussionwp' ); ?></h6>
        <div class="mkd-ratings-stars-holder">
            <!--<div class="mkd-ratings-stars-inner">
                <span id="mkd-rating-1" ></span>
                <span id="mkd-rating-2" ></span>
                <span id="mkd-rating-3" ></span>
                <span id="mkd-rating-4" ></span>
                <span id="mkd-rating-5" ></span>
            </div> -->
<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
        </div>
    </div>
    <div class="mkd-ratings-message-holder">
        <div class="mkd-rating-value"></div>
        <div class="mkd-rating-message"></div>
    </div>
</div>
