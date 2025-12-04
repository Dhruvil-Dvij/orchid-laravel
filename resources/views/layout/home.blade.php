@extends('layout.home-layout')
@section('content')
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Diversify with Crypto Baskets</h1>
                <p>Invest in curated cryptocurrency baskets instead of individual coins. Reduce risk, maximize returns
                    with professionally managed crypto collections.</p>
                <div class="hero-buttons">
                    <a href="#" class="btn-primary">Explore Baskets</a>
                    <a href="#crypto-prices" class="btn-secondary">View Live Prices</a>
                </div>
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <div class="container">
            <h2>Smart Crypto Baskets</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🗂️</div>
                    <h3>Diversified Baskets</h3>
                    <p>Invest in curated collections of cryptocurrencies instead of picking individual coins. Reduce
                        risk through professional diversification.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>One-Click Investment</h3>
                    <p>Buy entire crypto baskets with a single transaction. No need to research and purchase multiple
                        cryptocurrencies separately.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Expert Curation</h3>
                    <p>Baskets created by crypto experts based on themes like DeFi, Gaming, Layer 1s, and emerging
                        technologies.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Crypto Table Section -->
    <section class="crypto-table-section" id="crypto-prices">
        <div class="container">
            <h2>Live Crypto Prices</h2>
            <p class="section-subtitle">Track the performance of major crypto currencies in real-time</p>

            <!-- Search and Controls -->
            {{-- <div class="table-controls">
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
            </div> --}}
            <div style="display:flex; justify-content:space-between; margin-bottom:12px">
                <input type="text" id="searchInput" placeholder="Search by Coin Name or Symbol..."
                    style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 300px;">
                <div id="paginationControls" style="display: flex; gap: 8px; align-items: center;">
                    <button id="prevPageBtn" disabled>Previous</button>
                    <span id="pageInfo">Page 1 of 1</span>
                    <button id="nextPageBtn" disabled>Next</button>
                </div>
            </div>
            <div class="table-wrap table-container">
                <div class="center" id="listLoading">Loading coins from CoinGecko...</div>

                <table id="coinTable" class="table crypto-table" style="display:none;">
                    <thead>
                        <tr>
                            <th>Coin</th>
                            <th>Symbol</th>
                            <th>Price</th>
                            <th>24h%</th>
                            <th>24h Volume</th>
                            <th>Market Cap</th>
                        </tr>
                    </thead>
                    <tbody id="coinTableBody"></tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination" id="pagination">
                <!-- Pagination will be populated by JavaScript -->
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2>Start Building Your Crypto Basket</h2>
            <p>Join thousands of investors who trust CryptoVault with their diversified crypto investments. Start with
                professionally curated baskets today.</p>
            <a href="#" class="btn-primary">Browse Baskets</a>
        </div>
    </section>
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
                const formattedMarketCap = coin.market_cap ? `$${(coin.market_cap / 1e12).toFixed(2)}T` :
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

        // Optional: A fallback interval to force update table cells if the WS 
        // updates are sparse, although generally not needed for Binance's !ticker@arr
        // setInterval(updateTableCells, 1000); 
    </script>
@endsection
