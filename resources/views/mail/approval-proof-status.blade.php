<x-mail::message>
{{-- # New Quote --}}

{{-- Create a quote for you by {{ config('app.name') }} admin. Please upload your documents & payment now. --}}
# Dear Admin,

An approval proof was sent to {{$order->user?->company_name}} for order approval against the quotation no. {{$order->invoice}}. <br><br>

@if($status == 'approved')
## {{$order->user?->name}} approved the order after viewing the approval file.
@else
## {{$order->user?->name}} rejected the order after viewing the approval file. <br> <br>
Reason: {{$reason}}
@endif

To view details please click the button below. <br> <br>

<x-mail::button :url="route('admin.order.show', $order->id)">Details</x-mail::button> <br><br><br>

Thanks.<br><br>


<img src="https://software.immersivebrands.co.uk/storage/app/public/setting/emailLogos.png" width="250px" alt="Logo" srcset="" class="img-fluid" style="margin-left: 130px;">

{{-- <img src="https://software.immersivebrands.co.uk/storage/setting/logo.png" width="120px" alt="Logo" srcset="" class="img-fluid"> <br> --}}
{{-- <img src="https://software.immersivebrands.co.uk/storage/app/public/setting/logos.png" width="500px" alt="Logo" srcset="" style="margin-left: 150px; margin-top: 80px"> --}}
</x-mail::message>
