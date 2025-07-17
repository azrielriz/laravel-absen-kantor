<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Web Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
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
                <!-- Ilustrasi -->
                <div class="md:w-1/2 bg-gradient-to-br from-blue-500 to-indigo-600 p-8 hidden md:block">
                    <div class="flex flex-col items-center justify-center h-full">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/c50ad190-b456-485b-b125-1ccd29ddb711.png" class="w-full h-auto rounded-lg mb-6" />
                        <h2 class="text-2xl font-bold text-white mb-2">Web Absensi</h2>
                        <p class="text-white text-opacity-90 text-center">Silakan masuk ke akun untuk mencatat kehadiran, melihat riwayat absensi, dan mengakses informasi terkait kehadiran kerja.</p>
                    </div>
                </div>

                <!-- Form Login -->
                <div class="md:w-1/2 p-8">
                    <div class="flex justify-center mb-8">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/3c318f04-e6dd-42b8-a727-7ff3a790f512.png" class="h-12" />
                    </div>

                    <h2 class="text-xl font-semibold text-gray-700 mb-6 text-center">Login ke Akun Anda</h2>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" placeholder="you@example.com" required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div class="mb-6">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="password" id="password" name="password" placeholder="••••••••" required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div class="flex items-center justify-between mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                                <span class="ml-2 text-sm text-gray-700">Remember me</span>
                            </label>
                            <a href="#" class="text-sm text-blue-600 hover:text-blue-500">Forgot password?</a>
                        </div>
                        <button type="submit"
                                class="w-full py-2 px-4 rounded-lg font-medium transition duration-200 bg-blue-600 text-white hover:bg-blue-700">
                            Login
                        </button>
                    </form>

                    <div class="mt-8 text-center text-sm text-gray-500">
                        <p>© 2025 deltagrup.id. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
