<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Minimarket') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>

    </style>
</head>

<body style="overflow-x: hidden;">
    <div id="app">

        <main class="py-4">
            <div class="sidebar">
                <h4>
                    MyMinimarket
                </h4>
                <div class="column" style="margin-top: 20px; ">
                    <div class="col-12">
                        <a href="{{ route('home') }}" wire:navigate
                            class="btn-menu btn {{ request()->routeIs('home') ? 'active' : '' }}">
                            <img src="{{ asset(request()->routeIs('home') ? 'icons/Home.png' : 'icons/Home2.png') }}"
                                style="width: 16.8px; height: auto;" alt="Home">Beranda</a>

                        @if(Auth::user()->peran == 'admin')
                        <a href="{{ route('user') }}" wire:navigate
                            class="btn-menu btn {{ request()->routeIs('user') ? 'active' : '' }}">
                            <img src="{{ asset(request()->routeIs('user') ? 'icons/User.png' : 'icons/User2.png') }}"
                                style="width: 13px; height: auto;" alt="User">Pengguna</a>
                        @endif

                        
                        <a href="{{ route('produk') }}" wire:navigate
                            class="btn-menu btn {{ request()->routeIs('produk') ? 'active' : '' }}">
                            <img src="{{ asset(request()->routeIs('produk') ? 'icons/Produk.png' : 'icons/Produk2.png') }}"
                                alt="Produk">Produk</a>
                    

                        <a href="{{ route('transaksi') }}" wire:navigate
                            class="btn-menu btn {{ request()->routeIs('transaksi') ? 'active' : '' }}">
                            <img src="{{ asset(request()->routeIs('transaksi') ? 'icons/Transaksi.png' : 'icons/Transaksi2.png') }}"
                                style="width: 17px; height: auto;" alt="Transaksi">Transaksi</a>

                        <a href="{{ route('laporan') }}" wire:navigate
                            class="btn-menu btn {{ request()->routeIs('laporan') ? 'active' : '' }}">
                            <img src="{{ asset(request()->routeIs('laporan') ? 'icons/Laporan.png' : 'icons/Laporan2.png') }}"
                                style="width: 16px; height: auto;" alt="Laporan">Laporan</a>
                    </div>
                </div>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li style="margin-top: 300px; ">
                            <a class="btn-menu btn" href="#" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ asset(request()->routeIs('admin') ? 'icons/User.png' : 'icons/User2.png') }}"
                                    style="width: 13px; height: auto;" alt="admin">
                                {{ Auth::user()->name }}
                            </a>
                            
                            <a class="btn-menu btn" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <img src="{{ asset(request()->routeIs('keluar') ? 'icons/Logout.png' : 'icons/Logout.png') }}"
                                    style="width: 16px; height: auto;" alt="Laporan">
                                {{ __('Keluar') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
