@extends('layout.home-layout')

@section('styles')
    <style>
        :root {
            --bg-dark: #050505;
            --bg-card: rgba(20, 20, 30, 0.6);
            --bg-card-hover: rgba(30, 30, 45, 0.8);
            --primary: #00E0FF;
            /* Cyber Blue */
            --accent: #9D00FF;
            /* Neon Purple */
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

        /* Utility */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .text-gradient {
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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
            border-color: var(--primary);
            background: rgba(0, 224, 255, 0.1);
        }

        /* Section Header */
        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header h2 {
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 3rem;
        }

        /* Header */
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
            /* open below fixed header */
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
            /* solid background for drawer */
            border-left: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .mobile-logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--text-main);
        }

        .mobile-logo img {
            height: 32px;
            width: auto;
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

        /* Hero */
        .hero {
            padding: 180px 0 100px;
            position: relative;
        }

        .hero-content {
            text-align: center;
            max-width: 900px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 4.5rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -0.03em;
        }

        .hero p {
            font-size: 1.25rem;
            color: var(--text-muted);
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .badge-new {
            background: rgba(157, 0, 255, 0.2);
            color: #d8b4fe;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid rgba(157, 0, 255, 0.4);
            display: inline-block;
            margin-bottom: 20px;
        }

        /* Floating 3D Cards Animation */
        .hero-cards {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: -1;
        }

        .floating-coin {
            position: absolute;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--bg-card);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            animation: float 6s ease-in-out infinite;
        }

        .c1 {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .c2 {
            top: 30%;
            right: 10%;
            animation-delay: 2s;
        }

        .c3 {
            bottom: 20%;
            left: 15%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* SECTION 0: Stats (New) */
        .stats-section {
            padding: 60px 0;
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
            padding: 30px;
            border-radius: 20px;
            backdrop-filter: var(--glass);
        }

        .stat-value {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 5px;
            line-height: 1.1;
        }

        .stat-label {
            color: var(--text-muted);
            font-weight: 500;
        }


        /* SECTION 1: Calculator (Interactive) - Existing */
        .calculator-section {
            padding: 100px 0;
        }

        .calc-container {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 30px;
            padding: 50px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            backdrop-filter: var(--glass);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }

        .calc-controls h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .calc-input-group {
            margin-top: 30px;
        }

        .calc-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .range-slider {
            width: 100%;
            height: 6px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            outline: none;
            -webkit-appearance: none;
        }

        .range-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--primary);
            cursor: pointer;
            box-shadow: 0 0 15px var(--primary);
        }

        .calc-result-card {
            background: linear-gradient(145deg, rgba(30, 30, 40, 0.8), rgba(20, 20, 30, 0.9));
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
            overflow: hidden;
        }

        .calc-result-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--gradient-text);
        }

        .roi-text {
            font-size: 4rem;
            font-weight: 800;
            color: var(--success);
            margin: 20px 0;
            text-shadow: 0 0 20px rgba(0, 255, 163, 0.3);
        }

        /* SECTION 2: How It Works (New) */
        .how-it-works-section {
            padding: 100px 0;
            background: #0f0f15;
        }

        .steps-grid {
            display: flex;
            justify-content: space-between;
            gap: 40px;
            position: relative;
        }

        .steps-grid::before {
            content: '';
            position: absolute;
            top: 35px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 2px;
            background: var(--border);
            z-index: 1;
        }

        .step-item {
            flex: 1;
            text-align: center;
            position: relative;
            padding-top: 80px;
        }

        .step-icon {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 70px;
            background: var(--bg-dark);
            border: 3px solid var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary);
            z-index: 2;
        }

        .step-item h3 {
            margin: 15px 0 10px;
        }

        .step-item p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }


        /* SECTION 3: Learn to Earn - Existing */
        .learn-section {
            padding: 100px 0;
        }

        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .course-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.4s ease;
            position: relative;
            group: cursor;
        }

        .course-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(0, 224, 255, 0.1);
        }

        .course-image {
            height: 180px;
            background: #1a1a1a;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .course-image i {
            font-size: 2.5rem;
            opacity: 0.2;
        }

        .reward-tag {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(0, 0, 0, 0.8);
            border: 1px solid var(--success);
            color: var(--success);
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .course-content {
            padding: 25px;
        }

        .course-content h3 {
            font-size: 1.3rem;
            margin-bottom: 10px;
        }

        .course-content p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 20px;
        }


        /* SECTION 4: Roadmap */
        .roadmap-section {
            padding: 65px 0;
            background: linear-gradient(to bottom, var(--bg-dark), #0f0f15);
        }

        .roadmap-badge {
            display: inline-block;
            padding: 8px 20px;
            border: 2px solid var(--primary);
            border-radius: 50px;
            color: var(--primary);
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 20px;
        }

        .roadmap-heading {
            font-size: 3rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 16px;
        }

        .roadmap-heading .highlight {
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .roadmap-timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0px 0 0px;
        }

        .timeline-line {
            position: absolute;
            top: 78px;
            /* horizontal line height */
            left: 0;
            right: 0;
            height: 2px;
            background: var(--text-muted);
            opacity: 0.3;
            z-index: 0;
        }

        .timeline-items {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            position: relative;
            z-index: 1;
        }

        .timeline-item {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .timeline-icon {
            width: 80px;
            height: 80px;
            margin: 40px auto 0;
            /* 40px from top; center at 40px+40px = 80px */

            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            padding: 10px;
        }

        .timeline-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .timeline-year {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 15px;
            margin-top: 20px;
        }

        .timeline-description {
            color: var(--text-main);
            font-size: 1rem;
            line-height: 1.6;
        }

        /* SECTION 5: Testimonials (New) */
        .testimonials-section {
            padding: 100px 0;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .testimonial-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 30px;
            transition: all 0.3s;
        }

        .testimonial-card:hover {
            border-color: var(--accent);
            box-shadow: 0 0 20px rgba(157, 0, 255, 0.15);
        }

        .quote-icon {
            color: var(--accent);
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .author-meta {
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #000;
        }

        .author-details p {
            margin: 0;
            font-weight: 600;
        }

        .author-details span {
            color: var(--text-muted);
            font-size: 0.9rem;
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

        /* Crypto Table Section */
        .crypto-table-section {
            padding: 80px 0;
            background: var(--bg-dark);
            color: var(--text-main);
        }

        .crypto-table-section h2 {
            text-align: center;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.25rem;
            color: var(--text-muted);
            margin-bottom: 3rem;
        }

        /* Search and Controls */
        .table-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .search-container {
            position: relative;
            flex: 1;
            max-width: 400px;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 25px;
            color: var(--text-main);
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(0, 224, 255, 0.25);
        }

        .search-input::placeholder {
            color: var(--text-muted);
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        .per-page-selector {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-muted);
        }

        .per-page-select {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-main);
            padding: 0.5rem 2.2rem 0.5rem 0.75rem;
            /* extra right padding for arrow spacing */
            font-size: 0.9rem;
            outline: none;
            cursor: pointer;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%23ffffff'%3E%3Cpath fill-rule='evenodd' d='M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z' clip-rule='evenodd'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.7rem center;
            background-size: 0.75rem;
        }

        .per-page-select:focus {
            border-color: var(--primary);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .section-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }

        .table-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            /* Allow wrapping on smaller screens */
            gap: 15px;
            /* Space between items */
        }

        .search-container {
            position: relative;
            flex-grow: 1;
            /* Allow search input to take more space */
            max-width: 400px;
            /* Limit max width of search */
        }

        .search-input {
            width: 100%;
            padding: 10px 10px 10px 35px;
            /* Add padding for icon */
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        .per-page-selector label {
            margin-right: 10px;
            font-weight: bold;
            /* color: #333; */
        }

        /* .per-page-select styles defined above (theme-aware) */

        .table-container {
            overflow-x: auto;
            /* Enable horizontal scrolling for small screens */
            border: 1px solid #00e0ff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .crypto-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
            /* Ensure minimum width for better display */
        }

        .crypto-table th,
        .crypto-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .crypto-table thead th {
            background-color: rgba(255, 255, 255, 0.02);
            font-weight: bold;
            color: var(--text-muted);
            position: sticky;
            top: 0;
            z-index: 10;
            cursor: pointer;
            /* Indicate sortable columns */
        }

        .crypto-table tbody tr:hover {
            background-color: rgba(0, 224, 255, 0.08);
            /* Highlight row on hover */
            color: var(--text-main);
        }

        .crypto-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Column specific styles */
        .coin-name-col {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .coin-logo {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            object-fit: contain;
        }

        /* Text colors for change */
        .text-success {
            color: #28a745;
            /* Green */
        }

        .text-danger {
            color: #dc3545;
            /* Red */
        }

        /* Pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            list-style: none;
            padding: 0;
            flex-wrap: wrap;
        }

        .pagination .page-item {
            margin: 0 5px;
        }

        .pagination .page-link {
            display: block;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 5px;
            color: var(--text-main);
            text-decoration: none;
            transition: background-color 0.2s, color 0.2s;
        }

        .pagination .page-link:hover:not(.disabled) {
            background-color: rgba(0, 224, 255, 0.1);
            color: var(--primary);
            border-color: var(--primary);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary);
            color: #000;
            border-color: var(--primary);
        }

        .pagination .page-item.disabled .page-link {
            color: var(--text-muted);
            pointer-events: none;
            background-color: transparent;
        }

        .pagination .page-item span.page-link {
            /* For "..." */
            background-color: transparent;
            border-color: transparent;
            color: var(--text-muted);
            cursor: default;
        }

        /* Sort indicators */
        .sortable {
            position: relative;
            padding-right: 25px;
            /* Make space for the arrow */
        }

        .sortable::after {
            content: '';
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            border: 4px solid transparent;
            opacity: 0.3;
            /* Faded arrow by default */
        }

        .sortable.asc::after {
            border-bottom-color: #555;
            /* Up arrow */
            opacity: 1;
        }

        .sortable.desc::after {
            border-top-color: #555;
            /* Down arrow */
            opacity: 1;
        }

        @media (max-width: 768px) {
            .table-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .search-container {
                max-width: 100%;
            }

            .pagination {
                justify-content: center;
                gap: 0.25rem;
            }

            .pagination .page-item {
                margin: 0 2px;
            }

            .step-item {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
            }

            .hero-right .countdown {
                justify-content: center;
            }
        }

        .hero-buttons {
            gap: 12px;
            display: flex;
            justify-content: center;
        }

        @media (max-width: 425px) {
            .hero-buttons {
                display: flex;
                flex-direction: column;
                gap: 10px;
                justify-content: center;
                align-items: center;
            }

            .calc-container {
                padding: 25px;
            }

            .calc-controls p {
                text-align: center;
            }

            .calc-input-group {
                width: 83%;
            }

            .calc-input-group div .btn-outline {
                padding: 7px 22px;
                font-size: 12px;
            }

            .roi-text {
                font-size: 30px;

            }

        }

        /* secure section */

        .hero-section {
            background: #0f0f15;
            padding: 80px 0;
            color: #fff;
        }

        .hero-container {
            width: 75%;
            max-width: 1300px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px;
        }

        .hero-left img {
            width: 450px;
        }

        .countdown {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
        }

        .time-box h2 {
            font-size: 42px;
            font-weight: 700;
        }

        .time-box p {
            font-size: 14px;
            margin-top: -8px;
            text-align: center;
        }

        .hero-title {
            font-size: 45px;
            font-weight: 700;
            line-height: 1.2;
            background: rgba(255, 255, 255, 0.1);
            display: inline-block;
            padding: 5px 10px;
            margin-bottom: 20px;
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-description {
            width: 90%;
            font-size: 15px;
            margin-bottom: 30px;
            color: #d7e4ff;
        }

        .hero-btn {
            background: var(--primary);
            color: #000;
            border: none;
            box-shadow: 0 0 20px rgba(0, 224, 255, 0.3);
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

        .hero-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba #00e0ff80 (0, 224, 255, 0.5);
            background: #33eaff;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-container {
                flex-direction: column;
                text-align: center;
            }

            .hero-left img {
                width: 350px;
            }

            .hero-description {
                width: 100%;
            }
        }

        @media (max-width: 425px) {
            .hero-left img {
                width: 286px;
            }
        }

        /* FAQ */

        .faq-section-container {
            background: #0f0f15;
            padding: 80px 0px;
        }

        .faq-section {
            max-width: 1200px;
            width: 85%;
            margin: 0px auto;
            color: #bfc7d5;
        }

        .faq-section h2 {
            text-align: center;
            font-size: 2.2rem;
            margin-bottom: 2.5rem;
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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
    </style>
@endsection
@section('content')
    <section class="hero">
        <div class="hero-cards">
            <div class="floating-coin c1"><i class="fa-brands fa-bitcoin" style="color:#F7931A; font-size: 24px;"></i>
            </div>
            <div class="floating-coin c2"><i class="fa-brands fa-ethereum" style="color:#627EEA; font-size: 24px;"></i>
            </div>
            <div class="floating-coin c3"><i class="fa-solid fa-shield-halved" style="color:#00E0FF; font-size: 24px;"></i>
            </div>
        </div>
        <div class="container hero-content">
            <h1>Diversify with Crypto <br><span class="text-gradient">Baskets</span></h1>
            <p>Vcoins aggregates yield, automates staking, and simplifies DeFi. Earn up to 12% APY on stablecoins with
                our audited smart baskets.</p>
            <div class="hero-buttons">
                <a href="#staking" class="btn btn-primary">Start Earning <i class="fa-solid fa-arrow-right"></i></a>
                <a href="{{route('platform.baskets')}}" class="btn btn-outline">View Baskets</a>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-value text-gradient">$85M+</div>
                    <div class="stat-label">Total Value Locked (TVL)</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value text-gradient">12%</div>
                    <div class="stat-label">Max Stablecoin APY</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value text-gradient">50,000+</div>
                    <div class="stat-label">Active Users</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value text-gradient">24/7</div>
                    <div class="stat-label">AI Rebalancing</div>
                </div>
            </div>
        </div>
    </section>
    <section class="calculator-section" id="staking">
        <div class="container">
            <div class="calc-container">
                <div class="calc-controls">
                    <h2 class="text-gradient">Calculate Earnings</h2>
                    <p style="color:var(--text-muted);">See how much your crypto could grow with our auto-compounding
                        vaults.</p>

                    <div class="calc-input-group">
                        <div class="calc-label">
                            <span>Investment Amount</span>
                            <span id="amountDisplay">$10,000</span>
                        </div>
                        <input type="range" min="100" max="100000" value="10000" class="range-slider"
                            id="amountSlider">
                    </div>

                    <div class="calc-input-group">
                        <div class="calc-label">
                            <span>Duration (Months)</span>
                            <span id="timeDisplay">12 Months</span>
                        </div>
                        <input type="range" min="1" max="60" value="12" class="range-slider"
                            id="timeSlider">
                    </div>

                    <div class="calc-input-group">
                        <div class="calc-label">
                            <span>Asset Type</span>
                        </div>
                        <div style="display:flex; gap:10px;">
                            <button class="btn btn-outline" onclick="setAPY(0.20, this)"
                                style="border-color:var(--primary);">ETH (20%)</button>
                            <button class="btn btn-outline" onclick="setAPY(0.12, this)">USDC (12%)</button>
                            <button class="btn btn-outline" onclick="setAPY(0.18, this)">SOL (18%)</button>
                        </div>
                    </div>
                </div>

                <div class="calc-result-card">
                    <div style="font-size: 1.1rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px;">
                        Est. Total Return</div>
                    <div class="roi-text" id="totalReturn">$10,500</div>
                    <p style="color:var(--text-muted);">Profit: <span id="profitDisplay" style="color:#fff;">+$500</span>
                    </p>
                    <a href="{{route('platform.baskets')}}" class="btn btn-primary" style="margin-top: 30px; justify-content:center;">Stake
                        Now</a>
                </div>
            </div>
        </div>
    </section>
    <section class="crypto-table-section" id="crypto-prices">
        <div class="container">
            <h2>Live Crypto Prices</h2>
            <p class="section-subtitle">Track the performance of major crypto currencies in real-time</p>

            <!-- Search and Controls -->
            <div class="table-controls">
                {{-- <div class="search-container">
                    <input type="text" id="cryptoSearch" class="search-input" placeholder="Search crypto currencies...">
                </div> --}}
                {{-- <div class="search-container">
                    <span class="search-icon">🔍</span>
                    <input type="text" id="searchInput" class="search-input" placeholder="Search crypto currencies...">
                </div> --}}
                {{-- <div id="paginationControls" class="per-page-selector"
                    style="display: flex; gap: 8px; align-items: center;">
                    <button id="prevPageBtn" disabled>Previous</button>
                    <span id="pageInfo">Page 1 of 1</span>
                    <button id="nextPageBtn" disabled>Next</button>
                </div> --}}
            </div>

            <div class="table-container table-wrap">
                <div class="center" id="listLoading">Loading coins from CoinGecko...</div>


                <table class="table crypto-table" id="coinTable" style="display:none;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Symbol</th>
                            <th>Price</th>
                            <th>24h Change</th>
                            <th>Volume (24h)</th>
                            <th>Market Cap</th>
                        </tr>
                    </thead>
                    <tbody id="coinTableBody">
                        <!-- Table rows will be populated by JavaScript -->
                    </tbody>
                </table>
                <div id="noResults" class="no-results" style="display: none;">
                    <p>No cryptocurrencies found matching your search.</p>
                </div>

                <!-- Show More Button -->
            </div>
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{route('platform.markets')}}" class="btn btn-primary">Show More</a>
            </div>

        </div>
    </section>

    <section class="how-it-works-section">
        <div class="container">
            <div class="section-header">
                <h2 class="text-gradient">How Vcoins Works</h2>
                <p style="color:var(--text-muted); max-width:600px; margin: 0 auto;">Our intelligent system simplifies
                    the complex DeFi landscape to maximize your yield safely.</p>
            </div>

            <div class="steps-grid">
                <div class="step-item">
                    <div class="step-icon"><i class="fa-solid fa-wallet"></i></div>
                    <h3>1. Deposit</h3>
                    <p>Connect your wallet and deposit an asset (e.g., USDC, ETH) into a Vcoins Smart Basket.</p>
                </div>

                <div class="step-item">
                    <div class="step-icon"><i class="fa-solid fa-robot"></i></div>
                    <h3>2. AI Strategy</h3>
                    <p>Our AI automatically finds the best-audited yield farms, staking, and lending protocols.</p>
                </div>

                <div class="step-item">
                    <div class="step-icon"><i class="fa-solid fa-arrow-up-right-dots"></i></div>
                    <h3>3. Auto-Compound</h3>
                    <p>Your yield is harvested and reinvested back into the basket, automatically compounding your
                        returns.</p>
                </div>

                <div class="step-item">
                    <div class="step-icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                    <h3>4. Withdraw Anytime</h3>
                    <p>Withdraw your principal and earned yield back to your wallet at any time, with no lock-ins.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="learn-section" id="academy">
        <div class="container">
            <div class="section-header">
                <h2>Learn & Earn Rewards</h2>
                <p style="color:var(--text-muted); max-width:500px; margin: 0 auto;">Complete short lessons about crypto
                    concepts and earn token rewards instantly.</p>
            </div>

            <div class="course-grid">
                <div class="course-card">
                    <div class="course-image">
                        <div class="reward-tag"> $5 VCN</div>
                        <i class="fa-brands fa-bitcoin"></i>
                    </div>
                    <div class="course-content">
                        <h3>Intro to Bitcoin</h3>
                        <p>Understand the history of money and how blockchain solves the double-spend problem.</p>
                        {{-- <a href="#" class="btn btn-outline"
                            style="width:100%; justify-content:center; font-size:0.9rem;">Start Lesson</a> --}}
                    </div>
                </div>

                <div class="course-card">
                    <div class="course-image">
                        <div class="reward-tag"> $10 VCN</div>
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div class="course-content">
                        <h3>DeFi Liquidity Pools</h3>
                        <p>Learn how Automated Market Makers (AMMs) work and how to earn yield as a provider.</p>
                        {{-- <a href="#" class="btn btn-outline"
                            style="width:100%; justify-content:center; font-size:0.9rem;">Start Lesson</a> --}}
                    </div>
                </div>

                <div class="course-card">
                    <div class="course-image">
                        <div class="reward-tag"> NFT Badge</div>
                        <i class="fa-solid fa-fingerprint"></i>
                    </div>
                    <div class="course-content">
                        <h3>Wallet Security 101</h3>
                        <p>Essential tips for keeping your private keys safe and avoiding phishing scams.</p>
                        {{-- <a href="#" class="btn btn-outline"
                            style="width:100%; justify-content:center; font-size:0.9rem;">Start Lesson</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="hero-section">
        <div class="hero-container">

            <div class="hero-left">
                <img src="{{ asset('images/countdown-img.svg') }}" alt="Crypto Illustration" class="hero-img">
            </div>

            <div class="hero-right">

                {{-- <div class="countdown">
                    <div class="time-box">
                        <h2>89</h2>
                        <p>DAYS</p>
                    </div>
                    <div class="time-box">
                        <h2>21</h2>
                        <p>HOUR</p>
                    </div>
                    <div class="time-box">
                        <h2>15</h2>
                        <p>MINS</p>
                    </div>
                    <div class="time-box">
                        <h2>48</h2>
                        <p>SECS</p>
                    </div>
                </div> --}}

                <h1 class="hero-title">
                    Smart and Secure Way to<br>Invest in Crypto
                </h1>

                <p class="hero-description">
                    Create a personalized crypto basket with top-performing assets. Diversify your holdings, manage risk effectively, and invest in the future of digital finance with confidence.
                </p>

                <a href="{{route('platform.baskets')}}" class="hero-btn">Buy Now</a>

            </div>

        </div>
    </section>

    <section class="roadmap-section" id="roadmap">
        <div class="container">
            <div style="text-align: center; margin-bottom: 30px;">
                <span class="roadmap-badge">ROADMAP</span>
            </div>
            <h2 class="roadmap-heading">
                Our <span class="highlight">strategy</span> & Planning
            </h2>

            <div class="roadmap-timeline">
                <div class="timeline-line"></div>
                <div class="timeline-items">
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <img src="https://themeadapt.com/tf/webze/assets/img/icon/roadmap_icon01.png" alt="2014">
                        </div>
                        <div class="timeline-year">2014</div>
                        <div class="timeline-description">Definitions of key terms in cryptocurrency</div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <img src="https://themeadapt.com/tf/webze/assets/img/icon/roadmap_icon02.png" alt="2017">
                        </div>
                        <div class="timeline-year">2017</div>
                        <div class="timeline-description">Automated tools for executing strategies</div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <img src="https://themeadapt.com/tf/webze/assets/img/icon/roadmap_icon03.png" alt="2022">
                        </div>
                        <div class="timeline-year">2022</div>
                        <div class="timeline-description">APIs for developers to build custom tools</div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <img src="https://themeadapt.com/tf/webze/assets/img/icon/roadmap_icon04.png" alt="2025">
                        </div>
                        <div class="timeline-year">2025</div>
                        <div class="timeline-description">A space for users to discuss trends</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <h2>Trusted by the Community</h2>
                <p style="color:var(--text-muted); max-width:500px; margin: 0 auto;">Don't just take our word for it.
                    Hear from our users who are growing their wealth.</p>
            </div>

            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fa-solid fa-quote-left"></i></div>
                    <p>“Vcoins is a game changer. The 12% stablecoin APY is fantastic, and the automated rebalancing
                        gives me peace of mind. Truly set-and-forget DeFi.”</p>
                    <div class="author-meta">
                        <div class="author-avatar">J.D.</div>
                        <div class="author-details">
                            <p>Jane Doe</p>
                            <span>Verified Investor</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fa-solid fa-quote-left"></i></div>
                    <p>“The Learn & Earn academy is brilliant! I got paid to understand liquidity pools. It's the
                        perfect platform for new users to start their journey.”</p>
                    <div class="author-meta">
                        <div class="author-avatar">A.S.</div>
                        <div class="author-details">
                            <p>Alex Sun</p>
                            <span>Crypto Newbie</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fa-solid fa-quote-left"></i></div>
                    <p>“As an advanced user, I appreciate the transparency of the DAO. Being able to vote on new chain
                        integrations is a massive plus for decentralization.”</p>
                    <div class="author-meta">
                        <div class="author-avatar">M.R.</div>
                        <div class="author-details">
                            <p>Mark Rivers</p>
                            <span>DeFi Engineer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="faq-section-container">

        <section class="faq-section">
            <h2>Frequently Asked Questions</h2>

            <!-- FAQ Item -->
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
        /* ===================== CONFIG ===================== */
        const COINGECKO_URL =
            'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=10&page=1&sparkline=false';

        // Using the 24hr ticker stream for ALL symbols
        const BINANCE_WS = 'wss://stream.binance.com:9443/ws/!ticker@arr';
        const SUFFIXES = ['USDT', 'BUSD']; // Prioritized stablecoin pairs

        /* ===================== STATE ===================== */
        let coins = []; // Array of CoinGecko objects (used for filtering/pagination)
        let coinIndexBySymbol = {}; // Map for CoinGecko metadata access: { "BTC": {...} }
        let liveTickers = {}; // Map for live Binance data: { "BTCUSDT": {...} }
        let searchTerm = "";
        let currentPage = 1;
        const coinsPerPage = 20;

        /* ===================== DOM ===================== */
        const tbody = document.getElementById('coinTableBody');
        const table = document.getElementById('coinTable');
        const listLoadingEl = document.getElementById('listLoading');

        // DOM elements for search and pagination
        // const searchInput = document.getElementById('searchInput');
        // const prevPageBtn = document.getElementById('prevPageBtn');
        // const nextPageBtn = document.getElementById('nextPageBtn');
        // const pageInfoEl = document.getElementById('pageInfo');


        /* ===================== UTIL ===================== */
        /**
         * Formats large numbers with B (Billion) or T (Trillion) suffix.
         */
        function fmtNumber(n) {
            if (!n || isNaN(n)) return '—';
            const num = Number(n);
            // if (num >= 1e12) return (num / 1e12).toFixed(2) + 'T';
            // if (num >= 1e9) return (num / 1e9).toFixed(2) + 'B';
            // if (num >= 1e6) return (num / 1e6).toFixed(2) + 'M';
            // return num.toLocaleString();

            return (num / 1e9).toFixed(2) + 'B';
        }

        /**
         * Formats price with dollar sign and appropriate precision.
         */
        function fmtPrice(p) {
            if (!p || isNaN(p)) return '—';
            const price = Number(p);
            return price >= 1 ? '$' + price.toLocaleString(undefined, {
                    maximumFractionDigits: 2
                }) :
                '$' + price.toPrecision(6);
        }

        /**
         * Formats percentage with color coding.
         */
        function pct(v) {
            if (v === null || v === undefined || isNaN(v)) return '—';
            const val = Number(v);
            const p = val.toFixed(2) + '%';
            return val >= 0 ? `<span class="change up">${p}</span>` :
                `<span class="change down">${p}</span>`;
        }

        /**
         * Attempts to find the best Binance pair symbol (e.g., BTCUSDT, BTCEUR, etc.)
         */
        function findBinanceSymbol(sym) {
            for (const s of SUFFIXES) {
                const x = sym + s;
                if (liveTickers[x]) return x;
            }
            // Default to USDT, even if not found yet, as it's the most common
            return sym + "USDT";
        }

        /* ===================== FETCH CoinGecko ===================== */
        async function loadCoins() {
            try {
                const res = await fetch(COINGECKO_URL);
                if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);

                coins = await res.json();

                // Create a quick lookup map for CoinGecko data
                coins.forEach(c => {
                    const s = c.symbol.toUpperCase();
                    // Avoid overwriting if a symbol appears multiple times (unlikely here)
                    if (!coinIndexBySymbol[s]) coinIndexBySymbol[s] = c;
                });

                renderTable(); // Initial render with CoinGecko data
            } catch (error) {
                console.error("Error loading coins from CoinGecko:", error);
                listLoadingEl.textContent = "Error loading initial data. Please check the console.";
            }
        }

        /* ===================== RENDER TABLE ===================== */
        function renderTable() {
            listLoadingEl.style.display = 'none';
            table.style.display = 'table';
            tbody.innerHTML = '';

            // 1. FILTER: Apply the search term
            const lowerSearchTerm = searchTerm.toLowerCase();
            const filteredCoins = coins.filter(c =>
                c.name.toLowerCase().includes(lowerSearchTerm) ||
                c.symbol.toLowerCase().includes(lowerSearchTerm)
            );

            // // 2. PAGINATION: Calculate page details
            // const totalPages = Math.ceil(filteredCoins.length / coinsPerPage);

            // // Boundary checks for current page
            // if (currentPage > totalPages && totalPages > 0) {
            //     currentPage = totalPages;
            // } else if (totalPages === 0) {
            //     currentPage = 1;
            // }

            // const startIndex = (currentPage - 1) * coinsPerPage;
            // const endIndex = startIndex + coinsPerPage;

            // // 3. SLICE: Get only the coins for the current page
            const coinsToDisplay = filteredCoins.slice(0, 10);

            // 4. RENDER ROWS
            coinsToDisplay.forEach(c => {
                const s = c.symbol.toUpperCase();
                const tr = document.createElement('tr');
                tr.dataset.symbol = s;
                const priceChangeClass = c.price_change_percentage_24h >= 0 ? 'text-success' : 'text-danger';

                // Initial data comes from CoinGecko
                tr.innerHTML = `
                    <td class="coin-name-col"><img class="coin-logo" src="${c.image}" alt="${c.name} icon"><strong>${c.name}</strong></td>
                    <td data-symbol-id="${s}">${s}</td>

                    <td data-price-id="${s}" class="price">${fmtPrice(c.current_price)}</td>
                    <td data-change-id="${s}" class="${priceChangeClass}">${pct(c.price_change_percentage_24h)}</td>
                    <td data-volume-id="${s}">${fmtNumber(c.total_volume)}</td>
                    <td>${fmtNumber(c.market_cap)}</td>
                `;
                //set tr as link that redirect to coin details page
                tr.style.cursor = 'pointer';
                tr.addEventListener('click', () => {
                    window.location.href = `/coin/${s}`;
                });

                tbody.appendChild(tr);
            });

            // 5. UPDATE PAGINATION CONTROLS
            updatePaginationControls(totalPages);

            // Crucial: After rendering the table, immediately update the cells 
            // with any available live ticker data.
            updateTableCells();
        }

        /* ===================== LIVE UPDATE (WS) ===================== */
        function setupWS() {
            const ws = new WebSocket(BINANCE_WS);

            ws.onmessage = e => {
                const arr = JSON.parse(e.data);
                if (!Array.isArray(arr)) return;

                // Update the master liveTickers map
                arr.forEach(t => liveTickers[t.s] = t);

                // No need to re-render the whole table, just update the cells
                updateTableCells();
            };

            ws.onclose = () => {
                console.log("WebSocket closed. Attempting reconnect in 3s...");
                setTimeout(setupWS, 3000);
            }

            ws.onerror = (error) => {
                console.error("WebSocket error:", error);
                ws.close();
            }
        }

        /* ===================== UPDATE TABLE CELLS ===================== */
        /**
         * Updates visible table cells based on the liveTickers map.
         * This function is called frequently by the WS onmessage handler.
         */
        function updateTableCells() {
            // Iterate over all coins that are currently displayed in the table
            document.querySelectorAll('#coinTableBody tr').forEach(row => {
                const s = row.dataset.symbol; // e.g., "BTC"

                // 1. Find the corresponding Binance symbol (e.g., "BTCUSDT")
                const binSym = findBinanceSymbol(s);
                const t = liveTickers[binSym]; // Live ticker data

                if (!t) return; // No live data available yet for this coin

                // 2. Locate and update the cells
                const p = row.querySelector(`[data-price-id="${s}"]`);
                const pc = row.querySelector(`[data-change-id="${s}"]`);
                const pv = row.querySelector(`[data-volume-id="${s}"]`);

                if (p) {
                    const newPrice = Number(t.c);
                    const newChangeP = Number(t.P);
                    const newVolume = Number(t.q);

                    // --- Apply Live Updates ---

                    // Price
                    p.textContent = fmtPrice(newPrice);

                    // 24h Change (%)
                    pc.innerHTML = pct(newChangeP);

                    // Volume (t.q is quote volume in USDT/BUSD)
                    pv.textContent = fmtNumber(newVolume);

                    // --- Optional Price Flash Effect ---
                    // if (p.lastPrice !== newPrice) {
                    //     const isUp = newPrice > (p.lastPrice || 0);
                    //     p.style.backgroundColor = isUp ? '#ddffdd' : '#ffdddd';
                    //     setTimeout(() => {
                    //         p.style.backgroundColor = 'transparent';
                    //     }, 100);
                    //     p.lastPrice = newPrice;
                    // }
                }
            });
        }

        /* ===================== PAGINATION/SEARCH LOGIC ===================== */

        function updatePaginationControls(totalPages) {
            pageInfoEl.textContent = `Page ${currentPage} of ${totalPages || 1}`;

            prevPageBtn.disabled = currentPage === 1 || totalPages === 0;
            nextPageBtn.disabled = currentPage >= totalPages;
        }

        function handleSearch(event) {
            searchTerm = event.target.value.trim();
            currentPage = 1;
            renderTable(); // Re-render table on search/filter change
        }

        function changePage(direction) {
            currentPage += direction;
            renderTable();
            document.querySelector('.table-wrap').scrollTop = 0; // Scroll to top of table
        }

        /* ===================== INIT ===================== */

        // searchInput.addEventListener('input', handleSearch);
        // prevPageBtn.addEventListener('click', () => changePage(-1));
        // nextPageBtn.addEventListener('click', () => changePage(1));

        // Start by loading static CoinGecko data
        loadCoins();

        // Setup WebSocket for live updates
        setupWS();
    </script>
    <script>
        // Default APY
        let currentAPY = 0.05;

        const amountSlider = document.getElementById('amountSlider');
        const timeSlider = document.getElementById('timeSlider');
        const amountDisplay = document.getElementById('amountDisplay');
        const timeDisplay = document.getElementById('timeDisplay');
        const totalReturn = document.getElementById('totalReturn');
        const profitDisplay = document.getElementById('profitDisplay');

        function updateCalculator() {
            const principal = parseFloat(amountSlider.value);
            const months = parseFloat(timeSlider.value);

            // Format displays
            amountDisplay.innerText = '$' + principal.toLocaleString();
            timeDisplay.innerText = months + ' Months';

            // Simple Compound Interest Calculation (Monthly compounding)
            // A = P(1 + r/n)^(nt)
            // r = APY, n = 12, t = months/12
            const ratePerPeriod = currentAPY / 12;
            const total = principal * Math.pow((1 + ratePerPeriod), months);
            const profit = total - principal;

            totalReturn.innerText = '$' + Math.floor(total).toLocaleString();
            profitDisplay.innerText = '+$' + Math.floor(profit).toLocaleString();
        }

        // Change APY when clicking buttons
        function setAPY(rate, btnElement) {
            currentAPY = rate;

            // Reset button styles
            document.querySelectorAll('.calc-input-group .btn-outline').forEach(b => {
                b.style.borderColor = 'var(--border)';
                b.style.color = 'white';
            });

            // Highlight active
            btnElement.style.borderColor = 'var(--primary)';
            btnElement.style.color = 'var(--primary)';

            updateCalculator();
        }

        // Event Listeners
        amountSlider.addEventListener('input', updateCalculator);
        timeSlider.addEventListener('input', updateCalculator);

        // Initialize
        updateCalculator();

        // FAQ
        document.querySelectorAll(".faq-item").forEach(item => {
            item.querySelector(".faq-header").addEventListener("click", () => {
                const openItem = document.querySelector(".faq-item.active");
                if (openItem && openItem !== item) {
                    openItem.classList.remove("active");
                }
                item.classList.toggle("active");
            });
        });
    </script>
@endsection
