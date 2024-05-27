@props(['title', 'description' => null, 'button', 'button_id', 'size' => 'md'])

<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-{{ $size}} modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2">{{ ucfirst($title) }}</h3>
                    <p class="text-muted">{{ $description }}</p>
                </div>
                <!-- Add role form -->
                <form {{ $attributes->merge(['method' => 'post', 'id' => 'submit', 'class' => 'row g-1']) }}>
                    @csrf

                    {{ $slot }}

                    <div class="col-12 text-center mt-4">
                        @isset($button)
                            <x-admin.submit-button :text="$button"   />
                        @endisset
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>
