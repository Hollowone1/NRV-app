<?php

namespace App\Http\Controllers;

use App\Services\SpotService;
use App\Traits\JsonControllerTrait;
use App\Exceptions\ServiceEveningNotFoundException;
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

    public function getAllSpots(): JsonResponse
    {
        try {
            $spots = $this->serviceSpot->getSpots();

            return response()->json([
                'type' => 'resource',
                'spots' => $this->formatJsonResource($spots),
            ], Response::HTTP_OK);
        } catch (ServiceEveningNotFoundException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
