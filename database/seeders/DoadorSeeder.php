<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class DoadorSeeder extends Seeder
{
    public function run()
    {
        // Cria o usuário doador
        User::create([
            'username' => 'doador',
            'email' => 'doador@teste.com',
            'password' => Hash::make('Senha@123456'),
            'role' => 'doador',
            'role_id' => 3,
        ]);

        $this->command->info("Usuário doador criado com sucesso.");
    }
}
