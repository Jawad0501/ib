<x-mail::message>
{{-- # New Quote --}}

{{-- Create a quote for you by {{ config('app.name') }} admin. Please upload your documents & payment now. --}}

# Hi Admin,

{{$quote->user?->company_name}} requested an invoice for the quotation no. {{$quote->invoice}}. <br>

<a href="{{route('invoice.send-invoice', encrypt($quote->invoice))}}" style="all:unset; font-weight:600; color: #005EFF; font-size: 16px; cursor: pointer; text-decoration: none;" >
Send Invoice
</a>
<br><br>

Thanks. <br><br>

<img src="https://software.immersivebrands.co.uk/storage/app/public/setting/emailLogos.png" width="250px" alt="Logo" srcset="" class="img-fluid" style="margin-left: 130px;">

</x-mail::message>
