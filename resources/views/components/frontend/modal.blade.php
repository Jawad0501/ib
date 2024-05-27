@props([
    'title',
    'description' => null,
    'button' => null,
    'size' => 'md',
    'enctype' => 'application/x-www-form-urlencoded',
    'redirect' => null
])

<div class="modal fade" id="modal" tabindex="-1">
    <div class="modal-dialog modal-{{ $size}}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ ucfirst($title) }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form {{ $attributes->merge(['method' => 'post', 'id' => 'submit', 'enctype' => $enctype, 'data-redirect' => $redirect]) }}>
                @csrf

                <div class="modal-body">
                    {{ $slot }}
                </div>

                @if ($button !== null)
                    <div class="modal-footer">
                        <x-frontend.submit-button :label="$button" type="submit" />
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
