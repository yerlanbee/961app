<?php

namespace Database\Seeders;

use App\Infrastructure\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdvantageSeeder::class,
            HouseClassSeeder::class,
            IssuanceSeeder::class,
            LandscapingSeeder::class,
            TechnologySeeder::class
        ]);
    }
}
