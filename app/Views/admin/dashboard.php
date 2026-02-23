<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - POS Restoran</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            font-size: 28px;
        }
        
        .logout-btn {
            background-color: #ff6b6b;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .logout-btn:hover {
            background-color: #ff5252;
        }
        
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-left: 5px solid #667eea;
        }
        
        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .stat-card .number {
            font-size: 32px;
            font-weight: bold;
            color: #667eea;
        }
        
        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .menu-item {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            color: #333;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .menu-item .icon {
            font-size: 40px;
            margin-bottom: 10px;
        }
        
        .menu-item h4 {
            font-size: 18px;
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h1>🏪 Dashboard Admin</h1>
            <p>POS Sistem Restoran</p>
        </div>
        <a href="<?= base_url('logout') ?>" class="logout-btn">🚪 Logout</a>
    </div>
    
    <div class="container">
        <h2 style="margin-bottom: 20px; color: #333;">📊 Statistik</h2>
        
        <div class="stats">
            <div class="stat-card">
                <h3>Total Meja</h3>
                <div class="number"><?= $totalTables ?? 0 ?></div>
            </div>
            <div class="stat-card" style="border-left-color: #f59e0b;">
                <h3>Total Menu</h3>
                <div class="number" style="color: #f59e0b;"><?= $totalMenu ?? 0 ?></div>
            </div>
            <div class="stat-card" style="border-left-color: #10b981;">
                <h3>Pesanan Hari Ini</h3>
                <div class="number" style="color: #10b981;"><?= $totalOrders ?? 0 ?></div>
            </div>
        </div>
        
        <h2 style="margin-bottom: 20px; color: #333;">⚙️ Menu Manajemen</h2>
        
        <div class="menu">
            <a href="<?= base_url('admin/tables') ?>" class="menu-item">
                <div class="icon">🪑</div>
                <h4>Kelola Meja</h4>
            </a>
            <a href="<?= base_url('admin/menu') ?>" class="menu-item">
                <div class="icon">🍽️</div>
                <h4>Kelola Menu</h4>
            </a>
            <a href="<?= base_url('admin/orders') ?>" class="menu-item">
                <div class="icon">📝</div>
                <h4>Lihat Pesanan</h4>
            </a>
            <a href="<?= base_url('admin/users') ?>" class="menu-item">
                <div class="icon">👥</div>
                <h4>Kelola User</h4>
            </a>
        </div>
    </div>
</body>
</html>
