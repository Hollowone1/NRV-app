<?php

namespace App\Services;

use App\Models\Spot;
use Illuminate\Database\Eloquent\Collection;

class SpotService
{
    public function getSpots(): Collection
    {
        return Spot::with('images')->get();
    }

    public function getAllNameSpots(): array
    {
        return Spot::select('name')->distinct()->pluck('name')->toArray();
    }
}
