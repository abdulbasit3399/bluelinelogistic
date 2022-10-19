var i_refresh = {};
var is_RTL = false;

(function($){


    'use strict';

    var $doc, $body, $window, $html, adBlock = false, $fixedEnabled, $navHeghit, intialWidth, has_lazy, has_sticky_nav, ad_blocker_detector, mobile_topmenu, menuHeight, stickyNavTop,
        adminbarOffset, mobile_menu, $bd_popup, outer, widthHasScroll, click_to_comments, sticky_sidebar, window_height, window_offest, is_singular, post_reading_position_indicator, heart, post_id, ajaxurl, nonce, all_lightbox;

    $(document).ready(function(){

        // Debugging
        performance.mark('KolStart');



        /**
         * Load Effects
         */
        //bd_lazy_load();


        $doc                = $ (document );
        $body               = jQuery(document.body);
        $window             = jQuery(window);
        $html               = jQuery( 'html' );
        adBlock             = false;
        $fixedEnabled       = jQuery( 'nav#navigation.fixed-enabled' );
        $navHeghit          = jQuery( '.navigation-outer' );
        intialWidth         = jQuery(window).width();
        has_lazy            = true;
        has_sticky_nav      = true;
        ad_blocker_detector = true
        mobile_topmenu      = true;
        click_to_comments   = false;
        sticky_sidebar      = true;
        is_singular         = false;
        all_lightbox        = true;
        ajaxurl             = '';
        nonce               = '';

        mobile_menu = jQuery( '.bd-push-menu #mobile-menu' );
        $bd_popup = jQuery( '.bdaia-popup' );
        adminbarOffset = $body.is('.admin-bar') ? jQuery('#wpadminbar').height() : 0;
        post_reading_position_indicator = true;


        function bd_lazy_load( element, area ) {

            if ( typeof element != 'undefined' ) {
                var $percent_rating = element.find( '.rating-percentages-inner' );
                var $lazy_load_img  = element.find('.bdaia-fp-post-img-container, .mm-img, .img, .img-lazy, .lazy-bg, .article-thumb-bg .article-link-thumb-bg');
            }
            else {
                var $percent_rating = jQuery( '.rating-percentages-inner' );
                var $lazy_load_img  = jQuery('.bdaia-fp-post-img-container, .mm-img, .img, .img-lazy:visible, .lazy-bg:visible, .article-thumb-bg .article-link-thumb-bg');
            }

            $percent_rating.viewportChecker({
                callbackFunction: function(elem, action){

                    setTimeout(function(){
                        var rate_val = elem.data('rate-val') + '%';
                        elem.velocity('stop').velocity({width: rate_val},{stagger: 200, duration: 600});
                    },500);
                }
            });

            $lazy_load_img.viewportChecker({
                callbackFunction: function(elem, action){
                    setTimeout(function(){
                        elem.lazy({
                            effect:    'fadeIn',
                            effectTime: 500,
                        });

                    },500);
                }
            });

        }

/*
        jQuery('.insta-lazy').lazy({
            effect:    'fadeIn',
            effectTime: 500,
        });
*/


        /**
         * A Scroll Animate
         */
        jQuery('a[href^="#"]').on('click', function(event){
            var target = jQuery(this.getAttribute('href'));

            if(target.length){
                event.preventDefault();

                jQuery('html, body').stop().animate({
                    scrollTop: target.offset().top
                }, 1000);
            }
        });




        /**
         * Prevent Default
         */
        jQuery('.prev, .nxt, .flex-next, .flex-prev, .bdaia-load-comments-btn a, .bd-login-j a').on('click', function(event) {
            event.preventDefault();
        });





        /**
         * Responsive Videos
         */
        /*jQuery('#page').fitVids({
            ignore         : '',
            customSelector : "iframe[src*='maps.google.com'], iframe[src*='google.com/maps'], iframe[src*='dailymotion.com'], iframe[src*='twitter.com/i/videos']"
        });*/


        /**
         * Topbar Search
         */
        jQuery("span.bdaia__top_header_search_icon").on('touchend click', function(e) {

            if (jQuery('div.bdaia__top_header_search').hasClass('bdaia__top_expanded_search') === !1) {
                e.preventDefault();
                jQuery("div.bdaia__top_header_search").addClass("bdaia__top_expanded_search");
                jQuery("div.bdaia__top_header_search input.search-field").focus();

            } else {
                if (!jQuery('div.bdaia__top_header_search input.search-field').val()) {
                    e.preventDefault();
                    jQuery("div.bdaia__top_header_search").removeClass("bdaia__top_expanded_search");
                    jQuery("div.bdaia__top_header_search input.search-field").blur()
                }
            }
        });


        /**
         * Sticky nav
         */
        /*var activeSubNav = jQuery('.bd-subnav-wrapper').outerHeight();
        var menuHeight = $fixedEnabled.outerHeight();

        $fixedEnabled.parent().css({height:menuHeight});
        $fixedEnabled.tiesticky('destroy');

        if($fixedEnabled.length > 0 && intialWidth > 991){

            var stickyNavTop = $fixedEnabled.offset().top;

            $fixedEnabled.tiesticky({
                offset : stickyNavTop,
                tolerance : 0
            });
        }*/


        /**
         * Menu Slideout
         */
        function hasParentClass( e, classname ) {

            if ( e === document ) {
                return false;
            }

            if ( jQuery(e).hasClass( classname ) ) {
                return true;
            }
            return e.parentNode && hasParentClass( e.parentNode, classname );
        }

        var resetMenu = function() {
            $body.removeClass('bd-push-menu-open');

            }, bodyClickFn = function(evt){

                if ( !hasParentClass( evt.target, 'bd-push-menu' ) )
                {
                    resetMenu();

                    document.removeEventListener( 'touchstart', bodyClickFn );
                    document.removeEventListener( 'click', bodyClickFn );
                }
            }, el = jQuery('.bdaia-push-menu');

        el.on( 'touchstart click', function( ev ) {
            ev.stopPropagation();
            ev.preventDefault();

            jQuery('body').addClass('bd-push-menu-open');

            if ( has_lazy )
            {
                jQuery( 'aside.bd-push-menu .lazy-img' ).lazy( { bind: 'event' } );
            }
        } );

        $body.on( 'touchstart click', bodyClickFn );
        $doc.on( 'keydown', function(e) {
            if ( e.which == 27 ) {
                resetMenu();
                document.removeEventListener( 'touchstart', bodyClickFn );
                document.removeEventListener( 'click', bodyClickFn );
            }
        });

        jQuery('body').on("click", ".bd-push-menu-close" , function(){
            resetMenu();
        });

        $window.resize(function() {
            intialWidth = $window.width();

            if ( intialWidth == 991 ) {
                resetMenu();
            }
        });

        var mobileItems = jQuery( '.bdaia-header-default #navigation #menu-primary' ).clone();
        mobileItems.find( '.sub_cats_posts .mega-menu-content, .nav-logo, .logo, .bd-push-menu-btn' ).remove();

        mobile_menu.append( mobileItems );
        if(mobile_topmenu){
            var mobileItemsTop = jQuery( '.bdaia-header-default .topbar ul.top-nav' ).clone();
            mobile_menu.append( mobileItemsTop );
        }

        var subNavItem = jQuery( '.bd-subnav-wrapper .sub-nav' ).clone();
        mobile_menu.append( subNavItem );

        jQuery( ".bd-push-menu #mobile-menu .menu-item-has-children" ).append( '<span class="mobile-arrows fa fa-chevron-down isOpen"></span>' );
        $doc.on( "click", "#mobile-menu .menu-item-has-children .mobile-arrows", function() {
            if ( jQuery( this ).hasClass( "isOpen" ) ) {
                jQuery( this ).removeClass( "isOpen" );
            }
            else {
                jQuery( this ).removeClass( "isOpen" ).addClass( "isOpen" );
            }
            jQuery( this ).parent().find( 'ul:first' ).toggle();
        });

        function bd_get_scroll_bar_width () {
            outer               = jQuery( '<div>' ).css( { visibility: 'hidden', width: 100, display: 'none', overflow: 'scroll' } ).appendTo( 'body' );
            widthHasScroll      = jQuery( '<div>' ).css( { width: '100%' } ).appendTo( outer ).outerWidth();

            outer.remove();
            return 100 - widthHasScroll;
        }

        $doc.on('click', '.bd-login-j a', function(event){
            event.preventDefault();
            bd_btn_open('#bd-login-join');
        });

        if(ad_blocker_detector && typeof $adbDE3 == 'undefined'){
            adBlock = true;
            $html.css( { 'marginRight': bd_get_scroll_bar_width(), 'overflow': 'hidden' } );
            setTimeout( function() { $body.addClass( 'bdaia-popup-is-opend' ) }, 10 );
            bd_btn_open( '#bdaia-popup-adblock' );
        }

        function bd_btn_open(windowToOpen){
            jQuery( windowToOpen ).show();
            setTimeout( function() { $body.addClass( 'bdaia-popup-is-opend' ) }, 10) ;
            $html.css( { 'marginRight': bd_get_scroll_bar_width(), 'overflow': 'hidden' } );
        }

        if ($bd_popup.length && ! adBlock) {
            $doc.keyup(function(event){
                if (event.which == '27' && $body.hasClass('bdaia-popup-is-opend')){
                    bd_close_popup();
                }
            });
        }

        $bd_popup.on('click', function(event){
            if(jQuery( event.target ).is('.bdaia-popup:not(.is-fixed-popup)')){
                event.preventDefault();
                bd_close_popup();
            }
        });

        jQuery('.bdaia-btn-close').on('click', function(){
            bd_close_popup();
            return false;
        });

        function bd_close_popup(){
            jQuery.when($bd_popup.fadeOut(500)).done( function(){
                $html.removeAttr('style');
            });
            $body.removeClass('bdaia-popup-is-opend');
        }


        /**
         * Points rating
         */
        jQuery(".points-rating-div").each(function( i, el ){
            var points      = jQuery( this );
            var rate_val    = points.attr('data-rate-val') + '%';
            var attr_id     = points.attr( 'id' );
            var id          = jQuery( '#' + attr_id );

            if(points){
                id.velocity('stop').velocity({width: rate_val},{stagger: 200, duration: 600});
            }
        });


        /**
         * iLightbox
         */
        if(jQuery().iLightBox){
            var $pos_class  = jQuery( '.bdaia-post-template' );
            i_refresh       = jQuery( 'a.lightbox-enabled, a[rel="lightbox-enabled, .bd-video-ilightbox"]' ).iLightBox( { autostart: false } );

            jQuery( 'a.lightbox-enabled, a[rel="lightbox-enabled"], .bd-video-ilightbox' ).iLightBox( { autostart: false } );

            $pos_class.find( "div.bdaia-post-content a, .bdaia-post-heading a" ).not( "div.bdaia-post-gallery a" ).not( "div.bdaia-e3-container a" ).not( "._e3lann a" ).each( function( i, el ) {
                var href_value = el.href;
                if ($(this).find('img').length) {
                    $(this).addClass('post_content_image')
                }

            });

            $pos_class.find( '.ilightbox-gallery' ).iLightBox( { path: 'horizontal' } );

            if (all_lightbox) {
                jQuery( '.bdaia-post-content a.post_content_image, .bdaia-post-heading a.post_content_image' ).iLightBox();
            }
        }



        /**
         * Retina
         */
        if ( window.devicePixelRatio > 1 ) {
            jQuery('.bd-retina').each( function() {
                var lowres  = jQuery( this ).attr( 'src' ),
                    highres = lowres.replace( ".png", "@2x.png" );

                highres = highres.replace( ".jpg", "@2x.jpg" );

                jQuery( this ).attr( 'src', highres );
            });

            jQuery( '.bd-retina-data' ).each( function() {
                jQuery( this ).attr( 'src', jQuery( this ).data( 'retina' ) );
                jQuery( this ).addClass( 'bd-retina-src' );
            });
        }


        /**
         * Sticky sidebar
         */
        if( jQuery.fn.theiaStickySidebar ){

            if ( intialWidth > 900 && sticky_sidebar ) {
                jQuery( '.theia_sticky' ).theiaStickySidebar( {
                    "additionalMarginTop"   : 32,
                    'minWidth'              : 990
                } );

                jQuery( '.is-sticky' ).theiaStickySidebar( {
                    "additionalMarginTop"   : 32,
                    'additionalMarginBottom' : 32,
                    'minWidth'              : 990
                } );
            }
        }


        /**
         * Youtube
         */
        jQuery('iframe[src*="youtube.com"]').each( function(){
            var url = jQuery( this ).attr( 'src' );

            if(jQuery(this).attr( 'src' ).indexOf( '?' ) > 0 ){
                jQuery(this).attr({
                    'src'   : url + '&wmode=transparent',
                    'wmode' : 'Opaque'
                });
            }
            else {
                jQuery( this ).attr({
                    'src'   : url + '?wmode=transparent',
                    'wmode' : 'Opaque'
                });
            }
        });


        /**
         * Go top
         */
        var bdGoTopOffset      = 220;
        var bdGoTopDuration    = 500;
        var bdGoTopClass       = jQuery('.gotop');

        jQuery(window).scroll(function(){
            if ( jQuery( this ).scrollTop() > bdGoTopOffset ){
                bdGoTopClass.css( { opacity: "1", bottom: "5px" } );
            }
            else {
                bdGoTopClass.css( { opacity: "0", bottom: "-60px" } );
            }
        });

        bdGoTopClass.on( 'click', function(event) {
            event.preventDefault();
            jQuery('html, body').animate( { scrollTop: 0 }, bdGoTopDuration );
            return false;
        } );


        /**
         * Mega menu
         */
        jQuery('div.mega-cat-wrapper').each(function(){
            jQuery(this).find('div.mega-cat-content-tab').hide();
            jQuery(this).find('ul.mega-cat-sub-categories li:first').addClass('cat-active').show();
            jQuery(this).find('div.mega-cat-content-tab:first').addClass('already-loaded').show();
            jQuery(this).find('ul.mega-cat-sub-categories li').mouseover(function(event){
                event.preventDefault();

                jQuery( this ).parent().find('li').removeClass('cat-active');
                jQuery( this ).addClass('cat-active');
                jQuery( this ).parent().parent().parent().find('div.mega-cat-content-tab').hide();

                var act_tab = jQuery(this).find('a').attr('id');

                if ( jQuery( act_tab ).hasClass('already-loaded') ) {
                    jQuery( act_tab ).fadeIn( 'fast' );
                }
                else {
                    jQuery( act_tab ).addClass('loading-items').fadeIn( 'fast' , function() {
                        jQuery( this ).removeClass('loading-items').addClass('already-loaded');
                    });
                }
                return false;
            });
        });

        var menu = function( el ) {
            this.target = el;
            this.target.find( '.components-sub-menu' ).css( {
                'dispay'  : 'none',
                'opacity' : 0
            } );

            this.target.on( {
                mouseenter: this.reveal,
                mouseleave: this.conceal
            }, 'li' );
        };

        menu.prototype.reveal = function() {
            var target = jQuery( this ).children( '.components-sub-menu' );

            if ( target.hasClass( 'is_open' ) ) {
                target.velocity( 'stop' ).velocity( 'reverse' );
            }
            else {
                target.velocity( 'stop' ).velocity( 'transition.slideDownIn',{
                        duration: 250,
                        delay   : 0,
                        complete : function() {
                            target.addClass('is_open');
                        }
                    } );
            }
        };

        menu.prototype.conceal = function() {
            var target = jQuery( this ).children( '.components-sub-menu' );

            target.velocity( 'stop' ).velocity( 'transition.fadeOut',{
                    duration: 100,
                    delay   : 0,

                    complete: function() {
                        target.removeClass('is_open');
                    }
                }
            );
        };

        var $menu       = jQuery('ul.bd-components');
        var dropMenu    = new menu($menu);


        /**
         * Breaking Counter
         */
        jQuery( '.breaking-cont ul' ).each( function() {
            if ( ! jQuery( this ).find( 'li.active' ).length ) {
                jQuery( this ).find( 'li:first' ).addClass( 'active fadeIn' );
            }

            var ticker = jQuery( this );

            window.setInterval( function() {
                var active = ticker.find( 'li.active' );

                active.fadeOut( function() {
                    var next = active.next();

                    if ( !next.length ) {
                        next = ticker.find( 'li:first' );
                    }

                    next.addClass( 'active fadeIn' ).fadeIn();
                    active.removeClass( 'active fadeIn' );
                } );
            }, 5000 );
        } );


        /**
         * Custom Scroll
         */
        if ( jQuery.fn.mCustomScrollbar ) {

            jQuery( '.push-menu-has-custom-scroll, .bd-login-join-wrapper' ).each( function () {
                var thisElement     = jQuery( this );
                var scroll_height   = thisElement.data( 'height' ) ? thisElement.data( 'height' ) : 'auto',
                    data_padding    = thisElement.data( 'padding' ) ? thisElement.data( 'padding' ) : 0; thisElement.mCustomScrollbar( 'destroy' );

                if ( thisElement.data( 'height' ) == 'window' ) {
                    var thisHeight      = thisElement.height(),
                        windowHeight    = $window.height() - data_padding - 50;

                    scroll_height = ( thisHeight < windowHeight ) ? thisHeight : windowHeight;
                }

                thisElement.mCustomScrollbar( {
                    scrollButtons       : { enable : false },
                    autoHideScrollbar   : thisElement.hasClass('show-scroll') ? false : true,
                    scrollInertia       : 100,
                    mouseWheel          : { enable: true, scrollAmount: 60 },
                    set_height          : scroll_height,
                    advanced            : { updateOnContentResize: true },
                    callbacks           : {
                        whileScrolling:function() {
                            bd_lazy_load( thisElement, 'custom-scroll-area' );
                        }
                    }
                } );
            } );
        }







        var box_i   = jQuery('.articles-box');

        box_i.each( function (idx, item){

            var box_i3  = jQuery(this);
            var box_i2  = box_i3.attr('id');
            var box_i4  = jQuery('#' + box_i2);
            var box_i5  = jQuery( box_i4 ).find( '.articles-box-filter-links-more-inner' );

            var blocksFilters = jQuery( box_i4 ).find( '.articles-box-filter-links' ).clone();
            box_i5.append( blocksFilters );


            jQuery( box_i4 ).find( '.button-more' ).on('click', function() {

                var isOpen      = box_i5.is(':visible'),
                    slideDir    = isOpen ? 'slideUp' : 'slideDown',
                    dur         = isOpen ? 100 : 200;

                box_i5.velocity('stop').velocity(slideDir, {
                    easing: 'easeOutQuart',
                    duration: dur
                } );
            } );
        } );

        jQuery('body').on('click','.articles-box-title-arrow, .more-btn',function(e) {

            e.preventDefault();

            if($(this).hasClass('pagination-disabled')){
                return false;
            }

            var box                 = jQuery(this).closest('.articles-box');
            var box_id              = box.get(0).id;
            var id                  = jQuery('#' + box_id);
            var the_box             = jQuery.extend( {}, window[ 'js_'+box_id ] );
            var data_page           = jQuery('#'+box_id).attr('data-page');
            var type                = jQuery(this).attr('data-type');


            var box_ele             = jQuery(id).find('.bd_element_widget');
            var box_content         = box.find('.articles-box-content');
            var box_content_items   = box.find('.articles-box-items');
            var box_wrapper         = box.find('.articles-box-container-wrapper');

            if(jQuery(id).find('.articles-box-filter-links').hasClass('filter_categories')){
                var category_id = jQuery(id).find('.articles-box-filter-links li.active a').attr('data-id');
            }else if(jQuery(id).find('.articles-box-filter-links').hasClass('filter_tags')){
                var tag = jQuery(id).find('.articles-box-filter-links li.active a').attr('data-id');
            }

            if ( type == 'prev' ) {
                data_page--;
                var max_page = 1;
            }

            else {
                data_page++;
                var max_page = the_box.max_num_pages;
            }

            if ( jQuery(id).hasClass('bd_element_widget_article') ) {
                var act = 'new_ajax_ele';
            } else {
                var act = 'new_ajax';
            }

            var ajaxData = {
                'action'        : act,
                'the_box'       : the_box,
                'data-page'     : data_page,
                'category_id'   : category_id,
                'tag'           : tag,
                'type'          : type
            };

            //console.log(ajaxData);

            if ( ( data_page <= max_page && ( type =='next' || type=='load_more' || type=='show_more' ) ) || ( data_page >= max_page && type == 'prev' ) )
            {
                jQuery.ajax( {
                    type: 'post',
                    url     : bdaia.ajaxurl,
                    data    : ajaxData,

                    beforeSend: function ()
                    {
                        var blockHeight = box_content.height();
                        box_wrapper.addClass('is-loading')
                    },

                    success: function (data) {

                        //data = jQuery.parseJSON(data);


                        if (type === 'prev') {
                            id.attr('data-page', data_page);
                            id.find('.next_arrow').removeClass('pagination-disabled');
                            id.find('.more-btn').css('display', 'inline-block');

                            if (data_page == 1) {
                                jQuery('#' + box_id).find('.prev_arrow').addClass('pagination-disabled');
                            }
                        }

                        else {
                            id.attr('data-page', data_page);
                            id.find('.prev_arrow').removeClass('pagination-disabled');

                            if (data_page == the_box.max_num_pages) {
                                id.find('.next_arrow').addClass('pagination-disabled');
                                id.find('.more-btn').css('display', 'none');
                            }
                        }

                        if (type == 'load_more') {
                            id.find('.articles-box-content').append(data);
                        }

                        else {
                            id.find('.articles-box-content').html(data);
                        }

                        var box_items_li = box.find('.articles-items-' + data_page);


                        if (type === 'prev') {
                            box_items_li.find( 'li' ).hide().velocity('stop').velocity( 'transition.slideLeftIn', { stagger:100, duration:488, display:"inline-block",
                                complete: function(){
                                    box_items_li.attr( 'style', '' );
                                    bd_lazy_load( box_items_li );
                                }
                            } );
                        }
                        else if (type === 'next')
                        {
                            box_items_li.find( 'li' ).hide().velocity('stop').velocity( 'transition.slideRightIn', { stagger: 100, duration:488, display:"inline-block",
                                complete: function(){
                                    box_items_li.attr( 'style', '' );
                                    bd_lazy_load( box_items_li );
                                }
                            } ) ;
                        }
                        else if (type === 'show_more')
                        {
                            box_items_li.find( 'li' ).hide().velocity('stop').velocity( 'transition.fadeIn', { stagger: 0, duration:488, display:"inline-block",
                                complete: function(){
                                    box_items_li.attr( 'style', '' );
                                    bd_lazy_load( box_items_li );
                                }
                            } ) ;
                        }
                        else {
                            box_items_li.find( 'li' ).hide().velocity('stop').velocity( 'transition.slideUpIn', { stagger:100, duration:488, display:"inline-block",
                                complete: function(){
                                    box_items_li.attr( 'style', '' );
                                    bd_lazy_load( box_items_li );
                                }
                            } );
                        }


                        if(jQuery(id).find('.end_posts').length > 0 || data == ''){
                            id.find('.next_arrow').addClass('pagination-disabled');
                            id.find('.more-btn').css('display', 'none');
                        }
                    },

                    complete: function( data ){
                        box_wrapper.removeClass('is-loading');
                    },
                } );
            }
            return false;
        } );

        jQuery('.filter_categories,.filter_tags').on('click','li a',function(e) { e.preventDefault();

            var box                 = jQuery(this).closest('.articles-box');
            var box_id              = box.attr('id');
            var id                  = jQuery('#' + box_id);
            var the_box             = jQuery.extend( {}, window[ 'js_'+box_id ] );

            if(jQuery(this).closest('.articles-box-filter-links').hasClass('filter_categories')) {
                jQuery('.filter_categories li').removeClass('active');
                jQuery(this).parent('li').addClass('active');
                var category_id = jQuery(this).attr('data-id');
            }else{
                jQuery('.filter_tags li').removeClass('active');
                jQuery(this).parent('li').addClass('active');
                var tag = jQuery(this).attr('data-id');
            }
            var box_content         = jQuery('.articles-box-content');
            var box_content_items   = box.find('.articles-box-items');
            var box_wrapper         = box.find('.articles-box-container-wrapper');
            var box_container       = box.find('.articles-box-container');

            id.find('.end_posts').remove();
            id.find('.next_arrow').removeClass('pagination-disabled');
            id.find('.more-btn').removeAttr('style');
            id.attr('data-page' ,1);


            if ( jQuery(id).hasClass('bd_element_widget_article') ) {
                var act = 'filter_ajax_ele';
            } else {
                var act = 'filter_ajax';
            }

            var ajaxData = {
                'action'        : act,
                'the_box'       : the_box,
                'tag'           : tag,
                'category_id'   : category_id
            };

            jQuery.ajax( {
                type    : "POST",
                url     : bdaia.ajaxurl,
                data    : ajaxData,

                beforeSend: function ()
                {
                    var blockHeight = box_content.height();

                    box_wrapper.addClass('is-loading');

                    box_container.append( '<div class="loader-overlay"><div class="bd-loading"></div></div>' );
                    box_wrapper.find( ".articles-box-load-more" ).css( "max-height", "0px" , "transition", "max-height 1s ease" );
                    box_content_items.css( "opacity", "0.5" );


                    if ( box.hasClass('articles-box-next_prev') ) {
                        box.find( ".loader-overlay" ).remove();
                    }

                },

                success: function (data) {
                    id.find('.articles-box-content').html(data);
                    if(jQuery(id).find('.end_posts').length > 0){
                        id.find('.next_arrow').addClass('pagination-disabled');
                        id.find('.more-btn').css('display', 'none');
                    }
                },

                complete: function( data ){
                    box_wrapper.removeClass('is-loading');
                    box_container.find( ".loader-overlay" ).remove();
                    box_wrapper.find( ".articles-box-load-more" ).css( "max-height", "100%", "transition", "max-height 1s ease" );
                    box_content_items.css( "opacity", "1" );

                    jQuery(id).find( 'ul.articles-box-items li' ).hide().velocity('stop').velocity( 'transition.slideRightIn', { stagger: 100, duration:488, display:"inline-block",
                        complete: function(){
                            jQuery(id).find( 'ul.articles-box-items li' ).attr( 'style', '' );
                            bd_lazy_load( jQuery(id).find( 'ul.articles-box-items li' ) );
                        }
                    } ) ;
                },
            } );

            return false;
        } );


        jQuery('body').on('click','.general-more-btn', function(e) {

            e.preventDefault();

            var pagination_btn = jQuery( '.general-more-btn' );

            if ( ! pagination_btn.length ) {
                return false;
            }


            var the_query       = pagination_btn.attr('data-q'),
                the_url         = pagination_btn.attr('data-url'),
                max_num_pages   = pagination_btn.attr('data-max-num'),
                query_vars      = pagination_btn.attr('data-query-vars'),
                posts_per_page   = pagination_btn.attr('data-posts-per-page'),
                button_text     = pagination_btn.attr('data-text'),
                latest_post     = pagination_btn.attr('data-latest'),
                csrf_token      = pagination_btn.attr('data-csrf');



            var boxx                 = jQuery(this).closest('.articles-box');
            var boxx_id              = boxx.attr('id');
            var id                  = jQuery('#' + boxx_id);

            var box                 = jQuery('.articles-box');
            var box_id              = box.attr('id');
            var box_block           = js_cat_box.block;
            var box_content         = box.find('.articles-box-content');
            var box_wrapper         = box.find('.articles-box-container-wrapper');
            var box_count           = jQuery(this).attr('data-count');


            var data_page           = jQuery('#'+boxx_id).attr('data-page');

            data_page++;

            var ajaxData = {
                'action'        : 'general_ajax',
                'query'         : the_query,
                'max_num'       : max_num_pages,
                'query_vars'    : query_vars,
                'posts_per_page': posts_per_page,
                'page'          : data_page,
                'latest_post'   : latest_post,
                'offset'        : boxx.find('.articles-box-item').length,
                'count'         : box_count,
                'layout'        : js_cat_box.layout,
                'post_meta'     : js_cat_box.post_meta,
                'read_more'     : js_cat_box.read_more,
                'excerpt'       : js_cat_box.excerpt,
                'excerpt_length': js_cat_box.excerpt_length,
                'type'          : jQuery(this).attr('data-type'),
                'block'         : box_block,
                'data_page'     : data_page,
                'id'            : jQuery(this).attr('data-id')
            };

            jQuery.ajax({
                url: the_url,
                type: 'post',
                data: ajaxData,
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                beforeSend: function (xhr) {
                    //  xhr.setRequestHeader('X-CSRF-TOKEN', csrf_token);
                    box_wrapper.addClass('is-loading')
                },

                success: function( data){

                    if ( data['hide_next'] ) {
                        //jQuery('.general-more-btn').css('display', 'none');
                    }
                    else {
                        //jQuery('.general-more-btn').css('display', 'inline-block');
                    }

                    if ( max_num_pages == 1 || ( max_num_pages == data_page ) ) {
                        jQuery('.general-more-btn').css('display', 'none');
                    }


                    pagination_btn.attr( 'data-latest', latest_post );

                    id.attr('data-page', data_page);
                    pagination_btn.attr( 'data-page', data_page );

                    var content = jQuery( data );
                    box_content.append(content);

                    var box_items_li = boxx.find('.articles-items-' + data_page);
                    box_items_li.find( 'li' ).hide().velocity('stop').velocity( 'transition.slideUpIn', { stagger:100, duration:1000, display:"inline-block",
                        complete: function(){
                            box_items_li.attr( 'style', '' );
                            bd_lazy_load( box_items_li );
                        }
                    } );
                },

                complete: function(){
                    box_wrapper.removeClass('is-loading');
                }
            } );
            return false;
        } );


        // onload
        window.onload = function () {
            console.log('Loaded')
        }


        // Debugging
        performance.mark('KolEnd');
        performance.measure( 'Kol Custom JS', 'KolStart', 'KolEnd' );
    } );

} )( jQuery );



var win_height_padded = jQuery(window).height() * .9;

jQuery(window).on('scroll', bd_images_scroll);

function bd_images_scroll(){

    var scrolled = jQuery(window).scrollTop(),
        win_height_padded = jQuery(window).height() * .9;

    jQuery( ".bdaia-lazyload .post-thumb, .bdaia-lazyload .block-article-img-container, .bdaia-lazyload .bdaia-fp-post-img-container, .bdaia-lazyload .big-grids, .bdaia-lazyload .bd-post-carousel, .bdaia-lazyload .post-image, .bdaia-lazyload .bdaia-post-featured-image, .bdaia-lazyload .bdaia-post-content img, .bdaia-lazyload .bd-block-mega-menu-post, .bdaia-lazyload .bdaia-featured-img-cover, .bdaia-lazyload .thumbnail-cover, .bdaia-lazyload .ei-slider, .bdaia-lazyload .bd-post-thumb, .bdaia-lazyload .bwb-article-img-container, .bdaia-lazyload div.bdaia-instagram-footer ul li a" ).each(function (){
        var thiss     = jQuery(this);
        var offsetTop = thiss.offset().top;

        if (scrolled + win_height_padded > offsetTop){
            jQuery(this).addClass('bdaia-img-show');
        }
    });
}
bd_images_scroll();




function kolyoum_wb_ajax_js( $block_id, $prev ) {

    var block               = jQuery( '.bdaia-wb-id'+$block_id );
    var bd_wait             = jQuery( '.bdaia-wb-id'+$block_id+' .bdayh-posts-load-wait'   );
    var bd_more             = jQuery( '.bdaia-wb-id'+$block_id+' .bdaia-wb-more-btn'       );
    var bd_next             = jQuery( '.bdaia-wb-id'+$block_id+' .carousel-nav .mo-next'   );
    var bd_prev             = jQuery( '.bdaia-wb-id'+$block_id+' .carousel-nav .mo-prev'   );
    var bd_content          = jQuery( '.bdaia-wb-id'+$block_id+' .bdaia-wb-inner'          );
    var bd_content_ul       = jQuery( '.bdaia-wb-id'+$block_id+' .bdaia-nip-inner ul'      );

    var bd_paged            = parseInt( block.attr( 'data-paged'            ) );
    var bd_num_posts        = parseInt( block.attr( 'data-num_posts'        ) );
    var bd_cat_uid          = parseInt( block.attr( 'data-cat_uid'          ) );

    var bd_sort_order       = block.attr( 'data-sort_order'       );
    var bd_tag_slug         = block.attr( 'data-tag_slug'         );
    var bd_cat_uids         = block.attr( 'data-cat_uids'         );
    var bd_posts            = block.attr( 'data-posts'            );
    var bd_ajax_pagination  = block.attr( 'data-ajax_pagination'  );
    var bd_block_nu         = block.attr( 'data-box_nu'           );
    var bd_max_nu           = block.attr( 'data-max_nu'           );
    var bd_total_posts_num  = block.attr( 'data-total_posts_num'  );
    var bd_com_meta         = block.attr( 'data-com_meta'       );
    var bd_review           = block.attr( 'data-review'         );
    var bd_author_meta      = block.attr( 'data-author_meta'    );
    var bd_date_meta        = block.attr( 'data-date_meta'      );
    var bd_thumbnail        = block.attr( 'data-thumbnail'      );

    if ( bd_ajax_pagination == "load_more" )
    {
        if ( bd_paged < bd_max_nu )
        {
            bd_paged++;
        }
    }

    else if ( bd_ajax_pagination = "next_prev" )
    {
        if ( $prev == 'next' )
        {
            if ( bd_paged < bd_max_nu )
            {
                bd_paged++;
            }
        }

        else {

            if ( bd_paged !=1 ) {
                bd_paged = bd_paged - 1;
            }

            else {
                return false;
            }
        }
    }

    block.attr( 'data-paged', bd_paged );

    jQuery.ajax( {
        type        : "POST",
        url         : bdaia.ajaxurl,
        dataType    : 'html',
        data        : "action=bdaia_wboxs&nonce="+bdaia.nonce+"&paged="+bd_paged+"&sort_order="+bd_sort_order+"&num_posts="+bd_num_posts+"&tag_slug="+bd_tag_slug+"&cat_uid="+bd_cat_uid+"&cat_uids="+bd_cat_uids+"&ajax_pagination="+bd_ajax_pagination+"&box_nu="+bd_block_nu+"&com_meta="+bd_com_meta+"&author_meta="+bd_author_meta+"&review="+bd_review+"&thumbnail="+bd_thumbnail+"&date_meta="+bd_date_meta+"&posts="+bd_posts,
        cache       : false,

        beforeSend : function ()
        {
            bd_wait.css( "display", "block"     );

            if ( bd_block_nu == 'wb1' || bd_block_nu == 'wb2' || bd_block_nu == 'wb3' || bd_block_nu == 'wb4' || bd_block_nu == 'wb5' || bd_block_nu == 'wb6' || bd_block_nu == 'wb7' || bd_block_nu == 'wb9' )
            {
                if ( bd_ajax_pagination == "load_more" )
                {
                    bd_content.css( "opacity", "1" );
                }

                else if ( bd_ajax_pagination = "next_prev" )
                {
                    bd_content.css( "opacity", "0.4" );
                }
            }

            if ( bd_block_nu == 'wb8' )
            {
                if ( bd_ajax_pagination == "load_more" )
                {
                    bd_content_ul.css( "opacity", "1" );
                }

                else if ( bd_ajax_pagination = "next_prev" )
                {
                    bd_content_ul.css( "opacity", "0.4" );
                }
            }
        },

        success: function( data )
        {
            if ( data == '' ) {}

            if ( data.trim() !== '' )
            {
                var content = jQuery( data );

                if ( bd_block_nu == 'wb1' || bd_block_nu == 'wb2' || bd_block_nu == 'wb3' || bd_block_nu == 'wb4' || bd_block_nu == 'wb5' || bd_block_nu == 'wb6' || bd_block_nu == 'wb7' || bd_block_nu == 'wb9' )
                {
                    if ( bd_ajax_pagination == "load_more" )
                    {
                        bd_content.append( content ).fadeIn( 'fast' );
                    }

                    else if ( bd_ajax_pagination = "next_prev" )
                    {
                        bd_content.html( content ).fadeIn( 'fast' );
                        bd_content.css( "opacity", "1" );
                    }
                }

                if ( bd_block_nu == 'wb8' )
                {
                    if ( bd_ajax_pagination == "load_more" )
                    {
                        bd_content_ul.append( content ).fadeIn( 'fast' );
                    }

                    else if ( bd_ajax_pagination = "next_prev" )
                    {
                        bd_content_ul.html( content ).fadeIn( 'fast' );
                        bd_content_ul.css( "opacity", "1" );
                    }
                }

                bd_more.css( "display", "block" );
                i_refresh.refresh();
                content.fitVids();

                jQuery( '.ttip' ).tipsy( { fade: true, gravity: 's' } );

                content.each( function( index )
                {
                    if ( jQuery().mediaelementplayer )
                    {
                        jQuery( this ).find( '.wp-audio-shortcode, .wp-video-shortcode' ).mediaelementplayer();
                    }
                } );

                var bd_re   = bd_content.find( '.bwb-article-img-container' );
                bd_re.addClass( 'bdaia-img-show' );
            }

            bd_wait.css( "display", "none" );

            if ( bd_max_nu == bd_paged )
            {
                bd_more.remove();
                bd_next.addClass( 'ajax-page-disabled' );
            }

            else {
                bd_next.removeClass( 'ajax-page-disabled' );
            }

            if ( 1== bd_paged )
            {
                bd_prev.addClass( 'ajax-page-disabled' );
            }

            else {
                bd_prev.removeClass( 'ajax-page-disabled' );
            }
        }

    }, 'html');

    return false;
}

/**! jQuery-viewport-checker - v1.8.8 - 2017-09-25 (c) 2015 Dirk Groenen https:// github.com/dirkgroenen/jQuery-viewport-checker MIT @license: en.wikipedia.org/wiki/MIT_License */
!function(a){a.fn.viewportChecker=function(b){var c={classToAdd:"visible",classToRemove:"invisible",classToAddForFullView:"full-visible",removeClassAfterAnimation:!1,offset:100,repeat:!1,invertBottomOffset:!0,callbackFunction:function(a,b){},scrollHorizontal:!1,scrollBox:window};a.extend(c,b);var d=this,e={height:a(c.scrollBox).height(),width:a(c.scrollBox).width()};return this.checkElements=function(){var b,f;c.scrollHorizontal?(b=Math.max(a("html").scrollLeft(),a("body").scrollLeft(),a(window).scrollLeft()),f=b+e.width):(b=Math.max(a("html").scrollTop(),a("body").scrollTop(),a(window).scrollTop()),f=b+e.height),d.each(function(){var d=a(this),g={},h={};if(d.data("vp-add-class")&&(h.classToAdd=d.data("vp-add-class")),d.data("vp-remove-class")&&(h.classToRemove=d.data("vp-remove-class")),d.data("vp-add-class-full-view")&&(h.classToAddForFullView=d.data("vp-add-class-full-view")),d.data("vp-keep-add-class")&&(h.removeClassAfterAnimation=d.data("vp-remove-after-animation")),d.data("vp-offset")&&(h.offset=d.data("vp-offset")),d.data("vp-repeat")&&(h.repeat=d.data("vp-repeat")),d.data("vp-scrollHorizontal")&&(h.scrollHorizontal=d.data("vp-scrollHorizontal")),d.data("vp-invertBottomOffset")&&(h.scrollHorizontal=d.data("vp-invertBottomOffset")),a.extend(g,c),a.extend(g,h),!d.data("vp-animated")||g.repeat){String(g.offset).indexOf("%")>0&&(g.offset=parseInt(g.offset)/100*e.height);var i=g.scrollHorizontal?d.offset().left:d.offset().top,j=g.scrollHorizontal?i+d.width():i+d.height(),k=Math.round(i)+g.offset,l=g.scrollHorizontal?k+d.width():k+d.height();g.invertBottomOffset&&(l-=2*g.offset),k<f&&l>b?(d.removeClass(g.classToRemove),d.addClass(g.classToAdd),g.callbackFunction(d,"add"),j<=f&&i>=b?d.addClass(g.classToAddForFullView):d.removeClass(g.classToAddForFullView),d.data("vp-animated",!0),g.removeClassAfterAnimation&&d.one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",function(){d.removeClass(g.classToAdd)})):d.hasClass(g.classToAdd)&&g.repeat&&(d.removeClass(g.classToAdd+" "+g.classToAddForFullView),g.callbackFunction(d,"remove"),d.data("vp-animated",!1))}})},("ontouchstart"in window||"onmsgesturechange"in window)&&a(document).bind("touchmove MSPointerMove pointermove",this.checkElements),a(c.scrollBox).bind("load scroll",this.checkElements),a(window).resize(function(b){e={height:a(c.scrollBox).height(),width:a(c.scrollBox).width()},d.checkElements()}),this.checkElements(),this}}(jQuery);

/*!
 * jQuery & Zepto Lazy - v1.7.8
 * http://jquery.eisbehr.de/lazy/
 *
 * Copyright 2012 - 2018, Daniel 'Eisbehr' Kern
 *
 * Dual licensed under the MIT and GPL-2.0 licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * $("img.lazy").lazy();
 */
!function(t,e){"use strict";function r(r,a,n,o,u){function l(){B=t.devicePixelRatio>1,n=f(n),a.delay>=0&&setTimeout(function(){c(!0)},a.delay),(a.delay<0||a.combined)&&(o.e=b(a.throttle,function(t){"resize"===t.type&&(z=w=-1),c(t.all)}),o.a=function(t){t=f(t),n.push.apply(n,t)},o.g=function(){return n=$(n).filter(function(){return!$(this).data(a.loadedName)})},o.f=function(t){for(var e=0;e<t.length;e++){var r=n.filter(function(){return this===t[e]});r.length&&c(!1,r)}},c(),$(a.appendScroll).on("scroll."+u+" resize."+u,o.e))}function f(t){var n=a.defaultImage,i=a.placeholder,o=a.imageBase,u=a.srcsetAttribute,l=a.loaderAttribute,f=a._f||{};t=$(t).filter(function(){var t=$(this),r=h(this);return!t.data(a.handledName)&&(t.attr(a.attribute)||t.attr(u)||t.attr(l)||f[r]!==e)}).data("plugin_"+a.name,r);for(var c=0,s=t.length;c<s;c++){var d=$(t[c]),A=h(t[c]),g=d.attr(a.imageBaseAttribute)||o;A===I&&g&&d.attr(u)&&d.attr(u,m(d.attr(u),g)),f[A]===e||d.attr(l)||d.attr(l,f[A]),A===I&&n&&!d.attr(N)?d.attr(N,n):A===I||!i||d.css(C)&&"none"!==d.css(C)||d.css(C,"url('"+i+"')")}return t}function c(t,e){if(!n.length)return void(a.autoDestroy&&r.destroy());for(var i=e||n,o=!1,u=a.imageBase||"",l=a.srcsetAttribute,f=a.handledName,c=0;c<i.length;c++)if(t||e||d(i[c])){var A=$(i[c]),g=h(i[c]),m=A.attr(a.attribute),b=A.attr(a.imageBaseAttribute)||u,v=A.attr(a.loaderAttribute);A.data(f)||a.visibleOnly&&!A.is(":visible")||!((m||A.attr(l))&&(g===I&&(b+m!==A.attr(N)||A.attr(l)!==A.attr(E))||g!==I&&b+m!==A.css(C))||v)||(o=!0,A.data(f,!0),s(A,g,b,v))}o&&(n=$(n).filter(function(){return!$(this).data(f)}))}function s(t,e,r,n){++y;var i=function(){p("onError",t),v(),i=$.noop};p("beforeLoad",t);var o=a.attribute,u=a.srcsetAttribute,l=a.sizesAttribute,f=a.retinaAttribute,c=a.removeAttribute,s=a.loadedName,d=t.attr(f);if(n){var A=function(){c&&t.removeAttr(a.loaderAttribute),t.data(s,!0),p(L,t),setTimeout(v,1),A=$.noop};t.off(D).one(D,i).one(T,A),p(n,t,function(e){e?(t.off(T),A()):(t.off(D),i())})||t.trigger(D)}else{var g=$(new Image);g.one(D,i).one(T,function(){t.hide(),e===I?t.attr(F,g.attr(F)).attr(E,g.attr(E)).attr(N,g.attr(N)):t.css(C,"url('"+g.attr(N)+"')"),t[a.effect](a.effectTime),c&&(t.removeAttr(o+" "+u+" "+f+" "+a.imageBaseAttribute),l!==F&&t.removeAttr(l)),t.data(s,!0),p(L,t),g.remove(),v()});var h=(B&&d?d:t.attr(o))||"";g.attr(F,t.attr(l)).attr(E,t.attr(u)).attr(N,h?r+h:null),g.complete&&g.trigger(T)}}function d(t){var e=t.getBoundingClientRect(),r=a.scrollDirection,n=a.threshold,i=g()+n>e.top&&-n<e.bottom,o=A()+n>e.left&&-n<e.right;return"vertical"===r?i:"horizontal"===r?o:i&&o}function A(){return z>=0?z:z=$(t).width()}function g(){return w>=0?w:w=$(t).height()}function h(t){return t.tagName.toLowerCase()}function m(t,e){if(e){var r=t.split(",");t="";for(var a=0,n=r.length;a<n;a++)t+=e+r[a].trim()+(a!==n-1?",":"")}return t}function b(t,e){var n,i=0;return function(o,u){function l(){i=+new Date,e.call(r,o)}var f=+new Date-i;n&&clearTimeout(n),f>t||!a.enableThrottle||u?l():n=setTimeout(l,t-f)}}function v(){--y,n.length||y||p("onFinishedAll")}function p(t,e,n){return!!(t=a[t])&&(t.apply(r,[].slice.call(arguments,1)),!0)}var y=0,z=-1,w=-1,B=!1,L="afterLoad",T="load",D="error",I="img",N="src",E="srcset",F="sizes",C="background-image";"event"===a.bind||i?l():$(t).on(T+"."+u,l)}function a(a,i){var o=this,u=$.extend({},o.config,i),l={},f=u.name+"-"+ ++n;return o.config=function(t,r){return r===e?u[t]:(u[t]=r,o)},o.addItems=function(t){return l.a&&l.a("string"===$.type(t)?$(t):t),o},o.getItems=function(){return l.g?l.g():{}},o.update=function(t){return l.e&&l.e({},!t),o},o.force=function(t){return l.f&&l.f("string"===$.type(t)?$(t):t),o},o.loadAll=function(){return l.e&&l.e({all:!0},!0),o},o.destroy=function(){return $(u.appendScroll).off("."+f,l.e),$(t).off("."+f),l={},e},r(o,u,a,l,f),u.chainable?a:o}var $=t.jQuery||t.Zepto,n=0,i=!1;$.fn.Lazy=$.fn.lazy=function(t){return new a(this,t)},$.Lazy=$.lazy=function(t,r,n){if($.isFunction(r)&&(n=r,r=[]),$.isFunction(n)){t=$.isArray(t)?t:[t],r=$.isArray(r)?r:[r];for(var i=a.prototype.config,o=i._f||(i._f={}),u=0,l=t.length;u<l;u++)(i[t[u]]===e||$.isFunction(i[t[u]]))&&(i[t[u]]=n);for(var f=0,c=r.length;f<c;f++)o[r[f]]=t[0]}},a.prototype.config={name:"lazy",chainable:!0,autoDestroy:!0,bind:"load",threshold:500,visibleOnly:!1,appendScroll:t,scrollDirection:"both",imageBase:null,defaultImage:"data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==",placeholder:null,delay:-1,combined:!1,attribute:"data-src",srcsetAttribute:"data-srcset",sizesAttribute:"data-sizes",retinaAttribute:"data-retina",loaderAttribute:"data-loader",imageBaseAttribute:"data-imagebase",removeAttribute:!0,handledName:"handled",loadedName:"loaded",effect:"show",effectTime:0,enableThrottle:!0,throttle:250,beforeLoad:e,afterLoad:e,onError:e,onFinishedAll:e},$(t).on("load",function(){i=!0})}(window);

/*! FitVids */
;(function(e){"use strict";e.fn.fitVids=function(t){var n={customSelector:null};if(t){e.extend(n,t)}return this.each(function(){var t=["iframe[src*='player.vimeo.com']","iframe[src*='www.youtube.com']","iframe[src*='www.youtube-nocookie.com']","iframe[src*='www.dailymotion.com']","iframe[src*='www.kickstarter.com']","object","embed"];if(n.customSelector){t.push(n.customSelector)}var r=e(this).find(t.join(","));r.each(function(){var t=e(this);if(this.tagName.toLowerCase()==="embed"&&t.parent("object").length||t.parent(".fluid-width-video-wrapper").length){return}var n=this.tagName.toLowerCase()==="object"||t.attr("height")&&!isNaN(parseInt(t.attr("height"),10))?parseInt(t.attr("height"),10):t.height(),r=!isNaN(parseInt(t.attr("width"),10))?parseInt(t.attr("width"),10):t.width(),i=n/r;if(!t.attr("id")){var s="fitvid"+Math.floor(Math.random()*999999);t.attr("id",s)}t.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",i*100+"%");t.removeAttr("height").removeAttr("width")})})}})(jQuery);

/* tiesticky.js 1.2.0 - headroom.js | URL: http://wicky.nillia.ms/headroom.js */
!function(a){a&&(a.fn.tiesticky=function(b){return this.each(function(){var c=a(this),d=c.data("tiesticky"),e="object"==typeof b&&b;e=a.extend(!0,{},TieSticky.options,e),d||(d=new TieSticky(this,e),d.init(),c.data("tiesticky",d)),"string"==typeof b&&(d[b](),"destroy"===b&&c.removeData("tiesticky"))})},a("[data-tiesticky]").each(function(){var b=a(this);b.tiesticky(b.data())}))}(window.jQuery),function(a,b){"use strict";"function"==typeof define&&define.amd?define([],b):"object"==typeof exports?module.exports=b():a.TieSticky=b()}(this,function(){"use strict";function b(a){this.callback=a,this.ticking=!1}function c(a){return a&&"undefined"!=typeof window&&(a===window||a.nodeType)}function d(a){if(arguments.length<=0)throw new Error("Missing arguments in extend function");var e,f,b=a||{};for(f=1;f<arguments.length;f++){var g=arguments[f]||{};for(e in g)"object"!=typeof b[e]||c(b[e])?b[e]=b[e]||g[e]:b[e]=d(b[e],g[e])}return b}function e(a){return a===Object(a)?a:{down:a,up:a}}function f(a,b){b=d(b,f.options),this.lastKnownScrollY=0,this.elem=a,this.tolerance=e(b.tolerance),this.classes=b.classes,this.behaviorMode=b.behaviorMode,this.scroller=b.scroller,this.initialised=!1,this.onPin=b.onPin,this.onUnpin=b.onUnpin,this.onTop=b.onTop,this.onNotTop=b.onNotTop,this.onBottom=b.onBottom,this.onNotBottom=b.onNotBottom,this.offset=b.offset,this.offset="default"!=this.behaviorMode?this.offset+this.elem.offsetHeight:this.offset,this.offset=jQuery(document.body).hasClass("admin-bar")?this.offset-32:this.offset,this.offset=jQuery(document.body).hasClass("border-layout")?this.offset-25:this.offset}var a={bind:!!function(){}.bind,classList:"classList"in document.documentElement,rAF:!!(window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame)};return window.requestAnimationFrame=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame,b.prototype={constructor:b,update:function(){this.callback&&this.callback(),this.ticking=!1},requestTick:function(){this.ticking||(requestAnimationFrame(this.rafCallback||(this.rafCallback=this.update.bind(this))),this.ticking=!0)},handleEvent:function(){this.requestTick()}},f.prototype={constructor:f,init:function(){if(f.cutsTheMustard)return"default"==this.behaviorMode&&this.elem.classList.add("defautl-behavior-mode"),this.debouncer=new b(this.update.bind(this)),this.elem.classList.add(this.classes.initial),setTimeout(this.attachEvent.bind(this),100),this},destroy:function(){var a=this.classes;this.initialised=!1,this.elem.classList.remove(a.unpinned,a.pinned,a.top,a.notTop,a.initial),this.scroller.removeEventListener("scroll",this.debouncer,!1)},attachEvent:function(){this.initialised||(this.lastKnownScrollY=this.getScrollY(),this.initialised=!0,this.scroller.addEventListener("scroll",this.debouncer,!1),this.debouncer.handleEvent())},unpin:function(){var a=this.elem.classList,b=this.classes;!a.contains(b.pinned)&&a.contains(b.unpinned)||(a.add(b.unpinned),a.remove(b.pinned),this.onUnpin&&this.onUnpin.call(this))},pin:function(){var a=this.elem.classList,b=this.classes;a.contains(b.unpinned)&&(a.remove(b.unpinned),a.add(b.pinned),this.onPin&&this.onPin.call(this))},top:function(){var a=this.elem.classList,b=this.classes;a.contains(b.top)||(a.add(b.top),a.remove(b.notTop),this.onTop&&this.onTop.call(this))},notTop:function(){var a=this.elem.classList,b=this.classes;a.contains(b.notTop)||(a.add(b.notTop),a.remove(b.top),this.onNotTop&&this.onNotTop.call(this))},bottom:function(){var a=this.elem.classList,b=this.classes;a.contains(b.bottom)||(a.add(b.bottom),a.remove(b.notBottom),this.onBottom&&this.onBottom.call(this))},notBottom:function(){var a=this.elem.classList,b=this.classes;a.contains(b.notBottom)||(a.add(b.notBottom),a.remove(b.bottom),this.onNotBottom&&this.onNotBottom.call(this))},getScrollY:function(){return void 0!==this.scroller.pageYOffset?this.scroller.pageYOffset:void 0!==this.scroller.scrollTop?this.scroller.scrollTop:(document.documentElement||document.body.parentNode||document.body).scrollTop},getViewportHeight:function(){return window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight},getElementPhysicalHeight:function(a){return Math.max(a.offsetHeight,a.clientHeight)},getScrollerPhysicalHeight:function(){return this.scroller===window||this.scroller===document.body?this.getViewportHeight():this.getElementPhysicalHeight(this.scroller)},getDocumentHeight:function(){var a=document.body,b=document.documentElement;return Math.max(a.scrollHeight,b.scrollHeight,a.offsetHeight,b.offsetHeight,a.clientHeight,b.clientHeight)},getElementHeight:function(a){return Math.max(a.scrollHeight,a.offsetHeight,a.clientHeight)},getScrollerHeight:function(){return this.scroller===window||this.scroller===document.body?this.getDocumentHeight():this.getElementHeight(this.scroller)},isOutOfBounds:function(a){var b=a<0,c=a+this.getScrollerPhysicalHeight()>this.getScrollerHeight();return b||c},toleranceExceeded:function(a,b){return Math.abs(a-this.lastKnownScrollY)>=this.tolerance[b]},shouldUnpin:function(a,b){var c=a>this.lastKnownScrollY,d=a>=this.offset;return c&&d&&b},shouldPin:function(a,b){var c=a<this.lastKnownScrollY,d=a<=this.offset;return c&&b||d},update:function(){var a=this.getScrollY(),b=a>this.lastKnownScrollY?"down":"up",c=this.toleranceExceeded(a,b);this.isOutOfBounds(a)||(a<=this.offset-this.elem.offsetHeight&&"default"!=this.behaviorMode?(this.top(),this.elem.classList.add("unpinned-no-transition")):a<=this.offset&&"default"==this.behaviorMode?this.top():a>this.offset&&(this.notTop(),"default"==this.behaviorMode&&a<this.offset+100&&jQuery(".autocomplete-suggestions").hide()),a+this.getViewportHeight()>=this.getScrollerHeight()?this.bottom():this.notBottom(),this.shouldUnpin(a,c)?this.unpin():this.shouldPin(a,c)&&(this.pin(),a>this.offset&&"default"!=this.behaviorMode&&(this.elem.classList.remove("unpinned-no-transition"),jQuery(".autocomplete-suggestions").hide())),this.lastKnownScrollY=a)}},f.options={tolerance:{up:0,down:0},offset:0,behaviorMode:"upwards",scroller:window,classes:{initial:"fixed",pinned:"fixed-pinned",unpinned:"fixed-unpinned",top:"fixed-top",notTop:"fixed-nav",bottom:"fixed-bottom",notBottom:"fixed-not-bottom"}},f.cutsTheMustard=void 0!==a&&a.rAF&&a.bind&&a.classList,f});

/**! VelocityJS.org (1.2.3). (C) 2014 Julian Shapiro. MIT @license: en.wikipedia.org/wiki/MIT_License */
/**! VelocityJS.org jQuery Shim (1.0.1). (C) 2014 The jQuery Foundation. MIT @license: en.wikipedia.org/wiki/MIT_License. */
!function(e){function t(e){var t=e.length,a=r.type(e);return"function"!==a&&!r.isWindow(e)&&(!(1!==e.nodeType||!t)||("array"===a||0===t||"number"==typeof t&&t>0&&t-1 in e))}if(!e.jQuery){var r=function(e,t){return new r.fn.init(e,t)};r.isWindow=function(e){return null!=e&&e==e.window},r.type=function(e){return null==e?e+"":"object"==typeof e||"function"==typeof e?n[o.call(e)]||"object":typeof e},r.isArray=Array.isArray||function(e){return"array"===r.type(e)},r.isPlainObject=function(e){var t;if(!e||"object"!==r.type(e)||e.nodeType||r.isWindow(e))return!1;try{if(e.constructor&&!i.call(e,"constructor")&&!i.call(e.constructor.prototype,"isPrototypeOf"))return!1}catch(e){return!1}for(t in e);return void 0===t||i.call(e,t)},r.each=function(e,r,a){var n,i=0,o=e.length,s=t(e);if(a){if(s)for(;o>i&&!1!==(n=r.apply(e[i],a));i++);else for(i in e)if(!1===(n=r.apply(e[i],a)))break}else if(s)for(;o>i&&!1!==(n=r.call(e[i],i,e[i]));i++);else for(i in e)if(!1===(n=r.call(e[i],i,e[i])))break;return e},r.data=function(e,t,n){if(void 0===n){var i=e[r.expando],o=i&&a[i];if(void 0===t)return o;if(o&&t in o)return o[t]}else if(void 0!==t){var i=e[r.expando]||(e[r.expando]=++r.uuid);return a[i]=a[i]||{},a[i][t]=n,n}},r.removeData=function(e,t){var n=e[r.expando],i=n&&a[n];i&&r.each(t,function(e,t){delete i[t]})},r.extend=function(){var e,t,a,n,i,o,s=arguments[0]||{},l=1,c=arguments.length,u=!1;for("boolean"==typeof s&&(u=s,s=arguments[l]||{},l++),"object"!=typeof s&&"function"!==r.type(s)&&(s={}),l===c&&(s=this,l--);c>l;l++)if(null!=(i=arguments[l]))for(n in i)e=s[n],a=i[n],s!==a&&(u&&a&&(r.isPlainObject(a)||(t=r.isArray(a)))?(t?(t=!1,o=e&&r.isArray(e)?e:[]):o=e&&r.isPlainObject(e)?e:{},s[n]=r.extend(u,o,a)):void 0!==a&&(s[n]=a));return s},r.queue=function(e,a,n){function i(e,r){var a=r||[];return null!=e&&(t(Object(e))?function(e,t){for(var r=+t.length,a=0,n=e.length;r>a;)e[n++]=t[a++];if(r!==r)for(;void 0!==t[a];)e[n++]=t[a++];e.length=n}(a,"string"==typeof e?[e]:e):[].push.call(a,e)),a}if(e){a=(a||"fx")+"queue";var o=r.data(e,a);return n?(!o||r.isArray(n)?o=r.data(e,a,i(n)):o.push(n),o):o||[]}},r.dequeue=function(e,t){r.each(e.nodeType?[e]:e,function(e,a){t=t||"fx";var n=r.queue(a,t),i=n.shift();"inprogress"===i&&(i=n.shift()),i&&("fx"===t&&n.unshift("inprogress"),i.call(a,function(){r.dequeue(a,t)}))})},r.fn=r.prototype={init:function(e){if(e.nodeType)return this[0]=e,this;throw new Error("Not a DOM node.")},offset:function(){var t=this[0].getBoundingClientRect?this[0].getBoundingClientRect():{top:0,left:0};return{top:t.top+(e.pageYOffset||document.scrollTop||0)-(document.clientTop||0),left:t.left+(e.pageXOffset||document.scrollLeft||0)-(document.clientLeft||0)}},position:function(){function e(){for(var e=this.offsetParent||document;e&&"html"===!e.nodeType.toLowerCase&&"static"===e.style.position;)e=e.offsetParent;return e||document}var t=this[0],e=e.apply(t),a=this.offset(),n=/^(?:body|html)$/i.test(e.nodeName)?{top:0,left:0}:r(e).offset();return a.top-=parseFloat(t.style.marginTop)||0,a.left-=parseFloat(t.style.marginLeft)||0,e.style&&(n.top+=parseFloat(e.style.borderTopWidth)||0,n.left+=parseFloat(e.style.borderLeftWidth)||0),{top:a.top-n.top,left:a.left-n.left}}};var a={};r.expando="velocity"+(new Date).getTime(),r.uuid=0;for(var n={},i=n.hasOwnProperty,o=n.toString,s="Boolean Number String Function Array Date RegExp Object Error".split(" "),l=0;l<s.length;l++)n["[object "+s[l]+"]"]=s[l].toLowerCase();r.fn.init.prototype=r.fn,e.Velocity={Utilities:r}}}(window),function(e){"object"==typeof module&&"object"==typeof module.exports?module.exports=e():"function"==typeof define&&define.amd?define(e):e()}(function(){return function(e,t,r,a){function n(e){for(var t=-1,r=e?e.length:0,a=[];++t<r;){var n=e[t];n&&a.push(n)}return a}function i(e){return y.isWrapped(e)?e=[].slice.call(e):y.isNode(e)&&(e=[e]),e}function o(e){var t=p.data(e,"velocity");return null===t?a:t}function s(e){return function(t){return Math.round(t*e)*(1/e)}}function l(e,r,a,n){function i(e,t){return 1-3*t+3*e}function o(e,t){return 3*t-6*e}function s(e){return 3*e}function l(e,t,r){return((i(t,r)*e+o(t,r))*e+s(t))*e}function c(e,t,r){return 3*i(t,r)*e*e+2*o(t,r)*e+s(t)}function u(t,r){for(var n=0;y>n;++n){var i=c(r,e,a);if(0===i)return r;r-=(l(r,e,a)-t)/i}return r}function f(){for(var t=0;b>t;++t)w[t]=l(t*x,e,a)}function p(t,r,n){var i,o,s=0;do{o=r+(n-r)/2,i=l(o,e,a)-t,i>0?n=o:r=o}while(Math.abs(i)>v&&++s<h);return o}function d(t){for(var r=0,n=1,i=b-1;n!=i&&w[n]<=t;++n)r+=x;--n;var o=(t-w[n])/(w[n+1]-w[n]),s=r+o*x,l=c(s,e,a);return l>=m?u(t,s):0==l?s:p(t,r,r+x)}function g(){V=!0,(e!=r||a!=n)&&f()}var y=4,m=.001,v=1e-7,h=10,b=11,x=1/(b-1),S="Float32Array"in t;if(4!==arguments.length)return!1;for(var P=0;4>P;++P)if("number"!=typeof arguments[P]||isNaN(arguments[P])||!isFinite(arguments[P]))return!1;e=Math.min(e,1),a=Math.min(a,1),e=Math.max(e,0),a=Math.max(a,0);var w=S?new Float32Array(b):new Array(b),V=!1,O=function(t){return V||g(),e===r&&a===n?t:0===t?0:1===t?1:l(d(t),r,n)};O.getControlPoints=function(){return[{x:e,y:r},{x:a,y:n}]};var C="generateBezier("+[e,r,a,n]+")";return O.toString=function(){return C},O}function c(e,t){var r=e;return y.isString(e)?b.Easings[e]||(r=!1):r=y.isArray(e)&&1===e.length?s.apply(null,e):y.isArray(e)&&2===e.length?x.apply(null,e.concat([t])):!(!y.isArray(e)||4!==e.length)&&l.apply(null,e),!1===r&&(r=b.Easings[b.defaults.easing]?b.defaults.easing:h),r}function u(e){if(e){var t=(new Date).getTime(),r=b.State.calls.length;r>1e4&&(b.State.calls=n(b.State.calls));for(var i=0;r>i;i++)if(b.State.calls[i]){var s=b.State.calls[i],l=s[0],c=s[2],d=s[3],g=!!d,m=null;d||(d=b.State.calls[i][3]=t-16);for(var v=Math.min((t-d)/c.duration,1),h=0,x=l.length;x>h;h++){var P=l[h],V=P.element;if(o(V)){var O=!1;if(c.display!==a&&null!==c.display&&"none"!==c.display){if("flex"===c.display){var C=["-webkit-box","-moz-box","-ms-flexbox","-webkit-flex"];p.each(C,function(e,t){S.setPropertyValue(V,"display",t)})}S.setPropertyValue(V,"display",c.display)}c.visibility!==a&&"hidden"!==c.visibility&&S.setPropertyValue(V,"visibility",c.visibility);for(var X in P)if("element"!==X){var Y,T=P[X],k=y.isString(T.easing)?b.Easings[T.easing]:T.easing;if(1===v)Y=T.endValue;else{var D=T.endValue-T.startValue;if(Y=T.startValue+D*k(v,c,D),!g&&Y===T.currentValue)continue}if(T.currentValue=Y,"tween"===X)m=Y;else{if(S.Hooks.registered[X]){var F=S.Hooks.getRoot(X),A=o(V).rootPropertyValueCache[F];A&&(T.rootPropertyValue=A)}var I=S.setPropertyValue(V,X,T.currentValue+(0===parseFloat(Y)?"":T.unitType),T.rootPropertyValue,T.scrollData);S.Hooks.registered[X]&&(o(V).rootPropertyValueCache[F]=S.Normalizations.registered[F]?S.Normalizations.registered[F]("extract",null,I[1]):I[1]),"transform"===I[0]&&(O=!0)}}c.mobileHA&&o(V).transformCache.translate3d===a&&(o(V).transformCache.translate3d="(0px, 0px, 0px)",O=!0),O&&S.flushTransformCache(V)}}c.display!==a&&"none"!==c.display&&(b.State.calls[i][2].display=!1),c.visibility!==a&&"hidden"!==c.visibility&&(b.State.calls[i][2].visibility=!1),c.progress&&c.progress.call(s[1],s[1],v,Math.max(0,d+c.duration-t),d,m),1===v&&f(i)}}b.State.isTicking&&w(u)}function f(e,t){if(!b.State.calls[e])return!1;for(var r=b.State.calls[e][0],n=b.State.calls[e][1],i=b.State.calls[e][2],s=b.State.calls[e][4],l=!1,c=0,u=r.length;u>c;c++){var f=r[c].element;if(t||i.loop||("none"===i.display&&S.setPropertyValue(f,"display",i.display),"hidden"===i.visibility&&S.setPropertyValue(f,"visibility",i.visibility)),!0!==i.loop&&(p.queue(f)[1]===a||!/\.velocityQueueEntryFlag/i.test(p.queue(f)[1]))&&o(f)){o(f).isAnimating=!1,o(f).rootPropertyValueCache={};var d=!1;p.each(S.Lists.transforms3D,function(e,t){var r=/^scale/.test(t)?1:0,n=o(f).transformCache[t];o(f).transformCache[t]!==a&&new RegExp("^\\("+r+"[^.]").test(n)&&(d=!0,delete o(f).transformCache[t])}),i.mobileHA&&(d=!0,delete o(f).transformCache.translate3d),d&&S.flushTransformCache(f),S.Values.removeClass(f,"velocity-animating")}if(!t&&i.complete&&!i.loop&&c===u-1)try{i.complete.call(n,n)}catch(e){setTimeout(function(){throw e},1)}s&&!0!==i.loop&&s(n),o(f)&&!0===i.loop&&!t&&(p.each(o(f).tweensContainer,function(e,t){/^rotate/.test(e)&&360===parseFloat(t.endValue)&&(t.endValue=0,t.startValue=360),/^backgroundPosition/.test(e)&&100===parseFloat(t.endValue)&&"%"===t.unitType&&(t.endValue=0,t.startValue=100)}),b(f,"reverse",{loop:!0,delay:i.delay})),!1!==i.queue&&p.dequeue(f,i.queue)}b.State.calls[e]=!1;for(var g=0,y=b.State.calls.length;y>g;g++)if(!1!==b.State.calls[g]){l=!0;break}!1===l&&(b.State.isTicking=!1,delete b.State.calls,b.State.calls=[])}var p,d=function(){if(r.documentMode)return r.documentMode;for(var e=7;e>4;e--){var t=r.createElement("div");if(t.innerHTML="<!--[if IE "+e+"]><span></span><![endif]-->",t.getElementsByTagName("span").length)return t=null,e}return a}(),g=function(){var e=0;return t.webkitRequestAnimationFrame||t.mozRequestAnimationFrame||function(t){var r,a=(new Date).getTime();return r=Math.max(0,16-(a-e)),e=a+r,setTimeout(function(){t(a+r)},r)}}(),y={isString:function(e){return"string"==typeof e},isArray:Array.isArray||function(e){return"[object Array]"===Object.prototype.toString.call(e)},isFunction:function(e){return"[object Function]"===Object.prototype.toString.call(e)},isNode:function(e){return e&&e.nodeType},isNodeList:function(e){return"object"==typeof e&&/^\[object (HTMLCollection|NodeList|Object)\]$/.test(Object.prototype.toString.call(e))&&e.length!==a&&(0===e.length||"object"==typeof e[0]&&e[0].nodeType>0)},isWrapped:function(e){return e&&(e.jquery||t.Zepto&&t.Zepto.zepto.isZ(e))},isSVG:function(e){return t.SVGElement&&e instanceof t.SVGElement},isEmptyObject:function(e){for(var t in e)return!1;return!0}},m=!1;if(e.fn&&e.fn.jquery?(p=e,m=!0):p=t.Velocity.Utilities,8>=d&&!m)throw new Error("Velocity: IE8 and below require jQuery to be loaded before Velocity.");if(7>=d)return void(jQuery.fn.velocity=jQuery.fn.animate);var v=400,h="swing",b={State:{isMobile:/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),isAndroid:/Android/i.test(navigator.userAgent),isGingerbread:/Android 2\.3\.[3-7]/i.test(navigator.userAgent),isChrome:t.chrome,isFirefox:/Firefox/i.test(navigator.userAgent),prefixElement:r.createElement("div"),prefixMatches:{},scrollAnchor:null,scrollPropertyLeft:null,scrollPropertyTop:null,isTicking:!1,calls:[]},CSS:{},Utilities:p,Redirects:{},Easings:{},Promise:t.Promise,defaults:{queue:"",duration:v,easing:h,begin:a,complete:a,progress:a,display:a,visibility:a,loop:!1,delay:!1,mobileHA:!0,_cacheValues:!0},init:function(e){p.data(e,"velocity",{isSVG:y.isSVG(e),isAnimating:!1,computedStyle:null,tweensContainer:null,rootPropertyValueCache:{},transformCache:{}})},hook:null,mock:!1,version:{major:1,minor:2,patch:2},debug:!1};t.pageYOffset!==a?(b.State.scrollAnchor=t,b.State.scrollPropertyLeft="pageXOffset",b.State.scrollPropertyTop="pageYOffset"):(b.State.scrollAnchor=r.documentElement||r.body.parentNode||r.body,b.State.scrollPropertyLeft="scrollLeft",b.State.scrollPropertyTop="scrollTop");var x=function(){function e(e){return-e.tension*e.x-e.friction*e.v}function t(t,r,a){var n={x:t.x+a.dx*r,v:t.v+a.dv*r,tension:t.tension,friction:t.friction};return{dx:n.v,dv:e(n)}}function r(r,a){var n={dx:r.v,dv:e(r)},i=t(r,.5*a,n),o=t(r,.5*a,i),s=t(r,a,o),l=1/6*(n.dx+2*(i.dx+o.dx)+s.dx),c=1/6*(n.dv+2*(i.dv+o.dv)+s.dv);return r.x=r.x+l*a,r.v=r.v+c*a,r}return function e(t,a,n){var i,o,s,l={x:-1,v:0,tension:null,friction:null},c=[0],u=0,f=1e-4,p=.016;for(t=parseFloat(t)||500,a=parseFloat(a)||20,n=n||null,l.tension=t,l.friction=a,i=null!==n,i?(u=e(t,a),o=u/n*p):o=p;s=r(s||l,o),c.push(1+s.x),u+=16,Math.abs(s.x)>f&&Math.abs(s.v)>f;);return i?function(e){return c[e*(c.length-1)|0]}:u}}();b.Easings={linear:function(e){return e},swing:function(e){return.5-Math.cos(e*Math.PI)/2},spring:function(e){return 1-Math.cos(4.5*e*Math.PI)*Math.exp(6*-e)}},p.each([["ease",[.25,.1,.25,1]],["ease-in",[.42,0,1,1]],["ease-out",[0,0,.58,1]],["ease-in-out",[.42,0,.58,1]],["easeInSine",[.47,0,.745,.715]],["easeOutSine",[.39,.575,.565,1]],["easeInOutSine",[.445,.05,.55,.95]],["easeInQuad",[.55,.085,.68,.53]],["easeOutQuad",[.25,.46,.45,.94]],["easeInOutQuad",[.455,.03,.515,.955]],["easeInCubic",[.55,.055,.675,.19]],["easeOutCubic",[.215,.61,.355,1]],["easeInOutCubic",[.645,.045,.355,1]],["easeInQuart",[.895,.03,.685,.22]],["easeOutQuart",[.165,.84,.44,1]],["easeInOutQuart",[.77,0,.175,1]],["easeInQuint",[.755,.05,.855,.06]],["easeOutQuint",[.23,1,.32,1]],["easeInOutQuint",[.86,0,.07,1]],["easeInExpo",[.95,.05,.795,.035]],["easeOutExpo",[.19,1,.22,1]],["easeInOutExpo",[1,0,0,1]],["easeInCirc",[.6,.04,.98,.335]],["easeOutCirc",[.075,.82,.165,1]],["easeInOutCirc",[.785,.135,.15,.86]]],function(e,t){b.Easings[t[0]]=l.apply(null,t[1])});var S=b.CSS={RegEx:{isHex:/^#([A-f\d]{3}){1,2}$/i,valueUnwrap:/^[A-z]+\((.*)\)$/i,wrappedValueAlreadyExtracted:/[0-9.]+ [0-9.]+ [0-9.]+( [0-9.]+)?/,valueSplit:/([A-z]+\(.+\))|(([A-z0-9#-.]+?)(?=\s|$))/gi},Lists:{colors:["fill","stroke","stopColor","color","backgroundColor","borderColor","borderTopColor","borderRightColor","borderBottomColor","borderLeftColor","outlineColor"],transformsBase:["translateX","translateY","scale","scaleX","scaleY","skewX","skewY","rotateZ"],transforms3D:["transformPerspective","translateZ","scaleZ","rotateX","rotateY"]},Hooks:{templates:{textShadow:["Color X Y Blur","black 0px 0px 0px"],boxShadow:["Color X Y Blur Spread","black 0px 0px 0px 0px"],clip:["Top Right Bottom Left","0px 0px 0px 0px"],backgroundPosition:["X Y","0% 0%"],transformOrigin:["X Y Z","50% 50% 0px"],perspectiveOrigin:["X Y","50% 50%"]},registered:{},register:function(){for(var e=0;e<S.Lists.colors.length;e++){var t="color"===S.Lists.colors[e]?"0 0 0 1":"255 255 255 1";S.Hooks.templates[S.Lists.colors[e]]=["Red Green Blue Alpha",t]}var r,a,n;if(d)for(r in S.Hooks.templates){a=S.Hooks.templates[r],n=a[0].split(" ");var i=a[1].match(S.RegEx.valueSplit);"Color"===n[0]&&(n.push(n.shift()),i.push(i.shift()),S.Hooks.templates[r]=[n.join(" "),i.join(" ")])}for(r in S.Hooks.templates){a=S.Hooks.templates[r],n=a[0].split(" ");for(var e in n){var o=r+n[e],s=e;S.Hooks.registered[o]=[r,s]}}},getRoot:function(e){var t=S.Hooks.registered[e];return t?t[0]:e},cleanRootPropertyValue:function(e,t){return S.RegEx.valueUnwrap.test(t)&&(t=t.match(S.RegEx.valueUnwrap)[1]),S.Values.isCSSNullValue(t)&&(t=S.Hooks.templates[e][1]),t},extractValue:function(e,t){var r=S.Hooks.registered[e];if(r){var a=r[0],n=r[1];return t=S.Hooks.cleanRootPropertyValue(a,t),t.toString().match(S.RegEx.valueSplit)[n]}return t},injectValue:function(e,t,r){var a=S.Hooks.registered[e];if(a){var n,i,o=a[0],s=a[1];return r=S.Hooks.cleanRootPropertyValue(o,r),n=r.toString().match(S.RegEx.valueSplit),n[s]=t,i=n.join(" ")}return r}},Normalizations:{registered:{clip:function(e,t,r){switch(e){case"name":return"clip";case"extract":var a;return S.RegEx.wrappedValueAlreadyExtracted.test(r)?a=r:(a=r.toString().match(S.RegEx.valueUnwrap),a=a?a[1].replace(/,(\s+)?/g," "):r),a;case"inject":return"rect("+r+")"}},blur:function(e,t,r){switch(e){case"name":return b.State.isFirefox?"filter":"-webkit-filter";case"extract":var a=parseFloat(r);if(!a&&0!==a){var n=r.toString().match(/blur\(([0-9]+[A-z]+)\)/i);a=n?n[1]:0}return a;case"inject":return parseFloat(r)?"blur("+r+")":"none"}},opacity:function(e,t,r){if(8>=d)switch(e){case"name":return"filter";case"extract":var a=r.toString().match(/alpha\(opacity=(.*)\)/i);return r=a?a[1]/100:1;case"inject":return t.style.zoom=1,parseFloat(r)>=1?"":"alpha(opacity="+parseInt(100*parseFloat(r),10)+")"}else switch(e){case"name":return"opacity";case"extract":return r;case"inject":return r}}},register:function(){9>=d||b.State.isGingerbread||(S.Lists.transformsBase=S.Lists.transformsBase.concat(S.Lists.transforms3D));for(var e=0;e<S.Lists.transformsBase.length;e++)!function(){var t=S.Lists.transformsBase[e];S.Normalizations.registered[t]=function(e,r,n){switch(e){case"name":return"transform";case"extract":return o(r)===a||o(r).transformCache[t]===a?/^scale/i.test(t)?1:0:o(r).transformCache[t].replace(/[()]/g,"");case"inject":var i=!1;switch(t.substr(0,t.length-1)){case"translate":i=!/(%|px|em|rem|vw|vh|\d)$/i.test(n);break;case"scal":case"scale":b.State.isAndroid&&o(r).transformCache[t]===a&&1>n&&(n=1),i=!/(\d)$/i.test(n);break;case"skew":i=!/(deg|\d)$/i.test(n);break;case"rotate":i=!/(deg|\d)$/i.test(n)}return i||(o(r).transformCache[t]="("+n+")"),o(r).transformCache[t]}}}();for(var e=0;e<S.Lists.colors.length;e++)!function(){var t=S.Lists.colors[e];S.Normalizations.registered[t]=function(e,r,n){switch(e){case"name":return t;case"extract":var i;if(S.RegEx.wrappedValueAlreadyExtracted.test(n))i=n;else{var o,s={black:"rgb(0, 0, 0)",blue:"rgb(0, 0, 255)",gray:"rgb(128, 128, 128)",green:"rgb(0, 128, 0)",red:"rgb(255, 0, 0)",white:"rgb(255, 255, 255)"};/^[A-z]+$/i.test(n)?o=s[n]!==a?s[n]:s.black:S.RegEx.isHex.test(n)?o="rgb("+S.Values.hexToRgb(n).join(" ")+")":/^rgba?\(/i.test(n)||(o=s.black),i=(o||n).toString().match(S.RegEx.valueUnwrap)[1].replace(/,(\s+)?/g," ")}return 8>=d||3!==i.split(" ").length||(i+=" 1"),i;case"inject":return 8>=d?4===n.split(" ").length&&(n=n.split(/\s+/).slice(0,3).join(" ")):3===n.split(" ").length&&(n+=" 1"),(8>=d?"rgb":"rgba")+"("+n.replace(/\s+/g,",").replace(/\.(\d)+(?=,)/g,"")+")"}}}()}},Names:{camelCase:function(e){return e.replace(/-(\w)/g,function(e,t){return t.toUpperCase()})},SVGAttribute:function(e){var t="width|height|x|y|cx|cy|r|rx|ry|x1|x2|y1|y2";return(d||b.State.isAndroid&&!b.State.isChrome)&&(t+="|transform"),new RegExp("^("+t+")$","i").test(e)},prefixCheck:function(e){if(b.State.prefixMatches[e])return[b.State.prefixMatches[e],!0];for(var t=["","Webkit","Moz","ms","O"],r=0,a=t.length;a>r;r++){var n;if(n=0===r?e:t[r]+e.replace(/^\w/,function(e){return e.toUpperCase()}),y.isString(b.State.prefixElement.style[n]))return b.State.prefixMatches[e]=n,[n,!0]}return[e,!1]}},Values:{hexToRgb:function(e){var t,r=/^#?([a-f\d])([a-f\d])([a-f\d])$/i,a=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i;return e=e.replace(r,function(e,t,r,a){return t+t+r+r+a+a}),t=a.exec(e),t?[parseInt(t[1],16),parseInt(t[2],16),parseInt(t[3],16)]:[0,0,0]},isCSSNullValue:function(e){return 0==e||/^(none|auto|transparent|(rgba\(0, ?0, ?0, ?0\)))$/i.test(e)},getUnitType:function(e){return/^(rotate|skew)/i.test(e)?"deg":/(^(scale|scaleX|scaleY|scaleZ|alpha|flexGrow|flexHeight|zIndex|fontWeight)$)|((opacity|red|green|blue|alpha)$)/i.test(e)?"":"px"},getDisplayType:function(e){var t=e&&e.tagName.toString().toLowerCase();return/^(b|big|i|small|tt|abbr|acronym|cite|code|dfn|em|kbd|strong|samp|var|a|bdo|br|img|map|object|q|script|span|sub|sup|button|input|label|select|textarea)$/i.test(t)?"inline":/^(li)$/i.test(t)?"list-item":/^(tr)$/i.test(t)?"table-row":/^(table)$/i.test(t)?"table":/^(tbody)$/i.test(t)?"table-row-group":"block"},addClass:function(e,t){e.classList?e.classList.add(t):e.className+=(e.className.length?" ":"")+t},removeClass:function(e,t){e.classList?e.classList.remove(t):e.className=e.className.toString().replace(new RegExp("(^|\\s)"+t.split(" ").join("|")+"(\\s|$)","gi")," ")}},getPropertyValue:function(e,r,n,i){function s(e,r){function n(){c&&S.setPropertyValue(e,"display","none")}var l=0;if(8>=d)l=p.css(e,r);else{var c=!1;if(/^(width|height)$/.test(r)&&0===S.getPropertyValue(e,"display")&&(c=!0,S.setPropertyValue(e,"display",S.Values.getDisplayType(e))),!i){if("height"===r&&"border-box"!==S.getPropertyValue(e,"boxSizing").toString().toLowerCase()){var u=e.offsetHeight-(parseFloat(S.getPropertyValue(e,"borderTopWidth"))||0)-(parseFloat(S.getPropertyValue(e,"borderBottomWidth"))||0)-(parseFloat(S.getPropertyValue(e,"paddingTop"))||0)-(parseFloat(S.getPropertyValue(e,"paddingBottom"))||0);return n(),u}if("width"===r&&"border-box"!==S.getPropertyValue(e,"boxSizing").toString().toLowerCase()){var f=e.offsetWidth-(parseFloat(S.getPropertyValue(e,"borderLeftWidth"))||0)-(parseFloat(S.getPropertyValue(e,"borderRightWidth"))||0)-(parseFloat(S.getPropertyValue(e,"paddingLeft"))||0)-(parseFloat(S.getPropertyValue(e,"paddingRight"))||0);return n(),f}}var g;g=o(e)===a?t.getComputedStyle(e,null):o(e).computedStyle?o(e).computedStyle:o(e).computedStyle=t.getComputedStyle(e,null),"borderColor"===r&&(r="borderTopColor"),l=9===d&&"filter"===r?g.getPropertyValue(r):g[r],(""===l||null===l)&&(l=e.style[r]),n()}if("auto"===l&&/^(top|right|bottom|left)$/i.test(r)){var y=s(e,"position");("fixed"===y||"absolute"===y&&/top|left/i.test(r))&&(l=p(e).position()[r]+"px")}return l}var l;if(S.Hooks.registered[r]){var c=r,u=S.Hooks.getRoot(c);n===a&&(n=S.getPropertyValue(e,S.Names.prefixCheck(u)[0])),S.Normalizations.registered[u]&&(n=S.Normalizations.registered[u]("extract",e,n)),l=S.Hooks.extractValue(c,n)}else if(S.Normalizations.registered[r]){var f,g;f=S.Normalizations.registered[r]("name",e),"transform"!==f&&(g=s(e,S.Names.prefixCheck(f)[0]),S.Values.isCSSNullValue(g)&&S.Hooks.templates[r]&&(g=S.Hooks.templates[r][1])),l=S.Normalizations.registered[r]("extract",e,g)}if(!/^[\d-]/.test(l))if(o(e)&&o(e).isSVG&&S.Names.SVGAttribute(r))if(/^(height|width)$/i.test(r))try{l=e.getBBox()[r]}catch(e){l=0}else l=e.getAttribute(r);else l=s(e,S.Names.prefixCheck(r)[0]);return S.Values.isCSSNullValue(l)&&(l=0),b.debug>=2&&console.log("Get "+r+": "+l),l},setPropertyValue:function(e,r,a,n,i){var s=r;if("scroll"===r)i.container?i.container["scroll"+i.direction]=a:"Left"===i.direction?t.scrollTo(a,i.alternateValue):t.scrollTo(i.alternateValue,a);else if(S.Normalizations.registered[r]&&"transform"===S.Normalizations.registered[r]("name",e))S.Normalizations.registered[r]("inject",e,a),s="transform",a=o(e).transformCache[r];else{if(S.Hooks.registered[r]){var l=r,c=S.Hooks.getRoot(r);n=n||S.getPropertyValue(e,c),a=S.Hooks.injectValue(l,a,n),r=c}if(S.Normalizations.registered[r]&&(a=S.Normalizations.registered[r]("inject",e,a),r=S.Normalizations.registered[r]("name",e)),s=S.Names.prefixCheck(r)[0],8>=d)try{e.style[s]=a}catch(e){b.debug&&console.log("Browser does not support ["+a+"] for ["+s+"]")}else o(e)&&o(e).isSVG&&S.Names.SVGAttribute(r)?e.setAttribute(r,a):e.style[s]=a;b.debug>=2&&console.log("Set "+r+" ("+s+"): "+a)}return[s,a]},flushTransformCache:function(e){function t(t){return parseFloat(S.getPropertyValue(e,t))}var r="";if((d||b.State.isAndroid&&!b.State.isChrome)&&o(e).isSVG){var a={translate:[t("translateX"),t("translateY")],skewX:[t("skewX")],skewY:[t("skewY")],scale:1!==t("scale")?[t("scale"),t("scale")]:[t("scaleX"),t("scaleY")],rotate:[t("rotateZ"),0,0]};p.each(o(e).transformCache,function(e){/^translate/i.test(e)?e="translate":/^scale/i.test(e)?e="scale":/^rotate/i.test(e)&&(e="rotate"),a[e]&&(r+=e+"("+a[e].join(" ")+") ",delete a[e])})}else{var n,i;p.each(o(e).transformCache,function(t){return n=o(e).transformCache[t],"transformPerspective"===t?(i=n,!0):(9===d&&"rotateZ"===t&&(t="rotate"),void(r+=t+n+" "))}),i&&(r="perspective"+i+" "+r)}S.setPropertyValue(e,"transform",r)}};S.Hooks.register(),S.Normalizations.register(),b.hook=function(e,t,r){var n=a;return e=i(e),p.each(e,function(e,i){if(o(i)===a&&b.init(i),r===a)n===a&&(n=b.CSS.getPropertyValue(i,t));else{var s=b.CSS.setPropertyValue(i,t,r);"transform"===s[0]&&b.CSS.flushTransformCache(i),n=s}}),n};var P=function(){function e(){return s?X.promise||null:l}function n(){function e(){function e(e,t){var r=a,n=a,o=a;return y.isArray(e)?(r=e[0],!y.isArray(e[1])&&/^[\d-]/.test(e[1])||y.isFunction(e[1])||S.RegEx.isHex.test(e[1])?o=e[1]:(y.isString(e[1])&&!S.RegEx.isHex.test(e[1])||y.isArray(e[1]))&&(n=t?e[1]:c(e[1],s.duration),e[2]!==a&&(o=e[2]))):r=e,t||(n=n||s.easing),y.isFunction(r)&&(r=r.call(i,V,w)),y.isFunction(o)&&(o=o.call(i,V,w)),[r||0,n,o]}function f(e,t){var r,a;return a=(t||"0").toString().toLowerCase().replace(/[%A-z]+$/,function(e){return r=e,""}),r||(r=S.Values.getUnitType(e)),[a,r]}function d(){var e={myParent:i.parentNode||r.body,position:S.getPropertyValue(i,"position"),fontSize:S.getPropertyValue(i,"fontSize")},a=e.position===I.lastPosition&&e.myParent===I.lastParent,n=e.fontSize===I.lastFontSize;I.lastParent=e.myParent,I.lastPosition=e.position,I.lastFontSize=e.fontSize;var s=100,l={};if(n&&a)l.emToPx=I.lastEmToPx,l.percentToPxWidth=I.lastPercentToPxWidth,l.percentToPxHeight=I.lastPercentToPxHeight;else{var c=o(i).isSVG?r.createElementNS("http:// www.w3.org/2000/svg","rect"):r.createElement("div");b.init(c),e.myParent.appendChild(c),p.each(["overflow","overflowX","overflowY"],function(e,t){b.CSS.setPropertyValue(c,t,"hidden")}),b.CSS.setPropertyValue(c,"position",e.position),b.CSS.setPropertyValue(c,"fontSize",e.fontSize),b.CSS.setPropertyValue(c,"boxSizing","content-box"),p.each(["minWidth","maxWidth","width","minHeight","maxHeight","height"],function(e,t){b.CSS.setPropertyValue(c,t,s+"%")}),b.CSS.setPropertyValue(c,"paddingLeft",s+"em"),l.percentToPxWidth=I.lastPercentToPxWidth=(parseFloat(S.getPropertyValue(c,"width",null,!0))||1)/s,l.percentToPxHeight=I.lastPercentToPxHeight=(parseFloat(S.getPropertyValue(c,"height",null,!0))||1)/s,l.emToPx=I.lastEmToPx=(parseFloat(S.getPropertyValue(c,"paddingLeft"))||1)/s,e.myParent.removeChild(c)}return null===I.remToPx&&(I.remToPx=parseFloat(S.getPropertyValue(r.body,"fontSize"))||16),null===I.vwToPx&&(I.vwToPx=parseFloat(t.innerWidth)/100,I.vhToPx=parseFloat(t.innerHeight)/100),l.remToPx=I.remToPx,l.vwToPx=I.vwToPx,l.vhToPx=I.vhToPx,b.debug>=1&&console.log("Unit ratios: "+JSON.stringify(l),i),l}if(s.begin&&0===V)try{s.begin.call(g,g)}catch(e){setTimeout(function(){throw e},1)}if("scroll"===Y){var v,x,P,O=/^x$/i.test(s.axis)?"Left":"Top",C=parseFloat(s.offset)||0;s.container?y.isWrapped(s.container)||y.isNode(s.container)?(s.container=s.container[0]||s.container,v=s.container["scroll"+O],P=v+p(i).position()[O.toLowerCase()]+C):s.container=null:(v=b.State.scrollAnchor[b.State["scrollProperty"+O]],x=b.State.scrollAnchor[b.State["scrollProperty"+("Left"===O?"Top":"Left")]],P=p(i).offset()[O.toLowerCase()]+C),l={scroll:{rootPropertyValue:!1,startValue:v,currentValue:v,endValue:P,unitType:"",easing:s.easing,scrollData:{container:s.container,direction:O,alternateValue:x}},element:i},b.debug&&console.log("tweensContainer (scroll): ",l.scroll,i)}else if("reverse"===Y){if(!o(i).tweensContainer)return void p.dequeue(i,s.queue);"none"===o(i).opts.display&&(o(i).opts.display="auto"),"hidden"===o(i).opts.visibility&&(o(i).opts.visibility="visible"),o(i).opts.loop=!1,o(i).opts.begin=null,o(i).opts.complete=null,h.easing||delete s.easing,h.duration||delete s.duration,s=p.extend({},o(i).opts,s);var T=p.extend(!0,{},o(i).tweensContainer);for(var k in T)if("element"!==k){var D=T[k].startValue;T[k].startValue=T[k].currentValue=T[k].endValue,T[k].endValue=D,y.isEmptyObject(h)||(T[k].easing=s.easing),b.debug&&console.log("reverse tweensContainer ("+k+"): "+JSON.stringify(T[k]),i)}l=T}else if("start"===Y){var T;o(i).tweensContainer&&!0===o(i).isAnimating&&(T=o(i).tweensContainer),p.each(m,function(t,r){if(RegExp("^"+S.Lists.colors.join("$|^")+"$").test(t)){var n=e(r,!0),i=n[0],o=n[1],s=n[2];if(S.RegEx.isHex.test(i)){for(var l=["Red","Green","Blue"],c=S.Values.hexToRgb(i),u=s?S.Values.hexToRgb(s):a,f=0;f<l.length;f++){var p=[c[f]];o&&p.push(o),u!==a&&p.push(u[f]),m[t+l[f]]=p}delete m[t]}}});for(var F in m){var A=e(m[F]),j=A[0],R=A[1],L=A[2];F=S.Names.camelCase(F);var H=S.Hooks.getRoot(F),N=!1;if(o(i).isSVG||"tween"===H||!1!==S.Names.prefixCheck(H)[1]||S.Normalizations.registered[H]!==a){(s.display!==a&&null!==s.display&&"none"!==s.display||s.visibility!==a&&"hidden"!==s.visibility)&&/opacity|filter/.test(F)&&!L&&0!==j&&(L=0),s._cacheValues&&T&&T[F]?(L===a&&(L=T[F].endValue+T[F].unitType),N=o(i).rootPropertyValueCache[H]):S.Hooks.registered[F]?L===a?(N=S.getPropertyValue(i,H),L=S.getPropertyValue(i,F,N)):N=S.Hooks.templates[H][1]:L===a&&(L=S.getPropertyValue(i,F));var q,z,Z,B=!1;if(q=f(F,L),L=q[0],Z=q[1],q=f(F,j),j=q[0].replace(/^([+-\/*])=/,function(e,t){return B=t,""}),z=q[1],L=parseFloat(L)||0,j=parseFloat(j)||0,"%"===z&&(/^(fontSize|lineHeight)$/.test(F)?(j/=100,z="em"):/^scale/.test(F)?(j/=100,z=""):/(Red|Green|Blue)$/i.test(F)&&(j=j/100*255,z="")),/[\/*]/.test(B))z=Z;else if(Z!==z&&0!==L)if(0===j)z=Z;else{n=n||d();var M=/margin|padding|left|right|width|text|word|letter/i.test(F)||/X$/.test(F)||"x"===F?"x":"y";switch(Z){case"%":L*="x"===M?n.percentToPxWidth:n.percentToPxHeight;break;case"px":break;default:L*=n[Z+"ToPx"]}switch(z){case"%":L*=1/("x"===M?n.percentToPxWidth:n.percentToPxHeight);break;case"px":break;default:L*=1/n[z+"ToPx"]}}switch(B){case"+":j=L+j;break;case"-":j=L-j;break;case"*":j*=L;break;case"/":j=L/j}l[F]={rootPropertyValue:N,startValue:L,currentValue:L,endValue:j,unitType:z,easing:R},b.debug&&console.log("tweensContainer ("+F+"): "+JSON.stringify(l[F]),i)}else b.debug&&console.log("Skipping ["+H+"] due to a lack of browser support.")}l.element=i}l.element&&(S.Values.addClass(i,"velocity-animating"),E.push(l),""===s.queue&&(o(i).tweensContainer=l,o(i).opts=s),o(i).isAnimating=!0,V===w-1?(b.State.calls.push([E,g,s,null,X.resolver]),!1===b.State.isTicking&&(b.State.isTicking=!0,u())):V++)}var n,i=this,s=p.extend({},b.defaults,h),l={};switch(o(i)===a&&b.init(i),parseFloat(s.delay)&&!1!==s.queue&&p.queue(i,s.queue,function(e){b.velocityQueueEntryFlag=!0,o(i).delayTimer={setTimeout:setTimeout(e,parseFloat(s.delay)),next:e}}),s.duration.toString().toLowerCase()){case"fast":s.duration=200;break;case"normal":s.duration=v;break;case"slow":s.duration=600;break;default:s.duration=parseFloat(s.duration)||1}!1!==b.mock&&(!0===b.mock?s.duration=s.delay=1:(s.duration*=parseFloat(b.mock)||1,s.delay*=parseFloat(b.mock)||1)),s.easing=c(s.easing,s.duration),s.begin&&!y.isFunction(s.begin)&&(s.begin=null),s.progress&&!y.isFunction(s.progress)&&(s.progress=null),s.complete&&!y.isFunction(s.complete)&&(s.complete=null),s.display!==a&&null!==s.display&&(s.display=s.display.toString().toLowerCase(),"auto"===s.display&&(s.display=b.CSS.Values.getDisplayType(i))),s.visibility!==a&&null!==s.visibility&&(s.visibility=s.visibility.toString().toLowerCase()),s.mobileHA=s.mobileHA&&b.State.isMobile&&!b.State.isGingerbread,!1===s.queue?s.delay?setTimeout(e,s.delay):e():p.queue(i,s.queue,function(t,r){return!0===r?(X.promise&&X.resolver(g),!0):(b.velocityQueueEntryFlag=!0,void e(t))}),""!==s.queue&&"fx"!==s.queue||"inprogress"===p.queue(i)[0]||p.dequeue(i)}var s,l,d,g,m,h,x=arguments[0]&&(arguments[0].p||p.isPlainObject(arguments[0].properties)&&!arguments[0].properties.names||y.isString(arguments[0].properties));if(y.isWrapped(this)?(s=!1,d=0,g=this,l=this):(s=!0,d=1,g=x?arguments[0].elements||arguments[0].e:arguments[0]),g=i(g)){x?(m=arguments[0].properties||arguments[0].p,h=arguments[0].options||arguments[0].o):(m=arguments[d],h=arguments[d+1]);var w=g.length,V=0;if(!/^(stop|finish|finishAll)$/i.test(m)&&!p.isPlainObject(h)){var O=d+1;h={};for(var C=O;C<arguments.length;C++)y.isArray(arguments[C])||!/^(fast|normal|slow)$/i.test(arguments[C])&&!/^\d/.test(arguments[C])?y.isString(arguments[C])||y.isArray(arguments[C])?h.easing=arguments[C]:y.isFunction(arguments[C])&&(h.complete=arguments[C]):h.duration=arguments[C]}var X={promise:null,resolver:null,rejecter:null};s&&b.Promise&&(X.promise=new b.Promise(function(e,t){X.resolver=e,X.rejecter=t}));var Y;switch(m){case"scroll":Y="scroll";break;case"reverse":Y="reverse";break;case"finish":case"finishAll":case"stop":p.each(g,function(e,t){o(t)&&o(t).delayTimer&&(clearTimeout(o(t).delayTimer.setTimeout),o(t).delayTimer.next&&o(t).delayTimer.next(),delete o(t).delayTimer),"finishAll"!==m||!0!==h&&!y.isString(h)||(p.each(p.queue(t,y.isString(h)?h:""),function(e,t){y.isFunction(t)&&t()}),p.queue(t,y.isString(h)?h:"",[]))});var T=[];return p.each(b.State.calls,function(e,t){t&&p.each(t[1],function(r,n){var i=h===a?"":h;return!0!==i&&t[2].queue!==i&&(h!==a||!1!==t[2].queue)||void p.each(g,function(r,a){
    a===n&&((!0===h||y.isString(h))&&(p.each(p.queue(a,y.isString(h)?h:""),function(e,t){y.isFunction(t)&&t(null,!0)}),p.queue(a,y.isString(h)?h:"",[])),"stop"===m?(o(a)&&o(a).tweensContainer&&!1!==i&&p.each(o(a).tweensContainer,function(e,t){t.endValue=t.currentValue}),T.push(e)):("finish"===m||"finishAll"===m)&&(t[2].duration=1))})})}),"stop"===m&&(p.each(T,function(e,t){f(t,!0)}),X.promise&&X.resolver(g)),e();default:if(!p.isPlainObject(m)||y.isEmptyObject(m)){if(y.isString(m)&&b.Redirects[m]){var k=p.extend({},h),D=k.duration,F=k.delay||0;return!0===k.backwards&&(g=p.extend(!0,[],g).reverse()),p.each(g,function(e,t){parseFloat(k.stagger)?k.delay=F+parseFloat(k.stagger)*e:y.isFunction(k.stagger)&&(k.delay=F+k.stagger.call(t,e,w)),k.drag&&(k.duration=parseFloat(D)||(/^(callout|transition)/.test(m)?1e3:v),k.duration=Math.max(k.duration*(k.backwards?1-e/w:(e+1)/w),.75*k.duration,200)),b.Redirects[m].call(t,t,k||{},e,w,g,X.promise?X:a)}),e()}var A="Velocity: First argument ("+m+") was not a property map, a known action, or a registered redirect. Aborting.";return X.promise?X.rejecter(new Error(A)):console.log(A),e()}Y="start"}var I={lastParent:null,lastPosition:null,lastFontSize:null,lastPercentToPxWidth:null,lastPercentToPxHeight:null,lastEmToPx:null,remToPx:null,vwToPx:null,vhToPx:null},E=[];p.each(g,function(e,t){y.isNode(t)&&n.call(t)});var j,k=p.extend({},b.defaults,h);if(k.loop=parseInt(k.loop),j=2*k.loop-1,k.loop)for(var R=0;j>R;R++){var L={delay:k.delay,progress:k.progress};R===j-1&&(L.display=k.display,L.visibility=k.visibility,L.complete=k.complete),P(g,"reverse",L)}return e()}};b=p.extend(P,b),b.animate=P;var w=t.requestAnimationFrame||g;return b.State.isMobile||r.hidden===a||r.addEventListener("visibilitychange",function(){r.hidden?(w=function(e){return setTimeout(function(){e(!0)},16)},u()):w=t.requestAnimationFrame||g}),e.Velocity=b,e!==t&&(e.fn.velocity=P,e.fn.velocity.defaults=b.defaults),p.each(["Down","Up"],function(e,t){b.Redirects["slide"+t]=function(e,r,n,i,o,s){var l=p.extend({},r),c=l.begin,u=l.complete,f={height:"",marginTop:"",marginBottom:"",paddingTop:"",paddingBottom:""},d={};l.display===a&&(l.display="Down"===t?"inline"===b.CSS.Values.getDisplayType(e)?"inline-block":"block":"none"),l.begin=function(){c&&c.call(o,o);for(var r in f){d[r]=e.style[r];var a=b.CSS.getPropertyValue(e,r);f[r]="Down"===t?[a,0]:[0,a]}d.overflow=e.style.overflow,e.style.overflow="hidden"},l.complete=function(){for(var t in d)e.style[t]=d[t];u&&u.call(o,o),s&&s.resolver(o)},b(e,f,l)}}),p.each(["In","Out"],function(e,t){b.Redirects["fade"+t]=function(e,r,n,i,o,s){var l=p.extend({},r),c={opacity:"In"===t?1:0},u=l.complete;l.complete=n!==i-1?l.begin=null:function(){u&&u.call(o,o),s&&s.resolver(o)},l.display===a&&(l.display="In"===t?"auto":"none"),b(this,c,l)}}),b}(window.jQuery||window.Zepto||window,window,document)}),function(e){"function"==typeof require&&"object"==typeof exports?module.exports=e():"function"==typeof define&&define.amd?define(["velocity"],e):e()}(function(){return function(e,t,r,a){function n(e,t){var r=[];return!(!e||!t)&&($.each([e,t],function(e,t){var a=[];$.each(t,function(e,t){for(;t.toString().length<5;)t="0"+t;a.push(t)}),r.push(a.join(""))}),parseFloat(r[0])>parseFloat(r[1]))}if(!e.Velocity||!e.Velocity.Utilities)return void(t.console&&console.log("Velocity UI Pack: Velocity must be loaded first. Aborting."));var i=e.Velocity,$=i.Utilities;if(n({major:1,minor:1,patch:0},i.version)){var o="Velocity UI Pack: You need to update Velocity (jquery.velocity.js) to a newer version. Visit http:// github.com/julianshapiro/velocity.";throw alert(o),new Error(o)}i.RegisterEffect=i.RegisterUI=function(e,t){function r(e,t,r,a){var n=0,o;$.each(e.nodeType?[e]:e,function(e,t){a&&(r+=e*a),o=t.parentNode,$.each(["height","paddingTop","paddingBottom","marginTop","marginBottom"],function(e,r){n+=parseFloat(i.CSS.getPropertyValue(t,r))})}),i.animate(o,{height:("In"===t?"+":"-")+"="+n},{queue:!1,easing:"ease-in-out",duration:r*("In"===t?.6:1)})}return i.Redirects[e]=function(n,o,s,l,c,u){function f(){o.display!==a&&"none"!==o.display||!/Out$/.test(e)||$.each(c.nodeType?[c]:c,function(e,t){i.CSS.setPropertyValue(t,"display","none")}),o.complete&&o.complete.call(c,c),u&&u.resolver(c||n)}var p=s===l-1;t.defaultDuration="function"==typeof t.defaultDuration?t.defaultDuration.call(c,c):parseFloat(t.defaultDuration);for(var d=0;d<t.calls.length;d++){var g=t.calls[d],y=g[0],m=o.duration||t.defaultDuration||1e3,v=g[1],h=g[2]||{},b={};if(b.duration=m*(v||1),b.queue=o.queue||"",b.easing=h.easing||"ease",b.delay=parseFloat(h.delay)||0,b._cacheValues=h._cacheValues||!0,0===d){if(b.delay+=parseFloat(o.delay)||0,0===s&&(b.begin=function(){o.begin&&o.begin.call(c,c);var t=e.match(/(In|Out)$/);t&&"In"===t[0]&&y.opacity!==a&&$.each(c.nodeType?[c]:c,function(e,t){i.CSS.setPropertyValue(t,"opacity",0)}),o.animateParentHeight&&t&&r(c,t[0],m+b.delay,o.stagger)}),null!==o.display)if(o.display!==a&&"none"!==o.display)b.display=o.display;else if(/In$/.test(e)){var x=i.CSS.Values.getDisplayType(n);b.display="inline"===x?"inline-block":x}o.visibility&&"hidden"!==o.visibility&&(b.visibility=o.visibility)}d===t.calls.length-1&&(b.complete=function(){if(t.reset){for(var e in t.reset){var r=t.reset[e];i.CSS.Hooks.registered[e]!==a||"string"!=typeof r&&"number"!=typeof r||(t.reset[e]=[t.reset[e],t.reset[e]])}var o={duration:0,queue:!1};p&&(o.complete=f),i.animate(n,t.reset,o)}else p&&f()},"hidden"===o.visibility&&(b.visibility=o.visibility)),i.animate(n,y,b)}},i},i.RegisterEffect.packagedEffects={"callout.bounce":{defaultDuration:550,calls:[[{translateY:-30},.25],[{translateY:0},.125],[{translateY:-15},.125],[{translateY:0},.25]]},"callout.shake":{defaultDuration:800,calls:[[{translateX:-11},.125],[{translateX:11},.125],[{translateX:-11},.125],[{translateX:11},.125],[{translateX:-11},.125],[{translateX:11},.125],[{translateX:-11},.125],[{translateX:0},.125]]},"callout.flash":{defaultDuration:1100,calls:[[{opacity:[0,"easeInOutQuad",1]},.25],[{opacity:[1,"easeInOutQuad"]},.25],[{opacity:[0,"easeInOutQuad"]},.25],[{opacity:[1,"easeInOutQuad"]},.25]]},"callout.pulse":{defaultDuration:825,calls:[[{scaleX:1.1,scaleY:1.1},.5,{easing:"easeInExpo"}],[{scaleX:1,scaleY:1},.5]]},"callout.swing":{defaultDuration:950,calls:[[{rotateZ:15},.2],[{rotateZ:-10},.2],[{rotateZ:5},.2],[{rotateZ:-5},.2],[{rotateZ:0},.2]]},"callout.tada":{defaultDuration:1e3,calls:[[{scaleX:.9,scaleY:.9,rotateZ:-3},.1],[{scaleX:1.1,scaleY:1.1,rotateZ:3},.1],[{scaleX:1.1,scaleY:1.1,rotateZ:-3},.1],["reverse",.125],["reverse",.125],["reverse",.125],["reverse",.125],["reverse",.125],[{scaleX:1,scaleY:1,rotateZ:0},.2]]},"transition.fadeIn":{defaultDuration:500,calls:[[{opacity:[1,0]}]]},"transition.fadeOut":{defaultDuration:500,calls:[[{opacity:[0,1]}]]},"transition.flipXIn":{defaultDuration:700,calls:[[{opacity:[1,0],transformPerspective:[800,800],rotateY:[0,-55]}]],reset:{transformPerspective:0}},"transition.flipXOut":{defaultDuration:700,calls:[[{opacity:[0,1],transformPerspective:[800,800],rotateY:55}]],reset:{transformPerspective:0,rotateY:0}},"transition.flipYIn":{defaultDuration:800,calls:[[{opacity:[1,0],transformPerspective:[800,800],rotateX:[0,-45]}]],reset:{transformPerspective:0}},"transition.flipYOut":{defaultDuration:800,calls:[[{opacity:[0,1],transformPerspective:[800,800],rotateX:25}]],reset:{transformPerspective:0,rotateX:0}},"transition.flipBounceXIn":{defaultDuration:900,calls:[[{opacity:[.725,0],transformPerspective:[400,400],rotateY:[-10,90]},.5],[{opacity:.8,rotateY:10},.25],[{opacity:1,rotateY:0},.25]],reset:{transformPerspective:0}},"transition.flipBounceXOut":{defaultDuration:800,calls:[[{opacity:[.9,1],transformPerspective:[400,400],rotateY:-10},.5],[{opacity:0,rotateY:90},.5]],reset:{transformPerspective:0,rotateY:0}},"transition.flipBounceYIn":{defaultDuration:850,calls:[[{opacity:[.725,0],transformPerspective:[400,400],rotateX:[-10,90]},.5],[{opacity:.8,rotateX:10},.25],[{opacity:1,rotateX:0},.25]],reset:{transformPerspective:0}},"transition.flipBounceYOut":{defaultDuration:800,calls:[[{opacity:[.9,1],transformPerspective:[400,400],rotateX:-15},.5],[{opacity:0,rotateX:90},.5]],reset:{transformPerspective:0,rotateX:0}},"transition.swoopIn":{defaultDuration:850,calls:[[{opacity:[1,0],transformOriginX:["100%","50%"],transformOriginY:["100%","100%"],scaleX:[1,0],scaleY:[1,0],translateX:[0,-700],translateZ:0}]],reset:{transformOriginX:"50%",transformOriginY:"50%"}},"transition.swoopOut":{defaultDuration:850,calls:[[{opacity:[0,1],transformOriginX:["50%","100%"],transformOriginY:["100%","100%"],scaleX:0,scaleY:0,translateX:-700,translateZ:0}]],reset:{transformOriginX:"50%",transformOriginY:"50%",scaleX:1,scaleY:1,translateX:0}},"transition.whirlIn":{defaultDuration:850,calls:[[{opacity:[1,0],transformOriginX:["50%","50%"],transformOriginY:["50%","50%"],scaleX:[1,0],scaleY:[1,0],rotateY:[0,160]},1,{easing:"easeInOutSine"}]]},"transition.whirlOut":{defaultDuration:750,calls:[[{opacity:[0,"easeInOutQuint",1],transformOriginX:["50%","50%"],transformOriginY:["50%","50%"],scaleX:0,scaleY:0,rotateY:160},1,{easing:"swing"}]],reset:{scaleX:1,scaleY:1,rotateY:0}},"transition.shrinkIn":{defaultDuration:750,calls:[[{opacity:[1,0],transformOriginX:["50%","50%"],transformOriginY:["50%","50%"],scaleX:[1,1.5],scaleY:[1,1.5],translateZ:0}]]},"transition.shrinkOut":{defaultDuration:600,calls:[[{opacity:[0,1],transformOriginX:["50%","50%"],transformOriginY:["50%","50%"],scaleX:1.3,scaleY:1.3,translateZ:0}]],reset:{scaleX:1,scaleY:1}},"transition.expandIn":{defaultDuration:700,calls:[[{opacity:[1,0],transformOriginX:["50%","50%"],transformOriginY:["50%","50%"],scaleX:[1,.625],scaleY:[1,.625],translateZ:0}]]},"transition.expandOut":{defaultDuration:700,calls:[[{opacity:[0,1],transformOriginX:["50%","50%"],transformOriginY:["50%","50%"],scaleX:.5,scaleY:.5,translateZ:0}]],reset:{scaleX:1,scaleY:1}},"transition.bounceIn":{defaultDuration:800,calls:[[{opacity:[1,0],scaleX:[1.05,.3],scaleY:[1.05,.3]},.4],[{scaleX:.9,scaleY:.9,translateZ:0},.2],[{scaleX:1,scaleY:1},.5]]},"transition.bounceOut":{defaultDuration:800,calls:[[{scaleX:.95,scaleY:.95},.35],[{scaleX:1.1,scaleY:1.1,translateZ:0},.35],[{opacity:[0,1],scaleX:.3,scaleY:.3},.3]],reset:{scaleX:1,scaleY:1}},"transition.bounceUpIn":{defaultDuration:800,calls:[[{opacity:[1,0],translateY:[-30,1e3]},.6,{easing:"easeOutCirc"}],[{translateY:10},.2],[{translateY:0},.2]]},"transition.bounceUpOut":{defaultDuration:1e3,calls:[[{translateY:20},.2],[{opacity:[0,"easeInCirc",1],translateY:-1e3},.8]],reset:{translateY:0}},"transition.bounceDownIn":{defaultDuration:800,calls:[[{opacity:[1,0],translateY:[30,-1e3]},.6,{easing:"easeOutCirc"}],[{translateY:-10},.2],[{translateY:0},.2]]},"transition.bounceDownOut":{defaultDuration:1e3,calls:[[{translateY:-20},.2],[{opacity:[0,"easeInCirc",1],translateY:1e3},.8]],reset:{translateY:0}},"transition.bounceLeftIn":{defaultDuration:750,calls:[[{opacity:[1,0],translateX:[30,-1250]},.6,{easing:"easeOutCirc"}],[{translateX:-10},.2],[{translateX:0},.2]]},"transition.bounceLeftOut":{defaultDuration:750,calls:[[{translateX:30},.2],[{opacity:[0,"easeInCirc",1],translateX:-1250},.8]],reset:{translateX:0}},"transition.bounceRightIn":{defaultDuration:750,calls:[[{opacity:[1,0],translateX:[-30,1250]},.6,{easing:"easeOutCirc"}],[{translateX:10},.2],[{translateX:0},.2]]},"transition.bounceRightOut":{defaultDuration:750,calls:[[{translateX:-30},.2],[{opacity:[0,"easeInCirc",1],translateX:1250},.8]],reset:{translateX:0}},"transition.slideUpIn":{defaultDuration:900,calls:[[{opacity:[1,0],translateY:[0,20],translateZ:0}]]},"transition.slideUpOut":{defaultDuration:900,calls:[[{opacity:[0,1],translateY:-20,translateZ:0}]],reset:{translateY:0}},"transition.slideDownIn":{defaultDuration:900,calls:[[{opacity:[1,0],translateY:[0,-20],translateZ:0}]]},"transition.slideDownOut":{defaultDuration:900,calls:[[{opacity:[0,1],translateY:20,translateZ:0}]],reset:{translateY:0}},"transition.slideLeftIn":{defaultDuration:1e3,calls:[[{opacity:[1,0],translateX:[0,-20],translateZ:0}]]},"transition.slideLeftOut":{defaultDuration:1050,calls:[[{opacity:[0,1],translateX:-20,translateZ:0}]],reset:{translateX:0}},"transition.slideRightIn":{defaultDuration:1e3,calls:[[{opacity:[1,0],translateX:[0,20],translateZ:0}]]},"transition.slideRightOut":{defaultDuration:1050,calls:[[{opacity:[0,1],translateX:20,translateZ:0}]],reset:{translateX:0}},"transition.slideUpBigIn":{defaultDuration:850,calls:[[{opacity:[1,0],translateY:[0,75],translateZ:0}]]},"transition.slideUpBigOut":{defaultDuration:800,calls:[[{opacity:[0,1],translateY:-75,translateZ:0}]],reset:{translateY:0}},"transition.slideDownBigIn":{defaultDuration:850,calls:[[{opacity:[1,0],translateY:[0,-75],translateZ:0}]]},"transition.slideDownBigOut":{defaultDuration:800,calls:[[{opacity:[0,1],translateY:75,translateZ:0}]],reset:{translateY:0}},"transition.slideLeftBigIn":{defaultDuration:800,calls:[[{opacity:[1,0],translateX:[0,-75],translateZ:0}]]},"transition.slideLeftBigOut":{defaultDuration:750,calls:[[{opacity:[0,1],translateX:-75,translateZ:0}]],reset:{translateX:0}},"transition.slideRightBigIn":{defaultDuration:800,calls:[[{opacity:[1,0],translateX:[0,75],translateZ:0}]]},"transition.slideRightBigOut":{defaultDuration:750,calls:[[{opacity:[0,1],translateX:75,translateZ:0}]],reset:{translateX:0}},"transition.perspectiveUpIn":{defaultDuration:800,calls:[[{opacity:[1,0],transformPerspective:[800,800],transformOriginX:[0,0],transformOriginY:["100%","100%"],rotateX:[0,-180]}]],reset:{transformPerspective:0,transformOriginX:"50%",transformOriginY:"50%"}},"transition.perspectiveUpOut":{defaultDuration:850,calls:[[{opacity:[0,1],transformPerspective:[800,800],transformOriginX:[0,0],transformOriginY:["100%","100%"],rotateX:-180}]],reset:{transformPerspective:0,transformOriginX:"50%",transformOriginY:"50%",rotateX:0}},"transition.perspectiveDownIn":{defaultDuration:800,calls:[[{opacity:[1,0],transformPerspective:[800,800],transformOriginX:[0,0],transformOriginY:[0,0],rotateX:[0,180]}]],reset:{transformPerspective:0,transformOriginX:"50%",transformOriginY:"50%"}},"transition.perspectiveDownOut":{defaultDuration:850,calls:[[{opacity:[0,1],transformPerspective:[800,800],transformOriginX:[0,0],transformOriginY:[0,0],rotateX:180}]],reset:{transformPerspective:0,transformOriginX:"50%",transformOriginY:"50%",rotateX:0}},"transition.perspectiveLeftIn":{defaultDuration:950,calls:[[{opacity:[1,0],transformPerspective:[2e3,2e3],transformOriginX:[0,0],transformOriginY:[0,0],rotateY:[0,-180]}]],reset:{transformPerspective:0,transformOriginX:"50%",transformOriginY:"50%"}},"transition.perspectiveLeftOut":{defaultDuration:950,calls:[[{opacity:[0,1],transformPerspective:[2e3,2e3],transformOriginX:[0,0],transformOriginY:[0,0],rotateY:-180}]],reset:{transformPerspective:0,transformOriginX:"50%",transformOriginY:"50%",rotateY:0}},"transition.perspectiveRightIn":{defaultDuration:950,calls:[[{opacity:[1,0],transformPerspective:[2e3,2e3],transformOriginX:["100%","100%"],transformOriginY:[0,0],rotateY:[0,180]}]],reset:{transformPerspective:0,transformOriginX:"50%",transformOriginY:"50%"}},"transition.perspectiveRightOut":{defaultDuration:950,calls:[[{opacity:[0,1],transformPerspective:[2e3,2e3],transformOriginX:["100%","100%"],transformOriginY:[0,0],rotateY:180}]],reset:{transformPerspective:0,transformOriginX:"50%",transformOriginY:"50%",rotateY:0}}};for(var s in i.RegisterEffect.packagedEffects)i.RegisterEffect(s,i.RegisterEffect.packagedEffects[s]);i.RunSequence=function(e){var t=$.extend(!0,[],e);t.length>1&&($.each(t.reverse(),function(e,r){var a=t[e+1];if(a){var n=r.o||r.options,o=a.o||a.options,s=n&&!1===n.sequenceQueue?"begin":"complete",l=o&&o[s],c={};c[s]=function(){var e=a.e||a.elements,t=e.nodeType?[e]:e;l&&l.call(t,t),i(r)},a.o?a.o=$.extend({},o,c):a.options=$.extend({},o,c)}}),t.reverse()),i(t[0])}}(window.jQuery||window.Zepto||window,window,document)});
