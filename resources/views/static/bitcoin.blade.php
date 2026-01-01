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

        .terms-hero {
            padding: 150px 0 30px;
            text-align: center;
        }

        .terms-hero h1 {
            font-size: 4.5rem;
            line-height: 1.1;
            margin-bottom: 1rem;
            letter-spacing: -0.03em;
        }

        .terms-hero p {
            font-size: 1.1rem;
            color: var(--text-muted);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .terms-hero .last-updated {
            margin-top: 20px;
            font-size: 0.95rem;
            color: var(--text-muted);
        }

        .terms-content {
            padding: 60px 0 100px;
            max-width: 900px;
            margin: 0 auto;
        }

        .terms-section {
            margin-bottom: 50px;
        }

        .terms-section h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: var(--primary);
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }

        .terms-section h3 {
            font-size: 1.4rem;
            margin-top: 30px;
            margin-bottom: 15px;
            color: var(--text-main);
        }

        .terms-section p {
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .terms-section ul,
        .terms-section ol {
            margin-left: 30px;
            margin-bottom: 20px;
            color: var(--text-muted);
        }

        .terms-section li {
            margin-bottom: 12px;
            line-height: 1.8;
        }

        .terms-section strong {
            color: var(--text-main);
            font-weight: 600;
        }

        .terms-section a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.3s;
        }

        .terms-section a:hover {
            color: var(--accent);
            text-decoration: underline;
        }

        .highlight-box {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-left: 3px solid var(--primary);
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
            backdrop-filter: var(--glass);
        }

        .highlight-box p {
            margin-bottom: 0;
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
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width: 890px) {

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

            .terms-hero h1 {
                font-size: 2.8rem;
            }

            .terms-section h2 {
                font-size: 1.6rem;
            }

            .terms-section h3 {
                font-size: 1.2rem;
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

            .terms-hero {
                padding: 140px 0 25px;
            }

            .terms-hero h1 {
                font-size: 3.5rem;
            }

            .terms-hero p {
                font-size: 1.05rem;
            }

            .terms-hero .last-updated {
                font-size: 0.9rem;
                margin-top: 18px;
            }

            .terms-content {
                padding: 50px 0 80px;
            }

            .terms-section {
                margin-bottom: 45px;
            }

            .terms-section h2 {
                font-size: 1.85rem;
                margin-bottom: 18px;
                padding-bottom: 12px;
            }

            .terms-section h3 {
                font-size: 1.3rem;
                margin-top: 25px;
                margin-bottom: 12px;
            }

            .terms-section p {
                font-size: 0.95rem;
                margin-bottom: 12px;
            }

            .terms-section ul,
            .terms-section ol {
                margin-left: 25px;
                margin-bottom: 18px;
            }

            .terms-section li {
                margin-bottom: 10px;
            }

            .highlight-box {
                padding: 18px;
                margin: 22px 0;
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

            .terms-hero {
                padding: 130px 0 20px;
            }

            .terms-hero h1 {
                font-size: 2.5rem;
                line-height: 1.2;
                margin-bottom: 0.875rem;
            }

            .terms-hero p {
                font-size: 1rem;
            }

            .terms-hero .last-updated {
                font-size: 0.85rem;
                margin-top: 15px;
            }

            .terms-content {
                padding: 40px 0 60px;
            }

            .terms-section {
                margin-bottom: 40px;
            }

            .terms-section h2 {
                font-size: 1.6rem;
                margin-bottom: 15px;
                padding-bottom: 10px;
            }

            .terms-section h3 {
                font-size: 1.2rem;
                margin-top: 22px;
                margin-bottom: 10px;
            }

            .terms-section p {
                font-size: 0.95rem;
                line-height: 1.7;
                margin-bottom: 12px;
            }

            .terms-section ul,
            .terms-section ol {
                margin-left: 22px;
                margin-bottom: 16px;
            }

            .terms-section li {
                margin-bottom: 8px;
                line-height: 1.7;
            }

            .highlight-box {
                padding: 16px;
                margin: 20px 0;
                border-radius: 10px;
            }

            .highlight-box p {
                font-size: 0.95rem;
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

            .terms-hero {
                padding: 110px 0 15px;
            }

            .terms-hero h1 {
                font-size: 2rem;
                margin-bottom: 0.75rem;
            }

            .terms-hero p {
                font-size: 0.95rem;
            }

            .terms-hero .last-updated {
                font-size: 0.8rem;
                margin-top: 12px;
            }

            .terms-content {
                padding: 35px 0 50px;
            }

            .terms-section {
                margin-bottom: 35px;
            }

            .terms-section h2 {
                font-size: 1.4rem;
                margin-bottom: 12px;
                padding-bottom: 8px;
            }

            .terms-section h3 {
                font-size: 1.1rem;
                margin-top: 20px;
                margin-bottom: 8px;
            }

            .terms-section p {
                font-size: 0.9rem;
                line-height: 1.7;
                margin-bottom: 10px;
            }

            .terms-section ul,
            .terms-section ol {
                margin-left: 20px;
                margin-bottom: 14px;
            }

            .terms-section li {
                margin-bottom: 8px;
                line-height: 1.7;
                font-size: 0.9rem;
            }

            .terms-section strong {
                font-size: 0.95rem;
            }

            .highlight-box {
                padding: 14px;
                margin: 18px 0;
                border-radius: 10px;
            }

            .highlight-box p {
                font-size: 0.9rem;
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
            .terms-hero h1 {
                font-size: 1.75rem;
            }

            .terms-hero p {
                font-size: 0.9rem;
            }

            .terms-hero .last-updated {
                font-size: 0.75rem;
            }

            .terms-section h2 {
                font-size: 1.25rem;
            }

            .terms-section h3 {
                font-size: 1rem;
            }

            .terms-section p {
                font-size: 0.85rem;
            }

            .terms-section ul,
            .terms-section ol {
                margin-left: 18px;
            }

            .terms-section li {
                font-size: 0.85rem;
            }

            .highlight-box {
                padding: 12px;
            }

            .highlight-box p {
                font-size: 0.85rem;
            }
        }

        /* Landscape Orientation for Mobile */
        @media (max-width: 768px) and (orientation: landscape) {
            .terms-hero {
                padding: 100px 0 15px;
            }

            .terms-hero h1 {
                font-size: 2rem;
            }

            .terms-content {
                padding: 30px 0 50px;
            }
        }

        /* Print Styles */
        @media print {

            .menu-toggle,
            .mobile-nav {
                display: none;
            }

            .terms-hero {
                padding: 20px 0;
            }

            .terms-hero h1 {
                font-size: 1.5rem;
            }

            .terms-content {
                padding: 20px 0;
            }

            .terms-section {
                break-inside: avoid;
                page-break-inside: avoid;
                margin-bottom: 30px;
            }

            .highlight-box {
                break-inside: avoid;
                page-break-inside: avoid;
            }
        }
    </style>
@endsection

@section('content')
    <section class="terms-hero">
        <div class="container">
            <h1>Intro to <span class="text-gradient">Bitcoin</span></h1>
            {{-- <p>Please read these terms carefully before using our platform. By accessing or using Vcoins, you agree to be
                bound by these terms.</p> --}}
            <div class="last-updated">Last Updated: January 2025</div>
        </div>
    </section>
    <section class="terms-content">
        <div class="container">
            <div class="terms-section">
                <h2>Understanding Bitcoin</h2>
                <p>Bitcoin is a digital currency designed to enable peer-to-peer transactions over the internet without the
                    involvement of banks or central authorities. It exists entirely in digital form and is maintained by a
                    decentralized network of computers distributed globally.</p>
                    
                <p>Unlike traditional money, Bitcoin is not issued by a government or controlled by a single organization.
                </p>
            </div>

            <div class="terms-section">
                <h2>Purpose and Origin of Bitcoin</h2>
                <p>Bitcoin was introduced in 2009 to address limitations in traditional financial systems, including reliance on intermediaries, lack of transparency, and restricted access to financial services.</p>

                <p>Its primary objective is to provide an open, permissionless, and trust-minimized monetary system where users retain full control over their funds.</p>
            </div>

            <div class="terms-section">
                <h2>The Double-Spending Challenge</h2>
                <p>A major challenge with digital money is preventing the same unit from being spent multiple times. Bitcoin solves this through a publicly verifiable transaction ledger.</p>

                <p>Each transaction is validated by the network and recorded permanently, ensuring that no Bitcoin can be duplicated or reused fraudulently.</p>
            </div>

            <div class="terms-section">
                <h2>Introduction to Blockchain Technology</h2>
                <p>Bitcoin operates on a blockchain, which is a distributed ledger composed of sequential blocks. Each block contains verified transactions and is cryptographically linked to the previous one.</p>

                <ul>
                    <li>Data integrity</li>
                    <li>Transparency</li>
                    <li>Resistance to tampering</li>
                </ul>

                <p>The blockchain is maintained collectively by network participants rather than a central authority.</p>
            </div>

            <div class="terms-section">
                <h2>How Bitcoin Transactions Are Processed</h2>
                <p>When a user sends Bitcoin:</p>

                <ol>
                    <li>The transaction is broadcast to the network</li>
                    <li>Network participants validate its authenticity</li>
                    <li>The transaction is included in a block</li>
                    <li>The block is added to the blockchain</li>
                </ol>

                <p>Once confirmed, transactions are irreversible and permanently recorded.</p>
            </div>

            <div class="terms-section">
                <h2>Bitcoin Mining Explained</h2>
                <p>Mining is the process through which transactions are validated and blocks are added to the blockchain. Miners contribute computational power to secure the network and, in return, are rewarded with newly issued Bitcoin and transaction fees.</p>

                <p>Mining plays a critical role in maintaining decentralization and network security.</p>
            </div>

            <div class="terms-section">
                <h2>Mining plays a critical role in maintaining decentralization and network security.</h2>

                <p>Bitcoin derives its value from several key factors:</p>
                <ul>
                    <li>A fixed maximum supply of 21 million coins</li>
                    <li>Decentralized governance</li>
                    <li>Global accessibility</li>
                    <li>Strong cryptographic security</li>
                </ul>

                <p>These characteristics distinguish Bitcoin from traditional currencies and other digital assets.</p>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script></script>
@endsection
