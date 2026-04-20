<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Restoran</title>
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
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .breadcrumb {
            font-size: 13px;
            color: #6C757D;
        }
        
        .breadcrumb strong {
            color: #6B8E6B;
        }
        
        .category-btn {
            background: #e9ecef;
            color: #6C757D;
            padding: 10px 20px;
            border-radius: 8px;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 13px;
        }
        
        .category-btn:hover {
            border-color: #6B8E6B;
            color: #6B8E6B;
        }
        
        .category-btn.active {
            background: #6B8E6B;
            color: white;
            border-color: #6B8E6B;
        }
        
        .menu-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }
        
        .menu-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(107, 142, 107, 0.15);
            border-color: #6B8E6B;
        }
        
        .menu-image {
            width: 100%;
            height: 120px;
            background: #e9ecef;
            overflow: hidden;
        }
        
        .menu-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .menu-info {
            padding: 12px;
        }
        
        .menu-name {
            font-weight: 600;
            color: #2D2D2D;
            font-size: 13px;
            margin-bottom: 4px;
        }
        
        .menu-price {
            color: #6B8E6B;
            font-weight: 700;
            font-size: 14px;
        }
        
        .order-panel {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            position: fixed;
            right: 32px;
            bottom: 32px;
            width: 320px;
            height: calc(100vh - 240px);
            max-height: 600px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            z-index: 50;
        }
        
        .order-header {
            padding: 16px;
            border-bottom: 1px solid #e9ecef;
            background: #f8f9fa;
            border-radius: 12px 12px 0 0;
        }
        
        .table-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .table-badge {
            background: #c8dde9;
            color: #2D4056;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
        }
        
        .order-number-display {
            font-size: 18px;
            font-weight: 700;
            color: #2D2D2D;
        }
        
        .order-items {
            flex: 1;
            overflow-y: auto;
            padding: 12px;
        }
        
        .order-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
            border-left: 3px solid #6B8E6B;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-name {
            font-weight: 600;
            color: #2D2D2D;
            font-size: 12px;
            margin-bottom: 4px;
        }
        
        .item-price {
            color: #6B8E6B;
            font-size: 12px;
            font-weight: 600;
        }
        
        .item-controls {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .qty-btn {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 2px 6px;
            cursor: pointer;
            color: #6B8E6B;
            font-weight: bold;
            font-size: 12px;
            transition: all 0.2s ease;
        }
        
        .qty-btn:hover {
            background: #6B8E6B;
            color: white;
            border-color: #6B8E6B;
        }
        
        .qty-display {
            padding: 0 6px;
            font-weight: 600;
            font-size: 12px;
            color: #2D2D2D;
            min-width: 20px;
            text-align: center;
        }
        
        .remove-btn {
            background: #E76F51;
            border: none;
            color: white;
            border-radius: 4px;
            padding: 2px 6px;
            cursor: pointer;
            font-size: 11px;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        
        .remove-btn:hover {
            background: #d45a3b;
        }
        
        .order-summary {
            padding: 12px;
            border-top: 1px solid #e9ecef;
            background: #f8f9fa;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            font-size: 12px;
        }
        
        .summary-label {
            color: #6C757D;
        }
        
        .summary-value {
            color: #2D2D2D;
            font-weight: 600;
        }
        
        .summary-total {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            font-weight: 700;
            color: #2D2D2D;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 2px solid #e9ecef;
        }
        
        .summary-total .value {
            color: #6B8E6B;
        }
        
        .order-actions {
            display: flex;
            gap: 10px;
            padding: 12px;
            border-top: 1px solid #e9ecef;
        }
        
        .btn-back {
            flex: 0.5;
            background: white;
            border: 2px solid #E76F51;
            color: #E76F51;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 12px;
        }
        
        .btn-back:hover {
            background: #fde8e3;
        }
        
        .btn-save {
            flex: 1;
            background: #6B8E6B;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 12px;
        }
        
        .btn-save:hover {
            background: #5a7c5a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(107, 142, 107, 0.25);
        }
        
        .btn-save:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }
        
        .user-badge {
            background: #c8dde9;
            color: #2D4056;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .material-icons {
            font-size: 24px;
            display: block;
            line-height: 1;
        }
        
        .hamburger-btn {
            display: none;
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
            display: none !important;
        }

        .sidebar-overlay.active {
            background: rgba(0, 0, 0, 0.4);
            opacity: 1;
            pointer-events: all;
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
        
        .sidebar-logo {
            padding: 16px;
            border-bottom: 1px solid #3A3A3A;
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
        }
        
        .sidebar-logo-icon .material-icons {
            font-size: 20px;
        }
        
        .sidebar-bottom {
            margin-top: auto;
            padding: 16px;
            border-top: 1px solid #3A3A3A;
        }

        .sidebar-new {
            display: none !important;
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

        /* PRODUCT PREVIEW MODAL */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .product-modal {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 450px;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease-out;
            display: flex;
            flex-direction: column;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-image-section {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, #e9ecef 0%, #f0f2f5 100%);
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }

        .product-image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .close-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .close-btn:hover {
            background: white;
            transform: scale(1.1);
        }

        .product-details {
            padding: 16px;
            flex: 1;
            overflow-y: auto;
        }

        .product-name {
            font-size: 18px;
            font-weight: 700;
            color: #2D2D2D;
            margin-bottom: 2px;
            font-family: 'Playfair Display', serif;
        }

        .product-price {
            font-size: 22px;
            font-weight: 700;
            color: #6B8E6B;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: 11px;
            font-weight: 700;
            color: #6C757D;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            margin-top: 12px;
        }

        .qty-selector {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f8f9fa;
            padding: 8px 12px;
            border-radius: 6px;
            width: fit-content;
        }

        .qty-selector button {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 4px;
            width: 28px;
            height: 28px;
            cursor: pointer;
            font-weight: 700;
            font-size: 14px;
            color: #6B8E6B;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-selector button:hover {
            background: #6B8E6B;
            color: white;
            border-color: #6B8E6B;
        }

        .qty-display-modal {
            font-weight: 700;
            font-size: 14px;
            color: #2D2D2D;
            min-width: 30px;
            text-align: center;
        }

        .addons-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
            max-height: 140px;
            overflow-y: auto;
        }

        .addon-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 8px;
            background: #f8f9fa;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }

        .addon-item:hover {
            background: #eef0f2;
            border-color: #6B8E6B;
        }

        .addon-item input[type="checkbox"] {
            cursor: pointer;
            width: 16px;
            height: 16px;
            accent-color: #6B8E6B;
            flex-shrink: 0;
        }

        .addon-item label {
            flex: 1;
            cursor: pointer;
            font-size: 12px;
            color: #2D2D2D;
            font-weight: 500;
        }

        .addon-price {
            font-weight: 600;
            color: #6B8E6B;
            font-size: 11px;
            flex-shrink: 0;
        }

        .notes-section {
            margin-top: 12px;
        }

        .notes-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            font-size: 12px;
            font-family: 'Poppins', sans-serif;
            resize: none;
        }

        .notes-input:focus {
            outline: none;
            border-color: #6B8E6B;
            box-shadow: 0 0 8px rgba(107, 142, 107, 0.1);
        }

        .modal-summary {
            background: #f8f9fa;
            padding: 12px;
            border-top: 1px solid #e9ecef;
            margin-top: 12px;
            border-radius: 6px;
        }

        .summary-row-modal {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            font-size: 11px;
        }

        .summary-label-modal {
            color: #6C757D;
            font-weight: 500;
        }

        .summary-value-modal {
            color: #2D2D2D;
            font-weight: 600;
        }

        .total-row-modal {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            font-weight: 700;
            color: #2D2D2D;
            padding-top: 6px;
            border-top: 1px solid #e9ecef;
            margin-top: 6px;
        }

        .total-row-modal .value {
            color: #6B8E6B;
        }

        .modal-actions {
            display: flex;
            gap: 8px;
            padding: 12px;
            border-top: 1px solid #e9ecef;
            background: white;
            border-radius: 0 0 16px 16px;
            flex-shrink: 0;
        }

        .btn-cancel-modal {
            flex: 1;
            background: white;
            border: 2px solid #E76F51;
            color: #E76F51;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 13px;
        }

        .btn-cancel-modal:hover {
            background: #fde8e3;
        }

        .btn-add-modal {
            flex: 1;
            background: #6B8E6B;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 13px;
        }

        .btn-add-modal:hover {
            background: #5a7c5a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(107, 142, 107, 0.25);
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
            <a href="<?php echo base_url('kasir/history'); ?>" class="sidebar-new-item">
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
            <a href="<?php 
                $menuLink = (!empty($table_id)) ? base_url('kasir/order/' . $table_id) : base_url('kasir');
                echo $menuLink;
            ?>" class="sidebar-item active" title="Menu">
                <span class="material-icons">menu</span>
                <span class="text-xs">MENU</span>
            </a>
            <a href="<?php echo base_url('kasir/history'); ?>" class="sidebar-item" title="History">
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
                    <p class="breadcrumb mt-1"><span class="material-icons" style="display: inline; font-size: 16px; vertical-align: middle; margin-right: 4px;">home</span> <a href="<?php echo base_url('kasir'); ?>" class="hover:underline">Dashboard</a> > <strong>Meja <?php echo $table['table_number'] ?? '-'; ?></strong></p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-xs text-[#6C757D] flex items-center gap-2">
                    <span class="material-icons" style="font-size: 16px;">calendar_today</span>
                    <span id="currentDate">April 15 2026, 10:00 AM</span>
                </div>
                <div class="user-badge">
                    <span class="material-icons" style="font-size: 16px;">person</span>
                    <span><?php echo session('username') ?? 'KASIR'; ?></span>
                </div>
            </div>
        </div>
        
        <!-- CATEGORY TABS -->
        <div class="flex gap-3 px-8 pb-4 overflow-x-auto">
            <button class="category-btn active" onclick="filterCategory('all')">SEMUA</button>
            <button class="category-btn" onclick="filterCategory('makanan')">MAKANAN</button>
            <button class="category-btn" onclick="filterCategory('minuman')">MINUMAN</button>
            <button class="category-btn" onclick="filterCategory('snack')">SNACK</button>
            <button class="category-btn" onclick="filterCategory('paket')">PAKET HEMAT</button>
        </div>
    </div>
    
        <!-- CONTENT -->
        <div class="flex-1 flex overflow-hidden">
            <!-- MENU GRID -->
            <div class="flex-1 px-8 py-6 overflow-y-auto" style="padding-right: 360px;">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="menuGrid">
                    <!-- Menu items will be loaded here -->
                </div>
            </div>
        </div>
        
        <!-- ORDER PANEL -->
        <div class="order-panel">
            <!-- ORDER HEADER -->
            <div class="order-header">
                <div class="table-info">
                    <div>
                        <div class="text-xs text-[#6C757D] mb-1">MEJA</div>
                        <div class="table-badge"><span class="material-icons" style="display: inline; font-size: 14px; vertical-align: middle; margin-right: 4px;">restaurant</span> MEJA <?php echo $table['table_number'] ?? '-'; ?></div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-[#6C757D] mb-1">KAPASITAS</div>
                        <div class="table-badge"><span class="material-icons" style="display: inline; font-size: 14px; vertical-align: middle; margin-right: 4px;">group</span> <?php echo $table['capacity'] ?? '2'; ?> TAMU</div>
                    </div>
                </div>
            </div>
            
            <!-- ORDER ITEMS -->
            <div class="order-items" id="orderItems">
                <div class="text-center text-[#6C757D] text-sm py-8">
                    Pilih menu untuk menambahkan item
                </div>
            </div>
            
            <!-- ORDER SUMMARY -->
            <div class="order-summary">
                <div class="summary-row">
                    <span class="summary-label">SUBTOTAL</span>
                    <span class="summary-value" id="subtotal">$0,00</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">PAJAK (0%)</span>
                    <span class="summary-value" id="tax">$0,00</span>
                </div>
                <div class="summary-total">
                    <span>TOTAL</span>
                    <span class="value" id="total">$0,00</span>
                </div>
            </div>
            
            <!-- ORDER ACTIONS -->
            <div class="order-actions">
                <button class="btn-back" onclick="goBack()"><span class="material-icons" style="display: inline; font-size: 14px; vertical-align: middle; margin-right: 4px;">arrow_back</span>KEMBALI</button>
                <button class="btn-save" id="saveBtn" onclick="saveOrder()" disabled><span class="material-icons" style="display: inline; font-size: 14px; vertical-align: middle; margin-right: 4px;">check</span>SIMPAN PESANAN</button>
            </div>
        </div>
    </div>

    <!-- PRODUCT PREVIEW MODAL -->
    <div class="modal-overlay" id="productModal">
        <div class="product-modal">
            <!-- Product Image -->
            <div class="product-image-section">
                <img id="modalProductImage" src="" alt="Product">
                <button class="close-btn" onclick="closeProductModal()"><span class="material-icons">close</span></button>
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <div class="product-name" id="modalProductName">Product Name</div>
                <div class="product-price" id="modalProductPrice">Rp 0</div>

                <!-- Quantity Selector -->
                <div class="section-title">Jumlah</div>
                <div class="qty-selector">
                    <button onclick="decreaseQty()">−</button>
                    <div class="qty-display-modal" id="qtyDisplayModal">1</div>
                    <button onclick="increaseQty()">+</button>
                </div>

                <!-- Add-ons Section -->
                <div class="section-title">Tambahan (Opsional)</div>
                <div class="addons-list" id="addonsList">
                    <!-- Add-ons will be populated here -->
                </div>

                <!-- Notes Section -->
                <div class="notes-section">
                    <div class="section-title">Catatan (Opsional)</div>
                    <textarea class="notes-input" id="notesInput" placeholder="Misal: tanpa saus, dipotong kecil..." rows="2" maxlength="100"></textarea>
                </div>

                <!-- Summary -->
                <div class="modal-summary">
                    <div class="summary-row-modal">
                        <span class="summary-label-modal">Harga Menu</span>
                        <span class="summary-value-modal" id="basePriceDisplay">Rp 0</span>
                    </div>
                    <div class="summary-row-modal">
                        <span class="summary-label-modal">Tambahan</span>
                        <span class="summary-value-modal" id="addonPriceDisplay">Rp 0</span>
                    </div>
                    <div class="total-row-modal">
                        <span>Total</span>
                        <span class="value" id="totalPriceDisplay">Rp 0</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="modal-actions">
                <button class="btn-cancel-modal" onclick="closeProductModal()">Batal</button>
                <button class="btn-add-modal" onclick="confirmAddToOrder()">Tambahkan ke Pesanan</button>
            </div>
        </div>
    </div>
    
    <script>
        // Data
        const table = <?php echo json_encode($table ?? []); ?>;
        const menu = <?php echo json_encode($menu ?? []); ?>;
        let availableAddons = <?php echo json_encode($addons ?? []); ?>;
        let orderData = {};

        // Modal state
        let currentProduct = null;
        let currentQty = 1;
        let selectedAddons = {};

        // Fallback addons jika tidak ada dari server
        if (!availableAddons || Object.keys(availableAddons).length === 0) {
            availableAddons = {
                'makanan': [
                    {id: 1, name: 'Extra Keju', price: 5000},
                    {id: 2, name: 'Extra Telur', price: 3000},
                    {id: 3, name: 'Saus Spesial', price: 2000},
                    {id: 4, name: 'Bawang Merah Goreng', price: 2500}
                ],
                'minuman': [
                    {id: 5, name: 'Extra Es', price: 1000},
                    {id: 6, name: 'Tambah Sirup', price: 1500},
                    {id: 7, name: 'Tambah Gula', price: 500}
                ],
                'snack': [
                    {id: 8, name: 'Tambah Saus', price: 1000},
                    {id: 9, name: 'Extra Keju', price: 3000}
                ],
                'paket': [
                    {id: 10, name: 'Extra Minuman', price: 5000},
                    {id: 11, name: 'Extra Dessert', price: 8000}
                ]
            };
        }

        // Debug
        console.log('[INIT] Menu:', menu);
        console.log('[INIT] Available Addons:', availableAddons);
        
        function loadMenu(category = 'all') {
            const filtered = category === 'all' ? menu : menu.filter(m => m.category && m.category.toLowerCase() === category.toLowerCase());
            const menuGrid = document.getElementById('menuGrid');
            
            if (filtered.length === 0) {
                menuGrid.innerHTML = '<div class="col-span-full text-center text-gray-400 py-8">Tidak ada menu untuk kategori ini</div>';
                return;
            }
            
            let html = '';
            filtered.forEach(item => {
                html += `
                    <div class="menu-card" onclick="openProductModal(${item.id}, '${item.name.replace(/'/g, "\\'\'")}', ${item.price})">
                        <div class="menu-image">
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=300&q=80" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22300%22 height=%22120%22%3E%3Crect fill=%22%23e9ecef%22 width=%22300%22 height=%22120%22/%3E%3C/svg%3E'" alt="${item.name}">
                        </div>
                        <div class="menu-info">
                            <div class="menu-name">${item.name}</div>
                            <div class="menu-price">Rp${parseInt(item.price).toLocaleString('id-ID')}</div>
                        </div>
                    </div>
                `;
            });
            
            menuGrid.innerHTML = html;
        }
        
        function filterCategory(category) {
            // Update active button
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            loadMenu(category);
        }
        
        function openProductModal(menuId, name, price) {
            // Find menu item to get category
            const menuItem = menu.find(m => m.id === menuId);
            const category = menuItem ? menuItem.category : 'makanan';

            console.log('[DEBUG] Menu Item:', menuItem);
            console.log('[DEBUG] Category:', category);
            console.log('[DEBUG] Available Addons:', availableAddons);

            currentProduct = { id: menuId, name: name, price: price, category: category };
            currentQty = 1;
            selectedAddons = {};

            // Set modal content
            document.getElementById('modalProductName').textContent = name;
            document.getElementById('modalProductImage').src = 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&q=80';
            document.getElementById('qtyDisplayModal').textContent = '1';
            document.getElementById('modalProductPrice').textContent = `Rp${parseInt(price).toLocaleString('id-ID')}`;
            document.getElementById('basePriceDisplay').textContent = `Rp${parseInt(price).toLocaleString('id-ID')}`;
            document.getElementById('addonPriceDisplay').textContent = 'Rp 0';
            document.getElementById('totalPriceDisplay').textContent = `Rp${parseInt(price).toLocaleString('id-ID')}`;

            // Load add-ons berdasarkan kategori
            loadAddons(category);

            // Show modal
            document.getElementById('productModal').classList.add('active');
        }

        function closeProductModal() {
            document.getElementById('productModal').classList.remove('active');
            document.getElementById('notesInput').value = '';
            currentProduct = null;
            currentQty = 1;
            selectedAddons = {};
        }

        function increaseQty() {
            currentQty++;
            document.getElementById('qtyDisplayModal').textContent = currentQty;
            updateModalTotal();
        }

        function decreaseQty() {
            if (currentQty > 1) {
                currentQty--;
                document.getElementById('qtyDisplayModal').textContent = currentQty;
                updateModalTotal();
            }
        }

        function loadAddons(category = 'makanan') {
            console.log('[loadAddons] Category:', category);
            console.log('[loadAddons] availableAddons:', availableAddons);
            
            // Get addons berdasarkan kategori menu
            const addons = availableAddons[category] || [];
            
            console.log('[loadAddons] Addons untuk kategori', category, ':', addons);

            let html = '';
            if (addons.length === 0) {
                html = '<div class="text-center text-gray-400 text-sm py-4">Tidak ada opsi tambahan untuk menu ini</div>';
            } else {
                addons.forEach(addon => {
                    html += `
                        <div class="addon-item" onclick="toggleAddon(${addon.id}, '${addon.name}', ${addon.price})">
                            <input type="checkbox" id="addon-${addon.id}" onchange="toggleAddon(${addon.id}, '${addon.name}', ${addon.price})">
                            <label for="addon-${addon.id}">${addon.name}</label>
                            <span class="addon-price">+Rp${addon.price.toLocaleString('id-ID')}</span>
                        </div>
                    `;
                });
            }

            document.getElementById('addonsList').innerHTML = html;
        }

        function toggleAddon(addonId, addonName, price) {
            if (selectedAddons[addonId]) {
                delete selectedAddons[addonId];
                document.getElementById(`addon-${addonId}`).checked = false;
            } else {
                selectedAddons[addonId] = { name: addonName, price: price };
                document.getElementById(`addon-${addonId}`).checked = true;
            }
            updateModalTotal();
        }

        function updateModalTotal() {
            let addonTotal = 0;
            Object.values(selectedAddons).forEach(addon => {
                addonTotal += addon.price;
            });

            const itemTotal = currentProduct.price * currentQty;
            const finalTotal = itemTotal + (addonTotal * currentQty);

            document.getElementById('basePriceDisplay').textContent = `Rp${parseInt(itemTotal).toLocaleString('id-ID')}`;
            document.getElementById('addonPriceDisplay').textContent = `Rp${parseInt(addonTotal * currentQty).toLocaleString('id-ID')}`;
            document.getElementById('totalPriceDisplay').textContent = `Rp${parseInt(finalTotal).toLocaleString('id-ID')}`;
            document.getElementById('modalProductPrice').textContent = `Rp${parseInt(finalTotal).toLocaleString('id-ID')}`;
        }

        function confirmAddToOrder() {
            if (!currentProduct) return;

            const key = `${currentProduct.id}`;
            let finalPrice = currentProduct.price;
            let addonInfo = '';
            const notes = document.getElementById('notesInput').value;

            // Calculate add-ons price
            Object.values(selectedAddons).forEach(addon => {
                finalPrice += addon.price;
                addonInfo += (addonInfo ? ', ' : '') + addon.name;
            });

            if (!orderData[key]) {
                orderData[key] = {
                    id: currentProduct.id,
                    name: currentProduct.name,
                    price: finalPrice,
                    quantity: currentQty,
                    basePrice: currentProduct.price,
                    addons: addonInfo,
                    notes: notes
                };
            } else {
                orderData[key].quantity += currentQty;
                if (notes) {
                    orderData[key].notes = (orderData[key].notes ? orderData[key].notes + ' | ' : '') + notes;
                }
            }

            updateOrderDisplay();
            closeProductModal();
        }

        function addToOrder(menuId, name, price) {
            const key = `${menuId}`;
            if (!orderData[key]) {
                orderData[key] = { id: menuId, name: name, price: price, quantity: 0 };
            }
            orderData[key].quantity++;
            updateOrderDisplay();
        }
        
        function removeItem(menuId) {
            const key = `${menuId}`;
            if (orderData[key]) {
                orderData[key].quantity--;
                if (orderData[key].quantity <= 0) {
                    delete orderData[key];
                }
                updateOrderDisplay();
            }
        }

        function increaseItemQty(menuId) {
            const key = `${menuId}`;
            if (orderData[key]) {
                orderData[key].quantity++;
                updateOrderDisplay();
            }
        }
        
        function updateOrderDisplay() {
            const orderItemsDiv = document.getElementById('orderItems');
            const items = Object.values(orderData);
            
            if (items.length === 0) {
                orderItemsDiv.innerHTML = '<div class="text-center text-[#6C757D] text-sm py-8">Pilih menu untuk menambahkan item</div>';
                document.getElementById('saveBtn').disabled = true;
            } else {
                let html = '';
                items.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    const addonText = item.addons ? ` (${item.addons})` : '';
                    const notesText = item.notes ? `<div class="text-xs text-[#6C757D] mt-1">📝 ${item.notes}</div>` : '';
                    html += `
                        <div class="order-item">
                            <div class="item-details">
                                <div class="item-name">${item.name}${addonText}</div>
                                <div class="item-price">Rp${parseInt(item.price).toLocaleString('id-ID')} × ${item.quantity}</div>
                                ${notesText}
                            </div>
                            <div class="item-controls">
                                <button class="qty-btn" onclick="removeItem(${item.id})">−</button>
                                <span class="qty-display">${item.quantity}</span>
                                <button class="qty-btn" onclick="increaseItemQty(${item.id})">+</button>
                                <button class="remove-btn" onclick="removeItem(${item.id}); removeItem(${item.id});"><span class="material-icons" style="display: inline; font-size: 12px;">delete</span></button>
                            </div>
                        </div>
                    `;
                });
                orderItemsDiv.innerHTML = html;
                document.getElementById('saveBtn').disabled = false;
            }
            
            updateSummary();
        }
        
        function updateSummary() {
            let subtotal = 0;
            Object.values(orderData).forEach(item => {
                subtotal += item.price * item.quantity;
            });
            
            const tax = 0; // 0% pajak
            const total = subtotal + tax;
            
            document.getElementById('subtotal').textContent = `Rp${parseInt(subtotal).toLocaleString('id-ID')}`;
            document.getElementById('tax').textContent = `Rp${parseInt(tax).toLocaleString('id-ID')}`;
            document.getElementById('total').textContent = `Rp${parseInt(total).toLocaleString('id-ID')}`;
        }
        
        function saveOrder() {
            const items = Object.values(orderData);
            if (items.length === 0) {
                alert('Tambahkan minimal satu item');
                return;
            }
            
            // Calculate total
            let total = 0;
            items.forEach(item => {
                total += item.price * item.quantity;
            });
            
            // Prepare order data
            const orderPayload = {
                table_id: table.id,
                items: items,
                total_price: total,
                guest_count: table.guest_count || 1
            };
            
            // Send to server
            fetch('<?php echo base_url('kasir/order/create'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(orderPayload)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect to payment page
                    window.location.href = `<?php echo base_url('kasir/payment/'); ?>${data.order_id}`;
                } else {
                    alert('Gagal menyimpan pesanan: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan pesanan');
            });
        }
        
        function goBack() {
            // Reset table status to available sebelum kembali ke halaman tables
            const tableId = table.id;
            fetch('<?php echo base_url('kasir/api/updateTableStatus/'); ?>' + tableId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    status: 'available'
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('[goBack] Table status reset to available:', data);
                // Redirect to tables
                window.location.href = '<?php echo base_url('kasir'); ?>';
            })
            .catch(error => {
                console.error('[goBack] Error resetting table:', error);
                // Tetap redirect meski ada error
                window.location.href = '<?php echo base_url('kasir'); ?>';
            });
        }
        
        function updateDate() {
            const now = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            document.getElementById('currentDate').textContent = now.toLocaleDateString('id-ID', options);
        }
        
        // Initialize
        loadMenu('all');
        updateDate();
        setInterval(updateDate, 60000);

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
