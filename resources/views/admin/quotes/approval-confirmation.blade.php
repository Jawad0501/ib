<x-admin.modal
    title="Approval Confirmation"
    :action="route('admin.quotes.confirm-approve', $quote->id)"
    button="Confirm"
    enctype="multipart/form-data"
>
    @method('PUT')

    {{-- <p class="fw-medium fs-5 text-center mb-0">Confirm Quote Approval?</p> --}}

    <x-admin.form-group label="Enter PO Number" for="po" />

</x-admin.modal>
