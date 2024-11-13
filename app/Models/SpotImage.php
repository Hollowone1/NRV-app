<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpotImage extends Model
{
    protected $table = 'SpotImage';
    protected $primaryKey = 'id';

    protected $fillable = [
        'path',
        'spotId',
    ];
}
