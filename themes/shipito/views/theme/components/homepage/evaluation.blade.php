@php
$hasImage = isset($model) && $model->image;
$getImage = $hasImage ? $model->imageUrl : '';
$getMobileImage = $hasImage ? $model->imageUrl : '';

$textColor = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : '';
$headingtextColor = array_key_exists('heading_title_color', $data) && $data['heading_title_color'] ? "color: {$data['heading_title_color']} !important;" : '';
@endphp


@if (array_key_exists('display', $data) && $data['display'])
        <div class="container aos-init aos-animate " data-aos="fade-up" style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" : '' }}">


            <div class="reviews row ">
              <div class="col-md-6 col-lg-4">
                <div class="review">
                  <span class="stars" >
                    @for ($i = 1; $i <= ($data['rating_cont1'] ?? 5) ; $i++)
                            <i class="fas fa-star"></i>
                    @endfor

                    @for ($i = 1; $i <= 5 - ($data['rating_cont1'] ?? 5) ; $i++)
                        <i class="far fa-star"></i>
                    @endfor
                  </span>
                  <span class="review-text" style="{{ $textColor }}" >{{$data['description_1_evaluation'][app()->getLocale()] ?? ''}}</span >
                </div>
              </div>

              <div class="col-md-6 col-lg-4">
                <div class="review">
                  <span class="stars" >
                    @for ($i = 1; $i <= ($data['rating_cont2'] ?? 5) ; $i++)
                            <i class="fas fa-star"></i>
                    @endfor

                    @for ($i = 1; $i <= 5 - ($data['rating_cont2'] ?? 5) ; $i++)
                        <i class="far fa-star"></i>
                    @endfor
                  </span>
                  <span class="review-text" style="{{ $textColor }}" >{{$data['description_2_evaluation'][app()->getLocale()] ?? ''}}</span>
                </div>
              </div>

              <div class="col-md-6 col-lg-4">
                <div class="review">
                  <span class="stars" >
                    @for ($i = 1; $i <= ($data['rating_cont3'] ?? 5) ; $i++)
                            <i class="fas fa-star"></i>
                    @endfor

                    @for ($i = 1; $i <= 5 - ($data['rating_cont3'] ?? 5) ; $i++)
                        <i class="far fa-star"></i>
                    @endfor
                  </span>
                  <span class="review-text" style="{{ $textColor }}">"{{$data['description_3_evaluation'][app()->getLocale()] ?? ''}}</span>

                </div>
              </div>

            </div>
          </div>


          <div style="display: block"></div>





@endif

<style>
    #good-hands::before {
        background-color: {{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "{$data['header_bg']} !important;" : '#fff;' }}
    }

</style>
