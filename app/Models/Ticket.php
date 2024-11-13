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
        'clientMail',
        'eveningId',
        'idCommand',
        'price'
    ];

    public function evening () {
        return $this->belongsTo(Evening::class, 'eveningId');
    }
}
