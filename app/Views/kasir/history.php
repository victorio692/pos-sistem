<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Riwayat Transaksi - POS Restoran'; ?></title>
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
            background: #f8f9fa;
        }
        
        .header-bar {
            background: white;
            border-bottom: 1px solid #e9ecef;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }
        
        .breadcrumb {
            font-size: 13px;
            color: #6C757D;
        }
        
        .breadcrumb strong {
            color: #6B8E6B;
        }
        
        .user-badge {
            background: linear-gradient(135deg, #6B8E6B 0%, #5a7c5a 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(107, 142, 107, 0.2);
        }
        
        .sidebar {
            display: none;
        }
        
        .sidebar-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 16px;
            cursor: pointer;
            color: #6C757D;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            text-decoration: none;
        }
        
        .sidebar-item:hover {
            color: #6B8E6B;
            background: rgba(107, 142, 107, 0.1);
        }
        
        .sidebar-item.active {
            color: #6B8E6B;
            background: rgba(107, 142, 107, 0.15);
            border-left-color: #6B8E6B;
        }
        
        .material-icons {
            font-size: 24px;
            display: block;
            line-height: 1;
        }
        
        .sidebar-logo {
            padding: 16px;
            border-bottom: 1px solid #333;
            display: flex;
            justify-content: center;
        }
        
        .sidebar-logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #6B8E6B 0%, #5a7c5a 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 4px 12px rgba(107, 142, 107, 0.3);
        }
        
        .sidebar-logo-icon .material-icons {
            font-size: 20px;
        }
        
        .sidebar-bottom {
            margin-top: auto;
            padding: 16px;
            border-top: 1px solid #333;
        }

        /* Filter & Search Styles */
        .filter-section {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 24px;
        }

        .filter-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 16px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            font-size: 13px;
            font-weight: 600;
            color: #2D2D2D;
            margin-bottom: 6px;
        }

        .filter-buttons {
            display: flex;
            gap: 8px;
        }

        .filter-btn {
            padding: 8px 16px;
            border: 2px solid #e9ecef;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            color: #6C757D;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            border-color: #6B8E6B;
            color: #6B8E6B;
        }

        .filter-btn.active {
            background: #6B8E6B;
            color: white;
            border-color: #6B8E6B;
        }

        .search-input {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #6B8E6B;
            box-shadow: 0 0 0 3px rgba(107, 142, 107, 0.1);
        }

        /* Summary Cards */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .summary-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #6B8E6B;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .summary-label {
            font-size: 13px;
            color: #6C757D;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .summary-value {
            font-size: 24px;
            font-weight: 700;
            color: #6B8E6B;
        }

        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead {
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
        }

        .data-table th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
            color: #2D2D2D;
            font-size: 13px;
        }

        .data-table tbody tr {
            border-bottom: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .data-table tbody tr:hover {
            background: #f8f9fa;
        }

        .data-table td {
            padding: 14px 16px;
            font-size: 14px;
            color: #2D2D2D;
        }

        .invoice-id {
            font-weight: 600;
            color: #6B8E6B;
        }

        .table-number {
            background: #e6f4e6;
            color: #2d7a2d;
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
        }

        .payment-method {
            font-size: 12px;
            padding: 4px 12px;
            border-radius: 6px;
            background: #f0f0f0;
            color: #666;
        }

        .payment-method.cash {
            background: #fff3cd;
            color: #856404;
        }

        .payment-method.card {
            background: #d1ecf1;
            color: #0c5460;
        }

        .payment-method.qris {
            background: #d4edda;
            color: #155724;
        }

        .btn-detail {
            background: #6B8E6B;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-detail:hover {
            background: #5a7c5a;
            box-shadow: 0 2px 8px rgba(107, 142, 107, 0.3);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 24px;
            padding-bottom: 20px;
        }

        .pagination-btn {
            padding: 8px 12px;
            border: 1px solid #e9ecef;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            color: #6C757D;
            transition: all 0.3s ease;
        }

        .pagination-btn:hover:not(:disabled) {
            border-color: #6B8E6B;
            color: #6B8E6B;
        }

        .pagination-btn.active {
            background: #6B8E6B;
            color: white;
            border-color: #6B8E6B;
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6C757D;
        }

        .empty-state .material-icons {
            font-size: 64px;
            color: #e9ecef;
            display: block;
            margin-bottom: 16px;
        }

        .empty-state-text {
            font-size: 16px;
            font-weight: 600;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            max-width: 700px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            padding: 24px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 700;
            color: #2D2D2D;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #6C757D;
            padding: 0;
        }

        .modal-close:hover {
            color: #2D2D2D;
        }

        .modal-body {
            padding: 24px;
        }

        .detail-section {
            margin-bottom: 24px;
        }

        .detail-section-title {
            font-size: 14px;
            font-weight: 700;
            color: #2D2D2D;
            margin-bottom: 12px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 8px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 14px;
        }

        .detail-label {
            color: #6C757D;
        }

        .detail-value {
            font-weight: 600;
            color: #2D2D2D;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin: 12px 0;
        }

        .items-table th {
            background: #f8f9fa;
            padding: 10px;
            text-align: left;
            font-weight: 600;
            color: #2D2D2D;
            border-bottom: 1px solid #e9ecef;
        }

        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
        }

        .items-table tr:last-child td {
            border-bottom: none;
        }

        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #e9ecef;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn-print {
            background: #6B8E6B;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-print:hover {
            background: #5a7c5a;
            box-shadow: 0 2px 8px rgba(107, 142, 107, 0.3);
        }

        .btn-close-modal {
            background: #e9ecef;
            color: #2D2D2D;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-close-modal:hover {
            background: #dee2e6;
        }

        .loading {
            text-align: center;
            padding: 20px;
            color: #6C757D;
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #e9ecef;
            border-top-color: #6B8E6B;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* SIDEBAR STYLES */
        .hamburger-btn {
            display: flex;
            flex-direction: column;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            margin-right: 16px;
        }

        .hamburger-btn span {
            width: 24px;
            height: 2px;
            background: #1a202c;
            border-radius: 1px;
            transition: all 0.3s ease;
            display: block;
        }

        .hamburger-btn.active span:nth-child(1) {
            transform: rotate(45deg) translate(10px, 10px);
        }

        .hamburger-btn.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger-btn.active span:nth-child(3) {
            transform: rotate(-45deg) translate(8px, -8px);
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0);
            z-index: 999;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.active {
            background: rgba(0, 0, 0, 0.4);
            opacity: 1;
            pointer-events: all;
        }

        .sidebar-new {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(135deg, #ffffff 0%, #f7fafc 100%);
            border-right: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: -2px 0 8px rgba(0, 0, 0, 0.08);
            z-index: 1000;
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .sidebar-new.active {
            transform: translateX(0);
        }

        .sidebar-new-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .sidebar-new-title {
            font-size: 18px;
            font-weight: 700;
            color: #1a202c;
            margin: 0;
        }

        .sidebar-new-close {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 24px;
            color: #718096;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar-new-close:hover {
            background: rgba(0, 0, 0, 0.05);
            color: #1a202c;
        }

        .sidebar-new-nav {
            flex: 1;
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sidebar-new-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            cursor: pointer;
            text-decoration: none;
            color: #2D2D2D;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .sidebar-new-item:hover {
            background: rgba(79, 70, 229, 0.08);
            border-color: rgba(79, 70, 229, 0.2);
            color: #4f46e5;
        }

        .sidebar-new-item.active {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1), rgba(99, 102, 241, 0.1));
            border-color: rgba(79, 70, 229, 0.3);
            color: #4f46e5;
            font-weight: 600;
        }

        .sidebar-new-item .material-icons {
            font-size: 20px;
            flex-shrink: 0;
        }

        .sidebar-new-bottom {
            padding: 16px 12px;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
            flex-shrink: 0;
        }

        .sidebar-new-logout {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.08), rgba(249, 115, 22, 0.08));
            border: 1px solid rgba(239, 68, 68, 0.2);
            cursor: pointer;
            color: #dc2626;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .sidebar-new-logout:hover {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(249, 115, 22, 0.15));
            border-color: rgba(239, 68, 68, 0.4);
        }

        .sidebar-new-logout .material-icons {
            font-size: 20px;
            flex-shrink: 0;
        }

        @media (max-width: 768px) {
            .header-bar {
                padding: 12px 16px !important;
            }

            .header-bar h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- SIDEBAR OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>
    
    <!-- SIDEBAR NEW -->
    <div class="sidebar-new" id="sidebarNew">
        <div class="sidebar-new-header">
            <h2 class="sidebar-new-title">Menu</h2>
            <button class="sidebar-new-close" id="sidebarClose" onclick="closeSidebar()">
                <span class="material-icons">close</span>
            </button>
        </div>
        <nav class="sidebar-new-nav">
            <a href="<?php echo base_url('kasir'); ?>" class="sidebar-new-item">
                <span class="material-icons">table_restaurant</span>
                <span>Meja</span>
            </a>
            <a href="<?php echo base_url('kasir/history'); ?>" class="sidebar-new-item active">
                <span class="material-icons">history</span>
                <span>Riwayat Transaksi</span>
            </a>
            <a href="<?php echo base_url('kasir/profile'); ?>" class="sidebar-new-item">
                <span class="material-icons">person</span>
                <span>Profil</span>
            </a>
        </nav>
        <div class="sidebar-new-bottom">
            <form method="post" action="<?php echo base_url('auth/logout'); ?>" style="margin: 0;">
                <button type="submit" class="sidebar-new-logout" style="width: 100%; text-align: left; border: none; padding: 12px 16px; font-family: 'Poppins', sans-serif;">
                    <span class="material-icons">logout</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
    
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">
                <span class="material-icons">restaurant</span>
            </div>
        </div>
        
        <nav class="flex flex-col mt-8 flex-1">
            <a href="<?php echo base_url('kasir'); ?>" class="sidebar-item" title="Dashboard">
                <span class="material-icons">home</span>
                <span class="text-xs">HOME</span>
            </a>
            <a href="<?php echo base_url('kasir'); ?>" class="sidebar-item" title="Menu">
                <span class="material-icons">menu</span>
                <span class="text-xs">MENU</span>
            </a>
            <a href="<?php echo base_url('kasir/history'); ?>" class="sidebar-item active" title="History">
                <span class="material-icons">history</span>
                <span class="text-xs">HISTORY</span>
            </a>
            <a href="<?php echo base_url('kasir/profile'); ?>" class="sidebar-item" title="Profil">
                <span class="material-icons">person</span>
                <span class="text-xs">PROFIL</span>
            </a>
        </nav>
        
        <div class="sidebar-bottom">
            <a href="<?php echo base_url('logout'); ?>" class="sidebar-item" title="Logout">
                <span class="material-icons">logout</span>
                <span class="text-xs">LOGOUT</span>
            </a>
        </div>
    </div>
    
    <!-- MAIN CONTENT -->
    <div style="height: 100vh; display: flex; flex-direction: column;">
        <!-- HEADER -->
        <div class="header-bar">
        <div class="flex items-center justify-between px-8 py-4">
            <div class="flex items-center gap-4">
                <button class="hamburger-btn" id="hamburgerBtn" onclick="toggleSidebar()" style="margin-right: 0;">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div>
                    <h2 class="text-2xl font-bold text-[#2D2D2D]">Riwayat Transaksi</h2>
                    <p class="breadcrumb mt-1"><span class="material-icons" style="display: inline; font-size: 16px; vertical-align: middle; margin-right: 4px;">home</span> <a href="<?php echo base_url('kasir'); ?>" class="hover:underline">Dashboard</a> > <strong>History</strong></p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="user-badge">
                    <span class="material-icons" style="font-size: 16px;">person</span>
                    <span><?php echo session('username') ?? 'KASIR'; ?></span>
                </div>
            </div>
            </div>
        </div>
        
        <!-- CONTENT -->
        <div class="flex-1 overflow-y-auto px-8 py-6">
            <div style="max-width: 1200px; margin: 0 auto;">
                <!-- FILTER SECTION -->
                <div class="filter-section">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label>Filter Tanggal</label>
                            <div class="filter-buttons">
                                <button class="filter-btn active" data-filter="today">Hari Ini</button>
                                <button class="filter-btn" data-filter="yesterday">Kemarin</button>
                                <button class="filter-btn" data-filter="7days">7 Hari</button>
                                <button class="filter-btn" data-filter="month">Bulan Ini</button>
                            </div>
                        </div>
                        <div class="filter-group" style="grid-column: span 2;">
                            <label>Cari Invoice atau Nomor Meja</label>
                            <input type="text" class="search-input" id="searchInput" placeholder="Cari nomor invoice (#INV-xxx) atau nomor meja...">
                        </div>
                    </div>
                </div>

                <!-- SUMMARY CARDS -->
                <div class="summary-cards">
                    <div class="summary-card">
                        <div class="summary-label">Total Omzet</div>
                        <div class="summary-value" id="totalOmzet">Rp 0</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-label">Total Transaksi</div>
                        <div class="summary-value" id="totalTransactions">0</div>
                    </div>
                </div>

                <!-- TABLE CONTAINER -->
                <div class="table-container">
                    <div id="loading" class="loading" style="display: none;">
                        <div class="loading-spinner"></div>
                        Memuat data...
                    </div>
                    <div id="tableContent">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Meja</th>
                                    <th>Tanggal & Waktu</th>
                                    <th>Total Bayar</th>
                                    <th>Metode Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 40px; color: #6C757D;">
                                        Memuat data...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
                    <div class="pagination" id="pagination"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DETAIL -->
    <div class="modal" id="detailModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Detail Transaksi</h3>
                <button class="modal-close" onclick="closeDetailModal()">
                    <span class="material-icons" style="font-size: 24px;">close</span>
                </button>
            </div>
            <div class="modal-body" id="modalBody">
                <div class="loading">
                    <div class="loading-spinner"></div>
                    Memuat detail...
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-print" onclick="printReceipt()">
                    <span class="material-icons" style="font-size: 18px;">print</span>
                    Cetak Ulang Struk
                </button>
                <button class="btn-close-modal" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        let currentFilter = 'today';
        let currentPage = 1;
        let currentOrderId = null;

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadHistoryData();
            
            // Filter buttons
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentFilter = this.dataset.filter;
                    currentPage = 1;
                    loadHistoryData();
                });
            });

            // Search input
            document.getElementById('searchInput').addEventListener('input', function() {
                currentPage = 1;
                loadHistoryData();
            });
        });

        function loadHistoryData() {
            const search = document.getElementById('searchInput').value;
            const loading = document.getElementById('loading');
            const tableBody = document.getElementById('tableBody');
            
            loading.style.display = 'flex';
            tableBody.innerHTML = '';

            const params = new URLSearchParams({
                filter: currentFilter,
                search: search,
                page: currentPage
            });

            fetch('<?php echo base_url('kasir/getHistoryData'); ?>?' + params.toString())
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        renderTable(data.orders);
                        updateSummary(data.summary);
                        renderPagination(data.pagination);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    tableBody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 40px; color: #ccc;">Error loading data</td></tr>';
                })
                .finally(() => {
                    loading.style.display = 'none';
                });
        }

        function renderTable(orders) {
            const tableBody = document.getElementById('tableBody');
            
            if (orders.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #6C757D;">
                            <span class="material-icons" style="font-size: 48px; color: #e9ecef; display: block; margin-bottom: 12px;">inbox</span>
                            <strong>Tidak ada data transaksi</strong>
                        </td>
                    </tr>
                `;
                return;
            }

            tableBody.innerHTML = orders.map(order => {
                const date = new Date(order.created_at);
                const formattedDate = date.toLocaleDateString('id-ID', { 
                    year: 'numeric', 
                    month: '2-digit', 
                    day: '2-digit'
                });
                const formattedTime = date.toLocaleTimeString('id-ID', { 
                    hour: '2-digit', 
                    minute: '2-digit'
                });

                let paymentBadge = '<span class="payment-method">-</span>';
                if (order.payment_method) {
                    const method = order.payment_method.toLowerCase();
                    paymentBadge = `<span class="payment-method ${method}">${order.payment_method.toUpperCase()}</span>`;
                }

                return `
                    <tr>
                        <td><span class="invoice-id">#INV-${String(order.id).padStart(5, '0')}</span></td>
                        <td><span class="table-number">Meja ${order.table_number}</span></td>
                        <td>${formattedTime} | ${formattedDate}</td>
                        <td><strong>Rp ${new Intl.NumberFormat('id-ID').format(order.total_price)}</strong></td>
                        <td>${paymentBadge}</td>
                        <td>
                            <button class="btn-detail" onclick="showDetailModal(${order.id})">
                                <span class="material-icons" style="font-size: 16px;">visibility</span>
                                Detail
                            </button>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        function updateSummary(summary) {
            document.getElementById('totalOmzet').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(summary.total_omzet);
            document.getElementById('totalTransactions').textContent = summary.total_transactions;
        }

        function renderPagination(pagination) {
            const paginationDiv = document.getElementById('pagination');
            paginationDiv.innerHTML = '';

            if (pagination.total_pages <= 1) return;

            // Previous button
            const prevBtn = document.createElement('button');
            prevBtn.className = 'pagination-btn';
            prevBtn.disabled = currentPage === 1;
            prevBtn.innerHTML = '<span class="material-icons" style="font-size: 18px;">chevron_left</span>';
            prevBtn.onclick = () => {
                if (currentPage > 1) {
                    currentPage--;
                    loadHistoryData();
                }
            };
            paginationDiv.appendChild(prevBtn);

            // Page buttons
            for (let i = 1; i <= pagination.total_pages; i++) {
                const btn = document.createElement('button');
                btn.className = 'pagination-btn';
                if (i === currentPage) btn.classList.add('active');
                btn.textContent = i;
                btn.onclick = () => {
                    currentPage = i;
                    loadHistoryData();
                };
                paginationDiv.appendChild(btn);
            }

            // Next button
            const nextBtn = document.createElement('button');
            nextBtn.className = 'pagination-btn';
            nextBtn.disabled = currentPage === pagination.total_pages;
            nextBtn.innerHTML = '<span class="material-icons" style="font-size: 18px;">chevron_right</span>';
            nextBtn.onclick = () => {
                if (currentPage < pagination.total_pages) {
                    currentPage++;
                    loadHistoryData();
                }
            };
            paginationDiv.appendChild(nextBtn);
        }

        function showDetailModal(orderId) {
            currentOrderId = orderId;
            const modal = document.getElementById('detailModal');
            const modalBody = document.getElementById('modalBody');
            
            modal.classList.add('active');

            const params = new URLSearchParams({ order_id: orderId });

            fetch('<?php echo base_url('kasir/getOrderDetail'); ?>/' + orderId)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        renderDetailModal(data.order, data.items, data.payment);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    modalBody.innerHTML = '<p style="color: #ccc;">Error loading detail</p>';
                });
        }

        function renderDetailModal(order, items, payment) {
            const modalBody = document.getElementById('modalBody');
            
            let itemsHtml = '<table class="items-table"><thead><tr><th>Menu</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr></thead><tbody>';
            items.forEach(item => {
                const subtotal = item.price * item.quantity;
                itemsHtml += `
                    <tr>
                        <td>${item.name}</td>
                        <td>${item.quantity}</td>
                        <td>Rp ${new Intl.NumberFormat('id-ID').format(item.price)}</td>
                        <td>Rp ${new Intl.NumberFormat('id-ID').format(subtotal)}</td>
                    </tr>
                `;
            });
            itemsHtml += '</tbody></table>';

            const subtotal = items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const pajak = subtotal * 0.1; // 10% tax
            const service = subtotal * 0.05; // 5% service
            const total = subtotal + pajak + service;
            const bayar = payment ? payment.amount : total;
            const kembali = payment ? (payment.cash_received - payment.amount) : 0;

            modalBody.innerHTML = `
                <div class="detail-section">
                    <div class="detail-section-title">Informasi Transaksi</div>
                    <div class="detail-row">
                        <span class="detail-label">Invoice:</span>
                        <span class="detail-value">#INV-${String(order.id).padStart(5, '0')}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Meja:</span>
                        <span class="detail-value">Meja ${order.table_number}</span>
                    </div>
                    ${order.customer_name ? `
                    <div class="detail-row">
                        <span class="detail-label">Nama Customer:</span>
                        <span class="detail-value">👤 ${order.customer_name}</span>
                    </div>
                    ` : ''}
                    <div class="detail-row">
                        <span class="detail-label">Tanggal & Waktu:</span>
                        <span class="detail-value">${new Date(order.created_at).toLocaleString('id-ID')}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Jumlah Tamu:</span>
                        <span class="detail-value">${order.guest_count || '-'}</span>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">Daftar Menu</div>
                    ${itemsHtml}
                </div>

                <div class="detail-section">
                    <div class="detail-section-title">Ringkasan Pembayaran</div>
                    <div class="detail-row">
                        <span class="detail-label">Subtotal:</span>
                        <span class="detail-value">Rp ${new Intl.NumberFormat('id-ID').format(subtotal)}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Pajak (10%):</span>
                        <span class="detail-value">Rp ${new Intl.NumberFormat('id-ID').format(pajak)}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Service (5%):</span>
                        <span class="detail-value">Rp ${new Intl.NumberFormat('id-ID').format(service)}</span>
                    </div>
                    <div class="detail-row" style="border-top: 2px solid #e9ecef; padding-top: 12px; margin-top: 12px;">
                        <span class="detail-label"><strong>Total:</strong></span>
                        <span class="detail-value" style="font-size: 18px;">Rp ${new Intl.NumberFormat('id-ID').format(total)}</span>
                    </div>
                    ${payment ? `
                        <div class="detail-row">
                            <span class="detail-label">Metode Pembayaran:</span>
                            <span class="detail-value">${payment.payment_method.toUpperCase()}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Bayar:</span>
                            <span class="detail-value">Rp ${new Intl.NumberFormat('id-ID').format(payment.amount)}</span>
                        </div>
                        ${payment.cash_received ? `
                            <div class="detail-row">
                                <span class="detail-label">Diterima:</span>
                                <span class="detail-value">Rp ${new Intl.NumberFormat('id-ID').format(payment.cash_received)}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Kembali:</span>
                                <span class="detail-value" style="color: #28a745;">Rp ${new Intl.NumberFormat('id-ID').format(payment.change || 0)}</span>
                            </div>
                        ` : ''}
                    ` : ''}
                </div>
            `;
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.remove('active');
            currentOrderId = null;
        }

        function printReceipt() {
            if (currentOrderId) {
                window.open('<?php echo base_url('kasir/printReceipt'); ?>/' + currentOrderId, '_blank');
            }
        }

        // Close modal when clicking outside
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDetailModal();
            }
        });

        // ========== SIDEBAR FUNCTIONS ==========
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebarNew');
            const overlay = document.getElementById('sidebarOverlay');
            const hamburger = document.getElementById('hamburgerBtn');
            
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            hamburger.classList.toggle('active');
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sidebarNew');
            const overlay = document.getElementById('sidebarOverlay');
            const hamburger = document.getElementById('hamburgerBtn');
            
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            hamburger.classList.remove('active');
        }

        // Close sidebar when clicking on a link
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarItems = document.querySelectorAll('.sidebar-new-item');
            sidebarItems.forEach(item => {
                item.addEventListener('click', function() {
                    if (this.getAttribute('onclick')) return;
                    closeSidebar();
                });
            });
        });
    </script>
</body>
</html>
