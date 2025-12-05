
<footer>
    <div class="container">
        <div class="footer-grid">
            <div class="footer-column">
                <a class="footer-logo" href="{{ route('platform.index') }}">
                    <img src="{{ asset('images/logo.svg') }}" alt="Vcoins">
                    <span>Vcoins</span>
                </a>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Intelligent Crypto Wealth: Aggregating the
                    best DeFi yield with AI-powered security and auto-compounding for maximum returns.</p>
                <div class="social-links">
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-discord"></i></a>
                    <a href="#"><i class="fa-brands fa-github"></i></a>
                    <a href="#"><i class="fa-brands fa-telegram"></i></a>
                </div>
            </div>

            <div class="footer-column">
                <h4>Platform</h4>
                <ul>
                    <li><a href="{{ route('platform.index') }}">Home</a></li>
                    <li><a href="{{ route('platform.about') }}">About</a></li>
                    <li><a href="{{ route('platform.markets') }}">Markets</a></li>
                    <li><a href="{{ route('platform.contact') }}">Contact Us</a></li>
                    <li><a href="{{ route('platform.faq') }}">FAQ</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Community</h4>
                <ul>

                    <li><a href="{{ route('platform.blog') }}">Blog</a></li>
                    <li><a href="{{ route('platform.support') }}">Support</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Legal</h4>
                <ul>
                    <li><a href="{{ route('platform.terms') }}">Terms of Service</a></li>
                    <li><a href="{{ route('platform.privacy') }}">Privacy Policy</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 Vcoins Decentralized Platform. All rights reserved. | Built for the future of finance.
            </p>
        </div>
    </div>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.menu-toggle');
        const mobileNav = document.getElementById('mobileNav');

        if (menuToggle && mobileNav) {
            const toggleMobileNav = () => {
                mobileNav.classList.toggle('open');
            };

            menuToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleMobileNav();
            });

            document.addEventListener('click', (e) => {
                if (mobileNav.classList.contains('open')) {
                    const isClickInside = mobileNav.contains(e.target) || menuToggle.contains(e.target);
                    if (!isClickInside) {
                        mobileNav.classList.remove('open');
                    }
                }
            });

            mobileNav.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileNav.classList.remove('open');
                });
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 890) {
                    mobileNav.classList.remove('open');
                }
            });
        }
        // Get current URL
        const currentUrl = window.location.pathname;

        // Get all nav links
        const navLinks = document.querySelectorAll('nav a');

        navLinks.forEach(link => {
            const linkUrl = new URL(link.href).pathname;

            // Exact match
            if (linkUrl === currentUrl) {
                link.classList.add('active');
                // Also add active to parent li if exists
                const parentLi = link.closest('li');
                if (parentLi) {
                    parentLi.classList.add('active');
                }
            }

            // Partial match (for nested routes)
            if (currentUrl.startsWith(linkUrl) && linkUrl !== '/') {
                link.classList.add('active');
                const parentLi = link.closest('li');
                if (parentLi) {
                    parentLi.classList.add('active');
                }
            }
        });
    });
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add scroll effect to header
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (window.scrollY > 100) {
            header.style.background = '#181a20';
        } else {
            header.style.background = '#181a20';
        }
    });

    // Animate stats on scroll
    const animateStats = () => {
        const stats = document.querySelectorAll('.stat-item h3');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    const value = target.textContent;
                    const numericValue = parseFloat(value.replace(/[^0-9.]/g, ''));

                    if (!isNaN(numericValue)) {
                        let current = 0;
                        const increment = numericValue / 50;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= numericValue) {
                                current = numericValue;
                                clearInterval(timer);
                            }

                            // Determine how to format the displayed number based on the original text content
                            if (value.includes('B+')) { // Check for "B+" explicitly
                                target.textContent = Math.floor(current) + 'B+';
                            } else if (value.includes('M+')) { // Check for "M+" explicitly
                                target.textContent = Math.floor(current) + 'M+';
                            } else if (value.includes('%')) {
                                target.textContent = Math.floor(current) + '%';
                            } else if (value.includes('/')) {
                                // If the original value contains '/', set it to '24/7' directly
                                // This assumes '24/7' is a fixed text and not a counting animation
                                target.textContent = '24/7';
                                clearInterval(
                                    timer); // Stop the animation for '24/7' immediately
                            } else if (value.includes('+')) {
                                target.textContent = Math.floor(current) + '+';
                            } else {
                                // Default case if no specific suffix is found
                                target.textContent = Math.floor(current);
                            }
                        }, 50);
                    }
                    observer.unobserve(target); // Stop observing once animated
                }
            });
        });

        stats.forEach(stat => observer.observe(stat));
    };

    // Initialize animations when the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', animateStats);
</script>
