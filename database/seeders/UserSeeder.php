<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $responsableRole = Role::where('name', 'responsable')->first();
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'nom' => "Responsable $i",
                "prenom"=> "Prenom $i",
                'email' => "resp$i@example.com",
                'password' => Hash::make('password'),
                'role_id' => $responsableRole->id,
            ]);
        }

        $profRole = Role::where('name', 'professeur')->first();
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'nom' => "Professeur $i",
                "prenom"=> "Prenom $i",
                'email' => "prof$i@example.com",
                'password' => Hash::make('password'),
                'role_id' => $profRole->id,
            ]);
        }
    }
    
}
