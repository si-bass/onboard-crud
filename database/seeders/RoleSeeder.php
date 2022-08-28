<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Role::create([
                'name' => fake()->unique()->word(),
                'display_name' => fake()->unique()->jobTitle(),
                'description' => fake()->text(),
            ]);
        }
    }
}
