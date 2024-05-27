<x-mail::message>
{{-- # New Quote --}}

{{-- Create a quote for you by {{ config('app.name') }} admin. Please upload your documents & payment now. --}}
# Hi {{$order->user?->name}},

Your order has been completed and enroute to your desired address. <br>

<a href="{{route('placeorder.index', [encrypt($order->invoice), 'delivery'])}}" style="all:unset; font-weight:600; color: #005EFF; font-size: 16px; cursor: pointer; text-decoration: none" >
    See Status
</a>

<br><br>

Regards,<br>
Immersive Brands <br>
Phone: <a href=”tel:+4402030053217“ style="color: black; text-decoration: none">+44 0203 005 3217</a>   <span style="font-weight:600; margin-left: 10px">Email:</span> <a href="mailto:info@immersivebrands.co.uk" style="color: black; text-decoration: none">info@immersivebrands.co.uk</a> <br>
Floor 14, 25 Cabot Square, London E14 4QZ
<br>
<br>


<img src="https://software.immersivebrands.co.uk/storage/app/public/setting/emailLogos.png" width="250px" alt="Logo" srcset="" class="img-fluid" style="margin-left: 130px;">
{{-- <img src="https://software.immersivebrands.co.uk/storage/app/public/setting/logos.png" width="500px" alt="Logo" srcset="" style="margin-left: 150px; margin-top: 80px"> --}}
</x-mail::message>