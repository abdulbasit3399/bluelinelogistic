<div class="mb-6">
    <button
        type="button"
        class="btn btn-sm btn-secondary btn-show-translate-fields"
    >
        <i class="fas fa-language fa-fw fs-3 me-1"></i>
        <span class="text-toggle hide">
            {{ __('view.hide') }}
        </span>
        {{ __('view.translate') }}
    </button>
    <input type="hidden" class="translate-input {{ old('translate-active') == 'true' ? 'show-fields' : '' }}" name="translate-active" value="{{ old('translate-active', 'false') }}">
</div>