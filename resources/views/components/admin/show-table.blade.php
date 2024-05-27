@props([
    'propName',
    'items' => []
])

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        @if (count($items) > 0)
            <thead>
                <tr>
                    @foreach ($items as $item)
                        <th class="border">{{ ucwords(str_replace('_', ' ', $item)) }}</th>
                    @endforeach
                </tr>
            </thead>
        @endif
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
