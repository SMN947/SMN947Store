<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <title>{{ config('app.name') }}</title>
</head>

<body>


    <nav class="navbar navbar-expand-lg bg-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('/images/logo.svg') }}" alt="" width="30" height="30"
                    class="d-inline-block align-text-top">
                {{ config('app.name') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}"
                                    class="nav-link {{ Request::path() == 'dashboard' ? 'active' : '' }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/pos') }}"
                                    class="nav-link {{ Request::path() == 'pos' ? 'active' : '' }}">Venta</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/products') }}"
                                    class="nav-link {{ Request::path() == 'products' ? 'active' : '' }}">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/categories') }}"
                                    class="nav-link {{ Request::path() == 'categories' ? 'active' : '' }}">Categorias</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}"
                                    class="nav-link {{ Request::path() == 'login' ? 'active' : '' }}">Log in</a>
                            </li>

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}"
                                        class="nav-link {{ Request::path() == 'register' ? 'active' : '' }}">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
                @auth
                    <form class="d-flex" method="POST" action="{{ route('logout') }}">
                        <!-- Authentication -->
                        @csrf
                        <a class="btn btn-outline-danger" type="submit" href="route('logout')"
                            onclick="event.preventDefault();
                                this.closest('form').submit();">Log
                            Out</a>
                    </form>
                @endauth
            </div>
        </div>
    </nav>
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <ul class="list-unstyled mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::get('success', false))
        <?php $data = Session::get('success'); ?>
        @if (is_array($data))
            @foreach ($data as $msg)
                <div class="alert alert-success" role="alert">
                    <i class="fa fa-check"></i>
                    {{ $msg }}
                </div>
            @endforeach
        @else
            <div class="alert alert-success" role="alert">
                <i class="fa fa-check"></i>
                {{ $data }}
            </div>
        @endif
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
