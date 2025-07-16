<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Portal - Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .auth-tab.active {
            @apply bg-blue-600 text-white;
        }
        .auth-form {
            transition: all 0.3s ease;
        }
        .form-input {
            @apply w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent;
        }
        .auth-btn {
            @apply w-full py-2 px-4 rounded-lg font-medium transition duration-200;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="w-full max-w-4xl mx-auto p-6">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="md:flex">
                <!-- Auth Illustration -->
                <div class="md:w-1/2 bg-gradient-to-br from-blue-500 to-indigo-600 p-8 hidden md:block">
                    <div class="flex flex-col items-center justify-center h-full">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/c50ad190-b456-485b-b125-1ccd29ddb711.png" alt="Digital interface showing login screen with floating authentication elements and abstract geometric patterns in blue and purple hues" class="w-full h-auto rounded-lg mb-6" />
                        <h2 class="text-2xl font-bold text-white mb-2">Web Absensi</h2>
                        <p class="text-white text-opacity-90 text-center">Silakan masuk ke akun untuk mencatat kehadiran, melihat riwayat absensi, dan mengakses informasi terkait kehadiran kerja.</p>
                    </div>
                </div>
                
                <!-- Auth Content -->
                <div class="md:w-1/2 p-8">
                    <div class="flex justify-center mb-8">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/3c318f04-e6dd-42b8-a727-7ff3a790f512.png" alt="Company logo in dark blue with modern typography representing technology solutions" class="h-12" />
                    </div>
                    
                    <!-- Tab Navigation -->
                    <div class="flex mb-8 rounded-full bg-gray-100 p-1">
                        <button id="login-tab" class="auth-tab active flex-1 py-2 px-4 rounded-full font-medium">Login</button>
                        <button id="register-tab" class="auth-tab flex-1 py-2 px-4 rounded-full font-medium">Register</button>
                    </div>
                    
                    <!-- Login Form -->
                    <form id="login-form" class="auth-form" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="login-email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" id="login-email" name="email" class="form-input" placeholder="your@email.com" required>
                        </div>
                        <div class="mb-6">
                            <label for="login-password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="password" id="login-password" name="password" class="form-input" placeholder="••••••••" required>
                        </div>
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                            </div>
                            <a href="#" class="text-sm text-blue-600 hover:text-blue-500">Forgot password?</a>
                        </div>
                        <button type="submit" class="btn-blue">Sign In</button>
                        
                        <div class="relative my-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Jika Belum ada akun, silahkan Register</span>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Register Form -->
                    <form id="register-form" class="auth-form hidden" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="register-name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" id="register-name" name="name" class="form-input" placeholder="Arraya Bey" required>
                        </div>
                        <div class="mb-4">
                            <label for="register-email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" id="register-email" name="email" class="form-input" placeholder="your@email.com" required>
                        </div>
                        <div class="mb-4">
                            <label for="register-password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="password" id="register-password" name="password" class="form-input" placeholder="••••••••" required>
                        </div>
                        <div class="mb-6">
                            <label for="register-password-confirm" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <input type="password" id="register-password-confirm" name="password_confirmation" class="form-input" placeholder="••••••••" required>
                        </div>
                        <div class="mb-6">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" id="terms" name="terms" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="terms" class="text-gray-700">I agree to the <a href="#" class="text-blue-600 hover:text-blue-500">Terms of Service</a> and <a href="#" class="text-blue-600 hover:text-blue-500">Privacy Policy</a></label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="auth-btn bg-green-700 text-white hover:bg-green-800">Create Account</button>
                    </form>
                    
                    <!-- Footer -->
                    <div class="mt-8 text-center text-sm text-gray-500">
                        <p>© 2025 deltagrup.id. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching functionality
            const loginTab = document.getElementById('login-tab');
            const registerTab = document.getElementById('register-tab');
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            
            loginTab.addEventListener('click', function() {
                this.classList.add('active');
                registerTab.classList.remove('active');
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
            });
            
            registerTab.addEventListener('click', function() {
                this.classList.add('active');
                loginTab.classList.remove('active');
                registerForm.classList.remove('hidden');
                loginForm.classList.add('hidden');
            });
            
            // Form validation could be added here
            // Example: validate password strength on registration
            const registerPassword = document.getElementById('register-password');
            registerPassword.addEventListener('input', function() {
                const strength = calculatePasswordStrength(this.value);
                // Update UI based on strength
            });
            
            function calculatePasswordStrength(password) {
                // Implement password strength logic
                return 0;
            }
        });
    </script>
</body>
</html>

