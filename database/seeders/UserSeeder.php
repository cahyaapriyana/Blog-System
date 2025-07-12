<?php

namespace Database\Seeders;

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
        // Create admin user
        User::create([
            'name' => "Cahya Apriyana",
            'username' => 'cahyaapriyana',
            'email' => 'cahya@codemind.id',
            'password' => Hash::make('password123'),
        ]);

        // Create additional users without factory
        User::create([
            'name' => "John Doe",
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => "Jane Smith",
            'username' => 'janesmith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
