<?php do_action('discussion_before_page_header'); ?>

<header class="mkd-page-header">
    <div class="mkd-logo-area">
        <div class="mkd-grid">
            <div class="mkd-vertical-align-containers">
                <div class="mkd-position-left">
                    <div class="mkd-position-left-inner">
                        <?php if(!$hide_logo) {
                            discussion_get_logo();
                        } ?>
                    </div>
                </div>
                <div class="mkd-position-right">
                    <div class="mkd-position-right-inner">
                        <?php if(is_active_sidebar('mkd-right-from-logo')) : ?>
                            <?php dynamic_sidebar('mkd-right-from-logo'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mkd-menu-area">
        <div class="mkd-grid">
            <div class="mkd-vertical-align-containers">
                <div class="mkd-position-left">
                    <div class="mkd-position-left-inner">
                        <?php if(is_active_sidebar('mkd-left-from-main-menu')) : ?>
                            <?php dynamic_sidebar('mkd-left-from-main-menu'); ?>
                        <?php endif; ?>
                        <?php discussion_get_main_menu(); ?>
                    </div>
                </div>
                <div class="mkd-position-right">
                    <div class="mkd-position-right-inner">
                        <?php if(is_active_sidebar('mkd-right-from-main-menu')) : ?>
                            <?php dynamic_sidebar('mkd-right-from-main-menu'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($show_sticky) {
        discussion_get_sticky_header('centered');
    } ?>
</header>

<?php do_action('discussion_after_page_header'); ?>