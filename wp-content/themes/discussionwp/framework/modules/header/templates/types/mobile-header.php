<?php do_action('discussion_before_mobile_header'); ?>

<header class="mkd-mobile-header">
    <div class="mkd-mobile-header-inner">
        <?php do_action( 'discussion_after_mobile_header_html_open' ) ?>
        <div class="mkd-mobile-header-holder">
            <div class="mkd-grid">
                <div class="mkd-vertical-align-containers">
                    <?php if($show_logo) : ?>
                        <div class="mkd-position-left">
                            <div class="mkd-position-left-inner">
                                <?php discussion_get_mobile_logo(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="mkd-position-right">
                        <div class="mkd-position-right-inner">
                            <?php if(is_active_sidebar('mkd-right-from-mobile-logo')) {
                                dynamic_sidebar('mkd-right-from-mobile-logo');
                            } ?>
                            <?php if($show_navigation_opener) : ?>
                                <div class="mkd-mobile-menu-opener">
                                    <a href="javascript:void(0)">
                                        <span class="mkd-mobile-opener-icon-holder">
                                            <span class="mkd-line line1"></span>
                                            <span class="mkd-line line2"></span>
                                            <span class="mkd-line line3"></span>
                                        </span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div> <!-- close .mkd-vertical-align-containers -->
            </div>
        </div>
        <?php discussion_get_mobile_nav(); ?>
    </div>

</header> <!-- close .mkd-mobile-header -->

<?php do_action('discussion_after_mobile_header'); ?>