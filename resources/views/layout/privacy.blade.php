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

        .privacy-hero {
            padding: 140px 0 0px;
            background: var(--bg-dark);
        }

        .privacy-hero-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 60px;
        }

        .privacy-hero-content {
            flex: 1;
            text-align: center;
        }

        .privacy-hero-title {
            font-size: 4.5rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .privacy-hero-subtitle {
            font-size: 1.5rem;
            color: var(--text-muted);
            margin-bottom: 24px;
        }

        .privacy-hero-description {
            font-size: 1.1rem;
            color: var(--text-muted);
            line-height: 1.8;
        }

        .privacy-hero-graphic {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .lock-icon {
            width: 300px;
            height: 300px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lock-body {
            width: 200px;
            height: 200px;
            border: 4px solid var(--text-muted);
            border-radius: 20px;
            position: relative;
            background: var(--bg-card);
        }

        .lock-shackle {
            width: 120px;
            height: 80px;
            border: 4px solid var(--text-muted);
            border-bottom: none;
            border-radius: 60px 60px 0 0;
            position: absolute;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
        }

        .lock-keyhole {
            width: 40px;
            height: 40px;
            border: 3px solid var(--primary);
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .lock-keyhole::after {
            content: '';
            width: 20px;
            height: 30px;
            background: var(--primary);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 0 0 10px 10px;
        }

        .small-icons {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .small-icon {
            position: absolute;
            width: 40px;
            height: 40px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 1.2rem;
        }

        .icon-1 {
            top: 10%;
            left: 10%;
        }

        .icon-2 {
            top: 20%;
            right: 15%;
        }

        .icon-3 {
            bottom: 15%;
            left: 15%;
        }

        .icon-4 {
            bottom: 10%;
            right: 10%;
        }

        .section {
            padding: 80px 0;
            background: var(--bg-dark);
        }

        .section-alt {
            background: #0f0f15;
        }

        .section-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 48px;
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .principles-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .principle-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 32px;
            backdrop-filter: var(--glass);
            transition: all 0.3s ease;
        }

        .principle-card:hover {
            background: var(--bg-card-hover);
            transform: translateY(-4px);
        }

        .principle-icon {
            width: 48px;
            height: 48px;
            background: var(--gradient-bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: var(--primary);
        }

        .principle-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 12px;
            color: var(--text-main);
        }

        .principle-description {
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .principle-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .principle-link:hover {
            color: var(--accent);
            gap: 12px;
        }

        .tabs-section {
            margin-top: 60px;
        }

        .tabs-nav {
            display: flex;
            gap: 8px;
            margin-bottom: 32px;
            flex-wrap: wrap;
            border-bottom: 1px solid var(--border);
            padding-bottom: 16px;
        }

        .tab-link {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .tab-link:hover {
            color: var(--text-main);
            background: var(--bg-card);
        }

        .tab-link.active {
            color: var(--primary);
            background: var(--gradient-bg);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 60px;
            align-items: center;
        }

        .tab-content.reverse {
            grid-template-columns: 1fr 2fr;
        }

        .tab-content.reverse .tab-subsection {
            order: 2;
        }

        .tab-content.reverse>div:last-child {
            order: 1;
        }

        .tab-content-image img {
            width: 100%;
            max-width: 500px;
            height: auto;
        }

        .tab-subsection {
            margin-bottom: 40px;
        }

        .tab-subtitle {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 16px;
            color: var(--text-main);
        }

        .tab-description {
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 24px;
        }

        .data-icons {
            display: flex;
            gap: 16px;
            margin-top: 24px;
        }

        .data-icon {
            width: 60px;
            height: 60px;
            background: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-size: 1.5rem;
        }

        .privacy-notice-btn {
            background: var(--primary);
            color: #000;
            padding: 14px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            margin-top: 24px;
            transition: all 0.3s ease;
        }

        .privacy-notice-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(0, 224, 255, 0.5);
            background: #33eaff;
        }

        .rights-accordion {
            margin-top: 40px;
        }

        .rights-item {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            margin-bottom: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .rights-item.active {
            background: var(--bg-card-hover);
        }

        .rights-question {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            cursor: pointer;
            user-select: none;
        }

        .rights-icon {
            width: 24px;
            height: 24px;
            background: var(--primary);
            color: #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            flex-shrink: 0;
            transition: transform 0.3s ease;
            line-height: 1;
        }

        .rights-item.active .rights-icon {
            transform: rotate(45deg);
        }

        .rights-question-text {
            flex: 1;
            font-weight: 600;
            color: var(--text-main);
        }

        .rights-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease, padding 0.4s ease;
            padding: 0 24px;
        }

        .rights-item.active .rights-answer {
            max-height: 500px;
            padding: 0 24px 24px 64px;
        }

        .rights-answer-content {
            color: var(--text-muted);
            line-height: 1.8;
        }

        .rights-answer-content a {
            color: var(--primary);
            text-decoration: none;
        }

        .rights-answer-content a:hover {
            text-decoration: underline;
        }

        .rights-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 24px;
        }

        .rights-link:hover {
            color: var(--accent);
        }

        .dpo-section {
            padding: 0px 0 60px;
            background: var(--bg-dark);
        }

        .dpo-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .dpo-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0;
            color: var(--text-main);
            text-align: left;
        }

        .dpo-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .dpo-text {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .dpo-question {
            font-size: 1.25rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 0;
            color: var(--text-main);
            line-height: 1.4;
        }

        .dpo-contact {
            font-size: 1.1rem;
            color: var(--primary);
            margin-bottom: 0;
        }

        .dpo-contact a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .dpo-contact a:hover {
            text-decoration: underline;
        }

        .dpo-graphic {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .laptop-icon {
            width: 300px;
            height: 200px;
            background: #2a2f3a;
            border: 2px solid var(--border);
            border-radius: 12px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .laptop-screen {
            width: 85%;
            height: 75%;
            background: #1a1a2e;
            border-radius: 6px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .laptop-diamond {
            width: 40px;
            height: 40px;
            background: #8F9BB3;
            transform: rotate(45deg);
            border-radius: 4px;
        }

        .chat-bubble {
            width: 100px;
            height: 70px;
            background: var(--primary);
            border-radius: 12px;
            position: absolute;
            top: -50px;
            left: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            box-shadow: 0 0 30px rgba(0, 224, 255, 0.5);
        }

        .chat-bubble::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 20px;
            width: 0;
            height: 0;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            border-top: 8px solid var(--primary);
        }

        .chat-line {
            width: 30px;
            height: 3px;
            background: #000;
            border-radius: 2px;
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

        @media (max-width: 1200px) {
            .section-container {
                padding: 0 32px;
            }

            .privacy-hero-container {
                padding: 0 32px;
            }
        }

        @media (max-width: 992px) {
            .principles-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .privacy-hero-container {
                flex-direction: column;
                text-align: center;
                gap: 40px;
            }

            .privacy-hero-title {
                font-size: 2.8rem;
            }

            .privacy-hero-subtitle {
                font-size: 1.3rem;
            }

            .privacy-hero-description {
                max-width: 100%;
            }

            .section {
                padding: 80px 0;
            }

            .section-title {
                font-size: 2.2rem;
                margin-bottom: 40px;
            }

            .dpo-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .dpo-text {
                text-align: center;
            }

            .dpo-title {
                text-align: center;
                font-size: 2.2rem;
            }

            .dpo-question {
                font-size: 1.1rem;
            }

            .laptop-icon {
                width: 250px;
                height: 170px;
            }

            .tab-content.active {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .tab-content-image {
                text-align: center;
            }
        }

        @media (max-width: 890px) {

            .nav-links,
            .nav-actions {
                display: none;
            }

            .menu-toggle {
                display: inline-flex;
            }

            .privacy-hero {
                padding: 120px 0 0px;
            }

            .privacy-hero-title {
                font-size: 2.2rem;
                margin-bottom: 12px;
            }

            .privacy-hero-subtitle {
                font-size: 1.1rem;
                margin-bottom: 20px;
            }

            .privacy-hero-description {
                font-size: 1rem;
            }

            .section {
                padding: 60px 0;
            }

            .section-title {
                font-size: 1.8rem;
                margin-bottom: 32px;
            }

            .principle-card {
                padding: 24px;
            }

            .principle-title {
                font-size: 1.1rem;
            }

            .principle-description {
                font-size: 0.95rem;
            }

            .tabs-nav {
                flex-direction: column;
                gap: 8px;
            }

            .tab-link {
                width: 100%;
                text-align: left;
                padding: 12px 16px;
            }

            .tab-subtitle {
                font-size: 1.3rem;
            }

            .tab-description {
                font-size: 0.95rem;
            }

            .privacy-notice-btn {
                padding: 12px 24px;
                font-size: 0.95rem;
                width: 100%;
                justify-content: center;
            }

            .rights-question {
                padding: 16px 20px;
                gap: 12px;
            }

            .rights-question-text {
                font-size: 0.95rem;
            }

            .rights-answer-content {
                font-size: 0.9rem;
            }

            .rights-item.active .rights-answer {
                padding: 0 20px 20px 56px;
            }

            .dpo-section {
                padding: 0px 0 50px;
            }

            .dpo-title {
                font-size: 1.8rem;
                margin-bottom: 24px;
            }

            .dpo-question {
                font-size: 1rem;
                line-height: 1.5;
            }

            .dpo-contact {
                font-size: 1rem;
            }

            .laptop-icon {
                width: 200px;
                height: 140px;
            }

            .chat-line {
                width: 24px;
                height: 2px;
            }

            .tab-content.reverse .tab-subsection {
                order: 1;
            }

            .tab-content.reverse>div:last-child {
                order: 2;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 0 16px;
            }

            .section-container {
                padding: 0 16px;
            }

            .privacy-hero-container {
                padding: 0 16px;
            }

            .privacy-hero {
                padding: 110px 0 0px;
            }



            .privacy-hero-subtitle {
                font-size: 1rem;
            }

            .privacy-hero-description {
                font-size: 0.9rem;
            }

            .section {
                padding: 50px 0;
            }

            .section-title {
                font-size: 1.5rem;
                margin-bottom: 24px;
            }

            .principle-card {
                padding: 20px;
            }

            .principle-icon {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
                margin-bottom: 16px;
            }

            .principle-title {
                font-size: 1rem;
                margin-bottom: 10px;
            }

            .principle-description {
                font-size: 0.9rem;
                margin-bottom: 12px;
            }

            .principle-link {
                font-size: 0.9rem;
            }

            .tabs-section {
                margin-top: 40px;
            }

            .tabs-nav {
                margin-bottom: 24px;
                padding-bottom: 12px;
            }

            .tab-subtitle {
                font-size: 1.1rem;
                margin-bottom: 12px;
            }

            .tab-description {
                font-size: 0.9rem;
                margin-bottom: 20px;
            }

            .rights-question {
                padding: 14px 16px;
            }

            .rights-icon {
                width: 20px;
                height: 20px;
                font-size: 1rem;
            }

            .rights-question-text {
                font-size: 0.9rem;
            }

            .rights-item.active .rights-answer {
                padding: 0 16px 16px 48px;
            }

            .rights-answer-content {
                font-size: 0.85rem;
            }

            .dpo-container {
                gap: 8px;
            }

            .dpo-title {
                font-size: 1.5rem;
                margin-bottom: 20px;
            }

            .dpo-question {
                font-size: 0.9rem;
                margin-bottom: 16px;
            }

            .dpo-contact {
                font-size: 0.9rem;
            }

            .dpo-graphic {
                margin-top: 30px;
            }

            .laptop-icon {
                width: 180px;
                height: 120px;
            }

            .chat-bubble {
                width: 70px;
                height: 50px;
                top: -35px;
                left: 15px;
            }

            .chat-line {
                width: 20px;
            }

            .lock-icon {
                width: 250px;
                height: 250px;
            }

            .lock-icon img {
                width: 100%;
                height: auto;
            }
        }

        @media (max-width: 989px) {
            .lock-icon img {
                width: 100%;
                height: 100%;
            }

            .chat-bubble {
                width: 62px;
                height: 47px;
                top: -26px;
            }
        }
    </style>
@endsection

@section('content')
    <section class="privacy-hero">
        <div class="privacy-hero-container">
            <div class="privacy-hero-content">
                <h1 class="privacy-hero-title">Vcoins <span class="text-gradient">Privacy </span>Portal</h1>
                <p class="privacy-hero-subtitle">Our commitment to protecting your data</p>
                <p class="privacy-hero-description">
                    At Vcoins, we take your privacy seriously. This portal is designed to help you understand how we
                    collect, use, and safeguard your personal information. We are committed to transparency, security,
                    and giving you control over your data.
                </p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-container">
            <h2 class="section-title">Vcoins's Privacy Principles</h2>
            <div class="principles-grid">
                <div class="principle-card">
                    <div class="principle-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="principle-title">Transparency at All Times</h3>
                    <p class="principle-description">
                        We believe in clear, honest communication about how we handle your data. Our privacy policies
                        are written in plain language, and we regularly update you about any changes to our practices.
                    </p>
                    <a href="#" class="principle-link">Check our Privacy Notice <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="principle-card">
                    <div class="principle-icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h3 class="principle-title">Accountability and Compliance</h3>
                    <p class="principle-description">
                        We adhere to international data protection regulations including GDPR, CCPA, and other
                        applicable laws. Our compliance team ensures we meet the highest standards of data protection.
                    </p>
                    <a href="#" class="principle-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="principle-card">
                    <div class="principle-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3 class="principle-title">Data Security</h3>
                    <p class="principle-description">
                        Your data is protected with industry-leading encryption, secure servers, and regular security
                        audits. We employ multiple layers of security to keep your information safe from unauthorized
                        access.
                    </p>
                    <a href="#" class="principle-link">Check our Privacy Notice <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="principle-card">
                    <div class="principle-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h3 class="principle-title">User Control</h3>
                    <p class="principle-description">
                        You have the right to access, modify, or delete your personal data at any time. Our platform
                        provides easy-to-use tools for managing your privacy preferences and data.
                    </p>
                    <a href="#" class="principle-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="principle-card">
                    <div class="principle-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="principle-title">Minimal Data Collection</h3>
                    <p class="principle-description">
                        We only collect the data necessary to provide you with our services. We don't sell your personal
                        information to third parties, and we minimize data collection wherever possible.
                    </p>
                    <a href="#" class="principle-link">Check our Privacy Notice <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="principle-card">
                    <div class="principle-icon">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <h3 class="principle-title">Continuous Improvement</h3>
                    <p class="principle-description">
                        We regularly review and update our privacy practices to ensure they meet the highest standards.
                        We listen to user feedback and continuously improve our data protection measures.
                    </p>
                    <a href="#" class="principle-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-container">
            <h2 class="section-title">How Vcoins uses your data</h2>
            <div class="tabs-section">
                <div class="tabs-nav">
                    <a href="#" class="tab-link active" data-tab="personal-data">What is Personal Data?</a>
                    <a href="#" class="tab-link" data-tab="using-data">Using your Data</a>
                    <a href="#" class="tab-link" data-tab="retention">Retention of your Data</a>
                    <a href="#" class="tab-link" data-tab="sharing">Data Sharing with third parties</a>
                    <a href="#" class="tab-link" data-tab="cookies">Cookies and other Identifiers</a>
                </div>

                <div id="personal-data" class="tab-content active">
                    <div class="tab-content-image">
                        <img src="{{ asset('images/privacy_data_1.svg') }}" alt="privacy_data_1">
                    </div>
                    <div class="tab-subsection">
                        <h3 class="tab-subtitle">Definition of personal data</h3>
                        <p class="tab-description">
                            Personal data refers to any information that can be used to identify you directly or
                            indirectly. This includes, but is not limited to, your name, Vcoins ID, email address, phone
                            number, location data, IP address, transaction history, and any other information you
                            provide when using our platform.
                        </p>
                        <a href="#" class="privacy-notice-btn">Check our full Privacy Notice</a>
                    </div>
                </div>

                <div id="using-data" class="tab-content">
                    <div class="tab-content-image">
                        <img src="{{ asset('images/privacy_data_2.svg') }}" alt="privacy_data_2">
                    </div>
                    <div class="tab-subsection">
                        <h3 class="tab-subtitle">How we use your data</h3>
                        <p class="tab-description">
                            We use your personal data to provide, maintain, and improve our services, process
                            transactions, verify your identity, communicate with you, and ensure platform security. We
                            also use data for analytics and to comply with legal obligations.
                        </p>
                        <a href="#" class="privacy-notice-btn">Check our full Privacy Notice</a>
                    </div>
                </div>

                <div id="retention" class="tab-content">
                    <div class="tab-content-image">
                        <img src="{{ asset('images/privacy_data_3.svg') }}" alt="privacy_data_3">
                    </div>
                    <div class="tab-subsection">
                        <h3 class="tab-subtitle">Data retention</h3>
                        <p class="tab-description">
                            We retain your personal data only for as long as necessary to fulfill the purposes outlined
                            in our Privacy Notice, comply with legal obligations, resolve disputes, and enforce our
                            agreements. Retention periods vary based on the type of data and legal requirements.
                        </p>
                        <a href="#" class="privacy-notice-btn">Check our full Privacy Notice</a>
                    </div>
                </div>

                <div id="sharing" class="tab-content">
                    <div class="tab-content-image">
                        <img src="{{ asset('images/privacy_data_4.svg') }}" alt="privacy_data_4">
                    </div>
                    <div class="tab-subsection">
                        <h3 class="tab-subtitle">Third-party data sharing</h3>
                        <p class="tab-description">
                            We may share your data with trusted service providers who assist us in operating our
                            platform, processing transactions, or providing customer support. We ensure all third
                            parties adhere to strict data protection standards and only use your data for specified
                            purposes.
                        </p>
                        <a href="#" class="privacy-notice-btn">Check our full Privacy Notice</a>
                    </div>
                </div>

                <div id="cookies" class="tab-content reverse">
                    <div class="tab-content-image">
                        <img src="{{ asset('images/privacy_data_5.svg') }}" alt="privacy_data_5">
                    </div>
                    <div class="tab-subsection">
                        <h3 class="tab-subtitle">Cookies and identifiers</h3>
                        <p class="tab-description">
                            We use cookies, web beacons, and similar technologies to enhance your experience, analyze
                            usage patterns, and provide personalized content. You can manage your cookie preferences
                            through your browser settings or our privacy dashboard.
                        </p>
                        <a href="#" class="privacy-notice-btn">Check our full Privacy Notice</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-container">
            <h2 class="section-title">Exercising your Privacy Rights</h2>
            <div class="rights-accordion">
                <div class="rights-item active">
                    <div class="rights-question">
                        <div class="rights-icon">+</div>
                        <div class="rights-question-text">What rights do I have?</div>
                    </div>
                    <div class="rights-answer">
                        <div class="rights-answer-content">
                            You have several rights regarding your personal data, including the right to access,
                            rectify, erase, restrict processing, data portability, and object to processing. You also
                            have the right to withdraw consent at any time where processing is based on consent.
                        </div>
                    </div>
                </div>

                <div class="rights-item">
                    <div class="rights-question">
                        <div class="rights-icon">+</div>
                        <div class="rights-question-text">How do I access my data and get a copy of it?</div>
                    </div>
                    <div class="rights-answer">
                        <div class="rights-answer-content">
                            You can request a copy of your personal data by logging into your account and accessing the
                            Privacy Center, or by contacting our support team. We will provide your data in a
                            structured, commonly used format within 30 days of your request.
                        </div>
                    </div>
                </div>

                <div class="rights-item">
                    <div class="rights-question">
                        <div class="rights-icon">+</div>
                        <div class="rights-question-text">Can I delete my account?</div>
                    </div>
                    <div class="rights-answer">
                        <div class="rights-answer-content">
                            Yes, you can request account deletion at any time through your account settings or by
                            contacting support. Please note that some data may be retained for legal or regulatory
                            compliance purposes, but will not be used for any other purpose.
                        </div>
                    </div>
                </div>

                <div class="rights-item">
                    <div class="rights-question">
                        <div class="rights-icon">+</div>
                        <div class="rights-question-text">What support does Vcoins offer to help me exercise my rights?
                        </div>
                    </div>
                    <div class="rights-answer">
                        <div class="rights-answer-content">
                            Vcoins provides comprehensive support through our <a href="#">Privacy Center</a>, which
                            includes step-by-step guides and tools for managing your data. You can also contact our Data
                            Protection Officer via <a href="mailto:dpo@vcoins.co.in">email</a> for assistance with any
                            privacy-related requests or questions.
                        </div>
                    </div>
                </div>

                <div class="rights-item">
                    <div class="rights-question">
                        <div class="rights-icon">+</div>
                        <div class="rights-question-text">How can I opt out of or object to the processing for marketing
                            purposes?</div>
                    </div>
                    <div class="rights-answer">
                        <div class="rights-answer-content">
                            You can manage your marketing preferences in your account settings under "Communication
                            Preferences." You can opt out of marketing emails, push notifications, and other marketing
                            communications at any time.
                        </div>
                    </div>
                </div>

                <div class="rights-item">
                    <div class="rights-question">
                        <div class="rights-icon">+</div>
                        <div class="rights-question-text">How do I withdraw my consent?</div>
                    </div>
                    <div class="rights-answer">
                        <div class="rights-answer-content">
                            You can withdraw your consent at any time by updating your preferences in your account
                            settings or by contacting our support team. Withdrawing consent will not affect the
                            lawfulness of processing based on consent before its withdrawal.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="dpo-section">
        <div class="section-container">
            <div class="dpo-container">
                <h2 class="dpo-title">Contact the DPO team</h2>
                <div class="dpo-content">
                    <div class="dpo-text">
                        <p class="dpo-question">STILL HAVE QUESTIONS REGARDING YOUR PRIVACY AND DATA PROTECTION AT
                            VCOINS?</p>
                        <p class="dpo-contact">
                            <a href="mailto:dpo@vcoins.co.in">Click here to contact our DPO via email:
                                dpo@vcoins.co.in</a>
                        </p>
                    </div>
                    <div class="dpo-graphic">
                        <div class="laptop-icon">
                            <div class="laptop-screen">
                                <div class="laptop-diamond"></div>
                            </div>
                            <div class="chat-bubble">
                                <div class="chat-line"></div>
                                <div class="chat-line"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            document.querySelectorAll('.tab-link').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const tabId = link.getAttribute('data-tab');

                    document.querySelectorAll('.tab-link').forEach(l => l.classList.remove(
                        'active'));
                    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove(
                        'active'));

                    link.classList.add('active');
                    const target = document.getElementById(tabId);
                    if (target) {
                        target.classList.add('active');
                    }
                });
            });

            document.querySelectorAll('.rights-question').forEach(question => {
                question.addEventListener('click', () => {
                    const item = question.closest('.rights-item');
                    const openItem = document.querySelector('.rights-item.active');

                    if (openItem && openItem !== item) {
                        openItem.classList.remove('active');
                    }

                    if (item) {
                        item.classList.toggle('active');
                    }
                });
            });
        });
    </script>
@endsection
