<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Sandi - PT Pilar Kencana Sumberdaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-900 text-gray-800 antialiased min-h-screen flex items-center justify-center p-4 py-12 relative overflow-hidden">
    
    <!-- Background Pattern -->
    <div class="absolute inset-0 z-0 opacity-10">
        <img src="{{ asset('images/background.png') }}" class="w-full h-full object-cover" alt="Bg">
    </div>
    
    <!-- Garis Aksen Atas -->
    <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-orange-500 via-yellow-500 to-orange-500 z-10"></div>

    <div class="relative z-20 w-full max-w-md">
        
        <!-- Logo & Brand -->
        <div class="text-center mb-8">
            <a href="{{ route('landing') }}">
                <img src="{{ asset('images/logo-pks.png') }}" alt="Logo PKS" class="h-20 w-auto mx-auto mb-4 object-contain bg-white rounded-full p-1 shadow-lg hover:scale-105 transition">
            </a>
            <h1 class="text-2xl font-extrabold text-white tracking-tight uppercase">Pilar Kencana</h1>
            <p class="text-xs font-bold text-orange-500 tracking-widest uppercase mt-1">Sumberdaya</p>
        </div>

        <!-- Card Lupa Sandi -->
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-200">
            <div class="p-8">
                <div class="mb-6 text-center">
                    <h2 class="text-lg font-bold text-gray-900">Lupa Kata Sandi?</h2>
                    <p class="text-xs text-gray-500 mt-2 leading-relaxed">
                        Masukkan alamat email yang terdaftar. Kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
                    </p>
                </div>

                <!-- Session Status (Pesan Sukses) -->
                @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-green-600 bg-green-50 p-3 rounded-md border border-green-200">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Alamat Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                            class="w-full border-gray-300 rounded-md p-3 text-sm focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200"
                            placeholder="nama@email.com">
                        @error('email')
                            <p class="text-xs text-red-500 mt-2 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Button Submit -->
                    <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3.5 px-4 rounded-md shadow-md transition duration-300 uppercase tracking-widest text-xs mt-2">
                        Kirim Link Reset
                    </button>
                </form>
            </div>
            
            <!-- Footer Card (Kembali ke Login) -->
            <div class="bg-gray-50 p-6 text-center border-t border-gray-200">
                <p class="text-xs text-gray-600">
                    Ingat kata sandi Anda? 
                    <a href="{{ route('login') }}" class="font-bold text-orange-600 hover:text-orange-700 hover:underline transition">
                        Kembali ke Login
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer Copyright -->
        <div class="text-center mt-8">
            <p class="text-[10px] text-gray-500 font-medium tracking-wide">&copy; {{ date('Y') }} PT Pilar Kencana Sumberdaya. All rights reserved.</p>
        </div>

    </div>
</body>
</html>