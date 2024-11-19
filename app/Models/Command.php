<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\JsonSerializableTrait;

class Command extends Model
{
    use JsonSerializableTrait;

    protected $table = 'Command';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'dateCommande',
        'etat',
        'montantTotal',
        'clientMail',
    ];

    protected array $relationsToInclude = ['tickets'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'idCommand');
    }
}
