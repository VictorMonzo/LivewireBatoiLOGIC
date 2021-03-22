<header class="shadow p-0 bg-dark">
    <nav class="container navbar navbar-expand-lg navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand d-none d-lg-block py-3" href="{{ route('dashboard') }}">
                <img src="{{ asset('/imgs/logo.png') }}" alt="Logo" width="35px" height="35px">
            </a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('product') }}">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('provider') }}">Proveedores</a>
                </li>

                @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('order') }}">Comandas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('user') }}">Usuarios</a>
                    </li>
                @endif
            </ul>

            @if(Auth::check())
                <a href="" class="text-light mx-4 text-white">{{ Auth::user()->name}}</a>
            @endif

            @if(!Auth::check())
                <a class="btn btn-success mr-3" href="{{ route('login') }}">Login</a>
                <a class="btn btn-primary" href="{{ route('user.create') }}">{{ __('Register') }}</a>
            @else

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger text-white" type="submit">Logout</button>
            </form>

        @endif

        </div>

        <a class="navbar-brand d-lg-none d-block logo-ph" href="{{ route('dashboard') }}">
            <img src="{{ asset('/imgs/logo.png') }}" alt="BatoiLogic logo" height="30px">
        </a>
    </nav>
</header>
