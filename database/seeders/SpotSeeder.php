<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Spot;
use App\Models\Evening; // Les soirées associées aux spots
use Faker\Factory as Faker;

class SpotSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Génération de 10 spots
        for ($i = 0; $i < 10; $i++) {
            $spot = Spot::create([
                'name' => $faker->company, 
                'address' => $faker->address,
                'nbStanding' => $faker->numberBetween(100, 1000),
                'nbSeated' => $faker->numberBetween(50, 500), 
            ]);

            // Associer entre 1 et 3 soirées à ce spot
            $eveningCount = rand(1, 3);
            for ($j = 0; $j < $eveningCount; $j++) {
                Evening::create([
                    'name' => $faker->sentence(3), 
                    'thematic' => $faker->word, 
                    'date' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
                    'price' => $faker->randomFloat(2, 10, 100), 
                    'reducedPrice' => $faker->randomFloat(2, 5, 50),
                    'spotId' => $spot->id, 
                ]);
            }
        }
    }
}
