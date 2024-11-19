<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\JsonSerializableTrait;

class Spot extends Model
{
    use JsonSerializableTrait;

    protected $table = 'Spot';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'address',
        'nbStanding',
        'nbSeated',
    ];

    protected array $relationsToInclude = ['images'];

    public function images()
    {
        return $this->hasMany(SpotImage::class, 'spotId');
    }
}
