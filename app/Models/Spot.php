<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    protected $table = 'Spot';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'address',
        'nbStanding',
        'nbSeated',
    ];

    public function images () {
        return $this->hasMany(SpotImage::class, 'spotId');
    }
}
