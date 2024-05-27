@props([
    'text' => 'Submit',
    'button_id' => 'submit_button'
])


<button {{ $attributes->merge(['class' => 'btn btn-primary me-sm-3 me-1', 'id' => $button_id, 'data-button' => 'submit', 'type' => 'submit', 'data-text' => $text]) }}>
    <span class="spinner-border spinner-border-sm d-none me-1" id="submit-spinner" role="status" aria-hidden="true"></span>
    <span id="btn--text">{{ $text }}</span>
</button>
