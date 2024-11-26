<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Command;
use App\Models\Evening;
use Faker\Factory as Faker;

class TicketSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $commandIds = Command::pluck('id'); // Récupère les IDs des commandes existantes
        $eveningIds = Evening::pluck('id'); // Récupère les IDs des soirées existantes

        foreach ($commandIds as $commandId) {
            for ($i = 0; $i < rand(1, 5); $i++) {
                Ticket::create([
                    'idCommand' => $commandId, 
                    'eveningId' => $faker->randomElement($eveningIds), 
                    'date' => $faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
                    'barcode' => $faker->unique()->uuid, 
                    'clientMmail' => $faker->unique()->safeEmail,
                    'price' => $faker->randomFloat(2, 10, 100),
                ]);
            }
        }
    }
}
