<x-mail::message>

# Hello {{$order->user?->name}}, <br>

A quotation was listed for {{$order->user?->company_name}}. <br> <br>
You will be glad to know that the quotation order was Approved. To see the details please click the button below.<br><br>

<x-mail::button :url="route('placeorder.index', [encrypt($order->invoice), 'proof'])">Show Details</x-mail::button>

Regards,<br>
Immersive Brands<br><br><br><br>
Phone: <a href=”tel:+4402030053217“ style="color:black">+44 0203 005 3217</a>   <span style="font-weight:600; margin-left: 10px">Email:</span> <a href="mailto:info@immersivebrands.co.uk" style="color: black; text-decoration: none">info@immersivebrands.co.uk</a> <br>
Floor 14, 25 Cabot Square, London E14 4QZ
<br>
<br>

<img src="https://software.immersivebrands.co.uk/storage/app/public/setting/emailLogos.png" width="250px" alt="Logo" srcset="" class="img-fluid" style="margin-left: 130px;">
</x-mail::message>
