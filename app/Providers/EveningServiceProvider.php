<?php

namespace App\Services;

use App\Models\Evening;
use App\Exceptions\ServiceEveningNotFoundException;

class EveningService
{
    public function getAllDatesWithIdEvening()
    {
        $dates = Evening::select('id', 'date')->get();

        if ($dates->isEmpty()) {
            throw new ServiceEveningNotFoundException();
        }

        return $dates;
    }

    public function getEveningById(int $id)
    {
        $evening = Evening::with(['spot', 'shows'])->find($id);

        if (!$evening) {
            throw new ServiceEveningNotFoundException();
        }

        return $evening;
    }

    public function getAllThematics(): array
    {
        $thematics = Evening::select('thematic')->distinct()->pluck('thematic')->toArray();

        if (empty($thematics)) {
            throw new ServiceEveningNotFoundException();
        }

        return $thematics;
    }

    public function getPlaceByEvening(int $id): array
    {
        $evening = Evening::with('spot')->find($id);

        if (!$evening || !$evening->spot) {
            throw new ServiceEveningNotFoundException();
        }

        return [
            'nbStanding' => $evening->spot->nb_standing,
            'nbSeated' => $evening->spot->nb_seated,
        ];
    }
}
