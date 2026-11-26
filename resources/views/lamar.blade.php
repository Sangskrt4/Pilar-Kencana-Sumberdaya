<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lamaran - {{ $job->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-gray-100 antialiased">

    <!-- Navbar Sederhana -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('karir') }}" class="text-gray-600 hover:text-blue-600 font-semibold text-sm flex items-center gap-2">
                &larr; Kembali ke Karir
            </a>
            <div class="text-sm font-bold text-gray-800">Halo, {{ Auth::user()->name }}</div>
        </div>
    </nav>

    <!-- Form Lamaran -->
    <div class="max-w-3xl mx-auto mt-10 bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
        <div class="bg-slate-800 p-6 text-white border-b-4 border-orange-500">
            <p class="text-xs text-orange-400 font-bold uppercase tracking-widest mb-1">Formulir Lamaran</p>
            <h1 class="text-2xl font-bold">{{ $job->title }}</h1>
        </div>

        <form action="#" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            
            <!-- Input Biodata -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" value="{{ Auth::user()->name }}" class="w-full border border-gray-300 rounded-md p-3 bg-gray-50 text-gray-500 cursor-not-allowed" readonly>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                    <input type="email" value="{{ Auth::user()->email }}" class="w-full border border-gray-300 rounded-md p-3 bg-gray-50 text-gray-500 cursor-not-allowed" readonly>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">NIK (Nomor Induk Karyawan)</label>
                    <input type="text" name="nik" placeholder="Masukkan NIK Anda" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
                    <input type="text" name="phone" placeholder="Contoh: 08123456789" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Domisili</label>
                <textarea name="address" rows="3" placeholder="Masukkan alamat lengkap" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>

            <div class="border-t border-gray-200 pt-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Upload CV / Resume (PDF)</label>
                <input type="file" name="cv" accept=".pdf" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                <p class="text-xs text-gray-400 mt-2">*Maksimal ukuran file 2MB.</p>
            </div>

            <!-- Tombol Submit -->
            <div class="pt-6 border-t border-gray-200 flex justify-end">
                <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-8 rounded-md shadow-md transition uppercase tracking-wider text-sm">
                    Kirim Lamaran
                </button>
            </div>
        </form>
    </div>

    <div class="h-20"></div>
</body>
</html>