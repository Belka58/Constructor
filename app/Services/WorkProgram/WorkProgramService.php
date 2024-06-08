<?php

namespace App\Services\WorkProgram;

class WorkProgramService implements WorkProgramServiceContract
{

    public static function getTypes(): array
    {
        return [
            1 => 'МДК',
            2 => 'ПП',
            3 => 'УП',
        ];
    }
}
