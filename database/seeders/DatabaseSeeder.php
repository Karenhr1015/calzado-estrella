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
            'email' => 'prueba@calzadoestrella.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'role_id' => 1,
        ]);

       
        User::factory(15)->create();
        
        /* Gestionar Catalogo */
    
        Color::factory()->create([
            'color' => 'Rojo',
            'color_hex' => '#FF0000',
        ]);
        Color::factory()->create([
            'color' => 'Verde',
            'color_hex' => '#00FF00',
        ]);
        Color::factory()->create([
            'color' => 'Azul',
            'color_hex' => '#0000FF',
        ]);
        Color::factory()->create([
            'color' => 'Amarillo',
            'color_hex' => '#FFFF00',
        ]);
        Color::factory()->create([
            'color' => 'Negro',
            'color_hex' => '#000000',
        ]);

        // Size::factory(10)->create();
        Size::factory()->create([
            'value' => '35',
        ]);
        Size::factory()->create([
            'value' => '44',
        ]);

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
