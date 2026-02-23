<!DOCTYPE html>
<html>
<head>
  <title>New Order - Table <?= $tableNumber ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#2b140c] min-h-screen flex items-center justify-center p-6">

<div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md">

  <h1 class="text-2xl font-bold mb-2">New Order</h1>
  <p class="text-gray-600 mb-6">Table <?= $tableNumber ?></p>

  <form action="<?= base_url('order') ?>" method="post">
    
    <input type="hidden" name="table_number" value="<?= $tableNumber ?>">

    <div class="mb-4">
      <label class="block text-sm font-semibold mb-2">Customer Name</label>
      <input type="text" name="customer_name" required class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
    </div>

    <div class="mb-6">
      <label class="block text-sm font-semibold mb-2">Total Person</label>
      <input type="number" name="total_person" required min="1" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
    </div>

    <button type="submit" class="w-full bg-red-600 text-white font-semibold py-2 rounded-lg hover:bg-red-700 transition">
      Order Now
    </button>

  </form>

</div>

</body>
</html>
