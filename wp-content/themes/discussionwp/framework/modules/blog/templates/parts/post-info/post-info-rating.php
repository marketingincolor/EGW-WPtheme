<?php $post_rating = discussion_get_post_rating(); ?>
<div class="mkd-post-info-rating">
    <span class="mkd-post-info-rating-inactive">
        <span class="mkd-post-info-rating-active" style="width: <?php echo esc_attr(20*$post_rating) ?>%"></span>
    </span>
    <div class="mkd-post-info-rating-value"></div>
    <div class="mkd-post-info-rating-message"></div>
</div>