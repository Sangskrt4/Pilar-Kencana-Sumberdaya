<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Portal - PT Pilar Kencana Sumberdaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-900 text-gray-800 antialiased min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    
    <!-- Background Pattern / Overlay Tipis -->
    <div class="absolute inset-0 z-0 opacity-10">
        <img src="{{ asset('images/background.png') }}" class="w-full h-full object-cover" alt="Bg">
    </div>
    
    <!-- Garis Aksen Atas -->
    <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-orange-500 via-yellow-500 to-orange-500 z-10"></div>

    <div class="relative z-20 w-full max-w-md">
        
        <!-- Logo & Brand -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo-pks.png') }}" alt="Logo PKS" class="h-20 w-auto mx-auto mb-4 object-contain bg-white rounded-full p-1 shadow-lg">
            <h1 class="text-2xl font-extrabold text-white tracking-tight uppercase">Pilar Kencana</h1>
            <p class="text-xs font-bold text-orange-500 tracking-widest uppercase mt-1">Sumberdaya</p>
        </div>

        <!-- Card Login -->
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-200">
            <div class="p-8">
                <div class="mb-6 text-center">
                    <h2 class="text-lg font-bold text-gray-900">Portal Pelamar</h2>
                    <p class="text-xs text-gray-500 mt-1">Silakan masuk menggunakan akun Anda.</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-green-600 bg-green-50 p-3 rounded-md border border-green-200">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- autocomplete="off" biar browser gak nyimpen riwayat -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5" autocomplete="off">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Alamat Email</label>
                        <input id="email" type="email" name="email" value="" required autofocus autocomplete="off" 
                            class="w-full border-gray-300 rounded-md p-3 text-sm focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200"
                            placeholder="nama@email.com">
                        @error('email')
                            <p class="text-xs text-red-500 mt-2 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password (Dengan Ikon Mata) -->
                    <div>
                        <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Kata Sandi</label>
                        
                        <div class="relative">
                            <input id="password" type="password" name="password" required autocomplete="new-password" 
                                class="w-full border-gray-300 rounded-md p-3 pr-10 text-sm focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200"
                                placeholder="••••••••">
                            
                            <!-- Tombol Ikon Mata -->
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-orange-500 focus:outline-none transition-colors">
                                <!-- Ikon Mata Tertutup (Default) -->
                                <svg id="eye-closed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                </svg>
                                
                                <!-- Ikon Mata Terbuka (Tersembunyi dulu) -->
                                <svg id="eye-open" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        @error('password')
                            <p class="text-xs text-red-500 mt-2 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lupa Password (Remember Me dihapus) -->
                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-slate-600 hover:text-orange-600 font-bold transition">
                                Lupa Sandi?
                            </a>
                        @endif
                    </div>

                    <!-- Button Submit -->
                    <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3.5 px-4 rounded-md shadow-md transition duration-300 uppercase tracking-widest text-xs mt-2">
                        Masuk
                    </button>
                </form>
            </div>
            
            <!-- Footer Card (Register Link) -->
            <div class="bg-gray-50 p-6 text-center border-t border-gray-200">
                <p class="text-xs text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-bold text-orange-600 hover:text-orange-700 hover:underline transition">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer Copyright -->
        <div class="text-center mt-8">
            <p class="text-[10px] text-gray-500 font-medium tracking-wide">&copy; {{ date('Y') }} PT Pilar Kencana Sumberdaya. All rights reserved.</p>
        </div>

    </div>

    <!-- Script Toggle Password -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeClosed = document.getElementById('eye-closed');
            const eyeOpen = document.getElementById('eye-open');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeClosed.classList.add('hidden');
                eyeOpen.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeClosed.classList.remove('hidden');
                eyeOpen.classList.add('hidden');
            }
        }
    </script>
</body>
</html>