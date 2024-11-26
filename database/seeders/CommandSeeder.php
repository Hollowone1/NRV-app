<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Command;
use Faker\Factory as Faker;

class CommandSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Command::create([
                'id' => $faker->uuid,
                'clientMmail' => $faker->unique()->safeEmail,
                'dateCommande' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                'etat' => $faker->numberBetween(1, 2), // 1 = ETAT_CREE, 2 = ETAT_VALIDE
                'montantTotal' => $faker->randomFloat(2, 50, 500),
            ]);
        }
    }
}
