<?php

namespace Database\Factories;

use App\Services\WorkProgram\WorkProgramService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkProgram>
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
            'content' => $this->faker->randomHtml,
            'type' => $this->faker->randomElement(array_keys(WorkProgramService::getTypes()))
        ];
    }
}
