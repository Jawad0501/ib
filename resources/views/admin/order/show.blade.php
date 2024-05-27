@extends('layouts.admin.app')

@section('title', 'Order Details')

@section('content')
    <x-admin.page title="Order Details">
        <x-slot name="header">
            <x-admin.page-button :href="route('admin.order.index')" title="Back to order List" icon="back" />
            @can('edit_invoice')
                <x-admin.page-button :href="route('admin.invoice.edit', $order->id)" title="Send invoice" icon="invoice" id="invoiceBtn" />
            @endcan
        </x-slot>

        @include('admin.quotes.show-table', ['quote' => $order])

    </x-admin.page>
@endsection
