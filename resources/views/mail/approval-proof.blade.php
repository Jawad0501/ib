<x-mail::message>
{{-- # New Quote --}}

{{-- Create a quote for you by {{ config('app.name') }} admin. Please upload your documents & payment now. --}}
# Hi {{$order->user?->name}},

We've checked your file for job {{$order->invoice}} – and the results are ready for you to review. Only approve the artwork once you have checked all of the details and are happy to proceed to print. <br>

We know it's exciting, and you'll be tempted to approve immediately. However, please remember that it's your responsibility to check that everything is correct. We can't fix errors you find when you're holding your finished print. <br>

Your screen does a pretty bad impression of printed paper, so don't rely on the colours you see - they'll print differently. RGB and Pantone colours are converted to CMYK (where applicable), which will result in some colour shifts. You can request a PDF proof if you would like to check the CMYK colour makeup after pre-flighting.


<a href="{{route('placeorder.index', [encrypt($order->invoice), 'proof'])}}" style="all:unset; font-weight:600; color: #000000; text-decoration:none; font-size: 16px; cursor: pointer; text-transform: uppercase" >
See Proof
</a>
<br>
<br>

Check the content, and then choose an option below:

1) Approve for print <br>
-------------------- <br>
If you've properly checked your results, everything's correct, and you're happy to proceed, choose this option to go to print. <br><br>
3) Reject proof <br>
-------------------- <br>
If you notice something wrong and can't figure out how to fix it, please tell us what you'd like us to do. We'll let you know the cost before we proceed. We'll ask you to review the results again. <br> <br>
4) I'll upload a new file <br>
------------------------- <br>
If you spot an issue, choose this and upload a new file. <a href="{{route('placeorder.index', [encrypt($order->invoice), 'artwork'])}}" style="all:unset; font-weight:600; color: #000000; text-decoration:none; font-size: 16px; cursor: pointer; text-transform: uppercase" >click here</a>. <br> <br>

Regards,<br>
Immersive Brands <br><br><br><br>
Phone: <a href=”tel:+4402030053217“ style="color: black; text-decoration: none">+44 0203 005 3217</a>   <span style="font-weight:600; margin-left: 10px">Email:</span> <a href="mailto:info@immersivebrands.co.uk" style="color: black; text-decoration: none">info@immersivebrands.co.uk</a> <br>
Floor 14, 25 Cabot Square, London E14 4QZ
<br>
<br>


<img src="https://software.immersivebrands.co.uk/storage/app/public/setting/emailLogos.png" width="250px" alt="Logo" srcset="" class="img-fluid" style="margin-left: 130px;">

{{-- <img src="https://software.immersivebrands.co.uk/storage/app/public/setting/logos.png" width="500px" alt="Logo" srcset="" style="margin-left: 150px; margin-top: 80px"> --}}
</x-mail::message>
