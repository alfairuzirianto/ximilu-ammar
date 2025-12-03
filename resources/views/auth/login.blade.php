<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Background cream / putih lembut */
        .cream-bg {
            background: linear-gradient(to bottom right, #f5eee7, #efe7df);
        }

        /* Card glass */
        .glass-card {
            backdrop-filter: blur(14px);
            background: rgba(255, 255, 255, 0.55);
            border: 1px solid rgba(180, 160, 140, 0.35);
        }

        .brown-btn {
            background: #9e715d;
        }
        .brown-btn:hover {
            background: #b18470;
        }

        .fade-slide {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeSlideIn 0.8s ease-out forwards;
        }
        @keyframes fadeSlideIn {
            to { opacity: 1; transform: translateY(0); }
        }

        .fade {
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
        }
        @keyframes fadeIn {
            to { opacity: 1; }
        }
    </style>
</head>

<body class="cream-bg min-h-screen flex items-center justify-center px-4">

    <div class="max-w-md w-full space-y-6 fade-slide">

        <!-- LOGO -->
        <div class="flex justify-center fade">
            <div class="p-4 rounded-full glass-card shadow-lg">
                <img src="{{ asset('img/logo.png') }}" alt="Logo UMKM" class="w-20 h-20 object-contain">
            </div>
        </div>

        <!-- Title -->
        <div>
            <h2 class="text-center text-3xl font-bold text-[#5b392c] fade">
                Sistem Informasi UMKM
            </h2>
            <p class="mt-2 text-center text-sm text-gray-700 fade">
                Silakan login untuk melanjutkan
            </p>
        </div>

        <!-- Alert success -->
        @if(session('success'))
            <div class="glass-card text-green-700 px-4 py-3 rounded fade">
                {{ session('success') }}
            </div>
        @endif

        <!-- Alert errors -->
        @if($errors->any())
            <div class="glass-card text-red-700 px-4 py-3 rounded fade">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login Card -->
        <form class="mt-2 space-y-6 glass-card p-8 rounded-2xl shadow-xl fade-slide" 
              method="POST" action="{{ route('login.post') }}">

            @csrf

            <div class="space-y-4">

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-[#5b392c]">
                        Email
                    </label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        value="{{ old('email') }}"
                        required 
                        class="mt-1 block w-full px-3 py-2 rounded-lg bg-white text-[#4a3328]
                               border border-[#d5c4b8] focus:outline-none 
                               focus:ring-[#9e715d] focus:border-[#9e715d]"
                        placeholder="admin@umkm.com"
                    >
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-[#5b392c]">
                        Password
                    </label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        required 
                        class="mt-1 block w-full px-3 py-2 rounded-lg bg-white text-[#4a3328]
                               border border-[#d5c4b8] focus:outline-none 
                               focus:ring-[#9e715d] focus:border-[#9e715d]"
                        placeholder="••••••••"
                    >
                </div>

                <!-- Remember -->
                <div class="flex items-center">
                    <input 
                        id="remember" 
                        name="remember" 
                        type="checkbox" 
                        class="h-4 w-4 text-[#9e715d] border-[#c4b6a7] rounded"
                    >
                    <label for="remember" class="ml-2 block text-sm text-[#5b392c]">
                        Ingat saya
                    </label>
                </div>
            </div>

            <!-- Button -->
            <div>
                <button 
                    type="submit" 
                    class="w-full flex justify-center py-2 px-4 rounded-lg shadow-sm 
                    text-sm font-medium text-white brown-btn focus:outline-none 
                    focus:ring-2 focus:ring-offset-2 focus:ring-[#9e715d]"
                >
                    Login
                </button>
            </div>

            <!-- Back link -->
            <div class="text-center text-sm">
                <a href="{{ route('home') }}" class="text-[#8b6b5a] hover:text-[#5b392c] font-medium">
                    Kembali ke halaman utama
                </a>
            </div>

        </form>

        <!-- DEMO ACCOUNTS -->
        <div class="fade mt-4">

            <div class="text-center text-sm font-semibold mb-3 flex items-center justify-center text-[#8b6b5a]">
                <iconify-icon icon="solar:user-id-bold-duotone" style="font-size:18px; margin-right:6px;"></iconify-icon>
                Demo Accounts
            </div>

            <!-- ADMIN -->
            <div class="flex justify-between items-center px-4 py-3 mb-3 rounded-xl cursor-pointer glass-card"
                 onclick="fillDemo('admin1@gmail.com', 'admin123')">

                <div>
                    <div class="text-[#4a3328] font-semibold text-sm">Administrator</div>
                    <div class="text-[#8b6b5a] text-xs">admin1@gmail.com</div>
                </div>

                <div class="px-3 py-1 rounded-md text-xs font-bold text-white"
                     style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                    ADMIN
                </div>
            </div>

            <!-- OPERATOR -->
            <div class="flex justify-between items-center px-4 py-3 rounded-xl cursor-pointer glass-card"
                 onclick="fillDemo('operator1@gmail.com', 'operator123')">

                <div>
                    <div class="text-[#4a3328] font-semibold text-sm">Operator</div>
                    <div class="text-[#8b6b5a] text-xs">operator1@gmail.com</div>
                </div>

                <div class="px-3 py-1 rounded-md text-xs font-bold text-white"
                     style="background: linear-gradient(135deg, #10b981, #14b8a6);">
                    STAFF
                </div>
            </div>

        </div>

    </div>


    <!-- SCRIPTS -->
    <script>
        function fillDemo(email, password) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;

            // animasi fokus
            document.getElementById('email').focus();
            setTimeout(() => document.getElementById('password').focus(), 150);
        }
    </script>

</body>
</html>
