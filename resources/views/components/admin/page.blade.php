@props(['title' => null, 'column' => 'col-12'])

<section>
    <div class="row">
        <div class="{{ $column }}">
            <!-- list and filter start -->
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h4 class="card-title">{{ ucwords($title) }}</h4>
                        <div class="d-flex">
                            <div class="me-1">
                                {{ $draft ?? '' }}
                            </div>
                            <div>
                                {{ $header ?? '' }}
                            </div>
                        </div>
                    </div>
                    {{ $slot }}
                </div>

            </div>
            <!-- list and filter end -->
        </div>
    </div>

</section>
