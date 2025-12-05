{{-- <header>
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
    </nav>
</header> --}}
{{-- <a href="#" class="cta-button">Sign in</a>
<a href="#" class="cta-button">Sign up</a> --}}


<header>
    <div class="container">
        <nav>
             <a class="logo" href="{{ route('platform.index') }}">
                    <img src="{{ asset('images/logo.svg') }}" alt="Vcoins">
                    <span>Vcoins</span>
                </a>
            <div class="nav-links">
                <a href="{{route('platform.index')}}">Home</a>
                <a href="{{route('platform.about')}}">About</a>
                <a href="{{route('platform.markets')}}">Markets</a>
                <a href="{{route('platform.contact')}}">Contact Us</a>
                <a href="{{route('platform.faq')}}">FAQ</a>
            </div>
            <div class="nav-actions">
                @if (auth()->check())
                    <div class="nav-links">
                        <a href="{{ route('platform.baskets') }}">Dashboard</a>
                    </div>
                    <form method="POST" action="{{ route('platform.logout') }}">
                        @csrf
                        <button type="submit" id="logout_btn"
                            style="
                        color: #000;
                        padding: 8px 20px;
                        border-radius: 6px;
                        font-weight: 600;
                        text-decoration: none;" class="btn-primary">
                            Sign out</button>
                    </form>
                @else
                    <a href="{{ route('platform.login') }}" class="btn btn-outline">Log In</a>
                    <a href="{{ route('platform.register') }}" class="btn btn-primary">Sign Up</a>
                @endif
            </div>
            <button class="menu-toggle" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>
    </div>
    <div class="mobile-nav" id="mobileNav">
        <div class="mobile-nav-inner">

            <nav class="mobile-menu">
                <a href="{{route('platform.index')}}">Home</a>
                <a href="{{route('platform.about')}}">About</a>
                <a href="{{route('platform.markets')}}">Markets</a>
                <a href="{{route('platform.contact')}}">Contact Us</a>
                <a href="{{route('platform.faq')}}">FAQ</a>
            </nav>
            <div class="mobile-actions">
                @if (auth()->check())
                    <nav class="mobile-menu">
                        <a href="{{ route('platform.baskets') }}">Dashboard</a>
                    </nav>
                    <form method="POST" action="{{ route('platform.logout') }}">
                        @csrf
                        <button type="submit" id="logout_btn"
                            style="
                        color: #000;
                        padding: 8px 20px;
                        border-radius: 6px;
                        font-weight: 600;
                        text-decoration: none;" class="btn-primary">
                            Sign out</button>
                    </form>
                @else
                    <a href="{{ route('platform.login') }}" class="btn btn-outline">Log In</a>
                    <a href="{{ route('platform.register') }}" class="btn btn-primary">Sign Up</a>
                @endif
            </div>
        </div>
    </div>
</header>
