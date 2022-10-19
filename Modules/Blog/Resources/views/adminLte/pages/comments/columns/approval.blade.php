@php
    $approval_classes = [
        0 => 'warning',
        1 => 'success',
        2 => 'danger',
    ];
    $approval_texts = [
        0 => __('view.pending'),
        1 => __('view.approved'),
        2 => __('view.rejected'),
    ];
    $class_approved = $approval_classes[$model->approved];
    $text_approved = $approval_texts[$model->approved];
@endphp

<div class="approval-status model-id-{{ $model->id }}">
    <span class="badge fs-9 badge-{{$class_approved}}">
        {{ $text_approved }}
    </span>
</div>
