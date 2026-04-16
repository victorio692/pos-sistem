<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Meja - POS Restoran</title>
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
            background: linear-gradient(135deg, #f0f4f8 0%, #f8fafb 50%, #f0f2f5 100%);
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            color: #1a202c;
        }
        
        .header-section {
            background: linear-gradient(135deg, #ffffff 0%, #f7fafc 100%);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 4px 12px rgba(0, 0, 0, 0.03);
            flex-shrink: 0;
            z-index: 50;
            padding: 24px 32px;
        }
        
        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        
        .header-title {
            flex: 1;
        }
        
        .header-title h1 {
            font-size: 32px;
            font-weight: 800;
            color: #1a202c;
            letter-spacing: -0.5px;
            margin: 0;
        }
        
        .header-title p {
            font-size: 14px;
            color: #718096;
            margin: 4px 0 0 0;
            font-weight: 500;
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .time-display {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #2D2D2D;
            font-weight: 500;
        }
        
        .time-display .material-icons {
            color: #6C757D;
            font-size: 18px;
        }
        
        .time-display span:not(.material-icons) {
            color: #2D2D2D;
            font-weight: 600;
        }
        
        .user-badge {
            background: rgba(148, 163, 184, 0.15);
            color: #334155;
            padding: 6px 12px;
            border-radius: 8px;
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
        
        .logout-btn {
            background: linear-gradient(135deg, #ef4444 0%, #e53e3e 100%);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
            display: none;
            align-items: center;
            gap: 6px;
        }
        
        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.25);
        }
        
        .logout-btn:active {
            transform: translateY(0);
        }
        
        /* STATS CARDS */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(226, 232, 240, 0.6);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-color: rgba(226, 232, 240, 1);
        }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        
        .stat-available .stat-icon {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(20, 184, 166, 0.1));
            color: #16a34a;
        }
        
        .stat-occupied .stat-icon {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(249, 115, 22, 0.1));
            color: #dc2626;
        }
        
        .stat-info {
            flex: 1;
        }
        
        .stat-label {
            font-size: 12px;
            color: #718096;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 4px;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 800;
            color: #1a202c;
        }
        
        .stat-available .stat-value {
            background: linear-gradient(135deg, #16a34a, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .stat-occupied .stat-value {
            background: linear-gradient(135deg, #dc2626, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .main-content {
            flex: 1;
            overflow-y: auto;
            padding: 32px;
        }
        
        .main-content::-webkit-scrollbar {
            width: 8px;
        }
        
        .main-content::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .main-content::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }
        
        .main-content::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.3);
        }
        
        /* TABLE GRID */
        .table-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        
        @media (max-width: 1024px) {
            .table-grid {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
                gap: 16px;
            }
        }
        
        @media (max-width: 640px) {
            .table-grid {
                grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
                gap: 12px;
            }
        }
        
        /* TABLE CARD */
        .table-card {
            background: white;
            border-radius: 16px;
            border: 2px solid rgba(226, 232, 240, 0.8);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 24px;
            text-align: center;
            min-height: 160px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 12px;
            position: relative;
            overflow: hidden;
        }
        
        .table-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.5), transparent);
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.3s ease;
        }
        
        .table-card:hover {
            border-color: rgba(59, 130, 246, 0.5);
            box-shadow: 0 12px 32px rgba(59, 130, 246, 0.12), 0 2px 8px rgba(0, 0, 0, 0.04);
            transform: translateY(-8px);
        }
        
        .table-card:hover::before {
            transform: scaleX(1);
        }
        
        .table-card.occupied {
            background: rgba(249, 115, 22, 0.03);
            border-color: rgba(239, 68, 68, 0.2);
            cursor: not-allowed;
            opacity: 0.6;
        }
        
        .table-card.occupied:hover {
            transform: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            border-color: rgba(239, 68, 68, 0.2);
        }
        
        .table-icon {
            font-size: 48px;
            display: block;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .table-card:hover .table-icon:not(.table-card.occupied .table-icon) {
            transform: scale(1.1) rotate(5deg);
        }
        
        .table-number {
            font-size: 20px;
            font-weight: 800;
            color: #1a202c;
            letter-spacing: -0.3px;
            margin: 4px 0 0 0;
        }
        
        .table-capacity {
            font-size: 13px;
            color: #718096;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            margin: 2px 0;
        }
        
        .table-status {
            font-size: 12px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 12px;
            text-transform: uppercase;
            letter-spacing: 0.2px;
            display: inline-block;
            margin-top: 4px;
        }
        
        .status-available {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(20, 184, 166, 0.1));
            color: #16a34a;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }
        
        .status-occupied {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(249, 115, 22, 0.1));
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        
        .table-guest-info {
            font-size: 12px;
            color: #ec4899;
            font-weight: 600;
            margin-top: 4px;
        }
        
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            grid-column: 1 / -1;
        }
        
        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 20px;
            display: block;
        }
        
        .empty-state-text {
            color: #718096;
            font-size: 16px;
            font-weight: 600;
        }

        /* FINISH TABLE BUTTON */
        .finish-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
            display: none;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
            width: 100%;
            justify-content: center;
        }

        .table-card.occupied:hover .finish-btn {
            display: flex;
        }

        .finish-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .finish-btn:active {
            transform: translateY(0);
        }

        .finish-btn .material-icons {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <div class="header-section">
        <div class="header-top">
            <div class="header-title">
                <h1>Pilih Meja</h1>
                <p>Kelola meja restoran Anda</p>
            </div>
            <div class="header-actions">
                <div class="time-display">
                    <span class="material-icons" style="font-size: 16px;">calendar_today</span>
                    <span id="current-date"></span>
                </div>
                <div class="user-badge">
                    <span class="material-icons" style="font-size: 16px;">person</span>
                    <span><?php echo session()->get('username') ?? 'kasir'; ?></span>
                </div>
                <form method="post" action="<?php echo base_url('auth/logout'); ?>" style="margin: 0;">
                    <button type="submit" class="logout-btn">
                        <span class="material-icons" style="font-size: 16px;">logout</span>
                        Logout
                    </button>
                </form>
            </div>
        </div>
        
        <div class="stats-container">
            <div class="stat-card stat-available">
                <div class="stat-icon">📊</div>
                <div class="stat-info">
                    <div class="stat-label">Meja Tersedia</div>
                    <div class="stat-value" id="available-count">0</div>
                </div>
            </div>
            <div class="stat-card stat-occupied">
                <div class="stat-icon">👥</div>
                <div class="stat-info">
                    <div class="stat-label">Meja Terisi</div>
                    <div class="stat-value" id="occupied-count">0</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="table-grid" id="tableGrid">
            <!-- Tables will be loaded here -->
        </div>
        
        <div class="empty-state" id="emptyState" style="display: none;">
            <div class="empty-state-icon">📭</div>
            <div class="empty-state-text">Tidak ada data meja</div>
        </div>
    </div>
    
    <script>
        // Sample table data - in real app, this would come from backend
        let tables = <?php echo json_encode($tables ?? []); ?>; // CHANGED: const → let untuk bisa di-reassign
        
        function loadTables() {
            const tableGrid = document.getElementById('tableGrid');
            const emptyState = document.getElementById('emptyState');
            
            if (!tables || tables.length === 0) {
                tableGrid.innerHTML = '';
                emptyState.style.display = 'block';
                document.getElementById('available-count').textContent = '0';
                document.getElementById('occupied-count').textContent = '0';
                return;
            }
            
            emptyState.style.display = 'none';
            
            let available = 0;
            let occupied = 0;
            let html = '';
            
            tables.forEach(table => {
                const isOccupied = table.status === 'occupied';
                if (isOccupied) occupied++; else available++;
                
                const statusClass = isOccupied ? 'occupied' : '';
                const statusText = isOccupied ? 'Terisi' : 'Tersedia';
                const statusBadgeClass = isOccupied ? 'status-occupied' : 'status-available';
                const guestText = table.guest_count ? `👥 ${table.guest_count} Tamu` : '';
                const clickHandler = isOccupied ? '' : `onclick="selectTable(${table.id})"`;
                const finishButton = isOccupied ? `<button class="finish-btn" onclick="finishTable(${table.id}, event)"><span class="material-icons">check_circle</span> Selesai</button>` : '';
                
                html += `
                    <div class="table-card ${statusClass}" ${clickHandler}>
                        <div class="table-icon">🍽️</div>
                        <div class="table-number">MEJA ${table.table_number}</div>
                        <div class="table-capacity">👥 Kapasitas: ${table.capacity || 2} Orang</div>
                        <div class="table-status ${statusBadgeClass}">${statusText}</div>
                        ${guestText ? `<div class="table-guest-info">${guestText}</div>` : ''}
                        ${finishButton}
                    </div>
                `;
            });
            
            tableGrid.innerHTML = html;
            document.getElementById('available-count').textContent = available;
            document.getElementById('occupied-count').textContent = occupied;
        }
        
        function selectTable(tableId) {
            // Redirect to order page for this table
            window.location.href = `<?php echo base_url('kasir/order/'); ?>${tableId}`;
        }

        function finishTable(tableId, event) {
            event.stopPropagation();
            
            // Confirm before finishing table
            if (!confirm('Konfirmasi: Tandai meja ini selesai digunakan?')) {
                return;
            }
            
            // Call API to finish table
            fetch('<?php echo base_url('kasir/finishTable/'); ?>' + tableId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message and refresh tables
                    alert('Meja berhasil dibebaskan');
                    loadTables();
                } else {
                    alert('Gagal membebaskan meja: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat membebaskan meja');
            });
        }
        
        function updateDate() {
            const now = new Date();
            const day = now.getDate();
            const month = now.toLocaleDateString('id-ID', { month: 'long' });
            const year = now.getFullYear();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('current-date').textContent = `${day} ${month} ${year} pukul ${hours}.${minutes}`;
        }
        
        // Initialize
        loadTables();
        updateDate();
        setInterval(updateDate, 60000);
        
        // Refresh tables setiap 5 detik (dipercepat dari 10 detik)
        setInterval(() => {
            console.log('[Tables Auto-Refresh] Fetching latest data...');
            fetch('<?php echo base_url('kasir/api/tables'); ?>')
                .then(r => {
                    console.log('[Tables Auto-Refresh] Response status:', r.status);
                    return r.json();
                })
                .then(data => {
                    console.log('[Tables Auto-Refresh] Data received:', data);
                    // Update tables data variable dengan data terbaru
                    if (data && Array.isArray(data)) {
                        tables = data;
                        console.log('[Tables Auto-Refresh] Tables variable updated');
                        // Refresh view dengan data baru
                        loadTables();
                    } else {
                        console.warn('[Tables Auto-Refresh] Data is not valid array:', data);
                    }
                })
                .catch(e => {
                    console.error('[Tables Auto-Refresh] Error:', e);
                });
        }, 5000); // 5 detik
    </script>
</body>
</html>
