<x-mail::message>
{{-- # New Quote --}}

{{-- Create a quote for you by {{ config('app.name') }} admin. Please upload your documents & payment now. --}}

# Hi {{$quote->user?->name}},

Thank you for working with Immersive Brand Ltd to produce your order. I am attaching our Invoice for your kind attention. <br><br>
If you have any queries, please do not hesitate to contact us.


Regards,<br>
Immersive Brands <br><br><br><br>
Phone: <a href=”tel:+4402030053217“ style="color: black;">+44 0203 005 3217</a>   <span style="font-weight:600; margin-left: 10px">Email:</span> <a href="mailto:info@immersivebrands.co.uk" style="color: black; text-decoration: none;">info@immersivebrands.co.uk</a> <br>
Floor 14, 25 Cabot Square, London E14 4QZ
<br>
<br>


<img src="https://software.immersivebrands.co.uk/storage/app/public/setting/emailLogos.png" width="250px" alt="Logo" srcset="" class="img-fluid" style="margin-left: 130px;">


</x-mail::message>
