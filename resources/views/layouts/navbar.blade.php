<!-- /resources/views/layouts/navbar.blade.php -->

<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="/home" class="logo d-flex align-items-center">
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
                <li class="nav-item dropdown">
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
                </li>
            </ul>
        </nav><!-- End Icons Navigation -->
    @endguest

</header><!-- End Header -->

@auth
    <aside id="sidebar" class="sidebar">
        <!-- Existing sidebar content -->
        <!-- ... -->

        <!-- ======= Sidebar ======= -->
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link " href="/home">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#parcels-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-box-seam"></i><span>Parcels</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="parcels-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('parcels.create') }}">
                            <i class="bi bi-circle"></i><span>Register Parcel</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('parcels.index') }}">
                            <i class="bi bi-circle"></i><span>View Parcels</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Parcels Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#complaints-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-chat-left-text"></i><span>Complaints</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="complaints-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('complaints.create') }}">
                            <i class="bi bi-circle"></i><span>Create Complaint</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('complaints.index') }}">
                            <i class="bi bi-circle"></i><span>View Complaints</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Complaints Nav -->

            <!-- Existing menu items -->
            <!-- ... -->

        </ul>
    </aside><!-- End Sidebar -->
@endauth
