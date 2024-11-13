<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evening extends Model
{
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

    public function shows()
    {
        return $this->hasMany(Show::class, 'eveningId');
    }

    public function spot(){
        return $this->belongsTo(Spot::class, 'spotId');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'eveningId');
    }
}
