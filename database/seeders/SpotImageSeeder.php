<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Spot;
use App\Models\SpotImage;
use Faker\Factory as Faker;

class SpotImageSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $spotIds = Spot::pluck('id'); 

        foreach ($spotIds as $spotId) {
            for ($i = 0; $i < rand(1, 5); $i++) {
                SpotImage::create([
                    'spotId' => $spotId, 
                    'url' => $faker->imageUrl(640, 480, 'business', true, 'SpotImage'), 
                ]);
            }
        }
    }
}
