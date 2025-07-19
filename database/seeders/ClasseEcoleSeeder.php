<?php

namespace Database\Seeders;

use App\Models\Ecole;
use App\Models\Classe;
use App\Models\ClasseEcole;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClasseEcoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = Classe::all();
        $ecoles = Ecole::all();

        foreach ($ecoles as $ecole) {
            foreach ($classes as $classe) {
                ClasseEcole::create([
                    'classe_id' => $classe->id,
                    'ecole_id' => $ecole->id,
                ]);
            }
        }
    }
}
