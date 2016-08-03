(function($) {
    "use strict";

    window.mkd = {};
    mkd.modules = {};

    mkd.scroll = 0;
    mkd.window = $(window);
    mkd.document = $(document);
    mkd.windowWidth = $(window).width();
    mkd.windowHeight = $(window).height();
    mkd.body = $('body');
    mkd.html = $('html, body');
    mkd.menuDropdownHeightSet = false;
    mkd.defaultHeaderStyle = '';
    mkd.minVideoWidth = 1500;
    mkd.videoWidthOriginal = 1280;
    mkd.videoHeightOriginal = 720;
    mkd.videoRatio = 1.61; // golden ration for video
    mkd.boxedLayoutWidth = 1280;
    
    $(document).ready(function(){
        mkd.scroll = $(window).scrollTop();
    });


    $(window).resize(function() {
        mkd.windowWidth = $(window).width();
        mkd.windowHeight = $(window).height();
    });


    $(window).scroll(function(){
        mkd.scroll = $(window).scrollTop();
    });

})(jQuery);
(function($) {
	"use strict";

    var common = {};
    mkd.modules.common = common;

    common.mkdIsTouchDevice = mkdIsTouchDevice;
    common.mkdDisableSmoothScrollForMac = mkdDisableSmoothScrollForMac;
    common.mkdInitAudioPlayer = mkdInitAudioPlayer;
    common.mkdPostGallerySlider = mkdPostGallerySlider;
    common.mkdFluidVideo = mkdFluidVideo;
    common.mkdPreloadBackgrounds = mkdPreloadBackgrounds;
    common.mkdEnableScroll = mkdEnableScroll;
    common.mkdDisableScroll = mkdDisableScroll;
    common.mkdWheel = mkdWheel;
    common.mkdKeydown = mkdKeydown;
    common.mkdPreventDefaultValue = mkdPreventDefaultValue;
    common.mkdInitSelfHostedVideoPlayer = mkdInitSelfHostedVideoPlayer;
    common.mkdSelfHostedVideoSize = mkdSelfHostedVideoSize;
    common.mkdInitBackToTop = mkdInitBackToTop;
    common.mkdBackButtonShowHide = mkdBackButtonShowHide;
    common.mkdInitParallax = mkdInitParallax;

	$(document).ready(function() {
        mkdIsTouchDevice();
        mkdDisableSmoothScrollForMac();
        mkdInitAudioPlayer();
		mkdFluidVideo();
        mkdPostGallerySlider();
        mkdPreloadBackgrounds();
        mkdInitElementsAnimations();
        mkdInitAnchor().init();
        mkdInitVideoBackground();
        mkdInitVideoBackgroundSize();
        mkdInitSelfHostedVideoPlayer();
		mkdSelfHostedVideoSize();
        mkdInitBackToTop();
        mkdBackButtonShowHide();
        mkdPostRatings().init();
        mkdWidgetIcons();
	});

    $(window).resize(function() {
		mkdInitVideoBackgroundSize();
		mkdSelfHostedVideoSize();
	});

    $(window).load(function() {
		mkdInitParallax();
	});

    /*
     ** Disable shortcodes animation on appear for touch devices
     */
    function mkdIsTouchDevice() {
        if(Modernizr.touch && !mkd.body.hasClass('mkd-no-animations-on-touch')) {
            mkd.body.addClass('mkd-no-animations-on-touch');
        }
    }

    /*
     ** Disable smooth scroll for mac if smooth scroll is enabled
     */
    function mkdDisableSmoothScrollForMac() {
        var os = navigator.appVersion.toLowerCase();

        if (os.indexOf('mac') > -1 && mkd.body.hasClass('mkd-smooth-scroll')) {
            mkd.body.removeClass('mkd-smooth-scroll');
        }
    }

	function mkdFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

    function mkdInitAudioPlayer() {

        var players = $('audio.mkd-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    /*
    **  Init gallery post slider 
    */
    function mkdPostGallerySlider(){

        var bsHolder = $('.mkd-pg-slider');

        if(bsHolder.length){
            bsHolder.each(function(){
                var thisBsHolder = $(this);

                thisBsHolder.flexslider({
                    selector: ".mkd-pg-slides",
                    animation: "fade",
                    controlNav: false,
                    directionNav: true,
                    prevText: "<span class='ion-ios-arrow-left'></span>",
                    nextText: "<span class='ion-ios-arrow-right'></span>",
                    slideshowSpeed: 6000,
                    animationSpeed: 400,  
                });
            });
        }
    }

    /*
     *	Preload background images for elements that have 'mkd-preload-background' class
     */
    function mkdPreloadBackgrounds(){

        $(".mkd-preload-background").each(function() {
            var preloadBackground = $(this);
            if(preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") != "none") {

                var bgUrl = preloadBackground.attr('style');

                bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
                bgUrl = bgUrl ? bgUrl[1] : "";

                if (bgUrl) {
                    var backImg = new Image();
                    backImg.src = bgUrl;
                    $(backImg).load(function(){
                        preloadBackground.removeClass('mkd-preload-background');
                    });
                }
            }else{
                $(window).load(function(){ preloadBackground.removeClass('mkd-preload-background'); }); //make sure that mkd-preload-background class is removed from elements with forced background none in css
            }
        });
    }

    /*
     *	Start animations on elements
     */
    function mkdInitElementsAnimations(){

        var touchClass = $('.mkd-no-animations-on-touch'),
            noAnimationsOnTouch = true,
            elements = $('.mkd-grow-in, .mkd-fade-in-down, .mkd-element-from-fade, .mkd-element-from-left, .mkd-element-from-right, .mkd-element-from-top, .mkd-element-from-bottom, .mkd-flip-in, .mkd-x-rotate, .mkd-z-rotate, .mkd-y-translate, .mkd-fade-in, .mkd-fade-in-left-x-rotate'),
            clasess,
            animationClass;

        if (touchClass.length) {
            noAnimationsOnTouch = false;
        }

        if(elements.length > 0 && noAnimationsOnTouch){
            elements.each(function(){
                var element = $(this);

                clasess = element.attr('class').split(/\s+/);
                animationClass = clasess[1];

                element.appear(function() {
                    element.addClass(animationClass+'-on');
                },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
            });
        }
    }

    /*
     **	Anchor functionality
     */
    var mkdInitAnchor = mkd.modules.common.mkdInitAnchor = function() {

        /**
         * Set active state on clicked anchor
         * @param anchor, clicked anchor
         */
        var setActiveState = function(anchor){

            $('.mkd-main-menu .mkd-active-item, .mkd-mobile-nav .mkd-active-item, .mkd-vertical-menu .mkd-active-item, .mkd-fullscreen-menu .mkd-active-item').removeClass('mkd-active-item');
            anchor.parent().addClass('mkd-active-item');

            $('.mkd-main-menu a, .mkd-mobile-nav a, .mkd-vertical-menu a, .mkd-fullscreen-menu a').removeClass('current');
            anchor.addClass('current');
        };

        /**
         * Check anchor active state on scroll
         */
        var checkActiveStateOnScroll = function(){

            $('[data-mkd-anchor]').waypoint( function(direction) {
                if(direction === 'down') {
                    setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("mkd-anchor")+"']"));
                }
            }, { offset: '50%' });

            $('[data-mkd-anchor]').waypoint( function(direction) {
                if(direction === 'up') {
                    setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("mkd-anchor")+"']"));
                }
            }, { offset: function(){
                return -($(this.element).outerHeight() - 150);
            } });

        };

        /**
         * Check anchor active state on load
         */
        var checkActiveStateOnLoad = function(){
            var hash = window.location.hash.split('#')[1];

            if(hash !== "" && $('[data-mkd-anchor="'+hash+'"]').length > 0){
                //triggers click which is handled in 'anchorClick' function
                $("a[href='"+window.location.href.split('#')[0]+"#"+hash).trigger( "click" );
            }
        };

        /**
         * Calculate header height to be substract from scroll amount
         * @param anchoredElementOffset, anchorded element offest
         */
        var headerHeihtToSubtract = function(anchoredElementOffset){

            var headerHeight = mkdPerPageVars.vars.mkdHeaderTransparencyHeight;

            return headerHeight;
        };

        /**
         * Handle anchor click
         */
        var anchorClick = function() {
            mkd.document.on("click", ".mkd-main-menu a, .mkd-btn, .mkd-anchor", function() {
                var scrollAmount;
                var anchor = $(this);
                var hash = anchor.prop("hash").split('#')[1];

                if(hash !== "" && $('[data-mkd-anchor="' + hash + '"]').length > 0 && anchor.attr('href').split('#')[0] == window.location.href.split('#')[0]) {

                    var anchoredElementOffset = $('[data-mkd-anchor="' + hash + '"]').offset().top;
                    scrollAmount = $('[data-mkd-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset);

                    setActiveState(anchor);

                    mkd.html.stop().animate({
                        scrollTop: Math.round(scrollAmount)
                    }, 1000, function() {
                        //change hash tag in url
                        if(history.pushState) { history.pushState(null, null, '#'+hash); }
                    });
                    return false;
                }
            });
        };

        return {
            init: function() {
                if($('[data-mkd-anchor]').length) {
                    anchorClick();
                    checkActiveStateOnScroll();
                    $(window).load(function() { checkActiveStateOnLoad(); });
                }
            }
        };

    };

    /*
     **	Video background initialization
     */
    function mkdInitVideoBackground(){

        $('.mkd-section .mkd-video-wrap .mkd-video').mediaelementplayer({
            enableKeyboard: false,
            iPadUseNativeControls: false,
            pauseOtherPlayers: false,
            // force iPhone's native controls
            iPhoneUseNativeControls: false,
            // force Android's native controls
            AndroidUseNativeControls: false
        });

        //mobile check
        if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
            mkdInitVideoBackgroundSize();
            $('.mkd-section .mkd-mobile-video-image').show();
            $('.mkd-section .mkd-video-wrap').remove();
        }
    }

    /*
     **	Calculate video background size
     */
    function mkdInitVideoBackgroundSize(){

        $('.mkd-section .mkd-video-wrap').each(function(){

            var element = $(this);
            var sectionWidth = element.closest('.mkd-section').outerWidth();
            element.width(sectionWidth);

            var sectionHeight = element.closest('.mkd-section').outerHeight();
            mkd.minVideoWidth = mkd.videoRatio * (sectionHeight+20);
            element.height(sectionHeight);

            var scaleH = sectionWidth / mkd.videoWidthOriginal;
            var scaleV = sectionHeight / mkd.videoHeightOriginal;
            var scale =  scaleV;
            if (scaleH > scaleV)
                scale =  scaleH;
            if (scale * mkd.videoWidthOriginal < mkd.minVideoWidth) {scale = mkd.minVideoWidth / mkd.videoWidthOriginal;}

            element.find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * mkd.videoWidthOriginal +2));
            element.find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * mkd.videoHeightOriginal +2));
            element.scrollLeft((element.find('video').width() - sectionWidth) / 2);
            element.find('.mejs-overlay, .mejs-poster').scrollTop((element.find('video').height() - (sectionHeight)) / 2);
            element.scrollTop((element.find('video').height() - sectionHeight) / 2);
        });
    }

    function mkdDisableScroll() {

        if (window.addEventListener) {
            window.addEventListener('DOMMouseScroll', mkdWheel, false);
        }
        window.onmousewheel = document.onmousewheel = mkdWheel;
        document.onkeydown = mkdKeydown;

        if(mkd.body.hasClass('mkd-smooth-scroll')){
            window.removeEventListener('mousewheel', smoothScrollListener, false);
            window.removeEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function mkdEnableScroll() {
        if (window.removeEventListener) {
            window.removeEventListener('DOMMouseScroll', mkdWheel, false);
        }
        window.onmousewheel = document.onmousewheel = document.onkeydown = null;

        if(mkd.body.hasClass('mkd-smooth-scroll')){
            window.addEventListener('mousewheel', smoothScrollListener, false);
            window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function mkdWheel(e) {
        mkdPreventDefaultValue(e);
    }

    function mkdKeydown(e) {
        var keys = [37, 38, 39, 40];

        for (var i = keys.length; i--;) {
            if (e.keyCode === keys[i]) {
                mkdPreventDefaultValue(e);
                return;
            }
        }
    }

    function mkdPreventDefaultValue(e) {
        e = e || window.event;
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.returnValue = false;
    }

    function mkdInitSelfHostedVideoPlayer() {

        var players = $('.mkd-self-hosted-video');
            players.mediaelementplayer({
                audioWidth: '100%'
            });
    }

	function mkdSelfHostedVideoSize(){

		$('.mkd-self-hosted-video-holder .mkd-video-wrap').each(function(){
			var thisVideo = $(this);

			var videoWidth = thisVideo.closest('.mkd-self-hosted-video-holder').outerWidth();
			var videoHeight = videoWidth / mkd.videoRatio;

			if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
				thisVideo.parent().width(videoWidth);
				thisVideo.parent().height(videoHeight);
			}

			thisVideo.width(videoWidth);
			thisVideo.height(videoHeight);

			thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
			thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
		});
	}

    function mkdToTopButton(a) {
        
        var b = $("#mkd-back-to-top");
        b.removeClass('off on');
        if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
    }

    function mkdBackButtonShowHide(){
        mkd.window.scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) { d = b + c / 2; } else { d = 1; }
            if (d < 1e3) { mkdToTopButton('off'); } else { mkdToTopButton('on'); }
        });
    }

    function mkdInitBackToTop(){
        var backToTopButton = $('#mkd-back-to-top');
        backToTopButton.on('click',function(e){
            e.preventDefault();
            mkd.html.animate({scrollTop: 0}, mkd.window.scrollTop()/5, 'linear');
        });
    }

	/*
	 **	Sections with parallax background image
	 */
	function mkdInitParallax(){

	    if($('.mkd-parallax-section-holder').length){
	        $('.mkd-parallax-section-holder').each(function() {

	            var parallaxElement = $(this);
	            var speed = parallaxElement.data('mkd-parallax-speed')*0.4;
	            parallaxElement.parallax("50%", speed, true);
	        });
	    }
	}

    /*
    ** Social Icons placed in widget areas - animations
    */
    function mkdWidgetIcons() {
        var widgetIcons = $('.textwidget .mkd-icon-shortcode');
        if (widgetIcons.length) {
            widgetIcons.each(function(){
                var widgetIcon = $(this),
                    widgetIconLink = widgetIcon.find('a'),
                    widgetIconElement = widgetIconLink.find('> span');
                widgetIconElement.clone().appendTo(widgetIconLink).addClass('mkd-additional-icon');
                widgetIcon.addClass('mkd-rotate');
            });
        }
    }

    /**
     * Object that sets ratings for blog single
     * @returns {{init: Function}} function that initializes blog single ratings functionality
     */
    var mkdPostRatings = mkd.modules.common.mkdPostRatings = function(){

        // get all stars for rating
        var ratings = $('.mkd-ratings-stars-inner'),
            messageHolder = $('.mkd-ratings-message-holder'),
            ratingsMessage = messageHolder.children('.mkd-rating-message'),
            ratingsValue = messageHolder.children('.mkd-rating-value'),
            thisPost = $('.single-post article'),
            ratingId,
            thisPostId,
            postData;

        thisPostId = (thisPost.length)? thisPost.attr('id').match(/\d+/)[0] : '';

        /**
         * Function that triggers set ratings functionality
         */
        var mkdPostRatingsEvent = function () {
            ratings.children().hover(
                function () {
                    if(!ratings.hasClass('mkd-ratings-rated')) {
                        ratingId = ($(this).attr('id').match(/\d+/)[0]);
                        ratings.children().each(function () {
                            if ($(this).attr('id').match(/\d+/)[0] <= ratingId) {
                                $(this).addClass('mkd-hover-rating-star');
                            } else {
                                $(this).removeClass('mkd-hover-rating-star');
                            }
                        });
                    }
                },
                function () {
                    if(!ratings.hasClass('mkd-ratings-rated')) {
                        ratings.children().each(function () {
                            $(this).removeClass('mkd-hover-rating-star');
                        });
                    }
                });

            ratings.children().click(function(){
                if(!ratings.hasClass('mkd-ratings-rated')) {

                    ratingId = ($(this).attr('id').match(/\d+/)[0]);

                    ratings.children().each(function () {
                        if ($(this).attr('id').match(/\d+/)[0] <= ratingId) {
                            $(this).addClass('mkd-active-rating-star');
                        } else {
                            $(this).removeClass('mkd-active-rating-star');
                        }
                    });
                    ratings.addClass('mkd-ratings-rated');

                    postData = {
                        action: 'discussion_post_rating_ajax_function',
                        postID: thisPostId,
                        value: ratingId
                    };
                    
                    $.ajax({
                        type: 'POST',
                        data: postData,
                        url: mkdGlobalVars.vars.mkdAjaxUrl,
                        success: function (data) {
                            var response = $.parseJSON(data);
                            ratingsMessage.html(response.rateAnswer);
                            ratingsMessage.fadeIn();
                            ratingsValue.html("Current rate is: " + response.newCount);
                            ratingsValue.fadeIn();
                        }
                    });
                }
            });
        };

        return {
            init : function() {
                if (ratings.length) {
                    ratings.each(function () {
                        mkdPostRatingsEvent();
                    });
                }
            }
        };
    };


})(jQuery);
(function($) {
    "use strict";

    var header = {};
    mkd.modules.header = header;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour;
    header.mkdInitMobileNavigation = mkdInitMobileNavigation;
    header.mkdMobileHeaderBehavior = mkdMobileHeaderBehavior;
    header.mkdSetDropDownMenuPosition = mkdSetDropDownMenuPosition;
    header.mkdSetWideMenuPosition = mkdSetWideMenuPosition;
    header.mkdSideArea = mkdSideArea;
    header.mkdSideAreaScroll = mkdSideAreaScroll;
    header.mkdDropDownMenu = mkdDropDownMenu;
    header.mkdSearch = mkdSearch;

    $(document).ready(function() {
        mkdHeaderBehaviour();
        mkdInitMobileNavigation();
        mkdMobileHeaderBehavior();
        mkdSideArea();
        mkdSideAreaScroll();
        mkdSetDropDownMenuPosition();
        mkdSetWideMenuPosition();
        mkdSearch();
    });

    $(window).load(function() {
        mkdDropDownMenu();
        mkdSetDropDownMenuPosition();
        mkdSetWideMenuPosition();
    });

    $(window).resize(function() {
        mkdSetWideMenuPosition();
        mkdDropDownMenu();
    });

    /*
     **	Show/Hide sticky header on window scroll
     */
    function mkdHeaderBehaviour() {

        var header = $('.mkd-page-header');
        var stickyHeader = $('.mkd-sticky-header');
        var stickyAppearAmount;

        var fixedHeaderWrapper = $('.mkd-fixed-wrapper');
        var headerMenuAreaOffset = $('.mkd-page-header').find('.mkd-fixed-wrapper').length ? $('.mkd-page-header').find('.mkd-fixed-wrapper').offset().top: null;

        switch(true) {
            // sticky header that will be shown when user scrolls up
            case mkd.body.hasClass('mkd-sticky-header-on-scroll-up'):
                mkd.modules.header.behaviour = 'mkd-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = mkdGlobalVars.vars.mkdTopBarHeight + mkdGlobalVars.vars.mkdLogoAreaHeight + mkdGlobalVars.vars.mkdMenuAreaHeight + mkdGlobalVars.vars.mkdStickyHeaderHeight ;

                var headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();

                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        mkd.modules.header.isStickyVisible= false;
                        stickyHeader.removeClass('header-appear').find('.mkd-main-menu .second').removeClass('mkd-drop-down-start');
                    }else {
                        mkd.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case mkd.body.hasClass('mkd-sticky-header-on-scroll-down-up'):
                mkd.modules.header.behaviour = 'mkd-sticky-header-on-scroll-down-up';
                stickyAppearAmount = mkdPerPageVars.vars.mkdStickyScrollAmount !== 0 ? mkdPerPageVars.vars.mkdStickyScrollAmount : mkdGlobalVars.vars.mkdTopBarHeight + mkdGlobalVars.vars.mkdLogoAreaHeight + mkdGlobalVars.vars.mkdMenuAreaHeight;
                mkd.modules.header.stickyAppearAmount = stickyAppearAmount; //used in anchor logic

                var headerAppear = function(){
                    if(mkd.scroll < stickyAppearAmount) {
                        mkd.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.mkd-main-menu .second').removeClass('mkd-drop-down-start');
                    }else{
                        mkd.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, when viewport hits header's top position it remains fixed
            case mkd.body.hasClass('mkd-fixed-on-scroll'):
                mkd.modules.header.behaviour = 'mkd-fixed-on-scroll';
                var headerFixed = function(){
                    if(mkd.scroll < headerMenuAreaOffset){
                        fixedHeaderWrapper.removeClass('fixed');
                        header.css('margin-bottom',0);}
                    else{
                        fixedHeaderWrapper.addClass('fixed');
                        header.css('margin-bottom',fixedHeaderWrapper.height());
                    }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }
    

    function mkdInitMobileNavigation() {
        var navigationOpener = $('.mkd-mobile-header .mkd-mobile-menu-opener');
        var navigationHolder = $('.mkd-mobile-header .mkd-mobile-nav');
        var dropdownOpener = $('.mkd-mobile-nav .mobile_arrow, .mkd-mobile-nav h6, .mkd-mobile-nav a[href*="#"]');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if(navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                if(navigationHolder.is(':visible')) {
                    navigationOpener.removeClass('opened');
                    navigationHolder.slideUp(animationSpeed);
                } else {
                    navigationOpener.addClass('opened');
                    navigationHolder.slideDown(animationSpeed);
                }
            });
        }

        //dropdown opening / closing
        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                $(this).on('tap click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var dropdownToOpen = $(this).nextAll('ul').first();
                    var openerParent = $(this).parent('li');
                    if(dropdownToOpen.is(':visible')) {
                        dropdownToOpen.slideUp(animationSpeed);
                        openerParent.removeClass('mkd-opened');
                    } else {
                        dropdownToOpen.slideDown(animationSpeed);
                        openerParent.addClass('mkd-opened');
                    }
                });
            });
        }

        $('.mkd-mobile-nav a, .mkd-mobile-logo-wrapper a').on('click tap', function(e) {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function mkdMobileHeaderBehavior() {
        if(mkd.body.hasClass('mkd-sticky-up-mobile-header')) {
            var stickyAppearAmount;
            var topBar = $('.mkd-top-bar');
            var mobileHeader = $('.mkd-mobile-header');
            var adminBar     = $('#wpadminbar');
            var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
            var topBarHeight = topBar.is(':visible') ? topBar.height() : 0;
            var adminBarHeight = adminBar.length ? adminBar.height() : 0;

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = topBarHeight + mobileHeaderHeight + adminBarHeight;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('mkd-animate-mobile-header');
                    mobileHeader.css('margin-bottom',  mobileHeaderHeight);
                } else {
                    mobileHeader.removeClass('mkd-animate-mobile-header');
                    mobileHeader.css('margin-bottom', 0);
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    if(adminBar.length) {
                        mobileHeader.find('.mkd-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');

                }

                docYScroll1 = $(document).scrollTop();
            });
        }
    }

    /**
     * Set dropdown position
     */
    function mkdSetDropDownMenuPosition(){

        var menuItems = $(".mkd-drop-down > ul > li.mkd-menu-narrow");
        menuItems.each( function(i) {

            var browserWidth = mkd.windowWidth-16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.mkd-menu-second .mkd-menu-inner ul').width();

            var menuItemFromLeft = 0;
            if(mkd.body.hasClass('mkd-boxed')){
                menuItemFromLeft = mkd.boxedLayoutWidth  - (menuItemPosition - (browserWidth - mkd.boxedLayoutWidth)/2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if($(this).find('li.mkd-menu-sub').length > 0){
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if(menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth){
                $(this).find('.mkd-menu-second').addClass('right');
                $(this).find('.mkd-menu-second .mkd-menu-inner ul').addClass('right');
            } else {
                $(this).find('.mkd-menu-second').removeClass('right');
                $(this).find('.mkd-menu-second .mkd-menu-inner ul').removeClass('right');
            }
        });
    }

    function mkdSetWideMenuPosition() {

        var browserWidth = mkd.windowWidth;
        var menu_items = $('.mkd-drop-down > ul > li.mkd-menu-wide');
        menu_items.each(function(i) {
            if($(menu_items[i]).find('.mkd-menu-second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.mkd-menu-second');
                dropDownSecondDiv.css('left','0'); //reinit left offset for fixed header transition
                var dropdown = $(this).find('.mkd-menu-inner > ul');
                var dropdownWidth = dropdown.outerWidth();
                var dropdownPosition = dropdown.offset().left;
                var left_position = 0;


                if(!$(this).hasClass('mkd-menu-left-position') && !$(this).hasClass('mkd-menu-right-position')) {
                    left_position = dropdownPosition - (browserWidth - dropdownWidth)/2;
                    dropDownSecondDiv.css('left', -left_position);
                    dropDownSecondDiv.css('width', dropdownWidth);
                }
            }
        });
    }

    function mkdDropDownMenu() {

        var menu_items = $('.mkd-drop-down > ul > li');

        menu_items.each(function(i) {
            if($(menu_items[i]).find('.mkd-menu-second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.mkd-menu-second');

                if($(menu_items[i]).hasClass('mkd-menu-wide')) {
                    if($(menu_items[i]).data('wide_background_image') !== '' && $(menu_items[i]).data('wide_background_image') !== undefined){
                        var wideBackgroundImageSrc = $(menu_items[i]).data('wide_background_image');
                        dropDownSecondDiv.find('> .mkd-menu-inner > ul').css('background-image', 'url('+wideBackgroundImageSrc+')');
                    }
                }

                if(!mkd.menuDropdownHeightSet) {
                    $(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    $(menu_items[i]).on("touchstart mouseenter", function() {
                        dropDownSecondDiv.css({
                            'height': $(menu_items[i]).data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function() {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });

                } else {
                    $(menu_items[i]).mouseenter(function() {
                        dropDownSecondDiv.css({'opacity': '1','height':$(menu_items[i]).data('original_height'), 'top':'100%'});
                        dropDownSecondDiv.addClass('mkd-drop-down-start');
                    });
                    $(menu_items[i]).mouseleave(function() {
                        dropDownSecondDiv.css({'opacity': '0','height':'0'});
                        dropDownSecondDiv.removeClass('mkd-drop-down-start');
                    });
                }
            }
        });

        $('.mkd-drop-down ul li.mkd-menu-wide ul li a').on('click', function(e) {
            if (e.which == 1) {
                var $this = $(this);
                setTimeout(function () {
                    $this.mouseleave();
                }, 500);
            }
        });
        mkd.menuDropdownHeightSet = true;

    }

    /**
     * Show/hide side area
     */
    function mkdSideArea() {

        var wrapper = $('.mkd-wrapper'),
            sideMenu = $('.mkd-side-menu'),
            sideMenuButtonOpen = $('a.mkd-side-menu-button-opener'),
            cssClass,
        //Flags
            slideFromRight = false,
            slideWithContent = false,
            slideUncovered = false,
            slideOverContent = false;

        if (mkd.body.hasClass('mkd-side-menu-slide-from-right')) {
            $('.mkd-cover').remove();
            cssClass = 'mkd-right-side-menu-opened';
            wrapper.prepend('<div class="mkd-cover"/>');
            slideFromRight = true;

        } else if (mkd.body.hasClass('mkd-side-menu-slide-with-content')) {

            cssClass = 'mkd-side-menu-open';
            slideWithContent = true;

        } else if (mkd.body.hasClass('mkd-side-area-uncovered-from-content')) {

            cssClass = 'mkd-right-side-menu-opened';
            slideUncovered = true;

        } else if (mkd.body.hasClass('mkd-side-menu-slide-over-content')) {

            cssClass = 'mkd-side-menu-open';
            slideOverContent = true;

        }

        $('a.mkd-side-menu-button-opener, a.mkd-close-side-menu').click( function(e) {
            e.preventDefault();

            if(!sideMenuButtonOpen.hasClass('opened')) {

                sideMenuButtonOpen.addClass('opened');
                mkd.body.addClass(cssClass);

                if (slideFromRight) {
                    $('.mkd-wrapper .mkd-cover').click(function() {
                        mkd.body.removeClass('mkd-right-side-menu-opened');
                        sideMenuButtonOpen.removeClass('opened');
                    });
                }

                if (slideUncovered) {
                    sideMenu.css({
                        'visibility' : 'visible'
                    });
                }

                var currentScroll = $(window).scrollTop();
                $(window).scroll(function() {
                    if(Math.abs(mkd.scroll - currentScroll) > 400){
                        mkd.body.removeClass(cssClass);
                        sideMenuButtonOpen.removeClass('opened');
                        if (slideUncovered) {
                            var hideSideMenu = setTimeout(function(){
                                sideMenu.css({'visibility':'hidden'});
                                clearTimeout(hideSideMenu);
                            },400);
                        }
                    }
                });

            } else {

                sideMenuButtonOpen.removeClass('opened');
                mkd.body.removeClass(cssClass);
                if (slideUncovered) {
                    var hideSideMenu = setTimeout(function(){
                        sideMenu.css({'visibility':'hidden'});
                        clearTimeout(hideSideMenu);
                    },400);
                }

            }

            if (slideWithContent || slideOverContent) {

                e.stopPropagation();
                wrapper.click(function() {
                    e.preventDefault();
                    sideMenuButtonOpen.removeClass('opened');
                    mkd.body.removeClass('mkd-side-menu-open');
                });

            }

        });

    }

    /*
     **  Smooth scroll functionality for Side Area
     */
    function mkdSideAreaScroll(){

        var sideMenu = $('.mkd-side-menu');

        if(sideMenu.length){
            sideMenu.niceScroll({
                scrollspeed: 60,
                mousescrollstep: 40,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            });
        }
    }

    /**
     * Init Search Types
     */
    function mkdSearch() {

        var searchOpener = $('a.mkd-search-opener');

        searchOpener.each(function(){
            var opener = $(this),
                searchWidget = opener.parent().children('.mkd-search-widget-holder');

            opener.on('click', function(e) {
                e.preventDefault();
                opener.toggleClass('mkd-active');
                if (opener.hasClass('mkd-active')) {
                    searchWidget.slideToggle(300, 'easeOutBack',
                        function(){
                            $(this).find('.mkd-search-field').focus();
                        });
                } else {
                    searchWidget.fadeOut(0,
                        function(){
                            $(this).find('.mkd-search-field').blur().val('');
                        });
                }
            });

            $(document).mouseup(function (e) {
                var container = $(".mkd-search-widget-holder, a.mkd-search-opener");
                if (!container.is(e.target) && container.has(e.target).length === 0)  {
                    e.preventDefault();
                    opener.removeClass('mkd-active');
                    searchWidget.fadeOut(0,
                       function(){
                           $(this).find('.mkd-search-field').blur().val('');
                       });
                }
            });

        });

    }

})(jQuery);
(function($) {
    'use strict';

    var shortcodes = {};

    mkd.modules.shortcodes = shortcodes;

    shortcodes.mkdInitTabs = mkdInitTabs;
    shortcodes.mkdCustomFontResize = mkdCustomFontResize;
    shortcodes.mkdBlockReveal = mkdBlockReveal;
    shortcodes.mkdBlockTwo = mkdBlockTwo;
    shortcodes.mkdBreakingNews = mkdBreakingNews;
    shortcodes.mkdPostSlider = mkdPostSlider;
    shortcodes.mkdPostWithThumbnailSlider = mkdPostWithThumbnailSlider;
    shortcodes.mkdPostInteractiveSlider = mkdPostInteractiveSlider;
    shortcodes.mkdPostCarousel = mkdPostCarousel;
    shortcodes.mkdCarouselResize = mkdCarouselResize;
    shortcodes.mkdPostCarouselSwipe = mkdPostCarouselSwipe;
    shortcodes.mkdPostCarouselSwipeHover = mkdPostCarouselSwipeHover;
    shortcodes.mkdInitStickyWidget = mkdInitStickyWidget;
    shortcodes.mkdShowGoogleMap = mkdShowGoogleMap;

    $(document).ready(function() {
        mkdIcon().init();
		mkdInitTabs();
        mkdButton().init();
		mkdCustomFontResize();
        mkdBlockReveal();
        mkdBlockTwo();
        mkdBlockFour();
        mkdBlockFourOpenClose();
        mkdBlocksMovement();
        mkdBlocksHeight();
        mkdPostLayoutFive();
        mkdBreakingNews();
        mkdPostSlider();
        mkdPostWithThumbnailSlider();
        mkdPostInteractiveSlider();
        mkdPostInteractiveHeight();
        mkdPostCarousel();
        mkdCarouselResize();
        mkdPostCarouselSwipe();
        mkdPostCarouselSwipeHover();
        mkdSocialIconWidget().init();
        mkdPostPagination().init();
        mkdPostLayoutHovers();
        mkdRecentCommentsHover();
        mkdShowGoogleMap();
    });

    $(window).resize(function(){
		mkdCustomFontResize();
		mkdSliderResize();
		mkdCarouselResize();
        mkdInitStickyWidget();
        mkdBlockTwo();
        mkdBlockFour();
        mkdBlocksMovement();
        mkdBlocksHeight();
        mkdPostLayoutFive();
        mkdPostCarouselSwipeHover();
        mkdPostInteractiveHeight();
    });

    $(window).load(function(){
        mkdPostLayoutTabWidget().init();
        mkdInitStickyWidget();
        mkd.modules.common.mkdInitParallax();
    });

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdIcon = mkd.modules.shortcodes.mkdIcon = function() {
        //get all icons on page
        var icons = $('.mkd-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function(icon) {
            if(icon.hasClass('mkd-icon-animation')) {
                icon.appear(function() {
                    icon.parent('.mkd-icon-animation-holder').addClass('mkd-icon-animation-show');
                }, {accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.mkd-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function(icon) {
            if(typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function(event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.css('background-color');

                if(hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function(icon) {
            if(typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function(event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.css('border-color');

                if(hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });

                }
            }
        };
    };

    /**
     * Object that represents social icon widget
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdSocialIconWidget = mkd.modules.shortcodes.mkdSocialIconWidget = function() {
        //get all social icons on page
        var icons = $('.mkd-social-icon-widget-holder');

        /**
         * Function that triggers icon hover color functionality
         */
        var socialIconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon;
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        socialIconHoverColor($(this));
                    });

                }
            }
        };
    };

    /*
    **	Init tabs shortcode
    */
    function mkdInitTabs(){

       var tabs = $('.mkd-tabs');
        if(tabs.length){
            tabs.each(function(){
                var thisTabs = $(this);

                if(!thisTabs.hasClass('mkd-ptw-holder')) {
                    thisTabs.children('.mkd-tab-container').each(function(index){
                        index = index + 1;

                        var that = $(this),
                            link = that.attr('id');

                        var navItem = -1;
                        if(that.parent().find('.mkd-tabs-nav li').hasClass('mkd-tabs-title-holder')){
                            index = index + 1;

                            if(that.parent().find('.mkd-tabs-nav li.mkd-tabs-title-holder .mkd-tabs-title-image').length) {
                                that.parent().find('.mkd-tabs-nav li.mkd-tabs-title-holder').children('.mkd-tabs-title-image:first-child').addClass('mkd-active-tab-image');
                            }
                        }
                        navItem = that.parent().find('.mkd-tabs-nav li:nth-child('+index+') a');

                        var navLink = navItem.attr('href');

                            link = '#'+link;

                            if(link.indexOf(navLink) > -1) {
                                navItem.attr('href',link);
                            }
                    });
                }

                thisTabs.tabs({
                    activate: function() {
                        thisTabs.find('.mkd-tabs-nav li').each(function(){
                            var thisTab = $(this);

                            if(thisTab.hasClass('ui-tabs-active')) {
                                var activeTab = thisTab.index();

                                if(thisTab.parent().find('.mkd-tabs-title-image').length) {
                                    thisTab.parent().find('.mkd-tabs-title-image').removeClass('mkd-active-tab-image');
                                    thisTab.parent().find('.mkd-tabs-title-image:nth-child('+activeTab+')').addClass('mkd-active-tab-image');
                                }
                            }
                        });
                    }
                });
            });
        }
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var mkdButton = mkd.modules.shortcodes.mkdButton = function() {
        //all buttons on the page
        var buttons = $('.mkd-btn');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var buttonHoverColor = function(button) {
            if(typeof button.data('hover-color') !== 'undefined') {
                var changeButtonColor = function(event) {
                    event.data.button.css('color', event.data.color);
                };

                var originalColor = button.css('color');
                var hoverColor = button.data('hover-color');

                button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
                button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
            }
        };



        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonHoverBgColor = function(button) {
            if(typeof button.data('hover-bg-color') !== 'undefined') {
                var changeButtonBg = function(event) {
                    event.data.button.css('background-color', event.data.color);
                };

                var originalBgColor = button.css('background-color');
                var hoverBgColor = button.data('hover-bg-color');

                button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
                button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
            }
        };

        /**
         * Initializes button icon hover background color
         * @param button current button
         */
        var buttonIconHoverBgColor = function(button) {
            if(!button.hasClass('mkd-btn-outline') && (typeof button.data('icon-hover-bg-color') !== 'undefined' || typeof button.data('icon-hover-bg-color') !== 'undefined')) {
                if(typeof button.data('icon-bg-color') !== 'undefined'){
                    button.children('.mkd-btn-icon-element').css('background-color', button.data('icon-bg-color'));
                }

                var changeButtonIconBg = function(event) {
                    event.data.button.children('.mkd-btn-icon-element').css('background-color', event.data.color);
                };

                var originalIconBgColor = (typeof button.data('icon-bg-color') !== 'undefined') ? button.data('icon-bg-color'): 'transparent';
                var hoverIconBgColor = (typeof button.data('icon-hover-bg-color') !== 'undefined') ? button.data('icon-hover-bg-color') : 'transparent';

                button.on('mouseenter', { button: button, color: hoverIconBgColor }, changeButtonIconBg);
                button.on('mouseleave', { button: button, color: originalIconBgColor }, changeButtonIconBg);
            }
        };

        /**
         * Initializes button border color
         * @param button
         */
        var buttonHoverBorderColor = function(button) {
            if(typeof button.data('hover-border-color') !== 'undefined') {
                var changeBorderColor = function(event) {
                    event.data.button.css('border-color', event.data.color);
                };

                var originalBorderColor = button.css('border-color');
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
                button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
            }
        };

        return {
            init: function() {
                if(buttons.length) {
                    buttons.each(function() {
						var thisButton = $(this);
						if (!thisButton.hasClass('mkd-btn-transparent')){
							buttonHoverColor($(this));
							buttonHoverBgColor($(this));
							buttonHoverBorderColor($(this));
							buttonIconHoverBgColor($(this));
						}
                    });
                }
            }
        };
    };

	/*
	**	Custom Font resizing
	*/
	function mkdCustomFontResize(){
		var customFont = $('.mkd-custom-font-holder');
		if (customFont.length){
			customFont.each(function(){
				var thisCustomFont = $(this);
				var fontSize;
				var lineHeight;
				var coef1 = 1;
				var coef2 = 1;

				if (mkd.windowWidth < 1200){
					coef1 = 0.8;
				}

				if (mkd.windowWidth < 1000){
					coef1 = 0.7;
				}

				if (mkd.windowWidth < 768){
					coef1 = 0.6;
					coef2 = 0.7;
				}

				if (mkd.windowWidth < 600){
					coef1 = 0.5;
					coef2 = 0.6;
				}

				if (mkd.windowWidth < 480){
					coef1 = 0.4;
					coef2 = 0.5;
				}

				if (typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
					fontSize = parseInt(thisCustomFont.data('font-size'));

					if (fontSize > 70) {
						fontSize = Math.round(fontSize*coef1);
					}
					else if (fontSize > 35) {
						fontSize = Math.round(fontSize*coef2);
					}

					thisCustomFont.css('font-size',fontSize + 'px');
				}

				if (typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
					lineHeight = parseInt(thisCustomFont.data('line-height'));

					if (lineHeight > 70 && mkd.windowWidth < 1200) {
						lineHeight = '1.2em';
					}
					else if (lineHeight > 35 && mkd.windowWidth < 768) {
						lineHeight = '1.2em';
					}
					else{
						lineHeight += 'px';
					}

					thisCustomFont.css('line-height', lineHeight);
				}
			});
		}
	}

    /*
     **  Init block revealing
     */
    function mkdBlockReveal(){

        var blockHolder = $('.mkd-block-revealing .mkd-bnl-inner');

        if(blockHolder.length){
            blockHolder.each(function(){
                var thisBlockHolder = $(this);
                var thisBlockNonFeaturedHolder = thisBlockHolder.find('.mkd-pbr-non-featured');
                var thisBlockFeaturedHolder = thisBlockHolder.find('.mkd-pbr-featured');
                var currentItemPosition = 1;
                var activeItemClass = 'mkd-block-reveal-active-item';
                var activeNonFItemClass = 'mkd-reveal-nonf-active';

                var thisFeaturedBlocks = thisBlockFeaturedHolder.find('.mkd-post-block-part-inner');

                thisFeaturedBlocks.each(function(e){
                	var thisFeatured = $(this);

                	if (thisFeatured.hasClass('mkd-block-reveal-active-item')){
                		currentItemPosition = e + 1;
                	}
                });

                thisBlockFeaturedHolder.children('.mkd-post-block-part-inner:nth-child('+currentItemPosition+')').addClass(activeItemClass);
                thisBlockNonFeaturedHolder.children('.mkd-post-reveal-item:nth-child('+currentItemPosition+')').addClass(activeNonFItemClass);
                thisBlockFeaturedHolder.children('.mkd-post-block-part-inner:nth-child('+currentItemPosition+')').fadeIn(150);

                thisBlockNonFeaturedHolder.find('a').click(function(e){
                    e.preventDefault();

                    var thisItem = $(this).parents('.mkd-pbr-non-featured > .mkd-post-reveal-item');

                    currentItemPosition = $(this).parents('.mkd-pbr-non-featured > .mkd-post-reveal-item').index()+1; // +1 is because index start from 0 and list from 1

                    thisBlockFeaturedHolder.children('.mkd-post-block-part-inner').fadeOut(150);
                    thisBlockFeaturedHolder.children('.mkd-post-block-part-inner').removeClass(activeItemClass);
                    thisBlockNonFeaturedHolder.children('.mkd-post-reveal-item').removeClass(activeNonFItemClass);


                    thisBlockFeaturedHolder.children('.mkd-post-block-part-inner:nth-child('+currentItemPosition+')').addClass(activeItemClass);
                    thisItem.addClass(activeNonFItemClass);

                    setTimeout(function(){
                        thisBlockFeaturedHolder.children('.mkd-post-block-part-inner:nth-child('+currentItemPosition+')').fadeIn(150);
                    },160);
                });

    			mkd.modules.common.mkdInitParallax();
            });
        }
    }

    /*
     **  Block 2 calculations
     */
    function mkdBlockTwo(){
        var blockHolder = $('.mkd-pb-two-holder .mkd-bnl-inner');

        if(blockHolder.length){
            blockHolder.each(function(){
                var thisBlockHolder = $(this),
                    thisBlockFeaturedHolder = thisBlockHolder.find('.mkd-pbr-featured'),
                    thisBlocks = thisBlockFeaturedHolder.find('.mkd-post-block-part-inner'),
                    minHeight = parseInt(thisBlockFeaturedHolder.find('.mkd-block-reveal-active-item').height());

                thisBlockFeaturedHolder.waitForImages(function(){
					thisBlocks.each(function(){
						var thisBlockHeight = parseInt($(this).height());
						if (thisBlockHeight > minHeight){
							minHeight = thisBlockHeight;
						}
					});

					thisBlockFeaturedHolder.css('height',minHeight);
				});

            });
        }
    }


    /*
     **  Block 4 calculations
     */
    function mkdBlockFour(){
        var blockHolder = $('.mkd-pb-four-holder');

        if(blockHolder.length){
            blockHolder.each(function(){
                var thisBlockHolder = $(this),
                    thisBlockFeaturedHolder = thisBlockHolder.find('.mkd-pbr-featured'),
                    thisBlocks = thisBlockHolder.find('.mkd-post-block-part-inner'),
                    thisFeaturedItem = thisBlockFeaturedHolder.find('.mkd-post-item'),
                	thisBlockNonFeaturedHolder = thisBlockHolder.find('.mkd-pb-four-non-featured'),
                	thisButton = thisBlockNonFeaturedHolder.find('.mkd-hide-show-button'),
                	thisBlockNonFWidth = thisBlockNonFeaturedHolder.width(),
                    minHeight = parseInt(thisBlockFeaturedHolder.height()),
                    proportion = 1,
                    itemsHeight;

				thisFeaturedItem.each(function(){
					var thisItem = $(this),
						thisProportion = thisItem.data('image-proportion');

					if (thisProportion < proportion){
						proportion = thisProportion;
					}

				});

				if (thisBlockFeaturedHolder.data('image-height')){
					var imageHeight = thisBlockFeaturedHolder.data('image-height');
					if (mkd.windowWidth > 1280){
						itemsHeight = imageHeight;
					}
					else if (mkd.windowWidth > 1024){
						itemsHeight = imageHeight*0.9;
					}
					else if (mkd.windowWidth > 768){
						itemsHeight = imageHeight*0.8;
					}
					else if (mkd.windowWidth > 480){
						itemsHeight = imageHeight*0.7; 
					}
					else{
						itemsHeight = imageHeight*0.6;
					}
				}
				else{
					itemsHeight = mkd.windowWidth*proportion;
				}

				thisFeaturedItem.each(function(){
					var thisItem = $(this);

					thisItem.css({height: itemsHeight + 'px'});

				});

                thisBlockFeaturedHolder.css('height',itemsHeight);

				if (!thisButton.hasClass('mkd-hidden')){
					thisBlockNonFeaturedHolder.css({left: 'calc(100% - '+thisBlockNonFWidth+'px'});
				}

                thisBlockHolder.css({opacity: '1'});

            });
        }

    }

    function mkdBlockFourOpenClose(){
        var blockHolder = $('.mkd-pb-four-holder .mkd-bnl-inner');

        if(blockHolder.length){
            blockHolder.each(function(){
                var thisBlockHolder = $(this),
                	thisBlockNonFeaturedHolder = thisBlockHolder.find('.mkd-pb-four-non-featured'),
                	thisButton = thisBlockNonFeaturedHolder.find('.mkd-hide-show-button'),
                	thisButtonShow = thisButton.children('span:first-child'),
                	thisButtonHide = thisButton.children('span:nth-child(2)'),
                	thisBlockNonFWidth = thisBlockNonFeaturedHolder.width();

					if (mkd.windowWidth < 769){
						thisBlockNonFeaturedHolder.css({left: '100%'});
						thisButton.addClass('mkd-hidden');
					}
					else{
						thisBlockNonFeaturedHolder.css({left: 'calc(100% - '+thisBlockNonFWidth+'px'});
						thisButton.removeClass('mkd-hidden');
					}

                	thisButton.on("click tap",function(e){
						if(thisButton.hasClass('mkd-hidden')){
							thisBlockNonFeaturedHolder.css({left: 'calc(100% - '+thisBlockNonFWidth+'px'});
							thisButton.removeClass('mkd-hidden');
						}
						else{							
							thisBlockNonFeaturedHolder.css({left:'100%'});
							thisButton.addClass('mkd-hidden');
						}
                	});
            });
        }

    }

	function mkdBlocksMovement(){
		var blockHolder = $('.mkd-pb-five-holder, .mkd-pb-seven-holder');

		if (blockHolder.length){
			blockHolder.each(function(){
				var thisBlockHolder = $(this),
					blockPartHolder = thisBlockHolder.find('.mkd-post-block-part'),
					blockElements = thisBlockHolder.find('.mkd-post-item');

					blockElements.each(function(){
						var thisElement = $(this),
							thisElementContent = thisElement.find('.mkd-pt-five-content'),
							thisInfo = thisElement.find('.mkd-pt-info-section'),
							thisLinks = thisElement.find('.mkd-post-item-link'),
							thisMovement = parseInt(thisInfo.height());

						thisElementContent.css({'bottom': - thisMovement + 'px'});

						thisElement.on('mouseenter',function(){
							thisElementContent.css({'bottom': 0});
						});

						thisElement.on('mouseleave',function(){
							thisElementContent.css({'bottom': - thisMovement + 'px'});
						});


						thisLinks.each(function(){
							var thisLink = $(this);
							if (mkd.html.hasClass('touch')){
								thisLink.on("click tap touch",function(e){
									if (thisLink.hasClass('mkd-hover-link')){
										return true;
									}
									else{
										thisLink.addClass('mkd-hover-link');
										e.preventDefault();
										return false;
									}
								});
							}
						});
					});

			});
		}
	}

	function mkdBlocksHeight(){
		var blockHolder = $('.mkd-pb-five-holder, .mkd-pb-six-holder, .mkd-pb-seven-holder');

		if (blockHolder.length){
			blockHolder.each(function(){
				var thisBlockHolder = $(this),
					blockPartHolder = thisBlockHolder.find('.mkd-post-block-part'),
					blockWidth = blockPartHolder.width(),
					proportion;

					if (thisBlockHolder.hasClass('mkd-pb-five-holder')){
						if (mkd.windowWidth > 1024){
							proportion = 0.36923;
						}
						else if (mkd.windowWidth > 600){
							proportion = 1.515625;
						}
						else{
							proportion = 3.029;
						}
					}
					else if (thisBlockHolder.hasClass('mkd-pb-six-holder')){
						if (mkd.windowWidth > 1024){
							proportion = 0.3155;
						}
						else if (mkd.windowWidth > 600){
							proportion = 1.3975;
						}
						else{
							proportion = 1.707;
						}
					}
					else{
						if (mkd.windowWidth > 1024){
							proportion = 0.383;
						}
						else if (mkd.windowWidth > 600){
							proportion = 0.828125;
						}
						else{
							proportion = 2.267;
						}
					}

					blockPartHolder.css({'height': blockWidth*proportion});


			});
		}
	}

    /*
    * Post Layout 5 animate excerpt
    */
    function mkdPostLayoutFive() {
        var postLayoutFive = $('.mkd-pl-five-holder');
        if (postLayoutFive.length){
            postLayoutFive.each(function(){
                var thisLayout = $(this);
                if(thisLayout.data('display_excerpt') == 'yes') { 
                    //excerpt is shown
                    thisLayout.find('.mkd-pt-five-item').each(function(){
                        var thisArticle = $(this),
                            content = thisArticle.find('.mkd-pt-five-content'),
                            contentHeight = thisArticle.find('.mkd-pt-five-content').outerHeight(),
                            verticalPadding = parseInt(thisArticle.find('.mkd-pt-five-content-inner').css('padding-top')),
                            titleHeight = thisArticle.find('.mkd-pt-five-title').outerHeight(),
                            dateHeight = thisArticle.find('.mkd-post-info-date').outerHeight(true);
                       
                            var transformOffset = Math.ceil(contentHeight -  verticalPadding - titleHeight - dateHeight - 20); //20 for excerpt line height

                            content.css({'transform':'translateY('+transformOffset+'px)'});
                            thisArticle.mouseenter(function(){
                                content.css({'transform':'translateY(0px)'});
                            });
                            thisArticle.mouseleave(function(){
                                 content.css({'transform':'translateY('+transformOffset+'px)'});
                            });

                    });


                }   
            });
        }
    }

    /*
    **  Init breaking news
    */
    function mkdBreakingNews(){

        var bnHolder = $('.mkd-bn-holder');

        if(bnHolder.length){
            bnHolder.each(function(){
                var thisBnHolder = $(this);

                thisBnHolder.css('display','inline-block');

                var slideshowSpeed = (thisBnHolder.data('slideshowSpeed') !== '' && thisBnHolder.data('slideshowSpeed') !== undefined) ? thisBnHolder.data('slideshowSpeed') : 3000;
                var animationSpeed = (thisBnHolder.data('animationSpeed') !== '' && thisBnHolder.data('animationSpeed') !== undefined) ? thisBnHolder.data('animationSpeed') : 400;

                thisBnHolder.flexslider({
                    selector: ".mkd-bn-text",
                    animation: "fade",
                    controlNav: false,
                    directionNav: false,
                    maxItems: 1,
                    allowOneSlide: true,
                    slideshowSpeed: slideshowSpeed,
                    animationSpeed: animationSpeed
                });
            });
        }
    }

    /*
     **  Init post slider
     */
    function mkdPostSlider(){

        var sliders = $('.mkd-ps-holder');

        if(sliders.length){
            sliders.each(function(){
                var thisSliderHolder = $(this),
                    thisSlider = thisSliderHolder.children('.mkd-bnl-outer'),
                    control = false,
                    directionNav = false,
                    maxItems = mkdSliderNumberOfItems(thisSliderHolder);

                directionNav = thisSliderHolder.data('display_navigation') == 'yes';
                control = thisSliderHolder.data('display_paging') == 'yes';

                thisSlider.flexslider({
                    selector: ".mkd-slider-holder > .mkd-slider-item",
                    animation: "slide",
                    controlNav: control,
                    customDirectionNav: "<span><b></b></span>",
                    directionNav: directionNav,
                    prevText: "<span class='ion-ios-arrow-left'></span>",
                    nextText: "<span class='ion-ios-arrow-right'></span>",
                    minItems: maxItems,
                    maxItems: maxItems,
                    move: 1,
                    itemWidth: 200,
                    itemMargin: 8,
                    slideshowSpeed: 4000,
                    animationSpeed: 400,
                    start: function() {
                        setTimeout(function(){
                            thisSlider.css('opacity','1');
            				thisSlider.find('.flex-direction-nav li a').css({'opacity': '1'});
            				mkd.modules.common.mkdInitParallax();
                        }, 200);
                    }
                });
            });
        }
    }

    /*
	 * Calculate number of elements for slider
     */

     function mkdSliderNumberOfItems(slider){

     	var maxItems = 2;

		if (slider.hasClass('three-posts')){
			maxItems = 3;
		}
		else if (slider.hasClass('four-posts')){
			maxItems = 4;
		}

		if (mkd.windowWidth < 769){
			maxItems = 1;
		}
		else if(mkd.windowWidth < 1025){
			maxItems = 2;
		}

		return maxItems;
     }

    /*
	 * Resizing slider
     */

    function mkdSliderResize(){

        var sliders = $('.mkd-ps-holder');

        if(sliders.length){
            sliders.each(function(){
                var thisSliderHolder = $(this),
                    thisSlider = thisSliderHolder.children('.mkd-bnl-outer'),
                    thisItems = thisSlider.find('.mkd-post-item');

                var items = mkdSliderNumberOfItems(thisSliderHolder);
                
				thisSlider.data('flexslider').vars.minItems = items;
				thisSlider.data('flexslider').vars.maxItems = items;

            });
        }
    }

    /*
     **  Init with thumbnails slider
    */
    function mkdPostWithThumbnailSlider(){

        var withThumbnailSlider = $('.mkd-pswt-holder');

        if(withThumbnailSlider.length){
            withThumbnailSlider.each(function(){
                var thisSliderHolder = $(this),
                    thisSlider = thisSliderHolder.find('.mkd-pswt-slider'),
                    thisSliderThumbs = thisSliderHolder.find('.mkd-pswt-thumb-slider'),
                    thisSliderBackgroundHolder = thisSliderHolder.find('.mkd-pswt-background-holder');

                thisSliderHolder.css('opacity','1');

				// On init
				thisSlider.on('init', function(slick){
					var thisSlide = thisSlider.find('.mkd-pswt-slide.slick-current');
					var thisBackground = thisSlide.data('thumb');
					thisSliderBackgroundHolder.css({backgroundImage: 'url('+thisBackground+')'});
				});

				// On before slide change
				thisSlider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
					var thisSlide = thisSlider.find('.mkd-pswt-slide:nth-child('+ parseInt(nextSlide + 1) +')');
					var thisBackground = thisSlide.data('thumb');
					thisSliderBackgroundHolder.css({backgroundImage: 'url('+thisBackground+')'});
				});

				thisSlider.slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: true,
					fade: true,
					autoplay: true,
					asNavFor: thisSliderThumbs
				});

				thisSliderThumbs.slick({
					slidesToShow: 3,
					slidesToScroll: 1,
					asNavFor: thisSlider,
					focusOnSelect: true,
					arrows: false,
					responsive: [{
						breakpoint: 1024,
						settings: {
							slidesToShow: 2
						}
					}]
				});
            });
        }
    }

    /*
    **  Init Interactive slider
    */
    function mkdPostInteractiveSlider(){

        var interactiveSlider = $('.mkd-psi-holder');

        if(interactiveSlider.length){
            interactiveSlider.each(function(){
                var thisSliderHolder = $(this),
                    thisSlider = thisSliderHolder.find('.mkd-psi-slider'),
                    thisSliderThumbs = thisSliderHolder.find('.mkd-psi-slider-thumb'),
                    thisSliderThumbItem = thisSliderThumbs.find('.mkd-psi-slide-thumb'),
                    slidesToShow = 4;

                thisSliderHolder.css('opacity','1');

				thisSlider.on('afterChange', function(event, slick, currentSlide){
					mkdPostInteractiveThumbsHeight(thisSliderHolder);
				});

				if(thisSlider.data('posts-no')){
					var show = thisSlider.data('posts-no');
					if (show < 5){
						slidesToShow = show - 1;
					}
				}

				thisSliderThumbs.on('afterChange', function(event, slick, currentSlide){
					var cloned = thisSliderThumbs.find('.mkd-psi-slide-thumb.slick-cloned');

					//changing z-index of thumbs

					cloned.each(function(){
						var thisThumbItem = $(this);

						thisThumbItem.hover(function(){
							thisSliderThumbs.css("z-index",10);  //increasing z-index so images can be shown
						},function(){
							thisSliderThumbs.css("z-index",1); //decreasing z-index so title, info etc can be clicked
						});
					});
				});


				thisSlider.slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					autoplay: true,
					arrows: true,
					fade: true,
					asNavFor: thisSliderThumbs
				});

				thisSliderThumbs.slick({
					slidesToShow: slidesToShow,
					slidesToScroll: 1,
					asNavFor: thisSlider,
					focusOnSelect: true,
					arrows: false,
					responsive: [{
						breakpoint: 1024,
						settings: {
							slidesToShow: slidesToShow - 1
						}
					}, {
						breakpoint: 600,
						settings: {
						slidesToShow: 2
					}

					}]
				});

				thisSlider.waitForImages(function(){
					mkdPostInteractiveThumbsHeight(thisSliderHolder);
				});

				//changing z-index of thumbs

				thisSliderThumbItem.each(function(){
					var thisThumbItem = $(this);

					thisThumbItem.hover(function(){
						thisSliderThumbs.css("z-index",10);  //increasing z-index so images can be shown
					},function(){
						thisSliderThumbs.css("z-index",1); //decreasing z-index so title, info etc can be clicked
					});
				});
            });
        }
    }

    /*
     **  Calculate Interactive Slider height
    */
    function mkdPostInteractiveHeight(){

        var interactiveSlider = $('.mkd-psi-holder');

        if(interactiveSlider.length){
            interactiveSlider.each(function(){
                var thisSliderHolder = $(this),
                    thisSlider = thisSliderHolder.find('.mkd-psi-slider'),
                    thisSlides = thisSlider.find('.mkd-psi-slide'),
                    proportion = 1,
                    slidesHeight;

				thisSlides.each(function(){
					var thisSlide = $(this),
						thisProportion = thisSlide.data('image-proportion');

					if (thisProportion < proportion){
						proportion = thisProportion;
					}

				});

				if (thisSlider.data('image-height')){
					var imageHeight = thisSlider.data('image-height');
					if (mkd.windowWidth > 1280){
						slidesHeight = imageHeight;
					}
					else if (mkd.windowWidth > 1024){
						slidesHeight = imageHeight*0.59;
					}
					else if (mkd.windowWidth > 768){
						slidesHeight = imageHeight*0.62;
					}
					else if (mkd.windowWidth > 480){
						slidesHeight = imageHeight*0.57; 
					}
					else{
						slidesHeight = imageHeight*0.52;
					}
				}
				else{
					slidesHeight = mkd.windowWidth*proportion;
				}

				thisSlides.each(function(){
					var thisSlide = $(this);

					thisSlide.css({height: slidesHeight + 'px'});

				});

				mkdPostInteractiveThumbsHeight(thisSliderHolder);

            });
        }

    }


    /*
     **  Calculate Interactive Slider Thumbs height
    */
    function mkdPostInteractiveThumbsHeight(interactiveSlider){

        var thisSlider = interactiveSlider.find('.mkd-psi-slider'),
            thisSlideCurrent = thisSlider.find('.mkd-psi-slide.slick-current'),
            thisThumbSlides = interactiveSlider.find('.mkd-psi-thumb-slider-holder'),
            thisThumbsImage = thisThumbSlides.find('.mkd-psi-image'),
            thisThumbsSlick = thisThumbSlides.find('.slick-track'),
            thisThumbsBackground = interactiveSlider.find('.mkd-psi-thumb-slider-backg'),
            thumbsHeight;


		thumbsHeight = thisSlideCurrent.find('.mkd-psi-content').height();

		thisThumbsImage.each(function(){
			var thisThumb = $(this);

			thisThumb.css({height: thumbsHeight + 'px'});
		});

		thisThumbSlides.css({marginTop : -thumbsHeight + 'px'});
		thisThumbsSlick.css({marginTop : thumbsHeight + 'px'});
		thisThumbsBackground.css({height : 'calc(100% - ' + parseInt(thumbsHeight) + 'px)'});

    }

    /*
     **  Init post carousel
     */
    function mkdPostCarousel(){

        var carousels = $('.mkd-pc-holder');

        if(carousels.length){
            carousels.each(function(){
                var thisCarouselHolder = $(this),
                    thisCarousel = thisCarouselHolder.children('.mkd-bnl-outer'),
                    thisCarouselImageLinks = thisCarouselHolder.find('.mkd-pt-one-slide-link.mkd-image-link'),
                    control = false,
                    directionNav = false,
                    maxItems = mkdCarouselNumberOfItems(thisCarouselHolder);

                directionNav = thisCarouselHolder.data('display_navigation') == 'yes';
                control = thisCarouselHolder.data('display_paging') == 'yes';

                thisCarousel.flexslider({
                    selector: ".mkd-carousel-holder > .mkd-carousel-item",
                    animation: "slide",
                    controlNav: control,
                    customDirectionNav: "<span><b></b></span>",
                    directionNav: directionNav,
                    prevText: "<span class='ion-ios-arrow-left'></span>",
                    nextText: "<span class='ion-ios-arrow-right'></span>",
                    minItems: maxItems,
                    maxItems: maxItems,
                    itemWidth: 200,
                    itemMargin: 7,
                    slideshowSpeed: 4000,
                    animationSpeed: 500,
                    start: function() {
                        setTimeout(function(){
                            thisCarousel.css('opacity','1');
            				thisCarousel.find('.flex-direction-nav li a').css({'opacity': '1'});
            				mkd.modules.common.mkdInitParallax();
                        }, 200);
                    }
                });

				thisCarouselImageLinks.each(function(){
					var thisLink = $(this);
					if (mkd.html.hasClass('touch')){
						thisLink.on("click tap touch",function(e){
							if (thisLink.hasClass('mkd-hover-link')){
								return true;
							}
							else{
								thisLink.addClass('mkd-hover-link');
								e.preventDefault();
								return false;
							}
						});
					}
				});
            });
        }
    }

    /*
	 * Calculate number of elements for carousel
     */

     function mkdCarouselNumberOfItems(carousel){

     	var maxItems = 2;

		if (carousel.hasClass('three-posts')){
			maxItems = 3;
		}
		else if (carousel.hasClass('four-posts')){
			maxItems = 4;
		}

		if (mkd.windowWidth < 481){
			maxItems = 1;
		}
		else if(mkd.windowWidth < 1025){
			maxItems = 2;
		}

		return maxItems;
     }

    /*
	 * Resizing carousel
     */

    function mkdCarouselResize(){

        var carousels = $('.mkd-pc-holder');

        if(carousels.length){
            carousels.each(function(){
                var thisCarouselHolder = $(this),
                    thisCarousel = thisCarouselHolder.children('.mkd-bnl-outer'),
                    thisItems = thisCarousel.find('.mkd-post-item');

                var items = mkdCarouselNumberOfItems(thisCarouselHolder);
                
				thisCarousel.data('flexslider').vars.minItems = items;
				thisCarousel.data('flexslider').vars.maxItems = items;

				thisItems.each(function(i){
					var thisItem = $(this),
						thisItemTitle = thisItem.find('.mkd-pt-one-title-holder'),
						thisItemContent = thisItem.find('.mkd-pt-one-content-holder-outer'),
                        thisDate = thisItem.find('.mkd-post-info-date'),
						thisItemContentHeight = '',
						thisItemTitleHeight = '',
                        thisDateHeight = '',
						thisMovement = '';

						setTimeout(function(){
							thisItemContentHeight = thisItemContent.outerHeight(),
                            thisItemTitleHeight = thisItemTitle.outerHeight(true),
							thisDateHeight = thisDate.outerHeight(true),
							thisMovement = - thisItemContentHeight + thisDateHeight + thisItemTitleHeight + 20; //20 is top padding plus date line height space
							thisItemContent.css({'bottom': thisMovement + 'px'});
						},100); //timeout is set because of the calculation of excerpt height properly

					
					thisItem.on('mouseenter',function(){
						thisItemContent.css({'bottom': 0});
					});

					thisItem.on('mouseleave',function(){
						thisItemContent.css({'bottom': thisMovement + 'px'});
					});
				});

            });
        }
    }
     /*
     **  Init post carousel swipe
     */
    function mkdPostCarouselSwipe(){

        var swipeCarousels = $('.mkd-pcs-holder');

        if(swipeCarousels.length){
            swipeCarousels.each(function(){
                var thisSwipeCarousel = $(this);
                var thisSwipe = thisSwipeCarousel.children('.mkd-bnl-outer');
                var thisSwipeItem = thisSwipe.find('.mkd-post-item');
                var thisSwipeImageLinks = thisSwipeItem.find('.mkd-pt-five-link.mkd-image-link');

                var slidesToShow = 3;
                if (thisSwipeCarousel.hasClass('two-posts')){
                	slidesToShow = 2;
                }
                else if (thisSwipeCarousel.hasClass('four-posts')){
                	slidesToShow = 4;
                }

				thisSwipe.on('init', function(event, slick){
					thisSwipe.animate({opacity: 1},200);
					mkd.modules.common.mkdInitParallax();
				});

                thisSwipe.slick({
                    arrows: true,
                    autoplay: true,
                    autoplaySpeed: 4000,
                    infinite: true,
                    speed: 500,
                    slidesToShow: slidesToShow,
                    slidesToScroll: 1,
                    responsive: [
                        {
                          breakpoint: 1025,
                          settings: {
                            slidesToShow: 2
                          }
                        },
                        {
                          breakpoint: 600,
                          settings: {
                            slidesToShow: 1
                          }
                        }
                    ]
                });

				thisSwipeImageLinks.each(function(){
					var thisLink = $(this);
					if (mkd.html.hasClass('touch')){
						thisLink.on("click tap touch",function(e){
							if (thisLink.hasClass('mkd-hover-link')){
								return true;
							}
							else{
								thisLink.addClass('mkd-hover-link');
								e.preventDefault();
								return false;
							}
						});
					}
				});
            });
        }
    }

    /*
    **  Init post carousel swipe hover
    */
    function mkdPostCarouselSwipeHover(){

        var swipeCarousels = $('.mkd-pcs-holder');

        if(swipeCarousels.length){
            swipeCarousels.each(function(){
                var thisSwipeCarousel = $(this);
                var thisSwipeItem = thisSwipeCarousel.find('.mkd-post-item');

				thisSwipeItem.each(function(){
					var thisItem = $(this),
						thisSwipeExcerpt = thisItem.find('.mkd-pt-one-excerpt'),
						thisMovement = thisSwipeExcerpt.outerHeight(true),
						thisSwipeContent = thisItem.find('.mkd-pt-five-content'),
						thisSwipeInfo = thisItem.find('.mkd-pt-info-section'),
						thisInfoHeight = thisSwipeInfo.height();

					if (thisInfoHeight){
						thisMovement += thisInfoHeight;
					}

					thisSwipeContent.css({bottom: -thisMovement + 'px'});

					thisItem.on('mouseenter',function(){

						thisSwipeContent.css({bottom: '0'});

					});

					thisItem.on('mouseleave',function(){

						thisSwipeContent.css({bottom: -thisMovement + 'px'});

					});
				});
            });
        }
    }
    /*
     **  Init sticky sidebar widget
     */
    function mkdInitStickyWidget() {

        var stickyHeader = $('.mkd-sticky-header'),
            mobileHeader = $('.mkd-mobile-header'),
            stickyWidgets = $('.mkd-widget-sticky-sidebar');
        if ( stickyWidgets.length && mkd.windowWidth > 1024 ) {

            stickyWidgets.each(function(){
                var widget = $(this),
                    parent =  '.mkd-full-section-inner, .mkd-section-inner, .mkd-two-columns-75-25, .mkd-two-columns-25-75, .mkd-two-columns-66-33, .mkd-two-columns-33-66',
                    stickyHeight = 0,
                    widgetOffset = widget.offset().top;


                if (widget.parent('.mkd-sidebar').length) {
                    var sidebar = widget.parents('.mkd-sidebar');
                } else if (widget.parents('.wpb_widgetised_column').length) {
                    var sidebar = widget.parents('.wpb_widgetised_column');
                    widget.closest('.wpb_column').css('position','static');
                }

                var sidebarOffset = sidebar.offset().top;
				if(mkd.body.hasClass('mkd-sticky-header-on-scroll-down-up')){
					stickyHeight = mkdGlobalVars.vars.mkdStickyHeaderHeight;
                }else{
					stickyHeight = 0;
                }
                var offset = -(widgetOffset-sidebarOffset-stickyHeight-10); //10 is to push down from browser top edge


                sidebar.stick_in_parent({
                    parent: parent,
                    sticky_class : 'mkd-sticky-sidebar',
                    inner_scrolling : false,
                    offset_top: offset,
                }).on("sticky_kit:bottom", function() { //check if sticky sidebar have hit the bottom and use that class for pull it down when sticky header appears
                    sidebar.addClass('mkd-sticky-sidebar-on-bottom');
                }).on("sticky_kit:unbottom", function() {
                    sidebar.removeClass('mkd-sticky-sidebar-on-bottom');
                });

                $(window).scroll(function(){
                    if (mkd.windowWidth >= 1024 ) {
                        if (stickyHeader.hasClass('header-appear') && mkd.body.hasClass('mkd-sticky-header-on-scroll-up') && sidebar.hasClass('mkd-sticky-sidebar') && !sidebar.hasClass('mkd-sticky-sidebar-on-bottom')) {
                            sidebar.css('-webkit-transform', 'translateY('+mkdGlobalVars.vars.mkdStickyHeaderHeight+'px)');
                            sidebar.css('transform', 'translateY('+mkdGlobalVars.vars.mkdStickyHeaderHeight+'px)');
                        } else {
                            sidebar.css('-webkit-transform', 'translateY(0px)');
                            sidebar.css('transform', 'translateY(0px)');
                        }
                    }else{
                        if ( mobileHeader.hasClass('mobile-header-appear') && sidebar.hasClass('mkd-sticky-sidebar') && !sidebar.hasClass('mkd-sticky-sidebar-on-bottom')) {
                            sidebar.css('-webkit-transform', 'translateY('+mkdGlobalVars.vars.mkdMobileHeaderHeight+'px)');
                            sidebar.css('transform', 'translateY('+mkdGlobalVars.vars.mkdMobileHeaderHeight+'px)');
                        } else {
                            sidebar.css('-webkit-transform', 'translateY(0px)');
                            sidebar.css('transform', 'translateY(0px)');
                        }
                    }
                });

            });
        }

    }

    /**
     * Object that represents post pagination
     * @returns {{init: Function}} function that initializes post pagination functionality
     */
    var mkdPostPagination = mkd.modules.shortcodes.mkdPostPagination = function(){

        // get all post with load more
        var blogBlockWithPaginationLoadMore = $('.mkd-post-pag-load-more');
        var blogBlockWithPaginationPrevNext = $('.mkd-post-pag-np-horizontal');
        var blogBlockWithPaginationInfinitive = $('.mkd-post-pag-infinite');

        $('.mkd-post-item').addClass('mkd-active-post-page');

        /**
         * Function that triggers load more functionality
         */
        var mkdPostLoadMoreEvent = function (thisBlock) {
            var thisBlockShowLoadMoreHolder = thisBlock.children('.mkd-bnl-navigation-holder'),
                thisBlockShowLoadMore = thisBlockShowLoadMoreHolder.children('.mkd-bnl-load-more'),
                thisBlockShowLoadMoreLoading = thisBlockShowLoadMoreHolder.children('.mkd-bnl-load-more-loading'),
                thisBlockShowLoadMoreButton = thisBlockShowLoadMore.children(),
                blockData = mkdPostData(thisBlock),
                blogBlockOuter = thisBlock.children('.mkd-bnl-outer'),
                isBlockItem = isBlock(thisBlock);

            thisBlockShowLoadMoreButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                thisBlockShowLoadMore.hide();
                thisBlockShowLoadMoreLoading.css('display', 'inline-block');

                blockData.paged = blockData.next_page;

                $.ajax({
                    type: 'POST',
                    data: blockData,
                    url: mkdGlobalVars.vars.mkdAjaxUrl,
                    success: function (data) {
                        var response = $.parseJSON(data);
                        if(response.showNextPage === true){
                            blockData.next_page++;
                            thisBlock.waitForImages(function(){
                                if(isBlockItem) {
                                    blogBlockOuter.append(response.html);
                                }
                                else{
                                    blogBlockOuter.children('.mkd-bnl-inner').append(response.html);
                                } // Append the new content

                                setTimeout(function() {
                                    postAjaxCallback(thisBlock);
                                }, 100); // to prevent adding class before adding response html via after
                            });

                            if(blockData.max_pages > (blockData.paged)){
                                thisBlockShowLoadMore.show();
                                thisBlockShowLoadMoreLoading.hide();
                            }
                            else{
                                thisBlockShowLoadMoreHolder.hide();
                            }
                        }
                    }
                });
            });
        };

        /**
         * Function that triggers next prev functionality
         */
        var mkdPostNextPrevEvent = function (thisBlock) {
            var thisBlockPostPrevNextButton = thisBlock.children('.mkd-bnl-navigation-holder').find('a'),
                thisBlockAjaxPreloader = thisBlock.children('.mkd-post-ajax-preloader'),
                blockData = mkdPostData(thisBlock),
                blogBlockOuter = thisBlock.children('.mkd-bnl-outer'),
                isBlockItem = isBlock(thisBlock);

            thisBlockPostPrevNextButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                blockData.paged = getClickedButton($(this), blockData);
                if(blockData.paged == false){
                    return;
                }

                if(!setAjaxLoading(thisBlock, true)){
                    return;
                }

                thisBlockAjaxPreloader.show();

                if (!isBlockItem) {
                    blogBlockOuter.children('.mkd-bnl-inner').find('.mkd-post-item').addClass('mkd-removed-post-page');
                }

                $.ajax({
                    type: 'POST',
                    data: blockData,
                    url: mkdGlobalVars.vars.mkdAjaxUrl,
                    success: function (data) {
                        var response = $.parseJSON(data);
                        if (response.showNextPage === true) {
                            blockData.next_page = blockData.paged + 1;
                            blockData.prev_page = blockData.paged - 1;
                            thisBlock.waitForImages(function () {

                                if (isBlockItem) {
                                    blogBlockOuter.html(response.html);
                                }
                                else {
                                    var postItems = thisBlock.hasClass('mkd-pl-eight-holder') ? $(response.html).find('.mkd-post-item') : response.html;
                                    blogBlockOuter.children('.mkd-bnl-inner').find('.mkd-post-item:last').after(postItems);
                                    thisBlock.find('.mkd-removed-post-page').remove();
                                }// Append the new content

                                setTimeout(function(){

                                    thisBlock.css('min-height', '');
                                    thisBlockAjaxPreloader.hide();
                                    setAjaxLoading(thisBlock, false);
                                    postAjaxCallback(thisBlock);

                                },400);
                            });
                        }
                    }
                });
            });

            function setAjaxLoading(thisBlock, start) {
                if(start){
                    if(!thisBlock.hasClass('mkd-post-pag-active')) {
                        thisBlock.css('min-height', thisBlock.height());
                        thisBlock.addClass('mkd-post-pag-active');
                        return true;
                    }
                    else{
                        return false;
                    }
                }

                else if(!start && thisBlock.hasClass('mkd-post-pag-active')) {
                    thisBlock.removeClass('mkd-post-pag-active');
                }

                return true;
            }

            function getClickedButton(thisButton, blockData) {
                if (thisButton.hasClass('mkd-bnl-nav-next') && blockData.next_page <= blockData.max_pages) {
                    return blockData.paged = blockData.next_page;
                }
                else if (thisButton.hasClass('mkd-bnl-nav-prev') && blockData.prev_page > 0) {
                    return blockData.paged = blockData.prev_page;
                }
                else {
                    return false;
                }
            }
        };

        /**
         * Function that triggers load more functionality
         */
        var mkdPostInfinitiveEvent = function (thisBlock) {
            var blogBlockOuter = thisBlock.children('.mkd-bnl-outer'),
                blockData = mkdPostData(thisBlock),
                isBlockItem = isBlock(thisBlock);

            mkd.window.scroll(function () {

                if(!thisBlock.hasClass('mkd-ajax-infinite-started') &&(blockData.next_page <= blockData.max_pages) && ((mkd.window.height() + mkd.window.scrollTop()) > (blogBlockOuter.offset().top + blogBlockOuter.height()))) {

                    var preloaderHTML = '<div class="mkd-inf-scroll-preloader mkd-post-ajax-preloader"><div class="mkd-post-ajax-preloader-inner"><div class="mkd-pulse"></div><div class="mkd-pulse"></div><div class="mkd-pulse"></div></div></div>';

                    thisBlock.after(preloaderHTML);
                    thisBlock.addClass('mkd-ajax-infinite-started');
                    blockData.paged = blockData.next_page;

                    setTimeout(function(){
                        $.ajax({
                            type: 'POST',
                            data: blockData,
                            url: mkdGlobalVars.vars.mkdAjaxUrl,
                            success: function (data) {
                                var response = $.parseJSON(data);
                                if (response.showNextPage === true) {
                                    blockData.next_page++;
                                    thisBlock.waitForImages(function () {
                                        if(isBlockItem) {
                                            blogBlockOuter.append(response.html);
                                        }
                                        else{
                                            blogBlockOuter.children('.mkd-bnl-inner').append(response.html);
                                        } // Append the new content

                                        setTimeout(function() {
                                            postAjaxCallback(thisBlock);
                                        }, 100); // to prevent adding class before adding response html via after

                                        thisBlock.removeClass('mkd-ajax-infinite-started');
                                        $('.mkd-inf-scroll-preloader').remove();
                                    });
                                }
                            }
                        });
                    },300); //show inf animation
                }
            });
        };

        function isBlock($thisblock){
            return($thisblock.hasClass("mkd-pb-one-holder") || $thisblock.hasClass("mkd-pb-two-holder"));
        }

        function postAjaxCallback(thisBlock) {

            thisBlock.find('.mkd-post-item').addClass('mkd-active-post-page');

            if(thisBlock.parent().hasClass('widget')) {
                mkd.modules.header.mkdDropDownMenu();
                thisBlock.parent().parent().css('height', '');
            }
            mkdBlockReveal();
            mkdPostLayoutHovers();
            mkdBlocksMovement();
            mkdBlocksHeight();
        }

        return {
            init : function() {
                if (blogBlockWithPaginationLoadMore.length) {
                    blogBlockWithPaginationLoadMore.each(function () {
                        mkdPostLoadMoreEvent($(this));
                    });
                }
                if (blogBlockWithPaginationPrevNext.length) {
                    blogBlockWithPaginationPrevNext.each(function () {
                        mkdPostNextPrevEvent($(this));
                    });
                }
                if (blogBlockWithPaginationInfinitive.length) {
                    blogBlockWithPaginationInfinitive.each(function () {
                        mkdPostInfinitiveEvent($(this));
                    });
                }
            }
        };
    };

    /*
     * Init pagination - load more
     * @returns object with data parameters
     */

    function mkdPostData(container) {

        var myObj = container.data();
        myObj.action = 'discussion_list_ajax';

        return myObj;
    }

    /**
     * Object that represents post layout tabs widget
     * @returns {{init: Function}} function that initializes post layout tabs widget functionality
     */
    var mkdPostLayoutTabWidget = mkd.modules.shortcodes.mkdPostLayoutTabWidget = function(){

        var layoutTabsWidget = $('.mkd-plw-tabs');


        var mkdPostLayoutTabWidgetEvent = function (thisWidget) {
            var plwTabsHolder = thisWidget.find('.mkd-plw-tabs-tabs-holder');
            var plwTabsContent = thisWidget.find('.mkd-plw-tabs-content-holder');
            var currentItemPosition = plwTabsHolder.children('.mkd-plw-tabs-tab:first-child').index() + 1; // +1 is because index start from 0 and list from 1

            setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition);

            plwTabsHolder.find('a').mouseover(function (e) {
                e.preventDefault();

                currentItemPosition = $(this).parents('.mkd-plw-tabs-tab').index() + 1; // +1 is because index start from 0 and list from 1

                setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition);
            });
        };

        function setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition){
            var activeItemClass = 'mkd-plw-tabs-active-item';

            plwTabsContent.children('.mkd-plw-tabs-content').removeClass(activeItemClass);
            plwTabsHolder.children('.mkd-plw-tabs-tab').removeClass(activeItemClass);

            var height = plwTabsContent.children('.mkd-plw-tabs-content:nth-child('+currentItemPosition+')').addClass(activeItemClass).height();
            plwTabsContent.css('min-height',height+'px');
            plwTabsHolder.children('.mkd-plw-tabs-tab:nth-child('+currentItemPosition+')').addClass(activeItemClass);
        }

        return {
            init : function() {
                if (layoutTabsWidget.length) {
                    layoutTabsWidget.each(function () {
                        mkdPostLayoutTabWidgetEvent($(this));
                    });
                }
            },

        };
    }

    /*
    * Post layout hovers
    */
    function mkdPostLayoutHovers() {
        var layoutItems = $('.mkd-pt-one-item, .mkd-pt-two-item, .mkd-pt-three-item, .mkd-pt-six-item, .mkd-pt-seven-item, .mkd-pt-nine-item, .mkd-ps-item');
        if (layoutItems.length) {
            layoutItems.each(function(){
                var thisItem = $(this),
                    link = thisItem.find('.mkd-pt-link, .mkd-image-link');
                link.mouseenter(function(){
                    thisItem.addClass('mkd-item-hovered');
                });
                link.mouseleave(function(){
                    thisItem.removeClass('mkd-item-hovered');
                });
            });
        }
       
    }


    /*
    * Recent comments hover
    */
    function mkdRecentCommentsHover() {
        var link = $('.mkd-rpc-link');
        if(link.length){
            link.each(function(){
                var thisLink = $(this),
                    commentsNumber = thisLink.closest('li').find('.mkd-rpc-number-holder');
                thisLink.mouseenter(function(){
                    commentsNumber.addClass('mkd-hovered');
                });
                thisLink.mouseleave(function(){
                    commentsNumber.removeClass('mkd-hovered');
                });

            });
        }
    }


    /*
    **	Show Google Map
    */
    function mkdShowGoogleMap(){

        if($('.mkd-google-map').length){
            $('.mkd-google-map').each(function(){

                var element = $(this);

                var customMapStyle;
                if(typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if(typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }
                var addresses;
                if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }

                var map = "map_"+ uniqueId;
                var geocoder = "geocoder_"+ uniqueId;
                var holderId = "mkd-map-"+ uniqueId;

                mkdInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
            });
        }

    }
    /*
     **	Init Google Map
     */
    function mkdInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){

        var mapStyles = [
            {
                stylers: [
                    {hue: color },
                    {saturation: saturation},
                    {lightness: lightness},
                    {gamma: 1}
                ]
            }
        ];

        var googleMapStyleId;

        if(customMapStyle){
            googleMapStyleId = 'mkd-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        var qoogleMapType = new google.maps.StyledMapType(mapStyles,
            {name: "Mikado Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if (!isNaN(height)){
            height = height + 'px';
        }

        var myOptions = {

            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'mkd-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('mkd-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            mkdInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }
    /*
     **	Init Google Map Addresses
     */
    function mkdInitializeGoogleAddress(data, pin,  map, geocoder){
        if (data === '')
            return;
        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<div id="bodyContent">'+
            '<p>'+data+'</p>'+
            '</div>'+
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        geocoder.geocode( { 'address': data}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon:  pin,
                    title: data['store_title']
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

                google.maps.event.addDomListener(window, 'resize', function() {
                    map.setCenter(results[0].geometry.location);
                });

            }
        });
    }

})(jQuery);
(function($) {
    'use strict';

    var woocommerce = {};
    mkd.modules.woocommerce = woocommerce;

    woocommerce.mkdInitQuantityButtons = mkdInitQuantityButtons;
    woocommerce.mkdInitSelect2 = mkdInitSelect2;

    woocommerce.mkdOnDocumentReady = mkdOnDocumentReady;
    woocommerce.mkdOnWindowLoad = mkdOnWindowLoad;
    woocommerce.mkdOnWindowResize = mkdOnWindowResize;
    woocommerce.mkdOnWindowScroll = mkdOnWindowScroll;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdOnDocumentReady() {
        mkdInitQuantityButtons();
        mkdInitSelect2();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdOnWindowScroll() {

    }
    

    function mkdInitQuantityButtons() {

        $('.mkd-quantity-minus, .mkd-quantity-plus').click(function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.siblings('.mkd-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('mkd-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(1);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined ) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }

        });

    }

    function mkdInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length ||  $('#calc_shipping_country').length ) {

            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });

            $('#calc_shipping_country').select2();

        }

    }


})(jQuery);