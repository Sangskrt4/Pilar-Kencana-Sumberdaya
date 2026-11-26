<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Formasi Lowongan — PT Pilar Kencana Sumberdaya</title>
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

    <!-- HEADER & RINGKASAN FORMASI -->
    <header class="bg-white border-b border-slate-200 py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-8 bg-emerald-50 border border-emerald-200 text-emerald-900 px-5 py-3.5 rounded-xl text-xs font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 bg-red-50 border border-red-200 text-red-900 px-5 py-3.5 rounded-xl text-xs font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Header 2 Kolom Editorial -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-end pb-10 border-b border-slate-200">
                <div class="lg:col-span-7">
                    <p class="text-xs font-bold uppercase tracking-widest text-[#1B6EC2] mb-2">
                        Manajemen Formasi &amp; Kebutuhan SDM &bull; {{ now()->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                    </p>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Kelola Formasi Lowongan
                    </h1>
                    <p class="mt-2.5 text-sm text-slate-500 font-normal leading-relaxed max-w-2xl">
                        Atur ketersediaan posisi pekerjaan, kuota penerimaan, kualifikasi persyaratan, serta status pembukaan pendaftaran untuk pelamar.
                    </p>
                </div>

                <div class="lg:col-span-5 flex flex-wrap lg:justify-end gap-3">
                    <a href="{{ route('hrd.dashboard') }}" class="inline-flex items-center gap-2 border border-slate-300 hover:border-slate-900 text-slate-800 text-xs font-bold px-5 py-3 rounded-full transition">
                        <span>&larr;</span>
                        <span>Data Pelamar</span>
                    </a>
                    <a href="{{ route('hrd.vacancies.create') }}" class="inline-flex items-center gap-2 bg-[#1B6EC2] hover:bg-[#15599E] text-white text-xs font-bold px-6 py-3 rounded-full transition">
                        <span>+ Buat Lowongan Baru</span>
                    </a>
                </div>
            </div>

            <!-- 3 Angka Ringkasan Formasi -->
            <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-slate-200 pt-10">
                <div class="py-4 md:py-1 md:pr-10">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Formasi</p>
                    <p class="text-4xl sm:text-5xl font-extrabold text-slate-900 mt-2 tracking-tight">
                        {{ $vacancies->count() }} <span class="text-base font-bold text-slate-500">Posisi</span>
                    </p>
                    <p class="text-xs text-slate-500 mt-2">Tercatat dalam database rekrutmen</p>
                </div>

                <div class="py-4 md:py-1 md:px-10">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Status Dibuka</p>
                    <p class="text-4xl sm:text-5xl font-extrabold text-emerald-700 mt-2 tracking-tight">
                        {{ $vacancies->where('is_open', true)->count() }} <span class="text-base font-bold text-slate-500">Aktif</span>
                    </p>
                    <p class="text-xs text-slate-500 mt-2">Dapat dilamar langsung oleh kandidat</p>
                </div>

                <div class="py-4 md:py-1 md:pl-10">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Kebutuhan Kuota</p>
                    <p class="text-4xl sm:text-5xl font-extrabold text-[#1B6EC2] mt-2 tracking-tight">
                        {{ $vacancies->where('is_open', true)->sum('quota') }} <span class="text-base font-bold text-slate-500">Orang</span>
                    </p>
                    <p class="text-xs text-slate-500 mt-2">Akumulasi kuota formasi yang sedang dibuka</p>
                </div>
            </div>

        </div>
    </header>

    <!-- TABEL DAFTAR FORMASI -->
    <main class="flex-1 py-16 md:py-20 bg-[#F7F8FA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pb-6 mb-8 border-b border-slate-200 items-end">
                <div class="lg:col-span-7">
                    <p class="text-xs font-bold uppercase tracking-widest text-[#1B6EC2] mb-1.5">Daftar Posisi Pekerjaan</p>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Seluruh Formasi &amp; Kuota Divisi</h2>
                </div>
                <div class="lg:col-span-5 flex sm:justify-end">
                    <span class="inline-flex items-center bg-white border border-slate-300 text-slate-800 text-xs font-bold px-4 py-2 rounded-full">
                        {{ $vacancies->count() }} Formasi Tersimpan
                    </span>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-2xs">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50/70 text-slate-500 font-bold uppercase tracking-wider">
                                <th class="py-4 px-6">No</th>
                                <th class="py-4 px-6">Posisi / Jabatan</th>
                                <th class="py-4 px-6">Divisi</th>
                                <th class="py-4 px-6">Kuota</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($vacancies as $vacancy)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-4 px-6 text-slate-500">{{ $loop->iteration }}</td>
                                <td class="py-4 px-6">
                                    <p class="font-extrabold text-slate-900 text-sm">{{ $vacancy->title }}</p>
                                    @if($vacancy->requirements)
                                        <p class="text-[11px] text-slate-400 mt-0.5 line-clamp-1 max-w-md">{{ strip_tags($vacancy->requirements) }}</p>
                                    @endif
                                </td>
                                <td class="py-4 px-6 font-semibold text-slate-700">{{ $vacancy->division }}</td>
                                <td class="py-4 px-6 font-bold text-slate-900">{{ $vacancy->quota }} Orang</td>
                                <td class="py-4 px-6">
                                    @if($vacancy->is_open)
                                        <span class="inline-block border border-emerald-300 bg-emerald-50 text-emerald-800 px-3 py-1 text-[11px] font-bold rounded-full">
                                            Dibuka
                                        </span>
                                    @else
                                        <span class="inline-block border border-slate-300 bg-slate-100 text-slate-600 px-3 py-1 text-[11px] font-bold rounded-full">
                                            Ditutup
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="inline-flex items-center justify-end gap-2.5">
                                        <a href="{{ route('hrd.vacancies.edit', $vacancy->id) }}" class="border border-slate-300 hover:border-slate-900 text-slate-800 text-xs font-bold px-4 py-1.5 rounded-full transition">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('hrd.vacancies.destroy', $vacancy->id) }}" onsubmit="return confirm('Yakin mau hapus lowongan ini?');" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border border-red-200 bg-red-50 hover:bg-red-600 text-red-700 hover:text-white text-xs font-bold px-4 py-1.5 rounded-full transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-14 text-slate-500">
                                    Belum ada formasi lowongan yang dibuat. Klik <strong>+ Buat Lowongan Baru</strong> untuk menambahkan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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