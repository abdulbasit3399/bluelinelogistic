@if (isset($data['socials']) && count($data['socials']))
    
<section class="social-counters-widget">
    <div class="wpb_widgetised_column">
        <div id="bdaia-widget-counter-2" class="content-only widget bdaia-widget bdaia-widget-counter">
            <div class="widget-box-title widget-box-title-s4"><h3>@lang('view.stay_connected')</h3></div>
                <ul class="social-counter-widget-ul">
                    @foreach($data['socials'] as $social)
                        @php
                            $platform = collect($platforms)->first(function ($pl) use ($social) { return $pl['id'] == $social['platform']; });
                        @endphp
                        @if ($platform)
                            <li class="social-counter">
                                <div class="wrapper-social">
                                    <div class="side1">
                                        <span class="icon" style="background-color: {{ $platform['color'] }};">
                                            <span class="bdaia-io bdaia-io-{{$platform['id']}}"></span>
                                        </span>
                                        <span class="sc-num">{{ $social['count'] }}</span>
                                    </div>
                                    <small class="count-type">{{ $platform['count_type'] }}</small>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            <!-- End Social Counter/-->
        </div>
        <div class="widget content-only"></div>
    </div>
</section>

@endif
