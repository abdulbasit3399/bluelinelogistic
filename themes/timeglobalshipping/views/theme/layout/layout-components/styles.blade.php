@php
$header_setting = theme_setting('header.header');
if (!$header_setting) {
    $header_setting = [];
}
$hoverMenuBg = array_key_exists('menu_hover_bg_color', $header_setting) ? $header_setting['menu_hover_bg_color'] : '#105EFB';

if (check_module('Localization')) {
    $current_lang = Modules\Localization\Entities\Language::where('code', LaravelLocalization::getCurrentLocale())->first();
}

$current_theme = strtolower(Qirolab\Theme\Theme::active());
$additional_css = App\Models\CustomSetting::where('place', 'additional_css')
    ->where('theme', $current_theme)
    ->first();

$data = theme_setting('styling.styling');
if (!$data) {
    $data = [];
}

//  default colore : #fdc300 ;
$color = array_key_exists('main_color', $data) && $data['main_color'] ? " {$data['main_color']} !important;" : '#fdc300 !important; ';

@endphp

<link rel="stylesheet" href="{{ asset('themes/timeglobalshipping/assets/css/stylemien.css') }}" />
<link rel="stylesheet" id="kolyoum-default-css" href="{{ asset('themes/timeglobalshipping/assets/css/post.style.css') }}" type="text/css" media="all" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.15/css/intlTelInput.css" integrity="sha512-gxWow8Mo6q6pLa1XH/CcH8JyiSDEtiwJV78E+D+QP0EVasFs8wKXq16G8CLD4CJ2SnonHr4Lm/yY2fSI2+cbmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="{{ asset('themes/html/custom-assets/css/app.css') }}">

<!-- styles -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

<link rel="stylesheet" href="{{ asset('themes/timeglobalshipping/vendors/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('themes/timeglobalshipping/assets/css/style.css') }}" />

<!-- footer & header -->
<link rel="stylesheet" id="kolyoum-default-css" href="{{ asset('themes/public/header.style.css') }}" type="text/css" media="all" />
<link rel="stylesheet" id="kolyoum-default-css" href="{{ asset('themes/public/footer.style.css') }}" type="text/css" media="all" />





@if (isset($current_lang) && $current_lang->dir == 'rtl')
    <link rel="stylesheet" href="{{ asset('themes/timeglobalshipping/assets/css/rtl.css') }}" />
@endif

<style type='text/css'>
    @media only screen and (max-width: 900px) {

        .bd-push-menu-open aside.bd-push-menu,
        aside.bd-push-menu.light-skin {
            background: #fe4f2d;
            background: -webkit-linear-gradient(176deg, #cf109f, #fe4f2d);
            background: linear-gradient(176deg, #cf109f, #fe4f2d);
        }
    }

    @media only screen and (max-width: 900px) {
        div.bd-push-menu-inner::before {
            background-image: url("{{ asset('themes/html/assets/images/dsfdsfsddfsfd.jpg') }}") !important;
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-position: center;
            background-position: center;
        }
    }

    div.bdaia-footer,
    div.bdaia-footer.bd-footer-light {
        background: #111026;
        background: -webkit-linear-gradient(176deg, #111026, #111026);
        background: linear-gradient(176deg, #111026, #111026);
    }

    div.bdaia-footer::before {
        background-image: url("{{ asset('themes/html/assets/images/footer-background.svg') }}") !important;
        background-repeat: no-repeat;
        background-attachment: scroll;
        background-position: center top;
    }

    .bd-cat-10 {
        background: #e5b22b !important;
        color: #FFF !important;
    }

    .bd-cat-10::after {
        border-top-color: #e5b22b !important
    }

    .bd-cat-13 {
        background: #39a657 !important;
        color: #FFF !important;
    }

    .bd-cat-13::after {
        border-top-color: #39a657 !important
    }

    .bd-cat-8 {
        background: #6b45e0 !important;
        color: #FFF !important;
    }

    .bd-cat-8::after {
        border-top-color: #6b45e0 !important
    }

    .bd-cat-12 {
        background: #e81055 !important;
        color: #FFF !important;
    }

    .bd-cat-12::after {
        border-top-color: #e81055 !important
    }

    .bdaia-header-default .topbar:not(.topbar-light) {
        background: #fb8332
    }

    .bdaia-header-default .topbar:not(.topbar-light) {
        background: linear-gradient(176deg, #fb8332 0, #b31919 100%);
    }

    .bdaia-header-default .header-container {
        border-bottom: 0 none;
    }

    ul.bd-components>li.bd-alert-posts {
        padding-right: 0;
    }

    .bdaia-header-default .header-container .bd-container {
        background: url("{{ asset('themes/html/assets/images/top-shadow.png') }}") no-repeat top;
    }

    .bdaia-header-default .topbar.topbar-gradient .breaking-title {
        background-color: rgba(0, 0, 0, .75);
        border-radius: 2px;
    }

    .inner-wrapper {
        background-color: #FFF;
    }

    .article-meta-info .bd-alignleft .meta-item:last-child {
        margin-right: 0;
    }

    .article-meta-info .bd-alignright .meta-item:first-child {
        margin-left: 0;
    }

    .articles-box-dark.articles-box.articles-box-block625 .articles-box-items>li:first-child {
        border-bottom: 1px solid rgba(255, 255, 255, .1);
    }

    .articles-box.articles-box-block614 .articles-box-items>li .article-details h3 {
        padding: 0;
        font-size: 19px;
        line-height: 1.33;
        font-weight: normal;
    }

    .bdaia-header-default #navigation.nav-boxed.mainnav-dark .primary-menu ul#menu-primary>li:hover>a,
    .bdaia-header-default #navigation.nav-boxed.mainnav-dark .primary-menu ul#menu-primary>li.current-menu-item>a,
    .bdaia-header-default #navigation.nav-boxed.mainnav-dark .primary-menu ul#menu-primary>li.current-menu-ancestor>a,
    .bdaia-header-default #navigation.nav-boxed.mainnav-dark .primary-menu ul#menu-primary>li.current-menu-parent>a {
        background-color: {{ $hoverMenuBg }} !important;
    }

    .bdaia-header-default #navigation .primary-menu ul#menu-primary>li>.bd_mega.sub-menu,
    .bdaia-header-default #navigation .primary-menu ul#menu-primary>li>.sub-menu {
        border-color: {{ $hoverMenuBg }} !important;
    }

    .bdaia-header-default #navigation.dropdown-light .primary-menu ul#menu-primary li.bd_mega_menu div.bd_mega ul.bd_mega.sub-menu li a:hover,
    .bdaia-header-default #navigation.dropdown-light .primary-menu ul#menu-primary li ul.sub-menu li a:hover {
        color: {{ $hoverMenuBg }} !important;
    }

</style>

<style type="text/css" media="all">
    :root {
        --brand-color: {{ $color }};
        --dark-brand-color: #F65051;
        --bright-color: #FFF;
        --base-color: #161D40;
    }

    body {
        color: var(--base-color);
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Poppins, Oxygen, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", "Open Sans", Arial, sans-serif;
        font-size: 13px;
        line-height: 21px;
    }

    * {
        padding: 0;
        margin: 0;
        list-style: none;
        border: 0;
        outline: none;
        box-sizing: border-box;
    }

    a {
        color: var(--base-color);
        text-decoration: none;
        transition: 0.15s;
    }

    a:hover {
        color: var(--brand-color);
    }

    a:active,
    a:hover {
        outline-width: 0;
    }

    div.hero section#banner.section {
        background: #FFFFFF !important;
    }

    #main-header:hover,
    #main-header.active {
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
    }

    #main-header .navbar .logo {
        -webkit-margin-end: 90px;
        margin-inline-end: 90px;
    }

    #main-header .navbar .nav-list>li {
        padding-inline: 0;
        -webkit-margin-end: 40px;
        margin-inline-end: 40px;
    }

    #main-header .navbar .nav-list>li a {
        font-size: 14px;
        font-weight: bold;
        letter-spacing: 0;
        text-transform: uppercase;
        color: var(--base-color) !important;
    }

    #main-header .navbar .nav-list>li a:hover {
        color: var(--brand-color) !important;
    }

    #main-header .navbar .nav-list .dropdown-menu.submenu,
    #main-header .navbar .nav-list .dropdown-menu {
        border-radius: 0 !important;
        width: 230px !important;
        padding: 10px 0 !important;
        line-height: 20px !important;
        box-shadow: 0 15px 30px rgb(0 0 0 / 06%), 0 0 0 1px rgb(0 0 0 / 4%);
    }

    #main-header .navbar .nav-list .dropdown-menu.submenu a,
    #main-header .navbar .nav-list .dropdown-menu a {
        display: block;
        margin: 0 !important;
        padding: 8px 20px !important;
        min-height: unset !important;
        font-size: 13px !important;
        text-transform: unset !important;
        font-weight: normal !important;
        color: var(--base-color) !important;
        max-width: 100% !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }

    #main-header .navbar .nav-list .dropdown-menu.submenu a:hover,
    #main-header .navbar .nav-list .dropdown-menu a:hover {
        color: var(--brand-color) !important;
    }

    #main-header .navbar .nav-list li,
    #main-header .navbar .nav-list .dropdown-item {
        height: unset !important;
        max-height: unset !important;
        padding-block: unset !important;
    }

    #main-header .navbar .nav-list ul {
        line-height: 20px;
        z-index: 1;
        top: unset !important;
        left: unset !important;
    }

    #main-header .navbar .nav-list ul ul {
        top: 0 !important;
        left: 100% !important;
        margin-top: -10px !important;
    }

    #main-header .navbar .nav-list li svg {
        display: none !important;
    }

    #banner .btn {
        padding: 22px 40px;
        height: unset;
        border-radius: 10px !important;
        box-shadow: none !important;
        font-size: 18px;
        font-weight: 600;
        margin: 30px 0 0 0;
        font-family: 'Poppins';
        text-transform: unset !important;
    }

    .section .intro .heading {
        font-family: 'Poppins';
        font-weight: 600;
        letter-spacing: -2px;
    }

    @media only screen and (min-width: 75rem) {
        #banner .container {
            padding: 145px 0;
        }
    }

    {!! isset($additional_css->data['additional_css']) ? $additional_css->data['additional_css'] : '' !!}

</style>


<style>
    #progressbar li.active:before,
    #progressbar li.active:after {
        background: {{ $color }};

    }

    .chbs-meta-icon-route {
        color: {{ $color }};
    }


    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        background-color: {{ $color }};
    }


    .chbs-meta-title {
        color: {{ $color }};
    }


    ::-webkit-scrollbar-thumb {
        border-radius: 0px;
        -webkit-box-shadow: inset 0 0 6px {{ $color }};
        box-shadow: inset 0 0 6px {{ $color }};
        background-color: {{ $color }};
        height: 100px;
    }

    ::-moz-selection {
        background: {{ $color }};
        color: #ffffff;
        text-shadow: none;
    }

    ::selection {
        background: {{ $color }};
        color: #ffffff;
        text-shadow: none;
    }


    a:hover {
        color: {{ $color }};
    }


    #main-header .navbar .nav-list>li a:hover {
        color: {{ $color }};
    }

    #main-header .navbar .nav-list .dropdown-menu.submenu a:hover,
    #main-header .navbar .nav-list .dropdown-menu a:hover {
        color: {{ $color }};
    }

    ::selection {
        background: {{ $color }};
        color: #fff;
    }

    a:hover {
        color: {{ $color }};
    }

    button,
    .btn-link {
        /* color: {{ $color }}; */
    }


    #business .accordion .card .header .btn .heading {
        color: {{ $color }};
    }

    #good-hands .container .contents .heading {
        color: {{ $color }};
    }

    input[type=button],
    input[type=reset],
    input[type=submit] {
        background-color: {{ $color }};
    }


    .btn-link:active {
        background-color: {{ $color }};
    }

    input[type=button]:active,
    input[type=reset]:active,
    input[type=submit]:active {
        background-color: {{ $color }};
    }

    .bd-loading {
        border-left-color: {{ $color }};
    }

    .gotop {
        background-color: {{ $color }};
    }

    .comment-reply-link {
        color: {{ $color }};
    }

    .comment-reply-link:link,
    .comment-reply-link:active {
        color: {{ $color }};
    }


    .search-mobile .search-submit {
        background: {{ $color }};
    }

    aside#bd-MobileSiderbar svg {
        background: {{ $color }};
    }

    #reading-position-indicator {
        background: {{ $color }};
        box-shadow: 0 0 10px {{ $color }};
    }

    .sk-circle .sk-child:before {
        background-color: {{ $color }};
    }

    .bd-more-btn:hover {
        border-color: {{ $color }};
        background-color: {{ $color }};
    }

    .search-mobile button.search-button:hover,
    #submit_comment:hover,
    .post-password-form input[type=submit]:hover,
    #searchform input[type=submit]:hover,
    #reviews input[type=submit]:hover,
    input.wpcf7-form-control.wpcf7-submit:hover,
    .bbd-search-btn:hover {
        background: {{ $color }};
    }

    #bdaia-cats-builder ul.slick-dots li.slick-active button {
        background: {{ $color }};
    }

    .bdaia-load-comments-btn a:hover {
        border-color: {{ $color }};
        background-color: {{ $color }};
    }

    div.bdaia-post-count {
        border-left: 5px {{ $color }} solid;
    }


    div.bdaia-post-trn {
        background: {{ $color }};
    }

    h4.block-title:before {
        background-color: {{ $color }};
    }

    .ei-title h2 {
        border-right: 13px {{ $color }} solid;
    }


    .ei-title h3 {
        border-right: 13px {{ $color }} solid;
    }

    .ei-slider-thumbs li.ei-slider-element {
        background: {{ $color }};
    }

    .bdaia-post-content blockquote p,
    blockquote p {
        color: {{ $color }};
    }

    .bdaia-header-default .header-wrapper {
        border-top: 3px {{ $color }} solid;
    }

    .bdayh-click-open {
        background-color: {{ $color }};
    }

    .bdaia-header-default #navigation .primary-menu #menu-primary>li:hover>a {
        color: {{ $color }};
    }

    .bdaia-header-default #navigation .primary-menu ul#menu-primary>li:hover>a:after,
    .bdaia-header-default #navigation .primary-menu ul#menu-primary>li.current-menu-item>a:after,
    .bdaia-header-default #navigation .primary-menu ul#menu-primary>li.current-menu-ancestor>a:after,
    .bdaia-header-default #navigation .primary-menu ul#menu-primary>li.current-menu-parent>a:after {
        background: {{ $color }};
    }

    .bdaia-header-default #navigation.nav-boxed.mainnav-dark .primary-menu ul#menu-primary>li:hover>a,
    .bdaia-header-default #navigation.nav-boxed.mainnav-dark .primary-menu ul#menu-primary>li.current-menu-item>a,
    .bdaia-header-default #navigation.nav-boxed.mainnav-dark .primary-menu ul#menu-primary>li.current-menu-ancestor>a,
    .bdaia-header-default #navigation.nav-boxed.mainnav-dark .primary-menu ul#menu-primary>li.current-menu-parent>a {
        background: {{ $color }};
    }

    .bdaia-header-default #navigation.mainnav-dark:not(.nav-boxed) .primary-menu ul#menu-primary>li:hover>a,
    .bdaia-header-default #navigation.mainnav-dark:not(.nav-boxed) .primary-menu ul#menu-primary>li.current-menu-item>a,
    .bdaia-header-default #navigation.mainnav-dark:not(.nav-boxed) .primary-menu ul#menu-primary>li.current-menu-ancestor>a,
    .bdaia-header-default #navigation.mainnav-dark:not(.nav-boxed) .primary-menu ul#menu-primary>li.current-menu-parent>a,
    .bdaia-header-default #navigation.nav-bg-gradient .primary-menu ul#menu-primary>li:hover>a,
    .bdaia-header-default #navigation.nav-bg-gradient .primary-menu ul#menu-primary>li.current-menu-item>a,
    .bdaia-header-default #navigation.nav-bg-gradient .primary-menu ul#menu-primary>li.current-menu-ancestor>a,
    .bdaia-header-default #navigation.nav-bg-gradient .primary-menu ul#menu-primary>li.current-menu-parent>a {
        background: {{ $color }};
    }

    .bdaia-header-default #navigation .primary-menu ul#menu-primary>li>.bd_mega.sub-menu,
    .bdaia-header-default #navigation .primary-menu ul#menu-primary>li>.sub-menu {
        border-top: 4px solid {{ $color }};
    }

    .bdaia-header-default #navigation .primary-menu ul#menu-primary .sub_cats_posts {
        border-top: 4px solid {{ $color }};
    }

    .bdaia-header-default #navigation.dropdown-light .primary-menu ul#menu-primary li.bd_mega_menu div.bd_mega ul.bd_mega.sub-menu li a:hover,
    .bdaia-header-default #navigation.dropdown-light .primary-menu ul#menu-primary li ul.sub-menu li a:hover {
        color: {{ $color }};
    }

    .bdaia-header-default #navigation.dropdown-light .primary-menu ul#menu-primary .sub_cats_posts a:hover {
        color: {{ $color }};
    }


    #navigation .bdaia-alert-new-posts {
        background-color: {{ $color }};
    }

    .bdaia-header-default #navigation.dropdown-light .bdaia-alert-new-posts-inner ul li a:hover {
        color: {{ $color }};
    }


    div.bdaia-alert-new-posts-inner {
        border-top: 4px solid {{ $color }};
    }

    .bdaia-ns-wrap:after {
        background: {{ $color }};
    }

    .breaking-title {
        background-color: {{ $color }};
    }

    .bdaia-post-content a,
    .comments-container .comment-content a {
        color: {{ $color }};
    }

    div.widget.bdaia-widget .widget-inner .bdaia-wb9 .bwb-article-img-container>a:after {
        background: {{ $color }};
    }


    div.widget.bdaia-widget.bdaia-widget-counter div.bdaia-wc-style1 li.social-counter-comments:hover .bdaia-io {
        background: {{ $color }};
    }

    div.widget.bdaia-widget.bdaia-widget-counter div.bdaia-wc-style1 li.social-counter-comments:hover .sc-num {
        color: {{ $color }};
    }

    div.widget.bdaia-widget.bdaia-widget-counter .bdaia-wc-style2 li.social-counter-comments:hover .bdaia-io:before {
        background: {{ $color }};
    }

    div.widget.bdaia-widget.bdaia-widget-counter .bdaia-wc-style2 li.social-counter-comments:hover .sc-num {
        color: {{ $color }};
    }

    div.widget.bdaia-widget.bdaia-widget-counter .bdaia-wc-style3 li.social-counter-comments .bdaia-io:before {
        background: {{ $color }};
    }

    div.widget.bdaia-widget.bdaia-widget-counter .bdaia-wc-style4 li.social-counter-comments a {
        background: {{ $color }};
    }



    div.widget.bdaia-widget.bdaia-widget-timeline .widget-inner a:hover {
        color: {{ $color }};
    }


    div.widget.bdaia-widget.bdaia-widget-timeline .widget-inner a:hover span:before {
        background: {{ $color }};
        border-color: {{ $color }};
    }

    div.widget.bdaia-widget.bdaia-widget-timeline .widget-inner a:hover span {
        color: {{ $color }};
    }

    .widget.bd-login .login_user .bio-author-desc a {
        color: {{ $color }};
    }


    .widget.bdaia-widget.widget_mc4wp_form_widget .bdaia-mc4wp-form-icon span {
        color: {{ $color }};

    }


    div.bdaia-footer input[type=submit] {
        background: {{ $color }};
    }


    div.bdaia-toggle h4.bdaia-toggle-head.toggle-head-open span.bdaia-sio,
    div.bdaia-tabs.horizontal-tabs ul.nav-tabs li.current:before {
        background: {{ $color }};
    }


    div.bdaia-blocks.bdaia-block22 div.block-article hr {
        background: {{ $color }};
    }

    div.bdaia-blocks.bdaia-block22 div.block-article .post-more-btn a,
    div.bdaia-blocks.bdaia-block22 div.block-article .bdaia-post-cat-list a {
        color: {{ $color }};
    }


    div.bdaia-blocks.bdaia-block22 div.block-article .post-more-btn a:hover,
    div.bdaia-blocks.bdaia-block22 div.block-article .bdaia-post-cat-list a:hover {
        color: {{ $color }};
    }


    div.bd-footer-top-area .tagcloud span {
        background: {{ $color }};

    }


    div.bd-footer-top-area .tagcloud a:hover {
        background: {{ $color }};
    }

    div.bd-footer-light div.bd-footer-top-area a:hover,
    div.bd-footer-light div.bdaia-footer-area a:hover,
    div.bd-footer-light div.bdaia-footer-widgets a:hover {
        color: {{ $color }};
    }

    div.bd-footer-light div.widget.bdaia-widget.bdaia-widget-timeline .widget-inner a:hover {
        color: {{ $color }};
    }

    div.bd-footer-light div.widget.bdaia-widget.bdaia-widget-timeline .widget-inner a:hover span.bdayh-date {
        color: {{ $color }};
    }




    div.bd-footer-light div.bdaia-footer-widgets .carousel-nav a:hover {
        background-color: {{ $color }};
        border-color: {{ $color }};

    }

    @media (min-width: 768px) {
        .article-next-prev a::after {
            color: {{ $color }};

        }
    }

    .btn-circle {
        color: {{ $color }};
    }

    .btn-circle::before {
        box-shadow: inset 0 0 0 3px {{ $color }};
    }

    .rating-percentages .rating-percentages-inner span {
        background-color: {{ $color }};
        background: -webkit-linear-gradient(to left, {{ $color }}, transparent);
        background: linear-gradient(to left, {{ $color }}, transparent);
    }

    .slick-dots li.slick-active button,
    .slick-dots li button:hover {
        background: {{ $color }};
    }

    .load-more-btn:hover {
        background-color: {{ $color }};
    }

    .articles-box-title h3::before {
        background-color: {{ $color }};
    }

    .articles-box-title h3::after {
        background: -webkit-linear-gradient(to right, {{ $color }}, transparent);
    }


    .articles-box-title h3::after {
        background: linear-gradient(to right, {{ $color }}, transparent);
    }

    .articles-box-title .articles-box-filter-links li.active a {
        color: {{ $color }};
    }

    .articles-box-title .articles-box-title-arrow-nav li a:hover {
        background-color: {{ $color }};
    }

    .article-more-link {
        background-color: {{ $color }};
    }

    body:not(.bdaia-boxed) .articles-box.articles-box-dark .articles-box-title .articles-box-title-arrow-nav li a:hover {
        background-color: {{ $color }};
    }

    .articles-box.articles-box-block644 .articles-box-items>li .day-month::before {
        background: {{ $color }};
    }

    .articles-box.articles-box-block644 .articles-box-items>li .article-thumb::before {
        background: -webkit-linear-gradient(to bottom, {{ $color }}, transparent);
        background: linear-gradient(to bottom, {{ $color }}, transparent);
    }


    .slider-area.cover-grid.cover-title-style1 .cover-item .article-meta-info:first-child {
        background: {{ $color }};
    }


    div.bd-sidebar .widget .bdaia-widget-tabs .bdaia-tabs-nav>li.active a::after,
    .wpb_widgetised_column .widget .bdaia-widget-tabs .bdaia-tabs-nav>li.active a::after,
    .elementor-widget-container .widget .bdaia-widget-tabs .bdaia-tabs-nav>li.active a::after {
        background: -webkit-linear-gradient(to right, transparent, {{ $color }}, transparent);
    }

    .widget-box-title h3::before {
        background-color: {{ $color }};
    }

    .widget-box-title h3::after {
        background: -webkit-linear-gradient(to right, {{ $color }}, transparent);
        background: linear-gradient(to right, {{ $color }}, transparent);
    }

    .widget-box-title .widget-box-title-arrow-nav li a:hover {
        background-color: {{ $color }};
    }

    .page-nav ul li.current {
        border-color: {{ $color }};
        background-color: {{ $color }};
    }

    .page-nav .page-standard>span:hover {
        border-color: {{ $color }};
        background-color: {{ $color }};

    }

    article blockquote.bdaia-blockquotes,
    blockquote.bdaia-blockquotes,
    blockquote.bdaia-blockquotes.bdaia-bpull:before,
    blockquote.bdaia-blockquotes.bdaia-bpull:after {
        color: {{ $color }};
    }

    .bd-subnav-wrapper .sub-nav>li.current-menu-item::after {
        height: 5px;
        background: {{ $color }};
    }

    ._short_related h3 {
        background-color: {{ $color }};
    }


    ._short_related h3::after {
        background-color: {{ $color }};

    }

    .bd_f_button:hover svg {
        fill: {{ $color }};
    }

    .bd_element_widget.articles-box-block0055 .articles-box-items .articles-box-item a.bd-cat-link {
        color: {{ $color }};
    }

    .bd_element_widget.articles-box-block0054 a.bd-cat-link {
        color: {{ $color }};
    }

    .bd_element_widget.articles-box-block0054 .bd_widget_article_title .article-title a:hover {
        color: {{ $color }};
    }

    .bd_element_widget.articles-box-block0054 .bd_widget_article_readmore a:hover {
        color: {{ $color }};
    }

    .bd_element_widget.articles-box-block0054 .bd_widget_article_meta_footer a:hover {
        color: {{ $color }};
    }

    .bd_element_widget.articles-box-block0054 div.bdaia-post-sharing ul li {
        color: {{ $color }};
    }

    .bd_element_widget.articles-box-block0054 div.bdaia-post-sharing ul li a {
        color: {{ $color }};
    }

    .article__box {
        border-top: 8px solid {{ $color }};
    }

    .default_color_header {
        color: {{ $color }};
    }

    .typer {
        color: {{ $color }};
    }

    .btn.btn-primary {
        background: {{ $color }};
    }

    #supercharge .info .heading {
        color: {{ $color }};
    }

</style>
