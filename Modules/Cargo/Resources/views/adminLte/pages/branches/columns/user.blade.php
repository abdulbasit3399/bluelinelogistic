<div class="d-flex align-items-center">
    <!--begin:: Avatar -->
    <div class="symbol symbol-circle symbol-40px overflow-hidden me-3">
        <a href="{{ fr_route('branches.show', $model->id) }}">
            <div class="symbol-label">
                <img src="{{ $model->getFirstMediaUrl('avatar') }}" class="w-100" />
            </div>
        </a>
    </div>
    <!--end::Avatar-->
    <!--begin::User details-->
    <div class="d-flex flex-column">
        <a href="{{ fr_route('branches.show', $model->id) }}" class="text-gray-800 text-hover-primary mb-1">
            {{ $model->name }}
        </a>
        <span>{{ $model->email }}</span>
    </div>
    <!--begin::User details-->
</div>