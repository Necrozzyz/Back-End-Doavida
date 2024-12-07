<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@doavida.com',
            'password' => Hash::make('password123'), // Altere para a senha que desejar
            'role' => 'admin',
        ]);
    }
}
