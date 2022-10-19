<!-- start-shipping -->
@php
    $hasImage = isset($model) && $model->image;
    $getImage = $hasImage ? $model->imageUrl : '';
    $getMobileImage = $hasImage ? $model->imageUrl : '';

    $section_sub_title_color   = array_key_exists('section_sub_title_color', $data) && $data['section_sub_title_color'] ? "color: {$data['section_sub_title_color']} !important;" : 'color: ;';
    $titleColor  = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : 'color: ;';

    $card_1_bg_color  = array_key_exists('card_1_bg_color', $data) && $data['card_1_bg_color'] ? "background-color: {$data['card_1_bg_color']} !important;" : 'background-color: ;';
    $card_title_1_color  = array_key_exists('card_title_1_color', $data) && $data['card_title_1_color'] ? "color: {$data['card_title_1_color']} !important;" : 'color: ;';
    $card_desc_1_color  = array_key_exists('card_desc_1_color', $data) && $data['card_desc_1_color'] ? "color: {$data['card_desc_1_color']} !important;" : 'color: ;';
    $buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" : 'color: ;';
    $buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : 'background-color: ;';
@endphp
<!-- statistics -->
<section id="statistics" class="section mb-3 mt-5" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" : 'background-color: #fff;' }}">
        <div class="bg-angle"></div>
        <div class="container">
          {{-- <div class="intro">
            <h2 class="heading" style="{{$titleColor}}">{{$data['section_title'][app()->getLocale()] ?? ''}}</h2>
            <p class="sub" style="{{$section_sub_title_color}}">{{$data['section_sub_title'][app()->getLocale()] ?? ''}}</p>
          </div> --}}

          <div class="contents">
            <div class="row">
              <div class="col-md-6">
                <div class="row cards">
                  <div class="col-6">
                    <div class="card" style="{{$card_1_bg_color}}">
                      <div class="title" style="{{$card_title_1_color}}">{{$data['card_title_5'][app()->getLocale()] ?? ''}}</div>
                      <div class="sub" style="{{$card_desc_1_color}}">{{$data['card_description_5'][app()->getLocale()] ?? ''}}</div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="card" style="{{$card_1_bg_color}}">
                      <div class="title" style="{{$card_title_1_color}}">{{$data['card_title_4'][app()->getLocale()] ?? ''}}</div>
                      <div class="sub" style="{{$card_desc_1_color}}">{{$data['card_description_4'][app()->getLocale()] ?? ''}}</div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="card" style="{{$card_1_bg_color}}">
                      <div class="title" style="{{$card_title_1_color}}">{{$data['card_title_3'][app()->getLocale()] ?? ''}}</div>
                      <div class="sub" style="{{$card_desc_1_color}}">{{$data['card_description_3'][app()->getLocale()] ?? ''}}</div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="card" style="{{$card_1_bg_color}}">
                      <div class="title" style="{{$card_title_1_color}}">{{$data['card_title_2'][app()->getLocale()] ?? ''}}</div>
                      <div class="sub" style="{{$card_desc_1_color}}">{{$data['card_description_2'][app()->getLocale()] ?? ''}}</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 highlight">
                <div class="card" style="{{$card_1_bg_color}}">
                  <div class="title" style="{{$card_title_1_color}}">{{$data['card_title_1'][app()->getLocale()] ?? ''}}</div>
                  <div class="sub" style="{{$card_desc_1_color}}">{{$data['card_description_1'][app()->getLocale()] ?? ''}}</div>
                </div>
              </div>
            </div>

            @php
                $button_type = isset($data['section_url']) ? $data['section_url']['type'] : '';
            @endphp
            <div class="text-center">
                <form action="{{$data['section_url'][$button_type] ?? ''}}">
                    <button type="submit" class="btn btn-primary btn-lg mx-auto" style="{{$buttonColor }} {{$buttonBgColor}}">
                        {{$data['section_button'][app()->getLocale()] ?? ''}}
                    </button>
                </form>
            </div>
          </div>
        </div>
      </section>
