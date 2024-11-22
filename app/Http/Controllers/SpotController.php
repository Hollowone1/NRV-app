<?php

namespace App\Http\Controllers;

use App\Services\SpotService;
use App\Traits\JsonControllerTrait;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SpotController extends Controller
{
    use JsonControllerTrait;

    private SpotService $serviceSpot;

    public function __construct(SpotService $serviceSpot)
    {
        $this->serviceSpot = $serviceSpot;
    }

    /**
     * Récupérer tous les spots.
     */
    public function getAllSpots(): JsonResponse
    {
        $spots = $this->serviceSpot->getSpots();

        if ($spots->isEmpty()) {
            return response()->json([
                'type' => 'resource',
                'spots' => [],
                'message' => 'No spots found.',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'type' => 'resource',
            'spots' => $this->formatJsonResource($spots),
        ], Response::HTTP_OK);
    }

    /**
     * Récupérer tous les noms des spots.
     */
    public function getAllNameSpots(): JsonResponse
    {
        $names = $this->serviceSpot->getAllNameSpots();

        if (empty($names)) {
            return response()->json([
                'type' => 'resource',
                'names_spots' => [],
                'message' => 'No spot names found.',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'type' => 'resource',
            'names_spots' => $names,
        ], Response::HTTP_OK);
    }
}
