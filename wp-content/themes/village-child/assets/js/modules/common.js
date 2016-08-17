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