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

        .about-hero {
            padding: 145px 0 0px;
            text-align: center;
        }

        .about-hero h1 {
            font-size: 4.5rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -0.03em;
        }

        .about-hero p {
            font-size: 1.25rem;
            color: var(--text-muted);
            max-width: 800px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }

        .stats-section {
            padding: 80px 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            text-align: center;
        }

        .stat-item {
            background: var(--bg-card);
            border: 1px solid var(--border);
            padding: 40px 30px;
            border-radius: 20px;
            backdrop-filter: var(--glass);
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-value {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            line-height: 1.1;
        }

        .stat-label {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 1rem;
        }

        .content-section {
            padding: 40px 0;
        }

        .content-section-alt {
            background: #0f0f15;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header h2 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .section-header p {
            font-size: 1.1rem;
            color: var(--text-muted);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .mission-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 60px;
        }

        .mission-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px;
            backdrop-filter: var(--glass);
            transition: all 0.3s ease;
        }

        .mission-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(0, 224, 255, 0.1);
        }

        .mission-card-icon {
            width: 60px;
            height: 60px;
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

        .mission-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .mission-card p {
            color: var(--text-muted);
            line-height: 1.6;
        }

        .ecosystem-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 60px;
        }

        .ecosystem-item {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 30px;
            backdrop-filter: var(--glass);
            transition: all 0.3s ease;
        }

        .ecosystem-item:hover {
            transform: translateY(-5px);
            border-color: var(--accent);
            box-shadow: 0 10px 30px rgba(157, 0, 255, 0.15);
        }

        .ecosystem-item h4 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--primary);
        }

        .ecosystem-item p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin-top: 60px;
        }

        .team-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            backdrop-filter: var(--glass);
            transition: all 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(0, 224, 255, 0.1);
        }

        .team-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--gradient-bg);
            border: 3px solid var(--primary);
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--primary);
        }

        .team-card h3 {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .team-card .role {
            color: var(--primary);
            font-size: 1rem;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .team-card p {
            color: var(--text-muted);
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

            .mission-grid {
                grid-template-columns: 1fr;
            }

            .ecosystem-grid {
                grid-template-columns: 1fr;
            }

            .team-grid {
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

            .about-hero h1 {
                font-size: 2.8rem;
            }

            .section-header h2 {
                font-size: 2.2rem;
            }
        }
    </style>
@endsection

@section('content')
    <section class="about-hero">
        <div class="container">
            <h1>Welcome to <span class="text-gradient">Vcoins</span></h1>
            <p>We are building the infrastructure for the future of decentralized finance. Our mission is to make crypto
                wealth accessible, secure, and intelligent for everyone.</p>
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-value text-gradient">$85M+</div>
                    <div class="stat-label">Total Value Locked</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value text-gradient">25,000+</div>
                    <div class="stat-label">Active Users</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value text-gradient">12%</div>
                    <div class="stat-label">Max APY</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value text-gradient">100+</div>
                    <div class="stat-label">Supported Assets</div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <div class="section-header">
                <h2 class="text-gradient">Our Mission</h2>
                <p>To democratize access to DeFi yield opportunities through intelligent automation, security-first
                    architecture, and user-centric design.</p>
            </div>
            <div class="mission-grid">
                <div class="mission-card">
                    <div class="mission-card-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3>Security First</h3>
                    <p>We prioritize the safety of user funds through rigorous audits, multi-signature wallets, and
                        insurance coverage. Your assets are protected by industry-leading security measures.</p>
                </div>
                <div class="mission-card">
                    <div class="mission-card-icon">
                        <i class="fa-solid fa-robot"></i>
                    </div>
                    <h3>AI-Powered</h3>
                    <p>Our intelligent systems automatically find and optimize the best yield opportunities across multiple
                        protocols, ensuring maximum returns with minimal risk.</p>
                </div>
                <div class="mission-card">
                    <div class="mission-card-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h3>User Centric</h3>
                    <p>We believe DeFi should be accessible to everyone. Our platform simplifies complex strategies into
                        easy-to-use smart baskets that work for both beginners and experts.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section content-section-alt">
        <div class="container">
            <div class="section-header">
                <h2 class="text-gradient">Our Ecosystem</h2>
                <p>Vcoins offers a comprehensive suite of products designed to maximize your crypto wealth while maintaining
                    security and ease of use.</p>
            </div>
            <div class="ecosystem-grid">
                <div class="ecosystem-item">
                    <h4><i class="fa-solid fa-wallet"></i> Smart Baskets</h4>
                    <p>Automated yield farming strategies that intelligently allocate assets across multiple audited
                        protocols for optimal returns.</p>
                </div>
                <div class="ecosystem-item">
                    <h4><i class="fa-solid fa-chart-line"></i> Markets</h4>
                    <p>Real-time cryptocurrency price tracking and market analysis tools to help you make informed
                        investment decisions.</p>
                </div>
                <div class="ecosystem-item">
                    <h4><i class="fa-solid fa-graduation-cap"></i> Academy</h4>
                    <p>Learn & Earn platform where you can complete educational courses about crypto and DeFi while earning
                        token rewards.</p>
                </div>
                <div class="ecosystem-item">
                    <h4><i class="fa-solid fa-lock"></i> Security</h4>
                    <p>Multi-layered security infrastructure with insurance coverage, regular audits, and transparent risk
                        management.</p>
                </div>
                <div class="ecosystem-item">
                    <h4><i class="fa-solid fa-arrow-up-right-dots"></i> Auto-Compound</h4>
                    <p>Automated yield harvesting and reinvestment to maximize your returns through the power of compound
                        interest.</p>
                </div>
                <div class="ecosystem-item">
                    <h4><i class="fa-solid fa-network-wired"></i> Multi-Chain</h4>
                    <p>Access yield opportunities across multiple blockchain networks from a single, unified platform.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <div class="section-header">
                <h2 class="text-gradient">Our Values</h2>
                <p>The principles that guide everything we do at Vcoins.</p>
            </div>
            <div class="mission-grid">
                <div class="mission-card">
                    <div class="mission-card-icon">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h3>Transparency</h3>
                    <p>We believe in complete transparency. All our smart contracts are open-source and audited. Users can
                        verify every transaction and strategy.</p>
                </div>
                <div class="mission-card">
                    <div class="mission-card-icon">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <h3>Trust</h3>
                    <p>Building trust through consistent delivery, security best practices, and honest communication with
                        our community.</p>
                </div>
                <div class="mission-card">
                    <div class="mission-card-icon">
                        <i class="fa-solid fa-lightbulb"></i>
                    </div>
                    <h3>Innovation</h3>
                    <p>Continuously pushing the boundaries of what's possible in DeFi through cutting-edge technology and
                        creative solutions.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section content-section-alt">
        <div class="container">
            <div class="section-header">
                <h2 class="text-gradient">Leadership Team</h2>
                <p>The visionaries and experts building the future of decentralized finance.</p>
            </div>
            <div class="team-grid">
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <h3>Alex Chen</h3>
                    <div class="role">Co-Founder & CEO</div>
                    <p>Former DeFi protocol architect with 10+ years in blockchain technology. Led development of multiple
                        successful DeFi platforms before founding Vcoins.</p>
                </div>
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <h3>Sarah Kim</h3>
                    <div class="role">Co-Founder & CTO</div>
                    <p>Blockchain security expert and smart contract auditor. Previously worked on securing over $500M in
                        DeFi protocols. Passionate about making DeFi accessible.</p>
                </div>
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <h3>Michael Rodriguez</h3>
                    <div class="role">Head of Product</div>
                    <p>Product strategist with expertise in fintech and user experience. Focused on creating intuitive
                        interfaces for complex DeFi operations.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <div class="section-header">
                <h2 class="text-gradient">Regulatory Commitment</h2>
                <p>We are committed to operating in compliance with applicable regulations and working closely with
                    regulatory authorities worldwide.</p>
            </div>
            <div class="mission-grid">
                <div class="mission-card">
                    <div class="mission-card-icon">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <h3>Compliance</h3>
                    <p>We maintain strict compliance with financial regulations and work proactively with regulators to
                        ensure our platform meets all legal requirements.</p>
                </div>
                <div class="mission-card">
                    <div class="mission-card-icon">
                        <i class="fa-solid fa-file-shield"></i>
                    </div>
                    <h3>Data Protection</h3>
                    <p>Your privacy is paramount. We implement industry-leading data protection measures and never share
                        your personal information without consent.</p>
                </div>
                <div class="mission-card">
                    <div class="mission-card-icon">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <h3>Audits & Certifications</h3>
                    <p>Regular third-party security audits, smart contract reviews, and compliance certifications ensure the
                        highest standards of security and transparency.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
