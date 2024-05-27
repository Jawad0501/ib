<aside class="aside d-flex flex-column justify-content-between">
    <div>
        <div class="logo">
            <img src="{{ uploadedFile(getSetting('frontend_logo')) }}" alt="Logo" srcset="" class="img-fluid">
        </div>

        <ul class="asidebar">
            <x-frontend.navlink label="Dashboard" :url="route('dashboard')" startUrl="dashboard" />
            <x-frontend.navlink label="Quotes" :url="route('quote.index')" startUrl="quote*" />
            <x-frontend.navlink label="Orders" :url="route('order.index', ['status' => 'pending'])" startUrl="order*" />
            <x-frontend.navlink label="My Files" :url="route('file.index')" startUrl="file*" />
            <x-frontend.navlink label="Invoice" :url="route('invoice.index')" startUrl="invoice*" />
            <x-frontend.navlink label="Profile" :url="route('profile.edit')" startUrl="profile*" />

            <li class="aside-item">
                <a href="{{ route('logout') }}" class="aside-link" onclick="event.preventDefault(); document.getElementById('logOutConfirmModalOpener').click();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <button class="d-none" id="logOutConfirmModalOpener" data-bs-toggle="modal" data-bs-target="#log-out-confirm-modal">MODAL</button>

            </li>

        </ul>
    </div>

    <!-- <div class="text-center py-4">
        <img src="{{ uploadedFile(getSetting('badge_logo')) }}" alt="Badge Logo" class="img-fluid w-50">
    </div> -->
</aside>

@include('components.frontend.log-out-confirm-modal')
