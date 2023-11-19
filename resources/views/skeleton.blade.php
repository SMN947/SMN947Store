<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>{{ config('app.name') }}</title>
</head>

<body>




    <div class="navbar bg-base-100">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl" href="{{ url('/') }}">
                <img src="{{ asset('/images/logo.svg') }}" alt="" width="30" height="30" class="d-inline-block align-text-top">
                {{ config('app.name') }}
            </a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                @if (Route::has('login'))
                @auth
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link {{ Request::path() == 'dashboard' ? 'active' : '' }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/pos') }}" class="nav-link {{ Request::path() == 'pos' ? 'active' : '' }}">Venta</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/products') }}" class="nav-link {{ Request::path() == 'products' ? 'active' : '' }}">Productos</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/categories') }}" class="nav-link {{ Request::path() == 'categories' ? 'active' : '' }}">Categorias</a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link {{ Request::path() == 'login' ? 'active' : '' }}">Log in</a>
                </li>

                @if (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link {{ Request::path() == 'register' ? 'active' : '' }}">Register</a>
                </li>
                @endif
                @endauth
                @endif
            </ul>
        </div>
    </div>




    @if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul class="list-unstyled mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @yield('content')
    <nav class="navbar fixed-bottom bg-light">
        <div class="container-fluid justify-content-md-center">
            <span>SMN947 - dev.1.0</span>
        </div>
    </nav>
</body>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
@yield('scripts')

</html>