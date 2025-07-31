<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create(); test seed thử 10 user

        User::factory()->create([
            'first_name' => 'Test',
            'last_name'  => 'User',
            'username'   => 'testuser',
            'email'      => 'test@example.com',
        ]);
    
        $this->call(AdminSeeder::class); // Gọi seeder của User
    }
}
