<!DOCTYPE html>
<html lang="id">
<head>
    <title>Buat Lowongan - HRD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-50 p-8">
    <div class="max-w-3xl mx-auto bg-white p-8 border border-slate-200 shadow-sm mt-10">
        <h2 class="text-2xl font-extrabold text-slate-900 mb-6 border-b pb-4">Buat Lowongan Baru</h2>
        
        <form action="{{ route('hrd.vacancies.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nama Posisi</label>
                <input type="text" name="title" required class="w-full border p-3 rounded text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Divisi</label>
                <input type="text" name="division" required class="w-full border p-3 rounded text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Kuota</label>
                <input type="number" name="quota" value="1" min="1" required class="w-full border p-3 rounded text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Deskripsi</label>
                <textarea name="description" rows="3" required class="w-full border p-3 rounded text-sm"></textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Persyaratan</label>
                <textarea name="requirements" rows="4" required class="w-full border p-3 rounded text-sm" placeholder="Pisahkan dengan enter (baris baru)"></textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Prospek Karir (Opsional)</label>
                <textarea name="prospects" rows="2" class="w-full border p-3 rounded text-sm"></textarea>
            </div>
            <div class="flex items-center gap-2 mt-4">
                <input type="checkbox" name="is_open" id="is_open" value="1" class="w-5 h-5">
                <label for="is_open" class="text-sm font-bold text-slate-800">Buka pendaftaran langsung (Status: Sedang Dibutuhkan)</label>
            </div>
            
            <div class="pt-6 border-t flex gap-4">
                <button type="submit" class="bg-slate-900 text-white font-bold px-6 py-3 rounded text-sm uppercase">Simpan Lowongan</button>
                <a href="{{ route('hrd.vacancies.index') }}" class="bg-gray-200 text-gray-700 font-bold px-6 py-3 rounded text-sm uppercase">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>