<?php

namespace App\Services;

use App\Models\Evening;
use App\Exceptions\ServiceEveningNotFoundException;
use Illuminate\Database\Eloquent\Collection;

class EveningService
{
    /**
     * Récupérer toutes les dates des soirées avec leurs identifiants.
     *
     * @return Collection
     * @throws ServiceEveningNotFoundException
     */
    public function getAllDatesWithIdEvening(): Collection
    {
        $dates = Evening::select('id', 'date')->get();

        if ($dates->isEmpty()) {
            throw new ServiceEveningNotFoundException();
        }

        return $dates;
    }

    /**
     * Récupérer une soirée par son ID.
     *
     * @param int $id
     * @return Evening
     * @throws ServiceEveningNotFoundException
     */
    public function getEveningById(int $id): Evening
    {
        $evening = Evening::with(['spot', 'shows'])->find($id);

        if (!$evening) {
            throw new ServiceEveningNotFoundException();
        }

        return $evening;
    }
}
