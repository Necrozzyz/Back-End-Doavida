<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Cria o usuário administrador
        User::create([
            'username' => 'admin',
            'email' => 'admin@teste.com',
            'password' => Hash::make('Senha@123456'),
            'role' => 'admin',
            'role_id' => 1,
        ]);

        $this->command->info("Usuário administrador criado com sucesso.");
    }
}
