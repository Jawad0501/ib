@extends('layouts.frontend.app')

@section('title', 'Invoices')

@section('content')
<section>
    <div class="container">
        <x-frontend.quote-list title="Invoice" :quotes="$quotes" from="invoice" />
    </div>
</section>
@endsection
