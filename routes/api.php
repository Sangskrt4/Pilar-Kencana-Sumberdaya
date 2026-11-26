<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\TrainingModule;

// Login Mobile & Generate Sanctum Token
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Email atau password salah.',
        ], 401);
    }

    $token = $user->createToken('pks-mobile')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user'  => $user,
    ]);
});

// Protected Routes (Wajib Bearer Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());

    Route::get('/training-modules', function () {
        return response()->json([
            'data' => TrainingModule::orderBy('id')->get(),
        ]);
    });

    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    });
});