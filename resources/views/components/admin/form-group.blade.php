@props([
    'label',
    'islabel' => true,
    'for' => null,
    'required' => false,
    'isType' => 'input',
    'column' => null,
    'question' => null,
    'textarea_value' => ''
])

@php
    $htmlFor = $for != null ? $for : $label;
    $attr    = $attributes->merge(['type' => 'text', 'class' => 'form-control', 'name' => $htmlFor, 'id' => $htmlFor]);
@endphp

<div @class([$column => $column != null])>
    @if ($islabel)
        <label for="{{ $htmlFor }}" class="form-label">
            {{ ucfirst(str_replace('_', ' ', $label)) }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
            @if ($question !== null)
                <span style="cursor: help" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-html="true" title="<div>{!! $question !!}</div>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="i-icon i-icon--help"><g fill="none" fill-rule="evenodd" transform="translate(-115 -24)"><g transform="translate(114.355 23.757)"><path class="i-icon__fill" fill="#DBDFE4" d="M8.645.243a8 8 0 1 0 0 16 8 8 0 0 0 0-16z"></path><path class="i-icon__outline" fill="#112F49" d="M8.645 12.467l-.078.016h-.16c-.048-.01-.096-.017-.142-.03a.886.886 0 1 1 .384.014h-.004zM11.205 6.657c-.09.295-.25.564-.463.786a5.305 5.305 0 0 1-.8.658c-.16.11-.303.225-.453.34a.959.959 0 0 0-.296.428c-.032.086-.069.172-.103.26a.597.597 0 0 1-.556.394.784.784 0 0 1-.405-.064.66.66 0 0 1-.364-.494 1.135 1.135 0 0 1 .192-.848c.139-.203.308-.382.503-.531.21-.172.425-.335.64-.506.178-.136.327-.306.438-.5a.938.938 0 0 0-.112-1.04.858.858 0 0 0-.48-.266 1.528 1.528 0 0 0-.746.012.91.91 0 0 0-.577.48c-.075.14-.14.285-.211.428a1.027 1.027 0 0 1-.207.29.716.716 0 0 1-.542.174.754.754 0 0 1-.343-.093.594.594 0 0 1-.32-.528 1.551 1.551 0 0 1 .32-.98c.25-.336.58-.603.96-.777.288-.136.595-.225.911-.262L8.371 4h.32l.172.016c.428.027.847.135 1.234.32.345.159.64.41.85.728.162.25.26.533.29.829.043.254.033.515-.032.764z"></path></g></g></svg>
                </span>
                {{-- (<span class="text-danger">{{ $question }}</span>) --}}
            @endif
        </label>
    @endif
    @if ($isType === 'input')
        <input {{ $attr }} @required($required ? true : false) />
    @elseif($isType === 'textarea')
        <textarea {{ $attr }} @required($required ? true : false)>{{ $textarea_value }}</textarea>
    @elseif($isType === 'select')
        <select {{ $attr }} @required($required ? true : false)>
            {{ $slot }}
        </select>
    @else
        {{ $slot }}
    @endif

    <div class="invalid-feedback" id="invalid_{{ $htmlFor }}"></div>
</div>
