<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ClasseEcole;
use App\Models\ProfClasseEcole;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfClasseEcoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profs = User::whereHas('role', fn($q) => $q->where('name', 'professeur'))->get();
        $classeEcoles = ClasseEcole::all();

        foreach ($profs as $prof) {
            foreach ($classeEcoles->random(2) as $classeEcole) {
                ProfClasseEcole::create([
                    'user_id' => $prof->id,
                    'classe_ecole_id' => $classeEcole->id,
                ]);
            }
        }
    }
}
