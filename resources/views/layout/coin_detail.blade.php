@extends('layout.home-layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css?v=2') }}">
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
        
                h1, h2, h3, h4, h5 {
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
                    background: rgba(255,255,255,0.05);
                    border: 1px solid var(--border);
                    color: white;
                    backdrop-filter: var(--glass);
                }
        
                .btn-outline:hover {
                    border-color: var(--primary);
                    background: rgba(0, 224, 255, 0.1);
                }
                
                /* Section Header */
                .section-header {
                    text-align: center;
                    margin-bottom: 60px;
                }
             .section-header h2{
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
        
                .nav-links a:hover { color: var(--text-main); }
                .nav-links a.active { color: var(--primary); }
        
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
                    background: rgba(0,0,0,0.5);
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
                    top: 80px; /* open below fixed header */
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
                    background: var(--bg-dark); /* solid background for drawer */
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

        .stats-section {
            padding: 120px 0 80px;
            min-height: calc(100vh - 200px);
        }

        .coin-header {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px 36px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 32px;
            backdrop-filter: var(--glass);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        

        .coin-name {
            font-size: 2.2rem;
            font-weight: 700;
            background: var(--gradient-text);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-family: 'Space Grotesk', sans-serif;
            display: flex;
            align-items: center;
            gap: 12px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .coin-header-separator {
            width: 2px;
            height: 60px;
            background: var(--gradient-text);
            flex-shrink: 0;
            border-radius: 2px;
        }

        .coin-info-box {
            background: transparent;
            border: none;
            padding: 0;
            border-radius: 0;
            display: flex;
            gap: 32px;
            font-size: 0.95rem;
            backdrop-filter: none;
            box-shadow: none;
            position: relative;
            flex: 1;
            justify-content: flex-end;
        }

        .coin-info-box::before {
            display: none;
        }

        .coin-info-box div {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 110px;
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-main);
            position: relative;
            padding: 0;
            border-radius: 0;
            transition: all 0.3s ease;
            text-align: right;
        }

        .coin-info-box div:hover {
            background: transparent;
            border: none;
        }

        .coin-info-box div:nth-child(1) {
            color: var(--primary);
        }

        .coin-info-box div:nth-child(1) b {
            color: var(--primary);
            opacity: 0.8;
        }

        .coin-info-box div:nth-child(2) {
            color: var(--text-main);
        }

        .coin-info-box div:nth-child(2) b {
            color: var(--text-muted);
        }

        .coin-info-box div:nth-child(3) {
            color: var(--success);
        }

        .coin-info-box div:nth-child(3) b {
            color: var(--success);
            opacity: 0.8;
        }

        .coin-info-box div:nth-child(4) {
            color: #ff6b6b;
        }

        .coin-info-box div:nth-child(4) b {
            color: #ff6b6b;
            opacity: 0.8;
        }

        .coin-info-box div:nth-child(5) {
            color: var(--accent);
        }

        .coin-info-box div:nth-child(5) b {
            color: var(--accent);
            opacity: 0.8;
        }

        .coin-info-box div b {
            display: block;
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 6px;
            opacity: 0.9;
        }

        #timeframes {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px 24px;
            margin-bottom: 24px;
            display: flex;
            gap: 12px;
            backdrop-filter: var(--glass);
        }

        #timeframes button {
            padding: 10px 20px;
            border: 1px solid var(--border);
            background: rgba(0, 0, 0, 0.3);
            color: var(--text-muted);
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        #timeframes button:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: rgba(0, 224, 255, 0.1);
        }

        #timeframes button.active {
            background: var(--primary);
            color: #000;
            border-color: var(--primary);
            box-shadow: 0 0 15px rgba(0, 224, 255, 0.3);
        }

        .main-content {
            display: flex;
            gap: 24px;
            min-height: 600px;
            height: calc(100vh - 380px);
        }

        #chart {
            flex: 3.5;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            backdrop-filter: var(--glass);
            position: relative;
            width: 100%;
            height: 100%;
            min-height: 600px;
            display: flex;
        }

        #chart > div {
            width: 100% !important;
            height: 100% !important;
            flex: 1;
        }

        #chart canvas {
            width: 100% !important;
            height: 100% !important;
        }

        .trades-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 24px;
            min-height: 0;
            overflow: hidden;
        }

        .trade-box {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px 16px 24px 24px;
            display: flex;
            flex-direction: column;
            backdrop-filter: var(--glass);
            flex: 1;
            min-height: 0;
            overflow: hidden;
        }

        .trade-box h3 {
            margin: 0 0 20px 0;
            font-size: 1.1rem;
            font-weight: 600;
            text-align: center;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
            color: var(--text-main);
            font-family: 'Space Grotesk', sans-serif;
            flex-shrink: 0;
        }

        .trade-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            font-size: 0.9rem;
            overflow-y: auto;
            overflow-x: hidden;
            flex: 1;
            min-height: 0;
            max-height: 100%;
            padding: 4px 0;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .trade-list::-webkit-scrollbar {
            display: none;
            width: 0;
        }

        .trade {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .trade:last-child {
            border-bottom: none;
        }

        .trade span:first-child {
            font-weight: 600;
        }

        .trade span:last-child {
            color: var(--text-muted);
        }

        @media(max-width: 992px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
            .main-content {
                flex-direction: column;
                height: auto;
            }
            #chart {
                min-height: 400px;
                height: 400px;
            }
            .trades-panel {
                min-height: 400px;
            }
            .trade-box {
                min-height: 200px;
                max-height: 300px;
            }
            .coin-header {
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
            }
            .coin-header-separator {
                display: none;
            }
            .coin-info-box {
                flex-wrap: wrap;
                gap: 16px;
                width: 100%;
                justify-content: flex-start;
            }
            .coin-info-box div {
                text-align: left;
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
            .stats-section {
                padding: 100px 0 60px;
            }
            .coin-name {
                font-size: 1.5rem;
            }
            .coin-header-separator {
                display: none;
            }
            .coin-info-box {
                flex-direction: column;
                gap: 12px;
                width: 100%;
                justify-content: flex-start;
            }
            .coin-info-box div {
                flex-direction: row;
                justify-content: space-between;
                width: 100%;
                text-align: left;
            }
        }
    </style>
@endsection
@section('content')
    <section class="stats-section">
        <div class="container">
            <!-- COIN HEADER -->
            <div class="coin-header">
                <div class="coin-name" id="coin-title">Loading...</div>
                <div class="coin-header-separator"></div>
                <div class="coin-info-box" id="coin-info">
                    <!-- Filled by JS -->
                </div>
            </div>

            <!-- TIMEFRAMES -->
            <div class="section" id="timeframes">
                <button data-tf="15m" class="active">15m</button>
                <button data-tf="1h">1H</button>
                <button data-tf="4h">4H</button>
                <button data-tf="1d">1D</button>
            </div>

            <!-- MAIN LAYOUT -->
            <div class="main-content">
                <div id="chart"></div>

                <div class="trades-panel">
                    <div class="trade-box">
                        <h3>Seller Trades</h3>
                        <div id="seller-trades" class="trade-list"></div>
                    </div>

                    <div class="trade-box">
                        <h3>Buyer Trades</h3>
                        <div id="buyer-trades" class="trade-list"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/lightweight-charts@4.2.0/dist/lightweight-charts.standalone.production.js">
    </script>
    <script>
        /* -----------------------------------------------------------
                                    READ SYMBOL FROM URL
                                ----------------------------------------------------------- */
        // const urlParams = new URLSearchParams(window.location.search);
        let symbol = `{{ $symbol }}` || "BTCUSDT";
        // console.log("Trading Symbol:", symbol);
        document.getElementById("coin-title").innerText = symbol;

        /* -----------------------------------------------------------
            TIMEFRAME HANDLING
        ----------------------------------------------------------- */
        let timeframe = "15m";
        const tfButtons = document.querySelectorAll("#timeframes button");

        tfButtons.forEach(btn => {
            btn.onclick = () => {
                tfButtons.forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                timeframe = btn.dataset.tf;
                loadKlines();
            };
        });

        /* -----------------------------------------------------------
            CREATE CHART
        ----------------------------------------------------------- */
        const chart = LightweightCharts.createChart(document.getElementById("chart"), {
            layout: {
                background: {
                    color: "#0d0d0d"
                },
                textColor: "#fff"
            },
            grid: {
                vertLines: {
                    color: "#222"
                },
                horzLines: {
                    color: "#222"
                }
            },
            timeScale: {
                timeVisible: true,
                secondsVisible: false
            }
        });

        const candleSeries = chart.addCandlestickSeries({
            upColor: "#0f0",
            borderUpColor: "#0f0",
            downColor: "#f00",
            borderDownColor: "#f00",
            wickUpColor: "#0f0",
            wickDownColor: "#f00"
        });

        /* -----------------------------------------------------------
            LOAD KLINES
        ----------------------------------------------------------- */
        function handleKlineError() {
            // For Orchid, we use query param and redirect
            window.location.href = document.referrer + "?error=coin_not_available";
        }

        async function loadKlines() {
            try {
                candleSeries.setData([]);

                const url = `https://api.binance.com/api/v3/klines?symbol=${symbol}&interval=${timeframe}&limit=200`;

                const response = await fetch(url);

                // If fetch fails due to CORS, network, 429, etc.
                if (!response.ok) {
                    handleKlineError();
                    return;
                }

                const data = await response.json();

                // Binance returns [] when symbol doesn't exist
                if (!Array.isArray(data) || data.length === 0) {
                    handleKlineError();
                    return;
                }

                // Format candles
                const formatted = data.map(d => ({
                    time: d[0] / 1000,
                    open: parseFloat(d[1]),
                    high: parseFloat(d[2]),
                    low: parseFloat(d[3]),
                    close: parseFloat(d[4])
                }));

                candleSeries.setData(formatted);

                setupLiveKline();

            } catch (err) {
                console.error("Kline fetch error:", err);
                handleKlineError();
            }
        }

        loadKlines();

        /* -----------------------------------------------------------
            LIVE KLINE WS
        ----------------------------------------------------------- */
        let klineSocket;

        function setupLiveKline() {
            if (klineSocket) klineSocket.close();

            const wsUrl = `wss://stream.binance.com:9443/ws/${symbol.toLowerCase()}@kline_${timeframe}`;
            klineSocket = new WebSocket(wsUrl);

            klineSocket.onmessage = event => {
                const data = JSON.parse(event.data);
                const k = data.k;

                candleSeries.update({
                    time: k.t / 1000,
                    open: parseFloat(k.o),
                    high: parseFloat(k.h),
                    low: parseFloat(k.l),
                    close: parseFloat(k.c)
                });
            };
        }

        /* -----------------------------------------------------------
            MARKET TRADES WS  (SELLER & BUYER SPLIT)
        ----------------------------------------------------------- */
        const sellerDiv = document.getElementById("seller-trades");
        const buyerDiv = document.getElementById("buyer-trades");

        let sellerTrades = [];
        let buyerTrades = [];

        const tradeWS = new WebSocket(`wss://stream.binance.com:9443/ws/${symbol.toLowerCase()}@trade`);

        tradeWS.onmessage = (event) => {
            const t = JSON.parse(event.data);

            if (t.m) {
                // SELLER (RED)
                sellerTrades.unshift(t);
                sellerTrades = sellerTrades.slice(0, 5);
            } else {
                // BUYER (GREEN)
                buyerTrades.unshift(t);
                buyerTrades = buyerTrades.slice(0, 5);
            }

            renderTrades();
        };

        function renderTrades() {
            sellerDiv.innerHTML = sellerTrades
                .map(t => `<div class="trade"><span style="color:#f00">${t.p}</span><span>${t.q}</span></div>`)
                .join("");

            buyerDiv.innerHTML = buyerTrades
                .map(t => `<div class="trade"><span style="color:#0f0">${t.p}</span><span>${t.q}</span></div>`)
                .join("");
        }

        /* -----------------------------------------------------------
            COIN INFO
        ----------------------------------------------------------- */
        async function loadCoinInfo() {
            const url = `https://api.binance.com/api/v3/ticker/24hr?symbol=${symbol}`;
            const d = await fetch(url).then(r => r.json());

            document.getElementById("coin-info").innerHTML = `
                <div><b>Price</b>${d.lastPrice}</div>
                <div><b>24h Change</b>${d.priceChangePercent}%</div>
                <div><b>High</b>${d.highPrice}</div>
                <div><b>Low</b>${d.lowPrice}</div>
                <div><b>Volume</b>${d.volume}</div>
            `;
        }

        loadCoinInfo();
        setInterval(loadCoinInfo, 5000);
    </script>
@endsection
