<x-admin.modal
    title="Approval Proof"
    :action="route('admin.proof.update', $proof->id)"
    button="Submit"
    enctype="multipart/form-data"
>
    @method('PUT')

    {{-- <x-admin.form-group label="status" column="col-12" isType="select">
        @foreach ($status as $item)
            <option value="{{ $item }}" @selected($item == $proof->status)>{{ ucfirst($item) }}</option>
        @endforeach
    </x-admin.form-group> --}}

    <x-admin.form-group type="file" label="approval_file" column="col-12" :required="false" />
</x-admin.modal>
