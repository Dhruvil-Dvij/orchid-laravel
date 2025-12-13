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

        .crypto-table-section {
            padding: 100px 0 80px 0;
            background: var(--bg-dark);
            color: var(--text-main);
        }

        .crypto-table-section h2 {
            text-align: center;
            font-size: 4.5rem;
            line-height: 1.1;
            letter-spacing: -0.03em;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--text-main);
            margin-top: 40px;
        }

        @media(max-width: 890px) {
            .crypto-table-section h2 {
                font-size: 2.8rem;
            }
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
            padding: 0 24px;
        }

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

        @media(max-width: 890px) {

            .nav-links,
            .nav-actions {
                display: none;
            }

            .menu-toggle {
                display: inline-flex;
            }
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

        /* Pagination Previous/Next Buttons */
        #prevPageBtn,
        #nextPageBtn {
            padding: 8px 20px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.95rem;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-main);
            backdrop-filter: var(--glass);
            border-color: var(--primary);
        }

        #prevPageBtn:hover:not(:disabled),
        #nextPageBtn:hover:not(:disabled) {
            border-color: var(--primary);
            background: rgba(0, 224, 255, 0.15);
            color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 224, 255, 0.3);
        }

        #prevPageBtn:disabled,
        #nextPageBtn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            background: rgba(255, 255, 255, 0.02);
            border-color: rgba(255, 255, 255, 0.05);
            color: var(--text-muted);
            border-color: var(--primary);
        }

        #pageInfo {
            padding: 10px 0px;
            color: var(--text-main);
            font-weight: 500;
            font-size: 0.95rem;
        }
    </style>
@endsection

@section('content')
    <section class="crypto-table-section" id="crypto-prices">
        <div class="container">
            <h2>Live Crypto 
                <span class="text-gradient">Prices</span>
            </h2>
            <p class="section-subtitle">Track the performance of major crypto currencies in real-time</p>

            <!-- Search and Controls -->
            <div class="table-controls">
                {{-- <div class="search-container">
                    <input type="text" id="cryptoSearch" class="search-input" placeholder="Search crypto currencies...">
                </div> --}}
                <div class="search-container">
                    <span class="search-icon">🔍</span>
                    <input type="text" id="searchInput" class="search-input" placeholder="Search crypto currencies...">
                </div>
                <div id="paginationControls" class="per-page-selector"
                    style="display: flex; gap: 8px; align-items: center;">
                    <button id="prevPageBtn" disabled>Previous</button>
                    <span id="pageInfo">Page 1 of 1</span>
                    <button id="nextPageBtn" disabled>Next</button>
                </div>
            </div>

            <div class="table-container table-wrap">
                <div class="center" id="listLoading">Loading coins...</div>


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
            </div>

        </div>
    </section>
@endsection

@section('scripts')

    <script>
        /* ===================== CONFIG ===================== */
        const COINGECKO_URL =
            'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=250&page=1&sparkline=false';

        // Using the 24hr ticker stream for ALL symbols
        const BINANCE_WS = 'wss://stream.binance.com:9443/ws/!ticker@arr';
        const SUFFIXES = ['USDT', 'BUSD']; // Prioritized stablecoin pairs

        /* ===================== STATE ===================== */
        let coins = []; // Array of CoinGecko objects (used for filtering/pagination)
        let coinIndexBySymbol = {}; // Map for CoinGecko metadata access: { "BTC": {...} }
        let liveTickers = {}; // Map for live Binance data: { "BTCUSDT": {...} }
        let searchTerm = "";
        let currentPage = 1;
        const coinsPerPage = 15;

        /* ===================== DOM ===================== */
        const tbody = document.getElementById('coinTableBody');
        const table = document.getElementById('coinTable');
        const listLoadingEl = document.getElementById('listLoading');

        // DOM elements for search and pagination
        const searchInput = document.getElementById('searchInput');
        const prevPageBtn = document.getElementById('prevPageBtn');
        const nextPageBtn = document.getElementById('nextPageBtn');
        const pageInfoEl = document.getElementById('pageInfo');


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
                let res = await fetch('/get-coins');
                coins = await res.json();
                // const res = await fetch(COINGECKO_URL);
                // if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);

                // coins = await res.json();

                // Create a quick lookup map for CoinGecko data
                coins.forEach(c => {
                    const s = c.symbol.toUpperCase();
                    // Avoid overwriting if a symbol appears multiple times (unlikely here)
                    if (!coinIndexBySymbol[s]) coinIndexBySymbol[s] = c;
                });

                renderTable(); // Initial render with CoinGecko data
            } catch (error) {
                console.error("Error loading coins :", error);
                setTimeout(loadCoins, 2000);

                // listLoadingEl.textContent = "Error loading initial data. Please check the console.";
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

            // 2. PAGINATION: Calculate page details
            const totalPages = Math.ceil(filteredCoins.length / coinsPerPage);

            // Boundary checks for current page
            if (currentPage > totalPages && totalPages > 0) {
                currentPage = totalPages;
            } else if (totalPages === 0) {
                currentPage = 1;
            }

            const startIndex = (currentPage - 1) * coinsPerPage;
            const endIndex = startIndex + coinsPerPage;

            // 3. SLICE: Get only the coins for the current page
            const coinsToDisplay = filteredCoins.slice(startIndex, endIndex);

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

        searchInput.addEventListener('input', handleSearch);
        prevPageBtn.addEventListener('click', () => changePage(-1));
        nextPageBtn.addEventListener('click', () => changePage(1));

        // Start by loading static CoinGecko data
        loadCoins();

        // Setup WebSocket for live updates
        setupWS();
    </script>
@endsection
