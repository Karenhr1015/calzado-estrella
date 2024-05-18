<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\User;
use App\Models\Role;
use App\Models\Season;
use App\Models\Size;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* Roles Principales */
        Role::factory()->create([
            'name' => 'Administrador',
        ]);
        Role::factory()->create([
            'name' => 'Cliente Natural',
        ]);
        Role::factory()->create([
            'name' => 'Mayorista',
        ]);
        
        /* Usuario Admin */
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'role_id' => 1,
        ]);

       
        User::factory(15)->create();
        
        /* Gestionar Catalogo */
        Color::factory(10)->create();
        Size::factory(10)->create();

        /* Temporadas */
        Season::factory()->create([
            'name' => 'Dia de la Madre',
        ]);
        Season::factory()->create([
            'name' => 'Dia del Niño',
        ]);
        Season::factory()->create([
            'name' => 'Dia del Padre',
        ]);
    }
}
