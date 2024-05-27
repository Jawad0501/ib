<aside class="right-bar">
    <div>
        <div class="right-bar-header">
            <div class="d-flex align-items-center">
                <div class="avatar">
                    @if (!empty(auth()->user()->avatar))
                        <img src="{{ uploadedFile( auth()->user()->avatar ) }}" class="rounded-circle" width="48px" alt="{{ auth()->user()->name }}" />
                    @else
                        <div class="rounded bg-light d-flex align-items-center justify-content-center fs-4 p-2" style="width: 48px;height:48px">
                            {{ avatarText(auth()->user()->name) }}
                        </div>
                    @endif
                </div>
                <div class="ms-3">
                    <p class="mb-0 fs-16 fw-semibold">{{ Str::words(auth()->user()->designation, 2, '...') }}</p>
                    <p class="mb-0 fs-14">{{ auth()->user()->name }}</p>
                </div>
            </div>
            {{-- <div class="notify">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.53 15.3801H2.79999V7.4701C2.79999 3.6801 5.86999 0.600098 9.66999 0.600098C13.46 0.600098 16.54 3.6701 16.54 7.4701V15.3801H16.53Z" stroke="#333333" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M0.599976 15.3801H18.73" stroke="#333333" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.68 17.3701C11.68 18.4801 10.78 19.3901 9.65995 19.3901C8.53995 19.3901 7.63995 18.4901 7.63995 17.3701" stroke="#333333" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div> --}}
        </div>
        @php
            $quote = auth()->user()->quotes()->with('admin')->latest()->first();
            $admin = $quote?->admin;
            $name  = $admin->name ?? 'Emran Hoque';
            $email = $admin->email ?? getSetting('email');
            $phone = $admin->phone ?? getSetting('phone');
        @endphp
        <div class="right-bar-body">
            <div class="row gy-4">
                <div class="col-12">
                    <p class="mb-0 fs-14">Account Manager</p>
                    <p class="mb-0 fs-16 fw-semibold">
                        {{ $name }}
                    </p>
                </div>
                <div class="col-12">
                    <p class="mb-0 fs-14">Contact Details</p>
                    <p class="mb-0 fs-16 fw-semibold">
                        <a href="mailto:{{ $email }}" class="text-black">{{ $email }}</a>
                    </p>
                    <p class="mb-0 fs-16 fw-semibold">
                        <a href="tel:{{ $phone }}" class="text-black">{{ $phone }}</a>
                    </p>
                </div>
                @if ($quote?->account_type)
                    <div class="col-12">
                        <p class="mb-0 fs-14">Account Type</p>
                        <p class="mb-0 fs-16 fw-semibold">{{ $quote?->account_type }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="right-bar-footer">
        <div class="right-bar-footer-con">
            <div class="row gy-3">
                <div class="col-12">
                    <div class="border p-3 rounded-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.0725 19.9234H1.9823C1.06903 19.9234 0.333344 19.1877 0.333344 18.2744V1.89896C0.333344 0.98569 1.06903 0.25 1.9823 0.25H15.0725C15.9858 0.25 16.7215 0.98569 16.7215 1.89896V18.2744C16.7215 19.1877 15.9858 19.9234 15.0725 19.9234Z" fill="#5CB1FF"/>
                                    <path d="M4.67126 7.58154H9.84646" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4.67139 12.5918H12.3834" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <p class="mb-0 ms-2 fs-14 fw-semibold">Orders Placed</p>
                            </div>
                            <p class="mb-0 fs-12 fw-medium">{{ $placed }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="border p-3 rounded-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.0725 19.9234H1.9823C1.06903 19.9234 0.333344 19.1877 0.333344 18.2744V1.89896C0.333344 0.98569 1.06903 0.25 1.9823 0.25H15.0725C15.9858 0.25 16.7215 0.98569 16.7215 1.89896V18.2744C16.7215 19.1877 15.9858 19.9234 15.0725 19.9234Z" fill="#5CB1FF"/>
                                    <path d="M4.67126 7.58154H9.84646" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4.67139 12.5918H12.3834" stroke="white" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <p class="mb-0 ms-2 fs-14 fw-semibold">Quotes Requested</p>
                            </div>
                            <p class="mb-0 fs-12 fw-medium">{{ $requested }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
