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


{{-- <header class="main-header">
    <nav class="nav-container">
        <a href="#" class="logo">
            <img src="{{ asset('/images/logo.svg') }}" alt="Vcoins">
            <p>Vcoins</p>
        </a>
        <div class="header-left">
            <ul class="nav-menu">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Press</a></li>
                <li><a href="#">Blog</a></li>
            </ul>
        </div>

        <div class="header-right">
            @if (auth()->check())
                <a href="{{ route('platform.baskets') }}" class="login-btn">Dashboard</a>

                <form method="POST" action="{{ route('platform.logout') }}">
                    @csrf
                    <button type="submit" id="logout_btn"
                        style="background: #F0B90B;
                        color: #000;
                        padding: 8px 20px;
                        border-radius: 6px;
                        font-weight: 600;
                        text-decoration: none;">
                        Sign out</button>
                </form>
            @else
                <a href="{{ route('platform.login') }}" class="login-btn">Log In</a>
                <a href="{{ route('platform.register') }}" class="signup-btn">Sign Up</a>
            @endif

        </div>

        <button class="menu-toggle" aria-label="Open menu">
            <i class="fa-solid fa-list"></i>
        </button>
    </nav>

    <div class="mobile-nav" id="mobileNav">
        <div class="mobile-nav-inner">
            <ul class="mobile-nav-menu">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Press</a></li>
                <li><a href="#">Blog</a></li>
            </ul>
            <div class="mobile-nav-actions">
                @if (auth()->check())
                    <a href="{{ route('platform.baskets') }}" class="signup-btn">Dashboard</a>

                    <form method="POST" action="{{ route('platform.logout') }}">
                        @csrf
                        <button type="submit" id="logout_btn"
                            style="background: #F0B90B;
                        color: #000;
                        padding: 8px 20px;
                        border-radius: 6px;
                        font-weight: 600;
                        text-decoration: none;">
                            Sign out</button>
                    </form>
                @else
                    <a href="{{ route('platform.login') }}" class="login-btn">Log In</a>
                    <a href="{{ route('platform.register') }}" class="signup-btn">Sign Up</a>
                @endif
            </div>
        </div>
    </div>
</header> --}}

<header>
    <div class="container">
        <nav>
            <div class="logo">
                <img src="{{ asset('images/logo.svg') }}" alt="Vcoins">
                <span>Vcoins</span>
            </div>
            <div class="nav-links">
                <a href="#home" class="active">Home</a>
                <a href="#about">About</a>
                <a href="#crypto-prices">Markets</a>
                <a href="#contact">Contact Us</a>
                <a href="#faq">FAQ</a>
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
                <a href="#home" class="active">Home</a>
                <a href="#about">About</a>
                <a href="#market">Markets</a>
                <a href="#contact">Contact Us</a>
                <a href="#faq">FAQ</a>
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
