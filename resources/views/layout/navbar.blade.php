<header>
    <nav class="container">
        <a href="#" class="logo">
            <img src="{{asset('/images/logo.svg')}}" alt="Vcoins logo" srcset="">
        </a>
        <ul class="nav-links">
            @if (auth()->check())
                <li><a href="{{ route('platform.baskets') }}">Dashboard</a></li>

                <form method="POST" action="{{ route('platform.logout') }}">
                    @csrf
                    <li><button type="submit" id="logout_btn"  style="background: none; color:white; border:none; cursor: pointer;">
                        Sign out</button></li>
                </form>
            @else
                <li><a href="{{ route('platform.login') }}">Sign in</a></li>
                <li><a href="{{ route('platform.register') }}">Sign up</a></li>
            @endif
        </ul>
        {{-- <a href="#" class="cta-button">Sign in</a>
        <a href="#" class="cta-button">Sign up</a> --}}
    </nav>
</header>
