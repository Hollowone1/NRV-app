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

        $this->call([
            CommandSeeder::class,
        ]);

        $this->call([
            ArtistSeeder::class,
        ]);

        $this->call([
            EveningSeeder::class,
        ]);

        $this->call([
            ShowSeeder::class,
        ]);

        $this->call([
            ShowImageSeeder::class,
        ]);

        $this->call([
            SpotSeeder::class,
        ]);

        $this->call([
            SpotImageSeeder::class,
        ]);

        $this->call([
            TicketSeeder::class,
        ]);
    }
}
