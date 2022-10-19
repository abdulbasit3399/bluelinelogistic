
@php
    $hasImage = isset($model) && $model->image;
    $getImage = $hasImage ? $model->imageUrl : '';
    $getMobileImage = $hasImage ? $model->imageUrl : '';

    
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
    
@endphp


<style type="text/css">
    #top-banner1 H1 {
      color: var(--gray-5);
    }
    #top-banner1 {
      background-image: url({{ theme_setting_image($section->id,'slides_1_img') != '' ? theme_setting_image($section->id,'slides_1_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/2.jpg'))) }});
    }
    #top-banner2 {
      background-image: url({{ theme_setting_image($section->id,'slides_2_img') != '' ? theme_setting_image($section->id,'slides_2_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/3.jpg'))) }} );
    }
    #top-banner3 {
      background-image: url({{ theme_setting_image($section->id,'slides_3_img') != '' ? theme_setting_image($section->id,'slides_3_img') : (get_general_setting('website_logo', asset('themes/shipito/assets/imgs/home/1.jpg'))) }});
    }
    
    @media (max-width: 47.9375rem) {
      #top-banner1,
      html[dir='rtl'] #top-banner1 {
        background-image: url({{ asset('themes/shipito/assets/imgs/home/TopBanner1m.jpg') }});
      }
    }
  </style>
@if(array_key_exists('display', $data) && $data['display'])
    <div class="container-fluid top-banner-outer"  style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}"  >        
        <div class="container-fluid top-banner-inner">
          <div id="carousel-full" class="carousel slide" data-ride="">
            <!-- Indicators -->
             <ol class="carousel-indicators">
              <li data-target="#carousel-full" data-slide-to="0" class=""></li>
              <li data-target="#carousel-full" data-slide-to="1" class=""></li>
              <li data-target="#carousel-full" data-slide-to="2" class="active"></li>
            </ol> 

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox" style="background-color: transparent">
              <div id="top-banner1" class="item" style="height: 492px; background-color: transparent; padding: 0 0 0 0; margin: 0 0 0 0" >
                <div class="container">
                  <div class="carousel-caption">
                    <h1 style="line-height: 50px ; {{$titleColor}}"> {{$data['slides_1_title'][app()->getLocale()] ?? ''}} </h1>
                  </div>
                </div>
              </div>
              <div id="top-banner2" class="item" style="height: 492px; background-color: transparent">
                <div class="container">
                  <div class="carousel-caption">
                    <h1 class="light" style="{{$titleColor}}"> {{$data['slides_2_title'][app()->getLocale()] ?? ''}} </h1>
                  </div>
                </div>
              </div>
              <div id="top-banner3" class="item active" style="height: 492px; background-color: transparent">
                <div class="container">
                  <div class="carousel-caption">
                    <h1 class="light" style="{{$titleColor}}" >{{$data['slides_3_title'][app()->getLocale()] ?? ''}}</h1>
                  </div>
                </div>
              </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control banner-nav-prev" href="#carousel-full" role="button" data-slide="prev">
              <img class="not-mobile" src="{{ asset('themes/shipito/assets/imgs/home/BannerNavLeft.svg') }}" style="width: 30px" />
              <img class="mobile-only" src="{{ asset('themes/shipito/assets/imgs/home/BannerNavLeft.svg') }}" style="width: 20px" />
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control banner-nav-next" href="#carousel-full" role="button" data-slide="next" >
              <img class="not-mobile" src="{{ asset('themes/shipito/assets/imgs/home/BannerNavRight.svg') }}" style="width: 30px" />
              <img class="mobile-only" src="{{ asset('themes/shipito/assets/imgs/home/BannerNavRight.svg') }}" style="width: 20px" />
              <span class="sr-only">Next</span>
            </a> 
          </div>
        </div>
      </div>
@endif 

<style>
  .typer{
    color: {{array_key_exists('typer_color', $data) && $data['typer_color'] ? "{$data['typer_color']} !important;" : '#222;';}}
  }
</style>