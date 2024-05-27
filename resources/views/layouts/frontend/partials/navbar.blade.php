<!--Navbar Start-->
<nav class="navbar navbar-expand-lg fixed-top sticky" id="navbar">
    <div class="container-fluid custom-container">
        <a class="navbar-brand text-dark fw-bold me-auto" href="/">
            <img src="{{ uploadedFile(getSetting('logo')) }}" height="40" alt="" class="logo-dark" />
            {{-- <img src="{{ asset('/') }}assets/images/logo-light.png" height="22" alt="" class="logo-light" /> --}}
        </a>

        <!--end navabar-collapse-->
        <ul class="header-menu list-inline d-flex align-items-center mb-0">
            @auth
                <li class="list-inline-item dropdown">
                    <a href="javascript:void(0)" class="header-item" id="userdropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ uploadedFile(auth()->user()->avatar) }}" alt="mdo" width="35" height="35" class="rounded-circle me-1">
                        <span class="d-none d-md-inline-block fw-medium">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">My Profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li class="list-inline-item">
                    <a href="{{ route('login') }}" class="header-item">Login</a>
                </li>
            @endauth

        </ul><!--end header-menu-->
    </div>
    <!--end container-->
</nav>
<!-- Navbar End -->
