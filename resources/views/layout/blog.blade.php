@extends('layout.home-layout')

@section('styles')
    <style>
        :root {
            --bg-dark: #050505;
            --bg-card: rgba(20, 20, 30, 0.6);
            --bg-card-hover: rgba(30, 30, 45, 0.8);
            --primary: #00E0FF;
            --accent: #9D00FF;
            --success: #00FFA3;
            --text-main: #ffffff;
            --text-muted: #8F9BB3;
            --border: rgba(255, 255, 255, 0.08);
            --glass: blur(12px) saturate(180%);
            --gradient-text: linear-gradient(135deg, #00E0FF 0%, #9D00FF 100%);
            --gradient-bg: linear-gradient(135deg, rgba(0, 224, 255, 0.1) 0%, rgba(157, 0, 255, 0.1) 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            overflow-x: hidden;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(157, 0, 255, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(0, 224, 255, 0.1) 0%, transparent 40%);
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Space Grotesk', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .text-gradient {
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn {
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 1rem;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: #000;
            box-shadow: 0 0 20px rgba(0, 224, 255, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(0, 224, 255, 0.5);
            background: #33eaff;
        }

        .btn-outline {
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border);
            color: white;
            backdrop-filter: var(--glass);
        }

        .btn-outline:hover {
            border-color: var(--primary);
            background: rgba(0, 224, 255, 0.1);
        }

        header {
            padding: 20px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            background: rgba(5, 5, 5, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: -0.05em;
            text-decoration: none;
        }

        .logo img {
            height: 40px;
            width: auto;
            display: block;
            object-fit: contain;
        }
        
        .logo span {
            color: var(--primary);
        }

        .nav-links {
            display: flex;
            gap: 40px;
        }

        .nav-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
            font-size: 0.95rem;
        }

        .nav-links a:hover { color: var(--text-main); }
        .nav-links a.active { color: var(--primary); }

        .nav-actions {
            display: flex;
            gap: 10px;
        }

        .menu-toggle {
            display: none;
            width: 40px;
            height: 40px;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
        }

        .menu-toggle span {
            display: block;
            width: 18px;
            height: 2px;
            background: var(--text-main);
            border-radius: 999px;
        }

        .mobile-nav {
            position: fixed;
            top: 80px;
            right: 0;
            bottom: 0;
            left: 0;
            background: var(--bg-dark);
            z-index: 900;
            pointer-events: none;
            opacity: 0;
            transform: translateX(100%);
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .mobile-nav.open {
            pointer-events: auto;
            opacity: 1;
            transform: translateX(0);
        }

        .mobile-nav-inner {
            max-width: 100%;
            margin-left: auto;
            padding: 18px 24px 24px;
            border-radius: 0;
            background: var(--bg-dark);
            border-left: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .mobile-menu {
            display: flex;
            flex-direction: column;
            gap: 16px;
            align-items: flex-start;
        }

        .mobile-menu a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 1rem;
        }

        .mobile-menu a.active {
            color: var(--primary);
        }

        .mobile-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .mobile-actions a{
            display: flex;
            justify-content: center;
        }

        .blog-hero {
            padding: 160px 0 40px;
        }

        .blog-hero-inner {
            display: flex;
            flex-direction: column;
            gap: 16px;
            max-width: 720px;
        }

        .blog-hero-title {
            font-size: 3.5rem;
            line-height: 1.1;
            letter-spacing: -0.03em;
        }

        .blog-hero-desc {
            font-size: 1.1rem;
            color: var(--text-muted);
            line-height: 1.7;
        }

        .blog-section {
            padding: 10px 0 100px;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
        }

        .blog-card {
            background: var(--bg-card);
            border-radius: 24px;
            border: 1px solid var(--border);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            backdrop-filter: var(--glass);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .blog-card:hover {
            transform: translateY(-6px);
            border-color: var(--primary);
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.6);
        }

        .blog-image {
            height: 190px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .blog-tag {
            position: absolute;
            left: 16px;
            top: 16px;
            padding: 6px 14px;
            border-radius: 999px;
            background: rgba(0,0,0,0.6);
            border: 1px solid rgba(255,255,255,0.12);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-main);
        }

        .blog-content {
            padding: 22px 22px 24px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            flex: 1;
        }

        .blog-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .blog-meta span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .blog-title {
            font-size: 1.25rem;
            line-height: 1.3;
        }

        .blog-excerpt {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .blog-footer {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: var(--text-muted);
            padding-top: 8px;
        }

        .read-more {
            color: var(--primary);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .read-more i {
            font-size: 0.8rem;
        }

        footer {
            padding: 80px 0 40px;
            border-top: 1px solid var(--border);
            background: #020205;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 2fr;
            gap: 40px;
            margin-bottom: 50px;
        }
        
        .footer-logo {
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: -0.05em;
            color: var(--text-main);
            margin-bottom: 15px;
            text-decoration: none;
            width: fit-content;
        }
        
        .footer-logo img {
            height: 40px;
            width: auto;
            display: block;
            object-fit: contain;
        }
        
        .footer-logo span {
            color: var(--primary);
        }
        
        .footer-column h4 {
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 20px;
        }
        
        .footer-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-column ul li {
            margin-bottom: 10px;
        }
        
        .footer-column ul li a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.3s;
            font-size: 0.95rem;
        }
        
        .footer-column ul li a:hover {
            color: var(--text-main);
        }
        
        .social-links {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }
        
        .social-links a {
            color: var(--text-muted);
            font-size: 1.2rem;
            transition: color 0.3s;
        }
        
        .social-links a:hover {
            color: var(--primary);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid var(--border);
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        @media(max-width: 992px) {
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .blog-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media(max-width: 890px) {
            .nav-links,
            .nav-actions { display: none; }
            .menu-toggle { display: inline-flex; }
            .footer-grid { grid-template-columns: 1fr; }
            .blog-grid { grid-template-columns: 1fr; }
            .blog-hero-title { font-size: 2.6rem; }
        }
    </style>
@endsection

@section('content')
    <section class="blog-hero">
        <div class="container">
            <div class="blog-hero-inner">
                <h1 class="blog-hero-title">Vcoins <span class="text-gradient">Blog</span></h1>
                <p class="blog-hero-desc">
                    Insights, updates, and deep dives from the Vcoins team. Stay ahead of the curve with the latest
                    in DeFi, yield strategies, and the future of intelligent crypto wealth.
                </p>
            </div>
        </div>
    </section>

    <section class="blog-section">
        <div class="container">
            <div class="blog-grid">
                <article class="blog-card">
                    <div class="blog-image" style="background-image: url('{{ asset('images/blog_img_1.jpg') }}');">
                        <span class="blog-tag">DeFi Basics</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="fa-regular fa-calendar"></i> 2025-01-20</span>
                            <span><i class="fa-regular fa-clock"></i> 5 min read</span>
                        </div>
                        <h3 class="blog-title">Getting Started with Intelligent Yield on Vcoins</h3>
                        <p class="blog-excerpt">
                            Learn how Vcoins bundles complex DeFi strategies into simple Smart Baskets, so you can
                            start earning yield in just a few clicks without becoming a Solidity expert.
                        </p>
                        <div class="blog-footer">
                            <span>By Vcoins Research</span>
                            <a href="#" class="read-more">Read more <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </article>

                <article class="blog-card">
                    <div class="blog-image" style="background-image: url('{{ asset('images/blog_img_2.jpg') }}');">
                        <span class="blog-tag">Yield Strategies</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="fa-regular fa-calendar"></i> 2025-01-12</span>
                            <span><i class="fa-regular fa-clock"></i> 7 min read</span>
                        </div>
                        <h3 class="blog-title">How Auto-Compounding Maximizes Your Crypto Returns</h3>
                        <p class="blog-excerpt">
                            Discover how daily auto-compounding, dynamic rebalancing, and gas-optimized harvesting
                            work together on Vcoins to squeeze more performance out of every market cycle.
                        </p>
                        <div class="blog-footer">
                            <span>By Vcoins Labs</span>
                            <a href="#" class="read-more">Read more <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </article>

                <article class="blog-card">
                <div class="blog-image" style="background-image: url('{{ asset('images/blog_img_3.jpg') }}');">
                        <span class="blog-tag">Security</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="fa-regular fa-calendar"></i> 2025-01-05</span>
                            <span><i class="fa-regular fa-clock"></i> 6 min read</span>
                        </div>
                        <h3 class="blog-title">Inside Vcoins: Our Security Framework for DeFi Yield</h3>
                        <p class="blog-excerpt">
                            A closer look at how audits, risk scoring, insurance coverage, and real-time monitoring
                            come together to safeguard user funds across multiple protocols and chains.
                        </p>
                        <div class="blog-footer">
                            <span>By Vcoins Security</span>
                            <a href="#" class="read-more">Read more <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
