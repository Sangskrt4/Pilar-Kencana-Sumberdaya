<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrdApplicationController extends Controller
{
    public function updateStatus(Request $request,$id)
    {
        if (Auth::user()->role !== 'hrd') {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'status' => 'required|in:submitted,screening,interview,accepted,rejected',
            'notes' => 'nullable|string|max:1000',
            'rejection_reason' => 'required_if:status,rejected|nullable|string|max:1000',
        ], [
            'rejection_reason.required_if' => 'Alasan penolakan wajib diisi jika status Ditolak.',
        ]);

        $application = Application::with('jobVacancy', 'user')->findOrFail($id);

        $application->update([
            'status' => $request->status,
            'rejection_reason' => $request->status === 'rejected' ?$request->rejection_reason : null,
        ]);

        $division =$application->jobVacancy->division ?? 'Terkait';

        ApplicationLog::create([
            'application_id' => $application->id,
            'status' => $request->status,
            'notes' => $request->status === 'rejected'
                ? $request->rejection_reason
                : ($request->notes ?: $this->defaultNote($request->status,$division)),
        ]);

        // Begitu diterima menjadi karyawan -> role langsung berubah ke 'karyawan' & langsung masuk pelatihan divisi
        if ($request->status === 'accepted' && $application->user) {$application->user->update(['role' => 'karyawan']);
        }

        return back()->with('success', 'Status lamaran berhasil diperbarui!');
    }

    private function defaultNote(string $status, string$division): string
    {
        return match ($status) {
            'submitted' => 'Pendaftaran telah disubmit oleh pelamar.',
            'screening' => 'Berkas lamaran sedang dalam proses pengecekan oleh HRD.',
            'interview' => 'Pelamar lolos seleksi berkas dan dijadwalkan untuk tahap Interview.',
            'accepted'  => "Selamat! Anda diterima menjadi karyawan PT Pilar Kencana Sumberdaya dan otomatis diarahkan ke Pelatihan Divisi {$division}.",
            default     => 'Status diperbarui oleh HRD.',
        };
    }
}