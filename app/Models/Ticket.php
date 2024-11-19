<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\JsonSerializableTrait;

class Ticket extends Model
{
    use JsonSerializableTrait;

    protected $table = 'Ticket';
    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'date',
        'barcode',
        'client_email',
        'eveningId',
        'id_command',
        'price',
    ];

    
    protected array $relationsToInclude = ['evening', 'command'];

    public function evening()
    {
        return $this->belongsTo(Evening::class, 'eveningId');
    }

    public function command()
    {
        return $this->belongsTo(Command::class, 'id_command');
    }
}
