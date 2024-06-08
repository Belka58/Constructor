<?php

namespace App\Http\Controllers;

use App\Integration\Convertors\Pdf\PdfConversionContract;
use App\Integration\Convertors\Word\WordConversionContract;
use App\Models\WorkProgram;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\StreamedResponse;

class WorkProgramController extends Controller
{

    public function showById(WorkProgram $wk): WorkProgram
    {
        return $wk;
    }
    public function show(string $type): Collection|array
    {
        if ($type <= 0 || $type > 4) {
            throw new \RuntimeException('type must be 0-4');
        }

        return WorkProgram::query()
            ->where('publish', 1)
            ->where('type', $type)
            ->get();
    }

    public function download(WorkProgram $program, string $type): StreamedResponse
    {
        $this->autorizable($program, $program->publish !== 1);

        if ($type === 'pdf') {
            $contract = app(PdfConversionContract::class);
        } else {
            $contract = app(WordConversionContract::class);
        }

        return response()->streamDownload(function () use ($contract, $program, $type) {
            $key = "$type:$program->id";
            /**  @var PdfConversionContract|WordConversionContract $contract */
            if (!Cache::has($key)) {
                $file = tmpfile();
                fwrite($file, Blade::render('work-program', $program->content));
                Cache::put($key, $contract->convert("$program->id.$type", $file));
            }

            echo Cache::get($key);
        });
    }

    public function destroy(WorkProgram $wk): void
    {
        $this->autorizable($wk);
        $wk->delete();
    }

    public function create(Request $request): void
    {
        WorkProgram::create($request->all());
    }

    public function update(WorkProgram $wk, Request $request): void
    {
        $wk->update($request->all());
    }

    protected function autorizable(WorkProgram $wk, bool $when = true): void
    {
        if (Auth::id() !== $wk->user_id && $when) {
            abort(403);
        }
    }
}
