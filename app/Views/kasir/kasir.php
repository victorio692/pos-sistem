<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir - POS Restoran</title>
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
            background: #f8f9fa;
        }
        
        .sidebar {
            background: #2D2D2D;
            width: 80px;
            transition: all 0.3s ease;
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
        
        .header-bar {
            background: white;
            border-bottom: 1px solid #e9ecef;
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
            height: 140px;
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
            margin-bottom: 6px;
        }
        
        .menu-category {
            font-size: 11px;
            color: #6C757D;
            margin-bottom: 8px;
        }
        
        .menu-icons {
            display: flex;
            gap: 4px;
            font-size: 12px;
        }
        
        .order-panel {
            background: white;
            border-left: 1px solid #e9ecef;
            display: flex;
            flex-direction: column;
        }
        
        .order-header {
            padding: 16px;
            border-bottom: 1px solid #e9ecef;
            background: #f8f9fa;
        }
        
        .order-number {
            font-size: 32px;
            font-weight: 700;
            color: #2D2D2D;
            margin-bottom: 8px;
        }
        
        .order-meta {
            display: flex;
            gap: 16px;
            font-size: 12px;
            color: #6C757D;
        }
        
        .order-items {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
        }
        
        .order-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 12px;
            border-left: 4px solid #6B8E6B;
        }
        
        .order-item-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 6px;
        }
        
        .order-item-name {
            font-weight: 600;
            color: #2D2D2D;
            font-size: 13px;
        }
        
        .order-item-price {
            color: #6B8E6B;
            font-weight: 600;
            font-size: 13px;
        }
        
        .order-item-qty {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 4px 8px;
            font-size: 12px;
        }
        
        .qty-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            color: #6B8E6B;
            font-weight: bold;
            font-size: 14px;
        }
        
        .order-summary {
            padding: 16px;
            border-top: 1px solid #e9ecef;
            background: #f8f9fa;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 13px;
        }
        
        .summary-label {
            color: #6C757D;
        }
        
        .summary-value {
            color: #2D2D2D;
            font-weight: 500;
        }
        
        .summary-total {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: 700;
            color: #2D2D2D;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 2px solid #e9ecef;
        }
        
        .summary-total .total-value {
            color: #6B8E6B;
        }
        
        .order-actions {
            display: flex;
            gap: 12px;
            padding: 16px;
            border-top: 1px solid #e9ecef;
        }
        
        .btn-cancel {
            flex: 1;
            background: #E76F51;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 13px;
        }
        
        .btn-cancel:hover {
            background: #d45a3b;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(231, 111, 81, 0.25);
        }
        
        .btn-send {
            flex: 1;
            background: #6B8E6B;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 13px;
        }
        
        .btn-send:hover {
            background: #5a7c5a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(107, 142, 107, 0.25);
        }
        
        .badge-info {
            background: #e8f4f1;
            color: #6B8E6B;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
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
    </style>
</head>
<body>
    <div class="flex h-screen">
        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="p-4 border-b border-[#3A3A3A] flex justify-center">
                <div class="w-10 h-10 bg-gradient-to-br from-[#6B8E6B] to-[#5a7c5a] rounded-lg flex items-center justify-center text-white text-lg">
                    🍽️
                </div>
            </div>
            
            <nav class="flex flex-col mt-8">
                <div class="sidebar-item active">
                    <span class="text-2xl">🏠</span>
                    <span class="text-xs">HOME</span>
                </div>
                <div class="sidebar-item">
                    <span class="text-2xl">📋</span>
                    <span class="text-xs">MENU</span>
                </div>
                <div class="sidebar-item">
                    <span class="text-2xl">📜</span>
                    <span class="text-xs">HISTORY</span>
                </div>
                <div class="sidebar-item">
                    <span class="text-2xl">⚙️</span>
                    <span class="text-xs">SETTINGS</span>
                </div>
            </nav>
            
            <div class="absolute bottom-8 left-0 right-0 flex justify-center">
                <div class="sidebar-item">
                    <span class="text-2xl">🚪</span>
                    <span class="text-xs">LOGOUT</span>
                </div>
            </div>
        </div>
        
        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col">
            <!-- HEADER -->
            <div class="header-bar">
                <div class="flex items-center justify-between px-8 py-4">
                    <div class="flex items-center gap-4">
                        <h2 class="text-2xl font-bold text-[#2D2D2D]">POS / Menu</h2>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-xs text-[#6C757D]">
                            📅 <span id="currentDate">April 15 2026, 10:00 AM</span>
                        </div>
                        <div class="user-badge">
                            <span>👤</span>
                            <span>KASIR 1</span>
                        </div>
                    </div>
                </div>
                
                <!-- CATEGORY TABS -->
                <div class="flex gap-3 px-8 pb-4 overflow-x-auto">
                    <button class="category-btn active">MAKANAN</button>
                    <button class="category-btn">MINUMAN</button>
                    <button class="category-btn">SNACK</button>
                    <button class="category-btn">PAKET HEMAT</button>
                </div>
            </div>
            
            <!-- CONTENT AREA -->
            <div class="flex gap-6 flex-1 overflow-hidden">
                <!-- MENU GRID -->
                <div class="flex-1 px-8 py-6 overflow-y-auto">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <!-- Menu Item 1 -->
                        <div class="menu-card" onclick="addToOrder('Chicken Wings', 20)">
                            <div class="menu-image">
                                <img src="https://images.unsplash.com/photo-1626082927389-6cd097cfd330?w=300&q=80" alt="Chicken Wings">
                            </div>
                            <div class="menu-info">
                                <div class="menu-name">CHICKEN WINGS</div>
                                <div class="menu-category">CATEGORY: 🌶️ 🍗</div>
                            </div>
                        </div>
                        
                        <!-- Menu Item 2 -->
                        <div class="menu-card" onclick="addToOrder('French Fries', 5)">
                            <div class="menu-image">
                                <img src="https://images.unsplash.com/photo-1585238341710-4913d3a3a48f?w=300&q=80" alt="French Fries">
                            </div>
                            <div class="menu-info">
                                <div class="menu-name">FRENCH FRIES</div>
                                <div class="menu-category">CATEGORY: ✨ 🔥</div>
                            </div>
                        </div>
                        
                        <!-- Menu Item 3 -->
                        <div class="menu-card" onclick="addToOrder('Summer Salad', 10)">
                            <div class="menu-image">
                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=300&q=80" alt="Summer Salad">
                            </div>
                            <div class="menu-info">
                                <div class="menu-name">SUMMER SALAD</div>
                                <div class="menu-category">CATEGORY: 🥗 🍃</div>
                            </div>
                        </div>
                        
                        <!-- Menu Item 4 -->
                        <div class="menu-card" onclick="addToOrder('Summer Salad', 10)">
                            <div class="menu-image">
                                <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=300&q=80" alt="Summer Salad">
                            </div>
                            <div class="menu-info">
                                <div class="menu-name">SUMMER SALAD</div>
                                <div class="menu-category">CATEGORY: 🥗 🍃</div>
                            </div>
                        </div>
                        
                        <!-- Menu Item 5 -->
                        <div class="menu-card" onclick="addToOrder('Chicken Wings', 20)">
                            <div class="menu-image">
                                <img src="https://images.unsplash.com/photo-1626082927389-6cd097cfd330?w=300&q=80" alt="Chicken Wings">
                            </div>
                            <div class="menu-info">
                                <div class="menu-name">CHICKEN WINGS</div>
                                <div class="menu-category">CATEGORY: 🌶️ 🍗</div>
                            </div>
                        </div>
                        
                        <!-- Menu Item 6 -->
                        <div class="menu-card" onclick="addToOrder('Chicken Wings', 20)">
                            <div class="menu-image">
                                <img src="https://images.unsplash.com/photo-1626082927389-6cd097cfd330?w=300&q=80" alt="Chicken Wings">
                            </div>
                            <div class="menu-info">
                                <div class="menu-name">CHICKEN WINGS</div>
                                <div class="menu-category">CATEGORY: 🌶️ 🍗</div>
                            </div>
                        </div>
                        
                        <!-- Menu Item 7 -->
                        <div class="menu-card" onclick="addToOrder('Chicken Wings', 20)">
                            <div class="menu-image">
                                <img src="https://images.unsplash.com/photo-1626082927389-6cd097cfd330?w=300&q=80" alt="Chicken Wings">
                            </div>
                            <div class="menu-info">
                                <div class="menu-name">CHICKEN WINGS</div>
                                <div class="menu-category">CATEGORY: 🌶️ 🍗</div>
                            </div>
                        </div>
                        
                        <!-- Menu Item 8 -->
                        <div class="menu-card" onclick="addToOrder('Chicken Wings', 20)">
                            <div class="menu-image">
                                <img src="https://images.unsplash.com/photo-1626082927389-6cd097cfd330?w=300&q=80" alt="Chicken Wings">
                            </div>
                            <div class="menu-info">
                                <div class="menu-name">CHICKEN WINGS</div>
                                <div class="menu-category">CATEGORY: 🌶️ 🍗</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- ORDER PANEL -->
                <div class="order-panel w-80">
                    <!-- ORDER HEADER -->
                    <div class="order-header">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <div class="text-xs text-[#6C757D] mb-2">ORDER #</div>
                                <div class="order-number">12564878</div>
                            </div>
                            <div class="text-right">
                                <div class="badge-info mb-2">TABLE 1</div>
                                <div class="badge-info">GUEST: 2</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ORDER ITEMS -->
                    <div class="order-items" id="orderItems">
                        <div class="text-center text-[#6C757D] text-sm py-8">
                            Klik menu untuk menambahkan item
                        </div>
                    </div>
                    
                    <!-- ORDER SUMMARY -->
                    <div class="order-summary">
                        <div class="summary-row">
                            <span class="summary-label">SUBTOTAL</span>
                            <span class="summary-value" id="subtotal">$0,00</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">SERVICE CHARGE 10%</span>
                            <span class="summary-value" id="serviceCharge">£0,00</span>
                        </div>
                        <div class="summary-total">
                            <span>TOTAL</span>
                            <span class="total-value" id="total">$0,00</span>
                        </div>
                    </div>
                    
                    <!-- ORDER ACTIONS -->
                    <div class="order-actions">
                        <button class="btn-cancel" onclick="cancelOrder()">CANCEL ORDER</button>
                        <button class="btn-send" onclick="sendOrder()">SEND ORDER</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Order data
        let orderData = {};
        let orderCount = 0;
        
        function addToOrder(name, price) {
            if (!orderData[name]) {
                orderData[name] = { price: price, quantity: 0 };
                orderCount++;
            }
            orderData[name].quantity++;
            updateOrderDisplay();
        }
        
        function removeFromOrder(name) {
            if (orderData[name]) {
                orderData[name].quantity--;
                if (orderData[name].quantity <= 0) {
                    delete orderData[name];
                    orderCount--;
                }
                updateOrderDisplay();
            }
        }
        
        function updateOrderDisplay() {
            const orderItemsDiv = document.getElementById('orderItems');
            
            if (Object.keys(orderData).length === 0) {
                orderItemsDiv.innerHTML = '<div class="text-center text-[#6C757D] text-sm py-8">Klik menu untuk menambahkan item</div>';
            } else {
                let html = '';
                for (let name in orderData) {
                    const item = orderData[name];
                    const itemTotal = item.price * item.quantity;
                    html += `
                        <div class="order-item">
                            <div class="order-item-header">
                                <div class="order-item-name">${name}</div>
                                <div class="order-item-price">$${item.price}</div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="order-item-qty">
                                    <button class="qty-btn" onclick="removeFromOrder('${name}')">−</button>
                                    <span class="px-2">${item.quantity}</span>
                                    <button class="qty-btn" onclick="addToOrder('${name}', ${item.price})">+</button>
                                </div>
                                <div class="text-[#2D2D2D] font-600 text-sm">$${itemTotal}</div>
                            </div>
                        </div>
                    `;
                }
                orderItemsDiv.innerHTML = html;
            }
            
            updateSummary();
        }
        
        function updateSummary() {
            let subtotal = 0;
            for (let name in orderData) {
                const item = orderData[name];
                subtotal += item.price * item.quantity;
            }
            
            const serviceCharge = subtotal * 0.1;
            const total = subtotal + serviceCharge;
            
            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('serviceCharge').textContent = `£${serviceCharge.toFixed(2)}`;
            document.getElementById('total').textContent = `$${total.toFixed(2)}`;
        }
        
        function cancelOrder() {
            if (confirm('Batalkan pesanan ini?')) {
                orderData = {};
                orderCount = 0;
                updateOrderDisplay();
            }
        }
        
        function sendOrder() {
            if (Object.keys(orderData).length === 0) {
                alert('Tambahkan minimal satu item');
                return;
            }
            alert('Pesanan dikirim ke dapur!');
            orderData = {};
            orderCount = 0;
            updateOrderDisplay();
        }
        
        // Update current date
        function updateDate() {
            const now = new Date();
            const day = now.getDate();
            const month = now.toLocaleDateString('id-ID', { month: 'long' });
            const year = now.getFullYear();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('currentDate').textContent = `${day} ${month} ${year} pukul ${hours}.${minutes}`;
        }
        
        updateDate();
        setInterval(updateDate, 60000);
    </script>
</body>
</html>
