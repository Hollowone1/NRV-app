<?php

namespace App\Services;

use App\Models\Command;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CommandService
{
    public function accederCommande(int $id): ?Command
    {
        return Command::find($id);
    }

    public function getAllCommandsByUser(string $mail_client): array
    {
        $commands = Command::where('client_email', $mail_client)->get();

        return $commands->map(fn($command) => $command->toArray())->toArray();
    }

    public function validerCommande(int $id): void
    {
        $command = $this->accederCommande($id);

        if (!$command) {
            throw new \Exception('Command not found.', 404);
        }

        if ($command->etat !== Command::ETAT_CREE) {
            throw new \Exception('Command cannot be validated.', 400);
        }

        $command->etat = Command::ETAT_VALIDE;
        $command->save();
    }

    public function creerCommande(array $data): ?Command
    {
        DB::beginTransaction();

        try {
            $command = new Command();
            $command->id = Uuid::uuid4()->toString();
            $command->client_email = $data['mail_client'];
            $command->etat = Command::ETAT_CREE;
            $command->date_commande = now();
            $command->montant_total = 0; // Calculé ensuite
            $command->save();

            $totalAmount = 0;

            foreach ($data['tickets'] as $ticketData) {
                $ticket = new Ticket();
                $ticket->id = Uuid::uuid4()->toString();
                $ticket->date = $ticketData['date'];
                $ticket->barcode = $ticketData['barcode'];
                $ticket->client_email = $ticketData['client_email'];
                $ticket->evening_id = $ticketData['evening_id'];
                $ticket->price = $ticketData['price'];
                $ticket->id_command = $command->id;
                $ticket->save();

                $totalAmount += $ticketData['price'];
            }

            $command->montant_total = $totalAmount;
            $command->save();

            DB::commit();

            return $command;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }
}
