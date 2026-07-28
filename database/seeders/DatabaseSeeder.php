<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the application's database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@tienda.com'], [
            'name' => 'Admin',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        User::updateOrCreate(['email' => 'cliente1@email.com'], [
            'name' => 'Cliente 1',
            'password' => Hash::make('password123'),
            'role' => 'cliente',
        ]);

        User::updateOrCreate(['email' => 'cliente2@email.com'], [
            'name' => 'Cliente 2',
            'password' => Hash::make('password456'),
            'role' => 'cliente',
        ]);

        // 🗂 Ejecutar otros seeders
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
