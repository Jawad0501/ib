<x-mail::message>
    # Hi {{ $quote->user?->name }},

    I appreciate the opportunity to provide a quotation. Please see the attached document for details. <br>

    If you're happy with the quote, please click the link below to approve the order.


    <a href="{{ route('placeorder.index', [encrypt($quote->invoice), 'order']) }}"
        style="all:unset; font-weight:600; color: #005EFF; font-size: 16px; cursor: pointer; text-decoration: none">
        Place Order
    </a>
    <br>
    <br>

    I hope this meets your approval.

    Feel free to contact us if you have any inquiries or questions or need additional options.

    Regards,<br>
    Immersive Brands<br><br><br><br>
    Phone:
        <a href=”tel:+4402030053217“ style="color:black">+44 0203 005 3217</a>
        <span style="font-weight:600; margin-left: 10px">Email:</span>
        <a href="mailto:info@immersivebrands.co.uk" style="color: black; text-decoration: none">info@immersivebrands.co.uk</a>
    <br>
        Floor 14, 25 Cabot Square, London E14 4QZ
    <br>
    <br>

    <img src="https://software.immersivebrands.co.uk/storage/app/public/setting/emailLogos.png" width="250px" alt="Logo" srcset="" class="img-fluid" style="margin-left: 130px;">
</x-mail::message>
