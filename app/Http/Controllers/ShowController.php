<?php

namespace App\Http\Controllers;

use App\Services\ShowService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowController extends Controller
{
    private ShowService $serviceShow;

    public function __construct(ShowService $serviceShow)
    {
        $this->serviceShow = $serviceShow;
    }

    public function getShows(Request $request): JsonResponse
    {
        $queryParams = $request->query();
        $shows = [];

        if (isset($queryParams['date'])) {
            $shows = $this->serviceShow->getShowsByDate($queryParams['date']);
        } elseif (isset($queryParams['lieu'])) {
            $shows = $this->serviceShow->getShowsBySpot($queryParams['lieu']);
        } elseif (isset($queryParams['thematic'])) {
            $shows = $this->serviceShow->getShowsByThematic($queryParams['thematic']);
        } else {
            $shows = $this->serviceShow->getShows();
        }

        if (empty($shows)) {
            return response()->json([
                'type' => 'resource',
                'nbShows' => 0,
                'shows' => [],
                'message' => 'No shows found.',
            ], Response::HTTP_OK);
        }

        $data = [
            'type' => 'resource',
            'nbShows' => count($shows),
            'shows' => [],
        ];

        foreach ($shows as $show) {
            $date = $this->serviceShow->getEvening($show->evening_id)->date;
            $date = substr($date, 0, 10);

            $data['shows'][] = [
                'id' => $show->id,
                'title' => $show->title,
                'description' => $show->description,
                'time' => $show->time,
                'date' => $date,
                'video' => $show->video,
                'evening_id' => $show->evening_id,
                'artists' => $show->artists,
                'images' => $show->images,
            ];
        }

        return response()->json($data, Response::HTTP_OK);
    }
}
