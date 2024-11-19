<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'Ticket'; 
    protected $primaryKey = 'id';
    public $keyType = 'string'; 
    public $incrementing = false; 
    public $timestamps = false; 

    
    protected $fillable = [
        'id',
        'date',
        'barcode',
        'clientMmail',
        'eveningId', 
        'idCommand',
        'price',
    ];

    
    public function evening()
    {
        return $this->belongsTo(Evening::class, 'eveningId');
    }

    
    public function command()
    {
        return $this->belongsTo(Command::class, 'idCommand');
    }

    /**
     * Formater le ticket en tableau (remplace le DTO).
     */
    public function toFormattedArray(): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'barcode' => $this->barcode,
            'clientMmail' => $this->client_email,
            'eveningId' => $this->eveningId,
            'idCommand' => $this->id_command,
            'price' => $this->price,
        ];
    }
}
