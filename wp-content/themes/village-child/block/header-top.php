<?php if ($show_header_top) : ?>

    <?php do_action('discussion_before_header_top'); ?>

    <div class="mkd-top-bar mkd-top-bar-section">
        <?php if ($top_bar_in_grid) : ?>
            <div class="mkd-grid">
            <?php endif; ?>
            <?php do_action('discussion_after_header_top_html_open'); ?>
            <div class="mkd-vertical-align-containers mkd-<?php echo esc_attr($column_widths); ?>">

                <div class="mkd-position-fullright">
<!--                    <div class="signup_newsletter"><a href="#">Sign up for our Newsletter</a></div>

                    <div id="nav_menu-2" class="widget widget_nav_menu mkd-top-bar-widget"><div class="menu-header-top-menu-container"><ul id="menu-header-top-menu" class="menu"><li id="menu-item-1520" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1520"><a href="http://discussion.mikado-themes.com/category/world/">Help</a></li>
                                <li id="menu-item-1519" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1519"><a href="http://discussion.mikado-themes.com/2016/02/">About</a></li>
                                <li id="menu-item-1517" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1517"><a href="http://discussion.mikado-themes.com/contact/">Contact Us</a></li>
                            </ul></div></div>

                    <?php echo do_shortcode('[mkd_verticalsep color="#E6E7E8" height="33" thickness="1" margin_left="0" margin_right="30"]'); ?>
                    <div class="user_login_container"><a href="#" class="user_login"><img src="/wp-content/themes/discussionwp/assets/img/user-login-icon.png"/><span>
                                <?php
//                                if (is_user_logged_in()) {
//                                    echo '<a href="' . wp_logout_url(home_url()) . ' ?>">Logout</a>';
//                                } else {
//                                    echo '<a href="' . esc_url(home_url()) . '/login">Login</a>';
//                                }
                                ?>
                            </span></a></div>-->


                    <?php if (is_active_sidebar('mkd-top-bar-right')) : ?>
                        <?php dynamic_sidebar('mkd-top-bar-right'); ?>
    <?php endif; ?>
                </div>
            </div>
        <?php if ($top_bar_in_grid) : ?>
            </div>
    <?php endif; ?>
    </div>

    <?php do_action('discussion_after_header_top'); ?>

<?php endif; ?>