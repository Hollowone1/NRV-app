<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\JsonSerializableTrait;

class Show extends Model
{
    use JsonSerializableTrait;

    protected $table = 'Show';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'time',
        'video',
        'eveningId',
    ];

    protected array $relationsToInclude = ['evening', 'artists', 'images'];

    public function evening()
    {
        return $this->belongsTo(Evening::class, 'eveningId');
    }

    public function artists()
    {
        return $this->hasMany(Artist::class, 'showId');
    }

    public function images()
    {
        return $this->hasMany(ShowImage::class, 'showId');
    }
}
