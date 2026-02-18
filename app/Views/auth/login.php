<!DOCTYPE html>
<html>
<head>
  <title>Login POS</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen bg-gray-100">

<div class="flex h-full">

  <!-- LEFT SIDE -->
  <div class="hidden md:flex w-1/2 bg-red-600 relative items-center justify-center overflow-hidden">
    
    <!-- Carousel Container -->
    <div class="relative w-full h-full">
      
      <!-- Slides -->
      <div class="slides flex h-full transition-transform duration-500" id="carouselSlides">
        
        <!-- Slide 1 - Hidangan Istimewa -->
        <div class="w-full h-full flex-shrink-0 bg-gradient-to-br from-amber-900 to-amber-800 flex items-center justify-center relative" style="background-image: url('/images/slide1.jpg'); background-size: cover; background-position: center;">
        </div>

        <!-- Slide 2 - Diskon 50% -->
        <div class="w-full h-full flex-shrink-0 bg-gradient-to-br from-yellow-400 to-red-500 flex items-center justify-center relative" style="background-image: url('/images/slide2.jpg'); background-size: cover; background-position: center;">
        </div>

        <!-- Slide 3 - Menu Pilihan -->
        <div class="w-full h-full flex-shrink-0 bg-gradient-to-br from-orange-700 to-amber-900 flex items-center justify-center relative" style="background-image: url('/images/slide3.jpg'); background-size: cover; background-position: center;">
        </div>

      </div>

      <!-- Previous Button -->
      <button onclick="prevSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 z-20 bg-white/30 hover:bg-white/50 text-white rounded-full p-3 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
      </button>

      <!-- Next Button -->
      <button onclick="nextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 z-20 bg-white/30 hover:bg-white/50 text-white rounded-full p-3 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
      </button>

      <!-- Dots Indicator -->
      <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-20 flex gap-2">
        <button onclick="goToSlide(0)" class="w-3 h-3 rounded-full bg-white/60 hover:bg-white transition dot" data-slide="0"></button>
        <button onclick="goToSlide(1)" class="w-3 h-3 rounded-full bg-white/60 hover:bg-white transition dot" data-slide="1"></button>
        <button onclick="goToSlide(2)" class="w-3 h-3 rounded-full bg-white transition dot" data-slide="2"></button>
      </div>

    </div>

  </div>


  <!-- RIGHT SIDE -->
  <div class="flex w-full md:w-1/2 items-center justify-center bg-white px-10">

    <div class="w-full max-w-md">

      <h2 class="text-3xl font-bold mb-2 text-gray-800">
        Welcome back!
      </h2>

      <p class="text-gray-500 mb-8">
        Login untuk masuk kehalaman kasir
      </p>

      <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <form action="/proses-login" method="post" class="space-y-5">
        <?= csrf_field() ?>

        <div>
          <label class="block text-sm text-gray-600 mb-1">Username</label>
          <input type="text" name="username"
            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none"
            required>
        </div>

        <div>
          <label class="block text-sm text-gray-600 mb-1">Password</label>
          <input type="password" name="password"
            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none"
            required>
        </div>

        <button
          class="w-full bg-red-600 hover:bg-red-700 transition duration-200 text-white py-3 rounded-lg font-semibold shadow-md">
          Log in
        </button>
      </form>

    </div>

  </div>

</div>

</body>

<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.slides');
const totalSlides = 3;

function updateCarousel() {
  const slideContainer = document.getElementById('carouselSlides');
  slideContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
  
  // Update dots
  document.querySelectorAll('.dot').forEach((dot, index) => {
    if (index === currentSlide) {
      dot.classList.remove('bg-white/60');
      dot.classList.add('bg-white');
    } else {
      dot.classList.add('bg-white/60');
      dot.classList.remove('bg-white');
    }
  });
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % totalSlides;
  updateCarousel();
}

function prevSlide() {
  currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
  updateCarousel();
}

function goToSlide(n) {
  currentSlide = n;
  updateCarousel();
}

// Auto slide every 5 seconds
setInterval(nextSlide, 5000);

// Initialize
updateCarousel();
</script>

</html>
