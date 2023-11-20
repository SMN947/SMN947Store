<div class="navbar bg-base-200">
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
            <li class="nav-item">
                <a href="#">Hola {{ Auth::user()->name }}!</a>
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