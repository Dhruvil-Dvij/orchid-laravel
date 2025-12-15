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
            margin: 0 auto 0px;
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

        .faq-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10000;
            align-items: center;
            justify-content: center;
        }

        .faq-modal.active {
            display: flex;
        }

        .faq-modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        body.modal-open {
            overflow-y: scroll;
            position: fixed;
            width: 100%;
        }

        .faq-modal-content {
            position: relative;
            background: #0f0f15;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2.5rem;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            backdrop-filter: var(--glass);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .faq-modal-close {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: transparent;
            border: none;
            color: var(--text-main);
            font-size: 1.5rem;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .faq-modal-close:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--primary);
        }

        .faq-modal-question {
            color: var(--primary);
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0 0 1.5rem 0;
            padding-right: 3rem;
            line-height: 1.4;
        }

        .faq-modal-answer {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.8;
            margin: 0;
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

        /* ============================================
           COMPREHENSIVE RESPONSIVE MEDIA QUERIES
           ============================================ */

        /* Large Tablets and Small Desktops (1024px and below) */
        @media (max-width: 1024px) {
            .container {
                padding: 0 20px;
            }

            .support-hero {
                padding: 140px 0 18px;
            }

            .support-hero h1 {
                font-size: 3.5rem;
            }

            .support-hero p {
                font-size: 1.15rem;
            }

            .search-container {
                max-width: 650px;
            }

            .search-box {
                padding: 16px 55px 16px 22px;
                font-size: 0.95rem;
            }

            .quick-links {
                padding: 50px 0;
            }

            .quick-links-grid {
                gap: 22px;
            }

            .quick-link-card {
                padding: 27px;
            }

            .quick-link-icon {
                width: 45px;
                height: 45px;
                font-size: 1.4rem;
            }

            .quick-link-card h3 {
                font-size: 1.1rem;
            }

            .faq-section {
                padding: 50px 0;
            }

            .section-header {
                margin-bottom: 40px;
            }

            .section-header h2 {
                font-size: 2.2rem;
            }

            .faq-category {
                padding: 27px;
            }

            .faq-category h3 {
                font-size: 1.3rem;
            }

            .announcements {
                padding: 50px 0;
            }

            .announcement-card {
                padding: 22px;
            }

            .contact-support {
                padding: 50px 0;
            }

            .contact-option {
                padding: 35px;
            }

            .contact-icon {
                width: 65px;
                height: 65px;
                font-size: 1.9rem;
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

            .support-hero {
                padding: 130px 0 15px;
            }

            .support-hero h1 {
                font-size: 2.5rem;
                line-height: 1.2;
                margin-bottom: 1.25rem;
            }

            .support-hero p {
                font-size: 1rem;
            }

            .search-container {
                max-width: 100%;
            }

            .search-box {
                padding: 15px 50px 15px 20px;
                font-size: 0.95rem;
            }

            .search-icon {
                right: 20px;
                font-size: 1.1rem;
            }

            .quick-links {
                padding: 40px 0;
            }

            .quick-links-grid {
                gap: 20px;
            }

            .quick-link-card {
                padding: 25px;
                border-radius: 14px;
            }

            .quick-link-icon {
                width: 45px;
                height: 45px;
                font-size: 1.3rem;
                margin-bottom: 18px;
            }

            .quick-link-card h3 {
                font-size: 1.05rem;
                margin-bottom: 8px;
            }

            .quick-link-card p {
                font-size: 0.9rem;
            }

            .faq-section {
                padding: 40px 0;
            }

            .section-header {
                margin-bottom: 35px;
            }

            .section-header h2 {
                font-size: 2rem;
                margin-bottom: 0.75rem;
            }

            .section-header p {
                font-size: 1rem;
            }

            .faq-categories {
                gap: 25px;
            }

            .faq-category {
                padding: 25px;
                border-radius: 18px;
            }

            .faq-category h3 {
                font-size: 1.2rem;
                margin-bottom: 18px;
            }

            .faq-item {
                margin-bottom: 12px;
            }

            .faq-item a {
                padding: 10px;
                font-size: 0.9rem;
            }

            .faq-modal-content {
                padding: 2rem;
                max-width: 90%;
            }

            .faq-modal-question {
                font-size: 1.3rem;
                padding-right: 2.5rem;
            }

            .faq-modal-answer {
                font-size: 0.95rem;
            }

            .announcements {
                padding: 40px 0;
            }

            .announcement-card {
                padding: 20px;
            }

            .announcement-date {
                font-size: 0.85rem;
            }

            .announcement-card h4 {
                font-size: 1.05rem;
            }

            .announcement-card p {
                font-size: 0.9rem;
            }

            .contact-support {
                padding: 40px 0;
            }

            .contact-option {
                padding: 30px;
            }

            .contact-icon {
                width: 60px;
                height: 60px;
                font-size: 1.75rem;
                margin-bottom: 18px;
            }

            .contact-option h3 {
                font-size: 1.2rem;
                margin-bottom: 12px;
            }

            .contact-option p {
                font-size: 0.95rem;
                margin-bottom: 18px;
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

            .support-hero {
                padding: 110px 0 12px;
            }

            .support-hero h1 {
                font-size: 2rem;
                margin-bottom: 1rem;
            }

            .support-hero p {
                font-size: 0.95rem;
            }

            .search-box {
                padding: 13px 45px 13px 18px;
                font-size: 0.9rem;
                border-radius: 10px;
            }

            .search-icon {
                right: 18px;
                font-size: 1rem;
            }

            .quick-links {
                padding: 35px 0;
            }

            .quick-links-grid {
                gap: 18px;
            }

            .quick-link-card {
                padding: 20px;
                border-radius: 12px;
            }

            .quick-link-icon {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
                margin-bottom: 15px;
                border-radius: 10px;
            }

            .quick-link-card h3 {
                font-size: 1rem;
                margin-bottom: 6px;
            }

            .quick-link-card p {
                font-size: 0.85rem;
            }

            .faq-section {
                padding: 35px 0;
            }

            .section-header {
                margin-bottom: 30px;
            }

            .section-header h2 {
                font-size: 1.75rem;
                margin-bottom: 0.75rem;
            }

            .section-header p {
                font-size: 0.95rem;
            }

            .faq-categories {
                gap: 20px;
            }

            .faq-category {
                padding: 20px;
                border-radius: 14px;
            }

            .faq-category h3 {
                font-size: 1.1rem;
                margin-bottom: 15px;
            }

            .faq-item {
                margin-bottom: 10px;
            }

            .faq-item a {
                padding: 10px 8px;
                font-size: 0.85rem;
                gap: 8px;
            }

            .faq-item i {
                font-size: 0.75rem;
            }

            .faq-modal-content {
                padding: 1.5rem;
                max-width: 95%;
                border-radius: 16px;
            }

            .faq-modal-close {
                top: 1rem;
                right: 1rem;
                width: 35px;
                height: 35px;
                font-size: 1.3rem;
            }

            .faq-modal-question {
                font-size: 1.1rem;
                margin-bottom: 1.25rem;
                padding-right: 2.5rem;
            }

            .faq-modal-answer {
                font-size: 0.9rem;
                line-height: 1.7;
            }

            .announcements {
                padding: 35px 0;
            }

            .announcement-card {
                padding: 18px;
                border-radius: 10px;
            }

            .announcement-date {
                font-size: 0.8rem;
                margin-bottom: 6px;
            }

            .announcement-card h4 {
                font-size: 1rem;
                margin-bottom: 6px;
            }

            .announcement-card p {
                font-size: 0.85rem;
            }

            .contact-support {
                padding: 35px 0;
            }

            .contact-option {
                padding: 25px;
                border-radius: 16px;
            }

            .contact-icon {
                width: 55px;
                height: 55px;
                font-size: 1.6rem;
                margin-bottom: 15px;
            }

            .contact-option h3 {
                font-size: 1.1rem;
                margin-bottom: 10px;
            }

            .contact-option p {
                font-size: 0.9rem;
                margin-bottom: 15px;
            }

            .contact-option .btn {
                padding: 11px 24px;
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
            .support-hero h1 {
                font-size: 1.75rem;
            }

            .support-hero p {
                font-size: 0.9rem;
            }

            .search-box {
                padding: 12px 42px 12px 16px;
                font-size: 0.85rem;
            }

            .quick-link-card {
                padding: 18px;
            }

            .quick-link-icon {
                width: 38px;
                height: 38px;
                font-size: 1.1rem;
            }

            .quick-link-card h3 {
                font-size: 0.95rem;
            }

            .quick-link-card p {
                font-size: 0.8rem;
            }

            .section-header h2 {
                font-size: 1.5rem;
            }

            .faq-category {
                padding: 18px;
            }

            .faq-category h3 {
                font-size: 1rem;
            }

            .faq-item a {
                font-size: 0.8rem;
            }

            .faq-modal-content {
                padding: 1.25rem;
            }

            .faq-modal-question {
                font-size: 1rem;
            }

            .faq-modal-answer {
                font-size: 0.85rem;
            }

            .announcement-card {
                padding: 16px;
            }

            .contact-option {
                padding: 20px;
            }

            .contact-icon {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }

            .contact-option h3 {
                font-size: 1rem;
            }
        }

        /* Landscape Orientation for Mobile */
        @media (max-width: 768px) and (orientation: landscape) {
            .support-hero {
                padding: 100px 0 12px;
            }

            .support-hero h1 {
                font-size: 2rem;
            }

            .quick-links-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .faq-categories {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Print Styles */
        @media print {
            .menu-toggle,
            .mobile-nav,
            .search-container,
            .faq-modal {
                display: none;
            }

            .support-hero {
                padding: 20px 0;
            }

            .support-hero h1 {
                font-size: 1.5rem;
            }

            .quick-links,
            .faq-section,
            .announcements,
            .contact-support {
                padding: 20px 0;
            }

            .quick-link-card,
            .faq-category,
            .announcement-card,
            .contact-option {
                break-inside: avoid;
                page-break-inside: avoid;
            }
        }
    </style>
@endsection

@section('content')
    <section class="support-hero">
        <div class="container">
            <h1>How can we <span class="text-gradient">help you?</span></h1>
            <p>Our knowledge base or browse categories below to find answers to your questions.</p>
            {{-- <div class="search-container">
                <input type="text" class="search-box" placeholder="Search for help articles, FAQs, and guides...">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
            </div> --}}
        </div>
    </section>

    <section class="quick-links">
        <div class="container">
            <div class="quick-links-grid">
                <a href="{{ route('platform.baskets') }}" class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fa-solid fa-rocket"></i>
                    </div>
                    <h3>Getting Started</h3>
                    <p>Set up your Vcoins account, explore key features, and begin earning yield through automated baskets.
                    </p>
                </a>

                <a href="{{ route('platform.baskets') }}" class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <h3>Smart Baskets</h3>
                    <p>Automated yield baskets work, including allocation strategy, return cycles, and risk optimization.
                    </p>
                </a>

                <a href="{{ route('platform.privacy') }}" class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3>Security & Safety</h3>
                    <p>Understand our platform’s security framework, including encryption, account protection, and safe-use
                        guidelines.</p>
                </a>

                <a href="{{ route('platform.contact') }}" class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fa-solid fa-arrow-right-arrow-left"></i>
                    </div>
                    <h3>Transactions</h3>
                    <p>Get help with deposits, withdrawals, and transaction issues.</p>
                </a>

                <a href="{{ route('platform.contact') }}" class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fa-solid fa-wrench"></i>
                    </div>
                    <h3>Troubleshooting</h3>
                    <p>Quickly resolve common issues with logins, purchases, wallet syncing, basket updates, and app
                        performance.</p>
                </a>

                <a href="{{ route('platform.profile') }}" class="quick-link-card">
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
                        <li class="faq-item"><a href="#" class="faq-link" data-question="How do I create an account?"
                                data-answer="You can create an account by clicking Sign Up, entering your basic details, and verifying your profile with KYC."><i
                                    class="fa-solid fa-chevron-right"></i> How do I create an
                                account?</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="How do I verify my account?"
                                data-answer="Check your inbox for the verification email and click the confirmation link. If you didn’t receive it, you can request a new one from your profile settings."><i
                                    class="fa-solid fa-chevron-right"></i> How do I verify my
                                account?</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="I forgot my password"
                                data-answer="Password can be changed from profile page or contact support."><i
                                    class="fa-solid fa-chevron-right"></i> How do I change my
                                password</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="How do I update my email?"
                                data-answer="To update your email, go to Account Settings > Profile. Click on 'Change Email' and enter your new email address. your email will be updated."><i
                                    class="fa-solid fa-chevron-right"></i> How do I update my
                                email?</a></li>
                        <li class="faq-item"><a href="#" class="faq-link"
                                data-question="Account security best practices"
                                data-answer="For optimal security, use a strong unique password, never share your credentials, enable email notifications for account activity, and regularly review your account settings. Always log out when using shared devices."><i
                                    class="fa-solid fa-chevron-right"></i> Account security
                                best practices</a></li>
                    </ul>
                </div>

                <div class="faq-category">
                    <h3>Smart Baskets</h3>
                    <ul class="faq-list">
                        <li class="faq-item"><a href="#" class="faq-link" data-question="What are Smart Baskets?"
                                data-answer="Smart Baskets are diversified investment portfolios that automatically manage your crypto assets. They allow you to invest in multiple cryptocurrencies through a single basket, reducing risk through diversification and automated rebalancing."><i
                                    class="fa-solid fa-chevron-right"></i> What are Smart
                                Baskets?</a></li>
                        <li class="faq-item"><a href="#" class="faq-link"
                                data-question="How do I create a Smart Basket?"
                                data-answer="To create a Smart Basket, go to the 'Baskets' section in your dashboard. Click 'Create New Basket', choose your preferred cryptocurrencies and allocation percentages, set your investment amount, and confirm. Your basket will start managing your investments automatically."><i
                                    class="fa-solid fa-chevron-right"></i> How do I create a
                                Smart Basket?</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="How are yields calculated?"
                                data-answer="Yields are calculated based on the performance of the cryptocurrencies in your basket. The system tracks price appreciation, staking rewards, and other income sources. Yields are displayed as an annual percentage rate (APR) and updated in real-time."><i
                                    class="fa-solid fa-chevron-right"></i> How are yields
                                calculated?</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="What is auto-compounding?"
                                data-answer="Auto-compounding automatically reinvests your earnings back into your Smart Basket. This means any rewards, staking income, or profits are automatically added to your principal, allowing your investment to grow exponentially over time."><i
                                    class="fa-solid fa-chevron-right"></i> What is
                                auto-compounding?</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="Can I withdraw anytime?"
                                data-answer="Yes, you can withdraw from your Wallet at any time. Go to your wallet details, click 'Withdraw', enter the amount you want to withdraw, and confirm. Withdrawals are typically processed within 24-48 hours."><i
                                    class="fa-solid fa-chevron-right"></i> Can I withdraw
                                anytime?</a></li>
                    </ul>
                </div>

                <div class="faq-category">
                    <h3>Deposits & Withdrawals</h3>
                    <ul class="faq-list">
                        <li class="faq-item"><a href="#" class="faq-link" data-question="How do I deposit funds?"
                                data-answer="To deposit funds, go to your Wallet section and click 'Add Funds'. Choose your preferred way, copy the deposit address or scan the QR code, and send funds from your external wallet. Deposits are usually confirmed within a few minutes after network confirmation."><i
                                    class="fa-solid fa-chevron-right"></i> How do I deposit
                                funds?</a></li>
                        <li class="faq-item"><a href="#" class="faq-link"
                                data-question="How long do withdrawals take?"
                                data-answer="Withdrawal processing time varies by cryptocurrency. Most withdrawals are processed within 24-48 hours after approval. Network congestion can sometimes cause delays. You'll receive email notifications at each stage of the withdrawal process."><i
                                    class="fa-solid fa-chevron-right"></i> How long do
                                withdrawals take?</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="What are the fees?"
                                data-answer="Vcoins charges competitive fees: deposit fees are free, withdrawal fees vary by cryptocurrency (typically 0.0005-0.001 BTC equivalent), and trading fees are 0.1% per transaction. Smart Basket management fees are 2% annually, charged monthly."><i
                                    class="fa-solid fa-chevron-right"></i> What are the
                                fees?</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="Minimum deposit amount"
                                data-answer="The minimum deposit amount varies by cryptocurrency. For Bitcoin, the minimum is 0.001 BTC. For Ethereum, it's 0.01 ETH. Most altcoins have a minimum equivalent to approximately $10 USD. Check the deposit page for specific minimums."><i
                                    class="fa-solid fa-chevron-right"></i> Minimum deposit
                                amount</a></li>
                        <li class="faq-item"><a href="#" class="faq-link"
                                data-question="Supported cryptocurrencies"
                                data-answer="Vcoins supports 750+ cryptocurrencies including Bitcoin (BTC), Ethereum (ETH), Tether (USDT), Binance Coin (BNB), Cardano (ADA), Solana (SOL), and many more. We regularly add new cryptocurrencies based on user demand and market conditions."><i
                                    class="fa-solid fa-chevron-right"></i> Supported
                                cryptocurrencies</a></li>
                    </ul>
                </div>

                <div class="faq-category">
                    <h3>Security</h3>
                    <ul class="faq-list">
                        <li class="faq-item"><a href="#" class="faq-link" data-question="How secure is Vcoins?"
                                data-answer="Vcoins employs bank-level security measures including cold storage for 95% of funds, multi-signature wallets, SSL encryption, regular security audits, and compliance with international security standards. We've never experienced a security breach."><i
                                    class="fa-solid fa-chevron-right"></i> How secure is
                                Vcoins?</a></li>
                        <li class="faq-item"><a href="#" class="faq-link"
                                data-question="Enable two-factor authentication"
                                data-answer="To enable 2FA, go to Account Settings > Security. Click 'Enable Two-Factor Authentication' and scan the QR code with an authenticator app like Google Authenticator or Authy. Enter the verification code to complete setup."><i
                                    class="fa-solid fa-chevron-right"></i> Enable two-factor
                                authentication</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="What if I suspect fraud?"
                                data-answer="If you suspect fraudulent activity, immediately contact our security team at Vcoins.app@gmail.com or use the 'Support' feature in your account. Change your password immediately and enable 2FA if not already enabled. We investigate all reports within 24 hours."><i
                                    class="fa-solid fa-chevron-right"></i> What if I suspect
                                fraud?</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="Smart contract audits"
                                data-answer="All Vcoins smart contracts undergo rigorous third-party audits by leading blockchain security firms. Audit reports are publicly available. We also conduct regular internal security reviews and bug bounty programs to ensure ongoing security."><i
                                    class="fa-solid fa-chevron-right"></i> Smart contract
                                audits</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="Data security & privacy"
                                data-answer="User data is stored in secure, isolated server environments with encrypted databases, continuous monitoring, and strict access controls. Multiple backups are maintained to prevent data loss in case of system failures."><i
                                    class="fa-solid fa-chevron-right"></i> Data security & privacy</a></li>
                    </ul>
                </div>

                <div class="faq-category">
                    <h3>Fees & Limits</h3>
                    <ul class="faq-list">
                        <li class="faq-item"><a href="#" class="faq-link"
                                data-question="What fees does Vcoins charge?"
                                data-answer="Vcoins charges transparent fees: trading fees (0.1% per trade), withdrawal fees (varies by crypto, typically 0.0005-0.001 BTC equivalent), Smart Basket management fees (2% annually), and network gas fees (passed through at cost). Deposit fees are free."><i
                                    class="fa-solid fa-chevron-right"></i> What fees does
                                Vcoins charge?</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="Gas fees explained"
                                data-answer="Gas fees are network fees paid to blockchain networks (like Ethereum) to process transactions. These fees vary based on network congestion and transaction complexity. Vcoins passes these fees through at cost - we don't profit from gas fees."><i
                                    class="fa-solid fa-chevron-right"></i> Gas fees
                                explained</a></li>
                        <li class="faq-item"><a href="#" class="faq-link"
                                data-question="Deposit and withdrawal limits"
                                data-answer="Deposit limits: No maximum for verified accounts. Withdrawal limits: Unverified accounts can withdraw up to $1,000 daily. Verified accounts have higher limits (up to $50,000 daily). Limits can be increased by completing additional verification."><i
                                    class="fa-solid fa-chevron-right"></i> Deposit and
                                withdrawal limits</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="Performance fees"
                                data-answer="Smart Basket performance fees are 20% of profits, charged only when you withdraw. If your basket doesn't generate profits, no performance fee is charged. This aligns our success with yours - we only earn when you profit."><i
                                    class="fa-solid fa-chevron-right"></i> Performance
                                fees</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="Fee structure breakdown"
                                data-answer="Complete fee breakdown: Trading (0.1%), Withdrawals (network-dependent, ~0.0005-0.001 BTC), Smart Baskets (2% annual management fee, 20% performance fee on profits), Deposits (free), Gas fees (at cost). All fees are clearly displayed before transactions."><i
                                    class="fa-solid fa-chevron-right"></i> Fee structure
                                breakdown</a></li>
                    </ul>
                </div>

                <div class="faq-category">
                    <h3>Technical Support</h3>
                    <ul class="faq-list">
                        <li class="faq-item"><a href="#" class="faq-link"
                                data-question="Transaction stuck or pending"
                                data-answer="If your transaction is stuck, it's usually due to network congestion. Wait 24-48 hours for network confirmation. If still pending, check the transaction hash on a blockchain explorer. For urgent issues, contact support."><i
                                    class="fa-solid fa-chevron-right"></i> Transaction
                                stuck or pending</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="Connection issues"
                                data-answer="If experiencing connection issues, try: clearing browser cache, disabling VPN/proxy, checking internet connection, trying a different browser, or using incognito mode. If problems persist, contact our technical support team."><i
                                    class="fa-solid fa-chevron-right"></i> Connection
                                issues</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="Browser compatibility"
                                data-answer="Vcoins works best on Chrome, Firefox, Safari, and Edge (latest versions). We recommend keeping your browser updated. Some features may not work on older browsers. For optimal experience, use Chrome or Firefox with JavaScript enabled."><i
                                    class="fa-solid fa-chevron-right"></i> Browser
                                compatibility</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="Mobile app support"
                                data-answer="Vcoins mobile app is currently not available for iOS and Android. Be aware of fraud."><i
                                    class="fa-solid fa-chevron-right"></i> Mobile app
                                support</a></li>
                        <li class="faq-item"><a href="#" class="faq-link" data-question="API documentation"
                                data-answer="Our REST API documentation is available. It includes authentication, endpoints, rate limits, and code examples. API keys can be generated in Account Settings > API. For advanced features, check our WebSocket API documentation."><i
                                    class="fa-solid fa-chevron-right"></i> API
                                documentation</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="faq-modal" id="faqModal">
        <div class="faq-modal-overlay"></div>
        <div class="faq-modal-content">
            <button class="faq-modal-close" id="faqModalClose">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <h3 class="faq-modal-question" id="faqModalQuestion"></h3>
            <div class="faq-modal-answer" id="faqModalAnswer"></div>
        </div>
    </div>

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
                    <a href="mailto:Vcoins.app@gmail.com" class="btn btn-outline">Vcoins.app@gmail.com</a>
                </div>

                <div class="contact-option">
                    <div class="contact-icon">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h3>Contact</h3>
                    <p>Contact our support team (Available 24/7)</p>
                    <a href="{{route('platform.contact')}}" class="btn btn-outline">Contact us</a>
                </div>

                {{-- <div class="contact-option">
                    <div class="contact-icon">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <h3>Submit a Ticket</h3>
                    <p>Create a support ticket for detailed assistance</p>
                    <a href="contact.html" class="btn btn-primary">Submit Ticket</a>
                </div> --}}
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const faqModal = document.getElementById('faqModal');
            const faqModalQuestion = document.getElementById('faqModalQuestion');
            const faqModalAnswer = document.getElementById('faqModalAnswer');
            const faqModalClose = document.getElementById('faqModalClose');
            const faqLinks = document.querySelectorAll('.faq-link');

            let scrollPosition = 0;

            function openModal(question, answer) {
                faqModalQuestion.textContent = question;
                faqModalAnswer.textContent = answer;
                faqModal.classList.add('active');

                scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
                document.body.classList.add('modal-open');
                document.body.style.top = `-${scrollPosition}px`;
            }

            function closeModal() {
                faqModal.classList.remove('active');
                document.body.classList.remove('modal-open');
                document.body.style.top = '';
                window.scrollTo(0, scrollPosition);
            }

            faqLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const question = this.getAttribute('data-question');
                    const answer = this.getAttribute('data-answer');
                    if (question && answer) {
                        openModal(question, answer);
                    }
                });
            });

            faqModalClose.addEventListener('click', closeModal);

            faqModal.addEventListener('click', function(e) {
                if (e.target === faqModal || e.target.classList.contains('faq-modal-overlay')) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && faqModal.classList.contains('active')) {
                    closeModal();
                }
            });
        });
    </script>
@endsection
