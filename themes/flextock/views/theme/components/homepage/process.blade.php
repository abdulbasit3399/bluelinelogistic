
@php

    $textColor   = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" :  '' ;
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" :  '' ;
    $buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" :  '' ;
    $buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';
@endphp

    <!-- process -->
@if(array_key_exists('display', $data) && $data['display'])
<section class="process-section" id="process-section"  style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" :  ''  }}">

        <h2 data-i18n="headerThirdSection">{{$data['process_main_title'][app()->getLocale()] ?? ''}}</h2>

        <div class="process-card">
            <img src="{{ theme_setting_image($section->id,'process_1_image') != '' ? theme_setting_image($section->id,'process_1_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/illustration/warehouse.svg'))) }}" alt="Go Right" class="process-section--image" alt="Placing package on the shelf">
            <div class="indicator orange-indicator"><span>{{$data['process_1_counter'][app()->getLocale()] ?? ''}}</span></div>
            <div class="process-header">
                <h3 style="{{ $titleColor}}"  data-i18n="secondThirdSectionHeader">{{$data['process_1_title'][app()->getLocale()] ?? ''}}</h3>
                <img src="{{ asset('themes/flextock/assets/icons/arrow-right.svg') }}" alt="Go Right" class="process-icon process--arrow">
            </div>
            <p style="{{ $textColor }}" data-i18n="secondThirdSectionDescribtion">{{$data['sprocess_1_description'][app()->getLocale()] ?? ''}} </p>
        </div>
        <div class="process-card">
            <img src="{{ theme_setting_image($section->id,'process_2_image') != '' ? theme_setting_image($section->id,'process_2_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/illustration/forklift.svg'))) }}" class="process-section--image" alt="Moving the package around warehouse">
            <div class="indicator blue-indicator"><span>{{$data['process_2_counter'][app()->getLocale()] ?? ''}}</span></div>
            <div class="process-header">
                <h3 style="{{ $titleColor}}"  data-i18n="thirdThirdSectionHeader">{{$data['process_2_title'][app()->getLocale()] ?? ''}}</h3>
                <img src="{{ asset('themes/flextock/assets/icons/arrow-right.svg') }}" alt="Check Icon" class="process-icon process--arrow">
            </div>
            <p style="{{ $textColor }}" data-i18n="thirdThirdSectionDescribtion">{{$data['sprocess_2_description'][app()->getLocale()] ?? ''}} </p>
        </div>
        <div class="process-card">
            <img src="{{ theme_setting_image($section->id,'process_3_image') != '' ? theme_setting_image($section->id,'process_3_image') : (get_general_setting('website_logo', asset('themes/flextock/assets/illustration/courier.svg'))) }}" class="process-section--image" alt="Deliverying package to customer">
            <div class="indicator orange-indicator"><span>{{$data['process_3_counter'][app()->getLocale()] ?? ''}}</span></div>
            <div class="process-header">
                <h3 style="{{ $titleColor}}"  data-i18n="fifthThirdSectionHeader">{{$data['process_3_title'][app()->getLocale()] ?? ''}}</h3>
                <img  src="{{ asset('themes/flextock/assets/icons/check-small.svg')  }}" alt="Check Icon" class="process-icon">
            </div>
            <p style="{{ $textColor }}" data-i18n="fifthThirdSectionDescribtion"> {{$data['process_3_description'][app()->getLocale()] ?? ''}} </p>
        </div>

</section>
@endif

<style>
  .typer{
    color: {{array_key_exists('typer_color', $data) && $data['typer_color'] ? "{$data['typer_color']} !important;" : '#222;';}}
  }
</style>



