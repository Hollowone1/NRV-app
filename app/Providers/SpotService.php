<?php

namespace App\Services;

use App\Models\Spot;
use Illuminate\Database\Eloquent\Collection;

class SpotService
{
    public function getSpots(): Collection
    {
        $spots = Spot::with('images')->get();

        if ($spots->isEmpty()) {
            throw new \App\Exceptions\ServiceEveningNotFoundException('No spots found.');
        }

        return $spots;
    }
}
