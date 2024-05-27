@props([
    'label' => 'Submit',
    'buttonType' => null,
    'onclick' => null
    ])

<button @if($onclick)onclick="{{$onclick}}"@endif {{ $attributes->merge(['class' => 'btn btn-dark py-2 px-5', 'type' => $buttonType, 'data-text' => $label]) }}>
    <span class="spinner-border spinner-border-sm d-none me-1" id="submit-spinner" role="status" aria-hidden="true"></span>
    <span id="btn--text">{{ $label }}</span>
</button>
