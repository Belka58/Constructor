<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\WorkProgram;
use App\Services\WorkProgram\WorkProgramService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WorkProgram>
 */
class WorkProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => $this->faker->text,
            'publish' => $this->faker->boolean,
            'content' => [
                'header' => 'Комитет образования, науки и молодежной политики Волгоградской области 111 11231 124124 1241 ',
                'workProgramName' => 'Основы алгоритмизации и программирования 111',
                'specialnost' => ' 09.02.07 Информационные системы и программирование 1',
                'curse' => '2,4',
                'orgRazrab' => 'государственное бюджетное профессиональное образовательное учреждение «Волжский политехнический техникум» (ГБ ПОУ «ВПТ»).1',
                'razrabi' => [
                    'Дмитриев Алексей Андреевич – преподаватель ГБ ПОУ «ВПТ»',
                ],
                'rechesents' => [
                    'Дмитриев Алексей Андреевич – преподаватель ГБ ПОУ «ВПТ»',
                ],
            ],
            'type' => $this->faker->randomElement(array_keys(WorkProgramService::getTypes())),
            'user_id' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
