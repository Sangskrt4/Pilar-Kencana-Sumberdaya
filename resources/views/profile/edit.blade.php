<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - PT Pilar Kencana Sumberdaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-50 text-gray-800 antialiased">

    <!-- Navbar -->
    <nav class="bg-slate-900 border-b-4 border-orange-500 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-20">
            <div class="flex items-center gap-4">
                <a href="{{ route('landing') }}">
                    <img src="{{ asset('images/logo-pks.png') }}" alt="Logo PKS" class="h-12 w-auto object-contain bg-white rounded-full p-0.5">
                </a>
                <div class="flex flex-col border-l border-slate-700 pl-4">
                    <span class="font-extrabold text-base tracking-wide text-white uppercase leading-tight">Pilar Kencana</span>
                    <span class="font-bold text-[10px] tracking-widest text-orange-500 uppercase mt-0.5">Sumberdaya</span>
                </div>
            </div>
            
            <div class="flex items-center gap-6">
                <a href="{{ route('dashboard') }}" class="text-xs font-bold text-slate-300 hover:text-white uppercase tracking-widest transition">Dashboard</a>
                <a href="{{ route('landing') }}" class="text-xs font-bold text-slate-300 hover:text-white uppercase tracking-widest transition">Beranda</a>
                
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="text-xs font-bold text-white bg-slate-800 hover:bg-red-600 border border-slate-700 px-5 py-2.5 rounded transition uppercase tracking-widest">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="mb-10 border-l-4 border-orange-500 pl-6">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Pengaturan Profil</h1>
            <p class="text-slate-500 mt-2 text-sm font-medium">Perbarui informasi akun dan keamanan Anda di sini.</p>
        </div>

        <div class="space-y-8">
            <!-- Form Update Info Profil -->
            <div class="bg-white border border-slate-200 p-8 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-1">Informasi Profil</h2>
                <p class="text-xs text-slate-500 mb-6">Perbarui nama dan alamat email akun Anda.</p>
                
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('patch')
                    
                    <div>
                        <label for="name" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Nama Lengkap</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required 
                            class="w-full border-gray-300 rounded-md p-3 text-sm focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200">
                        @error('name') <p class="text-xs text-red-500 mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Alamat Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required 
                            class="w-full border-gray-300 rounded-md p-3 text-sm focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200">
                        @error('email') <p class="text-xs text-red-500 mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-6 py-3 rounded transition uppercase tracking-widest">
                            Simpan Perubahan
                        </button>

                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-xs text-green-600 font-bold">
                                Berhasil disimpan.
                            </p>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Form Update Password -->
            <div class="bg-white border border-slate-200 p-8 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-1">Perbarui Kata Sandi</h2>
                <p class="text-xs text-slate-500 mb-6">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                
                <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    @method('put')

                    <div>
                        <label for="current_password" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Sandi Saat Ini</label>
                        <input id="current_password" name="current_password" type="password" required 
                            class="w-full border-gray-300 rounded-md p-3 text-sm focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200">
                        @error('current_password', 'updatePassword') <p class="text-xs text-red-500 mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Sandi Baru</label>
                        <input id="password" name="password" type="password" required 
                            class="w-full border-gray-300 rounded-md p-3 text-sm focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200">
                        @error('password', 'updatePassword') <p class="text-xs text-red-500 mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Konfirmasi Sandi Baru</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                            class="w-full border-gray-300 rounded-md p-3 text-sm focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200">
                        @error('password_confirmation', 'updatePassword') <p class="text-xs text-red-500 mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-6 py-3 rounded transition uppercase tracking-widest">
                            Simpan Sandi
                        </button>

                        @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-xs text-green-600 font-bold">
                                Sandi berhasil diperbarui.
                            </p>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Form Hapus Akun -->
            <div class="bg-red-50 border border-red-200 p-8 shadow-sm">
                <h2 class="text-lg font-bold text-red-700 mb-1">Hapus Akun</h2>
                <p class="text-xs text-red-600 mb-6 leading-relaxed">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun, harap unduh data atau informasi apa pun yang ingin Anda simpan.</p>
                
                <form method="POST" action="{{ route('profile.destroy') }}" class="m-0">
                    @csrf
                    @method('delete')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-6 py-3 rounded transition uppercase tracking-widest shadow-md">
                        Hapus Akun Permanen
                    </button>
                </form>
            </div>
        </div>
    </main>

    <footer class="border-t border-slate-200 mt-12 py-8 text-center bg-white">
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">&copy; {{ date('Y') }} PT Pilar Kencana Sumberdaya. Internal System.</p>
    </footer>

</body>
</html>