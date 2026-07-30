<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user for Filament (Phase 2)
        User::factory()->create([
            'name' => 'Blog Admin',
            'email' => 'admin@blog.com',
        ]);

        // Seed application data
        $this->call([
            NewsPostSeeder::class,
        ]);
    }
}
