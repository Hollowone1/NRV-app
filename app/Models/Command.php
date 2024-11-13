<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    public const ETAT_CREE=1;
    public const ETAT_VALIDE= 2;
    const ETAT_PAYE=3;

    protected $table = 'Command';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id', 'dateCommande', 'etat', 'montantTotal', 'clientMail'];

    public function tickets () {
        return $this->hasMany(Ticket::class, 'idCommand');
    }

    public function calculerMontantTotal(): float {
        $montantTotal = 0;
        foreach ($this->tickets as $ticket) {
            $montantTotal += $ticket->price;
        }
        $this->montant_total = $montantTotal;
        $this->save();
        return $montantTotal;
    }
}
