<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    
    public const ETAT_CREE = 1;
    public const ETAT_VALIDE = 2;
    public const ETAT_PAYE = 3;

    
    protected $table = 'Command';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    
    public $timestamps = false;

   
    protected $fillable = ['id', 'dateCommande', 'etat', 'montantTotal', 'clientMail'];

    
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'idCommand');
    }

    
    public function calculerMontantTotal(): float
    {
        $montantTotal = $this->tickets->sum('price'); // Utilisation de la collection Eloquent
        $this->montantTotal = $montantTotal;
        $this->save();
        return $montantTotal;
    }

    /**
     * Formater la commande en tableau (remplace le DTO).
     */
    public function toFormattedArray(): array
    {
        return [
            'id' => $this->id,
            'date' => $this->dateCommande,
            'client_email' => $this->clientMail,
            'montant_total' => $this->montantTotal,
            'tickets' => $this->tickets->map(fn($ticket) => $ticket->toArray())->toArray(),
            'etat' => $this->etat,
        ];
    }
}
