<?php

namespace Database\Seeders; // Seeder của model User

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // điều kiện tìm
            [
                'first_name' => 'Super',
                'last_name'  => 'Admin',
                'username'   => 'superadmin',
                'password'   => 'secret123',   // mutator băm password
                'is_admin'   => 1,
                'is_active'  => 1,
            ]
        );
    }
}
