@extends('layout.home-layout')
@section('content')
    <section class="hero">
        <div class="hero-cards">
            <div class="floating-coin c1"><i class="fa-brands fa-bitcoin" style="color:#F7931A; font-size: 24px;"></i></div>
            <div class="floating-coin c2"><i class="fa-brands fa-ethereum" style="color:#627EEA; font-size: 24px;"></i></div>
            <div class="floating-coin c3"><i class="fa-solid fa-shield-halved" style="color:#00E0FF; font-size: 24px;"></i>
            </div>
        </div>
        <div class="container hero-content">
            <h1>Diversify with Crypto <br><span class="text-gradient">Baskets</span></h1>
            <p>Vcoins aggregates yield, automates staking, and simplifies DeFi. Earn up to 12% APY on stablecoins with our
                audited smart baskets.</p>
            <div class="hero-buttons">
                <a href="#staking" class="btn btn-primary">Start Earning <i class="fa-solid fa-arrow-right"></i></a>
                <a href="{{ route('platform.baskets') }}" class="btn btn-outline">View Baskets</a>
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
                    <div class="stat-value text-gradient">25,000+</div>
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
                            <button class="btn btn-outline" onclick="setAPY(0.05, this)"
                                style="border-color:var(--primary);">ETH (5%)</button>
                            <button class="btn btn-outline" onclick="setAPY(0.12, this)">USDC (12%)</button>
                            <button class="btn btn-outline" onclick="setAPY(0.08, this)">SOL (8%)</button>
                        </div>
                    </div>
                </div>

                <div class="calc-result-card">
                    <div style="font-size: 1.1rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px;">
                        Est. Total Return</div>
                    <div class="roi-text" id="totalReturn">$10,500</div>
                    <p style="color:var(--text-muted);">Profit: <span id="profitDisplay" style="color:#fff;">+$500</span>
                    </p>
                    <a href="#" class="btn btn-primary" style="margin-top: 30px; justify-content:center;">Stake
                        Now</a>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="crypto-table-section" id="crypto-prices">
        <div class="container">
            <h2>Live Crypto Prices</h2>
            <p class="section-subtitle">Track the performance of major crypto currencies in real-time</p>

            <!-- Search and Controls -->
            <div class="table-controls">
                <div class="search-container">
                    <span class="search-icon">🔍</span>
                    <input type="text" id="cryptoSearch" class="search-input" placeholder="Search crypto currencies...">
                </div>
                <div class="per-page-selector">
                    <label for="perPage">Show:</label>
                    <select id="perPage" class="per-page-select">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span>per page</span>
                </div>
            </div>

            <div class="table-container">


                <table class="table crypto-table" id="crypto-table">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Symbol</th>
                            <th>Price</th>
                            <th>24h Change</th>
                            <th>Market Cap</th>
                            <th>Volume (24h)</th>
                        </tr>
                    </thead>
                    <tbody id="crypto-body">
                        <!-- Table rows will be populated by JavaScript -->
                    </tbody>
                </table>
                <div id="noResults" class="no-results" style="display: none;">
                    <p>No cryptocurrencies found matching your search.</p>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination" id="pagination">
                <!-- Pagination will be populated by JavaScript -->
            </div>
        </div>
    </section> --}}

    <section class="crypto-table-section" id="crypto-prices">
        <div class="container">
            <h2>Live Crypto Prices</h2>
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
            </div>

        </div>
    </section>

    <section class="how-it-works-section">
        <div class="container">
            <div class="section-header">
                <h2 class="text-gradient">How Vcoins Works</h2>
                <p style="color:var(--text-muted); max-width:600px; margin: 0 auto;">Our intelligent system simplifies the
                    complex DeFi landscape to maximize your yield safely.</p>
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
                    <p>Your yield is harvested and reinvested back into the basket, automatically compounding your returns.
                    </p>
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
                        <a href="#" class="btn btn-outline"
                            style="width:100%; justify-content:center; font-size:0.9rem;">Start Lesson</a>
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
                        <a href="#" class="btn btn-outline"
                            style="width:100%; justify-content:center; font-size:0.9rem;">Start Lesson</a>
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
                        <a href="#" class="btn btn-outline"
                            style="width:100%; justify-content:center; font-size:0.9rem;">Start Lesson</a>
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

                <div class="countdown">
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
                </div>

                <h1 class="hero-title">
                    Smart and Secure Way to<br>Invest in Crypto
                </h1>

                <p class="hero-description">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elit,
                    sed dianonumy eirmod tempor invidunt. Lorem ipsum dolor
                    sit amet, consetetur sadipscing elit, sed dianonumy
                    eirmod tempor invidunt ut labore.
                </p>

                <a href="#" class="hero-btn">Buy Token Now</a>

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
                <p style="color:var(--text-muted); max-width:500px; margin: 0 auto;">Don't just take our word for it. Hear
                    from our users who are growing their wealth.</p>
            </div>

            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fa-solid fa-quote-left"></i></div>
                    <p>“Vcoins is a game changer. The 12% stablecoin APY is fantastic, and the automated rebalancing gives
                        me peace of mind. Truly set-and-forget DeFi.”</p>
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
                    <p>“The Learn & Earn academy is brilliant! I got paid to understand liquidity pools. It's the perfect
                        platform for new users to start their journey.”</p>
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
    <div class="faq-section-container" id="faq">

        <section class="faq-section">
            <h2>Frequently Asked Questions</h2>

            <!-- FAQ Item -->
            <div class="faq-item active">
                <button class="faq-header">
                    <span class="faq-number">1</span>
                    <span class="faq-title">Why is Binance the best exchange for crypto traders?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-content">
                    <p>
                        Binance offers low fees, fast transactions and support for Bitcoin, Ethereum, Tether and 350+
                        cryptocurrencies...
                    </p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-header">
                    <span class="faq-number">2</span>
                    <span class="faq-title">What products does Binance provide?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-content">
                    <p>Spot Trading, Futures, P2P, Earn, Launchpad & more...</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-header">
                    <span class="faq-number">3</span>
                    <span class="faq-title">How to buy Bitcoin and other cryptocurrencies?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-content">
                    <p>Buy with Debit card, Credit card, UPI, Wallets & Bank transfer...</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-header">
                    <span class="faq-number">4</span>
                    <span class="faq-title">How to track cryptocurrency prices?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-content">
                    <p>Use Binance price charts, live market analytics & coin info...</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-header">
                    <span class="faq-number">5</span>
                    <span class="faq-title">How to trade cryptocurrencies?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-content">
                    <p>Spot trading, Margin, Futures & Copy trading available...</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-header">
                    <span class="faq-number">6</span>
                    <span class="faq-title">How to earn from crypto?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-content">
                    <p>Earn passive rewards using Stake, Earn, Launchpool & More...</p>
                </div>
            </div>

        </section>
    </div>
@endsection

@section('scripts')
    {{-- <script>
            const binanceSocket = 'wss://stream.binance.com:9443/ws/!ticker@arr';
            const coinMap = @json($coinMap); // Provided from your controller
            const prices = {}; // Stores all incoming crypto data
            let filteredAndSortedData = []; // Data after search and before pagination
            let currentPage = 1;
            let itemsPerPage = 10; // Default items per page, matching HTML default selected option
            let currentSort = 'market_cap'; // Default sort key
            let sortDirection = 'desc'; // Default sort direction (descending for market_cap)

            // Elements
            const cryptoBody = document.getElementById('crypto-body');
            const cryptoSearchInput = document.getElementById('cryptoSearch'); // Corrected ID
            const perPageSelect = document.getElementById('perPage'); // Corrected ID
            const paginationContainer = document.getElementById('pagination');
            const noResultsDiv = document.getElementById('noResults');
            const loaderElement = document.getElementById('loader'); // Assuming you have a loader div
            const cryptoTable = document.getElementById('crypto-table'); // Assuming you want to hide/show table

            // --- WebSocket Connection ---
            function connectWebSocket() {
                const ws = new WebSocket(binanceSocket);

                ws.onopen = () => {
                    console.log('WebSocket connected.');
                    // Assuming 'error-msg' is for general connection errors
                    const errorMsgElement = document.getElementById('error-msg');
                    if (errorMsgElement) {
                        errorMsgElement.classList.add('d-none');
                    }
                    if (loaderElement) {
                        loaderElement.classList.add('d-none'); // Hide loader on successful connection
                    }
                    if (cryptoTable) {
                        cryptoTable.classList.remove('d-none'); // Show table once connected
                    }
                };

                ws.onmessage = (event) => {
                    const updates = JSON.parse(event.data);
                    updates.forEach(coin => {
                        const symbol = coin.s;
                        const baseSymbol = symbol.replace('USDT', ''); // e.g., BTCUSDT -> BTC

                        if (coinMap[baseSymbol]) {
                            // Update or add coin data
                            prices[symbol] = {
                                symbol: baseSymbol, // Use base symbol for easier mapping to CoinGecko data
                                fullSymbol: symbol, // Keep full symbol if needed elsewhere
                                name: coinMap[baseSymbol].name,
                                logo: coinMap[baseSymbol].logo,
                                market_cap: parseFloat(coinMap[baseSymbol].market_cap ||
                                    0), // Ensure it's a number, default to 0
                                price: parseFloat(coin.c),
                                change: parseFloat(coin.P),
                                volume: parseFloat(coin.q),
                            };
                        }
                    });
                    // Every time new data arrives, re-filter, re-sort, and re-paginate
                    updateTableData();
                };

                ws.onerror = (error) => {
                    console.error('WebSocket error:', error);
                    const errorMsgElement = document.getElementById('error-msg');
                    if (errorMsgElement) {
                        errorMsgElement.classList.remove('d-none');
                    }
                };

                ws.onclose = (event) => {
                    console.warn('WebSocket closed:', event.code, event.reason);
                    // Reconnect after a delay if connection is closed unexpectedly
                    setTimeout(connectWebSocket, 3000);
                };
            }

            // --- Data Processing and Rendering ---
            function updateTableData() {
                let data = Object.values(prices); // Get all current crypto data

                // 1. Search Filtering
                const search = cryptoSearchInput.value.toLowerCase(); // Use cryptoSearchInput
                if (search) {
                    data = data.filter(c =>
                        c.name.toLowerCase().includes(search) ||
                        c.symbol.toLowerCase().includes(search) ||
                        c.fullSymbol.toLowerCase().includes(search) // Also search full symbol like BTCUSDT
                    );
                }

                // Show/hide no results message
                if (data.length === 0 && search) {
                    noResultsDiv.style.display = 'block';
                    cryptoBody.innerHTML = ''; // Clear table body
                    paginationContainer.innerHTML = ''; // Clear pagination
                    return; // No data to display
                } else {
                    noResultsDiv.style.display = 'none';
                }

                // 2. Sorting
                data.sort((a, b) => {
                    const valA = a[currentSort];
                    const valB = b[currentSort];

                    if (valA === undefined || valB === undefined) {
                        // Handle cases where a sort key might be missing (e.g., market_cap not available for all)
                        return 0;
                    }

                    if (sortDirection === 'asc') {
                        return valA - valB;
                    } else {
                        return valB - valA;
                    }
                });

                filteredAndSortedData = data; // Store for pagination

                // 3. Pagination
                paginateData(); // Call paginateData to render the current page
            }


            function paginateData() {
                const totalPages = Math.ceil(filteredAndSortedData.length / itemsPerPage);
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const paginated = filteredAndSortedData.slice(startIndex, endIndex);

                renderTable(paginated);
                renderPagination(totalPages);
            }

            function renderTable(dataToRender) {
                cryptoBody.innerHTML = ''; // Clear existing rows

                if (dataToRender.length === 0) {
                    // This case is already handled in updateTableData for search results
                    return;
                }

                let rankOffset = (currentPage - 1) * itemsPerPage; // Calculate rank based on current page
                dataToRender.forEach((coin, index) => {
                    const rank = rankOffset + index + 1; // Rank is 1-based index on the current page

                    // Determine text color for 24h Change
                    const changeClass = coin.change >= 0 ? 'text-success' : 'text-danger';

                    // Format numbers for display
                    const formattedPrice = `$${coin.price.toFixed(2)}`;
                    const formattedChange = `${coin.change.toFixed(2)}%`;
                    const formattedVolume = `$${(coin.volume / 1e9).toFixed(2)}B`; // Billions
                    const formattedMarketCap = coin.market_cap ? `$${(coin.market_cap / 1e9).toFixed(2)}B` :
                        'N/A'; // Trillions, handle missing market_cap

                    const row = `
                <tr>
                    <td>${rank}</td>
                    <td class="coin-name-col">
                        <img src="${coin.logo}" alt="${coin.name} logo" class="coin-logo">
                        <strong>${coin.name}</strong>
                    </td>
                    <td>${coin.symbol}</td> 
                    <td>${formattedPrice}</td>
                    <td class="${changeClass}">${formattedChange}</td>
                    <td>${formattedMarketCap}</td>
                    <td>${formattedVolume}</td>
                </tr>
            `;
                    cryptoBody.insertAdjacentHTML('beforeend', row);
                });
            }


            function renderPagination(totalPages) {
                paginationContainer.innerHTML = ''; // Clear existing pagination

                if (totalPages <= 1) {
                    return; // No need for pagination if only one page
                }

                const createPaginationItem = (text, page, isActive = false, isDisabled = false) => {
                    const li = document.createElement('li');
                    li.className = 'page-item';
                    if (isActive) li.classList.add('active');
                    if (isDisabled) li.classList.add('disabled');

                    const a = document.createElement('a');
                    a.className = 'page-link';
                    a.href = '#';
                    a.innerHTML = text;

                    if (!isDisabled) {
                        a.addEventListener('click', (e) => {
                            e.preventDefault();
                            currentPage = page;
                            paginateData();
                        });
                    }
                    li.appendChild(a);
                    return li;
                };

                // Previous button
                paginationContainer.appendChild(createPaginationItem('‹', currentPage - 1, false, currentPage === 1));

                // Page numbers
                const maxPagesToShow = 7; // Max number of page buttons to display
                let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
                let endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);

                if (endPage - startPage + 1 < maxPagesToShow) {
                    startPage = Math.max(1, endPage - maxPagesToShow + 1);
                }

                if (startPage > 1) {
                    paginationContainer.appendChild(createPaginationItem('1', 1));
                    if (startPage > 2) {
                        const liDots = document.createElement('li');
                        liDots.className = 'page-item disabled';
                        liDots.innerHTML = '<span class="page-link">...</span>';
                        paginationContainer.appendChild(liDots);
                    }
                }

                for (let i = startPage; i <= endPage; i++) {
                    paginationContainer.appendChild(createPaginationItem(i, i, i === currentPage));
                }

                if (endPage < totalPages) {
                    if (endPage < totalPages - 1) {
                        const liDots = document.createElement('li');
                        liDots.className = 'page-item disabled';
                        liDots.innerHTML = '<span class="page-link">...</span>';
                        paginationContainer.appendChild(liDots);
                    }
                    paginationContainer.appendChild(createPaginationItem(totalPages, totalPages));
                }


                // Next button
                paginationContainer.appendChild(createPaginationItem('›', currentPage + 1, false, currentPage === totalPages));
            }


            // --- Event Listeners ---
            cryptoSearchInput.addEventListener('input', () => {
                currentPage = 1; // Reset to first page on new search
                updateTableData();
            });

            perPageSelect.addEventListener('change', (e) => {
                itemsPerPage = parseInt(e.target.value);
                currentPage = 1; // Reset to first page when items per page changes
                updateTableData();
            });

            // Add event listeners for sortable headers
            document.querySelectorAll('.sortable').forEach(header => {
                header.addEventListener('click', () => {
                    const sortKey = header.dataset.sort;

                    // Toggle sort direction if clicking the same column
                    if (currentSort === sortKey) {
                        sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                    } else {
                        currentSort = sortKey;
                        sortDirection = 'desc'; // Default to descending for new sort column
                    }

                    // Remove existing sort indicators
                    document.querySelectorAll('.sortable').forEach(h => h.classList.remove('asc', 'desc'));

                    // Add new sort indicator
                    header.classList.add(sortDirection);

                    currentPage = 1; // Reset to first page on sort change
                    updateTableData();
                });
            });

            // --- Initial Call ---
            // Start WebSocket connection when the page loads
            document.addEventListener('DOMContentLoaded', () => {
                // Hide table and show loader initially
                if (loaderElement) {
                    loaderElement.classList.remove('d-none');
                }
                if (cryptoTable) {
                    cryptoTable.classList.add('d-none');
                }
                connectWebSocket();
            });
        </script> --}}

    {{-- <script>
        const binanceSocket = 'wss://stream.binance.com:9443/ws/!ticker@arr';
        const coinMap = @json($coinMap); // Provided from your controller
        const prices = {}; // Stores all incoming crypto data
        let filteredAndSortedData = []; // Data after search and before pagination
        let currentPage = 1;
        let itemsPerPage = 10; // Default items per page, matching HTML default selected option
        let currentSort = 'market_cap'; // Default sort key
        let sortDirection = 'desc'; // Default sort direction (descending for market_cap)

        // Elements
        const cryptoBody = document.getElementById('crypto-body');
        const cryptoSearchInput = document.getElementById('cryptoSearch'); // Corrected ID
        const perPageSelect = document.getElementById('perPage'); // Corrected ID
        const paginationContainer = document.getElementById('pagination');
        const noResultsDiv = document.getElementById('noResults');
        const loaderElement = document.getElementById('loader'); // Assuming you have a loader div
        const cryptoTable = document.getElementById('crypto-table'); // Assuming you want to hide/show table

        // --- WebSocket Connection ---
        function connectWebSocket() {
            const ws = new WebSocket(binanceSocket);

            ws.onopen = () => {
                console.log('WebSocket connected.');
                // Assuming 'error-msg' is for general connection errors
                const errorMsgElement = document.getElementById('error-msg');
                if (errorMsgElement) {
                    errorMsgElement.classList.add('d-none');
                }
                if (loaderElement) {
                    loaderElement.classList.add('d-none'); // Hide loader on successful connection
                }
                if (cryptoTable) {
                    cryptoTable.classList.remove('d-none'); // Show table once connected
                }
            };

            ws.onmessage = (event) => {
                const updates = JSON.parse(event.data);
                updates.forEach(coin => {
                    const symbol = coin.s;
                    const baseSymbol = symbol.replace('USDT', ''); // e.g., BTCUSDT -> BTC

                    if (coinMap[baseSymbol]) {
                        // Update or add coin data
                        prices[symbol] = {
                            symbol: baseSymbol, // Use base symbol for easier mapping to CoinGecko data
                            fullSymbol: symbol, // Keep full symbol if needed elsewhere
                            name: coinMap[baseSymbol].name,
                            logo: coinMap[baseSymbol].logo,
                            market_cap: parseFloat(coinMap[baseSymbol].market_cap * 1000 ||
                                0), // Ensure it's a number, default to 0
                            price: parseFloat(coin.c),
                            change: parseFloat(coin.P),
                            volume: parseFloat(coin.q),
                        };
                    }
                });
                // Every time new data arrives, re-filter, re-sort, and re-paginate
                updateTableData();
            };

            ws.onerror = (error) => {
                console.error('WebSocket error:', error);
                const errorMsgElement = document.getElementById('error-msg');
                if (errorMsgElement) {
                    errorMsgElement.classList.remove('d-none');
                }
            };

            ws.onclose = (event) => {
                console.warn('WebSocket closed:', event.code, event.reason);
                // Reconnect after a delay if connection is closed unexpectedly
                setTimeout(connectWebSocket, 3000);
            };
        }

        // --- Data Processing and Rendering ---
        function updateTableData() {
            let data = Object.values(prices); // Get all current crypto data

            // 1. Search Filtering
            const search = cryptoSearchInput.value.toLowerCase(); // Use cryptoSearchInput
            if (search) {
                data = data.filter(c =>
                    c.name.toLowerCase().includes(search) ||
                    c.symbol.toLowerCase().includes(search) ||
                    c.fullSymbol.toLowerCase().includes(search) // Also search full symbol like BTCUSDT
                );
            }

            // Show/hide no results message
            if (data.length === 0 && search) {
                noResultsDiv.style.display = 'block';
                cryptoBody.innerHTML = ''; // Clear table body
                paginationContainer.innerHTML = ''; // Clear pagination
                return; // No data to display
            } else {
                noResultsDiv.style.display = 'none';
            }

            // 2. Sorting
            data.sort((a, b) => {
                const valA = a[currentSort];
                const valB = b[currentSort];

                if (valA === undefined || valB === undefined) {
                    // Handle cases where a sort key might be missing (e.g., market_cap not available for all)
                    return 0;
                }

                if (sortDirection === 'asc') {
                    return valA - valB;
                } else {
                    return valB - valA;
                }
            });

            filteredAndSortedData = data; // Store for pagination

            // 3. Pagination
            paginateData(); // Call paginateData to render the current page
        }


        function paginateData() {
            const totalPages = Math.ceil(filteredAndSortedData.length / itemsPerPage);
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginated = filteredAndSortedData.slice(startIndex, endIndex);

            renderTable(paginated);
            renderPagination(totalPages);
        }

        function renderTable(dataToRender) {
            cryptoBody.innerHTML = ''; // Clear existing rows

            if (dataToRender.length === 0) {
                // This case is already handled in updateTableData for search results
                return;
            }

            let rankOffset = (currentPage - 1) * itemsPerPage; // Calculate rank based on current page
            dataToRender.forEach((coin, index) => {
                const rank = rankOffset + index + 1; // Rank is 1-based index on the current page

                // Determine text color for 24h Change
                const changeClass = coin.change >= 0 ? 'text-success' : 'text-danger';

                // Format numbers for display
                const formattedPrice = `$${coin.price.toFixed(2)}`;
                const formattedChange = `${coin.change.toFixed(2)}%`;
                const formattedVolume = `$${(coin.volume / 1e9).toFixed(2)}B`; // Billions
                const formattedMarketCap = coin.market_cap ? `$${(coin.market_cap / 1e12).toFixed(2)}B` :
                    'N/A'; // Trillions, handle missing market_cap

                const row = `
                <tr>
                    <td>${rank}</td>
                    <td class="coin-name-col">
                        <img src="${coin.logo}" alt="${coin.name} logo" class="coin-logo">
                        <strong>${coin.name}</strong>
                    </td>
                    <td>${coin.symbol}</td> 
                    <td>${formattedPrice}</td>
                    <td class="${changeClass}">${formattedChange}</td>
                    <td>${formattedMarketCap}</td>
                    <td>${formattedVolume}</td>
                </tr>
            `;
                cryptoBody.insertAdjacentHTML('beforeend', row);
            });
        }


        function renderPagination(totalPages) {
            paginationContainer.innerHTML = ''; // Clear existing pagination

            if (totalPages <= 1) {
                return; // No need for pagination if only one page
            }

            const createPaginationItem = (text, page, isActive = false, isDisabled = false) => {
                const li = document.createElement('li');
                li.className = 'page-item';
                if (isActive) li.classList.add('active');
                if (isDisabled) li.classList.add('disabled');

                const a = document.createElement('a');
                a.className = 'page-link';
                a.href = '#';
                a.innerHTML = text;

                if (!isDisabled) {
                    a.addEventListener('click', (e) => {
                        e.preventDefault();
                        currentPage = page;
                        paginateData();
                    });
                }
                li.appendChild(a);
                return li;
            };

            // Previous button
            paginationContainer.appendChild(createPaginationItem('‹', currentPage - 1, false, currentPage === 1));

            // Page numbers
            const maxPagesToShow = 7; // Max number of page buttons to display
            let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
            let endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);

            if (endPage - startPage + 1 < maxPagesToShow) {
                startPage = Math.max(1, endPage - maxPagesToShow + 1);
            }

            if (startPage > 1) {
                paginationContainer.appendChild(createPaginationItem('1', 1));
                if (startPage > 2) {
                    const liDots = document.createElement('li');
                    liDots.className = 'page-item disabled';
                    liDots.innerHTML = '<span class="page-link">...</span>';
                    paginationContainer.appendChild(liDots);
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                paginationContainer.appendChild(createPaginationItem(i, i, i === currentPage));
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const liDots = document.createElement('li');
                    liDots.className = 'page-item disabled';
                    liDots.innerHTML = '<span class="page-link">...</span>';
                    paginationContainer.appendChild(liDots);
                }
                paginationContainer.appendChild(createPaginationItem(totalPages, totalPages));
            }


            // Next button
            paginationContainer.appendChild(createPaginationItem('›', currentPage + 1, false, currentPage === totalPages));
        }


        // --- Event Listeners ---
        cryptoSearchInput.addEventListener('input', () => {
            currentPage = 1; // Reset to first page on new search
            updateTableData();
        });

        perPageSelect.addEventListener('change', (e) => {
            itemsPerPage = parseInt(e.target.value);
            currentPage = 1; // Reset to first page when items per page changes
            updateTableData();
        });

        // Add event listeners for sortable headers
        document.querySelectorAll('.sortable').forEach(header => {
            header.addEventListener('click', () => {
                const sortKey = header.dataset.sort;

                // Toggle sort direction if clicking the same column
                if (currentSort === sortKey) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    currentSort = sortKey;
                    sortDirection = 'desc'; // Default to descending for new sort column
                }

                // Remove existing sort indicators
                document.querySelectorAll('.sortable').forEach(h => h.classList.remove('asc', 'desc'));

                // Add new sort indicator
                header.classList.add(sortDirection);

                currentPage = 1; // Reset to first page on sort change
                updateTableData();
            });
        });

        // --- Initial Call ---
        // Start WebSocket connection when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            // Hide table and show loader initially
            if (loaderElement) {
                loaderElement.classList.remove('d-none');
            }
            if (cryptoTable) {
                cryptoTable.classList.add('d-none');
            }
            connectWebSocket();
        });

        // Features Slider Functionality
        (function() {
            const featuresGrid = document.getElementById('featuresGrid');
            const prevButton = document.getElementById('featuresSliderPrev');
            const nextButton = document.getElementById('featuresSliderNext');

            if (!featuresGrid || !prevButton || !nextButton) return;

            const cards = featuresGrid.querySelectorAll('.feature-card');
            let currentIndex = 0;

            function getCardsPerView() {
                return window.innerWidth <= 768 ? 1 : 3;
            }

            function getTotalSlides() {
                const cardsPerView = getCardsPerView();
                return Math.max(0, cards.length - cardsPerView);
            }

            function updateSlider() {
                const cardsPerView = getCardsPerView();
                const totalSlides = getTotalSlides();

                if (cards.length === 0) return;

                const container = featuresGrid.parentElement;
                const containerWidth = container.offsetWidth;
                const computedGap = window.getComputedStyle(featuresGrid).gap;
                const gapValue = parseFloat(computedGap) || 48;
                const cardWidth = (containerWidth - (cardsPerView - 1) * gapValue) / cardsPerView;
                const translateX = -currentIndex * (cardWidth + gapValue);

                featuresGrid.style.transform = `translateX(${translateX}px)`;

                prevButton.classList.toggle('disabled', currentIndex === 0);
                nextButton.classList.toggle('disabled', currentIndex >= totalSlides);
            }

            function handleResize() {
                const totalSlides = getTotalSlides();
                if (currentIndex > totalSlides) {
                    currentIndex = totalSlides;
                }
                updateSlider();
            }

            prevButton.addEventListener('click', () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateSlider();
                }
            });

            nextButton.addEventListener('click', () => {
                const totalSlides = getTotalSlides();
                if (currentIndex < totalSlides) {
                    currentIndex++;
                    updateSlider();
                }
            });

            window.addEventListener('resize', handleResize);

            updateSlider();
        })();

        // FAQ

        document.querySelectorAll(".faq-item").forEach(item => {
            item.querySelector(".faq-header").addEventListener("click", () => {
                item.classList.toggle("active");
            });
        });

        // CTA Navigation Buttons Functionality
        (function() {
            const ctaButtons = document.querySelectorAll('.cta-nav-btn');
            const ctaContent = {
                'BASKETS': {
                    leftIcon: '📊',
                    leftText: 'CryptoVault',
                    rightIcon: '💼',
                    rightText: 'Baskets',
                    textIcon: '💼',
                    title: 'Baskets',
                    description: 'CryptoVault is now available to millions of investors as a trusted platform for crypto basket investments. CryptoVault is built for diversified portfolios, professional curation, and risk management through expertly managed crypto collections.',
                    learnMore: 'LEARN MORE ABOUT CRYPTO BASKETS'
                },
                'GAMING': {
                    leftIcon: '🎮',
                    leftText: 'CryptoVault',
                    rightIcon: '🎯',
                    rightText: 'Gaming',
                    textIcon: '🎯',
                    title: 'Gaming',
                    description: 'Invest in the future of blockchain gaming with our curated Gaming crypto basket. This collection includes leading gaming tokens, metaverse projects, and play-to-earn platforms that are revolutionizing the gaming industry.',
                    learnMore: 'LEARN MORE ABOUT GAMING BASKETS'
                },
                'DEFI': {
                    leftIcon: '💱',
                    leftText: 'CryptoVault',
                    rightIcon: '🏦',
                    rightText: 'DeFi',
                    textIcon: '🏦',
                    title: 'DeFi',
                    description: 'Access the decentralized finance ecosystem through our DeFi basket. This professionally curated collection includes top DeFi protocols, lending platforms, DEX tokens, and yield farming opportunities for maximum returns.',
                    learnMore: 'LEARN MORE ABOUT DEFI BASKETS'
                },
                'LAYER 1': {
                    leftIcon: '⚡',
                    leftText: 'CryptoVault',
                    rightIcon: '🔗',
                    rightText: 'Layer 1',
                    textIcon: '🔗',
                    title: 'Layer 1',
                    description: 'Build your portfolio with foundational blockchain networks through our Layer 1 basket. This collection features leading blockchain platforms, smart contract networks, and infrastructure tokens that power the crypto ecosystem.',
                    learnMore: 'LEARN MORE ABOUT LAYER 1 BASKETS'
                },
                'TRADING': {
                    leftIcon: '📈',
                    leftText: 'CryptoVault',
                    rightIcon: '💹',
                    rightText: 'Trading',
                    textIcon: '💹',
                    title: 'Trading',
                    description: 'Optimize your trading strategy with our Trading basket. This collection includes exchange tokens, trading platform coins, and liquidity provider tokens designed for active traders seeking enhanced trading benefits and rewards.',
                    learnMore: 'LEARN MORE ABOUT TRADING BASKETS'
                }
            };

            function updateContent(category) {
                const content = ctaContent[category];
                if (!content) return;

                const textSection = document.querySelector('.cta-text-section');
                const visualSection = document.querySelector('.cta-visual-section');

                textSection.style.opacity = '0.5';
                visualSection.style.opacity = '0.5';

                setTimeout(() => {
                    document.getElementById('ctaLeftIcon').textContent = content.leftIcon;
                    document.getElementById('ctaLeftText').textContent = content.leftText;
                    document.getElementById('ctaRightIcon').textContent = content.rightIcon;
                    document.getElementById('ctaRightText').textContent = content.rightText;
                    document.getElementById('ctaTextIcon').textContent = content.textIcon;
                    document.getElementById('ctaTextTitle').textContent = content.title;
                    document.getElementById('ctaDescription').textContent = content.description;
                    document.getElementById('ctaLearnMore').innerHTML = content.learnMore +
                        ' <i class="fas fa-arrow-up-right"></i>';

                    textSection.style.opacity = '1';
                    visualSection.style.opacity = '1';
                }, 150);
            }

            ctaButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const category = button.textContent.trim();

                    ctaButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    updateContent(category);
                });
            });
        })();
        // Mobile navigation
        (function() {
            const toggle = document.querySelector('.menu-toggle');
            const mobileNav = document.getElementById('mobileNav');

            if (!toggle || !mobileNav) return;

            toggle.addEventListener('click', () => {
                mobileNav.classList.toggle('open');
            });

            document.addEventListener('click', (e) => {
                if (mobileNav.classList.contains('open')) {
                    if (!mobileNav.contains(e.target) && !toggle.contains(e.target)) {
                        mobileNav.classList.remove('open');
                    }
                }
            });
        })();
    </script> --}}
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

        // // Crypto Table Section
        // const binanceSocket = 'wss://stream.binance.com:9443/ws/!ticker@arr';
        // const coinMap = @json($coinMap);
        // const prices = {}; // Stores all incoming crypto data
        // let filteredAndSortedData = []; // Data after search and before pagination
        // let currentPage = 1;
        // let itemsPerPage = 10; // Default items per page, matching HTML default selected option
        // let currentSort = 'market_cap'; // Default sort key
        // let sortDirection = 'desc'; // Default sort direction (descending for market_cap)

        // // Elements
        // const cryptoBody = document.getElementById('crypto-body');
        // const cryptoSearchInput = document.getElementById('cryptoSearch'); // Corrected ID
        // const perPageSelect = document.getElementById('perPage'); // Corrected ID
        // const paginationContainer = document.getElementById('pagination');
        // const noResultsDiv = document.getElementById('noResults');
        // const loaderElement = document.getElementById('loader'); // Assuming you have a loader div
        // const cryptoTable = document.getElementById('crypto-table'); // Assuming you want to hide/show table

        // // --- WebSocket Connection ---
        // function connectWebSocket() {
        //     const ws = new WebSocket(binanceSocket);

        //     ws.onopen = () => {
        //         console.log('WebSocket connected.');
        //         // Assuming 'error-msg' is for general connection errors
        //         const errorMsgElement = document.getElementById('error-msg');
        //         if (errorMsgElement) {
        //             errorMsgElement.classList.add('d-none');
        //         }
        //         if (loaderElement) {
        //             loaderElement.classList.add('d-none'); // Hide loader on successful connection
        //         }
        //         if (cryptoTable) {
        //             cryptoTable.classList.remove('d-none'); // Show table once connected
        //         }
        //     };

        //     ws.onmessage = (event) => {
        //         const updates = JSON.parse(event.data);
        //         updates.forEach(coin => {
        //             const symbol = coin.s;
        //             const baseSymbol = symbol.replace('USDT', ''); // e.g., BTCUSDT -> BTC

        //             if (coinMap[baseSymbol]) {
        //                 // Update or add coin data
        //                 prices[symbol] = {
        //                     symbol: baseSymbol, // Use base symbol for easier mapping to CoinGecko data
        //                     fullSymbol: symbol, // Keep full symbol if needed elsewhere
        //                     name: coinMap[baseSymbol].name,
        //                     logo: coinMap[baseSymbol].logo,
        //                     market_cap: parseFloat(coinMap[baseSymbol].market_cap * 1000 ||
        //                         0), // Ensure it's a number, default to 0
        //                     price: parseFloat(coin.c),
        //                     change: parseFloat(coin.P),
        //                     volume: parseFloat(coin.q),
        //                 };
        //             }
        //         });
        //         // Every time new data arrives, re-filter, re-sort, and re-paginate
        //         updateTableData();
        //     };

        //     ws.onerror = (error) => {
        //         console.error('WebSocket error:', error);
        //         const errorMsgElement = document.getElementById('error-msg');
        //         if (errorMsgElement) {
        //             errorMsgElement.classList.remove('d-none');
        //         }
        //     };

        //     ws.onclose = (event) => {
        //         console.warn('WebSocket closed:', event.code, event.reason);
        //         // Reconnect after a delay if connection is closed unexpectedly
        //         setTimeout(connectWebSocket, 3000);
        //     };
        // }

        // // --- Data Processing and Rendering ---
        // function updateTableData() {
        //     let data = Object.values(prices); // Get all current crypto data

        //     // 1. Search Filtering
        //     const search = cryptoSearchInput.value.toLowerCase(); // Use cryptoSearchInput
        //     if (search) {
        //         data = data.filter(c =>
        //             c.name.toLowerCase().includes(search) ||
        //             c.symbol.toLowerCase().includes(search) ||
        //             c.fullSymbol.toLowerCase().includes(search) // Also search full symbol like BTCUSDT
        //         );
        //     }

        //     // Show/hide no results message
        //     if (data.length === 0 && search) {
        //         noResultsDiv.style.display = 'block';
        //         cryptoBody.innerHTML = ''; // Clear table body
        //         paginationContainer.innerHTML = ''; // Clear pagination
        //         return; // No data to display
        //     } else {
        //         noResultsDiv.style.display = 'none';
        //     }

        //     // 2. Sorting
        //     data.sort((a, b) => {
        //         const valA = a[currentSort];
        //         const valB = b[currentSort];

        //         if (valA === undefined || valB === undefined) {
        //             // Handle cases where a sort key might be missing (e.g., market_cap not available for all)
        //             return 0;
        //         }

        //         if (sortDirection === 'asc') {
        //             return valA - valB;
        //         } else {
        //             return valB - valA;
        //         }
        //     });

        //     filteredAndSortedData = data; // Store for pagination

        //     // 3. Pagination
        //     paginateData(); // Call paginateData to render the current page
        // }


        // function paginateData() {
        //     const totalPages = Math.ceil(filteredAndSortedData.length / itemsPerPage);
        //     const startIndex = (currentPage - 1) * itemsPerPage;
        //     const endIndex = startIndex + itemsPerPage;
        //     const paginated = filteredAndSortedData.slice(startIndex, endIndex);

        //     renderTable(paginated);
        //     renderPagination(totalPages);
        // }

        // function renderTable(dataToRender) {
        //     cryptoBody.innerHTML = ''; // Clear existing rows

        //     if (dataToRender.length === 0) {
        //         // This case is already handled in updateTableData for search results
        //         return;
        //     }

        //     let rankOffset = (currentPage - 1) * itemsPerPage; // Calculate rank based on current page
        //     dataToRender.forEach((coin, index) => {
        //         const rank = rankOffset + index + 1; // Rank is 1-based index on the current page

        //         // Determine text color for 24h Change
        //         const changeClass = coin.change >= 0 ? 'text-success' : 'text-danger';

        //         // Format numbers for display
        //         const formattedPrice = `$${coin.price.toFixed(2)}`;
        //         const formattedChange = `${coin.change.toFixed(2)}%`;
        //         const formattedVolume = `$${(coin.volume / 1e9).toFixed(2)}B`; // Billions
        //         const formattedMarketCap = coin.market_cap ? `$${(coin.market_cap / 1e12).toFixed(2)}B` :
        //             'N/A'; // Trillions, handle missing market_cap

        //         const row = `
        //         <tr>
        //             <td>${rank}</td>
        //             <td class="coin-name-col">
        //                 <img src="${coin.logo}" alt="${coin.name} logo" class="coin-logo">
        //                 <strong>${coin.name}</strong>
        //             </td>
        //             <td>${coin.symbol}</td> 
        //             <td>${formattedPrice}</td>
        //             <td class="${changeClass}">${formattedChange}</td>
        //             <td>${formattedMarketCap}</td>
        //             <td>${formattedVolume}</td>
        //         </tr>
        //     `;
        //         cryptoBody.insertAdjacentHTML('beforeend', row);
        //     });
        // }


        // function renderPagination(totalPages) {
        //     paginationContainer.innerHTML = ''; // Clear existing pagination

        //     if (totalPages <= 1) {
        //         return; // No need for pagination if only one page
        //     }

        //     const createPaginationItem = (text, page, isActive = false, isDisabled = false) => {
        //         const li = document.createElement('li');
        //         li.className = 'page-item';
        //         if (isActive) li.classList.add('active');
        //         if (isDisabled) li.classList.add('disabled');

        //         const a = document.createElement('a');
        //         a.className = 'page-link';
        //         a.href = '#';
        //         a.innerHTML = text;

        //         if (!isDisabled) {
        //             a.addEventListener('click', (e) => {
        //                 e.preventDefault();
        //                 currentPage = page;
        //                 paginateData();
        //             });
        //         }
        //         li.appendChild(a);
        //         return li;
        //     };

        //     // Previous button
        //     paginationContainer.appendChild(createPaginationItem('‹', currentPage - 1, false, currentPage === 1));

        //     // Page numbers
        //     const maxPagesToShow = 7; // Max number of page buttons to display
        //     let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
        //     let endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);

        //     if (endPage - startPage + 1 < maxPagesToShow) {
        //         startPage = Math.max(1, endPage - maxPagesToShow + 1);
        //     }

        //     if (startPage > 1) {
        //         paginationContainer.appendChild(createPaginationItem('1', 1));
        //         if (startPage > 2) {
        //             const liDots = document.createElement('li');
        //             liDots.className = 'page-item disabled';
        //             liDots.innerHTML = '<span class="page-link">...</span>';
        //             paginationContainer.appendChild(liDots);
        //         }
        //     }

        //     for (let i = startPage; i <= endPage; i++) {
        //         paginationContainer.appendChild(createPaginationItem(i, i, i === currentPage));
        //     }

        //     if (endPage < totalPages) {
        //         if (endPage < totalPages - 1) {
        //             const liDots = document.createElement('li');
        //             liDots.className = 'page-item disabled';
        //             liDots.innerHTML = '<span class="page-link">...</span>';
        //             paginationContainer.appendChild(liDots);
        //         }
        //         paginationContainer.appendChild(createPaginationItem(totalPages, totalPages));
        //     }


        //     // Next button
        //     paginationContainer.appendChild(createPaginationItem('›', currentPage + 1, false, currentPage === totalPages));
        // }


        // // --- Event Listeners ---
        // cryptoSearchInput.addEventListener('input', () => {
        //     currentPage = 1; // Reset to first page on new search
        //     updateTableData();
        // });

        // perPageSelect.addEventListener('change', (e) => {
        //     itemsPerPage = parseInt(e.target.value);
        //     currentPage = 1; // Reset to first page when items per page changes
        //     updateTableData();
        // });

        // // Add event listeners for sortable headers
        // document.querySelectorAll('.sortable').forEach(header => {
        //     header.addEventListener('click', () => {
        //         const sortKey = header.dataset.sort;

        //         // Toggle sort direction if clicking the same column
        //         if (currentSort === sortKey) {
        //             sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        //         } else {
        //             currentSort = sortKey;
        //             sortDirection = 'desc'; // Default to descending for new sort column
        //         }

        //         // Remove existing sort indicators
        //         document.querySelectorAll('.sortable').forEach(h => h.classList.remove('asc', 'desc'));

        //         // Add new sort indicator
        //         header.classList.add(sortDirection);

        //         currentPage = 1; // Reset to first page on sort change
        //         updateTableData();
        //     });
        // });

        // --- Initial Call ---
        // Start WebSocket connection when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            // Hide table and show loader initially
            if (loaderElement) {
                loaderElement.classList.remove('d-none');
            }
            if (cryptoTable) {
                cryptoTable.classList.add('d-none');
            }
            connectWebSocket();

            // Mobile navigation
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

                // Close on click outside
                document.addEventListener('click', (e) => {
                    if (mobileNav.classList.contains('open')) {
                        const isClickInside = mobileNav.contains(e.target) || menuToggle.contains(e.target);
                        if (!isClickInside) {
                            mobileNav.classList.remove('open');
                        }
                    }
                });

                // Close on navigation click
                mobileNav.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        mobileNav.classList.remove('open');
                    });
                });

                // Ensure nav is closed when resizing to desktop
                window.addEventListener('resize', () => {
                    if (window.innerWidth >= 890) {
                        mobileNav.classList.remove('open');
                    }
                });
            }
        });

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
        const coinsPerPage = 20;

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
