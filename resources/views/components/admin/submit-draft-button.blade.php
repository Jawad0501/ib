@props([
    'text' => 'Submit'
])

{{-- <input type="hidden" name="is_draft" value="true"> --}}

<button {{ $attributes->merge(['class' => 'btn btn-primary me-sm-3 me-1', 'id' => '', 'data-button' => 'draft', 'type' => 'submit', 'data-text' => $text]) }}>
    <span class="spinner-border spinner-border-sm d-none me-1" id="draft-spinner" role="status" aria-hidden="true"></span>
    <span id="draft-btn--text">{{ $text }}</span>
</button>
