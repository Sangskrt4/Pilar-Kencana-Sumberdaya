<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\TrainingModule;

// 1. Login Mobile & Generate Sanctum Token
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah.',
        ], 401);
    }

    $token = $user->createToken('pks-mobile')->plainTextToken;

    return response()->json([
        'success' => true,
        'token'   => $token,
        'user'    => $user,
    ]);
});

// 2. Protected Routes (Wajib Bearer Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());

    // Ambil Profil, Ringkasan Progres, dan Daftar Modul Pelatihan
    Route::get('/training/modules', function (Request $request) {
        $user = $request->user();
        $application = method_exists($user, 'applications')
            ? $user->applications()->with('jobVacancy')->latest()->first()
            : null;

        $division = $application->jobVacancy->division ?? $user->division ?? 'Produksi';
        $position = $application->jobVacancy->title ?? $user->position ?? 'Peserta Pelatihan';
        $nik      = $application->nik ?? $user->nik ?? '-';

        $query = TrainingModule::query();
        if (Schema::hasColumn('training_modules', 'division')) {
            $query->where(function ($q) use ($division) {
                $q->where('division', $division)->orWhereNull('division');
            });
        }
        $rawModules = Schema::hasColumn('training_modules', 'order_number')
            ? $query->orderBy('order_number')->get()
            : $query->orderBy('id')->get();

        $completedIds = [];
        if (method_exists($user, 'trainingProgress')) {
            $completedIds = $user->trainingProgress()
                ->where('is_completed', true)
                ->pluck('quiz_score', 'training_module_id')
                ->toArray();
        }

        $modules = $rawModules->values()->map(function ($mod, $index) use ($completedIds, $division) {
            $isCompleted = array_key_exists($mod->id, $completedIds);
            return [
                'id'             => $mod->id,
                'order_number'   => $mod->order_number ?? ($index + 1),
                'division'       => $mod->division ?? $division,
                'duration'       => $mod->duration ?? '15 Menit',
                'title'          => $mod->title ?? 'Modul Pelatihan K3',
                'summary'        => $mod->summary ?? $mod->description ?? '',
                'content'        => $mod->content ?? $mod->description ?? '',
                'quiz_questions' => is_string($mod->quiz_questions ?? null)
                    ? json_decode($mod->quiz_questions, true)
                    : ($mod->quiz_questions ?? []),
                'is_completed'   => $isCompleted,
                'quiz_score'     => $isCompleted ? $completedIds[$mod->id] : null,
            ];
        });

        $total     = $modules->count();
        $completed = $modules->where('is_completed', true)->count();
        $percent   = $total > 0 ? (int) round(($completed / $total) * 100) : 0;

        return response()->json([
            'success' => true,
            'profile' => [
                'name'     => $user->name,
                'email'    => $user->email,
                'nik'      => $nik,
                'division' => $division,
                'position' => $position,
            ],
            'summary' => [
                'total_modules'     => $total,
                'completed_modules' => $completed,
                'percentage'        => $percent,
                'is_graduated'      => $total > 0 && $completed >= $total,
            ],
            'modules' => $modules,
        ]);
    });

    // Tandai Modul Selesai & Simpan Skor Kuis
    Route::post('/training/modules/{id}/complete', function (Request $request, $id) {
        $user  = $request->user();
        $score = (int) $request->input('quiz_score', 100);

        if (method_exists($user, 'trainingProgress')) {
            $user->trainingProgress()->updateOrCreate(
                ['training_module_id' => $id],
                ['is_completed' => true, 'quiz_score' => $score]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Progres modul berhasil disimpan.',
        ]);
    });

    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success' => true, 'message' => 'Logged out']);
    });
});