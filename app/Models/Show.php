<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $table = 'Show';
    protected $primaryKey = 'id';

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

    public function artists () {
        return $this->hasMany(Artist::class, 'showId');
    }

    public function images() {
        return $this->hasMany(ShowImage::class, 'showId');
    }
}
