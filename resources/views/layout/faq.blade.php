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

        h1,
        h2,
        h3,
        h4,
        h5 {
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
        }

        .btn-primary {
            background: var(--primary);
            color: #000;
            border: none;
            box-shadow: 0 0 20px rgba(0, 224, 255, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(0, 224, 255, 0.5);
            background: #33eaff;
        }

        .btn-outline {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border);
            color: white;
            backdrop-filter: var(--glass);
        }

        .btn-outline:hover {
            border-color: var(--primary);
            background: rgba(0, 224, 255, 0.1);
        }

        /* Footer */
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
            .calc-container {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .steps-grid {
                flex-direction: column;
                gap: 60px;
            }

            .steps-grid::before {
                display: none;
            }

            .step-item {
                padding-top: 0;
                text-align: left;
            }

            .step-icon {
                position: static;
                transform: none;
                margin-bottom: 15px;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width: 890px) {
            .hero h1 {
                font-size: 2.8rem;
            }

            .nav-links,
            .nav-actions {
                display: none;
            }

            .menu-toggle {
                display: inline-flex;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .roadmap-heading {
                font-size: 2rem;
                margin-bottom: 50px;
            }

            .timeline-items {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .timeline-line {
                display: none;
            }
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

        .nav-links a:hover {
            color: var(--text-main);
        }

        .nav-links a.active {
            color: var(--primary);
        }

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
            background: rgba(0, 0, 0, 0.5);
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

        .mobile-actions a {
            display: flex;
            justify-content: center;
        }

        .faq-section-container {
            background: #0f0f15;
            padding: 120px 0 80px;
            min-height: 100vh;
        }

        .faq-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            color: #bfc7d5;
        }

        .faq-section h2 {
            text-align: center;
            font-size: 3.5rem;
            line-height: 1.1;
            letter-spacing: -0.03em;
            margin-bottom: 2.5rem;
            color: var(--text-main);
        }

        .faq-item {
            background: #0e1117;
            border: 1px solid #2a2f3a;
            border-radius: 12px;
            margin-bottom: 1rem;
            transition: background 0.3s ease;
            overflow: hidden;
        }

        .faq-header {
            width: 100%;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            background: transparent;
            border: none;
            color: #ffffff;
            font-size: 1.1rem;
            gap: 1rem;
            cursor: pointer;
            justify-content: space-between;
        }

        .faq-number {
            background: transparent;
            border: 1px solid #2a2f3a;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            font-weight: bold;
        }

        .faq-title {
            flex: 1;
            text-align: left;
            font-weight: 600;
        }

        .faq-icon {
            font-size: 1.5rem;
            transition: 0.3s ease;
        }

        .faq-content {
            max-height: 0;
            overflow: hidden;
            line-height: 1.6;
            padding: 0 25px;
            transition: max-height 0.4s ease;
            opacity: 0;
        }

        .faq-item.active {
            background: #1a2538;
        }

        .faq-item.active .faq-content {
            padding: 14px 25px 18px;
            max-height: 300px;
            opacity: 1;
        }

        .faq-item.active .faq-icon {
            transform: rotate(45deg);
        }

        @media(max-width: 890px) {

            .nav-links,
            .nav-actions {
                display: none;
            }

            .menu-toggle {
                display: inline-flex;
            }

            .faq-section {
                width: 95%;
            }

            .faq-section h2 {
                font-size: 2.8rem;
            }
        }

        /* ============================================
           COMPREHENSIVE RESPONSIVE MEDIA QUERIES
           ============================================ */

        /* Large Tablets and Small Desktops (1024px and below) */
        @media (max-width: 1024px) {
            .container {
                padding: 0 20px;
            }

            .faq-section-container {
                padding: 110px 0 70px;
            }

            .faq-section {
                padding: 0 20px;
            }

            .faq-section h2 {
                font-size: 3rem;
                margin-bottom: 2rem;
            }

            .faq-item {
                margin-bottom: 0.875rem;
            }

            .faq-header {
                padding: 16px 20px;
                font-size: 1.05rem;
            }

            .faq-content {
                padding: 0 20px;
            }

            .faq-item.active .faq-content {
                padding: 12px 20px 16px;
                max-height: 350px;
            }

            footer {
                padding: 60px 0 35px;
            }

            .footer-grid {
                gap: 30px;
                margin-bottom: 40px;
            }
        }

        /* Tablets (768px and below) */
        @media (max-width: 768px) {
            .container {
                padding: 0 16px;
            }

            header {
                padding: 15px 0;
            }

            .logo {
                font-size: 1.6rem;
            }

            .logo img {
                height: 36px;
            }

            .faq-section-container {
                padding: 100px 0 60px;
                min-height: auto;
            }

            .faq-section {
                padding: 0 16px;
                width: 100%;
            }

            .faq-section h2 {
                font-size: 2.5rem;
                margin-bottom: 2rem;
                line-height: 1.2;
            }

            .faq-item {
                margin-bottom: 0.75rem;
                border-radius: 10px;
            }

            .faq-header {
                padding: 15px 18px;
                font-size: 1rem;
                gap: 0.875rem;
            }

            .faq-number {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
            }

            .faq-title {
                font-size: 0.95rem;
            }

            .faq-icon {
                font-size: 1.3rem;
            }

            .faq-content {
                padding: 0 18px;
                font-size: 0.95rem;
            }

            .faq-item.active .faq-content {
                padding: 12px 18px 16px;
                max-height: 400px;
            }

            footer {
                padding: 50px 0 30px;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 30px;
                margin-bottom: 35px;
            }

            .social-links {
                gap: 15px;
                margin-top: 18px;
            }

            .footer-bottom {
                padding-top: 25px;
                font-size: 0.85rem;
            }
        }

        /* Mobile Devices (480px and below) */
        @media (max-width: 480px) {
            .container {
                padding: 0 12px;
            }

            header {
                padding: 12px 0;
            }

            .logo {
                font-size: 1.5rem;
            }

            .logo img {
                height: 32px;
            }

            .faq-section-container {
                padding: 90px 0 50px;
            }

            .faq-section {
                padding: 0 12px;
            }

            .faq-section h2 {
                font-size: 2rem;
                margin-bottom: 1.5rem;
                line-height: 1.2;
            }

            .faq-item {
                margin-bottom: 0.625rem;
                border-radius: 10px;
            }

            .faq-header {
                padding: 14px 16px;
                font-size: 0.9rem;
                gap: 0.75rem;
            }

            .faq-number {
                width: 28px;
                height: 28px;
                font-size: 0.85rem;
                border-radius: 5px;
            }

            .faq-title {
                font-size: 0.85rem;
            }

            .faq-icon {
                font-size: 1.2rem;
            }

            .faq-content {
                padding: 0 16px;
                font-size: 0.85rem;
                line-height: 1.5;
            }

            .faq-item.active .faq-content {
                padding: 12px 16px 14px;
                max-height: 500px;
            }

            footer {
                padding: 40px 0 25px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 25px;
                margin-bottom: 30px;
            }

            .footer-logo {
                font-size: 1.5rem;
                margin-bottom: 12px;
            }

            .footer-logo img {
                height: 32px;
            }

            .footer-column h4 {
                font-size: 0.95rem;
                margin-bottom: 15px;
            }

            .footer-column ul li {
                margin-bottom: 8px;
            }

            .footer-column ul li a {
                font-size: 0.85rem;
            }

            .social-links {
                gap: 12px;
                margin-top: 15px;
            }

            .social-links a {
                font-size: 1rem;
            }

            .footer-bottom {
                font-size: 0.8rem;
                padding-top: 20px;
            }
        }

        /* Small Mobile Devices (375px and below) */
        @media (max-width: 375px) {
            .faq-section h2 {
                font-size: 1.75rem;
            }

            .faq-header {
                padding: 12px 14px;
                font-size: 0.85rem;
                gap: 0.625rem;
            }

            .faq-number {
                width: 24px;
                height: 24px;
                font-size: 0.75rem;
            }

            .faq-title {
                font-size: 0.8rem;
            }

            .faq-icon {
                font-size: 1.1rem;
            }

            .faq-content {
                padding: 0 14px;
                font-size: 0.8rem;
            }

            .faq-item.active .faq-content {
                padding: 10px 14px 12px;
                max-height: 600px;
            }
        }

        /* Landscape Orientation for Mobile */
        @media (max-width: 768px) and (orientation: landscape) {
            .faq-section-container {
                padding: 80px 0 50px;
            }

            .faq-section h2 {
                font-size: 2rem;
            }

            .faq-item.active .faq-content {
                max-height: 300px;
            }
        }

        /* Print Styles */
        @media print {
            .menu-toggle,
            .mobile-nav {
                display: none;
            }

            .faq-section-container {
                padding: 20px 0;
                min-height: auto;
                background: transparent;
            }

            .faq-section h2 {
                font-size: 1.5rem;
            }

            .faq-item {
                break-inside: avoid;
                page-break-inside: avoid;
                margin-bottom: 1rem;
            }

            .faq-item.active .faq-content {
                max-height: none;
                opacity: 1;
            }
        }
    </style>
@endsection

@section('content')
    <div class="faq-section-container">
        <section class="faq-section">
            <h2>Frequently Asked <span class="text-gradient">Questions</span></h2>

            <div class="faq-item active">
                <button class="faq-header">
                    <span class="faq-number">1</span>
                    <span class="faq-title">Why is Vcoins the best for crypto traders?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-content">
                    <p>
                         Vcoins stands out for crypto traders with its low fees, fast transaction speeds, and support for 350+ coins including Bitcoin, Ethereum, and Tether.
                    </p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-header">
                    <span class="faq-number">2</span>
                    <span class="faq-title">What products does Vcoins provide?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-content">
                    <p>Vcoins provides a crypto basket product that allows users to invest in a diversified selection of digital assets effortlessly.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-header">
                    <span class="faq-number">3</span>
                    <span class="faq-title">How can I start investing in Vcoins’ crypto baskets?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-content">
                    <p>You can buy a crypto basket by creating an account on Vcoins, completing verification, adding funds to your wallet, and selecting the basket you want to invest in. Once you confirm the purchase, your basket will be added to your portfolio instantly.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-header">
                    <span class="faq-number">4</span>
                    <span class="faq-title">How to track cryptocurrency prices?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-content">
                    <p>You can easily monitor real-time market movements using our live market dashboard. Vcoins provides instant price updates, market trends, volume changes, and other key metrics so you can stay informed and make smarter trading decisions at any moment.</p>
                </div>
            </div>

            {{-- <div class="faq-item">
                <button class="faq-header">
                    <span class="faq-number">5</span>
                    <span class="faq-title">How to trade cryptocurrencies?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-content">
                    <p>Spot trading, Margin, Futures & Copy trading available...</p>
                </div>
            </div> --}}

            <div class="faq-item">
                <button class="faq-header">
                    <span class="faq-number">5</span>
                    <span class="faq-title">How to earn from crypto baskets?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-content">
                    <p>diversify your portfolio instantly with curated baskets designed around themes, performance, and risk levels. This reduces volatility and increases long-term earning potential.</p>
                </div>
            </div>

        </section>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.faq-item').forEach(item => {
                const header = item.querySelector('.faq-header');
                if (header) {
                    header.addEventListener('click', () => {
                        const openItem = document.querySelector('.faq-item.active');
                        if (openItem && openItem !== item) {
                            openItem.classList.remove('active');
                        }
                        item.classList.toggle('active');
                    });
                }
            });
        });
    </script>
@endsection
