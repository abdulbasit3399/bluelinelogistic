<div class="wpb_widgetised_column">
    <div id="bdaia-widget-timeline-{{ $id }}" class="content-only widget bdaia-widget bdaia-widget-timeline">
        <div class="widget-box-title widget-box-title-s4">
            <h3>{{ $data['section_title'][app()->getLocale()] ?? '' }}</h3>
        </div>
        <div class="widget-inner">
            <ul>
                @foreach($posts as $post)
                    <li>
                        <a href="{{ fr_route('post-page', ['slug' => $post['slug'] ]) }}" target="_blank">
                            <span class="bdayh-date">{{ $post['date'] }}</span>
                            <h3>{{ $post['title'] }}</h3>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="widget content-only"></div>
</div>