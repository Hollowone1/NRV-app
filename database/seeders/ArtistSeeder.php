<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artist;
use Faker\Factory as Faker;

class ArtistSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Artist::create([
                'name' => $faker->name, // Nom de l'artiste
            ]);
        }
    }
}
