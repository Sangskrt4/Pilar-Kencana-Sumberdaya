<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ApplicationLog;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function store(Request $request, $id)
    {
        // Cek apakah user sudah pernah melamar posisi ini (selain yang ditolak)
        $existing = Application::where('user_id', Auth::id())
            ->where('job_vacancy_id', $id)
            ->where('status', '!=', 'rejected')
            ->first();

        if ($existing) {
            return redirect()->route('dashboard')->with('error', 'Anda sudah mengirimkan lamaran untuk posisi ini.');
        }

        // 1. Validasi Input
        $request->validate([
            'nik' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'cv' => 'required|mimes:pdf|max:2048',
        ]);

        // 2. Upload File CV ke folder storage/app/public/cv
        $cvPath = $request->file('cv')->store('cv', 'public');

        // 3. Simpan ke Database & tampung ke variabel $application
        $application = Application::create([
            'user_id' => Auth::id(),
            'job_vacancy_id' => $id,
            'full_name' => Auth::user()->name,
            'nik' => $request->nik,
            'phone' => $request->phone,
            'address' => $request->address,
            'cv_path' => $cvPath,
            'status' => 'submitted',
        ]);

        // 4. Catat riwayat awal ke application_logs
        ApplicationLog::create([
            'application_id' => $application->id,
            'status' => 'submitted',
            'notes' => 'Pendaftaran telah disubmit dan menunggu pengecekan oleh HRD.',
        ]);

        // 5. Redirect balik ke Dashboard
        return redirect()->route('dashboard')->with('success', 'Lamaran berhasil dikirim!');
    }
}