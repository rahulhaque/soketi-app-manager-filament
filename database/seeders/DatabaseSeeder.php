<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(['id' => 1], [
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('password'), // password
            'is_active' => true,
            'is_admin' => true,
            'created_by' => 1,
        ]);
    }
}
