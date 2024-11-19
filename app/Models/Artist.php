<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    
    protected $table = 'Artist';

    
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

   
    public $timestamps = false;
    
    protected $fillable = ['id', 'name'];

    /**
     * Formater l'artiste en tableau (remplace le DTO).
     */
    public function toFormattedArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
