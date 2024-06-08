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

Route::get('/test', static function () {
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
        'table' => [
            'compotensy' => 'ОК 1, ОК 2, ОК 4, ОК 5, ОК 9, ОК 10; ПК 1.1-1.5, ПК 2.4, ПК 2.5.',
            'samostoylka' => '9',
            'reshenie_zadas' => '7',
            'otchet' => '2',
            'insult' => 0,
            'attectacia' => 8,
            'razdels' => [
                [
                    'name' => ' Основы программирования на языке C#.',
                    'themes' => [
                       [
                           'name' => 'Основы программирования на языке C#',
                           'lessons' => [
                               [
                                   'name' => 'Алгоритм',
                                   'osvoen' => 2,
                                   'hours' => 2
                               ],
                               [
                                   'name' => 'Типы данных.',
                                   'osvoen' => 3,
                                   'hours' => 4
                               ],
                           ],
                           'practika' => [
                               [
                                   'name' => 'Разработка линейных алгоритмов',
                                   'hours' => 40
                               ],
                               [
                                   'name' => 'Разработка линейных алгоритмов',
                                   'hours' => 20
                               ],
                           ]
                       ]
                    ]
                ],
                [
                    'name' => ' Основы программирования на языке C#.',
                    'themes' => [
                       [
                           'name' => 'Основы программирования на языке C#',
                           'lessons' => [
                               [
                                   'name' => 'Алгоритм',
                                   'osvoen' => 2,
                                   'hours' => 2
                               ],
                               [
                                   'name' => 'Типы данных.',
                                   'osvoen' => 3,
                                   'hours' => 4
                               ],
                           ],
                           'practika' => [
                               [
                                   'name' => 'Разработка линейных алгоритмов',
                                   'hours' => 40
                               ],
                               [
                                   'name' => 'Разработка линейных алгоритмов',
                                   'hours' => 20
                               ],
                           ]
                       ]
                    ]
                ],
            ],
        ]
    ]);
});

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
