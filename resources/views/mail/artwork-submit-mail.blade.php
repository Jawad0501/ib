<x-mail::message>
# Dear Admin

{{ $quote->user?->name }} submited an artwork file against the quotation no. {{$quote->invoice}}. <br><br>

Please view the details by clicking the button below. <br><br>

<x-mail::button :url="route('admin.order.show', $quote->id)">Details</x-mail::button> <br><br>

Thanks.<br><br>



<img src="https://software.immersivebrands.co.uk/storage/app/public/setting/emailLogos.png" width="250px" alt="Logo" srcset="" class="img-fluid" style="margin-left: 130px;">

</x-mail::message>
