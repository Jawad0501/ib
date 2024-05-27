@props(['items' => []])
<div class="card-datatable table-responsive">
    <table class="table border" id="datatable">
        {{-- @if(request()->route()->getName() == 'admin.invoice.index')
        <div class="row gx-4 mb-2">
            <div class="col-3"></div>
            <div class="col-3"></div>
            <div class="col-3">
                <input type="text" name="daterange" class="form-control" value="01/01/2018 - 01/15/2018" />
            </div>
            <div class="col-3">
                <select name="status"  class="form-control" id="invoiceType">
                    <option value="">Invoice Status</option>
                    <option value="unpaid">Unpaid</option>
                    <option value="paid">Paid</option>
                </select>
            </div>
        </div>
        @endif --}}
        @if(request()->route()->getName() == 'admin.invoice.index')
        <div class="row ">
            <div class="col-3">
                <select name="status"  class="form-control" id="invoiceType">
                    <option value="">Invoice Status</option>
                    <option value="unpaid">Unpaid</option>
                    <option value="paid">Paid</option>
                </select>
            </div>
            <div class="col-3">
                <select name="vat_status"  class="form-control" id="vatType">
                    <option value="">VAT Status</option>
                    <option value="included">Included</option>
                    <option value="not included">Not Included</option>
                    <option value="undefined">Undefined</option>
                </select>
            </div>
        </div>
        @endif

        @if (count($items) > 0)
            <thead>
                <tr>
                    @foreach ($items as $item)
                        <th class="border">{{ ucwords(str_replace('_', ' ', $item)) }}</th>
                    @endforeach
                </tr>
            </thead>
        @endif
    </table>
    <tbody>
        {{ $slot }}
    </tbody>
</div>

{{-- <script>
    $(function() {
      $('input[name="daterange"]').daterangepicker({
        opens: 'left'
      }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      });
    });
</script> --}}

