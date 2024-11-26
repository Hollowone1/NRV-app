<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evening;
use Faker\Factory as Faker;

class EveningSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Evening::create([
                'name' => $faker->sentence(3), 
                'thematic' => $faker->word, 
                'date' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
                'price' => $faker->randomFloat(2, 10, 100), 
                'reducedPrice' => $faker->randomFloat(2, 5, 50),
            ]);
        }
    }
}
