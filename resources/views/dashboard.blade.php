<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Kandidat — PT Pilar Kencana Sumberdaya</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @keyframes modalZoom {
            0% { opacity: 0; transform: scale(0.92) translateY(14px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }
        .animate-modal-zoom { animation: modalZoom 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>
</head>
<body class="bg-white text-slate-900 antialiased overflow-x-hidden flex flex-col min-h-screen">

    <!-- NAVBAR -->
    <nav class="sticky top-0 z-40 bg-slate-950/90 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-20">
            <a href="{{ route('landing') }}" class="flex items-center gap-3.5">
                <img src="{{ asset('images/logo-pks.png') }}" alt="Logo PKS" class="h-11 w-11 object-contain rounded-xl bg-white/10 p-1 border border-white/15">
                <div class="flex flex-col">
                    <span class="font-extrabold text-base tracking-tight text-white leading-tight">Pilar Kencana</span>
                    <span class="font-bold text-[11px] tracking-wider text-[#38BDF8] uppercase">Sumberdaya</span>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-7 text-xs font-bold uppercase tracking-wider text-slate-300">
                <a href="{{ route('dashboard') }}" class="text-white transition">Dashboard</a>
                <a href="{{ route('karir') }}" class="hover:text-white transition">Lowongan Karir</a>
                <a href="{{ route('profile.edit') }}" class="hover:text-white transition">Profil Akun</a>
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

    <!-- HEADER PORTAL KANDIDAT -->
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

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-end pb-10 border-b border-slate-200">
                <div class="lg:col-span-7">
                    <p class="text-xs font-bold uppercase tracking-widest text-[#1B6EC2] mb-2">
                        Portal Kandidat &amp; Onboarding &bull; {{ now()->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                    </p>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Selamat Datang, {{ Auth::user()->name }}
                    </h1>
                    <p class="mt-2.5 text-sm text-slate-500 font-normal leading-relaxed max-w-2xl">
                        Pantau perkembangan seleksi berkas lamaran serta akses panduan pelatihan karyawan PT Pilar Kencana Sumberdaya.
                    </p>
                </div>

                <div class="lg:col-span-5 flex flex-wrap lg:justify-end gap-3">
                    @if($acceptedApp)
                        <button type="button" onclick="openAcceptedModal()" class="inline-flex items-center gap-2 bg-[#1B6EC2] hover:bg-[#15599E] text-white text-xs font-bold px-5 py-3 rounded-full transition">
                            <span>Info Aplikasi PKS Training</span>
                            <span>&rarr;</span>
                        </button>
                    @endif
                    <a href="{{ route('karir') }}" class="inline-flex items-center gap-2 border border-slate-300 hover:border-slate-900 text-slate-800 text-xs font-bold px-5 py-3 rounded-full transition">
                        <span>Cari Lowongan</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- 3 Angka Ringkasan -->
            <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-slate-200 pt-10">
                <div class="py-5 md:py-1 md:pr-10">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Lamaran</p>
                    <p class="text-4xl sm:text-5xl font-extrabold text-slate-900 mt-2 tracking-tight">
                        {{ $applications->count() }} <span class="text-base font-bold text-slate-500">Berkas</span>
                    </p>
                    <a href="#riwayat-lamaran" class="inline-flex items-center gap-1 text-xs font-bold text-[#1B6EC2] hover:underline mt-3">
                        <span>Lihat Riwayat Seleksi</span>
                        <span>&rarr;</span>
                    </a>
                </div>

                <div class="py-5 md:py-1 md:px-10">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Status Kepesertaan</p>
                    <p class="text-2xl sm:text-3xl font-extrabold mt-2.5 {{ $acceptedApp ? 'text-emerald-700' : 'text-slate-900' }}">
                        {{ $acceptedApp ? 'Karyawan Baru' : 'Kandidat Pelamar' }}
                    </p>
                    <p class="text-xs text-slate-500 mt-2">{{ Auth::user()->email }}</p>
                </div>

                <div class="py-5 md:py-1 md:pl-10 flex flex-col justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Pengaturan &amp; Berkas</p>
                        <p class="text-sm font-bold text-slate-800 mt-2.5 leading-snug">
                            Pastikan data NIK, nomor telepon, dan CV terbaru Anda selalu valid.
                        </p>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-1.5 border border-slate-300 hover:border-slate-900 text-slate-800 text-xs font-bold px-4 py-1.5 rounded-full transition">
                            <span>Kelola Profil</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </header>

    <!-- TRACKING STATUS LAMARAN -->
    <main id="riwayat-lamaran" class="flex-1 py-16 md:py-20 bg-[#F7F8FA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pb-8 mb-10 border-b border-slate-200 items-end">
                <div class="lg:col-span-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-[#1B6EC2] mb-2">Rekam Jejak Seleksi</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Tracking Status Lamaran</h2>
                </div>
                <div class="lg:col-span-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-md">
                        Setiap tahapan verifikasi berkas oleh tim HRD akan diperbarui secara otomatis pada halaman ini.
                    </p>
                    <span class="shrink-0 inline-flex items-center bg-white border border-slate-300 text-slate-800 text-xs font-bold px-4 py-2 rounded-full">
                        {{ $applications->count() }} Pengajuan
                    </span>
                </div>
            </div>

            @if($applications->isEmpty())
                <div class="bg-white rounded-2xl border border-slate-200 p-16 text-center">
                    <h3 class="text-xl font-extrabold text-slate-900">Belum Ada Riwayat Lamaran</h3>
                    <p class="text-xs sm:text-sm text-slate-500 mt-2 max-w-md mx-auto leading-relaxed">
                        Anda belum mengirimkan lamaran untuk posisi apapun. Jelajahi formasi yang sedang dibuka untuk memulai pendaftaran.
                    </p>
                    <a href="{{ route('karir') }}" class="inline-flex items-center gap-2 mt-6 bg-[#1B6EC2] hover:bg-[#15599E] text-white text-xs font-bold px-6 py-3 rounded-full transition">
                        <span>Lihat Lowongan Tersedia</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            @else
                @php
                    $steps = [
                        'submitted' => 'Disubmit',
                        'screening' => 'Pengecekan HRD',
                        'interview' => 'Interview',
                        'accepted'  => 'Diterima & Pelatihan',
                    ];
                    $stepOrder = array_keys($steps);

                    $badgeStyles = [
                        'submitted' => ['label' => 'Pendaftaran Disubmit', 'class' => 'bg-slate-100 text-slate-700 border-slate-300'],
                        'screening' => ['label' => 'Proses Pengecekan HRD', 'class' => 'bg-amber-50 text-amber-800 border-amber-300'],
                        'interview' => ['label' => 'Tahap Interview', 'class' => 'bg-sky-50 text-[#1B6EC2] border-sky-300'],
                        'accepted'  => ['label' => 'Diterima Karyawan', 'class' => 'bg-emerald-50 text-emerald-800 border-emerald-300'],
                        'training'  => ['label' => 'Sedang Pelatihan', 'class' => 'bg-emerald-50 text-emerald-800 border-emerald-300'],
                        'graduated' => ['label' => 'Lulus Pelatihan', 'class' => 'bg-emerald-100 text-emerald-900 border-emerald-400'],
                        'rejected'  => ['label' => 'Pendaftaran Ditolak', 'class' => 'bg-red-50 text-red-700 border-red-300'],
                        'failed'    => ['label' => 'Gagal Pelatihan', 'class' => 'bg-red-100 text-red-800 border-red-400'],
                    ];
                @endphp

                <div class="space-y-6">
                    @foreach($applications as $app)
                        @php
                            $currentBadge = $badgeStyles[$app->status] ?? ['label' => ucfirst($app->status), 'class' => 'bg-slate-100 text-slate-700 border-slate-300'];
                            $mappedStatus = in_array($app->status, ['training', 'graduated', 'failed']) ? 'accepted' : $app->status;
                            $currentIndex = array_search($mappedStatus, $stepOrder);
                        @endphp

                        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 sm:p-8 shadow-2xs">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-6 border-b border-slate-200">
                                <div>
                                    <p class="text-[11px] font-bold uppercase tracking-wider text-[#1B6EC2]">
                                        Divisi {{ $app->jobVacancy->division ?? '-' }}
                                    </p>
                                    <h3 class="text-xl font-extrabold text-slate-900 mt-1">
                                        {{ $app->jobVacancy->title ?? 'Posisi Tidak Tersedia' }}
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-1">
                                        Dikirim pada {{ $app->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB &bull; NIK: {{ $app->nik }}
                                    </p>
                                </div>

                                <div class="flex flex-wrap items-center gap-3">
                                    @if($app->cv_path)
                                        <a href="{{ asset('storage/' . $app->cv_path) }}" target="_blank" class="border border-slate-300 hover:border-slate-900 text-slate-800 text-xs font-bold px-4 py-2 rounded-full transition">
                                            Dokumen CV (PDF)
                                        </a>
                                    @endif
                                    <span class="border px-4 py-2 rounded-full text-xs font-bold {{ $currentBadge['class'] }}">
                                        {{ $currentBadge['label'] }}
                                    </span>
                                </div>
                            </div>

                            @if($app->status === 'rejected')
                                <div class="mt-6 bg-red-50 border border-red-200 rounded-xl p-5">
                                    <p class="text-xs font-extrabold text-red-800 uppercase tracking-wider mb-1">Alasan Penolakan dari HRD:</p>
                                    <p class="text-xs sm:text-sm text-red-700 leading-relaxed">
                                        {{ $app->rejection_reason ?: 'Mohon maaf, kualifikasi Anda belum sesuai dengan kebutuhan posisi saat ini.' }}
                                    </p>
                                </div>
                            @else
                                <div class="mt-6">
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3.5">
                                        @foreach($steps as $key => $label)
                                            @php
                                                $idx = array_search($key, $stepOrder);
                                                $isDone = $currentIndex !== false && $idx < $currentIndex;
                                                $isCurrent = $currentIndex !== false && $idx === $currentIndex;
                                            @endphp
                                            <div class="rounded-xl border p-4 transition {{ $isCurrent ? 'border-[#1B6EC2] bg-sky-50/70' : ($isDone ? 'border-slate-900 bg-slate-900 text-white' : 'border-slate-200 bg-[#F7F8FA] text-slate-400') }}">
                                                <div class="flex items-center justify-between mb-1.5">
                                                    <span class="text-[10px] font-bold uppercase tracking-wider {{ $isCurrent ? 'text-[#1B6EC2]' : ($isDone ? 'text-[#38BDF8]' : 'text-slate-400') }}">
                                                        Tahap 0{{ $loop->iteration }}
                                                    </span>
                                                    @if($isDone)
                                                        <span class="text-xs font-bold text-emerald-400">&#10003;</span>
                                                    @elseif($isCurrent)
                                                        <span class="w-2 h-2 rounded-full bg-[#1B6EC2] animate-ping"></span>
                                                    @endif
                                                </div>
                                                <p class="text-xs font-bold leading-snug {{ $isCurrent ? 'text-slate-900' : ($isDone ? 'text-white' : 'text-slate-400') }}">
                                                    {{ $label }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if($app->logs && $app->logs->count() > 0)
                                <div class="mt-6 pt-5 border-t border-slate-200">
                                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-3">Catatan Aktivitas</p>
                                    <div class="space-y-2">
                                        @foreach($app->logs as $log)
                                            <div class="flex items-start gap-2.5 text-xs">
                                                <span class="w-1.5 h-1.5 rounded-full bg-[#1B6EC2] mt-1.5 shrink-0"></span>
                                                <div>
                                                    <span class="font-bold text-slate-800">{{ $log->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</span>
                                                    <span class="text-slate-300 mx-1.5">&bull;</span>
                                                    <span class="text-slate-600">{{ $log->notes }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </main>

    <!-- POPUP PKS TRAINING -->
    @if($acceptedApp)
    <div id="acceptedModal" class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-950/65 backdrop-blur-xs transition-opacity" onclick="closeAcceptedModal()"></div>

        <div class="relative w-full max-w-[440px] rounded-2xl bg-gradient-to-b from-[#1B6EC2] via-[#178CE0] to-[#0CB8F2] p-7 sm:p-8 text-center text-white shadow-2xl animate-modal-zoom overflow-hidden">
            <button type="button" onclick="closeAcceptedModal()" class="absolute top-4 right-5 text-white/80 hover:text-white text-2xl font-bold leading-none transition">
                &times;
            </button>

            <h2 class="text-lg sm:text-xl font-extrabold tracking-tight flex items-center justify-center gap-2 mt-1">
                <span>🎉</span>
                <span>Selamat! Anda Keterima Karyawan</span>
            </h2>
            <p class="text-xs text-sky-100 font-medium mt-1">
                Posisi {{ $acceptedApp->jobVacancy->title ?? '-' }} &bull; Divisi {{ $acceptedApp->jobVacancy->division ?? '-' }}
            </p>

            <div class="relative h-44 my-6 flex items-center justify-center select-none">
                <div class="w-24 h-36 bg-white/95 rounded-lg shadow-xl p-2.5 text-left text-slate-800 transform -rotate-12 -translate-x-14 translate-y-2 border border-white/40">
                    <div class="w-full h-14 rounded bg-gradient-to-r from-slate-800 to-slate-900 mb-2 flex items-center justify-center">
                        <img src="{{ asset('images/logo-pks.png') }}" class="h-7 w-7 object-contain bg-white rounded-full p-0.5" alt="PKS">
                    </div>
                    <div class="h-2 w-14 bg-slate-300 rounded mb-1.5"></div>
                    <div class="h-1.5 w-10 bg-slate-200 rounded mb-3"></div>
                    <div class="h-5 w-full rounded bg-orange-500/90 flex items-center justify-center text-[7px] font-bold text-white uppercase">Absensi</div>
                </div>

                <div class="w-28 h-40 bg-white rounded-lg shadow-2xl p-3 text-center text-slate-800 z-10 border border-white">
                    <img src="{{ asset('images/logo-pks.png') }}" class="h-10 w-10 mx-auto object-contain mb-2" alt="PKS">
                    <p class="text-[10px] font-extrabold text-slate-900 leading-tight">PKS TRAINING</p>
                    <p class="text-[8px] text-slate-500 mt-0.5">Portal Pelatihan</p>
                    <div class="mt-3 bg-sky-50 border border-sky-200 rounded px-1.5 py-1 text-[7px] font-mono text-sky-900 truncate">
                        {{ Auth::user()->email }}
                    </div>
                    <div class="mt-2 h-5 w-full rounded bg-[#178CE0] flex items-center justify-center text-[8px] font-bold text-white">
                        LOGIN AKUN
                    </div>
                </div>

                <div class="w-24 h-36 bg-white/95 rounded-lg shadow-xl p-2.5 text-left text-slate-800 transform rotate-12 translate-x-14 translate-y-2 border border-white/40">
                    <div class="w-full h-14 rounded bg-emerald-500 mb-2 flex items-center justify-center text-white font-extrabold text-xs">
                        100%
                    </div>
                    <div class="h-2 w-12 bg-slate-300 rounded mb-1.5"></div>
                    <div class="h-1.5 w-16 bg-slate-200 rounded mb-3"></div>
                    <div class="h-5 w-full rounded bg-emerald-600 flex items-center justify-center text-[7px] font-bold text-white uppercase">Sertifikat</div>
                </div>
            </div>

            <p class="text-xs sm:text-sm text-white/95 leading-relaxed max-w-sm mx-auto font-normal">
                Harap download aplikasi <strong>PKS Training</strong> di bawah ini dan login menggunakan email <strong>{{ Auth::user()->email }}</strong> &amp; password akun Anda!
            </p>

            <div class="mt-6">
                <a href="{{ asset('downloads/PKS-Training.apk') }}" download class="inline-block bg-white hover:bg-sky-50 text-[#1474C4] text-xs sm:text-sm font-extrabold px-7 py-3 rounded-lg shadow-lg transition transform hover:-translate-y-0.5">
                    Download PKS Training!
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- CORPORATE FOOTER -->
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
                        <li><a href="{{ route('dashboard') }}" class="hover:text-slate-900 transition">Status Lamaran Saya</a></li>
                        <li><a href="{{ route('profile.edit') }}" class="hover:text-slate-900 transition">Pengaturan Akun</a></li>
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
        function openAcceptedModal() {
            const m = document.getElementById('acceptedModal');
            if (m) m.classList.remove('hidden');
        }
        function closeAcceptedModal() {
            const m = document.getElementById('acceptedModal');
            if (m) m.classList.add('hidden');
        }
    </script>

</body>
</html>