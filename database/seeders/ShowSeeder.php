<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Show;
use App\Models\Evening; // Associer les shows à des soirées existantes
use Faker\Factory as Faker;

class ShowSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $eveningIds = Evening::pluck('id'); // Récupère les IDs des soirées existantes

        for ($i = 0; $i < 10; $i++) {
            Show::create([
                'title' => $faker->sentence(4), // Titre du show
                'description' => $faker->paragraph, // Description
                'time' => $faker->time('H:i'), // Heure du show
                'video' => $faker->url, // URL de vidéo
                'eveningId' => $faker->randomElement($eveningIds), // Associer à une soirée
            ]);
        }
    }
}
