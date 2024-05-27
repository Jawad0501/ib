<x-mail::message>
{{-- # New Quote --}}

{{-- Create a quote for you by {{ config('app.name') }} admin. Please upload your documents & payment now. --}}
# Hi Admin,

You have got a new order request from {{$user->company_name}}. <br>

<span style="font-weight: 600">Quote Title:</span> {{$requested_quote['title']}} <br>
<span style="font-weight: 600">Quote Reference:</span> {{$requested_quote['reference']}} <br>
<span style="font-weight: 600">Quote PO Number:</span> {{$requested_quote['pO_Number']}} <br>
<span style="font-weight: 600">Delivery Address:</span> {{$requested_quote['delivery_Address']}} <br>
<span style="font-weight: 600">Notes:</span> {{$requested_quote['note']}} <br> <br>
<span style="font-weight: 600">Items:</span> <br> <br>
@php
    $i = 1;
@endphp
@foreach($requested_quote['items'] as $index => $item)
    # Item {{$i}} <br>
    Product Name: {{$item['product_name']}} <br>
    Quantity: {{$item['qty']}} <br> <br>
    @php
        $i = $i + 1;
    @endphp
@endforeach


Regards,<br>
{{$user->company_name}}<br>
Phone: <a href="tel:{{$user->telephone}}" style="color:black">{{$user->telephone}}</a>   <span style="font-weight:600; margin-left: 10px">Email:</span> <a href="mailto:{{$user->email}}" style="color: black; text-decoration: none">{{$user->email}}</a> <br>
<br>
<br>


{{-- <img src="https://software.immersivebrands.co.uk/storage/app/public/setting/emailLogos.png" width="250px" alt="Logo" srcset="" class="img-fluid" style="margin-left: 130px;"> --}}
</x-mail::message>
