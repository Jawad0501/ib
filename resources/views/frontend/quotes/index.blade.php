@extends('layouts.frontend.app')

@section('title', 'Quotes')

@section('content')
<section>
    <div class="container">
        <x-frontend.quote-list title="Quotes" :quotes="$quotes" />
    </div>
</section>
@endsection
