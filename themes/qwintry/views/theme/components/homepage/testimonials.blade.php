@php
$hasImage = isset($model) && $model->image;
$getImage = $hasImage ? $model->imageUrl : '';
$getMobileImage = $hasImage ? $model->imageUrl : '';
$textColor = array_key_exists('text_color', $data) && $data['text_color'] ? "color: {$data['text_color']} !important;" : '';
$titleColor = array_key_exists('title_color', $data) && $data['title_color'] ? "color: {$data['title_color']} !important;" : '';
$pathColor = array_key_exists('pathColor', $data) && $data['pathColor'] ? "color: {$data['pathColor']} !important;" : '';
$link_color = array_key_exists('link_color', $data) && $data['link_color'] ? "color: {$data['link_color']} !important;" : '';
$buttonColor = array_key_exists('button_text_color', $data) && $data['button_text_color'] ? "color: {$data['button_text_color']} !important;" : '';
$buttonBgColor = array_key_exists('button_bg_color', $data) && $data['button_bg_color'] ? "background-color: {$data['button_bg_color']} !important;" : '';

$data = theme_setting('homepage.testimonials');

@endphp

<!-- testimonials -->
@if (array_key_exists('display', $data) && $data['display'])
    <section id="testimonials" class="section"
        style="{{ array_key_exists('header_bg', $data) && $data['header_bg'] ? "background-color: {$data['header_bg']} !important;" : '' }}">
        <div class="container-fluid">
            @php
                $col_width = 'col-lg-12';
                if ($data['testimonials_count'] == 3) {
                    $col_width = 'col-lg-4';
                } elseif ($data['testimonials_count'] == 2) {
                    $col_width = 'col-lg-6';
                }
            @endphp

            <div class="row footer-cols">
                <div class="{{ $col_width }} col-md-6 text-center ">

                    <div class="card card-body">
                        <div class="reviews-star mb-1 text-lg text-primary">

                            @for ($i = 1; $i <= ($data['rating_cont1'] ?? 5) ; $i++)
                                <i class="fas fa-star"></i>
                            @endfor

                            @for ($i = 1; $i <= 5 - ($data['rating_cont1'] ?? 5) ; $i++)
                                <i class="far fa-star"></i>
                            @endfor

                        </div>
                        <p class="mb-1 text-muted" style="{{ $pathColor }}">
                            {{ $data['path1'][app()->getLocale()] ?? '' }}</p>
                        <p class="text-lg mb-0"> {{ $data['section_description1'][app()->getLocale()] ?? '' }} </p>

                    </div>
                </div>
                @if ($data['testimonials_count'] > 1)
                    <div class="{{ $col_width }} col-md-6 text-center">

                        <div class="card card-body">
                            <div class="reviews-star mb-1 text-lg text-primary">
                                @for ($i = 1; $i <=  ($data['rating_cont2'] ?? 5); $i++)
                                    <i class="fas fa-star"></i>
                                @endfor

                                @for ($i = 1; $i <= 5 -  ($data['rating_cont2'] ?? 5); $i++)
                                    <i class="far fa-star"></i>
                                @endfor
                            </div>
                            <p class="mb-1 text-muted" style="{{ $pathColor }}">
                                {{ $data['path2'][app()->getLocale()] ?? '' }}</p>
                            <p class="text-lg mb-0"> {{ $data['section_description2'][app()->getLocale()] ?? '' }}
                            </p>
                        </div>

                    </div>
                @endif
                @if ($data['testimonials_count'] > 2)
                    <div class="{{ $col_width }} col-md-6 text-center">

                        <div class="card card-body">
                            <div class="reviews-star mb-1 text-lg text-primary">
                                @for ($i = 1; $i <= ($data['rating_cont3'] ?? 5); $i++)
                                    <i class="fas fa-star"></i>
                                @endfor

                                @for ($i = 1; $i <= 5 - ($data['rating_cont3'] ?? 5); $i++)
                                    <i class="far fa-star"></i>
                                @endfor
                            </div>
                            <p class="mb-1 text-muted" style="{{ $pathColor }}">
                                {{ $data['path3'][app()->getLocale()] ?? '' }} </p>
                            <p class="text-lg mb-0"> {{ $data['section_description3'][app()->getLocale()] ?? '' }}
                            </p>
                        </div>

                    </div>
                @endif

            </div>
            <div class="text-center">

            </div>
        </div>


    </section>
@endif
