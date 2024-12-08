<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class ReceptorSeeder extends Seeder
{
    public function run()
    {
        // Cria o usuário receptor
        User::create([
            'username' => 'receptor',
            'email' => 'receptor@teste.com',
            'password' => Hash::make('Senha@123456'),
            'role' => 'receptor',
            'role_id' => 2,
        ]);

        $this->command->info("Usuário receptor criado com sucesso.");
    }
}
