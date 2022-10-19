@php
    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
    $cardTitleColor  = array_key_exists('card_title_color', $data) && $data['card_title_color'] ? "color: {$data['card_title_color']} !important;" :  '' ;
@endphp

<!-- business -->
@if(array_key_exists('display', $data) && $data['display'])
<section id="business" class="section" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">
    <div class="">
        <div class="intro">
            <h2 class="heading" style="{{$titleColor}}">{{$data['section_title'][app()->getLocale()] ?? ''}}</h2>
            <p class="sub text-muted" style="{{$textColor}}">{{$data['section_subtitle'][app()->getLocale()] ?? ''}}</p>
        </div>

        <div class="contents">
            <div class="accordion" id="accordionExample">
                <div class="card" style="{{ array_key_exists('card_bg_color', $data) && $data['card_bg_color'] ? "background-color: {$data['card_bg_color']} !important;" :  ''  }}">
                    <div class="header" id="headingOne">
                        <button
                        class="btn"
                        type="button"
                        data-toggle="collapse"
                        data-target="#collapseOne"
                        aria-expanded="true"
                        aria-controls="collapseOne"
                        >
                        <h3 class="heading" style="{{$cardTitleColor}}">
                            {{$data['card_title_1'][app()->getLocale()] ?? ''}}
                            <i data-feather="chevron-down"></i>
                        </h3>
                        </button>
                    </div>

                    <div
                        id="collapseOne"
                        class="collapse show"
                        aria-labelledby="headingOne"
                        data-parent="#accordionExample"
                    >
                        <div class="body">
                            <img class="image" src="{{ theme_setting_image($section->id,'section_mobile_banner_1') != '' ? theme_setting_image($section->id,'section_mobile_banner_1') : (get_general_setting('website_logo', asset('themes/easyship/assets/imag/business-crowdfunding.png'))) }}" alt="demo" />
                            <img class="image lg" src="{{ theme_setting_image($section->id,'section_banner_1') != '' ? theme_setting_image($section->id,'section_banner_1') : (get_general_setting('website_logo', asset('themes/easyship/assets/img/9.svg'))) }}" alt="demo" />

                            <p class="text" style="{{$textColor}}">
                                {{$data['card_description_1'][app()->getLocale()] ?? ''}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card" style="{{ array_key_exists('card_bg_color', $data) && $data['card_bg_color'] ? "background-color: {$data['card_bg_color']} !important;" :  ''  }}">
                    <div class="header" id="headingTwo">
                        <button
                        class="btn collapsed"
                        type="button"
                        data-toggle="collapse"
                        data-target="#collapseTwo"
                        aria-expanded="false"
                        aria-controls="collapseTwo"
                        >
                        <h3 class="heading" style="{{$cardTitleColor}}">
                            {{$data['card_title_2'][app()->getLocale()] ?? ''}}
                            <i data-feather="chevron-down"></i>
                        </h3>
                        </button>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="body">
                            <img class="image" src="{{ theme_setting_image($section->id,'section_mobile_banner_2') != '' ? theme_setting_image($section->id,'section_mobile_banner_2') : (get_general_setting('website_logo', asset('themes/easyship/assets/images/business-crowdfunding.png'))) }}" alt="demo" />
                            <img class="image lg" src="{{ theme_setting_image($section->id,'section_banner_2') != '' ? theme_setting_image($section->id,'section_banner_2') : (get_general_setting('website_logo', asset('themes/easyship/assets/img/9.svg'))) }}" alt="demo" />

                            <p class="text" style="{{$textColor}}">
                                {{$data['card_description_2'][app()->getLocale()] ?? ''}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card" style="{{ array_key_exists('card_bg_color', $data) && $data['card_bg_color'] ? "background-color: {$data['card_bg_color']} !important;" :  ''  }}">
                    <div class="header" id="headingThree">
                        <button
                        class="btn collapsed"
                        type="button"
                        data-toggle="collapse"
                        data-target="#collapseThree"
                        aria-expanded="false"
                        aria-controls="collapseThree"
                        >
                            <h3 class="heading" style="{{$cardTitleColor}}">
                                {{$data['card_title_3'][app()->getLocale()] ?? ''}}
                                <i data-feather="chevron-down"></i>
                            </h3>
                        </button>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="body">
                            <img class="image" src="{{ theme_setting_image($section->id,'section_mobile_banner_3') != '' ? theme_setting_image($section->id,'section_mobile_banner_3') : (get_general_setting('website_logo', asset('themes/easyship/assets/images/business-crowdfunding.png'))) }}" alt="demo" />
                            <img class="image lg" src="{{ theme_setting_image($section->id,'section_banner_3') != '' ? theme_setting_image($section->id,'section_banner_3') : (get_general_setting('website_logo', asset('themes/easyship/assets/img/9.svg'))) }}" alt="demo" />

                            <p class="text" style="{{$textColor}}">
                                {{$data['card_description_3'][app()->getLocale()] ?? ''}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif


<style>
  .business{
    background-color: {{array_key_exists('header_bg', $data) && $data['header_bg'] ? "{$data['header_bg']} !important;" : '';}}
  }
</style>
