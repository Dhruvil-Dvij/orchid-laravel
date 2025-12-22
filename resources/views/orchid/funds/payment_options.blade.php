<div class="payment-options-container">
    <div class="payment-options-header">
        <h2 class="payment-options-title">Payment Options</h2>
        
    </div>

    <div class="payment-options-content">
        <div class="payment-options-left">
            <h3 class="payment-section-title">Recommended</h3>
            
            <div class="payment-method-item active" data-target-panel="upi">
                <div class="payment-method-header">
                    <span class="payment-method-name">UPI</span>
                    <span class="savings-badge">2 Offers</span>
                </div>
                <div class="payment-method-icons">
                    <div class="payment-icon payment-icon-gpay">
                        <img src="{{ asset('images/google-pay-icon.svg') }}" alt="Google Pay">
                    </div>
                    <div class="payment-icon payment-icon-phonepe">
                        <img src="{{ asset('images/phonepe-icon.svg') }}" alt="PhonePe">
                    </div>
                    <div class="payment-icon payment-icon-paytm">
                        <img src="{{ asset('images/paytm-icon.svg') }}" alt="Paytm">
                    </div>
                    <div class="payment-icon payment-icon-pop">
                        <img src="{{ asset('images/pop.svg') }}" alt="POP Pay">
                    </div>
                </div>
            </div>

            <div class="payment-method-item" data-target-panel="cards">
                <div class="payment-method-header">
                    <span class="payment-method-name">Cards</span>
                    <span class="savings-badge">3 Offers</span>
                </div>
                <div class="payment-method-icons">
                    <div class="payment-icon payment-icon-visa">
                        <img src="{{ asset('images/visa.svg') }}" alt="Visa">
                    </div>
                    <div class="payment-icon payment-icon-mastercard">
                        <img src="{{ asset('images/mastercard.svg') }}" alt="Mastercard">
                    </div>
                    <div class="payment-icon payment-icon-rupay">
                        <img src="{{ asset('images/rupay.svg') }}" alt="RuPay">
                    </div>
                    <div class="payment-icon payment-icon-amex">
                        <img src="{{ asset('images/amex.svg') }}" alt="American Express">
                    </div>
                </div>
            </div>

            <div class="payment-method-item" data-target-panel="wallet">
                <div class="payment-method-header">
                    <span class="payment-method-name">Wallet</span>
                    <span class="savings-badge">Get ₹10 assured cashback</span>
                </div>
                <div class="payment-method-icons">
                    <div class="payment-icon payment-icon-jiomoney">
                        <img src="{{ asset('images/amazonpay.png') }}" alt="PhonePe Wallet">
                    </div>
                    <div class="payment-icon payment-icon-mobikwik">
                    <img src="{{ asset('images/phonepe-icon.svg') }}" alt="PhonePe">
                    </div>
                    <div class="payment-icon payment-icon-airtel">
                        <img src="{{ asset('images/mobikwik.png') }}" alt="GPay Wallet">
                    </div>
                    <div class="payment-icon payment-icon-freecharge">
                        <img src="{{ asset('images/airtelmoney.png') }}" alt="POP Wallet">
                    </div>
                </div>
            </div>

            <div class="payment-method-item" data-target-panel="netbanking">
                <div class="payment-method-header">
                    <span class="payment-method-name">Bank Transfer</span>
                    <span class="savings-badge">Get ₹10 assured cashback</span>
                </div>
                <div class="payment-method-icons">
                    <div class="payment-icon payment-icon-sbi">
                    <img src="{{ asset('images/state-bank-of-india.png') }}" alt="POP Wallet">
                    </div>
                    <div class="payment-icon payment-icon-hdfc">
                    <img src="{{ asset('images/hdfc.png') }}" alt="POP Wallet">

                    </div>
                    <div class="payment-icon payment-icon-icici">
                    <img src="{{ asset('images/icici-bank-logo.png') }}" alt="POP Wallet">

                    </div>
                    <div class="payment-icon payment-icon-axis">
                    <img src="{{ asset('images/kotak-mahindra.png') }}" alt="POP Wallet">

                    </div>
                  
                </div>
            </div>

            
        </div>

        <div class="payment-options-right">
           

            <div class="payment-panels">
                <div class="payment-panel active" data-panel="upi">
                    <div class="upi-qr-section">
                        <div class="upi-qr-header">
                            <h3 class="payment-section-title">UPI QR</h3>
                            <div class="qr-timer">
                                {{-- <i class="fa-solid fa-clock"></i>
                                <span>6:07</span> --}}
                            </div>
                        </div>
                        <div class="upi-qr-content">
                            <div class="qr-code-container">
                                <div class="qr-code-placeholder">
                                    <img src="{{ !empty($payment_details->qr_code_img) ? asset($payment_details->qr_code_img) : asset('images/qr-code.png') }}" alt="UPI QR Code" class="qr-code-image">
                                </div>
                            </div>
                            <div class="upi-qr-info">
                                <p class="qr-instruction">Scan the QR using any UPI App</p>
                                <div class="upi-apps-icons">
                            <div class="payment-icon payment-icon-pop">
                                <img src="{{ asset('images/pop.svg') }}" alt="POP Pay">
                            </div>
                            <div class="payment-icon payment-icon-gpay-large">
                                <img src="{{ asset('images/google-pay-icon.svg') }}" alt="Google Pay">
                            </div>
                            <div class="payment-icon payment-icon-cred">
                                <img src="{{ asset('images/paytm-icon.svg') }}" alt="Paytm">
                            </div>
                            <div class="payment-icon payment-icon-phonepe-large">
                                <img src="{{ asset('images/phonepe-icon.svg') }}" alt="PhonePe">
                            </div>
                            <div class="payment-icon payment-icon-amazonpay">
                                <img src="{{ asset('images/rupay.svg') }}" alt="RuPay UPI">
                            </div>
                                </div>
                                <span class="savings-badge">Upto 1.5% savings with NeuCard UPI txns</span>
                            </div>
                        </div>
                    </div>
                    <div class="upi-id-section">
                        <h4 class="upi-id-title">UPI ID</h4>
                        <div class="upi-id-row">
                            <div class="upi-id-display">
                                <span class="upi-id-value">{{$payment_details->upi_id ?? ''}}</span>
                            </div>
                            <button class="upi-id-btn" type="button" id="copyUpiIdBtn">Copy UPI ID</button>
                        </div>
                    </div>
                </div>

                <div class="payment-panel" data-panel="cards">
                    {{-- <div class="card-form">
                        <h3 class="payment-section-title">Add a new card</h3>
                        <div class="card-form-fields">
                            <input type="text" class="card-input" placeholder="Card Number">
                            <div class="card-input-row">
                                <input type="text" class="card-input" placeholder="MM / YY">
                                <input type="text" class="card-input" placeholder="CVV">
                            </div>
                            <input type="text" class="card-input" placeholder="Enter name on card">
                        </div>
                        <label class="card-save-checkbox">
                            <input type="checkbox">
                            <span>Save this card as per RBI guidelines</span>
                        </label>
                        <button class="continue-btn">Coming Soon</button>
                    </div> --}}

                    <div class="coming-soon-section">
                        <div class="coming-soon-content">
                            <i class="fa-solid fa-wallet coming-soon-icon"></i>
                            <h3 class="coming-soon-title">Coming Soon</h3>
                            <p class="coming-soon-text">Cards payment options will be available soon.</p>
                        </div>
                    </div>
                </div>

                <div class="payment-panel" data-panel="netbanking">
                    <div class="netbanking-section">
                        

                        <div class="nb-account-details">
                            <div class="nb-account-header">
                                <h3 class="nb-section-title">Account Details</h3>
                                <button class="nb-copy-btn" type="button" id="copyAccountDetailsBtn">
                                    <i class="fa-solid fa-copy"></i> Copy
                                </button>
                            </div>
                            <div class="nb-account-card">
                                <div class="nb-detail-row">
                                    <span class="nb-detail-label">Bank Name:</span>
                                    <span class="nb-detail-value" id="bankName">{{$payment_details->bank_name ?? '-'}}</span>
                                </div>
                                <div class="nb-detail-row">
                                    <span class="nb-detail-label">Account:</span>
                                    <span class="nb-detail-value" id="accountNumber">{{$payment_details->account_number ?? '-'}}</span>
                                </div>
                                <div class="nb-detail-row">
                                    <span class="nb-detail-label">IFSC:</span>
                                    <span class="nb-detail-value" id="ifscCode">{{$payment_details->ifsc_code ?? '-'}}</span>
                                </div>
                                <div class="nb-detail-row">
                                    <span class="nb-detail-label">A/c Holder Name:</span>
                                    <span class="nb-detail-value" id="accountHolderName">{{$payment_details->bank_account_holder ?? '-'}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="payment-panel" data-panel="wallet">
                    <div class="coming-soon-section">
                        <div class="coming-soon-content">
                            <i class="fa-solid fa-wallet coming-soon-icon"></i>
                            <h3 class="coming-soon-title">Coming Soon</h3>
                            <p class="coming-soon-text">Wallet payment options will be available soon.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyUpiId(event) {
    const upiId = 'patelkb89-2@okhdfcbank';
    navigator.clipboard.writeText(upiId).then(function() {
        const btn = event.target;
        const originalText = btn.textContent;
        btn.textContent = 'Copied!';
        btn.style.background = '#00FFA3';
        setTimeout(function() {
            btn.textContent = originalText;
            btn.style.background = '';
        }, 2000);
    }).catch(function(err) {
        console.error('Failed to copy UPI ID:', err);
    });
}
</script>

@push('scripts')
<script>
document.addEventListener('turbo:load', () => {
    const items = document.querySelectorAll('.payment-method-item[data-target-panel]');
    const panels = document.querySelectorAll('.payment-panel');

    const activatePanel = (target) => {
        panels.forEach(panel => {
            panel.classList.toggle('active', panel.dataset.panel === target);
        });
        items.forEach(item => {
            item.classList.toggle('active', item.dataset.targetPanel === target);
        });
    };

    items.forEach(item => {
        item.addEventListener('click', () => activatePanel(item.dataset.targetPanel));
    });

    const copyUpiIdBtn = document.getElementById('copyUpiIdBtn');
    if (copyUpiIdBtn) {
        copyUpiIdBtn.addEventListener('click', function() {
            const upiId = "{{$payment_details->upi_id ?? 'Coming soon'}}";
            const btn = this;
            const originalText = btn.textContent;
            const originalBg = btn.style.background;

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(upiId).then(function() {
                    btn.textContent = 'Copied!';
                    btn.style.background = '#00FFA3';
                    btn.style.color = '#000';
                    setTimeout(function() {
                        btn.textContent = originalText;
                        btn.style.background = originalBg || '';
                        btn.style.color = '';
                    }, 2000);
                }).catch(function(err) {
                    console.error('Failed to copy UPI ID:', err);
                    fallbackCopyTextToClipboard(upiId, btn, originalText, originalBg);
                });
            } else {
                fallbackCopyTextToClipboard(upiId, btn, originalText, originalBg);
            }
        });
    }

    function fallbackCopyTextToClipboard(text, btn, originalText, originalBg) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        textArea.style.top = '-999999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            const successful = document.execCommand('copy');
            if (successful) {
                btn.textContent = 'Copied!';
                btn.style.background = '#00FFA3';
                btn.style.color = '#000';
                setTimeout(function() {
                    btn.textContent = originalText;
                    btn.style.background = originalBg || '';
                    btn.style.color = '';
                }, 2000);
            } else {
                alert('Failed to copy UPI ID. Please copy manually: ' + text);
            }
        } catch (err) {
            console.error('Fallback copy failed:', err);
            alert('Failed to copy UPI ID. Please copy manually: ' + text);
        } finally {
            document.body.removeChild(textArea);
        }
    }

    const copyAccountDetailsBtn = document.getElementById('copyAccountDetailsBtn');
    if (copyAccountDetailsBtn) {
        copyAccountDetailsBtn.addEventListener('click', function() {
            const bankNameEl = document.getElementById('bankName');
            const accountNumberEl = document.getElementById('accountNumber');
            const ifscCodeEl = document.getElementById('ifscCode');
            const accountHolderEl = document.getElementById('accountHolderName');
            
            const bankName = bankNameEl ? bankNameEl.textContent.trim() : '';
            const accountNumber = accountNumberEl ? accountNumberEl.textContent.trim() : '';
            const ifscCode = ifscCodeEl ? ifscCodeEl.textContent.trim() : '';
            const accountHolder = accountHolderEl ? accountHolderEl.textContent.trim() : '';
            
            const accountDetails = `Bank Name: ${bankName}\nAccount: ${accountNumber}\nIFSC: ${ifscCode}\nA/c Holder Name: ${accountHolder}`;
            
            const btn = this;
            const originalText = btn.innerHTML;
            const originalBg = btn.style.background || '';
            const originalColor = btn.style.color || '';
            
            const copyToClipboard = (text) => {
                if (navigator.clipboard && window.isSecureContext) {
                    return navigator.clipboard.writeText(text);
                } else {
                    return new Promise((resolve, reject) => {
                        const textArea = document.createElement('textarea');
                        textArea.value = text;
                        textArea.style.position = 'fixed';
                        textArea.style.left = '-999999px';
                        textArea.style.top = '-999999px';
                        document.body.appendChild(textArea);
                        textArea.focus();
                        textArea.select();
                        
                        try {
                            const successful = document.execCommand('copy');
                            document.body.removeChild(textArea);
                            if (successful) {
                                resolve();
                            } else {
                                reject(new Error('Copy command failed'));
                            }
                        } catch (err) {
                            document.body.removeChild(textArea);
                            reject(err);
                        }
                    });
                }
            };
            
            copyToClipboard(accountDetails).then(function() {
                btn.innerHTML = '<i class="fa-solid fa-check"></i> Copied';
                btn.style.background = '#00FFA3';
                btn.style.color = '#000';
                setTimeout(function() {
                    btn.innerHTML = originalText;
                    btn.style.background = originalBg;
                    btn.style.color = originalColor;
                }, 2000);
            }).catch(function(err) {
                console.error('Failed to copy account details:', err);
                alert('Failed to copy account details. Please copy manually:\n\n' + accountDetails);
            });
        });
    }
});
</script>
@endpush
