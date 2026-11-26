<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel HRD &amp; Rekrutmen — PT Pilar Kencana Sumberdaya</title>
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
                <a href="{{ route('hrd.dashboard') }}" class="text-white transition">Data Pelamar</a>
                <a href="{{ route('hrd.vacancies.index') }}" class="hover:text-white transition">Kelola Lowongan</a>
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

    <!-- HEADER & TRACKSTATS HRD -->
    <header class="bg-white border-b border-slate-200 py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-8 bg-emerald-50 border border-emerald-200 text-emerald-900 px-5 py-3.5 rounded-xl text-xs font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-8 bg-red-50 border border-red-200 text-red-900 px-5 py-3.5 rounded-xl text-xs font-semibold">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Header 2 Kolom Editorial -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-end pb-10 border-b border-slate-200">
                <div class="lg:col-span-7">
                    <p class="text-xs font-bold uppercase tracking-widest text-[#1B6EC2] mb-2">
                        Human Resources Information System &bull; {{ now()->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                    </p>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Manajemen Rekrutmen &amp; Pelamar
                    </h1>
                    <p class="mt-2.5 text-sm text-slate-500 font-normal leading-relaxed max-w-2xl">
                        Verifikasi berkas kandidat, tetapkan jadwal wawancara, serta kelola status penerimaan karyawan baru PT Pilar Kencana Sumberdaya.
                    </p>
                </div>

                <div class="lg:col-span-5 flex flex-wrap lg:justify-end gap-3">
                    <a href="{{ route('hrd.vacancies.index') }}" class="inline-flex items-center gap-2 bg-[#1B6EC2] hover:bg-[#15599E] text-white text-xs font-bold px-5 py-3 rounded-full transition">
                        <span>Kelola Formasi Lowongan</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- 6 Angka TrackStats Bersih (Klik untuk Filter) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 divide-y sm:divide-y-0 sm:divide-x divide-slate-200 pt-8">
                <a href="{{ route('hrd.dashboard', ['filter' => 'all']) }}" class="py-4 sm:px-4 first:sm:pl-0 group transition">
                    <p class="text-[11px] font-bold uppercase tracking-wider {{ !$statusFilter || $statusFilter === 'all' ? 'text-[#1B6EC2]' : 'text-slate-400 group-hover:text-slate-700' }}">
                        Total Pelamar
                    </p>
                    <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-1.5">{{ $stats['total'] }}</p>
                    @if(!$statusFilter || $statusFilter === 'all')
                        <span class="inline-block w-6 h-0.5 bg-[#1B6EC2] mt-2"></span>
                    @endif
                </a>

                <a href="{{ route('hrd.dashboard', ['filter' => 'submitted']) }}" class="py-4 sm:px-4 group transition">
                    <p class="text-[11px] font-bold uppercase tracking-wider {{ $statusFilter === 'submitted' ? 'text-[#1B6EC2]' : 'text-slate-400 group-hover:text-slate-700' }}">
                        Disubmit
                    </p>
                    <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-1.5">{{ $stats['submitted'] }}</p>
                    @if($statusFilter === 'submitted')
                        <span class="inline-block w-6 h-0.5 bg-[#1B6EC2] mt-2"></span>
                    @endif
                </a>

                <a href="{{ route('hrd.dashboard', ['filter' => 'screening']) }}" class="py-4 sm:px-4 group transition">
                    <p class="text-[11px] font-bold uppercase tracking-wider {{ $statusFilter === 'screening' ? 'text-amber-600' : 'text-slate-400 group-hover:text-slate-700' }}">
                        Review HRD
                    </p>
                    <p class="text-3xl sm:text-4xl font-extrabold text-amber-600 mt-1.5">{{ $stats['screening'] }}</p>
                    @if($statusFilter === 'screening')
                        <span class="inline-block w-6 h-0.5 bg-amber-600 mt-2"></span>
                    @endif
                </a>

                <a href="{{ route('hrd.dashboard', ['filter' => 'interview']) }}" class="py-4 sm:px-4 group transition">
                    <p class="text-[11px] font-bold uppercase tracking-wider {{ $statusFilter === 'interview' ? 'text-[#1B6EC2]' : 'text-slate-400 group-hover:text-slate-700' }}">
                        Interview
                    </p>
                    <p class="text-3xl sm:text-4xl font-extrabold text-[#1B6EC2] mt-1.5">{{ $stats['interview'] }}</p>
                    @if($statusFilter === 'interview')
                        <span class="inline-block w-6 h-0.5 bg-[#1B6EC2] mt-2"></span>
                    @endif
                </a>

                <a href="{{ route('hrd.dashboard', ['filter' => 'accepted']) }}" class="py-4 sm:px-4 group transition">
                    <p class="text-[11px] font-bold uppercase tracking-wider {{ $statusFilter === 'accepted' ? 'text-emerald-700' : 'text-slate-400 group-hover:text-slate-700' }}">
                        Diterima
                    </p>
                    <p class="text-3xl sm:text-4xl font-extrabold text-emerald-700 mt-1.5">{{ $stats['accepted'] }}</p>
                    @if($statusFilter === 'accepted')
                        <span class="inline-block w-6 h-0.5 bg-emerald-700 mt-2"></span>
                    @endif
                </a>

                <a href="{{ route('hrd.dashboard', ['filter' => 'rejected']) }}" class="py-4 sm:pl-4 group transition">
                    <p class="text-[11px] font-bold uppercase tracking-wider {{ $statusFilter === 'rejected' ? 'text-red-600' : 'text-slate-400 group-hover:text-slate-700' }}">
                        Ditolak
                    </p>
                    <p class="text-3xl sm:text-4xl font-extrabold text-red-600 mt-1.5">{{ $stats['rejected'] }}</p>
                    @if($statusFilter === 'rejected')
                        <span class="inline-block w-6 h-0.5 bg-red-600 mt-2"></span>
                    @endif
                </a>
            </div>

        </div>
    </header>

    <!-- KONTEN DATA HRD -->
    <main class="flex-1 py-16 md:py-20 bg-[#F7F8FA] space-y-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            <!-- 1. DAFTAR KARYAWAN BARU LOLOS & DITERIMA -->
            <section>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pb-6 mb-6 border-b border-slate-200 items-end">
                    <div class="lg:col-span-7">
                        <p class="text-xs font-bold uppercase tracking-widest text-emerald-700 mb-1.5">Onboarding &amp; Pelatihan</p>
                        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Karyawan Lolos &amp; Diterima</h2>
                    </div>
                    <div class="lg:col-span-5 flex sm:justify-end">
                        <span class="inline-flex items-center bg-white border border-slate-300 text-slate-800 text-xs font-bold px-4 py-2 rounded-full">
                            {{ $acceptedEmployees->count() }} Karyawan Terdaftar
                        </span>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-2xs">
                    @if($acceptedEmployees->isEmpty())
                        <div class="p-10 text-center text-xs sm:text-sm text-slate-500">
                            Belum ada pelamar yang dinyatakan diterima sebagai karyawan baru.
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse text-xs">
                                <thead>
                                    <tr class="border-b border-slate-200 bg-slate-50/70 text-slate-500 font-bold uppercase tracking-wider">
                                        <th class="py-3.5 px-5">No</th>
                                        <th class="py-3.5 px-5">Nama Lengkap</th>
                                        <th class="py-3.5 px-5">NIK</th>
                                        <th class="py-3.5 px-5">Posisi &amp; Divisi</th>
                                        <th class="py-3.5 px-5">Akun Login App</th>
                                        <th class="py-3.5 px-5">Waktu Diterima</th>
                                        <th class="py-3.5 px-5 text-right">Berkas</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($acceptedEmployees as $emp)
                                        <tr class="hover:bg-slate-50/80 transition">
                                            <td class="py-3.5 px-5 text-slate-500">{{ $loop->iteration }}</td>
                                            <td class="py-3.5 px-5 font-bold text-slate-900">{{ $emp->full_name }}</td>
                                            <td class="py-3.5 px-5 font-mono text-slate-600">{{ $emp->nik }}</td>
                                            <td class="py-3.5 px-5">
                                                <span class="font-bold text-slate-900">{{ $emp->jobVacancy->title ?? '-' }}</span>
                                                <span class="text-slate-400 mx-1">&bull;</span>
                                                <span class="text-slate-600">{{ $emp->jobVacancy->division ?? '-' }}</span>
                                            </td>
                                            <td class="py-3.5 px-5 font-mono text-slate-700">{{ $emp->user->email ?? '-' }}</td>
                                            <td class="py-3.5 px-5 text-slate-500">{{ $emp->updated_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</td>
                                            <td class="py-3.5 px-5 text-right">
                                                <a href="{{ asset('storage/' . $emp->cv_path) }}" target="_blank" class="inline-flex items-center border border-slate-300 hover:border-slate-900 text-slate-800 font-bold px-3 py-1 rounded-full transition">
                                                    CV PDF
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </section>

            <!-- 2. DAFTAR SELURUH PELAMAR -->
            @php
                $statusBadge = [
                    'submitted' => 'bg-slate-100 text-slate-700 border-slate-300',
                    'screening' => 'bg-amber-50 text-amber-800 border-amber-300',
                    'interview' => 'bg-sky-50 text-[#1B6EC2] border-sky-300',
                    'accepted'  => 'bg-emerald-50 text-emerald-800 border-emerald-300',
                    'training'  => 'bg-emerald-50 text-emerald-800 border-emerald-300',
                    'graduated' => 'bg-emerald-100 text-emerald-900 border-emerald-400',
                    'rejected'  => 'bg-red-50 text-red-700 border-red-300',
                    'failed'    => 'bg-red-100 text-red-800 border-red-400',
                ];

                $statusText = [
                    'submitted' => 'Disubmit',
                    'screening' => 'Pengecekan HRD',
                    'interview' => 'Tahap Interview',
                    'accepted'  => 'Diterima (Pelatihan)',
                    'training'  => 'Diterima (Pelatihan)',
                    'graduated' => 'Lulus Pelatihan',
                    'rejected'  => 'Ditolak',
                    'failed'    => 'Gagal Pelatihan',
                ];
            @endphp

            <section>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pb-6 mb-6 border-b border-slate-200 items-end">
                    <div class="lg:col-span-7">
                        <p class="text-xs font-bold uppercase tracking-widest text-[#1B6EC2] mb-1.5">Database Kandidat</p>
                        <div class="flex flex-wrap items-center gap-3">
                            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Daftar Seluruh Pelamar</h2>
                            @if($statusFilter && $statusFilter !== 'all')
                                <span class="bg-slate-900 text-white text-[11px] font-bold px-3 py-1 rounded-full">
                                    Filter: {{ strtoupper($statusFilter) }}
                                </span>
                                <a href="{{ route('hrd.dashboard') }}" class="text-xs font-bold text-red-600 hover:underline">
                                    Reset Filter
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="lg:col-span-5 flex sm:justify-end">
                        <span class="inline-flex items-center bg-white border border-slate-300 text-slate-800 text-xs font-bold px-4 py-2 rounded-full">
                            {{ $applications->count() }} Data Ditampilkan
                        </span>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-2xs">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50/70 text-slate-500 font-bold uppercase tracking-wider">
                                    <th class="py-4 px-5">No</th>
                                    <th class="py-4 px-5">Identitas Pelamar</th>
                                    <th class="py-4 px-5">Formasi Dilamar</th>
                                    <th class="py-4 px-5">Status Seleksi</th>
                                    <th class="py-4 px-5 text-center">Dokumen</th>
                                    <th class="py-4 px-5 text-right">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($applications as $app)
                                    <tr class="hover:bg-slate-50/80 transition">
                                        <td class="py-4 px-5 text-slate-500 align-top">{{ $loop->iteration }}</td>
                                        <td class="py-4 px-5 align-top">
                                            <p class="font-extrabold text-slate-900 text-sm">{{ $app->full_name }}</p>
                                            <p class="text-slate-500 mt-0.5">NIK: {{ $app->nik }} &bull; HP: {{ $app->phone }}</p>
                                            <p class="text-slate-400">{{ $app->user->email ?? '-' }}</p>
                                        </td>
                                        <td class="py-4 px-5 align-top">
                                            <p class="font-bold text-slate-900">{{ $app->jobVacancy->title ?? '-' }}</p>
                                            <p class="text-slate-500 mt-0.5">Divisi {{ $app->jobVacancy->division ?? '-' }}</p>
                                        </td>
                                        <td class="py-4 px-5 align-top">
                                            <span class="inline-block border px-3 py-1 rounded-full font-bold {{ $statusBadge[$app->status] ?? 'bg-slate-100 text-slate-700 border-slate-300' }}">
                                                {{ $statusText[$app->status] ?? ucfirst($app->status) }}
                                            </span>
                                            <p class="text-[11px] text-slate-400 mt-1.5">
                                                Update: {{ $app->updated_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                                            </p>
                                            @if($app->status === 'rejected' && $app->rejection_reason)
                                                <p class="text-[11px] text-red-600 mt-1 max-w-xs leading-relaxed">
                                                    <strong>Alasan:</strong> {{ $app->rejection_reason }}
                                                </p>
                                            @endif
                                        </td>
                                        <td class="py-4 px-5 text-center align-top">
                                            <a href="{{ asset('storage/' . $app->cv_path) }}" target="_blank" class="inline-flex items-center border border-slate-300 hover:border-slate-900 text-slate-800 font-bold px-3.5 py-1.5 rounded-full transition">
                                                Buka CV
                                            </a>
                                        </td>
                                        <td class="py-4 px-5 text-right align-top">
                                            <button
                                                type="button"
                                                onclick="openStatusModal({{ $app->id }}, @js($app->full_name), @js($app->jobVacancy->title ?? '-'), @js(in_array($app->status, ['training', 'graduated']) ? 'accepted' : $app->status), @js($app->rejection_reason ?? ''))"
                                                class="bg-[#1B6EC2] hover:bg-[#15599E] text-white font-bold px-4 py-2 rounded-full transition">
                                                Proses Status
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-14 text-slate-500">
                                            Tidak ada data pelamar yang sesuai dengan filter saat ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </div>
    </main>

    <!-- MODAL PROSES STATUS HRD -->
    <div id="statusModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-xs" onclick="closeStatusModal()"></div>

        <div class="relative bg-white border border-slate-200 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
            <div class="bg-slate-950 text-white px-6 py-5 border-b border-slate-800 flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-[#38BDF8]">Keputusan Seleksi HRD</p>
                    <h3 id="modalApplicantName" class="text-base font-extrabold mt-0.5">Nama Pelamar</h3>
                    <p id="modalJobTitle" class="text-xs text-slate-400">Posisi</p>
                </div>
                <button type="button" onclick="closeStatusModal()" class="text-slate-400 hover:text-white p-1.5 rounded-lg hover:bg-white/10 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form id="statusForm" method="POST" action="" class="p-6 space-y-4 text-xs">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block font-bold text-slate-800 mb-1.5">Tahapan / Status Lamaran</label>
                    <select name="status" id="statusSelect" onchange="toggleRejectField()" class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-[#1B6EC2]">
                        <option value="submitted">1. Pendaftaran Disubmit</option>
                        <option value="screening">2. Proses Pengecekan oleh HRD</option>
                        <option value="interview">3. Lolos Berkas — Tahap Interview</option>
                        <option value="accepted">4. Diterima Menjadi Karyawan (Langsung Pelatihan)</option>
                        <option value="rejected">Tolak Lamaran (Wajib Isi Alasan)</option>
                    </select>
                </div>

                <div id="rejectReasonBox" class="hidden bg-red-50 border border-red-200 rounded-xl p-4">
                    <label class="block font-bold text-red-900 mb-1.5">Alasan Penolakan *</label>
                    <textarea name="rejection_reason" id="rejectionReasonInput" rows="3" placeholder="Tuliskan alasan penolakan secara jelas..." class="w-full border border-red-300 bg-white rounded-lg px-3 py-2 text-sm text-slate-900 focus:outline-none"></textarea>
                </div>

                <div id="notesBox">
                    <label class="block font-bold text-slate-800 mb-1.5">Catatan Keterangan (Opsional)</label>
                    <textarea name="notes" rows="2" placeholder="Contoh: Jadwal interview Senin pukul 09:00 WIB." class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-[#1B6EC2]"></textarea>
                </div>

                <div class="pt-4 border-t border-slate-200 flex justify-end gap-2.5">
                    <button type="button" onclick="closeStatusModal()" class="px-5 py-2.5 font-bold text-slate-700 border border-slate-300 hover:border-slate-900 rounded-full transition">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 font-bold text-white bg-[#1B6EC2] hover:bg-[#15599E] rounded-full transition">
                        Simpan Status
                    </button>
                </div>
            </form>
        </div>
    </div>

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

    <script>
        function openStatusModal(id, name, jobTitle, currentStatus, rejectionReason) {
            const form = document.getElementById('statusForm');
            form.action = `/hrd/applications/${id}/status`;

            document.getElementById('modalApplicantName').innerText = name;
            document.getElementById('modalJobTitle').innerText = jobTitle;
            document.getElementById('statusSelect').value = currentStatus;
            document.getElementById('rejectionReasonInput').value = rejectionReason || '';

            toggleRejectField();
            document.getElementById('statusModal').classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }

        function toggleRejectField() {
            const status = document.getElementById('statusSelect').value;
            const rejectBox = document.getElementById('rejectReasonBox');
            const rejectInput = document.getElementById('rejectionReasonInput');
            const notesBox = document.getElementById('notesBox');

            if (status === 'rejected') {
                rejectBox.classList.remove('hidden');
                rejectInput.setAttribute('required', 'required');
                notesBox.classList.add('hidden');
            } else {
                rejectBox.classList.add('hidden');
                rejectInput.removeAttribute('required');
                notesBox.classList.remove('hidden');
            }
        }
    </script>

</body>
</html>