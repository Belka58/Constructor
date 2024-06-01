<?php

namespace App\Providers;

use App\Integration\Convertors\Word\WordConversionContract;
use App\Integration\Convertors\Word\WordConversionService;
use App\Services\WorkProgram\WorkProgramService;
use App\Services\WorkProgram\WorkProgramServiceContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(WorkProgramServiceContract::class, function () {
            return new WorkProgramService();
        });

        $this->app->singleton(WordConversionContract::class, function () {
            return new WordConversionService();
        });
    }

    public function boot(): void
    {
        //
    }
}
