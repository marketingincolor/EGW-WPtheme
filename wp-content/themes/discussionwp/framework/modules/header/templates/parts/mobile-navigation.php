<?php do_action('discussion_before_mobile_navigation'); ?>

<nav class="mkd-mobile-nav">
    <div class="mkd-grid">
        <?php wp_nav_menu(array(
            'theme_location' => 'mobile-navigation' ,
            'container'  => '',
            'container_class' => '',
            'menu_class' => '',
            'menu_id' => '',
            'fallback_cb' => 'top_navigation_fallback',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'walker' => new DiscussionMobileNavigationWalker()
        )); ?>
    </div>
</nav>

<?php do_action('discussion_after_mobile_navigation'); ?>