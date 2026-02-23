<!DOCTYPE html>
<html>
<head>
  <title>Order - <?= $table ?? 'Table' ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#1e0f08] min-h-screen text-gray-800">

<div class="w-full min-h-screen bg-white">

  <!-- HEADER -->
  <div class="flex justify-between items-center px-10 py-6 border-b">
    <h1 class="text-xl font-semibold">
      Table <?= $table ?? '' ?>
    </h1>
    <span class="bg-gray-100 px-4 py-1 rounded-full text-sm">
      Order
    </span>
  </div>

  <div class="flex">

    <!-- LEFT SIDE -->
    <div class="w-2/3 px-10 py-8">

      <!-- SEARCH -->
      <input 
        type="text"
        id="searchInput"
        placeholder="Search your dish..."
        onkeyup="filterMenu()"
        class="w-full border rounded-xl px-5 py-3 mb-6 focus:outline-none focus:ring-2 focus:ring-red-500 transition">

      <!-- CATEGORY -->
      <div class="flex gap-8 mb-6">
        <button onclick="setCategory('classic')" id="cat-classic"
          class="category-btn font-semibold text-red-600 border-b-2 border-red-600 pb-1">
          Classic Pizzas
        </button>

        <button onclick="setCategory('starters')" id="cat-starters"
          class="category-btn text-gray-500">
          Starters
        </button>

        <button onclick="setCategory('drinks')" id="cat-drinks"
          class="category-btn text-gray-500">
          Drinks
        </button>
      </div>

      <!-- MENU GRID -->
      <div id="menuGrid" class="grid grid-cols-3 gap-6">
      </div>

    </div>

    <!-- RIGHT SIDE CART -->
    <div class="w-1/3 bg-gray-50 px-8 py-8">
      <h2 class="text-lg font-semibold mb-6">Order Summary</h2>

      <div id="cartItems" class="space-y-4 mb-6"></div>

      <div class="border-t pt-4">
        <div class="flex justify-between mb-2">
          <span>Subtotal</span>
          <span id="subtotal">€0</span>
        </div>

        <button onclick="checkout()" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl font-semibold transition">
          Checkout
        </button>
      </div>
    </div>

  </div>
</div>

<!-- MODAL -->
<div id="productModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center transition">
  <div class="bg-white rounded-2xl w-[700px] p-8 relative animate-fadeIn">

    <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500">✕</button>

    <div class="flex gap-8">

      <div class="w-1/2">
        <div class="h-64 bg-gray-200 rounded-xl"></div>
      </div>

      <div class="w-1/2">
        <h2 id="modalName" class="text-2xl font-bold mb-2"></h2>
        <p id="modalPrice" class="text-gray-600 mb-6"></p>

        <div class="flex items-center gap-4 mb-6">
          <button onclick="changeQty(-1)" class="px-3 py-1 bg-gray-200 rounded">-</button>
          <span id="modalQty">1</span>
          <button onclick="changeQty(1)" class="px-3 py-1 bg-gray-200 rounded">+</button>
        </div>

        <button onclick="addToCartFromModal()"
          class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl font-semibold transition">
          Add to Cart
        </button>
      </div>

    </div>

  </div>
</div>

<style>
@keyframes fadeIn {
  from { opacity:0; transform: scale(0.95); }
  to { opacity:1; transform: scale(1); }
}
.animate-fadeIn {
  animation: fadeIn 0.2s ease-in-out;
}
</style>

<script>

let currentCategory = "classic";
let modalProduct = null;
let modalQty = 1;
let cart = [];

const products = [
  {name:"Capricciosa", price:10, category:"classic"},
  {name:"BBQ Chicken", price:12, category:"classic"},
  {name:"Garlic Bread", price:6, category:"starters"},
  {name:"French Fries", price:5, category:"starters"},
  {name:"Coca Cola", price:4, category:"drinks"},
  {name:"Mineral Water", price:3, category:"drinks"}
];

function renderMenu(){
  let grid = document.getElementById("menuGrid");
  grid.innerHTML = "";

  let search = document.getElementById("searchInput").value.toLowerCase();

  products
    .filter(p => p.category === currentCategory)
    .filter(p => p.name.toLowerCase().includes(search))
    .forEach(p => {

      grid.innerHTML += `
        <div onclick="openModal('${p.name}', ${p.price})"
          class="bg-gray-50 rounded-xl p-4 shadow hover:shadow-lg cursor-pointer transition hover:-translate-y-1">

          <div class="h-32 bg-gray-200 rounded-lg mb-3"></div>
          <h3 class="font-semibold">${p.name}</h3>
          <p class="text-sm text-gray-500">€${p.price}</p>
        </div>
      `;
    });
}

function setCategory(cat){
  currentCategory = cat;

  document.querySelectorAll(".category-btn").forEach(btn=>{
    btn.classList.remove("text-red-600","border-b-2","border-red-600","font-semibold");
    btn.classList.add("text-gray-500");
  });

  let active = document.getElementById("cat-"+cat);
  active.classList.add("text-red-600","border-b-2","border-red-600","font-semibold");
  active.classList.remove("text-gray-500");

  renderMenu();
}

function filterMenu(){
  renderMenu();
}

function openModal(name, price){
  modalProduct = {name, price};
  modalQty = 1;
  document.getElementById("modalName").innerText = name;
  document.getElementById("modalPrice").innerText = "€" + price;
  document.getElementById("modalQty").innerText = modalQty;
  document.getElementById("productModal").classList.remove("hidden");
  document.getElementById("productModal").classList.add("flex");
}

function closeModal(){
  document.getElementById("productModal").classList.add("hidden");
}

function changeQty(change){
  modalQty += change;
  if(modalQty < 1) modalQty = 1;
  document.getElementById("modalQty").innerText = modalQty;
}

function addToCartFromModal(){
  let existing = cart.find(i => i.name === modalProduct.name);

  if(existing){
    existing.qty += modalQty;
  } else {
    cart.push({...modalProduct, qty:modalQty});
  }

  closeModal();
  renderCart();
}

function renderCart(){
  let container = document.getElementById("cartItems");
  container.innerHTML = "";
  let subtotal = 0;

  cart.forEach(item=>{
    subtotal += item.price * item.qty;

    container.innerHTML += `
      <div class="bg-white p-4 rounded-xl shadow flex justify-between">
        <div>
          <p class="font-semibold">${item.name}</p>
          <p class="text-sm text-gray-500">€${item.price} x ${item.qty}</p>
        </div>
        <span>€${item.price * item.qty}</span>
      </div>
    `;
  });

  document.getElementById("subtotal").innerText = "€" + subtotal;
}

function checkout(){
  if(cart.length === 0){
    alert("Cart is empty!");
    return;
  }
  
  window.location.href = "<?= base_url('order/success') ?>";
}

renderMenu();

</script>

</body>
</html>
