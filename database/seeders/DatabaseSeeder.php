<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Razenry',
            'photo' => 'razenry@gmail.com',
            'email' => 'razenry@gmail.com',
            'status' => '1',
            'password' => Hash::make('razenry'),
            'role'=> 'Admin'
        ]);
        // User::factory()->create([
        //     'name' => 'Rils',
        //     'email' => 'rils@gmail.com',
        //     'password' => Hash::make('rils'),
        //     'role'=> 'Officer'
        // ]);
    }
}
