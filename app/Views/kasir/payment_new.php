<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - POS Restoran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- LEFT: ORDER SUMMARY -->
        <div class="w-1/3 bg-white border-r border-gray-200 overflow-y-auto">
            <div class="p-6 border-b border-gray-200 sticky top-0 bg-white z-10">
                <h2 class="text-2xl font-bold text-gray-900">Ringkasan Pesanan</h2>
                <p class="text-sm text-gray-500 mt-1">Order #<?= $order['id'] ?></p>
            </div>

            <div class="p-6">
                <!-- Table & Customer Info -->
                <div class="bg-blue-50 rounded-lg p-4 mb-6 border border-blue-200">
                    <div class="flex items-center gap-3 mb-3">
                        <i class="fas fa-chair text-blue-600 text-xl"></i>
                        <div>
                            <p class="text-xs text-gray-600">Meja</p>
                            <p class="text-lg font-bold text-gray-900">Meja <?= $order['table_id'] ?></p>
                        </div>
                    </div>
                    <?php if (!empty($order['customer_name'])): ?>
                    <div class="flex items-center gap-3 mt-3 border-t border-blue-200 pt-3">
                        <i class="fas fa-user text-blue-600"></i>
                        <div>
                            <p class="text-xs text-gray-600">Nama Pelanggan</p>
                            <p class="font-semibold text-gray-900"><?= htmlspecialchars($order['customer_name']) ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($order['guest_count'])): ?>
                    <div class="flex items-center gap-3 mt-3 border-t border-blue-200 pt-3">
                        <i class="fas fa-users text-blue-600"></i>
                        <div>
                            <p class="text-xs text-gray-600">Jumlah Tamu</p>
                            <p class="font-semibold text-gray-900"><?= $order['guest_count'] ?> Orang</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Order Items -->
                <div class="mb-6">
                    <h3 class="font-bold text-gray-900 mb-3">Menu yang Dipesan</h3>
                    <div class="space-y-2 max-h-96 overflow-y-auto">
                        <?php foreach ($orderItems as $item): ?>
                        <div class="flex justify-between p-3 bg-gray-50 rounded border border-gray-200">
                            <div class="flex-1">
                                <p class="font-medium text-gray-900"><?= $item['name'] ?></p>
                                <p class="text-xs text-gray-500">x<?= $item['quantity'] ?></p>
                            </div>
                            <p class="font-bold text-gray-900">Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Total Summary -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 border border-blue-300">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-700">Subtotal</span>
                        <span class="font-semibold text-gray-900">Rp <?= number_format($totalAmount, 0, ',', '.') ?></span>
                    </div>
                    <div class="border-t border-blue-200 pt-2 mt-2">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-900">Total Pembayaran</span>
                            <span class="text-3xl font-bold text-blue-600">Rp <?= number_format($totalAmount, 0, ',', '.') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT: PAYMENT CONTENT -->
        <div class="flex-1 overflow-y-auto">
            <!-- STEP 1: SELECT PAYMENT METHOD -->
            <div id="step-select" class="p-8">
                <div class="max-w-2xl mx-auto">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Pilih Metode Pembayaran</h1>
                    <p class="text-gray-600 mb-8">Pilih salah satu metode pembayaran di bawah</p>

                    <!-- Payment Method Cards -->
                    <div class="grid grid-cols-1 gap-4">
                        <!-- CASH -->
                        <div class="payment-card-selector cursor-pointer bg-white border-2 border-gray-200 hover:border-green-400 hover:bg-green-50 rounded-xl p-6 transition duration-200" onclick="selectPaymentMethod('cash')">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-money-bill text-green-600 text-3xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900">Tunai (Cash)</h3>
                                    <p class="text-gray-600 mt-1">Bayar dengan uang tunai</p>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400 text-2xl"></i>
                            </div>
                        </div>

                        <!-- TRANSFER -->
                        <div class="payment-card-selector cursor-pointer bg-white border-2 border-gray-200 hover:border-blue-400 hover:bg-blue-50 rounded-xl p-6 transition duration-200" onclick="selectPaymentMethod('transfer')">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-bank text-blue-600 text-3xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900">Transfer Bank</h3>
                                    <p class="text-gray-600 mt-1">Transfer ke rekening tujuan</p>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400 text-2xl"></i>
                            </div>
                        </div>

                        <!-- QRIS -->
                        <div class="payment-card-selector cursor-pointer bg-white border-2 border-gray-200 hover:border-indigo-400 hover:bg-indigo-50 rounded-xl p-6 transition duration-200" onclick="selectPaymentMethod('qris')">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-indigo-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-qrcode text-indigo-600 text-3xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900">QRIS</h3>
                                    <p class="text-gray-600 mt-1">Scan dengan e-wallet atau mobile banking</p>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <button onclick="goBack()" class="mt-8 w-full px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-900 font-semibold rounded-lg transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Pesanan
                    </button>
                </div>
            </div>

            <!-- STEP 2: CASH PAYMENT -->
            <div id="step-cash" class="p-8 hidden">
                <div class="max-w-2xl mx-auto">
                    <div class="mb-6">
                        <button onclick="backToSelect()" class="text-blue-600 hover:text-blue-800 font-semibold">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali Pilih Metode
                        </button>
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Pembayaran Tunai</h1>
                    <p class="text-gray-600 mb-8">Masukkan jumlah uang tunai yang diterima</p>

                    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                        <p class="text-gray-600 text-sm mb-2">Total Pembayaran</p>
                        <p class="text-5xl font-bold text-gray-900 mb-8">Rp <?= number_format($totalAmount, 0, ',', '.') ?></p>

                        <!-- Cash Input -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Jumlah Uang Tunai</label>
                            <input type="number" id="cashAmount" class="w-full px-4 py-3 border-2 border-gray-300 focus:border-green-500 focus:outline-none rounded-lg text-lg font-semibold" placeholder="0" oninput="calculateCashChange()">
                        </div>

                        <!-- Change Display -->
                        <div id="changeDisplay" class="hidden">
                            <div class="p-4 rounded-lg mb-6" id="changeBox">
                                <p class="text-gray-600 text-sm mb-1">Kembalian</p>
                                <p class="text-3xl font-bold" id="changeAmount">Rp 0</p>
                            </div>
                        </div>

                        <!-- Warning Message -->
                        <div id="insufficientWarning" class="hidden bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                            <p class="text-red-700 font-semibold"><i class="fas fa-exclamation-circle mr-2"></i> Uang tidak cukup</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <button onclick="backToSelect()" class="flex-1 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-900 font-semibold rounded-lg transition duration-200">
                            Batal
                        </button>
                        <button id="cashConfirmBtn" onclick="confirmCashPayment()" class="flex-1 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            <i class="fas fa-check mr-2"></i> Bayar
                        </button>
                    </div>
                </div>
            </div>

            <!-- STEP 3: QRIS PAYMENT -->
            <div id="step-qris" class="p-8 hidden">
                <div class="max-w-2xl mx-auto">
                    <div class="mb-6">
                        <button onclick="backToSelect()" class="text-blue-600 hover:text-blue-800 font-semibold">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali Pilih Metode
                        </button>
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Pembayaran QRIS</h1>
                    <p class="text-gray-600 mb-8">Silakan scan QR code di bawah menggunakan e-wallet atau mobile banking Anda</p>

                    <!-- QR Code Section -->
                    <div class="bg-white rounded-xl border border-gray-200 p-8 mb-6 text-center">
                        <p class="text-gray-600 text-sm mb-4 font-semibold">SCAN QR CODE</p>
                        <div class="flex justify-center mb-6">
                            <div id="qrcode" class="bg-white p-4 rounded-lg border-2 border-gray-200"></div>
                        </div>
                        <p class="text-gray-600 mb-2">Total Pembayaran</p>
                        <p class="text-4xl font-bold text-gray-900">Rp <?= number_format($totalAmount, 0, ',', '.') ?></p>
                    </div>

                    <!-- Status Section -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-200 rounded-full flex items-center justify-center">
                                <i class="fas fa-hourglass-half text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Menunggu Pembayaran</p>
                                <p class="text-sm text-gray-600">Tunggu hingga pembayaran dikonfirmasi</p>
                            </div>
                        </div>
                    </div>

                    <!-- Instruction -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <p class="text-sm text-gray-700"><strong>Instruksi:</strong></p>
                        <ol class="text-sm text-gray-600 mt-2 space-y-1 list-decimal list-inside">
                            <li>Buka aplikasi e-wallet atau mobile banking Anda</li>
                            <li>Pilih fitur "Scan QRIS" atau "Bayar dengan QRIS"</li>
                            <li>Arahkan kamera ke QR code di atas</li>
                            <li>Verifikasi nominal dan konfirmasi pembayaran</li>
                        </ol>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <button onclick="backToSelect()" class="flex-1 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-900 font-semibold rounded-lg transition duration-200">
                            Batal
                        </button>
                        <button onclick="confirmQRISPayment()" class="flex-1 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition duration-200">
                            <i class="fas fa-check mr-2"></i> Sudah Dibayar
                        </button>
                    </div>
                </div>
            </div>

            <!-- STEP 4: TRANSFER PAYMENT -->
            <div id="step-transfer" class="p-8 hidden">
                <div class="max-w-2xl mx-auto">
                    <div class="mb-6">
                        <button onclick="backToSelect()" class="text-blue-600 hover:text-blue-800 font-semibold">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali Pilih Metode
                        </button>
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Pembayaran Transfer Bank</h1>
                    <p class="text-gray-600 mb-8">Transfer sesuai nominal ke rekening di bawah, kemudian konfirmasi pembayaran</p>

                    <!-- Bank Account Info -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                        <p class="text-gray-600 text-sm mb-4 font-semibold">REKENING TUJUAN</p>
                        
                        <div class="space-y-4">
                            <!-- Bank -->
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <p class="text-gray-600 text-sm mb-1">Nama Bank</p>
                                <p class="text-xl font-bold text-gray-900" id="bankName"><?= $bankAccount['bank_name'] ?? 'Bank BCA' ?></p>
                            </div>

                            <!-- Account Number -->
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <p class="text-gray-600 text-sm mb-1">Nomor Rekening</p>
                                <div class="flex items-center justify-between">
                                    <p class="text-2xl font-mono font-bold text-gray-900" id="accountNumber"><?= $bankAccount['account_number'] ?? '1234567890' ?></p>
                                    <button onclick="copyAccountNumber()" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded font-semibold">
                                        <i class="fas fa-copy mr-1"></i> Salin
                                    </button>
                                </div>
                            </div>

                            <!-- Account Holder -->
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <p class="text-gray-600 text-sm mb-1">Nama Penerima</p>
                                <p class="text-lg font-semibold text-gray-900" id="accountName"><?= $bankAccount['account_name'] ?? 'PT Restaurant Maju' ?></p>
                            </div>

                            <!-- Amount -->
                            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                                <p class="text-gray-600 text-sm mb-1">Nominal Transfer</p>
                                <p class="text-3xl font-bold text-green-600">Rp <?= number_format($totalAmount, 0, ',', '.') ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Instructions -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <p class="text-sm text-gray-700 font-semibold mb-2"><i class="fas fa-info-circle mr-2"></i> Instruksi:</p>
                        <ol class="text-sm text-gray-600 space-y-1 list-decimal list-inside">
                            <li>Buka aplikasi banking Anda (mobile/online banking)</li>
                            <li>Pilih transfer ke rekening lain</li>
                            <li>Masukkan data rekening di atas</li>
                            <li>Transfer sesuai nominal Rp <?= number_format($totalAmount, 0, ',', '.') ?></li>
                            <li>Kembali ke halaman ini dan klik "Konfirmasi Pembayaran"</li>
                        </ol>
                    </div>

                    <!-- Proof of Transfer (Optional) -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                        <p class="text-gray-600 text-sm mb-3 font-semibold">BUKTI TRANSFER (OPSIONAL)</p>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition">
                            <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                            <p class="text-gray-600 text-sm">Upload screenshot atau foto bukti transfer (opsional)</p>
                            <input type="file" id="proofFile" class="hidden" accept="image/*">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <button onclick="backToSelect()" class="flex-1 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-900 font-semibold rounded-lg transition duration-200">
                            Batal
                        </button>
                        <button onclick="confirmTransferPayment()" class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200">
                            <i class="fas fa-check mr-2"></i> Konfirmasi Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const orderId = <?= $order['id'] ?>;
        const totalAmount = <?= $totalAmount ?>;
        let currentStep = 'select';

        // Format currency
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }

        // Show step
        function showStep(step) {
            document.querySelectorAll('[id^="step-"]').forEach(el => el.classList.add('hidden'));
            document.getElementById(`step-${step}`).classList.remove('hidden');
            currentStep = step;
        }

        // Select payment method
        function selectPaymentMethod(method) {
            if (method === 'cash') {
                showStep('cash');
            } else if (method === 'qris') {
                showStep('qris');
                generateQRCode();
            } else if (method === 'transfer') {
                showStep('transfer');
            }
        }

        // Back to select
        function backToSelect() {
            showStep('select');
        }

        // Go back to order
        function goBack() {
            if (confirm('Batalkan pembayaran dan kembali ke pesanan?')) {
                window.location.href = '<?php echo base_url('kasir'); ?>';
            }
        }

        // ===== CASH PAYMENT =====
        function calculateCashChange() {
            const cashInput = document.getElementById('cashAmount');
            const cash = parseInt(cashInput.value) || 0;
            const changeDisplay = document.getElementById('changeDisplay');
            const changeBox = document.getElementById('changeBox');
            const changeAmount = document.getElementById('changeAmount');
            const insufficientWarning = document.getElementById('insufficientWarning');
            const confirmBtn = document.getElementById('cashConfirmBtn');

            if (cash > 0) {
                changeDisplay.classList.remove('hidden');
                const change = cash - totalAmount;

                if (change < 0) {
                    changeBox.className = 'p-4 rounded-lg mb-6 bg-red-50 border border-red-200';
                    changeAmount.className = 'text-2xl font-bold text-red-600';
                    changeAmount.textContent = `Kurang: ${formatCurrency(Math.abs(change))}`;
                    insufficientWarning.classList.remove('hidden');
                    confirmBtn.disabled = true;
                } else {
                    changeBox.className = 'p-4 rounded-lg mb-6 bg-green-50 border border-green-200';
                    changeAmount.className = 'text-3xl font-bold text-green-600';
                    changeAmount.textContent = formatCurrency(change);
                    insufficientWarning.classList.add('hidden');
                    confirmBtn.disabled = false;
                }
            } else {
                changeDisplay.classList.add('hidden');
                insufficientWarning.classList.add('hidden');
                confirmBtn.disabled = true;
            }
        }

        function confirmCashPayment() {
            const cash = parseInt(document.getElementById('cashAmount').value) || 0;
            if (cash < totalAmount) {
                alert('Uang tidak cukup!');
                return;
            }

            processPayment('cash', { cash_received: cash, change: cash - totalAmount });
        }

        // ===== QRIS PAYMENT =====
        function generateQRCode() {
            const qrcodeContainer = document.getElementById('qrcode');
            qrcodeContainer.innerHTML = ''; // Clear previous QR
            
            // Generate QRIS string (simplified - in production use proper QRIS library)
            const qrisString = `00020126360014com.midtrans${orderId}52040000530398405${totalAmount}6304${generateChecksum()}`;
            
            new QRCode(qrcodeContainer, {
                text: qrisString,
                width: 250,
                height: 250,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        }

        function generateChecksum() {
            return Math.floor(Math.random() * 10000).toString().padStart(4, '0');
        }

        function confirmQRISPayment() {
            if (confirm('Apakah pembayaran QRIS sudah diterima?')) {
                processPayment('qris', {});
            }
        }

        // ===== TRANSFER PAYMENT =====
        function copyAccountNumber() {
            const accountNumber = document.getElementById('accountNumber').textContent;
            navigator.clipboard.writeText(accountNumber).then(() => {
                alert('Nomor rekening berhasil disalin!');
            });
        }

        function confirmTransferPayment() {
            if (confirm('Apakah pembayaran transfer sudah dikonfirmasi?')) {
                processPayment('transfer', {});
            }
        }

        // ===== PROCESS PAYMENT =====
        function processPayment(method, extraData = {}) {
            const paymentData = {
                order_id: orderId,
                payment_method: method,
                amount: totalAmount,
                ...extraData
            };

            fetch('<?php echo base_url('kasir/processPayment'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(paymentData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = `<?php echo base_url('kasir/receipt/'); ?>${orderId}`;
                } else {
                    alert('Gagal memproses pembayaran: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan: ' + error.message);
            });
        }

        // Initialize
        showStep('select');
    </script>
</body>
</html>
