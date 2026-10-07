<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\ServiceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/servicios', [ServiceController::class, 'index'])
        ->name('services.index');

    Route::get('/servicios/crear', [ServiceController::class, 'create'])
        ->name('services.create');

    Route::post('/servicios', [ServiceController::class, 'store'])
        ->name('services.store');

    Route::get('/servicios/{service}/editar', [ServiceController::class, 'edit'])
        ->name('services.edit');

    Route::put('/servicios/{service}', [ServiceController::class, 'update'])
        ->name('services.update');

    Route::delete('/servicios/{service}', [ServiceController::class, 'destroy'])
        ->name('services.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/establecimiento', [EstablishmentController::class, 'edit'])
        ->name('establishment.edit');

    Route::put('/establecimiento', [EstablishmentController::class, 'update'])
        ->name('establishment.update');
});

require __DIR__ . '/auth.php';
