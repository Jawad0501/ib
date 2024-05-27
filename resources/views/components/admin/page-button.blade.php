@props(['title', 'icon' => null, ])

@php
    $disIcon = match($icon) {
        'add'      => 'ti-circle-plus',
        'upload'   => 'ti-upload',
        'download' => 'ti-download',
        'back'     => 'ti-arrow-bar-left',
        'edit'     => 'ti-edit',
        'show'     => 'ti-eye',
        'delete'   => 'ti-trash',
        'reload'   => 'ti-rotate',
        'print'    => 'ti-print',
        'invoice'  => 'ti-file',
        default => null
    };
    $btnClass = match($icon) {
        'add'      => 'btn-success',
        'upload'   => 'btn-info',
        'download' => 'btn-warning',
        'back'     => 'btn-danger',
        'edit'     => 'btn-warning',
        'show'     => 'btn-warning',
        'delete'   => 'btn-warning',
        'reload'   => 'btn-warning',
        'print'    => 'btn-warning',
        'invoice'  => 'btn-success',
        default => null
    };
@endphp

<a {{ $attributes->merge(['class' => "btn $btnClass", ]) }}>
    @if ($icon != null) <i class="ti {{ $disIcon }}"></i> @endif
    {{ ucwords($title) }}
</a>
