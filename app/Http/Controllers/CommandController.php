<?php

namespace App\Http\Controllers;

use App\Services\CommandService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommandController extends Controller
{
    private CommandService $commandService;

    public function __construct(CommandService $commandService)
    {
        $this->commandService = $commandService;
    }

    /**
     * Récupérer une commande par ID.
     */
    public function getCommand(int $id): JsonResponse
    {
        $command = $this->commandService->accederCommande($id);

        if (!$command) {
            return response()->json([
                'type' => 'error',
                'message' => 'Command not found.',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'type' => 'resource',
            'commande' => $command->toArray(),
        ], Response::HTTP_OK);
    }

    /**
     * Récupérer toutes les commandes d'un utilisateur.
     */
    public function getCommandsByUser(string $mail_client): JsonResponse
    {
        $commands = $this->commandService->getAllCommandsByUser($mail_client);

        if (empty($commands)) {
            return response()->json([
                'type' => 'resource',
                'commands' => [],
                'message' => 'No commands found for this user.',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'type' => 'resource',
            'commands' => $commands,
        ], Response::HTTP_OK);
    }

    /**
     * Valider une commande par ID.
     */
    public function patchValiderCommande(int $id): JsonResponse
    {
        try {
            $this->commandService->validerCommande($id);
        } catch (\Exception $e) {
            if ($e->getCode() === 400) {
                return response()->json([
                    'error' => 'Bad Request',
                    'message' => $e->getMessage(),
                ], Response::HTTP_BAD_REQUEST);
            }

            if ($e->getCode() === 404) {
                return response()->json([
                    'error' => 'Not Found',
                    'message' => $e->getMessage(),
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'error' => 'Internal Server Error',
                'message' => 'An unexpected error occurred.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $command = $this->commandService->accederCommande($id);

        return response()->json([
            'type' => 'commande',
            'status' => 'success',
            'commande' => $command->toArray(),
        ], Response::HTTP_OK);
    }

    /**
     * Créer une commande.
     */
    public function postCreerCommande(Request $request): JsonResponse
    {
        $data = $request->json()->all();

        $command = $this->commandService->creerCommande($data);

        if (!$command) {
            return response()->json([
                'type' => 'error',
                'message' => 'Failed to create command.',
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'type' => 'resource',
            'commande' => $command->toArray(),
        ], Response::HTTP_CREATED);
    }
}
