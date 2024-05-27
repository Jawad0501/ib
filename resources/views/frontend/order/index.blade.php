@extends('layouts.frontend.app')

@section('title', 'Orders')

@section('content')
<section>
    <div class="container">
        <x-frontend.quote-list title="Orders" :quotes="$orders" from="order">
            <x-slot name="header">
                <div class="d-flex flex-wrap gap-2">
                    {{-- @foreach ($status as $key => $value)
                        <a href="{{ route('order.index', ['status' => $key]) }}" @class(['btn-table text-capitalize', 'active' => request()->get('status') == $key])>{{ $key }}({{ $value }})</a>
                    @endforeach --}}
                </div>
            </x-slot>
        </x-frontend.quote-list>
    </div>
</section>
@endsection
