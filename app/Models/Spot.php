<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    protected $table = 'Spot'; 
    protected $primaryKey = 'id';
    public $timestamps = false; 

    
    protected $fillable = [
        'name',
        'address',
        'nbStanding',
        'nbSeated',
    ];

    
    public function images()
    {
        return $this->hasMany(SpotImage::class, 'spotId');
    }

    /**
     * Formater le spot en tableau (remplace le DTO).
     */
    public function toFormattedArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'nbStanding' => $this->nb_standing,
            'nbSeated' => $this->nb_seated,
            'images' => $this->images->map(fn($image) => $image->toFormattedArray())->toArray(),
        ];
    }
}
