@extends('layouts.admin.app')

@section('title', 'Artwork Details')

@section('content')
    <x-admin.page title="Artwork Details">
        <x-slot name="header">
            <x-admin.page-button :href="route('admin.artwork.index')" title="Back To Artworks List" icon="back" />
            @can('edit_invoice')
                <x-admin.page-button :href="route('admin.invoice.edit', $artwork->id)" title="Send invoice" icon="invoice" id="invoiceBtn" />
            @endcan
        </x-slot>

        @include('admin.quotes.show-table', ['quote' => $artwork])

    </x-admin.page>
@endsection
