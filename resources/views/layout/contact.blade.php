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

        .contact-hero {
            padding: 160px 0 80px;
            text-align: center;
        }

        .contact-hero h1 {
            font-size: 4.5rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -0.03em;
        }

        .contact-hero p {
            font-size: 1.25rem;
            color: var(--text-muted);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .contact-section {
            padding: 0px 0px 60px 0px;
        }

        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: start;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .info-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 30px;
            backdrop-filter: var(--glass);
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(0, 224, 255, 0.1);
        }

        .info-card-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .info-card h3 {
            font-size: 1.2rem;
            margin-bottom: 8px;
        }

        .info-card p {
            color: var(--text-muted);
            line-height: 1.6;
        }

        .contact-form-wrapper {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 40px;
            backdrop-filter: var(--glass);
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-main);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 14px 18px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--border);
            border-radius: 12px;
            color: var(--text-main);
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-group select {
            width: 100%;
            padding: 14px 44px 14px 18px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--border);
            border-radius: 12px;
            color: var(--text-main);
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            outline: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .select-wrapper {
            position: relative;
            display: block;
        }

        .select-wrapper::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 18px;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 6L8 10L12 6' stroke='%23A0AEC0' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: 16px 16px;
            opacity: 0.9;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 224, 255, 0.1);
            background: rgba(0, 0, 0, 0.4);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: var(--text-muted);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 150px;
        }

        .form-submit {
            width: 100%;
            margin-top: 10px;
        }

        .form-message {
            margin-top: 20px;
            padding: 14px 18px;
            border-radius: 12px;
            text-align: center;
            font-size: 0.95rem;
            display: none;
        }

        .form-message.success {
            background: rgba(0, 255, 163, 0.1);
            border: 1px solid var(--success);
            color: var(--success);
            display: block;
        }

        .form-message.error {
            background: rgba(249, 115, 115, 0.1);
            border: 1px solid #f97373;
            color: #f97373;
            display: block;
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

            .contact-container {
                grid-template-columns: 1fr;
                gap: 40px;
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

            .contact-hero h1 {
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

            .contact-hero {
                padding: 150px 0 70px;
            }

            .contact-hero h1 {
                font-size: 3.5rem;
            }

            .contact-hero p {
                font-size: 1.15rem;
            }

            .contact-section {
                padding: 0px 0px 50px 0px;
            }

            .contact-container {
                gap: 50px;
            }

            .contact-info {
                gap: 25px;
            }

            .info-card {
                padding: 25px;
            }

            .info-card-icon {
                width: 45px;
                height: 45px;
                font-size: 1.2rem;
            }

            .info-card h3 {
                font-size: 1.1rem;
            }

            .contact-form-wrapper {
                padding: 35px;
            }

            .contact-form-wrapper h2 {
                font-size: 1.75rem;
                margin-bottom: 25px;
            }

            .form-group {
                margin-bottom: 20px;
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

            .contact-hero {
                padding: 130px 0 60px;
            }

            .contact-hero h1 {
                font-size: 2.5rem;
                line-height: 1.2;
                margin-bottom: 1.25rem;
            }

            .contact-hero p {
                font-size: 1rem;
            }

            .contact-section {
                padding: 0px 0px 40px 0px;
            }

            .contact-container {
                gap: 35px;
            }

            .contact-info {
                gap: 20px;
            }

            .info-card {
                padding: 22px;
                border-radius: 18px;
            }

            .info-card-icon {
                width: 45px;
                height: 45px;
                font-size: 1.15rem;
                margin-bottom: 12px;
            }

            .info-card h3 {
                font-size: 1.05rem;
                margin-bottom: 6px;
            }

            .info-card p {
                font-size: 0.95rem;
            }

            .contact-form-wrapper {
                padding: 30px;
                border-radius: 20px;
            }

            .contact-form-wrapper h2 {
                font-size: 1.5rem;
                margin-bottom: 22px;
            }

            .form-group {
                margin-bottom: 18px;
            }

            .form-group label {
                font-size: 0.9rem;
                margin-bottom: 6px;
            }

            .form-group input,
            .form-group textarea,
            .form-group select {
                padding: 12px 16px;
                font-size: 0.95rem;
            }

            .form-group textarea {
                min-height: 130px;
            }

            .form-submit {
                padding: 12px 28px;
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

            .contact-hero {
                padding: 110px 0 50px;
            }

            .contact-hero h1 {
                font-size: 2rem;
                margin-bottom: 1rem;
            }

            .contact-hero p {
                font-size: 0.95rem;
            }

            .contact-section {
                padding: 0px 0px 35px 0px;
            }

            .contact-container {
                gap: 30px;
            }

            .contact-info {
                gap: 18px;
            }

            .info-card {
                padding: 20px;
                border-radius: 16px;
            }

            .info-card-icon {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
                margin-bottom: 10px;
                border-radius: 10px;
            }

            .info-card h3 {
                font-size: 1rem;
                margin-bottom: 5px;
            }

            .info-card p {
                font-size: 0.9rem;
            }

            .contact-form-wrapper {
                padding: 22px;
                border-radius: 18px;
            }

            .contact-form-wrapper h2 {
                font-size: 1.35rem;
                margin-bottom: 20px;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .form-group label {
                font-size: 0.85rem;
                margin-bottom: 6px;
            }

            .form-group input,
            .form-group textarea,
            .form-group select {
                padding: 11px 14px;
                font-size: 0.9rem;
                border-radius: 10px;
            }

            .form-group select {
                padding: 11px 40px 11px 14px;
            }

            .select-wrapper::after {
                right: 14px;
                width: 14px;
                height: 14px;
                background-size: 14px 14px;
            }

            .form-group textarea {
                min-height: 120px;
            }

            .form-submit {
                padding: 11px 24px;
                font-size: 0.9rem;
                width: 100%;
            }

            .form-message {
                padding: 12px 16px;
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
            .contact-hero h1 {
                font-size: 1.75rem;
            }

            .contact-hero p {
                font-size: 0.9rem;
            }

            .info-card {
                padding: 18px;
            }

            .info-card-icon {
                width: 38px;
                height: 38px;
                font-size: 1rem;
            }

            .info-card h3 {
                font-size: 0.95rem;
            }

            .info-card p {
                font-size: 0.85rem;
            }

            .contact-form-wrapper {
                padding: 18px;
            }

            .contact-form-wrapper h2 {
                font-size: 1.25rem;
                margin-bottom: 18px;
            }

            .form-group input,
            .form-group textarea,
            .form-group select {
                padding: 10px 12px;
                font-size: 0.85rem;
            }

            .form-group select {
                padding: 10px 38px 10px 12px;
            }

            .form-group textarea {
                min-height: 110px;
            }

            .form-submit {
                padding: 10px 20px;
                font-size: 0.85rem;
            }
        }

        /* Landscape Orientation for Mobile */
        @media (max-width: 768px) and (orientation: landscape) {
            .contact-hero {
                padding: 100px 0 40px;
            }

            .contact-hero h1 {
                font-size: 2rem;
            }

            .contact-container {
                gap: 30px;
            }
        }

        /* Print Styles */
        @media print {
            .menu-toggle,
            .mobile-nav,
            .contact-form-wrapper {
                display: none;
            }

            .contact-hero {
                padding: 20px 0;
            }

            .contact-hero h1 {
                font-size: 1.5rem;
            }

            .contact-section {
                padding: 20px 0;
            }

            .info-card {
                break-inside: avoid;
                page-break-inside: avoid;
            }
        }
    </style>
@endsection

@section('content')
    <section class="contact-hero">
        <div class="container">
            <h1>Get in <span class="text-gradient">Touch</span></h1>
            <p>Have questions or need support? We're here to help. Reach out to us and we'll get back to you as soon as
                possible.</p>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="contact-container">
                <div class="contact-info">
                    <div class="info-card">
                        <div class="info-card-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <h3>Email Us</h3>
                        <p>Vcoins.app@gmail.com</p>
                        <p style="margin-top: 8px; color: var(--text-muted);">We typically respond within 24 hours</p>
                    </div>

                    <div class="info-card">
                        <div class="info-card-icon">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <h3>Support</h3>
                        <p>Available 24/7 for your convenience</p>
                        <p style="margin-top: 8px; color: var(--text-muted);">Our team is always ready to assist you</p>
                    </div>

                    <div class="info-card">
                        <div class="info-card-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <h3>Office</h3>
                        <p>Global Remote Team</p>
                        <p style="margin-top: 8px; color: var(--text-muted);">Serving users worldwide</p>
                    </div>
                </div>

                <div class="contact-form-wrapper">
                    <h2 style="margin-bottom: 30px; color: var(--text-main);">Send us a Message</h2>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email address"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <div class="select-wrapper">
                                <select id="subject" name="subject" required>
                                    <option value="">Select a subject</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="support">Technical Support</option>
                                    <option value="partnership">Partnership</option>
                                    <option value="security">Security Issue</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" placeholder="Tell us how we can help you..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary form-submit">
                            Send Message <i class="fa-solid fa-paper-plane"></i>
                        </button>

                        <div id="formMessage" class="form-message"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const contactForm = document.getElementById('contactForm');
            const formMessage = document.getElementById('formMessage');

            if (contactForm) {
                contactForm.addEventListener('submit', (e) => {
                    e.preventDefault();

                    const name = document.getElementById('name').value;
                    const email = document.getElementById('email').value;
                    const subject = document.getElementById('subject').value;
                    const message = document.getElementById('message').value;

                    // use ajax call to submit the form data to the server
                    fetch('{{ route('platform.contact.submit') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            name: name,
                            email: email,
                            subject: subject,
                            message: message
                        })
                    }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            formMessage.textContent = 'Thank you for your message! We will get back to you soon.';
                            formMessage.className = 'form-message success';
                            contactForm.reset();
                        } else {
                            formMessage.textContent = 'There was an error sending your message. Please try again later.';
                            formMessage.className = 'form-message error';
                        }
                        contactForm.reset();

                        setTimeout(() => {
                            formMessage.className = 'form-message';
                            formMessage.style.display = 'none';
                        }, 5000);
                    }).catch(error => {
                        console.error('Error:', error);
                        formMessage.textContent = 'There was an error sending your message. Please try again later.';
                        formMessage.className = 'form-message error';
                        contactForm.reset();

                        setTimeout(() => {
                            formMessage.className = 'form-message';
                            formMessage.style.display = 'none';
                        }, 5000);
                    });
                    // formMessage.textContent = 'Thank you for your message! We will get back to you soon.';
                    // formMessage.className = 'form-message success';


                    // setTimeout(() => {
                    //     formMessage.className = 'form-message';
                    //     formMessage.style.display = 'none';
                    // }, 5000);
                });
            }
        });
    </script>
@endsection
