<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Kasir - POS Restoran</title>
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
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
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
        
        .material-icons {
            font-size: 24px;
            display: block;
            line-height: 1;
        }
        
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
        
        .profile-header-bg {
            background: linear-gradient(135deg, #6B8E6B 0%, #5a7c5a 100%);
            height: 180px;
            position: relative;
            border-radius: 16px 16px 0 0;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding-bottom: 60px;
            overflow: hidden;
        }
        
        .profile-header-bg::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .profile-header-bg::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }
        
        .profile-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            position: relative;
        }
        
        .profile-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6B8E6B 0%, #5a7c5a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 56px;
            position: absolute;
            top: 120px;
            left: 50%;
            transform: translateX(-50%);
            border: 4px solid white;
            box-shadow: 0 8px 20px rgba(107, 142, 107, 0.3);
            z-index: 10;
        }
        
        .profile-info {
            text-align: center;
            padding: 80px 32px 32px;
        }
        
        .profile-name {
            font-size: 28px;
            font-weight: 800;
            color: #2D2D2D;
            margin-bottom: 4px;
            letter-spacing: -0.5px;
        }
        
        .profile-username {
            font-size: 14px;
            color: #6B8E6B;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .profile-role-badge {
            display: inline-block;
            background: linear-gradient(135deg, #6B8E6B 0%, #5a7c5a 100%);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .profile-sections {
            padding: 32px;
        }
        
        .profile-section {
            margin-bottom: 32px;
        }
        
        .profile-section:last-child {
            margin-bottom: 0;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: 800;
            color: #2D2D2D;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .section-title .material-icons {
            font-size: 20px;
            color: #6B8E6B;
        }
        
        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, #6B8E6B 0%, rgba(107, 142, 107, 0.1) 100%);
            margin-bottom: 16px;
        }
        
        .profile-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 16px;
            background: linear-gradient(135deg, #f8f9fa 0%, #f0f2f5 100%);
            border-radius: 10px;
            margin-bottom: 10px;
            font-size: 14px;
            border-left: 4px solid #6B8E6B;
            transition: all 0.3s ease;
        }
        
        .profile-item:hover {
            background: linear-gradient(135deg, #f0f2f5 0%, #e8eaed 100%);
            transform: translateX(4px);
        }
        
        .profile-item-label {
            color: #6C757D;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.3px;
        }
        
        .profile-item-value {
            color: #2D2D2D;
            font-weight: 700;
            font-size: 15px;
        }
        
        .profile-item-value.highlight {
            background: linear-gradient(135deg, #6B8E6B 0%, #5a7c5a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 16px;
        }
        
        .profile-actions {
            display: flex;
            gap: 12px;
            padding: 32px;
            border-top: 2px solid #f0f2f5;
        }
        
        .btn {
            flex: 1;
            padding: 12px 24px;
            border-radius: 10px;
            border: none;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 14px;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-back {
            background: linear-gradient(135deg, #f8f9fa 0%, #e8eaed 100%);
            border: 2px solid #6B8E6B;
            color: #6B8E6B;
        }
        
        .btn-back:hover {
            background: linear-gradient(135deg, #6B8E6B 0%, #5a7c5a 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(107, 142, 107, 0.3);
        }
        
        .btn-logout {
            background: linear-gradient(135deg, #E76F51 0%, #d45a3b 100%);
            color: white;
        }
        
        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(231, 111, 81, 0.3);
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
            <a href="<?php echo base_url('kasir/profile'); ?>" class="sidebar-new-item active">
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
            <a href="<?php echo base_url('kasir/history'); ?>" class="sidebar-item" title="History">
                <span class="material-icons">history</span>
                <span class="text-xs">HISTORY</span>
            </a>
            <a href="<?php echo base_url('kasir/profile'); ?>" class="sidebar-item active" title="Profil">
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
                        <h2 class="text-2xl font-bold text-[#2D2D2D]">Profil Saya</h2>
                        <p class="breadcrumb mt-1"><span class="material-icons" style="display: inline; font-size: 16px; vertical-align: middle; margin-right: 4px;">home</span> <a href="<?php echo base_url('kasir'); ?>" class="hover:underline">Dashboard</a> > <strong>Profil</strong></p>
                    </div>
                </div>
                <div class="user-badge">
                    <span class="material-icons" style="font-size: 16px;">person</span>
                    <span><?php echo session('username') ?? 'KASIR'; ?></span>
                </div>
            </div>
        </div>
        
        <!-- CONTENT -->
        <div class="flex-1 overflow-y-auto px-8 py-8">
            <div class="max-w-3xl mx-auto">
                <!-- PROFILE CARD -->
                <div class="profile-card">
                    <!-- HEADER BACKGROUND -->
                    <div class="profile-header-bg"></div>
                    
                    <!-- AVATAR -->
                    <div class="profile-avatar">
                        <span class="material-icons" style="font-size: 56px;">person</span>
                    </div>
                    
                    <!-- PROFILE INFO -->
                    <div class="profile-info">
                        <div class="profile-name">Andi Saputra</div>
                        <div class="profile-username">@<?php echo $username ?? 'kasir1'; ?></div>
                        <div class="profile-role-badge">👨‍💼 Kasir</div>
                    </div>
                    
                    <!-- SECTIONS -->
                    <div class="profile-sections">
                        <!-- DATA DIRI -->
                        <div class="profile-section">
                            <div class="section-title">
                                <span class="material-icons">info</span>
                                Data Diri
                            </div>
                            <div class="section-divider"></div>
                            
                            <div class="profile-item">
                                <span class="profile-item-label">Nama Lengkap</span>
                                <span class="profile-item-value">Andi Saputra</span>
                            </div>
                            <div class="profile-item">
                                <span class="profile-item-label">Username</span>
                                <span class="profile-item-value"><?php echo $username ?? 'kasir1'; ?></span>
                            </div>
                            <div class="profile-item">
                                <span class="profile-item-label">Role</span>
                                <span class="profile-item-value"><?php echo session('role') === 'kasir' ? 'Kasir' : 'Admin'; ?></span>
                            </div>
                        </div>
                        
                        <!-- SHIFT SAYA -->
                        <div class="profile-section">
                            <div class="section-title">
                                <span class="material-icons">schedule</span>
                                Shift Saya
                            </div>
                            <div class="section-divider"></div>
                            
                            <div class="profile-item">
                                <span class="profile-item-label">Mulai Shift</span>
                                <span class="profile-item-value">08:00 WIB</span>
                            </div>
                            <div class="profile-item">
                                <span class="profile-item-label">Selesai Shift</span>
                                <span class="profile-item-value">16:00 WIB</span>
                            </div>
                            <div class="profile-item">
                                <span class="profile-item-label">Transaksi Ditangani</span>
                                <span class="profile-item-value highlight"><?php echo $completedOrders ?? 0; ?> Pesanan</span>
                            </div>
                            <div class="profile-item">
                                <span class="profile-item-label">Total Omzet (Hari Ini)</span>
                                <span class="profile-item-value highlight">Rp<?php echo number_format($todayRevenue ?? 0, 0, ',', '.'); ?></span>
                            </div>
                        </div>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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
