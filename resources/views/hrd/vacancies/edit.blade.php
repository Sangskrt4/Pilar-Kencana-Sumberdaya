<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Formasi Lowongan — PT Pilar Kencana Sumberdaya</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-slate-900 antialiased overflow-x-hidden flex flex-col min-h-screen">

    <!-- NAVBAR (Seragam Lintas Halaman) -->
    <nav class="sticky top-0 z-40 bg-slate-950/90 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-20">
            <a href="{{ route('hrd.dashboard') }}" class="flex items-center gap-3.5">
                <img src="{{ asset('images/logo-pks.png') }}" alt="Logo PKS" class="h-11 w-11 object-contain rounded-xl bg-white/10 p-1 border border-white/15">
                <div class="flex flex-col">
                    <span class="font-extrabold text-base tracking-tight text-white leading-tight">Pilar Kencana</span>
                    <span class="font-bold text-[11px] tracking-wider text-[#38BDF8] uppercase">HRD Administration</span>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-7 text-xs font-bold uppercase tracking-wider text-slate-300">
                <a href="{{ route('hrd.dashboard') }}" class="hover:text-white transition">Data Pelamar</a>
                <a href="{{ route('hrd.vacancies.index') }}" class="text-white transition">Kelola Lowongan</a>
                <a href="{{ route('karir') }}" class="hover:text-white transition">Halaman Karir</a>
                <a href="{{ route('landing') }}" class="hover:text-white transition">Beranda</a>
            </div>

            <div class="flex items-center gap-4">
                <span class="hidden sm:inline-block text-xs font-semibold text-slate-300 border-r border-white/15 pr-4">
                    {{ Auth::user()->name }}
                </span>
                <form method="POST" action="{{ route('logout') }}" class="m-0 flex items-center">
                    @csrf
                    <button type="submit" class="text-xs font-bold uppercase tracking-wider text-red-400 hover:text-red-300 transition">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- HEADER HALAMAN -->
    <header class="bg-white border-b border-slate-200 py-10 md:py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-900 px-5 py-3.5 rounded-xl text-xs font-semibold">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-end">
                <div class="lg:col-span-8">
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-400 mb-2.5">
                        <a href="{{ route('hrd.vacancies.index') }}" class="hover:text-[#1B6EC2] transition">Kelola Lowongan</a>
                        <span>/</span>
                        <span class="text-[#1B6EC2]">Edit Formasi</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Edit Formasi: {{ $vacancy->title }}
                    </h1>
                    <p class="mt-2 text-xs sm:text-sm text-slate-500 leading-relaxed max-w-2xl">
                        Perbarui detail posisi, jumlah kuota kebutuhan, deskripsi pekerjaan, persyaratan kandidat, serta status pembukaan pendaftaran.
                    </p>
                </div>

                <div class="lg:col-span-4 flex lg:justify-end">
                    <a href="{{ route('hrd.vacancies.index') }}" class="inline-flex items-center gap-2 border border-slate-300 hover:border-slate-900 text-slate-800 text-xs font-bold px-5 py-2.5 rounded-full transition">
                        <span>&larr;</span>
                        <span>Kembali ke Daftar</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT (Layout Editorial 2 Kolom) -->
    <main class="flex-1 py-12 md:py-16 bg-[#F7F8FA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

                <!-- Kolom Kiri: Ringkasan Formasi & Panduan -->
                <aside class="lg:col-span-4 space-y-6">
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs">
                        <p class="text-[11px] font-bold uppercase tracking-widest text-[#1B6EC2] mb-2">Informasi Formasi</p>
                        <h2 class="text-lg font-extrabold text-slate-900 leading-snug">{{ $vacancy->title }}</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Divisi {{ $vacancy->division }}</p>

                        <div class="mt-5 pt-5 border-t border-slate-100 space-y-3 text-xs">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Status Publikasi</span>
                                @if($vacancy->is_open)
                                    <span class="bg-emerald-50 text-emerald-800 border border-emerald-200 font-bold px-2.5 py-0.5 rounded-full">Dibuka</span>
                                @else
                                    <span class="bg-slate-100 text-slate-600 border border-slate-300 font-bold px-2.5 py-0.5 rounded-full">Ditutup</span>
                                @endif
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Kuota Saat Ini</span>
                                <span class="font-bold text-slate-900">{{ $vacancy->quota }} Orang</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Terakhir Diperbarui</span>
                                <span class="font-medium text-slate-700">{{ $vacancy->updated_at ? $vacancy->updated_at->timezone('Asia/Jakarta')->format('d M Y, H:i') . ' WIB' : '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs">
                        <p class="text-xs font-extrabold text-slate-900 uppercase tracking-wider mb-2">Catatan Pengisian</p>
                        <ul class="space-y-2 text-xs text-slate-500 leading-relaxed">
                            <li>&bull; Gunakan poin baris baru pada kolom <strong>Persyaratan</strong> agar mudah dibaca pelamar di halaman Karir.</li>
                            <li>&bull; Nonaktifkan centang pembukaan pendaftaran jika kuota formasi sudah terpenuhi.</li>
                        </ul>
                    </div>
                </aside>

                <!-- Kolom Kanan: Form Edit Lowongan -->
                <div class="lg:col-span-8">
                    <form action="{{ route('hrd.vacancies.update', $vacancy->id) }}" method="POST" class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 md:p-10 shadow-2xs space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="pb-4 border-b border-slate-200">
                            <h2 class="text-base font-extrabold text-slate-900">Detail &amp; Kualifikasi Posisi</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Perubahan akan langsung tampil pada halaman Peluang Karir publik.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nama Posisi / Jabatan *</label>
                                <input type="text" name="title" value="{{ old('title', $vacancy->title) }}" required
                                       class="w-full bg-[#F7F8FA] focus:bg-white border border-slate-300 focus:border-[#1B6EC2] rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none transition">
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Divisi Penempatan *</label>
                                <input type="text" name="division" value="{{ old('division', $vacancy->division) }}" required
                                       class="w-full bg-[#F7F8FA] focus:bg-white border border-slate-300 focus:border-[#1B6EC2] rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none transition">
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Kuota Penerimaan (Orang) *</label>
                                <input type="number" name="quota" value="{{ old('quota', $vacancy->quota) }}" min="1" required
                                       class="w-full bg-[#F7F8FA] focus:bg-white border border-slate-300 focus:border-[#1B6EC2] rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Deskripsi Pekerjaan *</label>
                            <textarea name="description" rows="3" required
                                      class="w-full bg-[#F7F8FA] focus:bg-white border border-slate-300 focus:border-[#1B6EC2] rounded-xl px-4 py-3 text-sm text-slate-900 leading-relaxed focus:outline-none transition">{{ old('description', $vacancy->description) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Kualifikasi &amp; Persyaratan *</label>
                            <textarea name="requirements" rows="5" required
                                      class="w-full bg-[#F7F8FA] focus:bg-white border border-slate-300 focus:border-[#1B6EC2] rounded-xl px-4 py-3 text-sm text-slate-900 leading-relaxed focus:outline-none transition">{{ old('requirements', $vacancy->requirements) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Prospek Karir</label>
                            <textarea name="prospects" rows="3"
                                      class="w-full bg-[#F7F8FA] focus:bg-white border border-slate-300 focus:border-[#1B6EC2] rounded-xl px-4 py-3 text-sm text-slate-900 leading-relaxed focus:outline-none transition">{{ old('prospects', $vacancy->prospects) }}</textarea>
                        </div>

                        <!-- Box Pengaturan Status Pembukaan -->
                        <div class="bg-[#F7F8FA] border border-slate-200 rounded-xl p-4 sm:p-5 flex items-start gap-3.5">
                            <input type="checkbox" name="is_open" id="is_open" value="1" {{ old('is_open', $vacancy->is_open) ? 'checked' : '' }}
                                   class="mt-0.5 w-4 h-4 rounded border-slate-300 text-[#1B6EC2] focus:ring-[#1B6EC2] cursor-pointer">
                            <label for="is_open" class="cursor-pointer">
                                <span class="block text-xs sm:text-sm font-extrabold text-slate-900">Buka Pendaftaran Langsung (Status: Sedang Dibutuhkan)</span>
                                <span class="block text-xs text-slate-500 mt-0.5">Jika dicentang, pelamar dapat langsung mengajukan lamaran pada formasi ini.</span>
                            </label>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="pt-6 border-t border-slate-200 flex flex-wrap items-center justify-end gap-3">
                            <a href="{{ route('hrd.vacancies.index') }}" class="border border-slate-300 hover:border-slate-900 text-slate-800 font-bold px-6 py-3 rounded-full text-xs transition">
                                Batal
                            </a>
                            <button type="submit" class="bg-[#1B6EC2] hover:bg-[#15599E] text-white font-bold px-7 py-3 rounded-full text-xs transition">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>

    <!-- CORPORATE FOOTER (Seragam Lintas Halaman) -->
    <footer class="bg-white border-t border-slate-200 pt-14 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-8 border-b border-slate-200">
                <div class="flex items-center gap-3.5">
                    <img src="{{ asset('images/logo-pks.png') }}" alt="Logo PKS" class="h-11 w-11 object-contain">
                    <div>
                        <p class="font-extrabold text-base text-slate-900 leading-tight">PT Pilar Kencana Sumberdaya</p>
                        <p class="text-xs text-slate-500">Human Resources &amp; Recruitment Administration</p>
                    </div>
                </div>
                <p class="text-xs text-slate-500">Sistem Informasi Manajemen Rekrutmen Internal</p>
            </div>

            <div class="pt-6 flex flex-col sm:flex-row justify-between items-center gap-2 text-[11px] text-slate-400">
                <p>&copy; {{ date('Y') }} PT Pilar Kencana Sumberdaya. All rights reserved.</p>
                <p>Divisi Human Resources &amp; General Affairs</p>
            </div>
        </div>
    </footer>

</body>
</html>