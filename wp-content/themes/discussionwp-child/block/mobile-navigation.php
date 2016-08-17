<?php do_action('discussion_before_mobile_navigation'); ?>

<nav class="mkd-mobile-nav">
    <div class="mkd-grid">
        <form method="get" action="<?php bloginfo('home'); ?>" id="searchform-859049597">
            <div class="mkd-form-holder">
                <div class="mkd-mobile-search-nw">
                    <div class="mkd-mobile-search-container">
                        <div class="mkd-column-left">
                            <input type="text" autocomplete="off" class="mkd-search-field" name="s" placeholder="Search">
                        </div>
                        <div class="mkd-column-right">
                            <button value="Search" type="submit" class="mkd-search-submit"><span class="ion-ios-search"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'mobile-navigation',
            'container' => '',
            'container_class' => '',
            'menu_class' => '',
            'menu_id' => '',
            'fallback_cb' => 'top_navigation_fallback',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'walker' => new DiscussionMobileNavigationWalker()
        ));
        ?>
    </div>
</nav>

<?php do_action('discussion_after_mobile_navigation'); ?>