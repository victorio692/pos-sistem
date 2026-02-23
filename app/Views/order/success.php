<!DOCTYPE html>
<html>
<head>
  <title>Order Success</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#1e0f08] min-h-screen flex items-center justify-center">

<div class="bg-white w-[1100px] rounded-2xl shadow-2xl overflow-hidden flex">

  <!-- LEFT SIDE - ORDER DETAILS -->
  <div class="w-1/2 p-12 bg-gray-50">

    <h2 class="text-2xl font-semibold mb-8 text-center">
      Order Details
    </h2>

    <div class="space-y-3 text-gray-700">
      <div class="flex justify-between">
        <span>Order Code</span>
        <span class="font-medium">T128038</span>
      </div>

      <div class="flex justify-between">
        <span>Table</span>
        <span class="font-medium">T-6</span>
      </div>

      <div class="flex justify-between">
        <span>Payment Method</span>
        <span class="font-medium">QRIS</span>
      </div>
    </div>

    <hr class="my-6">

    <!-- ORDER ITEMS -->
    <div class="space-y-3 text-gray-700">

      <div class="flex justify-between">
        <span>Capricciosa</span>
        <span>1x €15.00</span>
      </div>

      <div class="flex justify-between">
        <span>BBQ Chicken</span>
        <span>1x €12.00</span>
      </div>

      <div class="flex justify-between">
        <span>French Fries</span>
        <span>1x €5.00</span>
      </div>

    </div>

    <hr class="my-6">

    <!-- TOTAL SECTION -->
    <div class="space-y-3 text-gray-700">

      <div class="flex justify-between">
        <span>Subtotal</span>
        <span>€32.00</span>
      </div>

      <div class="flex justify-between">
        <span>Discount</span>
        <span>€2.00</span>
      </div>

      <div class="flex justify-between">
        <span>Tax</span>
        <span>€3.00</span>
      </div>

      <hr>

      <div class="flex justify-between text-lg font-semibold">
        <span>Total</span>
        <span>€33.00</span>
      </div>

    </div>

  </div>

  <!-- RIGHT SIDE - SUCCESS -->
  <div class="w-1/2 flex flex-col items-center justify-center p-12">

    <div class="w-28 h-28 bg-green-100 rounded-full flex items-center justify-center mb-6">
      <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center text-white text-3xl">
        ✓
      </div>
    </div>

    <h2 class="text-2xl font-semibold mb-3">
      Order Successful
    </h2>

    <p class="text-gray-500 mb-10 text-center">
      Thanks for your order, we’ll prepare your food!
    </p>

    <button onclick="window.print()"
      class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl font-semibold transition mb-4">
      Print
    </button>

    <button
      class="w-full bg-gray-200 text-gray-500 py-3 rounded-xl font-semibold cursor-not-allowed">
      Share to email
    </button>

  </div>

</div>

</body>
</html>
 