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