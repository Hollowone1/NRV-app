<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Show;
use App\Models\ShowImage;
use Faker\Factory as Faker;

class ShowImageSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $showIds = Show::pluck('id'); // Récupère les IDs des shows existants

        foreach ($showIds as $showId) {
            // Génère entre 1 et 5 images pour chaque show
            for ($i = 0; $i < rand(1, 5); $i++) {
                ShowImage::create([
                    'showId' => $showId, // Associe l'image au show
                    'url' => $faker->imageUrl(640, 480, 'events', true, 'Faker'), // URL de l'image
                ]);
            }
        }
    }
}
