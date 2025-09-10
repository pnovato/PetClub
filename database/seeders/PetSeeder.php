<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        // 12 pets fictícios
        Pet::factory()->count(12)->create();
    }
}
