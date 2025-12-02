<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .brown-bg {
            background: linear-gradient(to bottom right, #f4ede6, #e9dfd6);
        }
        .brown-card {
            background: #ffffff;
            border: 1px solid #d9c5b8;
        }
        .brown-btn {
            background: #6b3a24;
        }
        .brown-btn:hover {
            background: #8b4b30;
        }
        .brown-text {
            color: #6b3a24;
        }
        .brown-link {
            color: #8b4b30;
        }
        .brown-link:hover {
            color: #6b3a24;
        }

        /* Fade + Slide animation */
        .fade-slide {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeSlideIn 0.8s ease-out forwards;
        }

        @keyframes fadeSlideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

<body class="brown-bg min-h-screen flex items-center justify-center px-4">

    <div class="max-w-md w-full space-y-6 fade-slide">

        <!-- LOGO -->
        <div class="flex justify-center fade">
            <img src="{{ asset('img/logo.png') }}" alt="Logo UMKM" class="w-20 h-20 object-contain drop-shadow">
        </div>

        <!-- Title -->
        <div>
            <h2 class="text-center text-3xl font-bold brown-text fade">
                Sistem Informasi UMKM
            </h2>
            <p class="mt-2 text-center text-sm text-gray-700 fade">
                Silakan login untuk melanjutkan
            </p>
        </div>

        <!-- Alert success -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded fade">
                {{ session('success') }}
            </div>
        @endif

        <!-- Alert errors -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded fade">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card -->
        <form class="mt-2 space-y-6 brown-card p-8 rounded-lg shadow-lg fade-slide" method="POST" action="{{ route('login.post') }}">
            @csrf
            
            <div class="space-y-4">

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium brown-text">
                        Email
                    </label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        value="{{ old('email') }}"
                        required 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-[#8b4b30] focus:border-[#8b4b30]"
                        placeholder="admin@umkm.com"
                    >
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium brown-text">
                        Password
                    </label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        required 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-[#8b4b30] focus:border-[#8b4b30]"
                        placeholder="••••••••"
                    >
                </div>

                <!-- Remember -->
                <div class="flex items-center">
                    <input 
                        id="remember" 
                        name="remember" 
                        type="checkbox" 
                        class="h-4 w-4 text-[#8b4b30] focus:ring-[#8b4b30] border-gray-300 rounded"
                    >
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        Ingat saya
                    </label>
                </div>
            </div>

            <!-- Button -->
            <div>
                <button 
                    type="submit" 
                    class="w-full flex justify-center py-2 px-4 rounded-md shadow-sm 
                    text-sm font-medium text-white brown-btn 
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#6b3a24]"
                >
                    Login
                </button>
            </div>

            <!-- Back link -->
            <div class="text-center text-sm">
                <a href="{{ route('home') }}" class="font-medium brown-link">
                    Kembali ke halaman utama
                </a>
            </div>

        </form>

        <!-- Demo accounts -->
        <div class="text-center text-xs text-gray-600 fade">
            <p>Demo: admin1@gmail.com / admin123</p>
            <p>Demo: operator1@gmail.com / operator123</p>
        </div>

    </div>

</body>
</html>
