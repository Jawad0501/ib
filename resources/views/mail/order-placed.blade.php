<x-mail::message>
{{-- # New Quote --}}

# Dear Admin,

A quotation was created for {{$quote->user?->company_name}}, under the quote no. {{$quote->invoice}}. <br><br>

## The quotation order has been confirmed. <br><br>

Thanks.<br><br>


<img src="https://software.immersivebrands.co.uk/storage/app/public/setting/emailLogos.png" width="250px" alt="Logo" srcset="" class="img-fluid" style="margin-left: 130px;">
</x-mail::message>
