@extends('layout.home-layout')

@section('content')
    <section class="stats-section">
        <div class="container">
            <!-- COIN HEADER -->
            <div class="coin-header">
                <div class="coin-name" id="coin-title">Loading...</div>
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
        async function loadKlines() {
            candleSeries.setData([]);

            let url = `https://api.binance.com/api/v3/klines?symbol=${symbol}&interval=${timeframe}&limit=200`;
            const data = await fetch(url).then(r => r.json());

            const formatted = data.map(d => ({
                time: d[0] / 1000,
                open: parseFloat(d[1]),
                high: parseFloat(d[2]),
                low: parseFloat(d[3]),
                close: parseFloat(d[4])
            }));

            candleSeries.setData(formatted);

            setupLiveKline();
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
