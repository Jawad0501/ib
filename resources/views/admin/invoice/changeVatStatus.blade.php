@if($selected_invoice->vat_status === 'undefined')

<x-admin.modal
    title="Change VAT Status"
    :action="route('admin.invoice.update-vat-status', $invoice)"
    button="Submit"
>
    @method('PUT')

    <x-admin.form-group label="VAT_status" column="col-12" isType="select">
        @foreach (['Included','Not Included', 'Undefined'] as $item)
            <option value="{{ $item }}" >{{ $item }}</option>
        @endforeach
    </x-admin.form-group>


</x-admin.modal>

<script>
    const button = document.getElementById('submit_button');
    console.log(button);
    button.addEventListener('click', () => {

        const confirmed = confirm('Are you sure you want to submit this form?');

        if(confirmed){

        }
        else{
            event.preventDefault();
        }
    })
</script>


@else

<x-admin.modal
    title="Change VAT Status"
>

    <div class="d-flex justify-content-center align-items-center">
        VAT status already changed!
    </div>

</x-admin.modal>

@endif
