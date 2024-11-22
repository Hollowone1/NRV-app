<?php

namespace App\Services;

use App\Models\Show;
use App\Models\Evening;

class ShowService
{
    public function getShows()
    {
        return Show::with(['artists', 'images'])->get();
    }

    public function getShowsByDate(string $date)
    {
        return Show::whereHas('evening', function ($query) use ($date) {
            $query->whereDate('date', $date);
        })->with(['artists', 'images'])->get();
    }

    public function getShowsBySpot(string $spotName)
    {
        return Show::whereHas('evening.spot', function ($query) use ($spotName) {
            $query->where('name', $spotName);
        })->with(['artists', 'images'])->get();
    }

    public function getShowsByThematic(string $thematic)
    {
        return Show::whereHas('evening', function ($query) use ($thematic) {
            $query->where('thematic', $thematic);
        })->with(['artists', 'images'])->get();
    }

    public function getEvening(int $eveningId): Evening
    {
        return Evening::find($eveningId);
    }
}
