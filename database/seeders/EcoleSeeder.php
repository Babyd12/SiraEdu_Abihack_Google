<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ecole;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EcoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $responsables = User::whereHas('role', fn($q) => $q->where('name', 'responsable'))->get();

        foreach ($responsables as $index => $user) {
            Ecole::create([
                'nom' => "Ecole " . chr(65 + $index),
                'user_id' => $user->id,
            ]);
        }
    }
}
