<x-frontend.new-modal :title="$quote->order_title" :quote="$quote" :modal_page="$modal_page" :type="$type" size="xl" button="Place Order" action="{{ route('quote.store') }}">
    <input type="hidden" name="quote_id" id="quote_id" value="{{ $quote->id }}" >
    <div class="row gy-3">
        @foreach ($quote->items as $item)
        <div class="d-flex align-items-center pe-5">
            <div class="me-3">
                <input class="form-check-input" type="checkbox" name="items[]" value="{{ $item->id }}" onchange="getFormValues(this)" id="items[{{ $item->id }}]">
            </div>
            <div class="col-12">
                <div class="border bg-white p-3 p-lg-4 rounded-4">
                    <div class="row gy-4 gy-lg-0 align-items-center">
                        <div class="col-12 col-lg-5">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 fw-medium">
                                        <a href="#" class="text-dark">{{ $item->product?->name }}</a>
                                    </p>
                                    <div class="d-flex align-items-center gap-2 mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                        <span>{{ $item->quantity }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="d-flex justify-content-between gap-2">
                                <p class="mb-0">
                                    <strong class="border border-2 rounded-3 border-light p-1 text-center unit-price-label" title="Unit Price" style="font-size:10px;">Unit</strong>
                                    <span class="ms-1">{{ convertAmount($item->unit_price) }}</span>
                                </p>
                                <p class="mb-0">
                                    <strong class="border border-2 rounded-3 border-light p-1 text-center" title="Sub Total" style="font-size:10px;">SubTotal</strong>
                                    <span class="ms-1">{{ convertAmount($item->subtotal, false) }}</span>
                                </p>
                                <p class="mb-0">
                                    <strong class="border border-2 rounded-3 border-light p-1 text-center" style="font-size:10px;">Vat</strong>
                                    <span class="ms-1">{{ convertAmount($item->vat_percentage) }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2 text-lg-end">
                            <button type="button" class="btn btn-light">{{ convertAmount($item->total) }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</x-frontend.new-modal>

<script>
    let items = [];
    let quote_id = document.getElementById('quote_id').value;
    let csrfToken = document.getElementById('token').value;

    function getFormValues(element){
        if(items.includes(element.value)){
            var index = items.indexOf(element.value);
            if (index !== -1) {
                items.splice(index, 1);
            }
        }
        else{
            items.push(element.value);
        }

        if(items.length <= 0){
            if(document.getElementById('confirmButton').classList.contains('disabled')){

            }
            else{
                document.getElementById('confirmButton').classList.add('disabled')
            }
        }
        else if(items.length > 0){
            if(document.getElementById('confirmButton').classList.contains('disabled')){
                document.getElementById('confirmButton').classList.remove('disabled')
            }
            else{

            }
        }
    }

    function changeModalPage(event, number){

        console.log(event);

        if(number == 1){
            if(items.length > 0){
                document.getElementById('page1').style.display = 'none';
                document.getElementById('page2').style.display = 'block';
            }
        }
        else{
            document.getElementById('page1').style.display = 'block';
            document.getElementById('page2').style.display = 'none';
        }

    }

    function convertReadStream(response){
        return response.json();
    }

    function saveOrder(type){


        if(quote_id == null){

        }
        else if(items.length <= 0){

        }
        else{

            if(type == 'quote'){
                var url = "{{ route('quote.store') }}";
                fetch(url, {
                    method:'POST',
                    credentials: "same-origin",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body:JSON.stringify({
                        id: quote_id,
                        items: items
                    }),
                })
                .then(res=>res.clone().json())
                .then( json => {
                    document.getElementById('invoice_no').innerHTML = `Order #${json.invoice_no}`
                    document.getElementById('successModalOpener').click();
                })
            }
            else if(type == 'order'){
                var url = "{{ route('reorder-quote') }}";
                fetch(url, {
                    method:'POST',
                    credentials: "same-origin",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body:JSON.stringify({
                        id: quote_id,
                        items: items
                    }),
                })
                .then(res=>res.clone().json())
                .then( json => {
                    document.getElementById('invoice_no').innerHTML = `Order #${json.invoice_no}`
                    document.getElementById('successModalOpener').click();
                })
            }

        }
    }



</script>
