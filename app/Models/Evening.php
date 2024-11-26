<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\JsonSerializableTrait;

class Evening extends Model
{
    use JsonSerializableTrait;

    protected $table = 'Evening';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'thematic',
        'date',
        'price',
        'reducedPrice',
        'spotId',
    ];

    protected array $relationsToInclude = ['spot', 'shows'];

    public function spot()
    {
        return $this->belongsTo(Spot::class, 'spotId');
    }

    public function shows()
    {
        return $this->hasMany(Show::class, 'eveningId');
    }
}
