<x-admin.modal
    title="Change Invoice Status"
    :action="route('admin.invoice.update-status', $invoice)"
    button="Submit"
>
    @method('PUT')

    <x-admin.form-group label="invoice_status" column="col-12" isType="select" onchange="togglePaidAmountField()">
        @foreach (['Unpaid','Paid', 'Partially Paid'] as $item)
            <option value="{{ $item }}" >{{ $item }}</option>
        @endforeach
    </x-admin.form-group>

    <div id="paidAmountField" class="d-none">
        <x-admin.form-group label="paid amount" name="paid_amount" id="paid_amount" column="col-12" isType="input" type="number" step="0.01" max="{{$total_amount}}">
        </x-admin.form-group>
        <p class="fw-medium" style="font-size: 12px;">Total Amount Left: <span>{{convertAmount($total_amount)}}</span></p>
    </div>
</x-admin.modal>

<script>
    function togglePaidAmountField(){
        let value = event.target.value;
        let paidAmountField = document.getElementById('paidAmountField');

        if(value == 'Partially Paid'){
            if(paidAmountField.classList.contains('d-none')){
                paidAmountField.classList.remove('d-none')
            }
            else{

            }
        }
        else{
            if(paidAmountField.classList.contains('d-none')){

            }
            else{
                paidAmountField.classList.add('d-none')
            }
        }
    }
</script>
