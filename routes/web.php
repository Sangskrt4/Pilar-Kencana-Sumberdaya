<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\JobVacancy;
use App\Models\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\JobVacancyController;
use App\Http\Controllers\Admin\HrdApplicationController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('landing');
})->name('landing');

// Pengaman Logout (GET maupun POST tetap logout & langsung mental ke landing page)
Route::match(['get', 'post'], '/keluar', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('landing');
})->name('keluar.aman');

Route::get('/karir', function () {
    $vacancies = JobVacancy::orderBy('id')->get()->unique('title');
    return view('karir', compact('vacancies'));
})->name('karir');

// LAMARAN PELAMAR
Route::get('/lamar/{id}', function ($id) {
    $job = JobVacancy::findOrFail($id);
    return view('lamar', compact('job'));
})->middleware('auth')->name('lamar');

Route::post('/lamar/{id}', [ApplicationController::class, 'store'])->middleware('auth')->name('lamar.store');

// DASHBOARD USER / KARYAWAN BARU
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'hrd') {
        return redirect()->route('hrd.dashboard');
    }

    $applications = Application::with(['jobVacancy', 'logs' => function ($q) {
        $q->latest();
    }])->where('user_id', Auth::id())->latest()->get();

    // Cek apakah ada lamaran yang sudah diterima menjadi karyawan
    $acceptedApp = $applications->whereIn('status', ['accepted', 'training', 'graduated'])->first();

    return view('dashboard', compact('applications', 'acceptedApp'));
})->middleware(['auth'])->name('dashboard');

// GRUP ROUTE HRD
Route::middleware(['auth'])->prefix('hrd')->name('hrd.')->group(function () {
    
    Route::get('/dashboard', function () {
        if (Auth::user()->role !== 'hrd') abort(403, 'Akses ditolak.');

        $statusFilter = request('filter');

        $query = Application::with(['user', 'jobVacancy', 'logs' => function ($q) {
            $q->latest();
        }])->latest();

        if ($statusFilter && $statusFilter !== 'all') {
            if ($statusFilter === 'accepted') {
                $query->whereIn('status', ['accepted', 'training', 'graduated']);
            } elseif ($statusFilter === 'process') {
                $query->whereIn('status', ['submitted', 'screening', 'interview']);
            } else {
                $query->where('status', $statusFilter);
            }
        }

        $applications = $query->get();

        // Data TrackStats untuk HRD
        $stats = [
            'total'     => Application::count(),
            'submitted' => Application::where('status', 'submitted')->count(),
            'screening' => Application::where('status', 'screening')->count(),
            'interview' => Application::where('status', 'interview')->count(),
            'accepted'  => Application::whereIn('status', ['accepted', 'training', 'graduated'])->count(),
            'rejected'  => Application::where('status', 'rejected')->count(),
        ];

        $acceptedEmployees = Application::with('user', 'jobVacancy')
            ->whereIn('status', ['accepted', 'training', 'graduated'])
            ->latest()
            ->get();

        return view('hrd.dashboard', compact('applications', 'stats', 'acceptedEmployees', 'statusFilter'));
    })->name('dashboard');

    Route::patch('/applications/{id}/status', [HrdApplicationController::class, 'updateStatus'])->name('applications.updateStatus');

    Route::resource('vacancies', JobVacancyController::class);
});

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';