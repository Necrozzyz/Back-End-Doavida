<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Lista de roles para serem adicionadas
        $roles = ['admin', 'receptor', 'doador'];

        foreach ($roles as $roleName) {
            // Utiliza firstOrCreate para evitar a tentativa de duplicação
            Role::firstOrCreate(
                ['name' => $roleName], // Condição para busca
                ['created_at' => now(), 'updated_at' => now()] // Valores adicionais, se necessário
            );
        }

        $this->command->info('Roles foram verificadas e populadas com sucesso.');
    }
}
