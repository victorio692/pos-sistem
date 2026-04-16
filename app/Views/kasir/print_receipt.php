<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            background: white;
            padding: 0;
        }

        @media print {
            body {
                width: 80mm;
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }

        .receipt {
            width: 80mm;
            margin: 0 auto;
            padding: 10mm;
            background: white;
        }

        .header {
            text-align: center;
            margin-bottom: 10mm;
            border-bottom: 1px dashed #000;
            padding-bottom: 5mm;
        }

        .logo {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 3mm;
        }

        .restaurant-name {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 2mm;
        }

        .restaurant-info {
            font-size: 10px;
            line-height: 1.4;
            color: #333;
        }

        .transaction-info {
            font-size: 10px;
            margin-bottom: 8mm;
            border-bottom: 1px dashed #000;
            padding-bottom: 5mm;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2mm;
        }

        .info-label {
            font-weight: bold;
            width: 35%;
        }

        .info-value {
            width: 65%;
            text-align: right;
        }

        .items-section {
            margin-bottom: 8mm;
            border-bottom: 1px dashed #000;
            padding-bottom: 5mm;
        }

        .items-header {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            font-weight: bold;
            font-size: 9px;
            margin-bottom: 3mm;
            border-bottom: 1px solid #000;
            padding-bottom: 2mm;
        }

        .items-header-item {
            text-align: left;
        }

        .items-header-qty {
            text-align: center;
        }

        .items-header-price {
            text-align: right;
        }

        .item-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            font-size: 9px;
            margin-bottom: 2mm;
            line-height: 1.2;
        }

        .item-name {
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .item-qty {
            text-align: center;
        }

        .item-price {
            text-align: right;
        }

        .summary-section {
            margin-bottom: 8mm;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            margin-bottom: 2mm;
        }

        .summary-label {
            text-align: left;
        }

        .summary-value {
            text-align: right;
            min-width: 40mm;
        }

        .subtotal-row {
            border-bottom: 1px dashed #000;
            padding-bottom: 2mm;
            margin-bottom: 2mm;
        }

        .tax-row {
            font-size: 9px;
        }

        .service-row {
            font-size: 9px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 3mm;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 3mm 0;
        }

        .total-label {
            text-align: left;
        }

        .total-value {
            text-align: right;
            min-width: 40mm;
        }

        .payment-section {
            font-size: 10px;
            margin-bottom: 8mm;
        }

        .payment-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1mm;
        }

        .payment-method {
            font-weight: bold;
        }

        .cash-details {
            margin-top: 3mm;
            padding-top: 3mm;
            border-top: 1px dashed #000;
        }

        .change-row {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            margin-top: 2mm;
        }

        .footer {
            text-align: center;
            font-size: 9px;
            border-top: 1px dashed #000;
            padding-top: 5mm;
            color: #666;
        }

        .thank-you {
            font-weight: bold;
            margin-bottom: 3mm;
        }

        .footer-info {
            line-height: 1.4;
        }

        .print-button {
            display: block;
            margin: 10mm auto;
            padding: 10px 20px;
            background: #6B8E6B;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .print-button:hover {
            background: #5a7c5a;
        }

        @media print {
            .print-button {
                display: none;
            }
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="receipt">
        <!-- Header -->
        <div class="header">
            <div class="logo">🍽️ POS RESTORAN</div>
            <div class="restaurant-name">Restoran Makan Rapi</div>
            <div class="restaurant-info">
                Jl. Makan Enak No. 123<br>
                Phone: (021) 1234-5678<br>
                NPWP: 12.345.678.9-123.456
            </div>
        </div>

        <!-- Transaction Info -->
        <div class="transaction-info">
            <div class="info-row">
                <span class="info-label">Invoice:</span>
                <span class="info-value">#INV-<?php echo str_pad($order['id'], 5, '0', STR_PAD_LEFT); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Meja:</span>
                <span class="info-value"><?php echo $order['table_number'] ?? 'N/A'; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal:</span>
                <span class="info-value"><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Jumlah Tamu:</span>
                <span class="info-value"><?php echo $order['guest_count'] ?? 1; ?> orang</span>
            </div>
        </div>

        <!-- Items -->
        <div class="items-section">
            <div class="items-header">
                <div class="items-header-item">Menu</div>
                <div class="items-header-qty">Qty</div>
                <div class="items-header-price">Harga</div>
            </div>

            <?php 
            $subtotal = 0;
            foreach ($items as $item): 
                $itemSubtotal = $item['price'] * $item['quantity'];
                $subtotal += $itemSubtotal;
            ?>
                <div class="item-row">
                    <div class="item-name"><?php echo $item['name']; ?></div>
                    <div class="item-qty"><?php echo $item['quantity']; ?></div>
                    <div class="item-price">Rp<?php echo number_format($itemSubtotal, 0, ',', '.'); ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Summary -->
        <div class="summary-section">
            <div class="summary-row subtotal-row">
                <span class="summary-label">Subtotal:</span>
                <span class="summary-value">Rp<?php echo number_format($subtotal, 0, ',', '.'); ?></span>
            </div>

            <?php 
            $tax = $subtotal * 0.10;
            $service = $subtotal * 0.05;
            $total = $subtotal + $tax + $service;
            ?>

            <div class="summary-row tax-row">
                <span class="summary-label">Pajak (10%):</span>
                <span class="summary-value">Rp<?php echo number_format($tax, 0, ',', '.'); ?></span>
            </div>

            <div class="summary-row service-row">
                <span class="summary-label">Service (5%):</span>
                <span class="summary-value">Rp<?php echo number_format($service, 0, ',', '.'); ?></span>
            </div>

            <div class="total-row">
                <span class="total-label">TOTAL:</span>
                <span class="total-value">Rp<?php echo number_format($total, 0, ',', '.'); ?></span>
            </div>
        </div>

        <!-- Payment -->
        <?php if ($payment): ?>
        <div class="payment-section">
            <div class="payment-row">
                <span>Metode Pembayaran:</span>
                <span class="payment-method"><?php echo strtoupper($payment['payment_method']); ?></span>
            </div>
            <div class="payment-row">
                <span>Jumlah Bayar:</span>
                <span>Rp<?php echo number_format($payment['amount'], 0, ',', '.'); ?></span>
            </div>

            <?php if ($payment['cash_received']): ?>
            <div class="cash-details">
                <div class="payment-row">
                    <span>Uang Diterima:</span>
                    <span>Rp<?php echo number_format($payment['cash_received'], 0, ',', '.'); ?></span>
                </div>
                <div class="payment-row change-row">
                    <span>Kembalian:</span>
                    <span>Rp<?php echo number_format($payment['change'], 0, ',', '.'); ?></span>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Footer -->
        <div class="footer">
            <div class="thank-you">Terima Kasih!</div>
            <div class="footer-info">
                Kami tunggu kunjungan Anda berikutnya<br>
                <?php echo date('d/m/Y H:i'); ?>
            </div>
        </div>
    </div>

    <button class="print-button no-print" onclick="window.print()">🖨️ Cetak Struk</button>
</body>
</html>
