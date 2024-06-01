<?php

namespace App\Services\WorkProgram;

class WorkProgramService implements WorkProgramServiceContract
{

    public static function getTypes(): array
    {
        return [
            1 => 'Начальное общее образование',
            2 => 'Основное общее образование',
            3 => 'Среднее общее образование',
            4 => 'Внеурочная деятельность',
        ];
    }
}
