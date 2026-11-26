<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Pilar Kencana Sumberdaya — Energi &amp; Pertambangan Batubara</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        .marquee-container {
            overflow: hidden;
            white-space: nowrap;
            position: relative;
        }
        .marquee-content {
            display: inline-flex;
            animation: marquee 32s linear infinite;
        }
        .marquee-content:hover {
            animation-play-state: paused;
        }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
    </style>
</head>
<body class="bg-white text-slate-900 antialiased overflow-x-hidden">

    <!-- NAVBAR (Ukuran Seragam Lintas Halaman) -->
    <nav class="fixed w-full top-0 z-50 bg-slate-950/75 backdrop-blur-md border-b border-white/10 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-20">
            <a href="{{ route('landing') }}" class="flex items-center gap-3.5">
                <img src="{{ asset('images/logo-pks.png') }}" alt="Logo PKS" class="h-11 w-11 object-contain rounded-xl bg-white/10 p-1 border border-white/15">
                <div class="flex flex-col">
                    <span class="font-extrabold text-base tracking-tight text-white leading-tight">Pilar Kencana</span>
                    <span class="font-bold text-[11px] tracking-wider text-[#38BDF8] uppercase">Sumberdaya</span>
                </div>
            </a>

            <div class="hidden lg:flex items-center gap-7 text-xs font-bold uppercase tracking-wider text-slate-300">
                <a href="#tentang" class="hover:text-white transition">Tentang Kami</a>
                <a href="#kapasitas" class="hover:text-white transition">Kapasitas</a>
                <a href="#operasi" class="hover:text-white transition">Area Operasi</a>
                <a href="#keberlanjutan" class="hover:text-white transition">Keberlanjutan</a>
            </div>

            <div class="flex items-center gap-5 md:gap-6">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-xs font-bold uppercase tracking-wider text-slate-200 hover:text-white transition">Dashboard</a>
                    <a href="{{ route('karir') }}" class="text-xs font-bold uppercase tracking-wider text-slate-200 hover:text-white transition">Karir</a>
                    <form method="POST" action="{{ route('logout') }}" class="m-0 flex items-center">
                        @csrf
                        <button type="submit" class="text-xs font-bold uppercase tracking-wider text-red-400 hover:text-red-300 transition">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-bold uppercase tracking-wider text-slate-200 hover:text-white transition">Masuk</a>
                    <a href="{{ route('register') }}" class="text-xs font-bold uppercase tracking-wider text-white bg-[#1B6EC2] hover:bg-[#15599E] px-4 py-2.5 rounded-lg transition">Daftar Akun</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- 1. HERO SECTION (100% Full Screen h-screen) -->
    <header class="relative h-screen min-h-[600px] flex items-center overflow-hidden bg-slate-950">
        <div class="absolute inset-0 z-0">
            <video autoplay loop muted playsinline poster="{{ asset('images/background.png') }}" class="w-full h-full object-cover object-center">
                <source src="{{ asset('images/video-background.mp4') }}" type="video/mp4">
                <img src="{{ asset('images/background.png') }}" alt="Operasi Tambang PKS" class="w-full h-full object-cover object-center">
            </video>
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/55 to-slate-950/20"></div>
        </div>

        <div class="relative z-20 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-16">
            <div class="max-w-2xl">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#38BDF8] mb-4">
                    PT Pilar Kencana Sumberdaya
                </p>
                <h1 class="text-3xl sm:text-5xl md:text-[3.25rem] font-extrabold text-white tracking-tight leading-[1.15]">
                    Membangun Negeri Melalui Energi &amp; Sumber Daya
                </h1>
                <p class="mt-5 text-sm sm:text-base md:text-lg text-slate-200 leading-relaxed font-light max-w-xl">
                    Beroperasi dengan standar internasional dalam eksplorasi dan produksi batubara premium untuk ketahanan energi nasional maupun pasar global.
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-3.5">
                    <a href="#tentang" class="inline-flex items-center gap-2.5 bg-white text-slate-950 hover:bg-slate-100 text-xs font-bold px-6 py-3.5 rounded-full transition">
                        <span>Selengkapnya</span>
                        <span>&rarr;</span>
                    </a>
                    <a href="{{ route('karir') }}" class="inline-flex items-center gap-2 border border-white/40 hover:border-white text-white text-xs font-bold px-6 py-3.5 rounded-full transition backdrop-blur-xs">
                        <span>Peluang Karir</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- 2. SECTION EDITORIAL PROFIL (Visual Kiri, Teks Bersih Kanan) -->
    <section id="tentang" class="py-20 md:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                <div class="lg:col-span-5">
                    <div class="relative rounded-2xl overflow-hidden shadow-md border border-slate-200/80 aspect-[4/3] bg-slate-100">
                        <img src="{{ asset('images/sitea.png') }}" alt="Operasional PT PKS" class="w-full h-full object-cover">
                        <div class="absolute bottom-4 left-4 bg-white/95 backdrop-blur-sm px-4 py-2.5 rounded-xl shadow-sm border border-slate-200/70">
                            <p class="text-[11px] font-bold text-[#1B6EC2] uppercase tracking-wider">Kualitas Terjamin</p>
                            <p class="text-xs font-semibold text-slate-800">Batubara Kalori Tinggi &amp; Rendah Abu</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <p class="text-xs font-bold uppercase tracking-widest text-[#1B6EC2] mb-3">Profil Perusahaan</p>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Menghadirkan Sumber Energi Andal dengan Tata Kelola Berkelas Dunia
                    </h2>
                    <p class="mt-5 text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                        PT Pilar Kencana Sumberdaya mengekstraksi dan mengelola komoditas batubara berkalori tinggi dengan kadar abu serta sulfur rendah. Didukung armada alat berat modern dan tenaga ahli berpengalaman, kami menjamin keandalan pasokan energi jangka panjang yang aman dan berkelanjutan.
                    </p>
                    <div class="mt-7">
                        <a href="#kapasitas" class="inline-flex items-center gap-2 border border-slate-300 hover:border-slate-900 text-slate-800 text-xs font-bold px-5 py-2.5 rounded-full transition">
                            <span>Lihat Kapasitas Produksi</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. FULL-WIDTH PHOTO BREAK BANNER -->
    <section class="relative h-[380px] md:h-[460px] flex items-center overflow-hidden bg-slate-900">
        <img src="{{ asset('images/background.png') }}" alt="Site Pertambangan" class="absolute inset-0 w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-950/45 to-transparent"></div>

        <div class="relative z-10 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8">
            <div class="max-w-lg text-white">
                <p class="text-xs font-bold uppercase tracking-widest text-[#38BDF8] mb-2">Standar Operasional</p>
                <h3 class="text-2xl sm:text-3xl font-extrabold leading-snug">
                    Keselamatan Kerja &amp; Efisiensi Operasional Tanpa Kompromi
                </h3>
                <p class="text-xs sm:text-sm text-slate-200 mt-3 leading-relaxed font-light">
                    Setiap lini operasional di seluruh site kami diawasi dengan sistem pemantauan terintegrasi dan pelatihan berkala bagi seluruh personel lapangan.
                </p>
                <a href="#operasi" class="mt-6 inline-flex items-center gap-2 border border-white/60 hover:bg-white hover:text-slate-900 text-white text-xs font-bold px-5 py-2.5 rounded-full transition">
                    <span>Jelajahi Site Operasi</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- 4. ANGKA & KAPASITAS UTAMA -->
    <section id="kapasitas" class="py-20 md:py-24 bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pb-12 border-b border-slate-200 items-end">
                <div class="lg:col-span-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-[#1B6EC2] mb-2">Kinerja &amp; Sumber Daya</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        Fondasi Cadangan &amp; Kapasitas Jangka Panjang
                    </h2>
                </div>
                <div class="lg:col-span-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-md">
                        Komitmen kami tercermin dari ketahanan cadangan batubara, sebaran wilayah operasi strategis, serta mutu material unggulan.
                    </p>
                    <a href="{{ route('karir') }}" class="shrink-0 inline-flex items-center gap-2 border border-slate-300 hover:border-slate-900 text-slate-800 text-xs font-bold px-4 py-2 rounded-full transition">
                        <span>Bergabung</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-slate-200 pt-10">
                <div class="py-6 md:py-2 md:pr-10">
                    <p class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight">
                        50<span class="text-[#1B6EC2]">+</span> <span class="text-lg font-bold text-slate-500">Tahun</span>
                    </p>
                    <p class="text-sm font-bold text-slate-800 mt-3">Stok Cadangan Batubara</p>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Ketersediaan pasokan energi jangka panjang untuk mendukung kebutuhan industri domestik maupun ekspor.
                    </p>
                </div>

                <div class="py-6 md:py-2 md:px-10">
                    <p class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight">
                        5<span class="text-[#1B6EC2]">+</span> <span class="text-lg font-bold text-slate-500">Site</span>
                    </p>
                    <p class="text-sm font-bold text-slate-800 mt-3">Wilayah Operasi Aktif</p>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Tersebar di berbagai kawasan tambang utama di Kalimantan dan Sumatera dengan infrastruktur terintegrasi.
                    </p>
                </div>

                <div class="py-6 md:py-2 md:pl-10">
                    <p class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight">
                        100<span class="text-[#1B6EC2]">%</span> <span class="text-lg font-bold text-slate-500">Premium</span>
                    </p>
                    <p class="text-sm font-bold text-slate-800 mt-3">Standar Kualitas Material</p>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Batubara berkalori tinggi dengan kadar abu rendah melalui pengujian laboratorium mutu yang ketat.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. AREA OPERASI TAMBANG -->
    <section id="operasi" class="py-20 md:py-24 bg-[#F7F8FA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-12 items-end">
                <div class="lg:col-span-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-[#1B6EC2] mb-2">Jangkauan Wilayah</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Area Operasi &amp; Site Tambang</h2>
                </div>
                <div class="lg:col-span-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-md">
                        Pengelolaan konsesi tambang strategis dengan armada alat berat modern dan jalur logistik terpadu.
                    </p>
                    <a href="{{ route('karir') }}" class="shrink-0 inline-flex items-center gap-2 border border-slate-300 hover:border-slate-900 text-slate-800 text-xs font-bold px-4 py-2 rounded-full transition">
                        <span>Lihat Penempatan</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="group relative rounded-xl overflow-hidden h-80 bg-slate-900 shadow-sm">
                    <img src="{{ asset('images/sitea.png') }}" alt="Kalimantan Timur" class="w-full h-full object-cover transition duration-500 group-hover:scale-105 opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-[#38BDF8]">Site 01</p>
                        <h3 class="text-lg font-extrabold text-white mt-0.5">Kalimantan Timur</h3>
                        <p class="text-xs text-slate-300 mt-1 font-light">Eksplorasi &amp; Produksi Utama</p>
                    </div>
                </div>

                <div class="group relative rounded-xl overflow-hidden h-80 bg-slate-900 shadow-sm">
                    <img src="{{ asset('images/siteb.png') }}" alt="Kalimantan Selatan" class="w-full h-full object-cover transition duration-500 group-hover:scale-105 opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-[#38BDF8]">Site 02</p>
                        <h3 class="text-lg font-extrabold text-white mt-0.5">Kalimantan Selatan</h3>
                        <p class="text-xs text-slate-300 mt-1 font-light">Pengolahan &amp; Hauling Batubara</p>
                    </div>
                </div>

                <div class="group relative rounded-xl overflow-hidden h-80 bg-slate-900 shadow-sm">
                    <img src="{{ asset('images/sitec.png') }}" alt="Sumatera Utara" class="w-full h-full object-cover transition duration-500 group-hover:scale-105 opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-[#38BDF8]">Site 03</p>
                        <h3 class="text-lg font-extrabold text-white mt-0.5">Sumatera Utara</h3>
                        <p class="text-xs text-slate-300 mt-1 font-light">Logistik &amp; Terminal Pelabuhan</p>
                    </div>
                </div>

                <div class="group relative rounded-xl overflow-hidden h-80 bg-slate-900 shadow-sm">
                    <img src="{{ asset('images/background.png') }}" alt="Reklamasi & Lingkungan" class="w-full h-full object-cover transition duration-500 group-hover:scale-105 opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-400">ESG &amp; HSE</p>
                        <h3 class="text-lg font-extrabold text-white mt-0.5">Zona Reklamasi</h3>
                        <p class="text-xs text-slate-300 mt-1 font-light">Pemulihan Ekosistem Pascatambang</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. KEBERLANJUTAN & PENGEMBANGAN SDM -->
    <section id="keberlanjutan" class="py-20 md:py-24 bg-white border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-12 items-end">
                <div class="lg:col-span-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-[#1B6EC2] mb-2">Komitmen Perusahaan</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Keberlanjutan &amp; Pengembangan SDM</h2>
                </div>
                <div class="lg:col-span-6">
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-lg">
                        Menyelaraskan produktivitas pertambangan dengan pelestarian lingkungan hidup dan peningkatan kompetensi tenaga kerja.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <article class="flex flex-col justify-between border-b border-slate-200 pb-6">
                    <div>
                        <div class="rounded-xl overflow-hidden h-52 mb-5 bg-slate-100">
                            <img src="{{ asset('images/pose1.png') }}" alt="Pelatihan Karyawan" class="w-full h-full object-cover">
                        </div>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-[#1B6EC2] mb-1.5">Human Capital</p>
                        <h3 class="text-base font-extrabold text-slate-900 leading-snug">
                            Program Pelatihan Terpadu PKS Training
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                            Setiap karyawan baru menjalani pelatihan teknis dan keselamatan kerja sesuai divisi sebelum diterjunkan ke lapangan.
                        </p>
                    </div>
                    <div class="mt-5">
                        <a href="{{ route('karir') }}" class="inline-flex items-center gap-1.5 border border-slate-300 hover:border-slate-900 text-slate-800 text-[11px] font-bold px-4 py-1.5 rounded-full transition">
                            <span>Info Rekrutmen</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </article>

                <article class="flex flex-col justify-between border-b border-slate-200 pb-6">
                    <div>
                        <div class="rounded-xl overflow-hidden h-52 mb-5 bg-slate-100">
                            <img src="{{ asset('images/siteb.png') }}" alt="Reklamasi Alam" class="w-full h-full object-cover">
                        </div>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-700 mb-1.5">Lingkungan Hidup</p>
                        <h3 class="text-base font-extrabold text-slate-900 leading-snug">
                            Reklamasi Lahan &amp; Pengendalian Emisi
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                            Pengelolaan air limbah tambang dan revegetasi berkala untuk menjaga keseimbangan ekosistem sekitar area konsesi.
                        </p>
                    </div>
                    <div class="mt-5">
                        <a href="#operasi" class="inline-flex items-center gap-1.5 border border-slate-300 hover:border-slate-900 text-slate-800 text-[11px] font-bold px-4 py-1.5 rounded-full transition">
                            <span>Lihat Area</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </article>

                <article class="flex flex-col justify-between border-b border-slate-200 pb-6">
                    <div>
                        <div class="rounded-xl overflow-hidden h-52 mb-5 bg-slate-100">
                            <img src="{{ asset('images/pose2.png') }}" alt="Keselamatan Kerja" class="w-full h-full object-cover">
                        </div>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-amber-700 mb-1.5">Zero Accident</p>
                        <h3 class="text-base font-extrabold text-slate-900 leading-snug">
                            Budaya Keselamatan &amp; Kesehatan Kerja (K3)
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                            Penerapan standar K3 pertambangan secara disiplin di seluruh unit operasi, bengkel perawatan, dan pelabuhan muat.
                        </p>
                    </div>
                    <div class="mt-5">
                        <a href="#tentang" class="inline-flex items-center gap-1.5 border border-slate-300 hover:border-slate-900 text-slate-800 text-[11px] font-bold px-4 py-1.5 rounded-full transition">
                            <span>Profil Perusahaan</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- 7. SECTION KARIR & MARQUEE -->
    <section class="py-20 md:py-24 bg-[#F7F8FA] border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-10 items-end">
                <div class="lg:col-span-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-[#1B6EC2] mb-2">Rekrutmen &amp; Onboarding</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Ingin Berkarir Bersama Kami?</h2>
                </div>
                <div class="lg:col-span-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-md">
                        Bergabunglah dengan tim profesional PT Pilar Kencana Sumberdaya. Cek formasi yang sedang dibuka dan pantau seleksi secara transparan.
                    </p>
                    <a href="{{ route('karir') }}" class="shrink-0 inline-flex items-center gap-2 bg-[#1B6EC2] hover:bg-[#15599E] text-white text-xs font-bold px-6 py-3 rounded-full transition">
                        <span>Lihat Semua Posisi</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <div class="marquee-container relative w-full overflow-hidden py-3">
                <div class="absolute inset-y-0 left-0 w-16 md:w-24 bg-gradient-to-r from-[#F7F8FA] to-transparent z-10 pointer-events-none"></div>
                <div class="absolute inset-y-0 right-0 w-16 md:w-24 bg-gradient-to-l from-[#F7F8FA] to-transparent z-10 pointer-events-none"></div>

                <div class="marquee-content gap-4">
                    <img src="{{ asset('images/sitea.png') }}" class="h-36 w-60 md:h-44 md:w-72 object-cover rounded-xl" alt="Karir">
                    <img src="{{ asset('images/siteb.png') }}" class="h-36 w-60 md:h-44 md:w-72 object-cover rounded-xl" alt="Karir">
                    <img src="{{ asset('images/pose1.png') }}" class="h-36 w-60 md:h-44 md:w-72 object-cover rounded-xl" alt="Karir">
                    <img src="{{ asset('images/sitec.png') }}" class="h-36 w-60 md:h-44 md:w-72 object-cover rounded-xl" alt="Karir">
                    <img src="{{ asset('images/pose2.png') }}" class="h-36 w-60 md:h-44 md:w-72 object-cover rounded-xl" alt="Karir">

                    <img src="{{ asset('images/sitea.png') }}" class="h-36 w-60 md:h-44 md:w-72 object-cover rounded-xl" alt="Karir">
                    <img src="{{ asset('images/siteb.png') }}" class="h-36 w-60 md:h-44 md:w-72 object-cover rounded-xl" alt="Karir">
                    <img src="{{ asset('images/pose1.png') }}" class="h-36 w-60 md:h-44 md:w-72 object-cover rounded-xl" alt="Karir">
                    <img src="{{ asset('images/sitec.png') }}" class="h-36 w-60 md:h-44 md:w-72 object-cover rounded-xl" alt="Karir">
                    <img src="{{ asset('images/pose2.png') }}" class="h-36 w-60 md:h-44 md:w-72 object-cover rounded-xl" alt="Karir">
                </div>
            </div>
        </div>
    </section>

    <!-- 8. CORPORATE FOOTER -->
    <footer class="bg-white border-t border-slate-200 pt-14 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-10 border-b border-slate-200">
                <div class="flex items-center gap-3.5">
                    <img src="{{ asset('images/logo-pks.png') }}" alt="Logo PKS" class="h-11 w-11 object-contain">
                    <div>
                        <p class="font-extrabold text-base text-slate-900 leading-tight">PT Pilar Kencana Sumberdaya</p>
                        <p class="text-xs text-slate-500">Coal Mining &amp; Natural Resources</p>
                    </div>
                </div>
                <p class="text-xs text-slate-500">Portal Resmi Informasi Perusahaan, Rekrutmen &amp; Pelatihan Karyawan</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 py-10 text-xs">
                <div>
                    <p class="font-extrabold text-slate-900 uppercase tracking-wider mb-3">Perusahaan</p>
                    <ul class="space-y-2.5 text-slate-500">
                        <li><a href="#tentang" class="hover:text-slate-900 transition">Tentang Kami</a></li>
                        <li><a href="#kapasitas" class="hover:text-slate-900 transition">Cadangan &amp; Kapasitas</a></li>
                        <li><a href="#keberlanjutan" class="hover:text-slate-900 transition">Keberlanjutan &amp; K3</a></li>
                    </ul>
                </div>

                <div>
                    <p class="font-extrabold text-slate-900 uppercase tracking-wider mb-3">Area Operasi</p>
                    <ul class="space-y-2.5 text-slate-500">
                        <li><a href="#operasi" class="hover:text-slate-900 transition">Site Kalimantan Timur</a></li>
                        <li><a href="#operasi" class="hover:text-slate-900 transition">Site Kalimantan Selatan</a></li>
                        <li><a href="#operasi" class="hover:text-slate-900 transition">Site Sumatera Utara</a></li>
                    </ul>
                </div>

                <div>
                    <p class="font-extrabold text-slate-900 uppercase tracking-wider mb-3">Rekrutmen &amp; SDM</p>
                    <ul class="space-y-2.5 text-slate-500">
                        <li><a href="{{ route('karir') }}" class="hover:text-slate-900 transition">Lowongan Tersedia</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-slate-900 transition">Masuk Portal Pelamar</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-slate-900 transition">Registrasi Akun Baru</a></li>
                    </ul>
                </div>

                <div>
                    <p class="font-extrabold text-slate-900 uppercase tracking-wider mb-3">Kontak Kantor</p>
                    <ul class="space-y-2.5 text-slate-500">
                        <li>Jakarta Head Office, Indonesia</li>
                        <li>hrd@pilarkencana.co.id</li>
                        <li>Jam Operasional: 08:00 – 17:00 WIB</li>
                    </ul>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-2 text-[11px] text-slate-400">
                <p>&copy; {{ date('Y') }} PT Pilar Kencana Sumberdaya. All rights reserved.</p>
                <p>Human Resources &amp; Corporate Communication</p>
            </div>
        </div>
    </footer>

</body>
</html>