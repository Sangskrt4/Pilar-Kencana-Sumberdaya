<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login HRD - PT Pilar Kencana Sumberdaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-900 text-gray-800 antialiased min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    
    <div class="absolute inset-0 z-0 opacity-10">
        <img src="{{ asset('images/background.png') }}" class="w-full h-full object-cover" alt="Bg">
    </div>
    <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-orange-500 via-yellow-500 to-orange-500 z-10"></div>

    <div class="relative z-20 w-full max-w-md">
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo-pks.png') }}" alt="Logo PKS" class="h-20 w-auto mx-auto mb-4 object-contain bg-white rounded-full p-1 shadow-lg">
            <h1 class="text-2xl font-extrabold text-white tracking-tight uppercase">Pilar Kencana</h1>
            <p class="text-xs font-bold text-orange-500 tracking-widest uppercase mt-1">Portal Admin</p>
        </div>

        <div class="bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-200">
            <div class="p-8">
                <div class="mb-6 text-center">
                    <h2 class="text-lg font-bold text-gray-900">Login Khusus HRD</h2>
                    <p class="text-xs text-gray-500 mt-1">Otorisasi personil internal perusahaan.</p>
                </div>

                @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-green-600 bg-green-50 p-3 rounded-md border border-green-200">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Email Korporat</label>
                        <input id="email" type="email" name="email" required autofocus class="w-full border-gray-300 rounded-md p-3 text-sm focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200" placeholder="hrd@pks.co.id">
                        @error('email') <p class="text-xs text-red-500 mt-2 font-semibold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Kata Sandi</label>
                        <input id="password" type="password" name="password" required class="w-full border-gray-300 rounded-md p-3 text-sm focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200" placeholder="••••••••">
                        @error('password') <p class="text-xs text-red-500 mt-2 font-semibold">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3.5 px-4 rounded-md shadow-md transition duration-300 uppercase tracking-widest text-xs mt-2">
                        Masuk Sistem
                    </button>
                </form>
            </div>
            <div class="bg-gray-50 p-6 text-center border-t border-gray-200">
                <p class="text-xs text-gray-600">
                    Pelamar? <a href="{{ route('login') }}" class="font-bold text-orange-600 hover:text-orange-700 hover:underline transition">Login di sini</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>