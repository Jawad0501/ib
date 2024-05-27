@extends('layouts.admin.app')

@section('title', 'Quote Details')

@section('content')
    <x-admin.page title="Quote Details">

        <x-slot name="header">
            <x-admin.page-button :href="route('admin.quotes.index')" title="Back to quote List" icon="back" />
            @can('edit_quote')
                <x-admin.page-button :href="route('admin.quotes.edit', $quote->id)" title="Edit quote" icon="edit" />
            @endcan
            @can('edit_invoice')
                <x-admin.page-button :href="route('admin.invoice.edit', $quote->id)" title="Send invoice" icon="invoice" id="invoiceBtn" />
            @endcan
        </x-slot>

        @include('admin.quotes.show-table', ['quote' => $quote])
        
    </x-admin.page>
@endsection
