<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - POS Restoran</title>
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
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f5f5f5 100%);
            min-height: 100vh;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(107, 142, 107, 0.15);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }
        
        .sage-accent {
            color: #6B8E6B;
        }
        
        .input-group {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(107, 142, 107, 0.6);
            font-size: 18px;
        }
        
        .form-input {
            background: #ffffff;
            border: 2px solid #e9ecef;
            color: #2D2D2D;
            transition: all 0.3s ease;
        }
        
        .form-input::placeholder {
            color: #6C757D;
        }
        
        .form-input:focus {
            background: #ffffff;
            border-color: #6B8E6B;
            outline: none;
            box-shadow: 0 0 10px rgba(107, 142, 107, 0.2);
        }
        
        .btn-sage {
            background: linear-gradient(135deg, #6B8E6B 0%, #5a7c5a 100%);
            color: #ffffff;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(107, 142, 107, 0.25);
        }
        
        .btn-sage:hover {
            background: linear-gradient(135deg, #7a9d7a 0%, #6B8E6B 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(107, 142, 107, 0.35);
        }
        
        .btn-sage:active {
            transform: translateY(0);
        }
        
        .btn-cancel {
            background: transparent;
            border: 2px solid #E76F51;
            color: #E76F51;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-cancel:hover {
            background: #E76F51;
            color: #ffffff;
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .slide-in-left {
            animation: slideInLeft 0.8s ease-out;
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .slide-in-right {
            animation: slideInRight 0.8s ease-out;
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .image-overlay {
            background: linear-gradient(135deg, rgba(107, 142, 107, 0.7) 0%, rgba(90, 124, 90, 0.7) 100%);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
        
        .error-message {
            animation: slideDown 0.4s ease-out;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .label-text {
            color: #2D2D2D;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .text-secondary {
            color: #6C757D;
        }
        
        .divider-line {
            background: linear-gradient(90deg, transparent, rgba(107, 142, 107, 0.15), transparent);
            height: 1px;
        }
        
        .icon-logo {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #6B8E6B 0%, #5a7c5a 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 4px 12px rgba(107, 142, 107, 0.2);
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-6xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                
                <!-- LEFT SIDE - Image Section -->
                <div class="hidden lg:flex relative h-96 lg:h-screen rounded-2xl overflow-hidden slide-in-left shadow-xl">
                    <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800&q=80'); background-size: cover; background-position: center;">
                        <div class="image-overlay flex flex-col items-center justify-center text-white space-y-4 p-8">
                            <svg class="w-24 h-24 text-white opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C6.5 6.253 2 8.957 2 12.5c0 4.446 4 7.5 10 7.5s10-3.054 10-7.5c0-3.543-4.5-6.247-10-6.247z"></path>
                            </svg>
                            <h3 class="text-4xl font-bold playfair text-center">Fine Dining</h3>
                            <p class="text-lg text-white/90">Pengalaman Kuliner Istimewa</p>
                        </div>
                    </div>
                </div>
                
                <!-- RIGHT SIDE - Login Form -->
                <div class="flex items-center justify-center slide-in-right">
                    <div class="w-full max-w-md">
                        <!-- Logo/Branding -->
                        <div class="text-center mb-8 fade-in">
                            <div class="flex justify-center mb-4">
                                <div class="icon-logo">🍽️</div>
                            </div>
                            <h1 class="playfair text-4xl font-bold sage-accent mb-2">Hidangan Istimewa</h1>
                            <p class="text-secondary text-sm">Welcome back! Login untuk masuk ke halaman kasir</p>
                        </div>
                        
                        <!-- Glass Card Form -->
                        <div class="glass-effect rounded-2xl p-8 fade-in" style="animation-delay: 0.1s;">
                            
                            <!-- Error Message -->
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="error-message mb-6 p-4 rounded-lg bg-red-50 border-2 border-red-200">
                                    <div class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="text-red-700 text-sm font-medium"><?= session()->getFlashdata('error') ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <form action="<?= base_url('proses-login') ?>" method="post" class="space-y-5">
                                
                                <!-- Username Field -->
                                <div>
                                    <label class="label-text block mb-2">Username</label>
                                    <div class="input-group">
                                        <span class="input-icon">👤</span>
                                        <input 
                                            type="text" 
                                            name="username" 
                                            placeholder="Masukkan username"
                                            class="form-input w-full pl-12 pr-4 py-3 rounded-lg"
                                            required
                                            autocomplete="off"
                                        >
                                    </div>
                                </div>
                                
                                <!-- Password Field -->
                                <div>
                                    <label class="label-text block mb-2">Password</label>
                                    <div class="input-group">
                                        <span class="input-icon">🔒</span>
                                        <input 
                                            type="password" 
                                            name="password" 
                                            placeholder="Masukkan password"
                                            class="form-input w-full pl-12 pr-4 py-3 rounded-lg"
                                            required
                                            id="password"
                                        >
                                    </div>
                                </div>
                                
                                <!-- Remember & Forgot Password -->
                                <div class="flex items-center justify-between text-sm">
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="checkbox" class="w-4 h-4 rounded accent-[#6B8E6B]" name="remember">
                                        <span class="text-secondary group-hover:text-[#6B8E6B] transition">Ingat saya</span>
                                    </label>
                                    <a href="#" class="text-[#E76F51] hover:text-[#d45a3b] transition font-medium">Lupa password?</a>
                                </div>
                                
                                <!-- Login Button -->
                                <button 
                                    type="submit"
                                    class="btn-sage w-full py-3 rounded-lg font-semibold text-lg mt-6 transition-all duration-300"
                                >
                                    Masuk ke Kasir
                                </button>
                                
                                <!-- Cancel Button -->
                                <button 
                                    type="button"
                                    class="btn-cancel w-full py-3 rounded-lg font-semibold text-lg transition-all duration-300"
                                >
                                    Batal
                                </button>
                            </form>
                            
                            <!-- Divider -->
                            <div class="divider-line my-6"></div>
                            
                    
                        </div>
                        
                        <!-- Footer -->
                        <div class="text-center mt-6 text-secondary text-sm fade-in" style="animation-delay: 0.2s;">
                            <p>© 2026 POS Restoran. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Add subtle animations on scroll
        document.addEventListener('DOMContentLoaded', function() {
            // Focus input animations
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>
