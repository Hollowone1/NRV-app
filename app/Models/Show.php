<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $table = 'Show';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'time',
        'video',
        'eveningId', 
    ];

    
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

    /**
     * Formater le show en tableau (remplace le DTO).
     */
    public function toFormattedArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'time' => $this->time,
            'video' => $this->video,
            'evening_id' => $this->eveningId,
            'artists' => $this->artists->map(fn($artist) => $artist->toFormattedArray())->toArray(),
            'images' => $this->images->map(fn($image) => $image->toFormattedArray())->toArray(),
        ];
    }
}
