<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peluang Karir — PT Pilar Kencana Sumberdaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style> 
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-slate-900 antialiased overflow-x-hidden flex flex-col min-h-screen">

    <!-- NAVBAR (Ukuran & Gaya Seragam dengan Landing Page) -->
    <nav class="fixed w-full top-0 z-50 bg-slate-950/80 backdrop-blur-md border-b border-white/10 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-20">
            <a href="{{ route('landing') }}" class="flex items-center gap-3.5">
                <img src="{{ asset('images/logo-pks.png') }}" alt="Logo PKS" class="h-11 w-11 object-contain rounded-xl bg-white/10 p-1 border border-white/15">
                <div class="flex flex-col">
                    <span class="font-extrabold text-base tracking-tight text-white leading-tight">Pilar Kencana</span>
                    <span class="font-bold text-[11px] tracking-wider text-[#38BDF8] uppercase">Sumberdaya</span>
                </div>
            </a>

            <div class="hidden lg:flex items-center gap-7 text-xs font-bold uppercase tracking-wider text-slate-300">
                <a href="{{ route('landing') }}#tentang" class="hover:text-white transition">Tentang Kami</a>
                <a href="{{ route('landing') }}#kapasitas" class="hover:text-white transition">Kapasitas</a>
                <a href="{{ route('landing') }}#operasi" class="hover:text-white transition">Area Operasi</a>
                <a href="{{ route('landing') }}#keberlanjutan" class="hover:text-white transition">Keberlanjutan</a>
            </div>
            
            <div class="flex items-center gap-5 md:gap-6">
                <a href="{{ route('landing') }}" class="text-xs font-bold uppercase tracking-wider text-slate-200 hover:text-white transition">
                    Beranda
                </a>

                @auth
                    <a href="{{ route('dashboard') }}" class="text-xs font-bold uppercase tracking-wider text-white bg-[#1B6EC2] hover:bg-[#15599E] px-4 py-2.5 rounded-lg transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-bold uppercase tracking-wider text-slate-200 hover:text-white transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="text-xs font-bold uppercase tracking-wider text-white bg-[#1B6EC2] hover:bg-[#15599E] px-4 py-2.5 rounded-lg transition">
                        Daftar Akun
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- HEADER BANNER KARIR (Clean Corporate Banner) -->
    <header class="relative pt-32 pb-20 md:pt-40 md:pb-24 bg-slate-900 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/background.png') }}" class="w-full h-full object-cover object-center opacity-65" alt="Karir PT PKS">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/60 to-slate-950/25 z-10"></div>
        
        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#38BDF8] mb-3">
                    Rekrutmen &amp; Pengembangan Karir
                </p>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.15]">
                    Formasi &amp; Peluang Karir
                </h1>
                <p class="mt-4 text-sm sm:text-base text-slate-200 font-light leading-relaxed max-w-xl">
                    Bergabunglah bersama PT Pilar Kencana Sumberdaya. Pilih formasi yang sesuai dengan keahlian Anda dan ikuti proses seleksi secara transparan.
                </p>
            </div>
        </div>
    </header>

    <!-- DAFTAR FORMASI LOWONGAN (Editorial Clean Layout) -->
    <main class="flex-1 py-16 md:py-24 bg-[#F7F8FA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section 2 Kolom (Persis Gaya Landing Page) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pb-10 mb-12 border-b border-slate-200 items-end">
                <div class="lg:col-span-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-[#1B6EC2] mb-2">Posisi Tersedia</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        Daftar Formasi &amp; Divisi Penempatan
                    </h2>
                </div>
                <div class="lg:col-span-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-md">
                        Klik pada masing-masing formasi untuk melihat kualifikasi persyaratan, prospek jenjang karir, serta kuota penerimaan.
                    </p>
                    <span class="shrink-0 inline-flex items-center gap-2 bg-white border border-slate-300 text-slate-800 text-xs font-bold px-4 py-2 rounded-full">
                        {{ $vacancies->count() }} Formasi Terdaftar
                    </span>
                </div>
            </div>

            <!-- Grid Kartu Posisi -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @forelse($vacancies as $job)
                    <button type="button"
                            data-id="{{ $job->id }}" 
                            data-title="{{ $job->title }}" 
                            data-division="{{ $job->division }}" 
                            data-requirements="{{ $job->requirements }}" 
                            data-prospects="{{ $job->prospects }}" 
                            data-status="{{ $job->is_open ? 'open' : 'closed' }}" 
                            data-quota="{{ $job->quota }}"
                            class="open-modal-btn bg-white rounded-xl border border-slate-200/90 overflow-hidden text-left transition duration-300 group flex flex-col relative w-full shadow-xs hover:shadow-md hover:border-slate-400">
                        
                        <div class="h-48 w-full overflow-hidden bg-slate-100 relative">
                            <img src="{{ asset('images/sitea.png') }}" alt="{{ $job->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105 {{ $job->is_open ? '' : 'grayscale opacity-75' }}">
                            
                            @if($job->is_open)
                                <span class="absolute top-3.5 right-3.5 bg-emerald-600 text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-sm">
                                    Dibuka
                                </span>
                            @else
                                <span class="absolute top-3.5 right-3.5 bg-slate-700 text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-sm">
                                    Belum Dibuka
                                </span>
                            @endif
                        </div>
                        
                        <div class="p-6 flex-grow flex flex-col justify-between w-full">
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wider text-[#1B6EC2] mb-1.5">
                                    Divisi {{ $job->division }}
                                </p>
                                <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-[#1B6EC2] transition leading-snug">
                                    {{ $job->title }}
                                </h3>
                                <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">
                                    {{ Str::limit(strip_tags($job->requirements), 95) }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-4 mt-5 border-t border-slate-100 w-full">
                                <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-800 group-hover:text-[#1B6EC2] transition">
                                    <span>Lihat Detail</span>
                                    <span>&rarr;</span>
                                </span>
                                @if($job->is_open)
                                    <span class="text-xs font-semibold text-slate-500">Kuota: <strong class="text-slate-900">{{ $job->quota }}</strong></span>
                                @else
                                    <span class="text-xs font-medium text-slate-400">Tutup</span>
                                @endif
                            </div>
                        </div>
                    </button>
                @empty
                    <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center py-20 bg-white rounded-xl border border-slate-200">
                        <h3 class="text-lg font-extrabold text-slate-900">Data Formasi Belum Tersedia</h3>
                        <p class="text-slate-500 mt-1 text-xs sm:text-sm">Silakan hubungi divisi HRD untuk informasi pembukaan lowongan terbaru.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </main>

    <!-- MODAL POPUP PERSYARATAN (Clean Corporate Style) -->
    <div id="careerModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-xs transition-opacity" onclick="closeModal()"></div>
        
        <div class="relative bg-white border border-slate-200 w-full max-w-xl overflow-hidden transform scale-95 transition-transform duration-300 opacity-0 shadow-2xl rounded-2xl" id="modalContent">
            
            <!-- Header Modal -->
            <div class="bg-slate-950 px-6 py-6 md:px-8 text-white flex justify-between items-start border-b border-slate-800">
                <div>
                    <p id="modalDivision" class="text-[11px] font-bold uppercase tracking-widest text-[#38BDF8] mb-1.5">Divisi</p>
                    <h3 id="modalTitle" class="text-xl md:text-2xl font-extrabold tracking-tight">Posisi</h3>
                </div>
                <button type="button" onclick="closeModal()" class="text-slate-400 hover:text-white p-1.5 rounded-lg hover:bg-white/10 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <!-- Body Modal -->
            <div class="p-6 md:p-8 max-h-[75vh] overflow-y-auto">
                <div id="modalStatusBox" class="mb-6 px-4 py-3 rounded-xl text-xs font-bold"></div>

                <div class="mb-6 pb-6 border-b border-slate-200">
                    <h4 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider mb-2.5">Kualifikasi &amp; Persyaratan</h4>
                    <div id="modalRequirements" class="text-xs sm:text-sm text-slate-600 whitespace-pre-line leading-relaxed"></div>
                </div>
                
                <div class="mb-6">
                    <h4 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider mb-2.5">Prospek Karir</h4>
                    <div id="modalProspects" class="text-xs sm:text-sm text-slate-600 whitespace-pre-line leading-relaxed"></div>
                </div>
                
                <div class="flex justify-end gap-3 pt-5 border-t border-slate-200">
                    <button type="button" onclick="closeModal()" class="px-5 py-2.5 text-xs font-bold text-slate-700 border border-slate-300 hover:border-slate-900 rounded-full transition">
                        Tutup
                    </button>
                    <a href="#" id="btnLamar" class="px-6 py-2.5 text-xs font-bold text-white rounded-full transition">
                        Lamar Posisi Ini
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- CORPORATE FOOTER (Seragam dengan Landing Page) -->
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
                        <li><a href="{{ route('landing') }}#tentang" class="hover:text-slate-900 transition">Tentang Kami</a></li>
                        <li><a href="{{ route('landing') }}#kapasitas" class="hover:text-slate-900 transition">Cadangan &amp; Kapasitas</a></li>
                        <li><a href="{{ route('landing') }}#keberlanjutan" class="hover:text-slate-900 transition">Keberlanjutan &amp; K3</a></li>
                    </ul>
                </div>

                <div>
                    <p class="font-extrabold text-slate-900 uppercase tracking-wider mb-3">Area Operasi</p>
                    <ul class="space-y-2.5 text-slate-500">
                        <li><a href="{{ route('landing') }}#operasi" class="hover:text-slate-900 transition">Site Kalimantan Timur</a></li>
                        <li><a href="{{ route('landing') }}#operasi" class="hover:text-slate-900 transition">Site Kalimantan Selatan</a></li>
                        <li><a href="{{ route('landing') }}#operasi" class="hover:text-slate-900 transition">Site Sumatera Utara</a></li>
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

    <script>
        document.querySelectorAll('.open-modal-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');
                const division = this.getAttribute('data-division');
                const requirements = this.getAttribute('data-requirements');
                const prospects = this.getAttribute('data-prospects');
                const status = this.getAttribute('data-status');
                const quota = this.getAttribute('data-quota');

                document.getElementById('modalTitle').innerText = title;
                document.getElementById('modalDivision').innerText = 'Divisi ' + division;
                document.getElementById('modalRequirements').innerText = requirements || 'Tidak ada persyaratan khusus.';
                document.getElementById('modalProspects').innerText = prospects || 'Prospek karir yang menjanjikan.';
                
                const statusBox = document.getElementById('modalStatusBox');
                const btnLamar = document.getElementById('btnLamar');

                if (status === 'open') {
                    statusBox.innerHTML = `Status Formasi: Sedang Dibuka (Kuota ${quota} Orang)`;
                    statusBox.className = 'mb-6 px-4 py-3 border border-emerald-200 bg-emerald-50 text-emerald-800 text-xs font-bold rounded-xl';
                    
                    btnLamar.href = `/lamar/${id}`; 
                    btnLamar.innerText = 'Lamar Posisi Ini';
                    btnLamar.className = 'px-6 py-2.5 text-xs font-bold text-white bg-[#1B6EC2] hover:bg-[#15599E] transition cursor-pointer rounded-full';
                } else {
                    statusBox.innerHTML = `Status Formasi: Belum Dibuka`;
                    statusBox.className = 'mb-6 px-4 py-3 border border-slate-200 bg-slate-100 text-slate-600 text-xs font-bold rounded-xl';
                    
                    btnLamar.removeAttribute('href');
                    btnLamar.innerText = 'Pendaftaran Ditutup';
                    btnLamar.className = 'px-6 py-2.5 text-xs font-bold text-slate-400 bg-slate-100 cursor-not-allowed rounded-full';
                }
                
                const modal = document.getElementById('careerModal');
                const content = document.getElementById('modalContent');
                
                modal.classList.remove('hidden');
                setTimeout(() => {
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            });
        });

        function closeModal() {
            const modal = document.getElementById('careerModal');
            const content = document.getElementById('modalContent');
            
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
</body>
</html>