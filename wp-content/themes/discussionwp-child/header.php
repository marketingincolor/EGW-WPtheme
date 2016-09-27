<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <?php
        /**
         * @see discussion_header_meta() - hooked with 10
         * @see mkd_user_scalable - hooked with 10
         */
        ?>
        <?php do_action('discussion_header_meta'); ?>

        <?php wp_head(); ?>
          <?php if(ENVIRONMENT_MODE==1){ ?>
        <script type="text/javascript">
            var _ss = _ss || [];
            _ss.push(['_setDomain', 'https://koi-3QMYANU21K.marketingautomation.services/net']);
            _ss.push(['_setAccount', 'KOI-3R4GIH0NK8']);
            _ss.push(['_trackPageView']);
            (function () {
                var ss = document.createElement('script');
                ss.type = 'text/javascript';
                ss.async = true;
                ss.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'koi-3QMYANU21K.marketingautomation.services/client/ss.js?ver=1.1.1';
                var scr = document.getElementsByTagName('script')[0];
                scr.parentNode.insertBefore(ss, scr);
            })();
        </script>
          <?php } ?>
    </head>
    <body <?php if (is_single()) {
            body_class('mkd-apsc-custom-style-enabled');
        } else {
            body_class();
        } ?> itemscope itemtype="http://schema.org/WebPage">
                <!-- Google Tag Manager -->
                <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-556TBH"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
                <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-556TBH');</script>
                <!-- End Google Tag Manager -->
                <?php discussion_get_side_area(); ?>
        <div class="mkd-wrapper">
            <div class="mkd-wrapper-inner">
                        <?php discussion_get_header(); ?>

                        <?php if (discussion_options()->getOptionValue('show_back_button') == "yes") { ?>
                    <a id='mkd-back-to-top'  href='#'>
                        <span class="mkd-icon-stack">
                            <?php
                            discussion_icon_collections()->getBackToTopIcon('font_elegant');
                            ?>
                        </span>
                        <span class="mkd-icon-stack-flip">
                    <?php
                    discussion_icon_collections()->getBackToTopIcon('font_elegant');
                    ?>
                        </span>
                    </a>
                        <?php } ?>

                <div class="mkd-content" <?php discussion_content_elem_style_attr(); ?>>
                    <div class="mkd-content-inner">
<?php discussion_get_content_top(); ?>