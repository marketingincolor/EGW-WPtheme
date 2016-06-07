<div class="mkd-bnl-navigation-holder">
    <div data-rel="<?php echo esc_attr($params['query_result']->max_num_pages) ?> " class="mkd-btn mkd-bnl-load-more mkd-load-more mkd-btn-solid">
        <?php echo get_next_posts_link( esc_html__('Show More', 'discussionwp'), $params['query_result']->max_num_pages ) ?>
    </div>
    <div class="mkd-btn mkd-bnl-load-more-loading mkd-btn-solid">
        <a href="javascript: void(0)" class="">
            <?php echo esc_html__('LOADING...', 'discussionwp') ?>
        </a>
    </div>
</div>