<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkProgramController;
use App\Models\WorkProgram;
use App\Services\WorkProgram\WorkProgramServiceContract;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', static function (WorkProgramServiceContract $contract) {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'types' => $contract->getTypes(),
    ]);
});

Route::controller(WorkProgramController::class)
    ->prefix('work-program')
    ->group(function () {
        Route::get('/{type}', 'show');
        Route::get('/{program}/download/{type}', 'download');
    });


Route::get('/constructor', static function () {
    return Inertia::render('Constructor');
})->middleware(['auth', 'verified'])->name('constructor');

Route::get('/wk', function () {
    return Blade::render('work-program', [
        'header' => 'Комитет образования, науки и молодежной политики Волгоградской области 111 11231 124124 1241 ',
        'workProgramName' => 'Основы алгоритмизации и программирования 111',
        'specialnost' => ' 09.02.07 Информационные системы и программирование 1',
        'curse' => '2,4',
        'orgRazrab' => 'государственное бюджетное профессиональное образовательное учреждение «Волжский политехнический техникум» (ГБ ПОУ «ВПТ»).1',
        'razrabi' => [
            'Дмитриев Алексей Андреевич – преподаватель ГБ ПОУ «ВПТ»',
            'хуесос'
        ],
        'rechesents' => [
            'Дмитриев Алексей Андреевич – преподаватель ГБ ПОУ «ВПТ»',
            'хуесос'
        ],
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
