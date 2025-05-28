<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'email' => 'admin@azzahhafi.com',
            'password' => Hash::make('Admin@azzahhafi@2025'),
            'access_code' => 'azzahhafi@2025@',
        ]);
    }
}
