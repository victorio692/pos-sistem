<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - POS Restoran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        .playfair {
            font-family: 'Playfair Display', serif;
        }
        
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f5f5f5 100%);
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .header-section {
            background: white;
            border-bottom: 1px solid #e9ecef;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .payment-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #2D2D2D;
            margin-bottom: 16px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .payment-method {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .payment-method:hover {
            border-color: #6B8E6B;
            background: rgba(107, 142, 107, 0.05);
        }
        
        .payment-method.active {
            border-color: #6B8E6B;
            background: rgba(107, 142, 107, 0.1);
        }
        
        .payment-icon {
            font-size: 28px;
            width: 60px;
            text-align: center;
        }
        
        .payment-info {
            flex: 1;
        }
        
        .payment-name {
            font-weight: 600;
            color: #2D2D2D;
            font-size: 14px;
        }
        
        .payment-desc {
            font-size: 12px;
            color: #6C757D;
            margin-top: 2px;
        }
        
        .checkmark {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .payment-method.active .checkmark {
            background: #6B8E6B;
            border-color: #6B8E6B;
            color: white;
        }
        
        .order-items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        
        .order-items-table th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #2D2D2D;
            border-bottom: 2px solid #e9ecef;
        }
        
        .order-items-table td {
            padding: 12px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .qty-col {
            text-align: center;
            color: #6C757D;
        }
        
        .price-col {
            text-align: right;
            font-weight: 600;
            color: #2D2D2D;
        }
        
        .subtotal-row {
            background: #f8f9fa;
        }
        
        .summary-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 16px;
            margin-top: 16px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 13px;
        }
        
        .summary-label {
            color: #6C757D;
        }
        
        .summary-value {
            font-weight: 600;
            color: #2D2D2D;
        }
        
        .total-row {
            border-top: 2px solid #e9ecef;
            padding-top: 12px !important;
            color: #2D2D2D;
            font-size: 18px;
            font-weight: 700;
        }
        
        .total-row .summary-value {
            color: #6B8E6B;
            font-size: 20px;
        }
        
        .cash-input-section {
            display: none;
            margin-top: 16px;
            padding: 16px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        
        .cash-input-section.active {
            display: block;
        }
        
        .input-group {
            margin-bottom: 12px;
        }
        
        .input-label {
            font-size: 12px;
            font-weight: 600;
            color: #2D2D2D;
            margin-bottom: 6px;
            display: block;
        }
        
        .input-field {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 13px;
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            outline: none;
            border-color: #6B8E6B;
            box-shadow: 0 0 10px rgba(107, 142, 107, 0.2);
        }
        
        .change-row {
            display: flex;
            justify-content: space-between;
            padding: 12px;
            background: white;
            border-radius: 8px;
            margin-top: 12px;
            font-weight: 600;
        }
        
        .change-row.negative {
            background: #fde8e3;
            border-left: 4px solid #E76F51;
        }
        
        .change-row.positive {
            background: #e8f4f1;
            border-left: 4px solid #6B8E6B;
        }
        
        .change-label {
            color: #6C757D;
        }
        
        .change-value {
            color: #2D2D2D;
            font-size: 16px;
        }
        
        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }
        
        .btn {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 13px;
        }
        
        .btn-back {
            background: white;
            border: 2px solid #E76F51;
            color: #E76F51;
        }
        
        .btn-back:hover {
            background: #fde8e3;
        }
        
        .btn-process {
            background: #6B8E6B;
            color: white;
        }
        
        .btn-process:hover:not(:disabled) {
            background: #5a7c5a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(107, 142, 107, 0.25);
        }
        
        .btn-process:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
        
        .user-badge {
            background: rgba(148, 163, 184, 0.15);
            color: #334155;
            padding: 8px 14px;
            border-radius: 10px;
            border: 1px solid rgba(148, 163, 184, 0.2);
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .user-badge .material-icons {
            font-size: 18px;
            color: #2D2D2D;
        }
        
        .progress-bar {
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            margin-top: 12px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #6B8E6B 0%, #5a7c5a 100%);
            width: 67%;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <div class="header-section">
        <div class="flex items-center justify-between px-8 py-6">
            <div>
                <h1 class="text-3xl font-bold playfair text-[#2D2D2D]">Pembayaran Pesanan</h1>
                <p class="text-sm text-[#6C757D] mt-1">Pilih metode pembayaran untuk menyelesaikan transaksi</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-xs text-[#6C757D] flex items-center gap-2">
                    <span class="material-icons" style="font-size: 18px;">calendar_today</span>
                    <span id="currentDate">15 April 2026 pukul 10.00</span>
                </div>
                <div class="user-badge">
                    <span class="material-icons" style="font-size: 18px;">person</span>
                    <span><?php echo session('username') ?? 'kasir'; ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- MAIN CONTENT -->
    <div class="container p-8">
        <div class="grid grid-cols-3 gap-8">
            <!-- LEFT: PAYMENT METHODS & ORDER -->
            <div class="col-span-2">
                <!-- ORDER ITEMS -->
                <div class="payment-card p-6 mb-6">
                    <div class="section-title">📋 Rang yang Dipesan</div>
                    <table class="order-items-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th class="qty-col">Qty</th>
                                <th class="price-col">Harga</th>
                                <th class="price-col">Total</th>
                            </tr>
                        </thead>
                        <tbody id="orderItemsList">
                            <!-- Items will be loaded here -->
                        </tbody>
                        <tfoot>
                            <tr class="subtotal-row">
                                <td colspan="3" style="text-align: right; font-weight: 600;">SUBTOTAL</td>
                                <td class="price-col" id="subtotalDisplay">Rp 0,-</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <!-- PAYMENT METHODS -->
                <div class="payment-card p-6">
                    <div class="section-title">💳 Metode Pembayaran</div>
                    
                    <div class="space-y-3">
                        <!-- CASH -->
                        <div class="payment-method active" onclick="selectPaymentMethod('cash', this)">
                            <div class="payment-icon">💵</div>
                            <div class="payment-info">
                                <div class="payment-name">Tunai (Cash)</div>
                                <div class="payment-desc">Bayar dengan uang tunai</div>
                            </div>
                            <div class="checkmark">✓</div>
                        </div>
                        
                        <!-- QRIS -->
                        <div class="payment-method" onclick="selectPaymentMethod('qris', this)">
                            <div class="payment-icon">📱</div>
                            <div class="payment-info">
                                <div class="payment-name">QRIS</div>
                                <div class="payment-desc">Bayar dengan scan QRIS</div>
                            </div>
                            <div class="checkmark">✓</div>
                        </div>
                    </div>
                    
                    <!-- CASH INPUT SECTION -->
                    <div class="cash-input-section active" id="cashInputSection">
                        <div class="input-group">
                            <label class="input-label">Jumlah Uang Tunai</label>
                            <input type="number" id="cashInput" class="input-field" placeholder="Masukkan nominal pembayaran" oninput="calculateChange(); updateProcessButton();" onchange="updateProcessButton();" min="0">
                        </div>
                        <div class="change-row" id="changeDisplay" style="display: none;">
                            <span class="change-label">Kembalian</span>
                            <span class="change-value" id="changeValue">Rp 0,-</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- RIGHT: SUMMARY & ACTIONS -->
            <div class="col-span-1">
                <div class="payment-card p-6 sticky top-8">
                    <div class="section-title">📊 Ringkasan Pesanan</div>
                    
                    <div class="payment-card p-4 bg-[#f8f9fa] border-0 mb-4">
                        <div class="text-xs text-[#6C757D] mb-1">MEJA</div>
                        <div class="text-lg font-bold text-[#2D2D2D]">🍽️ MEJA <?php echo $order['table_id'] ?? '-'; ?></div>
                    </div>
                    
                    <div class="summary-section">
                        <div class="summary-row">
                            <span class="summary-label">Subtotal</span>
                            <span class="summary-value" id="summarySubtotal">Rp 0,-</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Pajak (0%)</span>
                            <span class="summary-value">Rp 0,-</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Diskon</span>
                            <span class="summary-value" id="discountDisplay">Rp 0,-</span>
                        </div>
                        <div class="summary-row total-row">
                            <span>TOTAL</span>
                            <span class="summary-value" id="totalDisplay">Rp 0,-</span>
                        </div>
                    </div>
                    
                    <div class="button-group">
                        <button class="btn btn-back" onclick="goBack()">← KEMBALI</button>
                        <button class="btn btn-process" id="processBtn" onclick="processPayment()" disabled>✓ BAYAR</button>
                    </div>
                    
                    <div class="progress-bar">
                        <div class="progress-fill"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Data from backend
        const order = <?php echo json_encode($order ?? []); ?>;
        const orderItems = <?php echo json_encode($orderItems ?? []); ?>;
        let selectedPaymentMethod = 'cash';
        
        // Format currency to Indonesian Rupiah
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(amount);
        }
        
        // Parse Rp formatted string to number
        function parseCurrency(str) {
            return parseInt(str.replace(/[^0-9]/g, '')) || 0;
        }
        
        function loadOrderItems() {
            const tbody = document.getElementById('orderItemsList');
            let html = '';
            let subtotal = 0;
            
            orderItems.forEach(item => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;
                html += `
                    <tr>
                        <td>${item.name}</td>
                        <td class="qty-col">${item.quantity}</td>
                        <td class="price-col">${formatCurrency(parseFloat(item.price))}</td>
                        <td class="price-col">${formatCurrency(itemTotal)}</td>
                    </tr>
                `;
            });
            
            tbody.innerHTML = html;
            document.getElementById('subtotalDisplay').textContent = formatCurrency(subtotal);
            document.getElementById('summarySubtotal').textContent = formatCurrency(subtotal);
            document.getElementById('totalDisplay').textContent = formatCurrency(subtotal);
        }
        
        function selectPaymentMethod(method, element) {
            selectedPaymentMethod = method;
            
            // Update UI - remove active from all methods
            document.querySelectorAll('.payment-method').forEach(el => {
                el.classList.remove('active');
            });
            
            // Add active to clicked method
            if (element) {
                element.classList.add('active');
            }
            
            // Show/hide cash input
            const cashSection = document.getElementById('cashInputSection');
            if (method === 'cash') {
                cashSection.classList.add('active');
            } else {
                cashSection.classList.remove('active');
            }
            
            updateProcessButton();
        }
        
        function calculateChange() {
            const cashInput = document.getElementById('cashInput').value;
            const total = parseCurrency(document.getElementById('totalDisplay').textContent);
            
            if (cashInput) {
                const cash = parseInt(cashInput) || 0;
                const change = cash - total;
                
                const changeDisplay = document.getElementById('changeDisplay');
                const changeValue = document.getElementById('changeValue');
                
                changeDisplay.style.display = 'flex';
                
                if (change < 0) {
                    changeDisplay.classList.remove('positive');
                    changeDisplay.classList.add('negative');
                    changeValue.textContent = `Kurang ${formatCurrency(Math.abs(change))}`;
                } else {
                    changeDisplay.classList.remove('negative');
                    changeDisplay.classList.add('positive');
                    changeValue.textContent = formatCurrency(change);
                }
            }
            
            updateProcessButton();
        }
        
        function updateProcessButton() {
            const btn = document.getElementById('processBtn');
            if (selectedPaymentMethod === 'cash') {
                const cashInput = document.getElementById('cashInput').value;
                const total = parseCurrency(document.getElementById('totalDisplay').textContent);
                const cash = parseInt(cashInput) || 0;
                btn.disabled = !cashInput || cash < total;
            } else {
                btn.disabled = false;
            }
        }
        
        function processPayment() {
            const total = parseCurrency(document.getElementById('totalDisplay').textContent);
            
            // Handle both object and array notation for order.id
            const orderId = order.id || order['id'];
            
            if (!orderId) {
                alert('Gagal: Order ID tidak ditemukan');
                console.error('Order object:', order);
                return;
            }
            
            let paymentData = {
                order_id: parseInt(orderId),
                payment_method: selectedPaymentMethod,
                amount: Math.round(total)
            };
            
            if (selectedPaymentMethod === 'cash') {
                const cash = parseInt(document.getElementById('cashInput').value) || 0;
                paymentData.cash_received = cash;
                paymentData.change = cash - total;
            }
            
            console.log('Mengiriman data pembayaran:', paymentData);
            console.log('URL endpoint:', '<?php echo base_url('kasir/payment/process'); ?>');
            
            // Disable button during processing
            const btn = document.getElementById('processBtn');
            btn.disabled = true;
            btn.textContent = 'Memproses...';
            
            // Send to server
            fetch('<?php echo base_url('kasir/payment/process'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(paymentData)
            })
            .then(response => {
                console.log('Response received - Status:', response.status);
                console.log('Response headers:', response.headers);
                
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error(`HTTP ${response.status}: ${text}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Data respons lengkap:', data);
                btn.textContent = '✓ BAYAR';
                
                if (data.success) {
                    console.log('Pembayaran sukses, redirect ke receipt');
                    window.location.href = `<?php echo base_url('kasir/receipt/'); ?>${data.order_id}`;
                } else {
                    btn.disabled = false;
                    alert('Gagal memproses pembayaran: ' + (data.message || 'Kesalahan tidak diketahui'));
                }
            })
            .catch(error => {
                console.error('Catch error:', error);
                btn.disabled = false;
                btn.textContent = '✓ BAYAR';
                alert('Terjadi kesalahan:\n' + error.message + '\n\nSilakan buka Developer Console (F12) untuk detail lebih lanjut.');
            });
        }
        
        function goBack() {
            if (confirm('Batalkan pembayaran dan kembali?')) {
                window.location.href = '<?php echo base_url('kasir'); ?>';
            }
        }
        
        function updateDate() {
            const now = new Date();
            const day = now.getDate();
            const month = now.toLocaleDateString('id-ID', { month: 'long' });
            const year = now.getFullYear();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('currentDate').textContent = `${day} ${month} ${year} pukul ${hours}.${minutes}`;
        }
        
        function goBack() {
            if (confirm('Batalkan pembayaran dan kembali?')) {
                window.location.href = '<?php echo base_url('kasir'); ?>';
            }
        }
        
        function updateDate() {
            const now = new Date();
            const day = now.getDate();
            const month = now.toLocaleDateString('id-ID', { month: 'long' });
            const year = now.getFullYear();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('currentDate').textContent = `${day} ${month} ${year} pukul ${hours}.${minutes}`;
        }
        
        // Initialize
        console.log('=== Inisialisasi halaman pembayaran ===');
        console.log('Order:', order);
        console.log('Order items:', orderItems);
        console.log('Selected payment method:', selectedPaymentMethod);
        
        if (orderItems && orderItems.length > 0) {
            console.log('Loading order items...');
            loadOrderItems();
        } else {
            console.warn('WARNING: Tidak ada order items!');
        }
        
        updateDate();
        setInterval(updateDate, 60000);
        
        // Enable button untuk QRIS atau cash jika sudah ada default
        console.log('Update process button after initialization...');
        updateProcessButton();
        console.log('Button disabled status:', document.getElementById('processBtn').disabled);
        console.log('=== Inisialisasi selesai ===');
    </script>
</body>
</html>
