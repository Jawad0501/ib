<x-mail::message>
{{-- # New Quote --}}

{{-- Create a quote for you by {{ config('app.name') }} admin. Please upload your documents & payment now. --}}
# Hi {{$order->user?->name}},

Your order was approved. <br>
Order No. {{$order->invoice}} <br>

<a href="{{route('placeorder.index', [encrypt($order->invoice), 'proof'])}}" style="all:unset; font-weight:600; color: #005EFF; font-size: 16px; cursor: pointer; text-decoration: none" >
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

{{-- <img src="https://software.immersivebrands.co.uk/storage/app/public/setting/logos.png" width="120px" alt="Logo" srcset=""> --}}
</x-mail::message>
