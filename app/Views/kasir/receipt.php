<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk - POS Restoran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            max-width: 500px;
            margin: 0 auto;
        }
        
        .receipt-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .receipt-header {
            background: linear-gradient(135deg, #6B8E6B 0%, #5a7c5a 100%);
            color: white;
            padding: 32px 24px;
            text-align: center;
            border-radius: 12px 12px 0 0;
        }
        
        .receipt-logo {
            font-size: 48px;
            margin-bottom: 12px;
        }
        
        .receipt-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 4px;
        }
        
        .receipt-subtitle {
            font-size: 12px;
            opacity: 0.9;
        }
        
        .receipt-body {
            padding: 32px;
        }
        
        .receipt-section {
            margin-bottom: 24px;
        }
        
        .section-heading {
            font-size: 11px;
            font-weight: 700;
            color: #6C757D;
            text-transform: uppercase;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e9ecef;
        }
        
        .receipt-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 13px;
        }
        
        .receipt-label {
            color: #6C757D;
        }
        
        .receipt-value {
            font-weight: 600;
            color: #2D2D2D;
        }
        
        .order-item-row {
            display: flex;
            margin-bottom: 12px;
            font-size: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .item-qty {
            width: 40px;
            color: #6C757D;
        }
        
        .item-name {
            flex: 1;
            color: #2D2D2D;
            font-weight: 500;
        }
        
        .item-price {
            text-align: right;
            color: #2D2D2D;
            font-weight: 600;
            width: 80px;
        }
        
        .summary-divider {
            height: 2px;
            background: #e9ecef;
            margin: 16px 0;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 13px;
        }
        
        .summary-row.total {
            font-size: 18px;
            font-weight: 700;
            color: #2D2D2D;
            margin-top: 12px;
        }
        
        .summary-row.total .value {
            color: #6B8E6B;
        }
        
        .summary-row.payment-method {
            font-size: 12px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e9ecef;
        }
        
        .receipt-footer {
            text-align: center;
            margin-top: 32px;
            padding-top: 16px;
            border-top: 2px solid #e9ecef;
        }
        
        .thank-you {
            font-size: 18px;
            font-weight: 700;
            color: #6B8E6B;
            margin-bottom: 8px;
        }
        
        .footer-text {
            font-size: 11px;
            color: #6C757D;
            margin-bottom: 4px;
        }
        
        .receipt-code {
            font-size: 24px;
            letter-spacing: 4px;
            font-weight: 700;
            color: #2D2D2D;
            margin: 16px 0;
            font-family: 'Courier New', monospace;
        }
        
        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
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
        
        .btn-print {
            background: #6B8E6B;
            color: white;
        }
        
        .btn-print:hover {
            background: #5a7c5a;
            transform: translateY(-2px);
        }
        
        .btn-home {
            background: white;
            border: 2px solid #6B8E6B;
            color: #6B8E6B;
        }
        
        .btn-home:hover {
            background: #e8f4f1;
        }
        
        @media print {
            body {
                background: white;
            }
            .action-buttons {
                display: none;
            }
            .container {
                max-width: 80mm;
            }
        }
    </style>
</head>
<body>
    <div class="container py-8">
        <div class="receipt-container">
            <!-- RECEIPT HEADER -->
            <div class="receipt-header">
                <div class="receipt-logo">🍽️</div>
                <div class="receipt-title">STRUK PEMBAYARAN</div>
                <div class="receipt-subtitle">POS RESTORAN</div>
            </div>
            
            <!-- RECEIPT BODY -->
            <div class="receipt-body">
                <!-- ORDER INFO -->
                <div class="receipt-section">
                    <div class="receipt-row">
                        <span class="receipt-label">Meja</span>
                        <span class="receipt-value">MEJA <?php echo $order['table_id'] ?? '-'; ?></span>
                    </div>
                    <div class="receipt-row">
                        <span class="receipt-label">Tanggal</span>
                        <span class="receipt-value"><?php echo date('d/m/Y H:i', strtotime($order['created_at'] ?? 'now')); ?></span>
                    </div>
                    <div class="receipt-row">
                        <span class="receipt-label">Pesanan #</span>
                        <span class="receipt-value">#<?php echo str_pad($order['id'], 6, '0', STR_PAD_LEFT); ?></span>
                    </div>
                </div>
                
                <!-- ORDER ITEMS -->
                <div class="receipt-section">
                    <div class="section-heading">Item Pesanan</div>
                    <?php foreach ($orderItems as $item): ?>
                        <div class="order-item-row">
                            <div class="item-qty"><?php echo $item['quantity']; ?>x</div>
                            <div class="item-name"><?php echo $item['name']; ?></div>
                            <div class="item-price">$<?php echo number_format($item['quantity'] * $item['price'], 2); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- PAYMENT SUMMARY -->
                <div class="receipt-section">
                    <div class="section-heading">Ringkasan Pembayaran</div>
                    <div class="summary-row">
                        <span class="receipt-label">Subtotal</span>
                        <span class="receipt-value">$<?php echo number_format($order['total_price'], 2); ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="receipt-label">Pajak (0%)</span>
                        <span class="receipt-value">$0.00</span>
                    </div>
                    <div class="summary-divider"></div>
                    <div class="summary-row total">
                        <span>TOTAL</span>
                        <span class="value">Rp <?php echo number_format($order['total_price'], 0, ',', '.'); ?>,-</span>
                    </div>
                    
                    <?php if ($payment): ?>
                        <div class="summary-row payment-method">
                            <span class="receipt-label">Metode Bayar</span>
                            <span class="receipt-value">
                                <?php 
                                    $methods = ['cash' => 'Tunai', 'card' => 'Kartu', 'qris' => 'QRIS'];
                                    echo $methods[$payment['payment_method']] ?? $payment['payment_method'];
                                ?>
                            </span>
                        </div>
                        
                        <?php if ($payment['payment_method'] === 'cash' && $payment['cash_received']): ?>
                            <div class="summary-row">
                                <span class="receipt-label">Uang Tunai</span>
                                <span class="receipt-value">Rp <?php echo number_format($payment['cash_received'], 0, ',', '.'); ?>,-</span>
                            </div>
                            <div class="summary-row">
                                <span class="receipt-label">Kembalian</span>
                                <span class="receipt-value">Rp <?php echo number_format($payment['change'], 0, ',', '.'); ?>,-</span>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                
                <!-- FOOTER -->
                <div class="receipt-footer">
                    <div class="thank-you">✓ TERIMA KASIH</div>
                    <div class="footer-text">Pembayaran berhasil diproses</div>
                    <div class="receipt-code"><?php echo strtoupper(substr(md5($order['id']), 0, 8)); ?></div>
                    <div class="footer-text">Silakan kembali lagi!</div>
                </div>
            </div>
        </div>
        
        <!-- ACTION BUTTONS -->
        <div class="action-buttons">
            <button class="btn btn-print" onclick="window.print()">🖨️ CETAK STRUK</button>
            <button class="btn btn-home" onclick="backToTables()">🏠 KEMBALI KE BERANDA</button>
        </div>
    </div>
    
    <script>
        function backToTables() {
            // Force refresh dengan cache busting - tambah timestamp
            const timestamp = new Date().getTime();
            const url = '<?php echo base_url('kasir'); ?>?t=' + timestamp;
            
            // Set header untuk prevent caching
            console.log('[Receipt] Navigating to tables with cache bust:', url);
            
            // Gunakan location.replace untuk force fresh load (tidak simpan di history)
            window.location.replace(url);
        }
        
        // Auto-print on page load (commented out for development)
        // window.addEventListener('load', () => {
        //     setTimeout(() => window.print(), 500);
        // });
    </script>
</body>
</html>
