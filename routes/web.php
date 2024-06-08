<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkProgramController;
use App\Models\WorkProgram;
use App\Services\WorkProgram\WorkProgramServiceContract;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/types', static function (WorkProgramServiceContract $contract) {
    return $contract->getTypes();
});

Route::get('/', static function (WorkProgramServiceContract $contract) {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'types' => $contract->getTypes(),
    ]);
})->name('main');

Route::controller(WorkProgramController::class)
    ->name('wk.')
    ->prefix('work-program')
    ->group(function () {
        Route::get('/wk/{wk}', 'showById')->name('id-by-show');
        Route::get('/{type}', 'show');
        Route::get('/{program}/download/{type}', 'download');
        Route::delete('/{wk}', 'destroy')->name('destroy');
        Route::patch('/{wk}', 'update')->name('update');
        Route::post('', 'create')->name('create');
    });


Route::get('/constructor', static function () {
    return Inertia::render('Constructor');
})->middleware(['auth', 'verified'])->name('constructor');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'wks' => WorkProgram::query()->where('user_id', Auth::id())->get()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
