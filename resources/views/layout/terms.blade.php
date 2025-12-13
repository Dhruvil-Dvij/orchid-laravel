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
    </style>
@endsection

@section('content')
    <section class="terms-hero">
        <div class="container">
            <h1>Terms of <span class="text-gradient">Service</span></h1>
            <p>Please read these terms carefully before using our platform. By accessing or using Vcoins, you agree to be
                bound by these terms.</p>
            <div class="last-updated">Last Updated: January 2025</div>
        </div>
    </section>

    <section class="terms-content">
        <div class="container">
            <div class="terms-section">
                <h2>1. Acceptance of Terms</h2>
                <p>By accessing and using the Vcoins platform ("Platform", "Service", "we", "us", or "our"), you accept and
                    agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the
                    above, please do not use this service.</p>
                <p>These Terms of Service ("Terms") constitute a legally binding agreement between you and Vcoins regarding
                    your use of our decentralized finance (DeFi) platform and services.</p>
            </div>

            <div class="terms-section">
                <h2>2. Description of Services</h2>
                <p>Vcoins provides a decentralized platform for cryptocurrency yield farming, automated smart basket
                    strategies, and DeFi services. Our services include but are not limited to:</p>
                <ul>
                    <li>Automated yield farming strategies through smart baskets</li>
                    <li>Real-time cryptocurrency market data and analytics</li>
                    <li>Multi-chain DeFi protocol integration</li>
                    <li>Auto-compounding yield optimization</li>
                    <li>Educational resources and academy features</li>
                </ul>
                <p>We reserve the right to modify, suspend, or discontinue any aspect of our services at any time without
                    prior notice.</p>
            </div>

            <div class="terms-section">
                <h2>3. Eligibility and Account Registration</h2>
                <h3>3.1 Eligibility</h3>
                <p>You must be at least 18 years old and have the legal capacity to enter into contracts in your
                    jurisdiction to use our services. By using Vcoins, you represent and warrant that:</p>
                <ul>
                    <li>You are of legal age in your jurisdiction</li>
                    <li>You have the authority to enter into these Terms</li>
                    <li>You are not located in a jurisdiction where cryptocurrency services are prohibited</li>
                    <li>You will comply with all applicable laws and regulations</li>
                </ul>

                <h3>3.2 Account Security</h3>
                <p>You are solely responsible for maintaining the confidentiality of your account credentials, private keys,
                    and wallet information. You agree to immediately notify us of any unauthorized use of your account or
                    any other breach of security.</p>
            </div>

            <div class="terms-section">
                <h2>4. User Obligations and Conduct</h2>
                <p>You agree to use our services only for lawful purposes and in accordance with these Terms. You agree not
                    to:</p>
                <ul>
                    <li>Use the Platform for any illegal or unauthorized purpose</li>
                    <li>Violate any applicable laws, regulations, or third-party rights</li>
                    <li>Interfere with or disrupt the integrity or performance of the Platform</li>
                    <li>Attempt to gain unauthorized access to any part of the Platform</li>
                    <li>Use automated systems or bots to interact with the Platform without authorization</li>
                    <li>Engage in any form of market manipulation or fraudulent activity</li>
                    <li>Transmit any viruses, malware, or harmful code</li>
                </ul>
            </div>

            <div class="terms-section">
                <h2>5. Risks and Disclaimers</h2>
                <div class="highlight-box">
                    <p><strong>Important:</strong> Cryptocurrency and DeFi activities involve substantial risk of loss. You
                        should carefully consider whether such activities are suitable for you in light of your
                        circumstances, knowledge, and financial resources.</p>
                </div>
                <h3>5.1 Market Risks</h3>
                <p>The cryptocurrency market is highly volatile and unpredictable. The value of digital assets can fluctuate
                    dramatically, and you may experience significant losses. Past performance does not guarantee future
                    results.</p>

                <h3>5.2 Smart Contract Risks</h3>
                <p>Our platform utilizes smart contracts on blockchain networks. While we conduct security audits, smart
                    contracts may contain bugs, vulnerabilities, or be subject to exploits. You acknowledge that:</p>
                <ul>
                    <li>Smart contracts are immutable once deployed</li>
                    <li>Blockchain transactions are irreversible</li>
                    <li>Protocol failures or exploits may result in loss of funds</li>
                    <li>Network congestion may affect transaction processing</li>
                </ul>

                <h3>5.3 Regulatory Risks</h3>
                <p>Cryptocurrency regulations vary by jurisdiction and may change. You are responsible for ensuring
                    compliance with all applicable laws in your jurisdiction. We may restrict or terminate services in
                    certain jurisdictions as required by law.</p>
            </div>

            <div class="terms-section">
                <h2>6. Intellectual Property</h2>
                <p>All content, features, and functionality of the Platform, including but not limited to text, graphics,
                    logos, icons, images, software, and code, are the exclusive property of Vcoins or its licensors and are
                    protected by copyright, trademark, and other intellectual property laws.</p>
                <p>You are granted a limited, non-exclusive, non-transferable license to access and use the Platform for
                    personal, non-commercial purposes in accordance with these Terms.</p>
            </div>

            <div class="terms-section">
                <h2>7. Limitation of Liability</h2>
                <p>To the maximum extent permitted by applicable law, Vcoins and its affiliates, officers, directors,
                    employees, and agents shall not be liable for any indirect, incidental, special, consequential, or
                    punitive damages, including but not limited to:</p>
                <ul>
                    <li>Loss of profits, revenue, or data</li>
                    <li>Loss of digital assets or cryptocurrency</li>
                    <li>Business interruption or loss of business opportunities</li>
                    <li>Damages resulting from unauthorized access or use</li>
                </ul>
                <p>Our total liability for any claims arising from or related to the use of our services shall not exceed
                    the amount you paid to us in the twelve (12) months preceding the claim, or $100, whichever is greater.
                </p>
            </div>

            <div class="terms-section">
                <h2>8. Indemnification</h2>
                <p>You agree to indemnify, defend, and hold harmless Vcoins and its affiliates, officers, directors,
                    employees, and agents from and against any claims, damages, losses, liabilities, costs, and expenses
                    (including reasonable attorneys' fees) arising out of or related to:</p>
                <ul>
                    <li>Your use or misuse of the Platform</li>
                    <li>Your violation of these Terms</li>
                    <li>Your violation of any applicable laws or regulations</li>
                    <li>Your infringement of any third-party rights</li>
                </ul>
            </div>

            <div class="terms-section">
                <h2>9. Privacy and Data Protection</h2>
                <p>Your privacy is important to us. Our collection, use, and protection of your personal information is
                    governed by our Privacy Policy, which is incorporated into these Terms by reference. By using our
                    services, you consent to the collection and use of information as described in our Privacy Policy.</p>
                <p>We implement industry-standard security measures to protect your data, but we cannot guarantee absolute
                    security. You are responsible for maintaining the security of your account credentials and private keys.
                </p>
            </div>

            <div class="terms-section">
                <h2>10. Fees and Payments</h2>
                <p>Certain services on our Platform may be subject to fees. We reserve the right to modify our fee structure
                    at any time. All fees will be clearly disclosed before you complete a transaction.</p>
                <p>You are responsible for all transaction fees, gas fees, and network fees associated with blockchain
                    transactions. These fees are paid directly to the blockchain network and are not controlled by Vcoins.
                </p>
            </div>

            <div class="terms-section">
                <h2>11. Termination</h2>
                <p>We reserve the right to suspend or terminate your access to the Platform at any time, with or without
                    cause or notice, for any reason including but not limited to:</p>
                <ul>
                    <li>Violation of these Terms</li>
                    <li>Fraudulent or illegal activity</li>
                    <li>Request by law enforcement or regulatory authorities</li>
                    <li>Extended periods of inactivity</li>
                </ul>
                <p>Upon termination, your right to use the Platform will immediately cease. You may terminate your use of
                    the Platform at any time by discontinuing access.</p>
            </div>

            <div class="terms-section">
                <h2>12. Changes to Terms</h2>
                <p>We reserve the right to modify these Terms at any time. We will notify users of material changes by
                    posting the updated Terms on our Platform and updating the "Last Updated" date.</p>
                <p>Your continued use of the Platform after such modifications constitutes your acceptance of the updated
                    Terms. If you do not agree to the modified Terms, you must discontinue use of the Platform.</p>
            </div>

            <div class="terms-section">
                <h2>13. Governing Law and Dispute Resolution</h2>
                <p>These Terms shall be governed by and construed in accordance with applicable laws, without regard to
                    conflict of law principles.</p>
                <p>Any disputes arising out of or relating to these Terms or the Platform shall be resolved through binding
                    arbitration in accordance with applicable arbitration rules, except where prohibited by law.</p>
            </div>

            <div class="terms-section">
                <h2>14. Severability</h2>
                <p>If any provision of these Terms is found to be unenforceable or invalid, that provision shall be limited
                    or eliminated to the minimum extent necessary, and the remaining provisions shall remain in full force
                    and effect.</p>
            </div>

            <div class="terms-section">
                <h2>15. Entire Agreement</h2>
                <p>These Terms, together with our Privacy Policy and any other legal notices published on the Platform,
                    constitute the entire agreement between you and Vcoins regarding the use of the Platform and supersede
                    all prior agreements and understandings.</p>
            </div>

            <div class="terms-section">
                <h2>16. Contact Information</h2>
                <p>If you have any questions about these Terms, please contact us at:</p>
                <p>
                    <strong>Email:</strong> <a href="mailto:Vcoins.app@gmail.com">Vcoins.app@gmail.com</a><br>
                    {{-- <strong>Support:</strong> <a href="mailto:Vcoins.app@gmail.com">Vcoins.app@gmail.com</a> --}}
                </p>
                <p>You can also visit our <a href="{{route('platform.contact')}}">Contact Us</a> page for additional ways to reach us.</p>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
