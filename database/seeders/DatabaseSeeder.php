<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'asd@asd.asd',
            'email' => 'asd@asd.asd',
            'password' => 'asd@asd.asd',
        ]);
        User::factory(10)->create();

        $this->call([
            WorkProgramSeeder::class
        ]);
    }
}
