<x-admin.modal
    title="Send Invoice"
    :action="route('admin.invoice.update', $invoice->id)"
    button="Submit"
>
    @method('PUT')

    <x-admin.form-group label="account_type" column="col-12" isType="select">
        <option value="">Select type</option>
        @foreach (['Proforma','Due on receipt','Invoice 7 days','Invoice 30 days'] as $item)
            <option value="{{ $item }}" @selected($invoice->account_type == $item)>{{ $item }}</option>
        @endforeach
    </x-admin.form-group>
</x-admin.modal>
