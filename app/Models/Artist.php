<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\JsonSerializableTrait;

class Artist extends Model
{
    use JsonSerializableTrait;

    protected $table = 'Artist';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    protected array $relationsToInclude = ['shows'];

    public function shows()
    {
        return $this->belongsToMany(Show::class, 'ShowArtist', 'artistId', 'showId');
    }
}
