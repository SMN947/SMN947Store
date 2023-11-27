<div class="navbar bg-base-200">
    <div class="flex-1">
        <a class="btn btn-ghost text-xl" href="{{ url('/') }}">
            <img src="{{ asset('/images/logo.svg') }}" alt="" width="30" height="30" class="d-inline-block align-text-top">
            {{ config('app.name') }} - {{tenant('path')}}
        </a>
    </div>

    <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
            @if (Route::has('login'))
            @auth
            <li class="nav-item">
                <a href="{{ url(tenant('path').'/dashboard') }}" class="nav-link {{ Request::path() == 'dashboard' ? 'active' : '' }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="{{ url(tenant('path').'/pos') }}" class="nav-link {{ Request::path() == 'pos' ? 'active' : '' }}">Venta</a>
            </li>
            <li class="nav-item">
                <a href="{{ url(tenant('path').'/products') }}" class="nav-link {{ Request::path() == 'products' ? 'active' : '' }}">Productos</a>
            </li>
            <li class="nav-item">
                <a href="{{ url(tenant('path').'/categories') }}" class="nav-link {{ Request::path() == 'categories' ? 'active' : '' }}">Categorias</a>
            </li>
            <li>
                <div class="form-control p-0 m-0">
                    <select class="select select-bordered" id="theme" x-model="theme" x-on:change="document.documentElement.setAttribute('data-theme', theme)">
                        <option value="dracula">Dracula</option>
                        <option value="light">Light</option>
                        <option value="dark">Dark</option>
                        <option value="cupcake">Cupcake</option>
                        <option value="black">Black</option>
                        <option value="cyberpunk">Cyberpunk</option>
                        <option value="retro">Retro</option>
                    </select>
                </div>
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