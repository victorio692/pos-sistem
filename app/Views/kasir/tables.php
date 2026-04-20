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
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.08);
        }
        
        .table-card:hover::before {
            transform: scaleX(0);
        }
        
        .table-card.occupied {
            background: rgba(249, 115, 22, 0.03);
            border-color: rgba(239, 68, 68, 0.2);
            cursor: pointer;
        }

        .table-card.occupied:hover {
            border-color: rgba(239, 68, 68, 0.5);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.08);
        }
        
        .table-card:hover .table-icon {
            transform: none;
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

        /* MODAL STYLES */
        .modal-overlay {
            display: none !important;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active,
        .modal-overlay.show {
            display: flex !important;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 420px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-icon {
            font-size: 48px;
            text-align: center;
            margin-bottom: 16px;
        }

        .modal-title {
            font-size: 24px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 12px;
            text-align: center;
        }

        .modal-info {
            font-size: 14px;
            color: #718096;
            text-align: center;
            margin-bottom: 12px;
            line-height: 1.6;
        }

        .modal-question {
            font-size: 15px;
            color: #1a202c;
            font-weight: 600;
            text-align: center;
            margin-bottom: 28px;
        }

        .modal-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .modal-btn {
            border: none;
            padding: 12px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .modal-btn-cancel {
            background: #f3f4f6;
            color: #1a202c;
            border: 1px solid #d1d5db;
        }

        .modal-btn-cancel:hover {
            background: #e5e7eb;
            transform: translateY(-2px);
        }

        .modal-btn-confirm {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .modal-btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .modal-btn:active {
            transform: translateY(0);
        }

        /* START ORDER MODAL STYLES */
        .modal-content.order-form {
            max-width: 480px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 8px;
            display: block;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        .form-input:focus {
            outline: none;
            border-color: #4f46e5;
            background: #f8f9ff;
        }

        .form-input::placeholder {
            color: #a0aec0;
        }

        .guest-counter {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .counter-btn {
            width: 44px;
            height: 44px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            background: #f9fafb;
            cursor: pointer;
            font-size: 18px;
            font-weight: 700;
            color: #4f46e5;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .counter-btn:hover {
            border-color: #4f46e5;
            background: #eff0ff;
        }

        .counter-btn:active {
            transform: scale(0.95);
        }

        .counter-display {
            flex: 1;
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            color: #1a202c;
            padding: 12px 16px;
            background: #f9fafb;
            border-radius: 10px;
            border: 2px solid #e5e7eb;
        }

        .capacity-warning {
            font-size: 13px;
            color: #718096;
            margin-top: 8px;
        }

        .capacity-warning.error {
            color: #dc2626;
            font-weight: 600;
        }

        .modal-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .modal-btn:disabled:hover {
            transform: none !important;
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

        .sidebar {
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

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: 700;
            color: #1a202c;
            margin: 0;
        }

        .sidebar-close {
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

        .sidebar-close:hover {
            background: rgba(0, 0, 0, 0.05);
            color: #1a202c;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sidebar-item {
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

        .sidebar-item:hover {
            background: rgba(79, 70, 229, 0.08);
            border-color: rgba(79, 70, 229, 0.2);
            color: #4f46e5;
        }

        .sidebar-item.active {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1), rgba(99, 102, 241, 0.1));
            border-color: rgba(79, 70, 229, 0.3);
            color: #4f46e5;
            font-weight: 600;
        }

        .sidebar-item .material-icons {
            font-size: 20px;
            flex-shrink: 0;
        }

        .sidebar-bottom {
            padding: 16px 12px;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
            flex-shrink: 0;
        }

        .sidebar-logout {
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

        .sidebar-logout:hover {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(249, 115, 22, 0.15));
            border-color: rgba(239, 68, 68, 0.4);
        }

        .sidebar-logout .material-icons {
            font-size: 20px;
            flex-shrink: 0;
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

        @media (max-width: 768px) {
            .header-section {
                padding: 16px 20px;
            }

            .header-top {
                margin-bottom: 12px;
            }

            .header-title h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <!-- SIDEBAR OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>
    
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2 class="sidebar-title">Menu</h2>
            <button class="sidebar-close" id="sidebarClose" onclick="closeSidebar()">
                <span class="material-icons">close</span>
            </button>
        </div>
        <nav class="sidebar-nav">
            <a href="<?php echo base_url('kasir/tables'); ?>" class="sidebar-item active">
                <span class="material-icons">table_restaurant</span>
                <span>Pilih meja</span>
            </a>
            <a href="<?php echo base_url('kasir/history'); ?>" class="sidebar-item">
                <span class="material-icons">history</span>
                <span>History</span>
            </a>
            <a href="<?php echo base_url('kasir/profile'); ?>" class="sidebar-item">
                <span class="material-icons">person</span>
                <span>Profil</span>
            </a>
        </nav>
        <div class="sidebar-bottom">
            <form method="post" action="<?php echo base_url('auth/logout'); ?>" style="margin: 0;">
                <button type="submit" class="sidebar-logout" style="width: 100%; text-align: left; border: none; padding: 12px 16px; font-family: 'Poppins', sans-serif;">
                    <span class="material-icons">logout</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
    
    <!-- HEADER -->
    <div class="header-section">
        <div class="header-top">
            <button class="hamburger-btn" id="hamburgerBtn" onclick="toggleSidebar()">
                <span></span>
                <span></span>
                <span></span>
            </button>
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
    
    <!-- MODAL FOR STARTING NEW ORDER (Available Tables) -->
    <div class="modal-overlay" id="startOrderModal">
        <div class="modal-content order-form">
            <div class="modal-icon">🍽️</div>
            <div class="modal-title" id="orderModalTitle">Mulai Pesanan</div>
            <div class="modal-info" id="orderModalInfo">Silahkan isi detail pesanan</div>
            
            <div class="form-group">
                <label class="form-label">Nama Customer</label>
                <input type="text" id="customerName" class="form-input" placeholder="Opsional, misal: Bapak Ahmad">
            </div>
            
            <div class="form-group">
                <label class="form-label">Jumlah Tamu</label>
                <div class="guest-counter">
                    <button type="button" class="counter-btn" onclick="decrementGuestCount()">−</button>
                    <div class="counter-display" id="guestCountDisplay">1</div>
                    <button type="button" class="counter-btn" onclick="incrementGuestCount()">+</button>
                </div>
                <div class="capacity-warning" id="capacityWarning"></div>
            </div>
            
            <div class="modal-buttons">
                <button class="modal-btn modal-btn-cancel" onclick="closeStartOrderModal()">BATAL</button>
                <button class="modal-btn modal-btn-confirm" id="confirmOrderBtn" onclick="confirmStartOrder()">LANJUTKAN</button>
            </div>
        </div>
    </div>

    <!-- MODAL FOR FINISHING OCCUPIED TABLE -->
    <div class="modal-overlay" id="finishModal">
        <div class="modal-content">
            
            <div class="modal-title" id="modalTitle">Selesaikan Meja 1?</div>
            <div class="modal-info" id="modalInfo">Meja ini sedang digunakan.</div>
            <div class="modal-question">Apakah sudah selesai?</div>
            <div class="modal-buttons">
                <button class="modal-btn modal-btn-cancel" onclick="closeFinishModal()">BATAL</button>
                <button class="modal-btn modal-btn-confirm" onclick="confirmFinishTable()">YA, SELESAI</button>
            </div>
        </div>
    </div>
    
    <script>
        // ========== SIDEBAR FUNCTIONS ==========
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const hamburger = document.getElementById('hamburgerBtn');
            
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            hamburger.classList.toggle('active');
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const hamburger = document.getElementById('hamburgerBtn');
            
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            hamburger.classList.remove('active');
        }

        // Close sidebar when clicking on a link
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            sidebarItems.forEach(item => {
                item.addEventListener('click', function() {
                    if (this.getAttribute('onclick')) return;
                    closeSidebar();
                });
            });
        });

        let selectedTableId = null;
        // Sample table data - in real app, this would come from backend
        let tables = <?php echo json_encode($tables ?? []); ?>; // CHANGED: const → let untuk bisa di-reassign
        
        function loadTables() {
            console.log('[loadTables] Tables data:', tables);
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
                const isOccupied = table.status === 'occupied' || table.status === 'terisi';
                if (isOccupied) occupied++; else available++;
                
                const statusClass = isOccupied ? 'occupied' : '';
                const statusText = isOccupied ? 'Terisi' : 'Tersedia';
                const statusBadgeClass = isOccupied ? 'status-occupied' : 'status-available';
                const currentGuestCount = table.guest_count || 0;
                const tableNum = table.table_number || table.id;
                
                // Use data attributes for event delegation instead of inline onclick
                const dataAttrs = isOccupied 
                    ? `data-action="finish" data-table-id="${table.id}" data-table-num="${tableNum}" data-guest-count="${currentGuestCount}"`
                    : `data-action="order" data-table-id="${table.id}" data-table-num="${tableNum}" data-table-capacity="${table.capacity || 2}"`;
                
                html += `
                    <div class="table-card ${statusClass}" ${dataAttrs}>
                        <div class="table-icon">🍽️</div>
                        <div class="table-number">MEJA ${tableNum}</div>
                        <div class="table-capacity">👥 Kapasitas: ${table.capacity || 2} Orang</div>
                        <div class="table-status ${statusBadgeClass}">${statusText}</div>
                    </div>
                `;
            });
            
            tableGrid.innerHTML = html;
            document.getElementById('available-count').textContent = available;
            document.getElementById('occupied-count').textContent = occupied;
            
            // Add event listeners to all table cards (event delegation)
            document.querySelectorAll('.table-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    const action = this.dataset.action;
                    const tableId = this.dataset.tableId;
                    
                    if (action === 'finish') {
                        const tableNum = this.dataset.tableNum;
                        const guestCount = this.dataset.guestCount;
                        console.log('[Table Card Click] Finish action for table:', tableId, 'num:', tableNum, 'guests:', guestCount);
                        openFinishModal(tableId, tableNum, guestCount);
                    } else if (action === 'order') {
                        const tableNum = this.dataset.tableNum;
                        const capacity = parseInt(this.dataset.tableCapacity);
                        console.log('[Table Card Click] Order action for table:', tableId, 'num:', tableNum, 'capacity:', capacity);
                        openStartOrderModal(tableId, tableNum, capacity);
                    }
                });
            });
        }
        
        // ========== START ORDER MODAL FUNCTIONS ==========
        let currentOrderTableId = null;
        let currentOrderTableNum = null;
        let currentOrderTableCapacity = null;
        let currentGuestCount = 1;
        
        function openStartOrderModal(tableId, tableNum, capacity) {
            console.log('[openStartOrderModal] Opening for table:', tableId, 'num:', tableNum, 'capacity:', capacity);
            currentOrderTableId = tableId;
            currentOrderTableNum = tableNum;
            currentOrderTableCapacity = capacity;
            currentGuestCount = 1;
            
            document.getElementById('orderModalTitle').textContent = `Mulai Pesanan - Meja T-${tableNum}`;
            document.getElementById('orderModalInfo').textContent = `Kapasitas: ${capacity} orang`;
            document.getElementById('customerName').value = '';
            document.getElementById('guestCountDisplay').textContent = '1';
            document.getElementById('capacityWarning').textContent = `Maksimal ${capacity} tamu`;
            document.getElementById('capacityWarning').classList.remove('error');
            document.getElementById('confirmOrderBtn').disabled = false;
            
            const modal = document.getElementById('startOrderModal');
            modal.classList.add('active');
            console.log('[openStartOrderModal] Modal opened');
        }
        
        function closeStartOrderModal() {
            console.log('[closeStartOrderModal] Closing start order modal');
            const modal = document.getElementById('startOrderModal');
            modal.classList.remove('active');
            currentOrderTableId = null;
            currentOrderTableNum = null;
            currentOrderTableCapacity = null;
            currentGuestCount = 1;
        }
        
        function incrementGuestCount() {
            if (currentGuestCount < currentOrderTableCapacity) {
                currentGuestCount++;
                updateGuestCountDisplay();
            }
        }
        
        function decrementGuestCount() {
            if (currentGuestCount > 1) {
                currentGuestCount--;
                updateGuestCountDisplay();
            }
        }
        
        function updateGuestCountDisplay() {
            const display = document.getElementById('guestCountDisplay');
            const warning = document.getElementById('capacityWarning');
            const confirmBtn = document.getElementById('confirmOrderBtn');
            
            display.textContent = currentGuestCount;
            
            if (currentGuestCount > currentOrderTableCapacity) {
                warning.textContent = `❌ Melebihi kapasitas maksimal ${currentOrderTableCapacity} tamu!`;
                warning.classList.add('error');
                confirmBtn.disabled = true;
            } else {
                warning.textContent = `Maksimal ${currentOrderTableCapacity} tamu`;
                warning.classList.remove('error');
                confirmBtn.disabled = false;
            }
        }
        
        function confirmStartOrder() {
            console.log('[confirmStartOrder] Processing order...');
            if (!currentOrderTableId) {
                console.error('Table ID not set');
                return;
            }
            
            // Capture ID BEFORE it gets reset
            const tableIdToRedirect = currentOrderTableId;
            const customerName = document.getElementById('customerName').value.trim();
            const guestCount = currentGuestCount;
            
            if (guestCount > currentOrderTableCapacity) {
                alert('Jumlah tamu melebihi kapasitas meja!');
                return;
            }
            
            console.log('[confirmStartOrder] Order confirmed:', {
                tableId: tableIdToRedirect,
                tableNum: currentOrderTableNum,
                customerName: customerName || '(No name)',
                guestCount: guestCount
            });
            
            // Show confirmation
            const confirmMsg = `Pesanan untuk Meja T-${currentOrderTableNum} dengan ${guestCount} tamu${customerName ? ' (' + customerName + ')' : ''}`;
            alert(confirmMsg);
            
            // Close modal (this resets currentOrderTableId to null)
            closeStartOrderModal();
            
            // Update table status to occupied with guest count BEFORE redirecting
            const updateUrl = `<?php echo base_url('kasir/api/updateTableStatus/'); ?>${tableIdToRedirect}`;
            const updatePayload = {
                status: 'occupied',
                guest_count: guestCount,
                customer_name: customerName
            };
            
            console.log('[confirmStartOrder] Calling API:', updateUrl);
            console.log('[confirmStartOrder] Payload:', updatePayload);
            
            fetch(updateUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(updatePayload)
            })
            .then(response => {
                console.log('[confirmStartOrder] Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('[confirmStartOrder] Table updated:', data);
                // Redirect to order page using the captured ID
                const redirectUrl = `<?php echo base_url('kasir/order/'); ?>${tableIdToRedirect}`;
                console.log('[confirmStartOrder] Redirecting to:', redirectUrl);
                window.location.href = redirectUrl;
            })
            .catch(error => {
                console.error('[confirmStartOrder] Error updating table:', error);
                // Still redirect even if update fails
                const redirectUrl = `<?php echo base_url('kasir/order/'); ?>${tableIdToRedirect}`;
                console.log('[confirmStartOrder] Redirecting anyway to:', redirectUrl);
                window.location.href = redirectUrl;
            });
        }

        function openFinishModal(tableId, tableNumber, guestCount) {
            console.log('[openFinishModal] Opening modal for table:', tableId, 'number:', tableNumber, 'guests:', guestCount);
            selectedTableId = tableId;
            document.getElementById('modalTitle').textContent = `Selesaikan Meja ${tableNumber}?`;
            document.getElementById('modalInfo').textContent = `Meja ini sedang digunakan oleh ${guestCount} tamu.`;
            
            const modal = document.getElementById('finishModal');
            modal.classList.add('active');
            console.log('[openFinishModal] Modal class added. Modal classes:', modal.className);
            console.log('[openFinishModal] Modal display style:', window.getComputedStyle(modal).display);
        }

        function closeFinishModal() {
            console.log('[closeFinishModal] Closing modal');
            const modal = document.getElementById('finishModal');
            modal.classList.remove('active');
            selectedTableId = null;
        }

        function confirmFinishTable() {
            console.log('[confirmFinishTable] Called with tableId:', selectedTableId);
            if (!selectedTableId) return;
            
            // Call API to finish table
            fetch('<?php echo base_url('kasir/finishTable/'); ?>' + selectedTableId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('[confirmFinishTable] Response:', data);
                if (data.success) {
                    closeFinishModal();
                    // Refresh tables data
                    fetch('<?php echo base_url('kasir/api/tables'); ?>')
                        .then(r => r.json())
                        .then(data => {
                            if (Array.isArray(data)) {
                                tables = data;
                                loadTables();
                            }
                        });
                } else {
                    alert('Gagal membebaskan meja: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat membebaskan meja');
            });
        }

        // Close modals when clicking outside
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('startOrderModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeStartOrderModal();
                }
            });
            
            document.getElementById('finishModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeFinishModal();
                }
            });
        });
        
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
