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
            ],
            'type' => $this->faker->randomElement(array_keys(WorkProgramService::getTypes())),
            'user_id' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
