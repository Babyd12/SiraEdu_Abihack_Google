<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            Classe::create([
                'nom' => "Classe $i",
            ]);
        }
    }
}
