<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Command;

class CommandController extends Controller
{
    public function show($id)
{
    $command = Command::with('tickets')->findOrFail($id);
    return response()->json($command->toFormattedArray());
}

public function store(Request $request)
{
    $validated = $request->validate([
        'client_email' => 'required|email',
        'tickets' => 'required|array',
    ]);

    $command = Command::create([
        'clientMail' => $validated['client_email'],
        'dateCommande' => now(),
        'etat' => Command::ETAT_CREE,
        'montantTotal' => 0,
    ]);

    foreach ($validated['tickets'] as $ticketData) {
        $command->tickets()->create($ticketData);
    }

    $command->calculerMontantTotal();

    return response()->json($command->toFormattedArray(), 201);
}


}
