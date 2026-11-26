<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - PT Pilar Kencana Sumberdaya</title>
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

        <!-- Card Verifikasi Email -->
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-200">
            <div class="p-8">
                <div class="mb-6 text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">Verifikasi Email Anda</h2>
                    <p class="text-xs text-gray-500 mt-2 leading-relaxed">
                        Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda. Jika Anda tidak menerimanya, kami akan dengan senang hati mengirimkan ulang.
                    </p>
                </div>

                <!-- Session Status -->
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 text-sm font-medium text-green-700 bg-green-50 p-3 rounded-md border border-green-200 text-center">
                        Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
                    </div>
                @endif

                <div class="space-y-4">
                    <!-- Tombol Kirim Ulang -->
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3.5 px-4 rounded-md shadow-md transition duration-300 uppercase tracking-widest text-xs">
                            Kirim Ulang Email Verifikasi
                        </button>
                    </form>

                    <!-- Tombol Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3.5 px-4 rounded-md transition duration-300 uppercase tracking-widest text-xs border border-gray-300">
                            Keluar (Log Out)
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer Copyright -->
        <div class="text-center mt-8">
            <p class="text-[10px] text-gray-500 font-medium tracking-wide">&copy; {{ date('Y') }} PT Pilar Kencana Sumberdaya. All rights reserved.</p>
        </div>

    </div>
</body>
</html>