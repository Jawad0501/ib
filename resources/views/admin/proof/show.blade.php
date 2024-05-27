@extends('layouts.admin.app')

@section('title', 'Proof Details')

@section('content')
    <x-admin.page title="Proof Details">
        <x-slot name="header">
            <x-admin.page-button :href="route('admin.proof.index')" title="Back to proof List" icon="back" />
            @can('edit_invoice')
                <x-admin.page-button :href="route('admin.invoice.edit', $proof->id)" title="Send invoice" icon="invoice" id="invoiceBtn" />
            @endcan
        </x-slot>

        @include('admin.quotes.show-table', ['quote' => $proof])

    </x-admin.page>
@endsection
