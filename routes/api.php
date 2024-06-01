<?php

use App\Http\Controllers\WorkProgramController;
use Illuminate\Support\Facades\Route;

Route::controller(WorkProgramController::class)
    ->prefix('work-program')
    ->group(function () {
        Route::get('/{type}', 'show');
    });
