<?php

namespace App\Http\Controllers;

use App\Services\EveningService;
use App\Traits\JsonControllerTrait;
use App\Exceptions\ServiceEveningNotFoundException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EveningController extends Controller
{
    use JsonControllerTrait;

    private EveningService $serviceEvening;

    public function __construct(EveningService $serviceEvening)
    {
        $this->serviceEvening = $serviceEvening;
    }

    /**
     * Récupérer toutes les dates des soirées.
     */
    public function getAllDatesEvening(): JsonResponse
    {
        try {
            $dates = $this->serviceEvening->getAllDatesWithIdEvening();

            return response()->json([
                'type' => 'resource',
                'dates' => $this->formatJsonResource($dates),
            ], Response::HTTP_OK);
        } catch (ServiceEveningNotFoundException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], $e->getStatusCode());
        }
    }

    /**
     * Récupérer une soirée par ID.
     */
    public function getEveningById(int $id): JsonResponse
    {
        try {
            $evening = $this->serviceEvening->getEveningById($id);

            return response()->json([
                'type' => 'resource',
                'evening' => $evening->toFormattedArray(),
            ], Response::HTTP_OK);
        } catch (ServiceEveningNotFoundException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], $e->getStatusCode());
        }
    }

    /**
     * Récupérer toutes les thématiques des soirées.
     */
    public function getAllThematics(): JsonResponse
    {
        try {
            $thematics = $this->serviceEvening->getAllThematics();

            return response()->json([
                'type' => 'resource',
                'thematics' => $thematics,
            ], Response::HTTP_OK);
        } catch (ServiceEveningNotFoundException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], $e->getStatusCode());
        }
    }

    /**
     * Récupérer le nombre de places pour une soirée.
     */
    public function getNbPlace(int $id): JsonResponse
    {
        try {
            $places = $this->serviceEvening->getPlaceByEvening($id);

            return response()->json([
                'type' => 'resource',
                'places' => $places,
            ], Response::HTTP_OK);
        } catch (ServiceEveningNotFoundException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], $e->getStatusCode());
        }
    }
}
