<!-- /resources/views/layouts/navbar.blade.php -->

<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ url('admin') }}" class="logo d-flex align-items-center">
            <img src="/assets/img/logo.png" alt="">
            <span class="d-none d-lg-block" style="font-size: 20px">Smart Parcel Tracking</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center" style="padding-right: 15px">
            @guest
                @if (Route::has('login'))
                    <li class="nav-item" style="padding-right: 10px;">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <!-- Right Side Of Navbar -->
                <li class="nav-item dropdown pe-3">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('password.request') }}">Reset Password</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </nav><!-- End Icons Navigation -->

    @auth
        <aside id="sidebar" class="sidebar">
            <!-- Existing sidebar content -->
            <!-- ... -->

            <!-- ======= Sidebar ======= -->
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('admin.register.staff') }}">
                        <i class="bi bi-person-plus"></i>
                        <span>Register Staff</span>
                    </a>
                </li><!-- End Register Staff Nav -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('admin.staff.index') }}">
                        <i class="bi bi-people"></i>
                        <span>Account Index</span>
                    </a>
                </li><!-- End Account Index Nav -->

                <!-- Existing menu items -->
                <!-- ... -->

            </ul>
        </aside><!-- End Sidebar -->
    @endauth

</header><!-- End Header -->
