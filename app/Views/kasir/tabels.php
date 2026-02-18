<!DOCTYPE html>
<html>
<head>
  <title>Denah Meja Restoran - Top View</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: #f3f4f6;
      padding: 20px;
    }
    
    /* Table styles */
    .table {
      position: relative;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.2s ease;
      filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
      margin: 20px;
    }

    .table:hover {
      transform: scale(1.02);
      filter: drop-shadow(0 4px 6px rgba(37, 99, 235, 0.2));
    }

    /* Large table - Rectangle for max 12 persons */
    .table-large {
      width: 160px;
      height: 80px;
      background: #f9fafb;
      border: 2px solid #2563eb;
      border-radius: 20px;
      position: relative;
      box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
    }

    .table-large::before {
      content: '';
      position: absolute;
      top: -6px;
      left: 50%;
      transform: translateX(-50%);
      width: 60%;
      height: 4px;
      background: #2563eb;
      border-radius: 2px;
      opacity: 0.6;
    }

    .table-large::after {
      content: '';
      position: absolute;
      bottom: -6px;
      left: 50%;
      transform: translateX(-50%);
      width: 60%;
      height: 4px;
      background: #2563eb;
      border-radius: 2px;
      opacity: 0.6;
    }

    /* Medium table - Square for max 8 persons */
    .table-medium {
      width: 90px;
      height: 90px;
      background: #f9fafb;
      border: 2px solid #2563eb;
      border-radius: 16px;
      position: relative;
      box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
    }

    .table-medium::before,
    .table-medium::after {
      content: '';
      position: absolute;
      width: 14px;
      height: 14px;
      background: #2563eb;
      border-radius: 4px;
      opacity: 0.4;
    }

    .table-medium::before {
      top: -6px;
      left: -6px;
    }

    .table-medium::after {
      bottom: -6px;
      right: -6px;
    }

    /* Small table - Circle for max 4 persons */
    .table-small {
      width: 70px;
      height: 70px;
      background: #f9fafb;
      border: 2px solid #2563eb;
      border-radius: 50%;
      position: relative;
      box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
    }

    .table-small::before {
      content: '●';
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #2563eb;
      font-size: 20px;
      opacity: 0.4;
    }

    /* Table number and capacity */
    .table-info {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      color: #1f2937;
      font-weight: bold;
      z-index: 2;
      background: rgba(255,255,255,0.95);
      padding: 4px 8px;
      border-radius: 9999px;
      border: 1px solid #e5e7eb;
      white-space: nowrap;
    }

    .table-number {
      font-size: 11px;
      color: #2563eb;
    }

    .table-capacity {
      font-size: 8px;
      color: #6b7280;
      margin-top: 2px;
    }

    /* Chairs for large table */
    .chair-row {
      position: absolute;
      display: flex;
      gap: 5px;
    }

    .chair {
      width: 14px;
      height: 14px;
      background: #e5e7eb;
      border: 1px solid #9ca3af;
      border-radius: 4px 4px 2px 2px;
    }

    /* Chairs for medium table */
    .chair-medium {
      width: 12px;
      height: 12px;
      background: #e5e7eb;
      border: 1px solid #9ca3af;
      border-radius: 4px 4px 2px 2px;
    }

    /* Chairs for small table */
    .chair-small {
      width: 10px;
      height: 10px;
      background: #e5e7eb;
      border: 1px solid #9ca3af;
      border-radius: 4px 4px 2px 2px;
    }

    /* Plants */
    .plant {
      position: absolute;
      width: 25px;
      height: 35px;
      background: #86efac;
      border-radius: 30px 30px 10px 10px;
      opacity: 0.8;
    }

    .plant::before {
      content: '🌿';
      position: absolute;
      top: -12px;
      left: -3px;
      font-size: 16px;
    }

    /* Kasir/meja informasi */
    .info-box {
      background: white;
      border: 2px solid #2563eb;
      border-radius: 16px;
      padding: 12px 24px;
      text-align: center;
      display: inline-block;
      margin-bottom: 30px;
    }
    
    .info-box h3 {
      color: #2563eb;
      font-weight: bold;
      font-size: 18px;
    }
    
    .info-box p {
      color: #6b7280;
      font-size: 12px;
    }

    /* Baris container */
    .row-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
      margin-bottom: 40px;
      padding: 20px;
      background: #f9fafb;
      border-radius: 16px;
    }

    .row-title {
      width: 100%;
      text-align: left;
      font-weight: bold;
      color: #4b5563;
      margin-bottom: 10px;
      padding-left: 10px;
      border-left: 4px solid #2563eb;
    }
  </style>
</head>

<body>
  <!-- TOPBAR -->
  <div class="bg-white shadow-sm px-8 py-4 flex justify-between items-center mb-6 rounded-lg">
    <h1 class="text-xl font-bold text-red-600">Kasir</h1>
    <div class="flex items-center gap-4">
      <a href="/logout" class="text-gray-600 hover:text-red-500 text-sm">Logout</a>
    </div>
  </div>

  <!-- Info Box (Kasir) -->
  <div class="info-box">
    <h3>KASIR</h3>
    <p>Meja tersedia: 18</p>
  </div>

  <!-- ==================== MEJA SESUAI DATABASE - 18 MEJA ==================== -->
  
  <!-- BARIS 1 - Meja Besar (max 12) -->
  <div class="row-container">
    <div class="row-title">🏆 MEJA BESAR (Kapasitas 12 Orang)</div>
    
    <!-- L1 -->
    <div class="table" onclick="openModal('L1', 12)">
      <div class="table-large">
        <div class="table-info">
          <div class="table-number">L1</div>
          <div class="table-capacity">max 12</div>
        </div>
      </div>
      <div class="chair-row" style="top: -18px; left: 35px;">
        <div class="chair"></div><div class="chair"></div><div class="chair"></div><div class="chair"></div>
      </div>
      <div class="chair-row" style="bottom: -18px; left: 35px;">
        <div class="chair"></div><div class="chair"></div><div class="chair"></div><div class="chair"></div>
      </div>
    </div>

    <!-- L2 -->
    <div class="table" onclick="openModal('L2', 12)">
      <div class="table-large">
        <div class="table-info">
          <div class="table-number">L2</div>
          <div class="table-capacity">max 12</div>
        </div>
      </div>
      <div class="chair-row" style="top: -18px; left: 35px;">
        <div class="chair"></div><div class="chair"></div><div class="chair"></div><div class="chair"></div>
      </div>
      <div class="chair-row" style="bottom: -18px; left: 35px;">
        <div class="chair"></div><div class="chair"></div><div class="chair"></div><div class="chair"></div>
      </div>
    </div>

    <!-- L3 -->
    <div class="table" onclick="openModal('L3', 12)">
      <div class="table-large">
        <div class="table-info">
          <div class="table-number">L3</div>
          <div class="table-capacity">max 12</div>
        </div>
      </div>
      <div class="chair-row" style="top: -18px; left: 35px;">
        <div class="chair"></div><div class="chair"></div><div class="chair"></div><div class="chair"></div>
      </div>
      <div class="chair-row" style="bottom: -18px; left: 35px;">
        <div class="chair"></div><div class="chair"></div><div class="chair"></div><div class="chair"></div>
      </div>
    </div>
  </div>

  <!-- BARIS 2 - Meja Sedang Bagian 1 (max 8) -->
  <div class="row-container">
    <div class="row-title">📊 MEJA SEDANG (Kapasitas 8 Orang) - Bagian 1</div>
    
    <!-- M1 -->
    <div class="table" onclick="openModal('M1', 8)">
      <div class="table-medium">
        <div class="table-info">
          <div class="table-number">M1</div>
          <div class="table-capacity">max 8</div>
        </div>
      </div>
      <div class="chair-row" style="top: -14px; left: 20px;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="bottom: -14px; left: 20px;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="left: -14px; top: 30px; flex-direction: column;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="right: -14px; top: 30px; flex-direction: column;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
    </div>

    <!-- M2 -->
    <div class="table" onclick="openModal('M2', 8)">
      <div class="table-medium">
        <div class="table-info">
          <div class="table-number">M2</div>
          <div class="table-capacity">max 8</div>
        </div>
      </div>
      <div class="chair-row" style="top: -14px; left: 20px;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="bottom: -14px; left: 20px;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="left: -14px; top: 30px; flex-direction: column;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="right: -14px; top: 30px; flex-direction: column;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
    </div>

    <!-- M3 -->
    <div class="table" onclick="openModal('M3', 8)">
      <div class="table-medium">
        <div class="table-info">
          <div class="table-number">M3</div>
          <div class="table-capacity">max 8</div>
        </div>
      </div>
      <div class="chair-row" style="top: -14px; left: 20px;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="bottom: -14px; left: 20px;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="left: -14px; top: 30px; flex-direction: column;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="right: -14px; top: 30px; flex-direction: column;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
    </div>
  </div>

  <!-- BARIS 3 - Meja Sedang Bagian 2 (max 8) -->
  <div class="row-container">
    <div class="row-title">📊 MEJA SEDANG (Kapasitas 8 Orang) - Bagian 2</div>
    
    <!-- M4 -->
    <div class="table" onclick="openModal('M4', 8)">
      <div class="table-medium">
        <div class="table-info">
          <div class="table-number">M4</div>
          <div class="table-capacity">max 8</div>
        </div>
      </div>
      <div class="chair-row" style="top: -14px; left: 20px;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="bottom: -14px; left: 20px;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="left: -14px; top: 30px; flex-direction: column;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="right: -14px; top: 30px; flex-direction: column;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
    </div>

    <!-- M5 -->
    <div class="table" onclick="openModal('M5', 8)">
      <div class="table-medium">
        <div class="table-info">
          <div class="table-number">M5</div>
          <div class="table-capacity">max 8</div>
        </div>
      </div>
      <div class="chair-row" style="top: -14px; left: 20px;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="bottom: -14px; left: 20px;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="left: -14px; top: 30px; flex-direction: column;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="right: -14px; top: 30px; flex-direction: column;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
    </div>

    <!-- M6 -->
    <div class="table" onclick="openModal('M6', 8)">
      <div class="table-medium">
        <div class="table-info">
          <div class="table-number">M6</div>
          <div class="table-capacity">max 8</div>
        </div>
      </div>
      <div class="chair-row" style="top: -14px; left: 20px;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="bottom: -14px; left: 20px;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="left: -14px; top: 30px; flex-direction: column;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
      <div class="chair-row" style="right: -14px; top: 30px; flex-direction: column;">
        <div class="chair-medium"></div><div class="chair-medium"></div>
      </div>
    </div>
  </div>

  <!-- BARIS 4 - Meja Kecil Bagian 1 (max 4) -->
  <div class="row-container">
    <div class="row-title">🍽️ MEJA KECIL (Kapasitas 4 Orang) - Bagian 1</div>
    
    <!-- S1 -->
    <div class="table" onclick="openModal('S1', 4)">
      <div class="table-small">
        <div class="table-info">
          <div class="table-number">S1</div>
          <div class="table-capacity">max 4</div>
        </div>
      </div>
      <div class="chair-small" style="position: absolute; top: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; bottom: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; left: -12px; top: 30px;"></div>
      <div class="chair-small" style="position: absolute; right: -12px; top: 30px;"></div>
    </div>

    <!-- S2 -->
    <div class="table" onclick="openModal('S2', 4)">
      <div class="table-small">
        <div class="table-info">
          <div class="table-number">S2</div>
          <div class="table-capacity">max 4</div>
        </div>
      </div>
      <div class="chair-small" style="position: absolute; top: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; bottom: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; left: -12px; top: 30px;"></div>
      <div class="chair-small" style="position: absolute; right: -12px; top: 30px;"></div>
    </div>

    <!-- S3 -->
    <div class="table" onclick="openModal('S3', 4)">
      <div class="table-small">
        <div class="table-info">
          <div class="table-number">S3</div>
          <div class="table-capacity">max 4</div>
        </div>
      </div>
      <div class="chair-small" style="position: absolute; top: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; bottom: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; left: -12px; top: 30px;"></div>
      <div class="chair-small" style="position: absolute; right: -12px; top: 30px;"></div>
    </div>

    <!-- S4 -->
    <div class="table" onclick="openModal('S4', 4)">
      <div class="table-small">
        <div class="table-info">
          <div class="table-number">S4</div>
          <div class="table-capacity">max 4</div>
        </div>
      </div>
      <div class="chair-small" style="position: absolute; top: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; bottom: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; left: -12px; top: 30px;"></div>
      <div class="chair-small" style="position: absolute; right: -12px; top: 30px;"></div>
    </div>

    <!-- S5 -->
    <div class="table" onclick="openModal('S5', 4)">
      <div class="table-small">
        <div class="table-info">
          <div class="table-number">S5</div>
          <div class="table-capacity">max 4</div>
        </div>
      </div>
      <div class="chair-small" style="position: absolute; top: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; bottom: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; left: -12px; top: 30px;"></div>
      <div class="chair-small" style="position: absolute; right: -12px; top: 30px;"></div>
    </div>
  </div>

  <!-- BARIS 5 - Meja Kecil Bagian 2 (max 4) -->
  <div class="row-container">
    <div class="row-title">🍽️ MEJA KECIL (Kapasitas 4 Orang) - Bagian 2</div>
    
    <!-- S6 -->
    <div class="table" onclick="openModal('S6', 4)">
      <div class="table-small">
        <div class="table-info">
          <div class="table-number">S6</div>
          <div class="table-capacity">max 4</div>
        </div>
      </div>
      <div class="chair-small" style="position: absolute; top: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; bottom: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; left: -12px; top: 30px;"></div>
      <div class="chair-small" style="position: absolute; right: -12px; top: 30px;"></div>
    </div>

    <!-- S7 -->
    <div class="table" onclick="openModal('S7', 4)">
      <div class="table-small">
        <div class="table-info">
          <div class="table-number">S7</div>
          <div class="table-capacity">max 4</div>
        </div>
      </div>
      <div class="chair-small" style="position: absolute; top: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; bottom: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; left: -12px; top: 30px;"></div>
      <div class="chair-small" style="position: absolute; right: -12px; top: 30px;"></div>
    </div>

    <!-- S8 -->
    <div class="table" onclick="openModal('S8', 4)">
      <div class="table-small">
        <div class="table-info">
          <div class="table-number">S8</div>
          <div class="table-capacity">max 4</div>
        </div>
      </div>
      <div class="chair-small" style="position: absolute; top: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; bottom: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; left: -12px; top: 30px;"></div>
      <div class="chair-small" style="position: absolute; right: -12px; top: 30px;"></div>
    </div>

    <!-- S9 -->
    <div class="table" onclick="openModal('S9', 4)">
      <div class="table-small">
        <div class="table-info">
          <div class="table-number">S9</div>
          <div class="table-capacity">max 4</div>
        </div>
      </div>
      <div class="chair-small" style="position: absolute; top: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; bottom: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; left: -12px; top: 30px;"></div>
      <div class="chair-small" style="position: absolute; right: -12px; top: 30px;"></div>
    </div>

    <!-- S10 -->
    <div class="table" onclick="openModal('S10', 4)">
      <div class="table-small">
        <div class="table-info">
          <div class="table-number">S10</div>
          <div class="table-capacity">max 4</div>
        </div>
      </div>
      <div class="chair-small" style="position: absolute; top: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; bottom: -12px; left: 30px;"></div>
      <div class="chair-small" style="position: absolute; left: -12px; top: 30px;"></div>
      <div class="chair-small" style="position: absolute; right: -12px; top: 30px;"></div>
    </div>
  </div>

  <!-- Legend -->
  <div class="flex flex-wrap justify-center gap-8 mt-8 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
    <div class="flex items-center gap-2">
      <div class="w-10 h-5 bg-gray-50 border-2 border-blue-500 rounded"></div>
      <span class="text-sm text-gray-600">Meja Besar (max 12) - 3 meja</span>
    </div>
    <div class="flex items-center gap-2">
      <div class="w-6 h-6 bg-gray-50 border-2 border-blue-500 rounded"></div>
      <span class="text-sm text-gray-600">Meja Sedang (max 8) - 6 meja</span>
    </div>
    <div class="flex items-center gap-2">
      <div class="w-6 h-6 bg-gray-50 border-2 border-blue-500 rounded-full"></div>
      <span class="text-sm text-gray-600">Meja Kecil (max 4) - 9 meja</span>
    </div>
    <div class="flex items-center gap-2">
      <span class="text-sm font-bold text-blue-600">Total: 18 meja</span>
    </div>
  </div>

  <!-- MODAL NEW ORDER -->
  <div id="tableModal"
       class="fixed inset-0 bg-black/40 hidden flex items-center justify-center z-50">

    <div class="bg-white p-8 rounded-2xl w-full max-w-md shadow-xl">

      <h2 class="text-xl font-bold mb-6 text-gray-800">New Order</h2>

      <form action="/order" method="post">
        
        <input type="hidden" name="table" id="selectedTable">
        <input type="hidden" name="maxCapacity" id="maxCapacity">

        <div class="mb-4">
          <label class="text-sm text-gray-600">Table</label>
          <input type="text" id="tableDisplay"
            class="w-full border border-gray-300 bg-gray-50 p-3 rounded-lg"
            readonly>
        </div>

        <div class="mb-4">
          <label class="text-sm text-gray-600">Customer Name</label>
          <input type="text" name="customer"
            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
            required>
        </div>

        <div class="mb-6">
          <label class="text-sm text-gray-600">Total Person <span id="capacityWarning" class="text-xs text-yellow-600 ml-2"></span></label>
          <input type="number" name="person" id="totalPerson" min="1"
            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
            required onchange="checkCapacity()">
        </div>

        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold">
          Order Now
        </button>
      </form>

    </div>
  </div>

  <script>
    let currentMaxCapacity = 0;

    function openModal(table, maxCapacity) {
      currentMaxCapacity = maxCapacity;
      document.getElementById('tableModal').classList.remove('hidden');
      document.getElementById('selectedTable').value = table;
      document.getElementById('tableDisplay').value = table + ' (Max ' + maxCapacity + ' orang)';
      document.getElementById('maxCapacity').value = maxCapacity;
      document.getElementById('totalPerson').value = '';
      document.getElementById('capacityWarning').innerHTML = '';
    }

    function checkCapacity() {
      const totalPerson = parseInt(document.getElementById('totalPerson').value);
      const warning = document.getElementById('capacityWarning');
      
      if (totalPerson > currentMaxCapacity) {
        warning.innerHTML = '⚠️ Melebihi kapasitas maksimal!';
        warning.classList.add('text-red-600');
        warning.classList.remove('text-yellow-600', 'text-green-600');
      } else if (totalPerson > 0) {
        warning.innerHTML = '✓ Kapasitas tersedia';
        warning.classList.add('text-green-600');
        warning.classList.remove('text-yellow-600', 'text-red-600');
      }
    }

    window.onclick = function(e) {
      let modal = document.getElementById('tableModal');
      if (e.target == modal) {
        modal.classList.add('hidden');
      }
    }

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        document.getElementById('tableModal').classList.add('hidden');
      }
    });
  </script>

</body>
</html>