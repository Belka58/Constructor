<?php

namespace App\Http\Controllers;

use App\Models\WorkProgram;
use Illuminate\Database\Eloquent\Collection;

class WorkProgramController extends Controller
{
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
}
