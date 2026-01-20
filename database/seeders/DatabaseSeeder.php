<?php

namespace Database\Seeders;

use App\Models\PooEntry;
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
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Generate poo entries for this user
        PooEntry::factory()
            ->count(50)
            ->for($user)
            ->create();
    }
}
