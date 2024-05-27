<x-admin.modal
    title="Update status"
    :action="route('admin.order.update', $order->id)"
    button="Submit"
>
    @csrf
    @method('PUT')

    <x-admin.form-group onchange="togglePOField()" label="status" column="col-12" isType="select">
        <option value="pending" @selected('pending' == $order->status)>{{ ucfirst('pending') }}</option>
        @foreach ($status as $item)
            <option value="{{ $item }}" @selected($item == $order->status)>{{ ucfirst($item) }}</option>
        @endforeach
    </x-admin.form-group>

    <div id="po_field">
        {{-- <x-admin.form-group label="Enter PO Number" for="po"  /> --}}
        <label for="po" class="form-label">Enter PO Number</label>
        <input type="text" class="form-control" name="po" id="po" @if($order->order_number != null) value="{{$order->order_number}}" readonly @endif>
    </div>
</x-admin.modal>

<script>
    function togglePOField(){
        console.log(event.target.value);
        if(event.target.value == 'approved' || event.target.value == 'pending'){
            if(document.getElementById('po_field').classList.contains('d-none')){
                document.getElementById('po_field').classList.remove('d-none')
            }
            else{

            }
        }
        else{
            if(document.getElementById('po_field').classList.contains('d-none')){

            }
            else{
                document.getElementById('po_field').classList.add('d-none')
            }
        }
    }
</script>
