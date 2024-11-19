<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpotImage extends Model
{
    protected $table = 'SpotImage'; 
    protected $primaryKey = 'id';
    public $timestamps = false; 

    
    protected $fillable = [
        'url',
        'spotId',
    ];

    /**
     * Formater l'image en tableau.
     */
    public function toFormattedArray(): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
        ];
    }
}
