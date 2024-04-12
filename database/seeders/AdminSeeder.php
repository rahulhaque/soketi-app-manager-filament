<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $jsonString = File::get(base_path('docker/config/defaultUsers.json'));
        $users = json_decode($jsonString, true);
        Log::info("message");
        dd($users);
        // User::updateOrCreate([]);
    }
}
