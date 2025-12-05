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

        .support-hero {
            padding: 150px 0 20px;
            text-align: center;
        }

        .support-hero h1 {
            font-size: 4.5rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -0.03em;
        }

        .support-hero p {
            font-size: 1.25rem;
            color: var(--text-muted);
            max-width: 700px;
            margin: 0 auto 40px;
            line-height: 1.6;
        }

        .search-container {
            max-width: 700px;
            margin: 0 auto;
            position: relative;
        }

        .search-box {
            width: 100%;
            padding: 18px 60px 18px 24px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            color: var(--text-main);
            font-size: 1rem;
            backdrop-filter: var(--glass);
            transition: all 0.3s ease;
            outline: none;
        }

        .search-box:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 224, 255, 0.1);
        }

        .search-box::placeholder {
            color: var(--text-muted);
        }

        .search-icon {
            position: absolute;
            right: 24px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1.2rem;
        }

        .quick-links {
            padding: 60px 0;
        }

        .quick-links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .quick-link-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 30px;
            backdrop-filter: var(--glass);
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            color: var(--text-main);
        }

        .quick-link-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(0, 224, 255, 0.1);
        }

        .quick-link-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .quick-link-card h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .quick-link-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .faq-section {
            padding: 60px 0;
            background: #0f0f15;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-header h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .section-header p {
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        .faq-categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .faq-category {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 30px;
            backdrop-filter: var(--glass);
        }

        .faq-category h3 {
            font-size: 1.4rem;
            margin-bottom: 20px;
            color: var(--primary);
        }

        .faq-list {
            list-style: none;
            padding: 0;
        }

        .faq-item {
            margin-bottom: 15px;
        }

        .faq-item a {
            color: var(--text-muted);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .faq-item a:hover {
            color: var(--text-main);
            background: rgba(0, 224, 255, 0.05);
        }

        .faq-item i {
            font-size: 0.8rem;
            color: var(--primary);
        }

        .announcements {
            padding: 60px 0;
        }

        .announcement-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-left: 3px solid var(--primary);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            backdrop-filter: var(--glass);
            transition: all 0.3s ease;
        }

        .announcement-card:hover {
            border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(0, 224, 255, 0.1);
        }

        .announcement-date {
            color: var(--primary);
            font-size: 0.9rem;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .announcement-card h4 {
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .announcement-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .contact-support {
            padding: 60px 0;
            background: #0f0f15;
        }

        .contact-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .contact-option {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            backdrop-filter: var(--glass);
            transition: all 0.3s ease;
        }

        .contact-option:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(0, 224, 255, 0.1);
        }

        .contact-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient-bg);
            border: 1px solid var(--border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--primary);
            margin: 0 auto 20px;
        }

        .contact-option h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
        }

        .contact-option p {
            color: var(--text-muted);
            margin-bottom: 20px;
            line-height: 1.6;
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

            .quick-links-grid {
                grid-template-columns: 1fr;
            }

            .faq-categories {
                grid-template-columns: 1fr;
            }

            .contact-options {
                grid-template-columns: 1fr;
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

            .support-hero h1 {
                font-size: 2.8rem;
            }

            .section-header h2 {
                font-size: 2rem;
            }
        }
    </style>
@endsection

@section('content')
    <section class="support-hero">
        <div class="container">
            <h1>How can we <span class="text-gradient">help you?</span></h1>
            <p>Search our knowledge base or browse categories below to find answers to your questions.</p>
            <div class="search-container">
                <input type="text" class="search-box" placeholder="Search for help articles, FAQs, and guides...">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
            </div>
        </div>
    </section>

    <section class="quick-links">
        <div class="container">
            <div class="quick-links-grid">
                <a href="#getting-started" class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fa-solid fa-rocket"></i>
                    </div>
                    <h3>Getting Started</h3>
                    <p>New to Vcoins? Learn how to set up your account and start earning yield.</p>
                </a>

                <a href="#smart-baskets" class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <h3>Smart Baskets</h3>
                    <p>Understand how our automated yield farming strategies work.</p>
                </a>

                <a href="#security" class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3>Security & Safety</h3>
                    <p>Learn about our security measures and how to protect your account.</p>
                </a>

                <a href="#transactions" class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fa-solid fa-arrow-right-arrow-left"></i>
                    </div>
                    <h3>Transactions</h3>
                    <p>Get help with deposits, withdrawals, and transaction issues.</p>
                </a>

                <a href="#troubleshooting" class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fa-solid fa-wrench"></i>
                    </div>
                    <h3>Troubleshooting</h3>
                    <p>Common issues and solutions to resolve problems quickly.</p>
                </a>

                <a href="#account" class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    <h3>Account Settings</h3>
                    <p>Manage your account, update preferences, and verify your identity.</p>
                </a>
            </div>
        </div>
    </section>

    <section class="faq-section">
        <div class="container">
            <div class="section-header">
                <h2 class="text-gradient">Frequently Asked Questions</h2>
                <p>Browse our FAQ categories to find quick answers</p>
            </div>
            <div class="faq-categories">
                <div class="faq-category">
                    <h3>Account & Registration</h3>
                    <ul class="faq-list">
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> How do I create an
                                account?</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> How do I verify my
                                account?</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> I forgot my
                                password</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> How do I update my
                                email?</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> Account security
                                best practices</a></li>
                    </ul>
                </div>

                <div class="faq-category">
                    <h3>Smart Baskets</h3>
                    <ul class="faq-list">
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> What are Smart
                                Baskets?</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> How do I create a
                                Smart Basket?</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> How are yields
                                calculated?</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> What is
                                auto-compounding?</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> Can I withdraw
                                anytime?</a></li>
                    </ul>
                </div>

                <div class="faq-category">
                    <h3>Deposits & Withdrawals</h3>
                    <ul class="faq-list">
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> How do I deposit
                                funds?</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> How long do
                                withdrawals take?</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> What are the
                                fees?</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> Minimum deposit
                                amount</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> Supported
                                cryptocurrencies</a></li>
                    </ul>
                </div>

                <div class="faq-category">
                    <h3>Security</h3>
                    <ul class="faq-list">
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> How secure is
                                Vcoins?</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> Enable two-factor
                                authentication</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> What if I suspect
                                fraud?</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> Smart contract
                                audits</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> Insurance
                                coverage</a></li>
                    </ul>
                </div>

                <div class="faq-category">
                    <h3>Fees & Limits</h3>
                    <ul class="faq-list">
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> What fees does
                                Vcoins charge?</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> Gas fees
                                explained</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> Deposit and
                                withdrawal limits</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> Performance
                                fees</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> Fee structure
                                breakdown</a></li>
                    </ul>
                </div>

                <div class="faq-category">
                    <h3>Technical Support</h3>
                    <ul class="faq-list">
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> Transaction
                                stuck or pending</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> Connection
                                issues</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> Browser
                                compatibility</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> Mobile app
                                support</a></li>
                        <li class="faq-item"><a href="#"><i class="fa-solid fa-chevron-right"></i> API
                                documentation</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="announcements">
        <div class="container">
            <div class="section-header">
                <h2 class="text-gradient">Announcements & Updates</h2>
                <p>Stay informed about the latest platform updates and important notices</p>
            </div>
            <div class="announcement-card">
                <div class="announcement-date">January 15, 2025</div>
                <h4>New Multi-Chain Support Added</h4>
                <p>We've expanded our platform to support additional blockchain networks, giving you more yield
                    opportunities across multiple chains.</p>
            </div>
            <div class="announcement-card">
                <div class="announcement-date">January 10, 2025</div>
                <h4>Security Audit Completed</h4>
                <p>Our latest smart contract security audit has been completed successfully. All systems are secure and
                    operating normally.</p>
            </div>
            <div class="announcement-card">
                <div class="announcement-date">January 5, 2025</div>
                <h4>Enhanced Auto-Compounding Features</h4>
                <p>New auto-compounding strategies are now available with improved yield optimization algorithms for better
                    returns.</p>
            </div>
        </div>
    </section>

    <section class="contact-support">
        <div class="container">
            <div class="section-header">
                <h2 class="text-gradient">Still Need Help?</h2>
                <p>Get in touch with our support team through any of these channels</p>
            </div>
            <div class="contact-options">
                <div class="contact-option">
                    <div class="contact-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <h3>Email Support</h3>
                    <p>Send us an email and we'll respond within 24 hours</p>
                    <a href="mailto:support@vcoins.co.in" class="btn btn-outline">support@vcoins.co.in</a>
                </div>

                <div class="contact-option">
                    <div class="contact-icon">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h3>Live Chat</h3>
                    <p>Chat with our support team in real-time (Available 24/7)</p>
                    <a href="contact.html" class="btn btn-outline">Start Chat</a>
                </div>

                <div class="contact-option">
                    <div class="contact-icon">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <h3>Submit a Ticket</h3>
                    <p>Create a support ticket for detailed assistance</p>
                    <a href="contact.html" class="btn btn-primary">Submit Ticket</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
