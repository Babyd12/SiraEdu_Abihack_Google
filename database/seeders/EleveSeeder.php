<?php

namespace Database\Seeders;

use App\Models\Eleve;
use App\Models\Classe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EleveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = Classe::all();

        foreach ($classes as $classe) {
            for ($i = 1; $i <= 3; $i++) {
                Eleve::create([
                    'nom' => "Élève $i",
                    'prenom' => "Prenom $i",
                    "email"=> "eleve$i@example.com",
                    "password"=> Hash::make('password'),
                    'classe_id' => $classe->id,
                ]);
            }
        }
    }
}
