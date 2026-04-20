<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Agent Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
        }

        body {
            background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1920&h=1080&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            padding-left: 63%;
            margin: 0;
        }

        .login-container {
            background: #ffffff;
            backdrop-filter: none;
            border: none;
            border-radius: 20px;
            padding: 40px;
            width: 400px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
            animation: slideInFromLeft 0.6s ease-out;
        }

        @keyframes slideInFromLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .brand {
            text-align: center;
            margin-bottom: 10px;
        }

        .brand-main {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            letter-spacing: 2px;
            margin-bottom: 4px;
        }

        .brand-sub {
            font-size: 12px;
            color: #666;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .login-title {
            font-size: 24px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .login-subtitle {
            font-size: 14px;
            color: #777;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
            color: #1a1a1a;
            font-size: 14px;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input::placeholder {
            color: #aaa;
        }

        .form-input:focus {
            background: #ffffff;
            border-color: #666;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 25px;
        }

        .forgot-password a {
            font-size: 13px;
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #1a1a1a;
        }

        .login-button {
            width: 100%;
            padding: 13px;
            background: #1a1a1a;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .login-button:hover {
            background: #333;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .signup-text {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #666;
        }

        .signup-text a {
            color: #1a1a1a;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .signup-text a:hover {
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .error-message {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #c53030;
            animation: slideDown 0.3s ease-out;
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

        @media (max-width: 640px) {
            body {
                padding-left: 20px;
                padding-right: 20px;
                justify-content: center;
                padding: 20px;
            }

            .login-container {
                width: 100%;
                max-width: 380px;
                padding: 30px;
            }

            .brand-main {
                font-size: 24px;
            }

            .login-title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="brand">
            <div class="brand-main">HORIZON</div>
            <div class="brand-sub">RESTAURANT</div>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="error-message">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('proses-login') ?>" method="post">
            <div class="form-group">
                <label class="form-label">Username</label>
                <input 
                    type="text" 
                    name="username" 
                    class="form-input" 
                    placeholder="Enter your username"
                    required
                    autocomplete="off"
                >
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-input" 
                    placeholder="Enter your password"
                    required
                    id="password"
                >
            </div>

         

            <button type="submit" class="login-button">Masuk</button>
        </form>

    </div>

    <script>
        // Prevent zoom on mouse wheel
        document.addEventListener('wheel', function(e) {
            if (e.ctrlKey) {
                e.preventDefault();
            }
        }, { passive: false });

        // Prevent keyboard zoom shortcuts
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && (e.key === '+' || e.key === '-' || e.key === '=' || e.key === '0')) {
                e.preventDefault();
            }
        });

        // Prevent pinch zoom
        document.addEventListener('touchmove', function(e) {
            if (e.touches.length > 1) {
                e.preventDefault();
            }
        }, { passive: false });
    </script>
</body>
</html>
