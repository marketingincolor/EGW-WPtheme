<?php
if(!function_exists('discussion_design_styles')) {
    /**
     * Generates general custom styles
     */
    function discussion_design_styles() {

		if (discussion_options()->getOptionValue('google_fonts')){
			$font_family = discussion_options()->getOptionValue('google_fonts');
			if(discussion_is_font_option_valid($font_family)) {

				$font_selector = array(
					'body',
					'#submit_comment',
					'.post-password-form input[type="submit"]',
					'input.wpcf7-form-control.wpcf7-submit',
					'div.pp_default .pp_nav p.currentTextHolder',
					'.mkd-drop-down .mkd-menu-wide .mkd-menu-second .mkd-menu-inner > ul > li > a',
					'.mkd-dropcaps',
					'.mkd-blog-audio-holder .mejs-container .mejs-controls > .mejs-time'
				);

				if (discussion_is_woocommerce_installed()){
					$woo_font_selector = array(
						'.mkd-woocommerce-page .woocommerce-result-count',
						'.mkd-single-product-summary .price',
						'.woocommerce.widget.widget_product_search input[type="submit"]',
						'.woocommerce-page .widget.widget_product_search input[type="submit"]',
						'.woocommerce.widget.widget_shopping_cart .widget_shopping_cart_content .total',
						'.woocommerce-page .widget.widget_shopping_cart .widget_shopping_cart_content .total'
					);

					$font_selector = array_merge($font_selector,$woo_font_selector);
				}
				echo discussion_dynamic_css($font_selector,array('font-family' => discussion_get_font_option_val($font_family)));
			}
		}

        if(discussion_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
            	'h1 a:hover',
            	'h2 a:hover',
            	'h3 a:hover',
            	'h4 a:hover',
            	'h5 a:hover',
            	'h6 a:hover',
            	'a:hover',
            	'p a:hover',
            	'.mkd-comment-holder .mkd-comment-info-and-links .mkd-comment-author-label',
            	'.mkd-comment-holder .mkd-comment-text .mkd-comment-date:before',
            	'.mkd-comment-holder .mkd-comment-links a:hover',
            	'.mkd-post-author-comment .mkd-comment-info .mkd-comment-author-label',
            	'.mkd-post-author-comment .mkd-comment-info .mkd-comment-mark',
            	'.mkd-post-author-comment .mkd-comment-text .mkd-text-holder:before',
            	'#submit_comment:hover',
            	'.post-password-form input[type="submit"]:hover',
            	'input.wpcf7-form-control.wpcf7-submit:hover',
            	'.mkd-sidebar #lang_sel a:hover',
            	'.wpb_widgetised_column #lang_sel a:hover',
            	'.mkd-drop-down .mkd-menu-wide .mkd-menu-second .mkd-menu-inner > ul > li > a .menu_icon_wrapper i',
            	'.mkd-drop-down .mkd-menu-wide .mkd-menu-second .mkd-menu-inner > ul > li > a:hover',
            	'.mkd-top-bar .widget.widget_nav_menu ul li a:hover',
            	'.mkd-mobile-header .mkd-mobile-nav a:hover',
            	'.mkd-mobile-header .mkd-mobile-nav h6:hover',
            	'footer .widget.widget_rss li a:hover',
            	'footer .widget.widget_tag_cloud a:hover',
            	'footer .widget.widget_mkd_twitter_widget li a:hover',
            	'footer .widget #submit_comment:hover',
            	'footer .widget .post-password-form input[type="submit"]:hover',
            	'footer .mkd-footer-bottom-holder .widget.widget_nav_menu ul li a:hover',
            	'.mkd-title .mkd-title-holder .mkd-breadcrumbs a:hover',
            	'aside.mkd-sidebar .widget a:hover h5',
            	'.wpb_widgetised_column .widget a:hover h5',
            	'aside.mkd-sidebar .widget.widget_rss .mkd-st-title a:hover',
            	'.wpb_widgetised_column .widget.widget_rss .mkd-st-title a:hover',
            	'aside.mkd-sidebar .widget.widget_rss li .rss-date',
            	'.wpb_widgetised_column .widget.widget_rss li .rss-date',
            	'aside.mkd-sidebar .widget.widget_pages ul li a:hover',
            	'aside.mkd-sidebar .widget.widget_archive ul li a:hover',
            	'aside.mkd-sidebar .widget.widget_categories ul li a:hover',
            	'aside.mkd-sidebar .widget.widget_meta ul li a:hover',
            	'aside.mkd-sidebar .widget.widget_recent_comments ul li a:hover',
            	'aside.mkd-sidebar .widget.widget_nav_menu ul li a:hover',
            	'.wpb_widgetised_column .widget.widget_pages ul li a:hover',
            	'.wpb_widgetised_column .widget.widget_archive ul li a:hover',
            	'.wpb_widgetised_column .widget.widget_categories ul li a:hover',
            	'.wpb_widgetised_column .widget.widget_meta ul li a:hover',
            	'.wpb_widgetised_column .widget.widget_recent_comments ul li a:hover',
            	'.wpb_widgetised_column .widget.widget_nav_menu ul li a:hover',
            	'aside.mkd-sidebar .widget.widget_tag_cloud a:hover',
            	'.wpb_widgetised_column .widget.widget_tag_cloud a:hover',
            	'.mkd-btn.mkd-btn-outline',
            	'.mkd-icon-shortcode .mkd-icon-element',
            	'.mkd-tabs .mkd-tabs-nav li.ui-state-active a',
            	'.mkd-tabs .mkd-tabs-nav li.ui-state-hover a',
            	'.mkd-evp-holder .mkd-evp-image-holder .mkd-evp-image-text .mkd-evp-bottom-holder .mkd-post-info-author a:hover',
            	'.mkd-evp-holder .mkd-evp-image-holder .mkd-evp-image-text .mkd-post-info-date a:before',
            	'.mkd-evp-holder .mkd-evp-image-holder .mkd-evp-image-text .mkd-post-info-date a:hover',
            	'.mkd-evp-holder .mkd-evp-image-holder .mkd-evp-image-text .mkd-post-info-date a:hover:before',
            	'.mkd-evp-holder .mkd-evp-video-holder .mkd-evp-video-close a',
            	'.mkd-ps-holder .mkd-post-item .mkd-ps-content .mkd-ps-title a:hover',
                '.mkd-ps-holder .mkd-post-item.mkd-item-hovered .mkd-ps-title a',
            	'.mkd-pswt-holder .mkd-pswt-slider .mkd-pswt-content .mkd-post-info-date a:before',
            	'.mkd-pswt-holder .mkd-pswt-slider .mkd-pswt-content .mkd-post-info-date a:hover',
            	'.mkd-pswt-holder .mkd-pswt-slider .mkd-pswt-content .mkd-post-info-date a:hover:before',
            	'.mkd-pswt-holder .flex-direction-nav li:hover a',
            	'.mkd-pswt-holder .mkd-pswt-thumb-slider .mkd-pswt-slide-thumb .mkd-pswt-thumb-content .mkd-post-info-date a:before',
            	'.mkd-pswt-holder .mkd-pswt-thumb-slider .mkd-pswt-slide-thumb .mkd-pswt-thumb-content .mkd-post-info-date a:hover',
            	'.mkd-pswt-holder .mkd-pswt-thumb-slider .mkd-pswt-slide-thumb .mkd-pswt-thumb-content .mkd-post-info-date a:hover:before',
                '.mkd-pswt-holder .mkd-pswt-thumb-slider .mkd-pswt-slide-thumb:hover .mkd-pswt-title',
            	'.mkd-psi-holder .mkd-psi-slide .mkd-post-info-date a:before',
            	'.mkd-psi-holder .mkd-psi-slide-thumb .mkd-post-info-date a:before',
            	'.mkd-psi-holder .mkd-psi-slide .mkd-post-info-date a:hover',
            	'.mkd-psi-holder .mkd-psi-slide .mkd-post-info-date a:hover:before',
            	'.mkd-psi-holder .mkd-psi-slide-thumb .mkd-post-info-date a:hover',
            	'.mkd-psi-holder .mkd-psi-slide-thumb .mkd-post-info-date a:hover:before',
            	'.mkd-psi-holder .mkd-psi-slider-thumb .mkd-psi-slide-thumb.slick-current h5',
            	'.mkd-post-item .mkd-post-info-date a:before',
            	'.mkd-post-item .mkd-post-info-date a:hover',
            	'.mkd-post-item .mkd-post-info-date a:hover:before',
            	'.mkd-post-item .mkd-pt-info-section > div > div a:hover',
            	'.mkd-pt-one-item.mkd-item-hovered .mkd-pt-one-title a',
            	'.mkd-pt-one-item .mkd-post-info-rating .mkd-post-info-rating-active',
            	'.mkd-pt-two-item .mkd-pt-two-content-holder .mkd-pt-info-section .mkd-post-info-comments:before',
            	'.mkd-pt-two-item .mkd-pt-two-content-holder .mkd-pt-info-section .mkd-post-info-count:before',
            	'.mkd-pt-two-item .mkd-pt-two-content-holder .mkd-pt-info-section .mkd-social-share-dropdown-opener:before',
            	'.mkd-pt-three-item .mkd-pt-three-content-holder .mkd-pt-info-section .mkd-post-info-comments:before',
            	'.mkd-pt-three-item .mkd-pt-three-content-holder .mkd-pt-info-section .mkd-social-share-dropdown-opener:before',
            	'.mkd-post-item.mkd-pt-five-item .mkd-pt-five-content .mkd-pt-five-title a:hover',
            	'.mkd-pt-six-item.mkd-item-hovered .mkd-pt-six-title a',
            	'.mkd-pt-six-item .mkd-pt-info-section div div .mkd-post-info-comments:before',
            	'.mkd-pt-six-item .mkd-pt-info-section div div .mkd-social-share-dropdown-opener:before',
            	'.mkd-pt-seven-item.mkd-item-hovered .mkd-pt-seven-title a',
            	'.mkd-pt-eight-item.mkd-item-hovered .mkd-pt-eight-title a',
            	'.mkd-pt-eight-item .mkd-btn:hover',
            	'.mkd-pt-nine-item.mkd-item-hovered .mkd-pt-nine-title a',
            	'.mkd-pt-nine-item .mkd-pt-nine-bottom-holder .mkd-post-info-author a:hover',
            	'.mkd-pb-two-holder .mkd-pb-two-non-featured .mkd-pt-four-item:hover .mkd-post-info-date a:before',
            	'.mkd-pb-two-holder .mkd-pb-two-non-featured .mkd-pt-four-item.mkd-reveal-nonf-active .mkd-post-info-date a:before',
            	'.mkd-blog-holder article.sticky .mkd-post-title a',
            	'.mkd-blog-holder.mkd-blog-type-standard article .mkd-post-info-date a:before',
            	'.mkd-blog-holder.mkd-blog-type-standard article .mkd-post-info-date a:hover',
            	'.mkd-blog-holder.mkd-blog-type-standard article .mkd-post-info-date a:hover:before',
            	'.mkd-single-tags-holder .mkd-tags a:hover',
            	'.mkd-blog-single-navigation .mkd-blog-single-prev a:hover h5',
            	'.mkd-blog-single-navigation .mkd-blog-single-prev a:hover .mkd-nav-arrows',
            	'.mkd-blog-single-navigation .mkd-blog-single-next a:hover h5',
            	'.mkd-blog-single-navigation .mkd-blog-single-next a:hover .mkd-nav-arrows',
            	'.mkd-ratings-holder .mkd-ratings-stars-holder .mkd-ratings-stars-inner > span.mkd-active-rating-star',
            	'.mkd-ratings-holder .mkd-ratings-stars-holder .mkd-ratings-stars-inner > span.mkd-hover-rating-star',
            	'.mkd-bn-holder ul.mkd-bn-slide .mkd-bn-text a:hover',
            	'.mkd-rpc-holder .mkd-rpc-inner ul li .mkd-rpc-number-holder.mkd-hovered',
            	'.mkd-rpc-holder .mkd-rpc-inner ul li .mkd-rpc-date:before',
            	'.mkd-rpc-holder .mkd-rpc-inner ul li .mkd-rpc-date:hover, .mkd-rpc-holder .mkd-rpc-inner ul li .mkd-rpc-date:hover:before',
            	'.mkd-top-bar .mkd-social-icon-widget-holder:hover',
            	'.mkd-footer-bottom-holder .mkd-social-icon-widget-holder:hover',
            	'.mkd-twitter-widget li .mkd-tweet-text a',
            	'.mkd-twitter-widget li .mkd-tweet-text a.mkd-tweet-time:hover',
            	'.mkd-side-menu .widget.widget_rss li a:hover',
            	'.mkd-side-menu .widget.widget_tag_cloud a:hover',
            	'.mkd-side-menu .widget.widget_mkd_twitter_widget li a:hover',
            	'.mkd-related-posts-holder .mkd-related-content .mkd-related-title a:hover',
            	'.mkd-image-with-hover-info-item .mkd-hover-holder .mkd-hover-holder-inner .mkd-hover-content .mkd-hover-content-inner .mkd-image-description-add',
            	'.slick-arrow:hover:before',
            	'.mkd-pc-holder .flex-direction-nav a:hover',
            	'.mkd-ps-holder .flex-direction-nav a:hover',
            	'.mkd-post-pag-np-horizontal .mkd-bnl-navigation-holder .mkd-bnl-nav-icon.mkd-bnl-nav-prev',
            	'.mkd-blog-gallery .mkd-pg-slider .flex-direction-nav li a:hover'
            );


            $color_important_selector = array(
            	'.mkd-pt-two-item.mkd-item-hovered .mkd-pt-two-title',
            	'.mkd-pt-three-item.mkd-item-hovered .mkd-pt-three-title'
            );

            $background_color_selector = array(
            	'blockquote:before',
            	'.wpcf7-form .mkd-newsletter .mkd-column2 .wpcf7-submit',
            	'.mkd-pagination ul li a:hover',
            	'.mkd-pagination ul li.active span',
            	'#mkd-back-to-top > span',
            	'.mkd-main-menu > ul > li.mkd-active-item > a',
            	'.mkd-drop-down .mkd-menu-second .mkd-menu-inner ul li:hover',
            	'.mkd-drop-down .mkd-menu-wide .mkd-menu-second .mkd-menu-inner ul li ul li:hover',
            	'.mkd-search-opener:hover',
            	'.mkd-search-opener.mkd-active',
            	'.mkd-search-widget-holder .mkd-search-submit',
            	'footer .widget #wp-calendar td#today',
            	'footer .widget.widget_search input[type="submit"]',
            	'.mkd-search-page-holder .mkd-search-page-form .mkd-form-holder .mkd-search-submit',
            	'aside.mkd-sidebar .widget #wp-calendar td#today',
            	'.wpb_widgetised_column .widget #wp-calendar td#today',
            	'aside.mkd-sidebar .widget.widget_search input[type="submit"]',
            	'.wpb_widgetised_column .widget.widget_search input[type="submit"]',
            	'.mkd-btn.mkd-btn-solid',
            	'.mkd-icon-shortcode.circle',
            	'.mkd-icon-shortcode.square',
            	'.mkd-icon-shortcode.landscape',
            	'.wpb_gallery_slides.wpb_flexslider .flex-control-nav li a:hover',
            	'.wpb_gallery_slides.wpb_flexslider .flex-control-nav li a.flex-active',
            	'.mkd-section-title-holder .mkd-st-title',
            	'.mkd-social-share-holder.mkd-list ul li a.mkd-share-link:hover',
            	'.mkd-evp-holder .mkd-evp-image-holder .mkd-evp-image-text .mkd-post-info-category:before',
            	'.mkd-ps-holder .flex-control-paging > li a:hover',
            	'.mkd-ps-holder .flex-control-paging > li a.flex-active',
            	'.mkd-pswt-holder .mkd-pswt-slider .mkd-pswt-content .mkd-post-info-category:before',
            	'.mkd-pswt-holder .mkd-pswt-slider .mkd-pswt-content .mkd-pt-info-section',
            	'.mkd-psi-holder .mkd-psi-slider .mkd-psi-content .mkd-post-info-category:before',
            	'.mkd-psi-holder .mkd-psi-slider .mkd-psi-content .mkd-pt-info-section',
            	'.mkd-psi-holder .mkd-psi-slider-thumb .mkd-psi-slide-thumb:hover',
            	'.mkd-pc-holder .flex-control-paging > li a:hover',
            	'.mkd-pc-holder .flex-control-paging > li a.flex-active',
            	'.mkd-post-item .mkd-post-info-category:before',
            	'.mkd-post-item .mkd-social-share-holder .mkd-social-share-dropdown-opener',
            	'.mkd-pt-one-item .mkd-pt-info-section',
            	'.mkd-post-item.mkd-pt-five-item .mkd-pt-five-content .mkd-pt-info-section',
            	'.mkd-pt-six-item .mkd-pt-info-section .mkd-pt-info-section-background',
            	'.mkd-pb-four-holder .mkd-bnl-outer .mkd-bnl-inner > .mkd-pb-four-non-featured .mkd-hide-show-button',
            	'.mkd-blog-holder article .mkd-post-content-inner > .mkd-post-info-category:before',
            	'.mkd-blog-holder article .mkd-post-image-holder > .mkd-post-info-category:before',
            	'.mkd-blog-holder article .mkd-post-info',
            	'.mkd-blog-holder article .mkd-social-share-holder .mkd-social-share-dropdown-opener',
            	'.mkd-blog-holder.mkd-blog-single article .mkd-post-image-area .mkd-post-info-category:before',
            	'.mkd-blog-holder.mkd-blog-single article .mkd-post-info',
            	'.mkd-author-description .mkd-author-description-image .mkd-author-name',
            	'.mkd-single-links-pages .mkd-single-links-pages-inner > span',
            	'.mkd-single-links-pages .mkd-single-links-pages-inner > a:hover',
            	'.mkd-main-menu ul li .mkd-plw-tabs .mkd-plw-tabs-tab:hover',
            	'.mkd-side-menu-button-opener:hover',
            	'.mkd-side-menu-button-opener.opened',
            	'.mkd-side-menu .widget #wp-calendar td#today',
            	'.mkd-side-menu .widget.widget_search input[type="submit"]',
            	'.mkd-side-menu .widget.widget_pages ul li a:hover:before',
            	'.mkd-side-menu .widget.widget_meta ul li a:hover:before',
            	'.mkd-side-menu .widget.widget_nav_menu ul li a:hover:before',
            	'.mkd-pswt-holder .mkd-pswt-slider .mkd-pswt-content .mkd-social-share-holder .mkd-social-share-dropdown-opener',
            	'.mkd-psi-holder .mkd-psi-slider .mkd-psi-content .mkd-social-share-holder .mkd-social-share-dropdown-opener',
                  '.mkd-post-ajax-preloader .mkd-pulse'
            );

            $background_color_important_selector = array(
            	'.mkd-btn.mkd-btn-outline:not(.mkd-btn-custom-hover-bg):hover',
                  'footer .widget input.wpcf7-form-control.wpcf7-submit:hover'
            );
    
            $border_color_selector = array(
            	'.mkd-drop-down .mkd-menu-second .mkd-menu-inner ul li:hover',
            	'.mkd-search-widget-holder .mkd-search-field:focus',
            	'.mkd-search-page-holder .mkd-search-page-form .mkd-form-holder .mkd-search-field:focus',
            	'.mkd-btn.mkd-btn-outline',
            	'.mkd-main-menu ul li .mkd-plw-tabs .mkd-plw-tabs-tab:hover'
            );

            $border_left_color_selector = array(
            	'.mkd-pb-four-holder .mkd-pb-four-non-featured .mkd-pb-item-row'
            );

            $border_color_important_selector = array(
            	'.mkd-btn.mkd-btn-outline:not(.mkd-btn-custom-border-hover):hover'
            );



            $woo_color_selector = array();
            $woo_background_color_selector = array();
            $woo_background_color_important_selector = array();

            if(discussion_is_woocommerce_installed()) {
                $woo_color_selector = array(
                	'.woocommerce .mkd-product-info-holder .price',
                	'.woocommerce .mkd-product-info-holder .mkd-btn .mkd-btn-icon-element',
                	'.woocommerce .star-rating span',
                	'.mkd-single-product-summary .price',
                	'.mkd-woocommerce-single-page .mkd-single-product-summary .cart .single_add_to_cart_button:after',
                	'.mkd-single-product-summary .product_meta span a:hover',
                	'.mkd-single-product-summary .mkd-social-share-holder.mkd-dropdown .mkd-social-share-dropdown-opener:hover',
                	'.mkd-single-product-summary .mkd-social-share-holder.mkd-dropdown .mkd-social-share-dropdown-opener:before',
                	'.mkd-woocommerce-page.mkd-woocommerce-single-page .comment-respond .stars a.active:after',
                	'.mkd-shopping-cart-dropdown ul li a:hover',
                	'.mkd-shopping-cart-dropdown .mkd-cart-bottom .mkd-total-amount span',
                	'.mkd-woocommerce-page .woocommerce-info .showcoupon:hover',
                	'.mkd-woocommerce-page .mkd-content input[type="submit"]:hover',
                	'.mkd-woocommerce-page table.cart tr.cart_item td.product-name a:hover',
                	'.mkd-woocommerce-page table.cart tr.cart_item td.product-remove a:hover',
                	'.woocommerce-page .widget.widget_products ul li .mkd-widget-product-holder .amount',
                	'.woocommerce-page .widget.widget_recent_reviews ul li .mkd-widget-product-holder .amount',
                	'.woocommerce-page .widget.widget_recently_viewed_products ul li .mkd-widget-product-holder .amount',
                	'.woocommerce-page .widget.widget_top_rated_products ul li .mkd-widget-product-holder .amount',
                	'.woocommerce-page .widget.widget_products ul li ins',
                	'.woocommerce-page .widget.widget_recent_reviews ul li ins',
                	'.woocommerce-page .widget.widget_recently_viewed_products ul li ins',
                	'.woocommerce-page .widget.widget_top_rated_products ul li ins',
                	'.woocommerce-page .widget.widget_product_tag_cloud a:hover',
                	'.woocommerce-page .widget.widget_price_filter .button:after',
                	'.woocommerce-page .widget.widget_product_categories ul li a:hover',
                	'.woocommerce-page .widget.widget_shopping_cart .widget_shopping_cart_content .quantity',
                	'.woocommerce-page .widget.widget_shopping_cart .widget_shopping_cart_content .total .amount',
                	'.woocommerce-page .widget.widget_shopping_cart .widget_shopping_cart_content .buttons a:hover',
                	'.select2-container .select2-choice:hover'
                );

                $woo_background_color_selector = array(
                	'.woocommerce .mkd-onsale:before',
                	'.woocommerce .mkd-out-of-stock:before',
                	'.woocommerce-pagination .page-numbers li span.current',
                	'.woocommerce-pagination .page-numbers li a:hover',
                	'.woocommerce-pagination .page-numbers li span:hover',
                	'.woocommerce-pagination .page-numbers li span.current:hover',
                	'.mkd-woocommerce-page.mkd-woocommerce-single-page .woocommerce-tabs ul.tabs > li:hover a',
                	'.mkd-woocommerce-page.mkd-woocommerce-single-page .woocommerce-tabs ul.tabs > li.active a',
                	'.mkd-shopping-cart-outer:hover',
                	'.mkd-woocommerce-page .mkd-content .mkd-quantity-buttons .mkd-quantity-minus:hover',
                	'.mkd-woocommerce-page .mkd-content .mkd-quantity-buttons .mkd-quantity-plus:hover',
                	'.mkd-woocommerce-page .woocommerce-message a.button.wc-forward',
                	'.woocommerce a.added_to_cart:hover',
                	'.mkd-woocommerce-page a.button.checkout-button',
                	'.woocommerce-page .widget.widget_price_filter .ui-slider .ui-slider-handle',
                	'.woocommerce-page .widget.widget_price_filter .ui-slider-horizontal .ui-slider-range',
                	'.woocommerce-page .widget.widget_price_filter .button:hover',
                	'.woocommerce-page .widget.widget_product_search input[type="submit"]',
                	'.select2-drop .select2-results .select2-highlighted',
                	'.select2-container .select2-choice .select2-arrow'
                );

                $woo_background_color_important_selector = array(
                	'.mkd-shopping-cart-dropdown .mkd-cart-bottom .view-cart:hover'
            	);
            }


            $color_selector = array_merge($color_selector, $woo_color_selector);
            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);
            $background_color_important_selector = array_merge($background_color_important_selector, $woo_background_color_important_selector);

            echo discussion_dynamic_css('::selection', array('background' => discussion_options()->getOptionValue('first_color')));
            echo discussion_dynamic_css('::-moz-selection', array('background' => discussion_options()->getOptionValue('first_color')));
            echo discussion_dynamic_css($color_selector, array('color' => discussion_options()->getOptionValue('first_color')));
            echo discussion_dynamic_css($color_important_selector, array('color' => discussion_options()->getOptionValue('first_color').'!important'));
            echo discussion_dynamic_css($background_color_selector, array('background-color' => discussion_options()->getOptionValue('first_color')));
            echo discussion_dynamic_css($background_color_important_selector, array('background-color' => discussion_options()->getOptionValue('first_color').'!important'));
            echo discussion_dynamic_css($border_color_selector, array('border-color' => discussion_options()->getOptionValue('first_color')));
            echo discussion_dynamic_css($border_left_color_selector, array('border-left-color' => discussion_options()->getOptionValue('first_color')));
            echo discussion_dynamic_css($border_color_important_selector, array('border-color' => discussion_options()->getOptionValue('first_color').'!important'));
        }

		if (discussion_options()->getOptionValue('page_background_color')) {
			$background_color_selector = array(
				'.mkd-wrapper-inner',
				'.mkd-content',
                '.mkd-boxed .mkd-wrapper .mkd-wrapper-inner',
                '.mkd-boxed .mkd-wrapper .mkd-content'
			);
			echo discussion_dynamic_css($background_color_selector, array('background-color' => discussion_options()->getOptionValue('page_background_color')));
		}

		if (discussion_options()->getOptionValue('selection_color')) {
			echo discussion_dynamic_css('::selection', array('background' => discussion_options()->getOptionValue('selection_color')));
			echo discussion_dynamic_css('::-moz-selection', array('background' => discussion_options()->getOptionValue('selection_color')));
		}

		$boxed_background_style = array();
		if (discussion_options()->getOptionValue('page_background_color_in_box')) {
			$boxed_background_style['background-color'] = discussion_options()->getOptionValue('page_background_color_in_box');
		}

		if (discussion_options()->getOptionValue('boxed_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(discussion_options()->getOptionValue('boxed_background_image')).')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat'] = 'no-repeat';
		}

		if (discussion_options()->getOptionValue('boxed_pattern_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(discussion_options()->getOptionValue('boxed_pattern_background_image')).')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat'] = 'repeat';
		}

		if (discussion_options()->getOptionValue('boxed_background_image_attachment')) {
			$boxed_background_style['background-attachment'] = (discussion_options()->getOptionValue('boxed_background_image_attachment'));
            if(discussion_options()->getOptionValue('boxed_background_image_attachment') == 'fixed'){
                $boxed_background_style['background-size'] = 'cover';
            }
		}

		echo discussion_dynamic_css('.mkd-boxed', $boxed_background_style);
    }

    add_action('discussion_style_dynamic', 'discussion_design_styles');
}


if(!function_exists('discussion_content_styles')) {
    /**
     * Generates content custom styles
     */
    function discussion_content_styles() {

        $content_style = array();
        if (discussion_options()->getOptionValue('content_top_padding') !== '') {
            $padding_top = (discussion_options()->getOptionValue('content_top_padding'));
            $content_style['padding-top'] = discussion_filter_px($padding_top).'px';
        }

        $content_selector = array(
            '.mkd-content .mkd-content-inner > .mkd-full-width > .mkd-full-width-inner',
        );

        echo discussion_dynamic_css($content_selector, $content_style);

        $content_style_in_grid = array();
        if (discussion_options()->getOptionValue('content_top_padding_in_grid') !== '') {
            $padding_top_in_grid = (discussion_options()->getOptionValue('content_top_padding_in_grid'));
            $content_style_in_grid['padding-top'] = discussion_filter_px($padding_top_in_grid).'px';

        }

        $content_selector_in_grid = array(
            '.mkd-content .mkd-content-inner > .mkd-container > .mkd-container-inner',
        );

        echo discussion_dynamic_css($content_selector_in_grid, $content_style_in_grid);

    }

    add_action('discussion_style_dynamic', 'discussion_content_styles');
}


if (!function_exists('discussion_h1_styles')) {

    function discussion_h1_styles() {

        $h1_styles = array();

        if(discussion_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = discussion_options()->getOptionValue('h1_color');
        }
        if(discussion_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = discussion_get_formatted_font_family(discussion_options()->getOptionValue('h1_google_fonts'));
        }
        if(discussion_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h1_fontsize')).'px';
        }
        if(discussion_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h1_lineheight')).'px';
        }
        if(discussion_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = discussion_options()->getOptionValue('h1_texttransform');
        }
        if(discussion_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = discussion_options()->getOptionValue('h1_fontstyle');
        }
        if(discussion_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = discussion_options()->getOptionValue('h1_fontweight');
        }
        if(discussion_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = discussion_filter_px(discussion_options()->getOptionValue('h1_letterspacing')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo discussion_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('discussion_style_dynamic', 'discussion_h1_styles');
}

if (!function_exists('discussion_h2_styles')) {

    function discussion_h2_styles() {

        $h2_styles = array();

        if(discussion_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = discussion_options()->getOptionValue('h2_color');
        }
        if(discussion_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = discussion_get_formatted_font_family(discussion_options()->getOptionValue('h2_google_fonts'));
        }
        if(discussion_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h2_fontsize')).'px';
        }
        if(discussion_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h2_lineheight')).'px';
        }
        if(discussion_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = discussion_options()->getOptionValue('h2_texttransform');
        }
        if(discussion_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = discussion_options()->getOptionValue('h2_fontstyle');
        }
        if(discussion_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = discussion_options()->getOptionValue('h2_fontweight');
        }
        if(discussion_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = discussion_filter_px(discussion_options()->getOptionValue('h2_letterspacing')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo discussion_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('discussion_style_dynamic', 'discussion_h2_styles');
}

if (!function_exists('discussion_h3_styles')) {

    function discussion_h3_styles() {

        $h3_styles = array();

        if(discussion_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = discussion_options()->getOptionValue('h3_color');
        }
        if(discussion_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = discussion_get_formatted_font_family(discussion_options()->getOptionValue('h3_google_fonts'));
        }
        if(discussion_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h3_fontsize')).'px';
        }
        if(discussion_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h3_lineheight')).'px';
        }
        if(discussion_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = discussion_options()->getOptionValue('h3_texttransform');
        }
        if(discussion_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = discussion_options()->getOptionValue('h3_fontstyle');
        }
        if(discussion_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = discussion_options()->getOptionValue('h3_fontweight');
        }
        if(discussion_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = discussion_filter_px(discussion_options()->getOptionValue('h3_letterspacing')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo discussion_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('discussion_style_dynamic', 'discussion_h3_styles');
}

if (!function_exists('discussion_h4_styles')) {

    function discussion_h4_styles() {

        $h4_styles = array();

        if(discussion_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = discussion_options()->getOptionValue('h4_color');
        }
        if(discussion_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = discussion_get_formatted_font_family(discussion_options()->getOptionValue('h4_google_fonts'));
        }
        if(discussion_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h4_fontsize')).'px';
        }
        if(discussion_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h4_lineheight')).'px';
        }
        if(discussion_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = discussion_options()->getOptionValue('h4_texttransform');
        }
        if(discussion_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = discussion_options()->getOptionValue('h4_fontstyle');
        }
        if(discussion_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = discussion_options()->getOptionValue('h4_fontweight');
        }
        if(discussion_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = discussion_filter_px(discussion_options()->getOptionValue('h4_letterspacing')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if (!empty($h4_styles)) {
            echo discussion_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('discussion_style_dynamic', 'discussion_h4_styles');
}

if (!function_exists('discussion_h5_styles')) {

    function discussion_h5_styles() {

        $h5_styles = array();

        if(discussion_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = discussion_options()->getOptionValue('h5_color');
        }
        if(discussion_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = discussion_get_formatted_font_family(discussion_options()->getOptionValue('h5_google_fonts'));
        }
        if(discussion_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h5_fontsize')).'px';
        }
        if(discussion_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h5_lineheight')).'px';
        }
        if(discussion_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = discussion_options()->getOptionValue('h5_texttransform');
        }
        if(discussion_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = discussion_options()->getOptionValue('h5_fontstyle');
        }
        if(discussion_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = discussion_options()->getOptionValue('h5_fontweight');
        }
        if(discussion_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = discussion_filter_px(discussion_options()->getOptionValue('h5_letterspacing')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo discussion_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('discussion_style_dynamic', 'discussion_h5_styles');
}

if (!function_exists('discussion_h6_styles')) {

    function discussion_h6_styles() {

        $h6_styles = array();

        if(discussion_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = discussion_options()->getOptionValue('h6_color');
        }
        if(discussion_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = discussion_get_formatted_font_family(discussion_options()->getOptionValue('h6_google_fonts'));
        }
        if(discussion_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('h6_fontsize')).'px';
        }
        if(discussion_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('h6_lineheight')).'px';
        }
        if(discussion_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = discussion_options()->getOptionValue('h6_texttransform');
        }
        if(discussion_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = discussion_options()->getOptionValue('h6_fontstyle');
        }
        if(discussion_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = discussion_options()->getOptionValue('h6_fontweight');
        }
        if(discussion_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = discussion_filter_px(discussion_options()->getOptionValue('h6_letterspacing')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo discussion_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('discussion_style_dynamic', 'discussion_h6_styles');
}

if (!function_exists('discussion_text_styles')) {

    function discussion_text_styles() {

        $text_styles = array();

        if(discussion_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = discussion_options()->getOptionValue('text_color');
        }
        if(discussion_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = discussion_get_formatted_font_family(discussion_options()->getOptionValue('text_google_fonts'));
			$text_fonts_selector = array(
				'.wpb_text_column ol li',
				'.wpb_text_column ul li',
				'.wpcf7-form-control.wpcf7-text',
				'.wpcf7-form-control.wpcf7-number',
				'.wpcf7-form-control.wpcf7-date',
				'.wpcf7-form-control.wpcf7-textarea',
				'.wpcf7-form-control.wpcf7-select',
				'.wpcf7-form-control.wpcf7-quiz',
				'#respond textarea',
				'#respond input[type="text"]',
				'.post-password-form input[type="password"]',
				'.mkd-drop-down .mkd-menu-second .mkd-menu-inner ul li > a',
				'.mkd-search-widget-holder .mkd-search-field',
				'.mkd-top-bar',
				'footer .widget select',
				'footer .widget.widget_search input',
				'footer .mkd-footer-bottom-holder .widget.widget_nav_menu ul li a',
				'.mkd-title .mkd-title-holder .mkd-breadcrumbs a',
				'.mkd-title .mkd-title-holder .mkd-breadcrumbs span',
				'.mkd-search-page-holder .mkd-search-page-form .mkd-form-holder .mkd-search-field',
				'aside.mkd-sidebar .widget select',
				'.wpb_widgetised_column .widget select',
				'aside.mkd-sidebar .widget.widget_search input',
				'.wpb_widgetised_column .widget.widget_search input',
				'.mkd-ordered-list ol li',
				'.mkd-ordered-list ul li',
				'.mkd-image-with-hover-info-item .mkd-hover-holder .mkd-hover-holder-inner .mkd-hover-content .mkd-hover-content-inner .mkd-image-description-add',
				'.mkd-image-with-hover-info-item .mkd-hover-holder .mkd-hover-holder-inner .mkd-hover-content .mkd-hover-content-inner .mkd-image-title',
				'.mkd-author-description .mkd-author-email',
				'.mkd-ratings-holder .mkd-rating-message',
				'.mkd-ratings-holder .mkd-rating-value',
				'.mkd-bn-holder ul.mkd-bn-slide .mkd-bn-text a',
				'.mkd-main-menu ul li .mkd-plw-tabs .mkd-plw-tabs-tab',
				'.mkd-side-menu .widget select',
				'.mkd-side-menu .widget.widget_search input'
			);

			if (discussion_is_woocommerce_installed()){
				$woo_fonts_selector = array(
					'.mkd-shopping-cart-dropdown .mkd-empty-cart',
					'.mkd-woocommerce-page .mkd-content .mkd-quantity-buttons .mkd-quantity-input',
					'.woocommerce.widget.widget_price_filter .price_label',
					'.woocommerce-page .widget.widget_price_filter .price_label',
					'.woocommerce.widget.widget_product_search input',
					'.woocommerce-page .widget.widget_product_search input',
					'.select2-container .select2-choice'
				);

				$text_fonts_selector = array_merge($text_fonts_selector,$woo_fonts_selector);
			}
			echo discussion_dynamic_css($text_fonts_selector,array('font-family' => $text_styles['font-family']));
        }
        if(discussion_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('text_fontsize')).'px';
        }
        if(discussion_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('text_lineheight')).'px';
        }
        if(discussion_options()->getOptionValue('text_texttransform') !== '') {
            $text_styles['text-transform'] = discussion_options()->getOptionValue('text_texttransform');
        }
        if(discussion_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = discussion_options()->getOptionValue('text_fontstyle');
        }
        if(discussion_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = discussion_options()->getOptionValue('text_fontweight');
        }
        if(discussion_options()->getOptionValue('text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = discussion_filter_px(discussion_options()->getOptionValue('text_letterspacing')).'px';
        }

        $text_selector = array(
            'p'
        );

        if (!empty($text_styles)) {
            echo discussion_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('discussion_style_dynamic', 'discussion_text_styles');
}

if (!function_exists('discussion_boxy_text_styles')) {

    function discussion_boxy_text_styles() {

        $text_styles = array();

        if(discussion_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = discussion_options()->getOptionValue('text_color');
        }
        if(discussion_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = discussion_filter_px(discussion_options()->getOptionValue('text_fontsize')).'px';
        }
        if(discussion_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = discussion_filter_px(discussion_options()->getOptionValue('text_lineheight')).'px';
        }
        if(discussion_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = discussion_options()->getOptionValue('text_fontweight');
        }

        $text_selector = array(
            'body'
        );

        if (!empty($text_styles)) {
            echo discussion_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('discussion_style_dynamic', 'discussion_boxy_text_styles');
}

if (!function_exists('discussion_link_styles')) {

    function discussion_link_styles() {

        $link_styles = array();

        if(discussion_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = discussion_options()->getOptionValue('link_color');
        }
        if(discussion_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = discussion_options()->getOptionValue('link_fontstyle');
        }
        if(discussion_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = discussion_options()->getOptionValue('link_fontweight');
        }
        if(discussion_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = discussion_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo discussion_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('discussion_style_dynamic', 'discussion_link_styles');
}

if (!function_exists('discussion_link_hover_styles')) {

    function discussion_link_hover_styles() {

        $link_hover_styles = array();

        if(discussion_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = discussion_options()->getOptionValue('link_hovercolor');
        }
        if(discussion_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = discussion_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo discussion_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(discussion_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = discussion_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if (!empty($link_heading_hover_styles)) {
            echo discussion_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('discussion_style_dynamic', 'discussion_link_hover_styles');
}

if (!function_exists('discussion_sidebar_styles')) {

    function discussion_sidebar_styles() {

        $sidebar_styles = array();

        if(discussion_options()->getOptionValue('sidebar_background_color') !== '') {
            $sidebar_styles['background-color'] = discussion_options()->getOptionValue('sidebar_background_color');
        }

        if(discussion_options()->getOptionValue('sidebar_padding_top') !== '') {
            $sidebar_styles['padding-top'] = discussion_filter_px(discussion_options()->getOptionValue('sidebar_padding_top')).'px';
        }

        if(discussion_options()->getOptionValue('sidebar_padding_right') !== '') {
            $sidebar_styles['padding-right'] = discussion_filter_px(discussion_options()->getOptionValue('sidebar_padding_right')).'px';
        }

        if(discussion_options()->getOptionValue('sidebar_padding_bottom') !== '') {
            $sidebar_styles['padding-bottom'] = discussion_filter_px(discussion_options()->getOptionValue('sidebar_padding_bottom')).'px';
        }

        if(discussion_options()->getOptionValue('sidebar_padding_left') !== '') {
            $sidebar_styles['padding-left'] = discussion_filter_px(discussion_options()->getOptionValue('sidebar_padding_left')).'px';
        }

        if(discussion_options()->getOptionValue('sidebar_alignment') !== '') {
            $sidebar_styles['text-align'] = discussion_options()->getOptionValue('sidebar_alignment');
        }

        if (!empty($sidebar_styles)) {
            echo discussion_dynamic_css('aside.mkd-sidebar', $sidebar_styles);
        }
    }

    add_action('discussion_style_dynamic', 'discussion_sidebar_styles');
}