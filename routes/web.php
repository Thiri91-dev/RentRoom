<?php

use App\Http\Controllers\HouseController;
use App\Http\Controllers\Auth\MemberAuthController;
use Illuminate\Support\Facades\Route;

// ── Home: redirect to house listing ──────────────────────────────
Route::get('/', fn() => redirect()->route('houses.index'));

// ── Auth Routes ───────────────────────────────────────────────────
Route::get('/register', [MemberAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [MemberAuthController::class, 'register']);

Route::get('/login', [MemberAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [MemberAuthController::class, 'login']);
Route::post('/logout', [MemberAuthController::class, 'logout'])->name('logout');

// ── Public: anyone can VIEW houses ───────────────────────────────
Route::get('/houses', [HouseController::class, 'index'])->name('houses.index');
Route::get('/houses/{house}', [HouseController::class, 'show'])->name('houses.show');

// ── Protected: must be logged in to CREATE / EDIT / DELETE ───────
Route::middleware('auth')->group(function () {
    Route::get('/houses/create', [HouseController::class, 'create'])->name('houses.create');
    Route::post('/houses', [HouseController::class, 'store'])->name('houses.store');
    Route::get('/houses/{house}/edit', [HouseController::class, 'edit'])->name('houses.edit');
    Route::put('/houses/{house}', [HouseController::class, 'update'])->name('houses.update');
    Route::delete('/houses/{house}', [HouseController::class, 'destroy'])->name('houses.destroy');
});
